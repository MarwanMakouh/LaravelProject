@extends('layouts.app')

@section('title', $post['title'] . ' - GamePortal')

@section('content')
<style>
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

    .post-detail-card {
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 30px;
    }

    body.light-theme .post-detail-card {
        background: #F9FAFB;
        border: 1px solid #000000;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .post-detail-header {
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #444;
    }

    body.light-theme .post-detail-header {
        border-bottom: 1px solid #ddd;
    }

    .post-detail-title {
        font-size: 32px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 15px;
    }

    body.light-theme .post-detail-title {
        color: #000000;
    }

    .post-meta {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .post-author {
        font-weight: bold;
        font-size: 18px;
        color: #6366f1;
    }

    body.light-theme .post-author {
        color: #000000;
    }

    .post-date {
        font-size: 14px;
        color: #999;
    }

    body.light-theme .post-date {
        color: #666;
    }

    .post-detail-content {
        font-size: 18px;
        line-height: 1.8;
        color: #ffffff;
        margin-bottom: 20px;
    }

    body.light-theme .post-detail-content {
        color: #333333;
    }

    .post-stats {
        display: flex;
        gap: 30px;
        padding-top: 20px;
        border-top: 1px solid #444;
    }

    body.light-theme .post-stats {
        border-top: 1px solid #ddd;
    }

    .stat-item {
        color: #999;
        font-size: 16px;
    }

    body.light-theme .stat-item {
        color: #666;
    }

    .comments-section {
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        padding: 30px;
    }

    body.light-theme .comments-section {
        background: #F9FAFB;
        border: 1px solid #000000;
    }

    .comments-header {
        font-size: 24px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #444;
    }

    body.light-theme .comments-header {
        color: #000000;
        border-bottom: 1px solid #ddd;
    }

    .comment-card {
        background: #1a1a1a;
        border: 1px solid #333;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    body.light-theme .comment-card {
        background: #ffffff;
        border: 1px solid #ddd;
    }

    .comment-card:hover {
        border-color: #6366f1;
        transform: translateX(5px);
    }

    body.light-theme .comment-card:hover {
        border-color: #000000;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .comment-author {
        font-weight: bold;
        color: #6366f1;
    }

    body.light-theme .comment-author {
        color: #000000;
    }

    .comment-date {
        font-size: 12px;
        color: #999;
    }

    body.light-theme .comment-date {
        color: #666;
    }

    .comment-content {
        color: #cccccc;
        line-height: 1.6;
    }

    body.light-theme .comment-content {
        color: #333333;
    }

    .no-comments {
        text-align: center;
        color: #999;
        padding: 40px;
        font-style: italic;
    }

    body.light-theme .no-comments {
        color: #666;
    }

    /* Comment form styling */
    .comment-form {
        background: #1a1a1a;
        border: 1px solid #333;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }

    body.light-theme .comment-form {
        background: #ffffff;
        border: 1px solid #ddd;
    }

    .form-group {
        margin-bottom: 1rem;
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
        background-color: #2a2a2a;
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
</style>

<a href="{{ route('community.index') }}" class="back-button">← Terug naar Community</a>

<div class="post-detail-card">
    <div class="post-detail-header">
        <h1 class="post-detail-title">{{ $post['title'] }}</h1>
        <div class="post-meta">
            <span class="post-author">👤 {{ $post['author'] }}</span>
            <span class="post-date">{{ $post['created_at'] }}</span>
        </div>
    </div>

    <div class="post-detail-content">
        <p>{{ $post['content'] }}</p>
    </div>

    <div class="post-stats">
        <span class="stat-item">👍 {{ $post['likes'] }} Likes</span>
        <span class="stat-item">💬 {{ $post['comments_count'] }} Reacties</span>
    </div>
</div>

<div class="comments-section">
    <h2 class="comments-header">💬 Reacties ({{ count($post['comments']) }})</h2>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Comment Form -->
    @auth
        <form action="{{ route('community.comment.store', $post['id']) }}" method="POST" class="comment-form">
            @csrf
            <div class="form-group">
                <label class="form-label">Reageren als: <strong>{{ Auth::user()->name }}</strong></label>
            </div>

            <div class="form-group">
                <label for="content" class="form-label">Reactie</label>
                <textarea id="content" name="content" class="form-control" rows="4" placeholder="Typ je reactie..." required maxlength="1000">{{ old('content') }}</textarea>
                @error('content')
                    <small style="color: #ef4444;">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn-primary">Plaats reactie</button>
        </form>
    @else
        <form action="{{ route('community.comment.store', $post['id']) }}" method="POST" class="comment-form">
            @csrf
            <div class="form-group">
                <label for="author" class="form-label">Naam</label>
                <input type="text" id="author" name="author" class="form-control" placeholder="Je naam..." required maxlength="255" value="{{ old('author') }}">
                @error('author')
                    <small style="color: #ef4444;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="content" class="form-label">Reactie</label>
                <textarea id="content" name="content" class="form-control" rows="4" placeholder="Typ je reactie..." required maxlength="1000">{{ old('content') }}</textarea>
                @error('content')
                    <small style="color: #ef4444;">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn-primary">Plaats reactie</button>
        </form>
        <p style="color: #999; margin-top: 1rem; font-size: 0.9rem;">
            💡 Tip: <a href="{{ route('login') }}" style="color: #6366f1;">Log in</a> om automatisch je accountnaam te gebruiken!
        </p>
    @endauth

    @if(count($post['comments']) > 0)
        @foreach($post['comments'] as $comment)
            <div class="comment-card">
                <div class="comment-header">
                    <span class="comment-author">👤 {{ $comment['author'] }}</span>
                    <span class="comment-date">{{ $comment['created_at'] }}</span>
                </div>
                <div class="comment-content">
                    {{ $comment['content'] }}
                </div>
            </div>
        @endforeach
    @else
        <div class="no-comments">
            Nog geen reacties. Wees de eerste om te reageren!
        </div>
    @endif
</div>
@endsection
