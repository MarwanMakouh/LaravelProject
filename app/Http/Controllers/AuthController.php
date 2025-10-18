<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    /**
     * Toon de login pagina
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Verwerk het login formulier
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'Je bent succesvol ingelogd!');
        }

        return back()->withErrors([
            'email' => 'De inloggegevens zijn onjuist.',
        ])->onlyInput('email');
    }

    /**
     * Toon de registratie pagina
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Verwerk het registratie formulier
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'name.required' => 'Naam is verplicht.',
            'email.required' => 'E-mailadres is verplicht.',
            'email.email' => 'Voer een geldig e-mailadres in.',
            'email.unique' => 'Dit e-mailadres is al in gebruik.',
            'password.required' => 'Wachtwoord is verplicht.',
            'password.confirmed' => 'De wachtwoorden komen niet overeen.',
            'password.min' => 'Wachtwoord moet minimaal 8 tekens zijn.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        // Trigger email verification
        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice')->with('status', 'Je account is aangemaakt! Controleer je email voor verificatie.');
    }

    /**
     * Uitloggen
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Je bent succesvol uitgelogd!');
    }
}
