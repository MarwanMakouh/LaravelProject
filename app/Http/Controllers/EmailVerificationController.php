<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    /**
     * Toon de email verificatie notice
     */
    public function notice()
    {
        return view('auth.verify-email');
    }

    /**
     * Verifieer het email adres
     */
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('home')->with('status', 'Je email is succesvol geverifieerd!');
    }

    /**
     * Verstuur opnieuw een verificatie email
     */
    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'Verificatie link opnieuw verzonden!');
    }
}
