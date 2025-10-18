@extends('layouts.app')

@section('title', 'Profiel Bewerken - GamePortal')

@section('content')
<style>
    .profile-edit-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .back-button {
        display: inline-block;
        color: #ffffff;
        text-decoration: none;
        padding: 10px 20px;
        background-color: #000000;
        border-radius: 5px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .back-button:hover {
        background-color: #ffffff;
        color: #000000;
        border: 1px solid #000000;
    }

    body.light-theme .back-button {
        background-color: #000000;
        color: #ffffff;
    }

    body.light-theme .back-button:hover {
        background-color: #ffffff;
        color: #000000;
    }

    .profile-edit-card {
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        padding: 30px;
    }

    body.light-theme .profile-edit-card {
        background: #F9FAFB;
        border: 1px solid #000000;
    }

    .profile-header {
        font-size: 28px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #444;
    }

    body.light-theme .profile-header {
        color: #000000;
        border-bottom: 1px solid #ddd;
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
    }

    .form-control:focus {
        outline: none;
        border-color: #6366f1;
        background-color: #333333;
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
        min-height: 120px;
    }

    .profile-photo-section {
        margin-bottom: 2rem;
    }

    .current-photo {
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .profile-photo-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #6366f1;
    }

    body.light-theme .profile-photo-img {
        border-color: #000000;
    }

    .photo-actions {
        display: flex;
        gap: 10px;
        margin-top: 1rem;
    }

    .btn-primary {
        background-color: #000000;
        color: #ffffff !important;
        border: 2px solid #000000;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #ffffff;
        color: #000000 !important;
        border-color: #000000;
    }

    .btn-danger {
        background-color: #dc2626;
        color: #ffffff !important;
        border: 2px solid #dc2626;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #ffffff;
        color: #dc2626 !important;
        border-color: #dc2626;
    }

    .alert-success {
        background-color: #10b981;
        color: #ffffff;
        padding: 1rem;
        border-radius: 5px;
        margin-bottom: 1rem;
    }

    body.light-theme .alert-success {
        background-color: #d1fae5;
        color: #065f46;
    }

    .alert-danger {
        background-color: #ef4444;
        color: #ffffff;
        padding: 1rem;
        border-radius: 5px;
        margin-bottom: 1rem;
    }

    body.light-theme .alert-danger {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .help-text {
        font-size: 0.875rem;
        color: #999;
        margin-top: 0.5rem;
    }

    body.light-theme .help-text {
        color: #666;
    }

    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .file-input-wrapper input[type=file] {
        position: absolute;
        left: -9999px;
    }

    .file-input-label {
        background-color: #6366f1;
        color: #ffffff;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .file-input-label:hover {
        background-color: #4f46e5;
    }

    body.light-theme .file-input-label {
        background-color: #000000;
    }

    body.light-theme .file-input-label:hover {
        background-color: #333333;
    }

    .file-name {
        margin-left: 10px;
        color: #ffffff;
    }

    body.light-theme .file-name {
        color: #000000;
    }
</style>

<div class="profile-edit-container">
    <a href="{{ route('profile.show', Auth::user()->id) }}" class="back-button">← Bekijk je profiel</a>

    <div class="profile-edit-card">
        <h1 class="profile-header">Profiel Bewerken</h1>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Profiel Foto Section -->
            <div class="profile-photo-section">
                <label class="form-label">Profiel Foto</label>

                <div class="current-photo">
                    @if($profile && $profile->profile_photo)
                        <img src="{{ asset('storage/' . $profile->profile_photo) }}" alt="Profiel foto" class="profile-photo-img">
                    @else
                        <img src="{{ asset('images/default-avatar.png') }}" alt="Standaard avatar" class="profile-photo-img">
                    @endif
                </div>

                <div class="file-input-wrapper">
                    <input type="file" name="profile_photo" id="profile_photo" accept="image/*">
                    <label for="profile_photo" class="file-input-label">Kies foto</label>
                    <span class="file-name" id="file-name"></span>
                </div>

                <p class="help-text">Max 2MB - JPG, PNG, GIF toegestaan</p>
            </div>

            <!-- Over Mij Section -->
            <div class="form-group">
                <label for="about_me" class="form-label">Over Mij</label>
                <textarea
                    id="about_me"
                    name="about_me"
                    class="form-control"
                    placeholder="Vertel iets over jezelf..."
                    maxlength="1000"
                >{{ old('about_me', $profile ? $profile->about_me : '') }}</textarea>
                <p class="help-text">Max 1000 karakters</p>
            </div>

            <!-- Account Info (Read Only) -->
            <div class="form-group">
                <label class="form-label">Gebruikersnaam</label>
                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" value="{{ $user->email }}" readonly>
            </div>

            <button type="submit" class="btn-primary">Profiel Opslaan</button>
        </form>

        @if($profile && $profile->profile_photo)
            <form action="{{ route('profile.photo.delete') }}" method="POST" style="margin-top: 20px;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger" onclick="return confirm('Weet je zeker dat je je profiel foto wilt verwijderen?')">
                    🗑️ Verwijder Profiel Foto
                </button>
            </form>
        @endif
    </div>
</div>

<script>
    // Toon geselecteerde bestandsnaam
    document.getElementById('profile_photo').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || '';
        document.getElementById('file-name').textContent = fileName;
    });
</script>
@endsection
