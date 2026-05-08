<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class PulseAuthorize
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil user dari guard manapun yang aktif
        $user = Auth::user()
             ?? Auth::guard('admin')->user()
             ?? Auth::guard('user')->user();

        // DEBUG (boleh dihapus nanti)
        // Log::info('🔒 Pulse Middleware Check', [
        //     'user_id' => $user?->id_user,
        //     'username' => $user?->username,
        //     'ownership' => $user?->ownership,
        //     'is_admin' => Auth::guard('admin')->check(),
        //     'is_user' => Auth::guard('user')->check(),
        // ]);

        // === KONDISI UTAMA ===
        // if (!$user || $user->ownership != 1) {
        //     abort(403, 'Akses Pulse ditolak. Hanya user dengan ownership = 1 yang diperbolehkan.');
        // }
        if (! $user || $user->ownership != 1) {
            return redirect('/');
        }

        return $next($request);
    }
}
