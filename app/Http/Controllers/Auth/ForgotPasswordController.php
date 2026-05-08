<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendEmailActivation;
use App\Mail\SendEmailReset;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;   // ← ADD THIS
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    // ← This trait gives us showLinkRequestForm() + other default methods
    use SendsPasswordResetEmails;

    /**
     * Send activation PIN or reset PIN via email
     * (We override only this method)
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $email = $request->email;

        // ==================== RATE LIMITING (anti-spam) ====================
        $throttleKey = 'forgot-password.' . $email . '|' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'email' => "Terlalu banyak permintaan. Silakan tunggu {$seconds} detik.",
            ]);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            RateLimiter::hit($throttleKey, 900);
            Log::warning('Forgot password - email not found', ['email' => $email, 'ip' => $request->ip()]);
            // Security: always show the same message
            return redirect()->route('login')
                ->with('success', 'Jika email terdaftar, PIN telah dikirim.');
        }

        $isActivation = ($user->STATUS_USER != '1' || $user->activationPin !== null);

        if ($isActivation) {
            $this->sendActivationPin($user, $email, $request->ip());
        } else {
            $this->sendResetPin($user, $email, $request->ip());
        }

        RateLimiter::hit($throttleKey, 900);

        return redirect()->route('login')
            ->with('success', 'Email telah dikirim. Silahkan cek inbox/spam dan masukkan PIN di halaman login.');
    }

    /**
     * Send Activation PIN
     */
    private function sendActivationPin(User $user, string $email, string $ip)
    {
        $pin = random_int(100000, 999999);

        $user->update([
            'activationPin'         => Hash::make($pin),
            'activationPin_expires' => Carbon::now()->addMinutes(60),
            'resetPin'              => null,
            'resetPin_expires'      => null,
        ]);

        $isSuperadmin = $user->superadmin == '1';
        $toEmail = $isSuperadmin ? env('ADMIN_EMAIL_LOCAL') : $email;

        Mail::to($toEmail)->send(new SendEmailActivation($email, $pin, $isSuperadmin));

        Log::info('Activation PIN sent', [
            'email'         => $email,
            'is_superadmin' => $isSuperadmin,
            'ip'            => $ip
        ]);
    }

    /**
     * Send Reset Password PIN
     */
    private function sendResetPin(User $user, string $email, string $ip)
    {
        $pin = random_int(100000, 999999);

        $user->update([
            'resetPin'         => Hash::make($pin),
            'resetPin_expires' => Carbon::now()->addMinutes(60),
            'activationPin'    => null,
            'activationPin_expires' => null,
        ]);

        $isSuperadmin = $user->superadmin == '1';
        $toEmail = $isSuperadmin ? env('ADMIN_EMAIL_LOCAL') : $email;

        Mail::to($toEmail)->send(new SendEmailReset($email, $pin));

        Log::info('Reset PIN sent', [
            'email'         => $email,
            'is_superadmin' => $isSuperadmin,
            'ip'            => $ip
        ]);
    }
}