@extends('layouts.app')

@section('title', 'Admin - Nieuws Beheer - GamePortal')

@section('content')
<style>
    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .admin-nav-container {
        margin-bottom: 30px;
        margin-top: 20px;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .admin-header h1 {
        font-size: 32px;
        font-weight: bold;
        color: #ffffff;
    }

    body.light-theme .admin-header h1 {
        color: #000000;
    }

    .admin-nav-link {
        display: inline-block;
        padding: 10px 15px;
        background: #2a2a2a;
        border: 1px solid #000000;
        border-radius: 5px;
        margin-right: 10px;
        text-decoration: none;
        color: #ffffff;
        transition: all 0.3s ease;
    }

    .admin-nav-link:hover {
        background: #d1d5db;
        color: #000000;
    }

    body.light-theme .admin-nav-link {
        background: #ffffff;
        color: #000000;
        border: 1px solid #000000;
    }

    body.light-theme .admin-nav-link:hover {
        background: #d1d5db;
        color: #000000;
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
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary:hover {
        background-color: #ffffff;
        color: #000000 !important;
        border-color: #000000;
        transform: translateY(-2px);
    }

    .alert-success {
        background-color: #10b981;
        color: #ffffff;
        padding: 1rem;
        border-radius: 5px;
        margin-bottom: 1.5rem;
    }

    body.light-theme .alert-success {
        background-color: #d1fae5;
        color: #065f46;
    }

    .news-table {
        width: 100%;
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        overflow: hidden;
    }

    body.light-theme .news-table {
        background: #F9FAFB;
        border: 1px solid #000000;
    }

    .news-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .news-table th {
        background: #1a1a1a;
        color: #ffffff;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        border-bottom: 1px solid #444;
    }

    body.light-theme .news-table th {
        background: #f3f4f6;
        color: #000000;
        border-bottom: 1px solid #e5e7eb;
    }

    .news-table td {
        padding: 1rem;
        border-bottom: 1px solid #333;
        color: #ffffff;
    }

    body.light-theme .news-table td {
        border-bottom: 1px solid #e5e7eb;
        color: #000000;
    }

    .news-table tr:last-child td {
        border-bottom: none;
    }

    .btn-edit {
        background-color: #3b82f6;
        color: #ffffff;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        margin-right: 0.5rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        background-color: #2563eb;
        transform: translateY(-2px);
    }

    .btn-delete {
        background-color: #ef4444;
        color: #ffffff;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        background-color: #dc2626;
        transform: translateY(-2px);
    }

    .news-image {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }

    .status-published {
        color: #10b981;
        font-weight: 600;
    }

    .status-draft {
        color: #f59e0b;
        font-weight: 600;
    }

    body.light-theme .status-published {
        color: #059669;
    }

    body.light-theme .status-draft {
        color: #d97706;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #888;
    }

    body.light-theme .empty-state {
        color: #6b7280;
    }
</style>

<div class="admin-container">
    <div class="admin-nav-container">
        <a href="{{ route('admin.news.index') }}" class="admin-nav-link">📰 Nieuws</a>
        <a href="{{ route('admin.faq.index') }}" class="admin-nav-link">❓ FAQ</a>
        <a href="{{ route('admin.users.index') }}" class="admin-nav-link">👥 Gebruikers</a>
        <a href="{{ route('admin.community.index') }}" class="admin-nav-link">💬 Community</a>
    </div>

    <div class="admin-header">
        <h1>📰 Nieuws Beheer</h1>
        <a href="{{ route('admin.news.create') }}" class="btn-primary">+ Nieuw Artikel</a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="news-table">
        @if($news->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Afbeelding</th>
                        <th>Titel</th>
                        <th>Status</th>
                        <th>Gepubliceerd</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $item)
                        <tr>
                            <td>
                                @if($item->image_url)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="news-image">
                                @else
                                    <div class="news-image" style="background: #444; display: flex; align-items: center; justify-content: center;">
                                        📰
                                    </div>
                                @endif
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>
                                @if($item->published_at)
                                    <span class="status-published">✓ Gepubliceerd</span>
                                @else
                                    <span class="status-draft">○ Concept</span>
                                @endif
                            </td>
                            <td>
                                @if($item->published_at)
                                    {{ $item->published_at->format('d/m/Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.news.edit', $item->id) }}" class="btn-edit">Bewerken</a>
                                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Weet je zeker dat je dit nieuwsbericht wilt verwijderen?')">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <p>Nog geen nieuwsberichten. Maak je eerste artikel aan!</p>
            </div>
        @endif
    </div>
</div>
@endsection
