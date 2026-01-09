@extends('layouts.app')

@section('title', 'Registreren - GamePortal')

@section('content')
<style>
    .auth-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
        box-sizing: border-box;
    }

    @media (max-width: 500px) {
        .auth-wrapper {
            padding: 0 1rem;
        }
    }

    .auth-container {
        max-width: 450px;
        margin: 50px auto;
        padding: 30px;
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    body.light-theme .auth-container {
        background: #F9FAFB;
        border: 1px solid #000000;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .auth-container:hover {
        transform: translateY(-10px);
        border-color: #ffffff;
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
    }

    body.light-theme .auth-container:hover {
        border-color: #000000;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .auth-title {
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 30px;
        color: #ffffff;
    }

    body.light-theme .auth-title {
        color: #000000;
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

    .btn-auth {
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

    .btn-auth:hover {
        background: #4f46e5;
        transform: translateY(-2px);
    }

    body.light-theme .btn-auth {
        background: #000000;
    }

    body.light-theme .btn-auth:hover {
        background: #333333;
    }

    .auth-links {
        text-align: center;
        margin-top: 20px;
        color: #ffffff;
    }

    body.light-theme .auth-links {
        color: #666666;
    }

    .auth-links a {
        color: #6366f1;
        text-decoration: none;
        font-weight: 500;
    }

    .auth-links a:hover {
        text-decoration: underline;
    }

    body.light-theme .auth-links a {
        color: #000000;
    }

    .alert {
        padding: 12px 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background: #fee;
        color: #c33;
        border: 1px solid #fcc;
    }

    body.light-theme .alert-danger {
        background: #fee;
        color: #c33;
        border: 1px solid #fcc;
    }

    .invalid-feedback {
        color: #ff6b6b;
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }

    body.light-theme .invalid-feedback {
        color: #c33;
    }

    .password-requirements {
        font-size: 13px;
        color: #999;
        margin-top: 5px;
    }

    body.light-theme .password-requirements {
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

    /* Password strength indicator */
    .password-strength {
        height: 5px;
        border-radius: 3px;
        margin-top: 8px;
        background: #444;
        overflow: hidden;
    }

    body.light-theme .password-strength {
        background: #e5e5e5;
    }

    .password-strength-bar {
        height: 100%;
        transition: width 0.3s ease, background-color 0.3s ease;
        width: 0%;
    }

    .password-strength-bar.weak {
        width: 33%;
        background: #ef4444;
    }

    .password-strength-bar.medium {
        width: 66%;
        background: #f59e0b;
    }

    .password-strength-bar.strong {
        width: 100%;
        background: #10b981;
    }

    .password-strength-text {
        font-size: 13px;
        margin-top: 5px;
        color: #999;
    }

    body.light-theme .password-strength-text {
        color: #666;
    }
</style>

<div class="auth-wrapper">
    <div class="auth-container">
        <h1 class="auth-title">Registreren</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Fout!</strong> Controleer de volgende velden:
            <ul style="margin: 10px 0 0 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">Naam</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                placeholder="Jouw naam"
            >
            <span class="validation-message" id="name-validation"></span>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">E-mailadres</label>
            <input
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                placeholder="naam@voorbeeld.nl"
            >
            <span class="validation-message" id="email-validation"></span>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Wachtwoord</label>
            <input
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                id="password"
                name="password"
                required
                placeholder="Minimaal 8 tekens"
            >
            <div class="password-strength">
                <div class="password-strength-bar" id="password-strength-bar"></div>
            </div>
            <div class="password-strength-text" id="password-strength-text"></div>
            <span class="validation-message" id="password-validation"></span>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Bevestig wachtwoord</label>
            <input
                type="password"
                class="form-control"
                id="password_confirmation"
                name="password_confirmation"
                required
                placeholder="Herhaal je wachtwoord"
            >
            <span class="validation-message" id="password_confirmation-validation"></span>
        </div>

        <button type="submit" class="btn-auth">Registreren</button>
    </form>

    <div class="auth-links">
        Heb je al een account? <a href="{{ route('login') }}">Log hier in</a>
    </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');
    const form = document.querySelector('form');
    const passwordStrengthBar = document.getElementById('password-strength-bar');
    const passwordStrengthText = document.getElementById('password-strength-text');

    // Email validatie
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Password sterkte berekenen
    function calculatePasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^a-zA-Z0-9]/.test(password)) strength++;

        return strength;
    }

    // Update password strength indicator
    function updatePasswordStrength(password) {
        if (password === '') {
            passwordStrengthBar.className = 'password-strength-bar';
            passwordStrengthText.textContent = '';
            return;
        }

        const strength = calculatePasswordStrength(password);

        passwordStrengthBar.classList.remove('weak', 'medium', 'strong');

        if (strength <= 2) {
            passwordStrengthBar.classList.add('weak');
            passwordStrengthText.textContent = 'Zwak wachtwoord';
            passwordStrengthText.style.color = '#ef4444';
        } else if (strength <= 3) {
            passwordStrengthBar.classList.add('medium');
            passwordStrengthText.textContent = 'Gemiddeld wachtwoord';
            passwordStrengthText.style.color = '#f59e0b';
        } else {
            passwordStrengthBar.classList.add('strong');
            passwordStrengthText.textContent = 'Sterk wachtwoord';
            passwordStrengthText.style.color = '#10b981';
        }
    }

    // Update veld status
    function updateFieldStatus(input, isValid, message) {
        const validationMsg = document.getElementById(input.id + '-validation');

        input.classList.remove('valid', 'invalid');
        validationMsg.classList.remove('error', 'success');

        if (input.value.trim() === '' && input.id !== 'password_confirmation') {
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

    // Password validatie met strength indicator
    passwordInput.addEventListener('input', function() {
        const password = this.value;

        updatePasswordStrength(password);

        if (password === '') {
            updateFieldStatus(this, false, '');
            return;
        }

        if (password.length < 8) {
            updateFieldStatus(this, false, 'Wachtwoord moet minimaal 8 tekens bevatten');
        } else {
            updateFieldStatus(this, true, 'Wachtwoord voldoet aan minimale lengte');
        }

        // Check ook password confirmation als die al is ingevuld
        if (passwordConfirmInput.value !== '') {
            validatePasswordConfirmation();
        }
    });

    // Password confirmation validatie
    function validatePasswordConfirmation() {
        const password = passwordInput.value;
        const passwordConfirm = passwordConfirmInput.value;

        if (passwordConfirm === '') {
            updateFieldStatus(passwordConfirmInput, false, '');
            return;
        }

        if (password !== passwordConfirm) {
            updateFieldStatus(passwordConfirmInput, false, 'Wachtwoorden komen niet overeen');
        } else {
            updateFieldStatus(passwordConfirmInput, true, 'Wachtwoorden komen overeen');
        }
    }

    passwordConfirmInput.addEventListener('input', validatePasswordConfirmation);

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

        // Valideer password
        const password = passwordInput.value;
        if (password === '') {
            updateFieldStatus(passwordInput, false, 'Wachtwoord is verplicht');
            isValid = false;
        } else if (password.length < 8) {
            updateFieldStatus(passwordInput, false, 'Wachtwoord moet minimaal 8 tekens bevatten');
            isValid = false;
        }

        // Valideer password confirmation
        const passwordConfirm = passwordConfirmInput.value;
        if (passwordConfirm === '') {
            updateFieldStatus(passwordConfirmInput, false, 'Wachtwoord bevestiging is verplicht');
            isValid = false;
        } else if (password !== passwordConfirm) {
            updateFieldStatus(passwordConfirmInput, false, 'Wachtwoorden komen niet overeen');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});
</script>
@endsection
