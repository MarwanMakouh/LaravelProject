<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Toon het contact formulier
     */
    public function show()
    {
        return view('contact.form');
    }

    /**
     * Verstuur contact email
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ], [
            'name.required' => 'Naam is verplicht',
            'email.required' => 'Email is verplicht',
            'email.email' => 'Voer een geldig email adres in',
            'subject.required' => 'Onderwerp is verplicht',
            'message.required' => 'Bericht is verplicht',
            'message.max' => 'Bericht mag maximaal 5000 karakters zijn',
        ]);

        try {
            // Verstuur email naar GamePortal
            Mail::send('emails.contact', [
                'contactName' => $validated['name'],
                'contactEmail' => $validated['email'],
                'contactSubject' => $validated['subject'],
                'contactMessage' => $validated['message'],
            ], function ($message) use ($validated) {
                $message->to('gameportaalproject@gmail.com')
                        ->subject('Contact Formulier: ' . $validated['subject'])
                        ->replyTo($validated['email'], $validated['name']);
            });

            return back()->with('success', 'Je bericht is succesvol verzonden! We nemen zo snel mogelijk contact met je op.');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Er ging iets mis bij het verzenden. Probeer het later opnieuw.'])
                ->withInput();
        }
    }
}
