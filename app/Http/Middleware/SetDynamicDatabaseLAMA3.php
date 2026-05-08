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
        
        $path = $request->path();
        if (
            str_contains($path, 'pulse') ||           // Semua route Pulse
            $request->header('X-Livewire') ||
            $request->is('livewire/*') ||
            str_contains($path, 'livewire')
        ) {
            return $next($request);
        }
        if ($request->routeIs('pulse.*') || str_contains($path, 'pulse')) {
            return $next($request);
        }

        if ($request->is('*.css', '*.js', '*.png', '*.jpg', '*.ico', '*.svg') ||
        str_starts_with($path, 'storage/') ||
        str_starts_with($path, 'assets/')) {
            return $next($request);
        }

        $idToko = session('id_toko');
        $username = session('username');
        $currentRouteName = $request->route()?->getName();

        // ==================== DETEKSI SESSION RUSAK (DIBUAT LEBIH LONGGAR) ====================
        if (Auth::guard('user')->check()) {
            // Hanya cek session rusak jika BUKAN request pertama setelah login
            // Dan bukan route yang diizinkan (home, toko, cekHakAkses, dll)
            if (empty($username) && ! $this->isAllowedWithoutToko($currentRouteName, $request->path())) {

                Log::warning('🚨 Session rusak terdeteksi (username hilang meski guard aktif)', [
                    'route' => $currentRouteName,
                    'path' => $request->path(),
                ]);

                return $this->forceLogout($request, 'Session username hilang');
            }
        }

        // ==================== ID_TOKO BELUM DIPILIH ====================
        if (empty($idToko)) {

            $isAllowed = $this->isAllowedWithoutToko($currentRouteName, $request->path());

            if (Auth::guard('user')->check() && ! $isAllowed) {

                $redirectCount = session('toko_redirect_count', 0) + 1;
                session(['toko_redirect_count' => $redirectCount]);

                if ($redirectCount >= $this->maxRedirectCount) {
                    return $this->forceLogout($request, 'Loop redirect terdeteksi');
                }

                Log::info('Redirect ke home karena id_toko belum dipilih', [
                    'attempted_route' => $currentRouteName,
                    'redirect_count' => $redirectCount,
                ]);

                return redirect('/home')
                    ->with('warning', 'Silakan pilih toko terlebih dahulu.');
            }

            session()->forget('toko_redirect_count');

            return $next($request);
        }

        // ==================== NORMAL FLOW ====================
        session()->forget('toko_redirect_count');

        $dbName = env('DYNAMIC_DB').$idToko;

        try {
            Config::set('database.connections.dynamic.database', $dbName);
            DB::purge('dynamic');
            DB::reconnect('dynamic');

            Log::info('✅ Dynamic DB switched', [
                'id_toko' => $idToko,
                'database' => $dbName,
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Dynamic DB switch failed', ['error' => $e->getMessage()]);
        }

        return $next($request);
    }

    private function forceLogout(Request $request, string $reason): Response
    {
        Log::warning("🚨 FORCE LOGOUT TRIGGERED: {$reason}");

        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->withErrors(['message' => 'Sesi tidak valid atau telah berakhir. Silakan login kembali.']);
    }

    private function isAllowedWithoutToko(?string $routeName, string $path): bool
    {
        if (! $routeName) {
            return str_starts_with($path, 'home') ||
                   str_starts_with($path, 'toko/') ||
                   str_starts_with($path, 'user') ||
                   str_starts_with($path, 'cekHakAkses') ||
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
