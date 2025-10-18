@extends('layouts.app')

@section('title', 'Wachtwoord Resetten - GamePortal')

@section('content')
<style>
    .reset-container {
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
    }

    .reset-card {
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        padding: 40px;
    }

    body.light-theme .reset-card {
        background: #F9FAFB;
        border: 1px solid #000000;
    }

    .reset-title {
        font-size: 28px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 30px;
    }

    body.light-theme .reset-title {
        color: #000000;
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

<div class="reset-container">
    <div class="reset-card">
        <h1 class="reset-title">Reset je Wachtwoord</h1>

        @if ($errors->any())
            <div class="alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email" class="form-label">Email Adres</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $email) }}"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Nieuw Wachtwoord</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    required
                    placeholder="Minimaal 8 karakters"
                >
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Bevestig Wachtwoord</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-control"
                    required
                    placeholder="Herhaal je wachtwoord"
                >
            </div>

            <button type="submit" class="btn-submit">
                🔒 Reset Wachtwoord
            </button>
        </form>
    </div>
</div>
@endsection
