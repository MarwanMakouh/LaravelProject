@extends('layouts.app')

@section('title', 'Contact - GamePortal')

@section('content')
<style>
    .contact-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
        box-sizing: border-box;
    }

    @media (max-width: 500px) {
        .contact-container {
            padding: 0 1rem;
        }
    }

    .contact-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .contact-header h1 {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #ffffff;
    }

    body.light-theme .contact-header h1 {
        color: #000000;
    }

    .contact-header p {
        color: #cccccc;
    }

    body.light-theme .contact-header p {
        color: #666666;
    }

    .contact-form-container {
        max-width: 600px;
        margin: 0 auto;
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        padding: 30px;
        transition: all 0.3s ease;
    }

    body.light-theme .contact-form-container {
        background: #F9FAFB;
        border: 1px solid #000000;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .contact-form-container:hover {
        transform: translateY(-10px);
        border-color: #ffffff;
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
    }

    body.light-theme .contact-form-container:hover {
        border-color: #000000;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #ffffff;
    }

    body.light-theme .form-label {
        color: #000000;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #444;
        border-radius: 5px;
        font-size: 16px;
        background: #2a2a2a;
        color: #ffffff;
        transition: border-color 0.3s, box-shadow 0.3s;
        box-sizing: border-box;
    }

    body.light-theme .form-control {
        background: #f5f5f5;
        border-color: #ddd;
        color: #000000;
    }

    .form-control:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
    }

    body.light-theme .form-control:focus {
        background: #ffffff;
        border-color: #000000;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 150px;
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        background: #6366f1;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
    }

    .btn-submit:hover {
        background: #4f46e5;
        transform: translateY(-2px);
    }

    body.light-theme .btn-submit {
        background: #000000;
    }

    body.light-theme .btn-submit:hover {
        background: #333333;
    }

    .contact-info {
        text-align: center;
        margin-top: 30px;
        color: #999;
    }

    body.light-theme .contact-info {
        color: #666;
    }

    /* Client-side validation styles */
    .form-control.valid {
        border-color: #10b981 !important;
    }

    .form-control.invalid {
        border-color: #ef4444 !important;
    }

    body.light-theme .form-control.valid {
        border-color: #10b981 !important;
    }

    body.light-theme .form-control.invalid {
        border-color: #ef4444 !important;
    }

    .validation-message {
        font-size: 14px;
        margin-top: 5px;
        display: none;
    }

    .validation-message.error {
        color: #ff6b6b;
        display: block;
    }

    .validation-message.success {
        color: #10b981;
        display: block;
    }

    body.light-theme .validation-message.error {
        color: #c33;
    }

    body.light-theme .validation-message.success {
        color: #10b981;
    }

    .char-count {
        font-size: 13px;
        color: #999;
        text-align: right;
        margin-top: 5px;
    }

    body.light-theme .char-count {
        color: #666;
    }
</style>

