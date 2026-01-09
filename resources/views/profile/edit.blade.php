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

            <!-- Username Section -->
            <div class="form-group">
                <label for="username" class="form-label">Gebruikersnaam</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-control"
                    value="{{ old('username', $user->username) }}"
                    placeholder="Kies een unieke gebruikersnaam"
                    maxlength="255"
                >
                <span class="validation-message" id="username-validation"></span>
                <p class="help-text">Dit is je unieke gebruikersnaam (optioneel)</p>
            </div>

            <!-- Birthday Section -->
            <div class="form-group">
                <label for="birthday" class="form-label">Geboortedatum</label>
                <input
                    type="date"
                    id="birthday"
                    name="birthday"
                    class="form-control"
                    value="{{ old('birthday', $user->birthday ? $user->birthday->format('Y-m-d') : '') }}"
                    max="{{ date('Y-m-d') }}"
                >
                <p class="help-text">Je geboortedatum (optioneel)</p>
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
                <div class="char-count" id="about-char-count">0 / 1000 tekens</div>
                <span class="validation-message" id="about_me-validation"></span>
            </div>

            <!-- Account Info (Read Only) -->
            <div class="form-group">
                <label class="form-label">Naam</label>
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
document.addEventListener('DOMContentLoaded', function() {
    const profilePhotoInput = document.getElementById('profile_photo');
    const usernameInput = document.getElementById('username');
    const aboutMeInput = document.getElementById('about_me');
    const aboutCharCount = document.getElementById('about-char-count');
    const form = document.querySelector('form');

    // Toon geselecteerde bestandsnaam
    profilePhotoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const fileName = file?.name || '';
        document.getElementById('file-name').textContent = fileName;

        // Valideer bestandsgrootte (max 2MB)
        if (file) {
            const maxSize = 2 * 1024 * 1024; // 2MB
            if (file.size > maxSize) {
                alert('Bestand is te groot! Maximum bestandsgrootte is 2MB.');
                profilePhotoInput.value = '';
                document.getElementById('file-name').textContent = '';
            }

            // Valideer bestandstype
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                alert('Ongeldig bestandstype! Alleen JPG, PNG en GIF zijn toegestaan.');
                profilePhotoInput.value = '';
                document.getElementById('file-name').textContent = '';
            }
        }
    });

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
        const length = aboutMeInput.value.length;
        aboutCharCount.textContent = length + ' / 1000 tekens';

        const percentage = (length / 1000) * 100;
        if (percentage > 95) {
            aboutCharCount.style.color = '#ef4444';
        } else if (percentage > 80) {
            aboutCharCount.style.color = '#f59e0b';
        } else {
            aboutCharCount.style.color = '#999';
        }
    }

    // Username validatie (optioneel veld)
    usernameInput.addEventListener('input', function() {
        const username = this.value.trim();

        if (username === '') {
            updateFieldStatus(this, false, '');
            return;
        }

        if (username.length < 3) {
            updateFieldStatus(this, false, 'Gebruikersnaam moet minimaal 3 tekens bevatten');
        } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
            updateFieldStatus(this, false, 'Alleen letters, cijfers en underscores toegestaan');
        } else {
            updateFieldStatus(this, true, 'Geldige gebruikersnaam');
        }
    });

    // About me validatie met character counter
    aboutMeInput.addEventListener('input', function() {
        updateCharCount();

        const aboutMe = this.value.trim();
        if (aboutMe !== '' && aboutMe.length > 1000) {
            updateFieldStatus(this, false, 'Maximaal 1000 tekens toegestaan');
        } else if (aboutMe !== '') {
            updateFieldStatus(this, true, 'Geldige beschrijving');
        }
    });

    // Initial char count
    updateCharCount();

    // Form submit validatie
    form.addEventListener('submit', function(e) {
        let isValid = true;

        // Valideer username (alleen als ingevuld)
        const username = usernameInput.value.trim();
        if (username !== '') {
            if (username.length < 3) {
                updateFieldStatus(usernameInput, false, 'Gebruikersnaam moet minimaal 3 tekens bevatten');
                isValid = false;
            } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
                updateFieldStatus(usernameInput, false, 'Alleen letters, cijfers en underscores toegestaan');
                isValid = false;
            }
        }

        // Valideer about me (alleen als ingevuld)
        const aboutMe = aboutMeInput.value.trim();
        if (aboutMe.length > 1000) {
            updateFieldStatus(aboutMeInput, false, 'Maximaal 1000 tekens toegestaan');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});
</script>
@endsection
