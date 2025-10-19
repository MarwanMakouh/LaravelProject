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

    /* Favorite Games styling */
    .favorite-games-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .game-card {
        background-color: #333333;
        border: 1px solid #444;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .game-card:hover {
        transform: translateY(-5px);
        border-color: #6366f1;
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.2);
    }

    body.light-theme .game-card {
        background-color: #ffffff;
        border-color: #ddd;
    }

    body.light-theme .game-card:hover {
        border-color: #000000;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .game-card-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .game-card-content {
        padding: 15px;
        background-color: #2a2a2a;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    body.light-theme .game-card-content {
        background-color: #f9f9f9;
    }

    .game-card-name {
        font-weight: 600;
        font-size: 16px;
        color: #ffffff;
        margin-bottom: 8px;
        line-height: 1.4;
    }

    body.light-theme .game-card-name {
        color: #000000;
    }

    .game-card-rating {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 14px;
        color: #fbbf24;
        font-weight: 600;
    }

    body.light-theme .game-card-rating {
        color: #f59e0b;
    }

    .no-favorites {
        text-align: center;
        padding: 40px 20px;
        color: #999;
        font-style: italic;
    }

    body.light-theme .no-favorites {
        color: #666;
    }

    @media (max-width: 768px) {
        .favorite-games-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
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
                @if($user->username)
                    <p class="profile-email">{{ '@' . $user->username }}</p>
                @endif
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
            @if($user->birthday)
                <div class="stat-item">
                    <span class="stat-number">{{ $user->birthday->format('d-m-Y') }}</span>
                    Geboortedatum
                </div>
            @endif
            <div class="stat-item">
                <span class="stat-number">{{ $favoriteGames->count() }}</span>
                Favoriete Games
            </div>
        </div>
    </div>

    <!-- Favoriete Games Sectie -->
    <div class="profile-card">
        <h2 class="section-title">⭐ Favoriete Games</h2>

        @if($favoriteGames->count() > 0)
            <div class="favorite-games-grid">
                @foreach($favoriteGames as $game)
                    <a href="{{ route('games.show', $game->slug) }}" class="game-card">
                        @if($game->background_image)
                            <img src="{{ $game->background_image }}" alt="{{ $game->name }}" class="game-card-image" loading="lazy">
                        @else
                            <div class="game-card-image" style="background-color: #1a1a1a; display: flex; align-items: center; justify-content: center; color: #666;">
                                🎮
                            </div>
                        @endif
                        <div class="game-card-content">
                            <div class="game-card-name">{{ $game->name }}</div>
                            @if($game->rating)
                                <div class="game-card-rating">
                                    ⭐ {{ number_format($game->rating, 1) }}/5
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="no-favorites">
                @if(Auth::check() && Auth::id() === $user->id)
                    Je hebt nog geen favoriete games toegevoegd. Bekijk games en klik op het hart icoon om ze toe te voegen!
                @else
                    Deze gebruiker heeft nog geen favoriete games toegevoegd.
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
