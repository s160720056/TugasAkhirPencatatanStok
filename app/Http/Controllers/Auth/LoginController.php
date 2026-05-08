<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\HakAkses;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function throttleKey(Request $request)
    {
        return 'login.' . $request->ip();
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        $key = $this->throttleKey($request);

        // ==================== 1. CLOUDFLARE TURNSTILE ====================
        if ($request->filled('cf-turnstile-response')) {
            $response = Http::timeout(8)
                ->asForm()
                ->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                    'secret' => env('TURNSTILE_SECRET_KEY'),
                    'response' => $request->input('cf-turnstile-response'),
                    'remoteip' => $request->ip(),
                ]);

            if (!$response->successful() || !($response->json()['success'] ?? false)) {
                RateLimiter::hit($key, 60);
                throw ValidationException::withMessages(['captcha' => 'Verifikasi Cloudflare gagal. Silakan coba lagi.']);
            }
        } else {
            throw ValidationException::withMessages(['captcha' => 'Verifikasi keamanan diperlukan.']);
        }

        // ==================== 2. RATE LIMITER ====================
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'password' => "Terlalu banyak percobaan. Tunggu {$seconds} detik.",
            ]);
        }

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            RateLimiter::hit($key, 60);
            throw ValidationException::withMessages(['password' => 'Username atau Password Salah.']);
        }

        // ==================== 3. ACTIVATION PIN ====================
        if ($this->handleActivationPin($request, $user)) {
            return $this->authenticated($request, $user, $user->superadmin == '1' ? 'admin' : 'user');
        }

        // ==================== 4. RESET PASSWORD PIN ====================
        if ($this->handleResetPin($request, $user)) {
            return $this->authenticated($request, $user, $user->superadmin == '1' ? 'admin' : 'user');
        }

        // ==================== 5. NORMAL LOGIN ====================
        if ($user->STATUS_USER != '1') {
            RateLimiter::hit($key, 60);
            throw ValidationException::withMessages(['password' => 'Akun belum aktif.']);
        }

        $credentials = ['username' => $request->username, 'password' => $request->password];
        $guard = $user->superadmin == '1' ? 'admin' : 'user';

        if (auth()->guard($guard)->attempt($credentials, $request->boolean('remember'))) {
            $loggedInUser = auth()->guard($guard)->user();

            if ($loggedInUser->two_factor_enabled && $loggedInUser->two_factor_confirmed_at) {
                session([
                    '2fa_pending_user_id' => $loggedInUser->id_user,
                    '2fa_guard' => $guard,
                    '2fa_remember' => $request->boolean('remember')
                ]);
                auth()->guard($guard)->logout();
                return redirect()->route('2fa.verify');
            }

            return $this->authenticated($request, $loggedInUser, $guard);
        }

        RateLimiter::hit($key, 60);
        throw ValidationException::withMessages(['password' => 'Username atau Password Salah.']);
    }

    // ====================== PIN HANDLERS ======================
    private function handleActivationPin(Request $request, User $user): bool
    {
        if ($this->validatePin($request->password, $user->activationPin, $user->activationPin_expires)) {
            $user->update([
                'STATUS_USER' => '1',
                'activationPin' => null,
                'activationPin_expires' => null,
            ]);

            Log::info('✅ ACTIVATION PIN BERHASIL', [
                'username' => $user->username,
                'ip' => $request->ip()
            ]);

            RateLimiter::clear($this->throttleKey($request));
            return true;
        }
        return false;
    }

    private function handleResetPin(Request $request, User $user): bool
    {
        if ($this->validatePin($request->password, $user->resetPin, $user->resetPin_expires)) {
            $user->update([
                'password' => bcrypt($request->password),   // PIN jadi password baru
                'resetPin' => null,
                'resetPin_expires' => null,
            ]);

            Log::info('✅ RESET PIN BERHASIL - Password diubah', [
                'username' => $user->username,
                'ip' => $request->ip()
            ]);

            RateLimiter::clear($this->throttleKey($request));
            return true;
        }
        return false;
    }

    private function validatePin($inputPin, $storedPin, $expiresAt): bool
    {
        if (!$storedPin || !$expiresAt || Carbon::now()->gt($expiresAt)) {
            Log::warning('❌ PIN validation failed', [
                'reason' => !$storedPin ? 'storedPin is null/empty' : (!$expiresAt ? 'no expiration' : 'expired'),
                'ip' => request()->ip()
            ]);
            return false;
        }
        $match = Hash::check($inputPin, $storedPin) || $inputPin === $storedPin;

        if (!$match) {
            Log::warning('❌ PIN hash mismatch', ['ip' => request()->ip()]);
        }
        return $match;
    }

    // ====================== AUTO LOGIN ======================
    public function authenticated(Request $request, $user, $guard)
    {
        $this->clearLoginAttempts($request);
        RateLimiter::clear($this->throttleKey($request));

        $otherGuard = $guard === 'admin' ? 'user' : 'admin';
        auth()->guard($otherGuard)->logout();

        $request->session()->regenerate(false);

        if ($guard === 'admin') {
            $request->session()->put([
                'username' => $user->username,
                'id_toko'  => $user->id_toko ?? null,
                'id_user'  => $user->id_user,
            ]);
            return redirect()->intended('/pengajuanToko');
        }

        $hakAkses = HakAkses::find($user->id_hak_akses);
        $sessionData = [
            'username' => $user->username,
            'id_toko' => $user->id_toko ?? null,
            'hak_akses' => $user->id_hak_akses,
            'nama_hak_akses' => $hakAkses?->nama_hak_akses,
            'id_user' => $user->id_user,
        ];

        $request->session()->put($sessionData);
        $request->session()->save();

        return redirect()->intended('/home');
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        auth()->guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}