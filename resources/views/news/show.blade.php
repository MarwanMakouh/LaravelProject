@extends('layouts.app')

@section('title', $newsItem->title . ' - GamePortal')

@section('content')
<style>
    .news-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .news-back {
        color: #6366f1;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .news-back:hover {
        gap: 12px;
    }

    .news-article {
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        overflow: hidden;
    }

    body.light-theme .news-article {
        background: #F9FAFB;
        border: 1px solid #000000;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .news-hero-image {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
    }

    .news-hero-placeholder {
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 128px;
    }

    .news-body {
        padding: 40px;
    }

    @media (max-width: 768px) {
        .news-body {
            padding: 20px;
        }
    }

    .news-article-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #444;
    }

    body.light-theme .news-article-header {
        border-bottom: 1px solid #e5e7eb;
    }

    .news-article-title {
        font-size: 36px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 15px;
        line-height: 1.2;
    }

    body.light-theme .news-article-title {
        color: #000000;
    }

    @media (max-width: 768px) {
        .news-article-title {
            font-size: 28px;
        }
    }

    .news-article-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        color: #888;
        font-size: 14px;
    }

    body.light-theme .news-article-meta {
        color: #6b7280;
    }

    .news-article-content {
        color: #e5e5e5;
        font-size: 18px;
        line-height: 1.8;
        white-space: pre-wrap;
    }

    body.light-theme .news-article-content {
        color: #374151;
    }

    .news-article-content p {
        margin-bottom: 1.5rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
</style>

<div class="news-container">
    <a href="{{ route('news.index') }}" class="news-back">
        ← Terug naar nieuws
    </a>

    <article class="news-article">
        @if($newsItem->image_url)
            <img src="{{ $newsItem->image_url }}" alt="{{ $newsItem->title }}" class="news-hero-image">
        @else
            <div class="news-hero-placeholder">
                📰
            </div>
        @endif

        <div class="news-body">
            <header class="news-article-header">
                <h1 class="news-article-title">{{ $newsItem->title }}</h1>

                <div class="news-article-meta">
                    <span class="meta-item">
                        📅 {{ $newsItem->published_at->format('d F Y') }}
                    </span>
                    <span class="meta-item">
                        🕐 {{ $newsItem->published_at->format('H:i') }}
                    </span>
                </div>
            </header>

            <div class="news-article-content">
                {{ $newsItem->content }}
            </div>
        </div>
    </article>
</div>
@endsection
