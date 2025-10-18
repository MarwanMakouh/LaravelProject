@extends('layouts.app')

@section('title', 'Inloggen - GamePortal')

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

    .form-check {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .form-check-input {
        margin-right: 8px;
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .form-check-label {
        color: #ffffff;
        cursor: pointer;
    }

    body.light-theme .form-check-label {
        color: #000000;
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
</style>

<div class="auth-wrapper">
    <div class="auth-container">
        <h1 class="auth-title">Inloggen</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Fout!</strong> Controleer je inloggegevens.
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">E-mailadres</label>
            <input
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                placeholder="naam@voorbeeld.nl"
            >
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
                placeholder="Voer je wachtwoord in"
            >
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-check">
            <input
                type="checkbox"
                class="form-check-input"
                id="remember"
                name="remember"
                {{ old('remember') ? 'checked' : '' }}
            >
            <label class="form-check-label" for="remember">
                Onthoud mij
            </label>
        </div>

        <button type="submit" class="btn-auth">Inloggen</button>
    </form>

    <div class="auth-links">
        <a href="{{ route('password.request') }}">Wachtwoord vergeten?</a>
    </div>

    <div class="auth-links">
        Nog geen account? <a href="{{ route('register') }}">Registreer hier</a>
    </div>
    </div>
</div>
@endsection
