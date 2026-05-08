<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Auth;

class DeployController extends Controller
{
    public function deploy(Request $request)
    {
        // Keamanan: Hanya user tertentu yang boleh (disarankan pakai middleware)
        if (!Auth::check() || !Auth::user()->is_admin) {  // sesuaikan dengan logic kamu
            abort(403, 'Unauthorized');
        }

        $commands = [
            'cd ' . base_path(),
            'git pull origin main',           // ganti 'main' dengan branch kamu (master/main)
            'composer install --no-interaction --no-dev --prefer-dist', // optional
            // 'php artisan migrate --force',                              // optional
            'php artisan optimize:clear',                                   // optional
            // 'php artisan config:cache',
            // 'php artisan route:cache',
            // 'php artisan view:cache',
        ];

        $process = Process::fromShellCommandline(implode(' && ', $commands));
        $process->setTimeout(120); // 2 menit

        try {
            $process->mustRun();

            return response()->json([
                'status' => 'success',
                'message' => 'Git Pull berhasil!',
                'output' => $process->getOutput()
            ]);

        } catch (ProcessFailedException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal melakukan git pull',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
