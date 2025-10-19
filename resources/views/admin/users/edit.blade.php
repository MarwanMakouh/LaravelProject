@extends('layouts.app')

@section('title', 'Gebruiker Bewerken - Admin')

@section('content')
<style>
    .admin-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .admin-header h1 {
        color: #ffffff;
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 30px;
    }

    body.light-theme .admin-header h1 {
        color: #000000;
    }

    .form-card {
        background-color: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        padding: 30px;
    }

    body.light-theme .form-card {
        background-color: #ffffff;
        border-color: #ddd;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        color: #ffffff;
        font-weight: 600;
        margin-bottom: 8px;
    }

    body.light-theme .form-group label {
        color: #000000;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"],
    .form-group input[type="date"] {
        width: 100%;
        padding: 12px;
        background-color: #1a1a1a;
        border: 1px solid #444;
        border-radius: 5px;
        color: #ffffff;
        font-size: 16px;
    }

    body.light-theme .form-group input[type="text"],
    body.light-theme .form-group input[type="email"],
    body.light-theme .form-group input[type="password"],
    body.light-theme .form-group input[type="date"] {
        background-color: #ffffff;
        border-color: #ddd;
        color: #000000;
    }

    .form-group input:focus {
        outline: none;
        border-color: #6366f1;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .checkbox-group input[type="checkbox"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    .checkbox-group label {
        margin: 0;
        cursor: pointer;
    }

    .form-help {
        font-size: 14px;
        color: #999;
        margin-top: 5px;
    }

    body.light-theme .form-help {
        color: #666;
    }

    .error-message {
        color: #ef4444;
        font-size: 14px;
        margin-top: 5px;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }

    .btn-primary {
        background-color: #000000;
        color: #ffffff;
        border: 2px solid #000000;
        padding: 12px 24px;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #ffffff;
        color: #000000;
        border-color: #000000;
    }

    .btn-secondary {
        background-color: #2a2a2a;
        color: #ffffff;
        border: 2px solid #444;
        padding: 12px 24px;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #3a3a3a;
    }

    body.light-theme .btn-secondary {
        background-color: #f3f4f6;
        color: #000000;
        border-color: #ddd;
    }

    body.light-theme .btn-secondary:hover {
        background-color: #e5e7eb;
    }

    .info-badge {
        background-color: #3b82f6;
        color: #ffffff;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        margin-left: 10px;
    }

    body.light-theme .info-badge {
        background-color: #dbeafe;
        color: #1e40af;
    }
</style>

<div class="admin-container">
    <div class="admin-header">
        <h1>👥 Gebruiker Bewerken</h1>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">
                    Naam *
                    @if($user->id === auth()->id())
                        <span class="info-badge">Je profiel</span>
                    @endif
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}">
                <div class="form-help">Optioneel - Weergavenaam voor de gebruiker</div>
                @error('username')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="birthday">Geboortedatum</label>
                <input type="date" id="birthday" name="birthday" value="{{ old('birthday', $user->birthday ? $user->birthday->format('Y-m-d') : '') }}">
                @error('birthday')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Nieuw Wachtwoord</label>
                <input type="password" id="password" name="password">
                <div class="form-help">Laat leeg om het huidige wachtwoord te behouden. Minimaal 8 karakters.</div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Bevestig Nieuw Wachtwoord</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="form-group">
                <div class="checkbox-group">
                    <input type="checkbox" id="is_admin" name="is_admin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                    <label for="is_admin">Admin rechten geven</label>
                </div>
                <div class="form-help">Gebruiker heeft toegang tot admin functies</div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Wijzigingen Opslaan</button>
                <a href="{{ route('admin.users.index') }}" class="btn-secondary">Annuleren</a>
            </div>
        </form>
    </div>
</div>
@endsection
