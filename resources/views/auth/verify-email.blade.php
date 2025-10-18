@extends('layouts.app')

@section('title', 'Email Verificatie - GamePortal')

@section('content')
<style>
    .verify-container {
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
    }

    .verify-card {
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        padding: 40px;
        text-align: center;
    }

    body.light-theme .verify-card {
        background: #F9FAFB;
        border: 1px solid #000000;
    }

    .verify-icon {
        font-size: 64px;
        margin-bottom: 20px;
    }

    .verify-title {
        font-size: 24px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 20px;
    }

    body.light-theme .verify-title {
        color: #000000;
    }

    .verify-text {
        color: #cccccc;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    body.light-theme .verify-text {
        color: #666666;
    }

    .btn-resend {
        background-color: #6366f1;
        color: #ffffff;
        border: none;
        padding: 12px 30px;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-resend:hover {
        background-color: #4f46e5;
        color: #ffffff;
    }

    body.light-theme .btn-resend {
        background-color: #000000;
    }

    body.light-theme .btn-resend:hover {
        background-color: #333333;
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
</style>

<div class="verify-container">
    <div class="verify-card">
        <div class="verify-icon">📧</div>
        <h1 class="verify-title">Verifieer je Email</h1>

        @if (session('status'))
            <div class="alert-status">
                {{ session('status') }}
            </div>
        @endif

        <p class="verify-text">
            Bedankt voor je registratie! Voordat je begint, kun je je email adres verifiëren door op de link te klikken die we je zojuist hebben gemaild?
        </p>

        <p class="verify-text">
            Als je geen email hebt ontvangen, sturen we je graag een nieuwe.
        </p>

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn-resend">
                🔄 Verstuur Opnieuw
            </button>
        </form>
    </div>
</div>
@endsection
