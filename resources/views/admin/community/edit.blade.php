@extends('layouts.app')

@section('title', 'Community Post Bewerken - Admin')

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
    .form-group textarea {
        width: 100%;
        padding: 12px;
        background-color: #1a1a1a;
        border: 1px solid #444;
        border-radius: 5px;
        color: #ffffff;
        font-size: 16px;
        font-family: inherit;
    }

    body.light-theme .form-group input[type="text"],
    body.light-theme .form-group textarea {
        background-color: #ffffff;
        border-color: #ddd;
        color: #000000;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #6366f1;
    }

    .form-group textarea {
        min-height: 200px;
        resize: vertical;
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

    .info-box {
        background-color: #1a1a1a;
        border: 1px solid #444;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
    }

    body.light-theme .info-box {
        background-color: #f3f4f6;
        border-color: #ddd;
    }

    .info-box p {
        color: #cccccc;
        margin: 5px 0;
        font-size: 14px;
    }

    body.light-theme .info-box p {
        color: #333333;
    }

    .info-label {
        font-weight: 600;
        color: #ffffff;
    }

    body.light-theme .info-label {
        color: #000000;
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
</style>

<div class="admin-container">
    <div class="admin-header">
        <h1>💬 Community Post Bewerken</h1>
    </div>

    <div class="info-box">
        <p><span class="info-label">Auteur:</span> {{ $community->user ? $community->user->name : 'Onbekend' }}</p>
        <p><span class="info-label">Aangemaakt op:</span> {{ $community->created_at->format('d-m-Y H:i') }}</p>
        <p><span class="info-label">Aantal reacties:</span> {{ $community->comments->count() }}</p>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.community.update', $community->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titel *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $community->title) }}" required>
                @error('title')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Inhoud *</label>
                <textarea id="content" name="content" required>{{ old('content', $community->content) }}</textarea>
                @error('content')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Wijzigingen Opslaan</button>
                <a href="{{ route('admin.community.index') }}" class="btn-secondary">Annuleren</a>
            </div>
        </form>
    </div>
</div>
@endsection
