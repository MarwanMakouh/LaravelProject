@extends('layouts.app')

@section('title', 'Wachtwoord Vergeten - GamePortal')

@section('content')
<style>
    .forgot-container {
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
    }

    .forgot-card {
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        padding: 40px;
    }

    body.light-theme .forgot-card {
        background: #F9FAFB;
        border: 1px solid #000000;
    }

    .forgot-title {
        font-size: 28px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 10px;
    }

    body.light-theme .forgot-title {
        color: #000000;
    }

    .forgot-subtitle {
        color: #cccccc;
        margin-bottom: 30px;
    }

    body.light-theme .forgot-subtitle {
        color: #666666;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        color: #ffffff;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    body.light-theme .form-label {
        color: #000000;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #444;
        border-radius: 5px;
        background-color: #1a1a1a;
        color: #ffffff;
        font-size: 1rem;
    }

    .form-control:focus {
        outline: none;
        border-color: #6366f1;
    }

    body.light-theme .form-control {
        background-color: #ffffff;
        border-color: #ddd;
        color: #000000;
    }

    body.light-theme .form-control:focus {
        border-color: #000000;
    }

    .btn-submit {
        width: 100%;
        background-color: #6366f1;
        color: #ffffff;
        border: none;
        padding: 12px;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #4f46e5;
    }

    body.light-theme .btn-submit {
        background-color: #000000;
    }

    body.light-theme .btn-submit:hover {
        background-color: #333333;
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #6366f1;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    body.light-theme .back-link {
        color: #000000;
    }

    .alert-status {
        background-color: #10b981;
        color: #ffffff;
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    body.light-theme .alert-status {
        background-color: #d1fae5;
        color: #065f46;
    }

    .alert-error {
        background-color: #ef4444;
        color: #ffffff;
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    body.light-theme .alert-error {
        background-color: #fee2e2;
        color: #991b1b;
    }
</style>

<div class="forgot-container">
    <div class="forgot-card">
        <h1 class="forgot-title">Wachtwoord Vergeten?</h1>
        <p class="forgot-subtitle">Geen probleem. Vul je email adres in en we sturen je een wachtwoord reset link.</p>

        @if (session('status'))
            <div class="alert-status">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Adres</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="je@email.com"
                >
            </div>

            <button type="submit" class="btn-submit">
                📧 Verstuur Reset Link
            </button>
        </form>

        <a href="{{ route('login') }}" class="back-link">← Terug naar login</a>
    </div>
</div>
@endsection
