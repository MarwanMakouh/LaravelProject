@extends('layouts.app')

@section('title', 'Community - GamePortal')

@section('content')
<style>
    .community-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .community-header h1 {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #ffffff;
    }

    body.light-theme .community-header h1 {
        color: #000000;
    }

    .community-header p {
        color: #cccccc;
    }

    body.light-theme .community-header p {
        color: #666666;
    }

    /* Pinterest-style masonry grid */
    .masonry-grid {
        column-count: 3;
        column-gap: 50px;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    @media (max-width: 1200px) {
        .masonry-grid {
            column-count: 2;
        }
    }

    @media (max-width: 500px) {
        .masonry-grid {
            column-count: 1;
            padding: 0 1rem;
        }
    }

    .post-card {
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        width: 100%;
        color: inherit;
        break-inside: avoid;
        page-break-inside: avoid;
        -webkit-column-break-inside: avoid;
        overflow: hidden;
        box-sizing: border-box;
    }

    body.light-theme .post-card {
        background: #F9FAFB;
        border: 1px solid #000000;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .post-card:hover {
        border-color: #ffffff;
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
        transform: scale(1.02);
    }

    body.light-theme .post-card:hover {
        border-color: #000000;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .post-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
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

    .post-content {
        font-size: 16px;
        line-height: 1.6;
        color: #ffffff;
    }

    .post-content h3 {
        color: #ffffff;
    }

    body.light-theme .post-content {
        color: #333333;
    }

    body.light-theme .post-content h3 {
        color: #000000;
    }

    .post-footer {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #333;
        display: flex;
        gap: 20px;
    }

    body.light-theme .post-footer {
        border-top: 1px solid #ddd;
    }

    .post-action {
        color: #999;
        font-size: 14px;
        cursor: pointer;
        transition: color 0.3s;
    }

    .post-action:hover {
        color: #6366f1;
    }

    body.light-theme .post-action:hover {
        color: #000000;
    }
</style>

<style>
    .btn-create {
        background-color: #000000;
        color: #ffffff !important;
        border: 2px solid #000000;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: block;
        margin: 0 auto 2rem auto;
        width: fit-content;
    }

    .btn-create:hover {
        background-color: #ffffff;
        color: #000000 !important;
        border-color: #000000;
        transform: translateY(-2px);
        text-decoration: none;
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

<div class="community-header">
    <h1>💬 Community</h1>
    <p>Deel je gaming ervaringen en praat met andere gamers</p>
</div>

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

@auth
    <a href="{{ route('community.create') }}" class="btn-create">✍️ Nieuwe Post</a>
@endauth

<div class="masonry-grid">
    @foreach($posts as $post)
    <a href="{{ route('community.show', $post['id']) }}" class="post-card">
        <div class="post-header">
            <span class="post-author">👤 {{ $post['author'] }}</span>
            <span class="post-date">{{ $post['created_at'] }}</span>
        </div>
        <div class="post-content">
            <h3>{{ $post['title'] }}</h3>
            <p>{{ $post['content'] }}</p>
        </div>
        <div class="post-footer">
            <span class="post-action">👍 {{ $post['likes'] }} Likes</span>
            <span class="post-action">💬 {{ $post['comments_count'] }} Reacties</span>
        </div>
    </a>
    @endforeach
</div>
@endsection
