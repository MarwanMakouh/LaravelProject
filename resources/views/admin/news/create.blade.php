@extends('layouts.app')

@section('title', 'Nieuw Artikel - Admin - GamePortal')

@section('content')
<style>
    .create-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .create-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .create-header h1 {
        font-size: 32px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 10px;
    }

    body.light-theme .create-header h1 {
        color: #000000;
    }

    .create-header p {
        color: #cccccc;
    }

    body.light-theme .create-header p {
        color: #666666;
    }

    .create-form {
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        padding: 30px;
    }

    body.light-theme .create-form {
        background: #F9FAFB;
        border: 1px solid #000000;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        color: #ffffff;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    body.light-theme .form-label {
        color: #000000;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #444;
        border-radius: 5px;
        background-color: #1a1a1a;
        color: #ffffff;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #6366f1;
        background-color: #2a2a2a;
    }

    body.light-theme .form-control {
        background-color: #ffffff;
        border-color: #ddd;
        color: #000000;
    }

    body.light-theme .form-control:focus {
        border-color: #000000;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 300px;
    }

    .form-help {
        font-size: 0.875rem;
        color: #888;
        margin-top: 0.25rem;
    }

    body.light-theme .form-help {
        color: #6b7280;
    }

    .btn-primary {
        background-color: #000000;
        color: #ffffff !important;
        border: 2px solid #000000;
        padding: 0.75rem 2rem;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .btn-primary:hover {
        background-color: #ffffff;
        color: #000000 !important;
        border-color: #000000;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background-color: transparent;
        color: #ffffff;
        border: 2px solid #444;
        padding: 0.75rem 2rem;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin-right: 1rem;
    }

    .btn-secondary:hover {
        border-color: #ffffff;
        text-decoration: none;
    }

    body.light-theme .btn-secondary {
        color: #000000;
        border-color: #ddd;
    }

    body.light-theme .btn-secondary:hover {
        border-color: #000000;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    small.error {
        color: #ef4444;
        display: block;
        margin-top: 0.25rem;
    }
</style>

<div class="create-container">
    <div class="create-header">
        <h1>📝 Nieuw Nieuwsartikel</h1>
        <p>Maak een nieuw artikel aan voor GamePortal</p>
    </div>

    <form action="{{ route('admin.news.store') }}" method="POST" class="create-form">
        @csrf

        <div class="form-group">
            <label for="title" class="form-label">Titel *</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                placeholder="Geef je artikel een pakkende titel..."
                required
                maxlength="255"
                value="{{ old('title') }}"
            >
            @error('title')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="content" class="form-label">Inhoud *</label>
            <textarea
                id="content"
                name="content"
                class="form-control"
                placeholder="Schrijf hier je artikel..."
                required
            >{{ old('content') }}</textarea>
            @error('content')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="image_url" class="form-label">Afbeelding URL</label>
            <input
                type="url"
                id="image_url"
                name="image_url"
                class="form-control"
                placeholder="https://example.com/image.jpg"
                maxlength="500"
                value="{{ old('image_url') }}"
            >
            <small class="form-help">Optioneel: Voeg een URL toe van een afbeelding voor je artikel</small>
            @error('image_url')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="published_at" class="form-label">Publicatiedatum</label>
            <input
                type="datetime-local"
                id="published_at"
                name="published_at"
                class="form-control"
                value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
            >
            <small class="form-help">Laat leeg om het artikel als concept op te slaan</small>
            @error('published_at')
                <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Artikel Publiceren</button>
            <a href="{{ route('admin.news.index') }}" class="btn-secondary">Annuleren</a>
        </div>
    </form>
</div>
@endsection
