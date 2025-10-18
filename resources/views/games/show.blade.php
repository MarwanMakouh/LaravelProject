@extends('layouts.app')
@section('title', 'Game Detail')

@section('content')
<style>
    /* Game detail page styling */
    .game-detail-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .game-header {
        margin-bottom: 2rem;
        margin-top: 2rem;
    }

    .game-banner {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }

    .game-title {
        color: #ffffff;
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    body.light-theme .game-title {
        color: #000000;
    }

    /* Info Grid */
    .game-info-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-card {
        background-color: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        padding: 1.5rem;
        text-align: center;
    }

    .info-card h3 {
        color: #ffffff;
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .big-text {
        color: #ffffff;
        font-size: 2rem;
        font-weight: bold;
        margin: 0.5rem 0;
    }

    .info-card small {
        color: #cccccc;
        font-size: 0.85rem;
    }

    body.light-theme .big-text {
        color: #6366f1;
    }

    body.light-theme .info-card {
        background-color: #f9f9f9;
        border-color: #ddd;
    }

    body.light-theme .info-card h3 {
        color: #000000;
    }

    body.light-theme .info-card small {
        color: #666;
    }

    /* Game Sections */
    .game-section {
        margin-bottom: 2rem;
    }

    .game-section h3 {
        color: #ffffff;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .game-section p {
        color: #cccccc;
        line-height: 1.8;
        font-size: 1.05rem;
    }

    .game-description {
        white-space: pre-line;
    }

    body.light-theme .game-section h3 {
        color: #000000;
    }

    body.light-theme .game-section p {
        color: #333333;
    }

    /* Tags */
    .tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .tag {
        background-color: #333333;
        color: #ffffff;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        border: 1px solid #444;
    }

    body.light-theme .tag {
        background-color: #e5e5e5;
        color: #000000;
        border-color: #ccc;
    }

    /* Info Row */
    .game-info-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .game-detail-container h4 {
        color: #ffffff;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .game-detail-container hr {
        border-color: #444;
        margin: 2rem 0;
    }

    body.light-theme .game-detail-container h4 {
        color: #000000;
    }

    body.light-theme .game-detail-container hr {
        border-color: #ddd;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .game-info-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .game-info-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .game-title {
            font-size: 2rem;
        }

        .game-info-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Form styling */
    .comment-form {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
        max-width: 800px;
        margin-bottom: 2rem;
    }

    .form-control {
        background-color: #2a2a2a;
        border: 1px solid #444;
        color: #ffffff;
        padding: 0.75rem;
        border-radius: 5px;
        flex: 1;
        resize: vertical;
        max-width: 600px;
    }

    .form-control:focus {
        background-color: #333333;
        border-color: #6c63ff;
        color: #ffffff;
        outline: none;
    }

    .form-control::placeholder {
        color: #888;
    }

    body.light-theme .form-control {
        background-color: #ffffff;
        border: 1px solid #ddd;
        color: #000000;
    }

    body.light-theme .form-control:focus {
        background-color: #ffffff;
        border-color: #000000;
    }

    body.light-theme .form-control::placeholder {
        color: #666;
    }

    @media (max-width: 768px) {
        .comment-form {
            flex-direction: column;
        }

        .btn-primary {
            width: 100%;
        }
    }

    /* Card styling for comments */
    .card {
        background-color: #2a2a2a;
        border: 1px solid #444;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    .card-body {
        padding: 1.25rem;
    }

    .card-body strong {
        color: #6366f1;
        font-size: 1.1rem;
    }

    .card-body a {
        color: #6366f1;
        font-size: 1.1rem;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .card-body a:hover {
        color: #4f46e5;
        text-decoration: underline;
    }

    body.light-theme .card-body a {
        color: #000000;
    }

    body.light-theme .card-body a:hover {
        color: #333333;
    }

    .card-body p {
        color: #ffffff;
        margin: 0.5rem 0;
    }

    .card-body small {
        color: #999;
    }

    body.light-theme .card {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
    }

    body.light-theme .card-body strong {
        color: #000000;
    }

    body.light-theme .card-body p {
        color: #333333;
    }

    body.light-theme .card-body small {
        color: #666;
    }

    /* Button styling */
    .btn-primary {
        background-color: #000000;
        border: 2px solid #000000;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        color: #ffffff !important;
        display: inline-block;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #ffffff;
        color: #000000 !important;
        border-color: #000000;
        transform: translateY(-2px);
        text-decoration: none;
    }

    /* Optimize rendering with CSS containment */
    .game-detail-container {
        contain: layout style paint;
    }

    .card {
        contain: layout style paint;
    }
</style>

<div class="game-detail-container">
    <!-- Game Header -->
    <div class="game-header">
        <img src="{{ $game['background_image'] }}"
             alt="{{ $game['name'] }}"
             class="game-banner"
             loading="eager"
             fetchpriority="high">
        <h1 class="game-title">{{ $game['name'] }}</h1>
    </div>

    <!-- Game Info Grid -->
    <div class="game-info-grid">
        <div class="info-card">
            <h3>⭐ Rating</h3>
            <p class="big-text">{{ $game['rating'] }}/5</p>
            <small>{{ number_format($game['rating_count']) }} reviews</small>
        </div>

        <div class="info-card">
            <h3>📅 Release Datum</h3>
            <p class="big-text">{{ $game['released'] }}</p>
        </div>

        <div class="info-card">
            <h3>🏆 Metacritic</h3>
            <p class="big-text">{{ $game['metacritic'] }}</p>
        </div>

        <div class="info-card">
            <h3>⏱️ Speeltijd</h3>
            <p class="big-text">{{ $game['playtime'] }} uur</p>
        </div>
    </div>

    <!-- Description -->
    <div class="game-section">
        <h3>📖 Beschrijving</h3>
        <p class="game-description">{{ $game['description'] }}</p>
    </div>

    <!-- Genres -->
    @if(!empty($game['genres']))
    <div class="game-section">
        <h3>🎮 Genres</h3>
        <div class="tags">
            @foreach($game['genres'] as $genre)
                <span class="tag">{{ $genre }}</span>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Platforms -->
    @if(!empty($game['platforms']))
    <div class="game-section">
        <h3>💻 Platforms</h3>
        <div class="tags">
            @foreach($game['platforms'] as $platform)
                <span class="tag">{{ $platform }}</span>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Developers & Publishers -->
    <div class="game-info-row">
        @if(!empty($game['developers']))
        <div class="game-section">
            <h3>👨‍💻 Ontwikkelaars</h3>
            <p>{{ implode(', ', $game['developers']) }}</p>
        </div>
        @endif

        @if(!empty($game['publishers']))
        <div class="game-section">
            <h3>🏢 Uitgevers</h3>
            <p>{{ implode(', ', $game['publishers']) }}</p>
        </div>
        @endif
    </div>

    <!-- Website Link -->
    @if($game['website'])
    <div class="game-section">
        <a href="{{ $game['website'] }}" target="_blank" class="btn btn-primary">🌐 Bezoek Website</a>
    </div>
    @endif

    <hr>
    <h4>💬 Reacties ({{ count($comments) }})</h4>

    @if(session('success'))
        <div style="background-color: #10b981; color: #ffffff; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Comment Form -->
    @auth
        <form action="{{ route('games.comment.store', $game['slug']) }}" method="POST" style="margin-bottom: 2rem;">
            @csrf
            <input type="hidden" name="game_name" value="{{ $game['name'] }}">
            <div style="margin-bottom: 1rem;">
                <label style="color: #ffffff; font-weight: 600; margin-bottom: 0.5rem; display: block;">
                    Reageren als: <strong>{{ Auth::user()->name }}</strong>
                </label>
            </div>
            <div class="comment-form">
                <textarea name="content" class="form-control" rows="4" placeholder="Typ je reactie..." required maxlength="1000">{{ old('content') }}</textarea>
                <button type="submit" class="btn btn-primary">Plaats reactie</button>
            </div>
            @error('content')
                <small style="color: #ef4444; display: block; margin-top: 0.5rem;">{{ $message }}</small>
            @enderror
        </form>
    @else
        <form action="{{ route('games.comment.store', $game['slug']) }}" method="POST" style="margin-bottom: 2rem;">
            @csrf
            <input type="hidden" name="game_name" value="{{ $game['name'] }}">
            <div style="margin-bottom: 1rem;">
                <label for="author" style="color: #ffffff; font-weight: 600; margin-bottom: 0.5rem; display: block;">Naam</label>
                <input type="text" id="author" name="author" class="form-control" placeholder="Je naam..." required maxlength="255" value="{{ old('author') }}" style="max-width: 800px; margin-bottom: 1rem;">
                @error('author')
                    <small style="color: #ef4444; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                @enderror
            </div>
            <div class="comment-form">
                <textarea name="content" class="form-control" rows="4" placeholder="Typ je reactie..." required maxlength="1000">{{ old('content') }}</textarea>
                <button type="submit" class="btn btn-primary">Plaats reactie</button>
            </div>
            @error('content')
                <small style="color: #ef4444; display: block; margin-top: 0.5rem;">{{ $message }}</small>
            @enderror
        </form>
        <p style="color: #999; margin-top: 1rem; font-size: 0.9rem; margin-bottom: 2rem;">
            💡 Tip: <a href="{{ route('login') }}" style="color: #6366f1;">Log in</a> om automatisch je accountnaam te gebruiken!
        </p>
    @endauth

    <!-- Comments List -->
    @if(count($comments) > 0)
        @foreach($comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    @if($comment['user_id'])
                        <a href="{{ route('profile.show', $comment['user_id']) }}">👤 {{ $comment['author'] }}</a>
                    @else
                        <strong>👤 {{ $comment['author'] }}</strong>
                    @endif
                    <p>{{ $comment['content'] }}</p>
                    <small class="text-muted">{{ $comment['created_at'] }}</small>
                </div>
            </div>
        @endforeach
    @else
        <div style="text-align: center; color: #999; padding: 2rem; font-style: italic;">
            Nog geen reacties. Wees de eerste om te reageren!
        </div>
    @endif
</div>
@endsection
