@extends('layouts.app')

@section('title', $user->name . ' - Profiel - GamePortal')

@section('content')
<style>
    .profile-container {
        max-width: 900px;
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

    .profile-card {
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 20px;
    }

    body.light-theme .profile-card {
        background: #F9FAFB;
        border: 1px solid #000000;
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 30px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #444;
    }

    body.light-theme .profile-header {
        border-bottom: 1px solid #ddd;
    }

    .profile-photo-container {
        flex-shrink: 0;
    }

    .profile-photo {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #6366f1;
    }

    body.light-theme .profile-photo {
        border-color: #000000;
    }

    .profile-info {
        flex: 1;
    }

    .profile-name {
        font-size: 32px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 10px;
    }

    body.light-theme .profile-name {
        color: #000000;
    }

    .profile-email {
        font-size: 16px;
        color: #999;
        margin-bottom: 15px;
    }

    body.light-theme .profile-email {
        color: #666;
    }

    .edit-profile-btn {
        display: inline-block;
        background-color: #6366f1;
        color: #ffffff;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 5px;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .edit-profile-btn:hover {
        background-color: #4f46e5;
    }

    body.light-theme .edit-profile-btn {
        background-color: #000000;
    }

    body.light-theme .edit-profile-btn:hover {
        background-color: #333333;
    }

    .about-section {
        margin-top: 20px;
    }

    .section-title {
        font-size: 24px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #444;
    }

    body.light-theme .section-title {
        color: #000000;
        border-bottom: 1px solid #ddd;
    }

    .about-text {
        color: #cccccc;
        line-height: 1.8;
        font-size: 16px;
        white-space: pre-wrap;
    }

    body.light-theme .about-text {
        color: #333333;
    }

    .no-about {
        color: #999;
        font-style: italic;
    }

    body.light-theme .no-about {
        color: #666;
    }

    .profile-stats {
        display: flex;
        gap: 30px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #444;
    }

    body.light-theme .profile-stats {
        border-top: 1px solid #ddd;
    }

    .stat-item {
        color: #999;
        font-size: 16px;
    }

    body.light-theme .stat-item {
        color: #666;
    }

    .stat-number {
        font-size: 24px;
        font-weight: bold;
        color: #6366f1;
        display: block;
    }

    body.light-theme .stat-number {
        color: #000000;
    }

    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .profile-photo {
            width: 120px;
            height: 120px;
        }

        .profile-name {
            font-size: 24px;
        }
    }
</style>

<div class="profile-container">
    <a href="{{ url()->previous() }}" class="back-button">← Terug</a>

    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-photo-container">
                @if($user->profile && $user->profile->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile->profile_photo) }}" alt="{{ $user->name }}" class="profile-photo">
                @else
                    <img src="{{ asset('images/default-avatar.png') }}" alt="{{ $user->name }}" class="profile-photo">
                @endif
            </div>

            <div class="profile-info">
                <h1 class="profile-name">{{ $user->name }}</h1>
                <p class="profile-email">{{ $user->email }}</p>

                @auth
                    @if(Auth::id() === $user->id)
                        <a href="{{ route('profile.edit') }}" class="edit-profile-btn">Profiel Bewerken</a>
                    @endif
                @endauth
            </div>
        </div>

        <div class="about-section">
            <h2 class="section-title">Over Mij</h2>

            @if($user->profile && $user->profile->about_me)
                <p class="about-text">{{ $user->profile->about_me }}</p>
            @else
                <p class="no-about">Deze gebruiker heeft nog geen 'over mij' toegevoegd.</p>
            @endif
        </div>

        <div class="profile-stats">
            <div class="stat-item">
                <span class="stat-number">{{ $user->created_at->format('Y') }}</span>
                Lid sinds
            </div>
        </div>
    </div>
</div>
@endsection
