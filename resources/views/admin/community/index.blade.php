@extends('layouts.app')

@section('title', 'Community Beheer - Admin')

@section('content')
<style>
    .admin-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .admin-header h1 {
        color: #ffffff;
        font-size: 32px;
        font-weight: bold;
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

    .alert {
        padding: 15px 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #10b981;
        color: #ffffff;
    }

    body.light-theme .alert-success {
        background-color: #d1fae5;
        color: #065f46;
        border: 1px solid #10b981;
    }

    .community-table {
        width: 100%;
        background-color: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        overflow: hidden;
    }

    body.light-theme .community-table {
        background-color: #ffffff;
        border-color: #ddd;
    }

    .community-table thead {
        background-color: #1a1a1a;
    }

    body.light-theme .community-table thead {
        background-color: #f3f4f6;
    }

    .community-table th {
        padding: 15px;
        color: #ffffff;
        font-weight: 600;
        text-align: left;
        border-bottom: 2px solid #444;
    }

    body.light-theme .community-table th {
        color: #000000;
        border-bottom-color: #ddd;
    }

    .community-table td {
        padding: 15px;
        color: #cccccc;
        border-bottom: 1px solid #333;
    }

    body.light-theme .community-table td {
        color: #333333;
        border-bottom-color: #e5e7eb;
    }

    .community-table tr:last-child td {
        border-bottom: none;
    }

    .btn-small {
        padding: 6px 12px;
        font-size: 14px;
        border-radius: 4px;
        text-decoration: none;
        display: inline-block;
        margin-right: 5px;
        transition: all 0.3s ease;
    }

    .btn-edit {
        background-color: #3b82f6;
        color: #ffffff;
    }

    .btn-edit:hover {
        background-color: #2563eb;
    }

    .btn-delete {
        background-color: #ef4444;
        color: #ffffff;
        border: none;
        cursor: pointer;
    }

    .btn-delete:hover {
        background-color: #dc2626;
    }

    .post-title {
        font-weight: 600;
        color: #ffffff;
    }

    body.light-theme .post-title {
        color: #000000;
    }

    .post-excerpt {
        color: #999;
        font-size: 14px;
        margin-top: 5px;
    }

    body.light-theme .post-excerpt {
        color: #666;
    }

    .comment-count {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background-color: #374151;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }

    body.light-theme .comment-count {
        background-color: #e5e7eb;
        color: #374151;
    }

    .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .pagination a,
    .pagination span {
        padding: 8px 12px;
        background: #2a2a2a;
        color: #ffffff;
        border-radius: 5px;
        text-decoration: none;
    }

    .pagination .active span {
        background: #6366f1;
    }

    body.light-theme .pagination a,
    body.light-theme .pagination span {
        background: #f3f4f6;
        color: #000000;
    }

    body.light-theme .pagination .active span {
        background: #000000;
        color: #ffffff;
    }
</style>

<div class="admin-container">
    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.news.index') }}" class="admin-nav-link">📰 Nieuws</a>
        <a href="{{ route('admin.community.index') }}" class="admin-nav-link">💬 Community</a>
        <a href="{{ route('admin.faq.index') }}" class="admin-nav-link">❓ FAQ</a>
        <a href="{{ route('admin.users.index') }}" class="admin-nav-link">👥 Gebruikers</a>

    </div>

    <div class="admin-header">
        <h1>💬 Community Beheer</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($communities->isEmpty())
        <p style="text-align: center; color: #999; padding: 40px;">
            Nog geen community posts gevonden.
        </p>
    @else
        <table class="community-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titel & Inhoud</th>
                    <th>Auteur</th>
                    <th>Reacties</th>
                    <th>Aangemaakt</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($communities as $community)
                    <tr>
                        <td>{{ $community->id }}</td>
                        <td>
                            <div class="post-title">{{ $community->title }}</div>
                            <div class="post-excerpt">{{ Str::limit($community->content, 80) }}</div>
                        </td>
                        <td>{{ $community->user ? $community->user->name : 'Onbekend' }}</td>
                        <td>
                            <span class="comment-count">💬 {{ $community->comments_count }}</span>
                        </td>
                        <td>{{ $community->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.community.edit', $community->id) }}" class="btn-small btn-edit">Bewerken</a>
                            <form action="{{ route('admin.community.destroy', $community->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-small btn-delete" onclick="return confirm('Weet je zeker dat je deze community post wilt verwijderen?')">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $communities->links() }}
        </div>
    @endif
</div>
@endsection
