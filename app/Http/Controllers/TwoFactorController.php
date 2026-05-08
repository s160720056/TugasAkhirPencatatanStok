<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TwoFactorController extends Controller
{
    /**
     * Helper: Mendapatkan user yang sedang login
     */
    private function getCurrentUser()
    {
        return Auth::user();
    }

    /**
     * Helper: Cek apakah user adalah owner
     */
    private function isOwner(): bool
    {
        $user = $this->getCurrentUser();
        return $user && $user->ownership == 1;
    }

    // ====================== VERIFIKASI 2FA SAAT LOGIN ======================
    public function show()
    {
        if (!session('2fa_pending_user_id')) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('auth.2fa-verify');
    }

    public function verify(Request $request)
    {
        if (!session('2fa_pending_user_id')) {
            return redirect()->route('login');
        }

        $request->validate(['code' => 'required|digits:6']);

        $userId = session('2fa_pending_user_id');
        $guard = session('2fa_guard');

        $user = User::findOrFail($userId);
        $google2fa = new Google2FA();

        if ($google2fa->verifyKey($user->two_factor_secret, $request->code)) {

            Auth::guard($guard)->login($user, session('2fa_remember', false));

            $request->session()->forget(['2fa_pending_user_id', '2fa_guard', '2fa_remember']);
            $request->session()->regenerate(true);

            $loginController = app(\App\Http\Controllers\Auth\LoginController::class);
            return $loginController->authenticated($request, $user, $guard);
        }

        return back()->withErrors(['code' => 'Kode 2FA salah. Silakan coba lagi.']);
    }

    // ====================== SETUP 2FA DARI HALAMAN USER MANAGEMENT ======================
    public function setupForUser($id)
    {
        $currentUser = $this->getCurrentUser();
        $user = User::findOrFail($id);

        // Non-owner hanya boleh setup 2FA dirinya sendiri
        if (!$this->isOwner() && $user->id_user != $currentUser?->id_user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki izin untuk mengatur 2FA user lain'
            ], 403);
        }

        $google2fa = new Google2FA();

        // Selalu buat secret baru setiap kali modal dibuka
        $secret = $google2fa->generateSecretKey();

        $user->update([
            'two_factor_secret' => $secret,
            'two_factor_enabled' => false,
            'two_factor_confirmed_at' => null,
        ]);

        $qrCodeInline = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->username . ' (' . $user->nama_user . ')',
            $secret
        );

        return response()->json([
            'html' => view('auth.2fa-setup-modal', compact('qrCodeInline', 'user'))->render()
        ]);
    }

    public function confirmSetupForUser(Request $request, $id)
    {
        $currentUser = $this->getCurrentUser();
        $user = User::findOrFail($id);

        // Non-owner hanya boleh confirm 2FA dirinya sendiri
        if (!$this->isOwner() && $user->id_user != $currentUser?->id_user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki izin untuk mengatur 2FA user lain'
            ], 403);
        }

        $request->validate(['code' => 'required|digits:6']);

        $google2fa = new Google2FA();

        if ($google2fa->verifyKey($user->two_factor_secret, $request->code)) {
            $user->update([
                'two_factor_enabled' => true,
                'two_factor_confirmed_at' => now(),
            ]);

            return response()->json(['status' => 'success', 'message' => '2FA berhasil diaktifkan.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Kode 2FA tidak valid.'], 422);
    }

    // ====================== SETUP & DISABLE UNTUK USER YANG SEDANG LOGIN ======================
    public function setup()
    {
        $user = $this->getCurrentUser();
        $google2fa = new Google2FA();

        $secret = $google2fa->generateSecretKey();

        $user->update([
            'two_factor_secret'      => $secret,
            'two_factor_enabled'     => false,
            'two_factor_confirmed_at'=> null,
        ]);

        $qrCodeInline = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->username . ' (' . $user->nama_user . ')',
            $secret
        );

        return view('auth.2fa-setup', compact('qrCodeInline', 'user'));
    }

    public function confirmSetup(Request $request)
    {
        $request->validate(['code' => 'required|digits:6']);

        $user = $this->getCurrentUser();
        $google2fa = new Google2FA();

        if ($google2fa->verifyKey($user->two_factor_secret, $request->code)) {
            $user->update([
                'two_factor_enabled' => true,
                'two_factor_confirmed_at' => now(),
            ]);

            return redirect()->route('home')
                ->with('success', 'Two-Factor Authentication berhasil diaktifkan!');
        }

        return back()->withErrors(['code' => 'Kode 2FA tidak valid.']);
    }

    public function disable(Request $request)
    {
        $user = $this->getCurrentUser();

        $user->update([
            'two_factor_secret' => null,
            'two_factor_enabled' => false,
            'two_factor_confirmed_at' => null,
        ]);

        return back()->with('success', 'Two-Factor Authentication telah dimatikan.');
    }

    public function disableForUser($id)
    {
        $currentUser = $this->getCurrentUser();
        $user = User::findOrFail($id);

        // Hanya owner yang boleh disable 2FA user lain
        // ownership=0 hanya boleh disable 2FA dirinya sendiri
        if (!$this->isOwner() && $user->id_user != $currentUser?->id_user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki izin untuk menonaktifkan 2FA user lain'
            ], 403);
        }

        $user->update([
            'two_factor_secret' => null,
            'two_factor_enabled' => false,
            'two_factor_confirmed_at' => null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => '2FA berhasil dinonaktifkan.'
        ]);
    }
}