<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class PasswordResetController extends Controller
{
    /**
     * Toon het formulier om wachtwoord reset link aan te vragen
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Verstuur wachtwoord reset link naar email
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Email is verplicht',
            'email.email' => 'Voer een geldig email adres in',
            'email.exists' => 'Dit email adres is niet geregistreerd',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'We hebben je een wachtwoord reset link gemaild!')
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Toon het wachtwoord reset formulier
     */
    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    /**
     * Reset het wachtwoord
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.required' => 'Wachtwoord is verplicht',
            'password.min' => 'Wachtwoord moet minimaal 8 karakters lang zijn',
            'password.confirmed' => 'Wachtwoorden komen niet overeen',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'Je wachtwoord is succesvol gereset!')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
