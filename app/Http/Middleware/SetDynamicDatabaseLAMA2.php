<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SetDynamicDatabase
{
    protected $allowedWithoutToko = [
        'home*',
        'user*',
        'toko*',
        'cekHakAkses*',
        '2fa*',
        'login',
        'logout',
        'getInfoToko',
        'pengaturanToko*',
    ];

    protected int $maxRedirectCount = 5;

    public function handle(Request $request, Closure $next): Response
    {
        $idToko       = session('id_toko');
        $username     = session('username');
        $currentRouteName = $request->route()?->getName();

        // ==================== DETEKSI SESSION RUSAK ====================
        if (Auth::guard('user')->check()) {
            if (empty($username)) {
                Log::warning('🚨 Session rusak terdeteksi (username hilang meski guard aktif)');

                return $this->forceLogout($request, 'Session username hilang');
            }
        }

        // ==================== ID_TOKO BELUM DIPILIH ====================
        if (empty($idToko)) {

            $isAllowed = $this->isAllowedWithoutToko($currentRouteName, $request->path());

            if (Auth::guard('user')->check() && !$isAllowed) {

                $redirectCount = session('toko_redirect_count', 0) + 1;
                session(['toko_redirect_count' => $redirectCount]);

                if ($redirectCount >= $this->maxRedirectCount) {
                    return $this->forceLogout($request, 'Loop redirect terdeteksi');
                }

                Log::info('Redirect ke home karena id_toko belum dipilih', [
                    'attempted_route' => $currentRouteName,
                    'redirect_count'  => $redirectCount,
                ]);

                return redirect('/home')
                    ->with('warning', 'Silakan pilih toko terlebih dahulu.');
            }

            // Reset counter jika berada di route yang diizinkan
            session()->forget('toko_redirect_count');

            return $next($request);
        }

        // ==================== NORMAL FLOW (id_toko SUDAH ADA) ====================
        session()->forget('toko_redirect_count');

        $dbName = env('DYNAMIC_DB') . $idToko;

        try {
            Config::set('database.connections.dynamic.database', $dbName);
            DB::purge('dynamic');
            DB::reconnect('dynamic');

            Log::info('✅ Dynamic DB switched', [
                'id_toko'  => $idToko,
                'database' => $dbName
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Dynamic DB switch failed', [
                'id_toko' => $idToko,
                'error'   => $e->getMessage()
            ]);
        }

        return $next($request);
    }

    private function forceLogout(Request $request, string $reason): Response
    {
        $user = Auth::guard('user')->user();

        Log::warning("🚨 FORCE LOGOUT TRIGGERED: {$reason}", [
            'user_id'  => $user?->id_user ?? null,
            'username' => $user?->username ?? 'unknown',
        ]);

        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->withErrors(['message' => 'Sesi tidak valid atau telah berakhir. Silakan login kembali.']);
    }

    private function isAllowedWithoutToko(?string $routeName, string $path): bool
    {
        if (!$routeName) {
            return str_starts_with($path, 'home') ||
                   str_starts_with($path, 'toko/') ||
                   str_starts_with($path, 'user') ||
                   $path === 'cekHakAkses' ||
                   str_starts_with($path, 'pengaturanToko');
        }

        foreach ($this->allowedWithoutToko as $pattern) {
            if (fnmatch($pattern, $routeName)) {
                return true;
            }
        }
        return false;
    }
}