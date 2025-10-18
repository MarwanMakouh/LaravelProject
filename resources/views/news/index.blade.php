@extends('layouts.app')

@section('title', 'Nieuws - GamePortal')

@section('content')
<style>
    .news-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .news-header h1 {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #ffffff;
    }

    body.light-theme .news-header h1 {
        color: #000000;
    }

    .news-header p {
        color: #cccccc;
    }

    body.light-theme .news-header p {
        color: #666666;
    }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    @media (max-width: 768px) {
        .news-grid {
            grid-template-columns: 1fr;
            padding: 0 1rem;
        }
    }

    .news-card {
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
    }

    body.light-theme .news-card {
        background: #F9FAFB;
        border: 1px solid #000000;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .news-card:hover {
        border-color: #ffffff;
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
        transform: translateY(-5px);
    }

    body.light-theme .news-card:hover {
        border-color: #000000;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .news-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: #1a1a1a;
    }

    body.light-theme .news-image {
        background: #e5e7eb;
    }

    .news-image-placeholder {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 64px;
    }

    .news-content {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .news-title {
        font-size: 22px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 10px;
    }

    body.light-theme .news-title {
        color: #000000;
    }

    .news-excerpt {
        color: #cccccc;
        margin-bottom: 15px;
        line-height: 1.6;
        flex: 1;
    }

    body.light-theme .news-excerpt {
        color: #4b5563;
    }

    .news-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #444;
    }

    body.light-theme .news-meta {
        border-top: 1px solid #e5e7eb;
    }

    .news-date {
        font-size: 14px;
        color: #888;
    }

    body.light-theme .news-date {
        color: #6b7280;
    }

    .read-more {
        color: #6366f1;
        font-weight: 600;
        text-decoration: none;
    }

    .read-more:hover {
        text-decoration: underline;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #888;
    }

    body.light-theme .empty-state {
        color: #6b7280;
    }

    .empty-state-icon {
        font-size: 64px;
        margin-bottom: 20px;
    }
</style>

<div class="news-header">
    <h1>📰 Laatste Nieuws</h1>
    <p>Blijf op de hoogte van het laatste gaming nieuws</p>
</div>

@if($news->count() > 0)
    <div class="news-grid">
        @foreach($news as $item)
            <a href="{{ route('news.show', $item->id) }}" class="news-card">
                @if($item->image_url)
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="news-image">
                @else
                    <div class="news-image-placeholder">
                        📰
                    </div>
                @endif

                <div class="news-content">
                    <h2 class="news-title">{{ $item->title }}</h2>
                    <p class="news-excerpt">
                        {{ Str::limit($item->content, 150) }}
                    </p>

                    <div class="news-meta">
                        <span class="news-date">
                            {{ $item->published_at->format('d M Y') }}
                        </span>
                        <span class="read-more">Lees meer →</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <div class="empty-state-icon">📭</div>
        <h2>Nog geen nieuws beschikbaar</h2>
        <p>Check later terug voor het laatste gaming nieuws!</p>
    </div>
@endif
@endsection