<div class="contact-container">
    <div class="contact-header">
        <h1>📧 Contact</h1>
        <p>Heb je een vraag of opmerking? Laat het ons weten!</p>
    </div>

    <div class="contact-form-container">
        @if(session('success'))
            <div class="alert-success" style="background-color: #10b981; color: #ffffff; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error" style="background-color: #ef4444; color: #ffffff; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form method="POST" action="{{ route('contact.send') }}">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Naam *</label>
            <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
                placeholder="Jouw naam"
            >
            <span class="validation-message" id="name-validation"></span>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">E-mailadres *</label>
            <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                placeholder="naam@voorbeeld.nl"
            >
            <span class="validation-message" id="email-validation"></span>
        </div>

        <div class="form-group">
            <label for="subject" class="form-label">Onderwerp *</label>
            <input
                type="text"
                class="form-control"
                id="subject"
                name="subject"
                value="{{ old('subject') }}"
                required
                placeholder="Waar gaat je bericht over?"
            >
            <span class="validation-message" id="subject-validation"></span>
        </div>

        <div class="form-group">
            <label for="message" class="form-label">Bericht *</label>
            <textarea
                class="form-control"
                id="message"
                name="message"
                required
                placeholder="Typ hier je bericht..."
                maxlength="1000"
            >{{ old('message') }}</textarea>
            <div class="char-count" id="char-count">0 / 1000 tekens</div>
            <span class="validation-message" id="message-validation"></span>
        </div>

        <button type="submit" class="btn-submit">Verstuur bericht</button>
    </form>

    <div class="contact-info">
        <p>Of neem direct contact op via:<br>
        <strong>gameportaalproject@gmail.com</strong></p>
    </div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const subjectInput = document.getElementById('subject');
    const messageInput = document.getElementById('message');
    const charCount = document.getElementById('char-count');
    const form = document.querySelector('form');

    // Email validatie
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Update veld status
    function updateFieldStatus(input, isValid, message) {
        const validationMsg = document.getElementById(input.id + '-validation');

        input.classList.remove('valid', 'invalid');
        validationMsg.classList.remove('error', 'success');

        if (input.value.trim() === '') {
            validationMsg.textContent = '';
            return;
        }

        if (isValid) {
            input.classList.add('valid');
            validationMsg.textContent = '✓ ' + message;
            validationMsg.classList.add('success');
        } else {
            input.classList.add('invalid');
            validationMsg.textContent = '✗ ' + message;
            validationMsg.classList.add('error');
        }
    }

    // Update character count
    function updateCharCount() {
        const length = messageInput.value.length;
        charCount.textContent = length + ' / 1000 tekens';

        if (length > 950) {
            charCount.style.color = '#ef4444';
        } else if (length > 800) {
            charCount.style.color = '#f59e0b';
        } else {
            charCount.style.color = '#999';
        }
    }

    // Naam validatie
    nameInput.addEventListener('input', function() {
        const name = this.value.trim();

        if (name === '') {
            updateFieldStatus(this, false, '');
            return;
        }

        if (name.length < 2) {
            updateFieldStatus(this, false, 'Naam moet minimaal 2 tekens bevatten');
        } else {
            updateFieldStatus(this, true, 'Geldige naam');
        }
    });

    // Email validatie
    emailInput.addEventListener('input', function() {
        const email = this.value.trim();

        if (email === '') {
            updateFieldStatus(this, false, '');
            return;
        }

        if (!validateEmail(email)) {
            updateFieldStatus(this, false, 'Voer een geldig e-mailadres in');
        } else {
            updateFieldStatus(this, true, 'Geldig e-mailadres');
        }
    });

    // Subject validatie
    subjectInput.addEventListener('input', function() {
        const subject = this.value.trim();

        if (subject === '') {
            updateFieldStatus(this, false, '');
            return;
        }

        if (subject.length < 3) {
            updateFieldStatus(this, false, 'Onderwerp moet minimaal 3 tekens bevatten');
        } else {
            updateFieldStatus(this, true, 'Geldig onderwerp');
        }
    });

    // Message validatie
    messageInput.addEventListener('input', function() {
        const message = this.value.trim();
        updateCharCount();

        if (message === '') {
            updateFieldStatus(this, false, '');
            return;
        }

        if (message.length < 10) {
            updateFieldStatus(this, false, 'Bericht moet minimaal 10 tekens bevatten');
        } else {
            updateFieldStatus(this, true, 'Geldig bericht');
        }
    });

    // Initial char count
    updateCharCount();

    // Form submit validatie
    form.addEventListener('submit', function(e) {
        let isValid = true;

        // Valideer naam
        const name = nameInput.value.trim();
        if (name === '') {
            updateFieldStatus(nameInput, false, 'Naam is verplicht');
            isValid = false;
        } else if (name.length < 2) {
            updateFieldStatus(nameInput, false, 'Naam moet minimaal 2 tekens bevatten');
            isValid = false;
        }

        // Valideer email
        const email = emailInput.value.trim();
        if (email === '' || !validateEmail(email)) {
            updateFieldStatus(emailInput, false, email === '' ? 'E-mailadres is verplicht' : 'Voer een geldig e-mailadres in');
            isValid = false;
        }

        // Valideer subject
        const subject = subjectInput.value.trim();
        if (subject === '') {
            updateFieldStatus(subjectInput, false, 'Onderwerp is verplicht');
            isValid = false;
        } else if (subject.length < 3) {
            updateFieldStatus(subjectInput, false, 'Onderwerp moet minimaal 3 tekens bevatten');
            isValid = false;
        }

        // Valideer message
        const message = messageInput.value.trim();
        if (message === '') {
            updateFieldStatus(messageInput, false, 'Bericht is verplicht');
            isValid = false;
        } else if (message.length < 10) {
            updateFieldStatus(messageInput, false, 'Bericht moet minimaal 10 tekens bevatten');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});
</script>
@endsection
