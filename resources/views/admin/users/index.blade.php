@extends('layouts.app')

@section('title', 'Gebruikersbeheer - Admin')

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

    .alert {
        padding: 15px 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #10b981;
        color: #ffffff;
    }

    .alert-error {
        background-color: #ef4444;
        color: #ffffff;
    }

    body.light-theme .alert-success {
        background-color: #d1fae5;
        color: #065f46;
        border: 1px solid #10b981;
    }

    body.light-theme .alert-error {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #ef4444;
    }

    .users-table {
        width: 100%;
        background-color: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        overflow: hidden;
    }

    body.light-theme .users-table {
        background-color: #ffffff;
        border-color: #ddd;
    }

    .users-table thead {
        background-color: #1a1a1a;
    }

    body.light-theme .users-table thead {
        background-color: #f3f4f6;
    }

    .users-table th {
        padding: 15px;
        color: #ffffff;
        font-weight: 600;
        text-align: left;
        border-bottom: 2px solid #444;
    }

    body.light-theme .users-table th {
        color: #000000;
        border-bottom-color: #ddd;
    }

    .users-table td {
        padding: 15px;
        color: #cccccc;
        border-bottom: 1px solid #333;
    }

    body.light-theme .users-table td {
        color: #333333;
        border-bottom-color: #e5e7eb;
    }

    .users-table tr:last-child td {
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

    .badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-admin {
        background-color: #6366f1;
        color: #ffffff;
    }

    .badge-user {
        background-color: #6b7280;
        color: #ffffff;
    }

    body.light-theme .badge-admin {
        background-color: #e0e7ff;
        color: #4338ca;
    }

    body.light-theme .badge-user {
        background-color: #e5e7eb;
        color: #374151;
    }

    .badge-verified {
        background-color: #10b981;
        color: #ffffff;
        font-size: 11px;
        margin-left: 5px;
    }

    body.light-theme .badge-verified {
        background-color: #d1fae5;
        color: #065f46;
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
        <h1>👥 Gebruikersbeheer</h1>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">+ Nieuwe Gebruiker</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if($users->isEmpty())
        <p style="text-align: center; color: #999; padding: 40px;">
            Nog geen gebruikers gevonden.
        </p>
    @else
        <table class="users-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Rol</th>
                    <th>Aangemaakt</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            {{ $user->name }}
                            @if($user->email_verified_at)
                                <span class="badge badge-verified">✓ Geverifieerd</span>
                            @endif
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username ?? '-' }}</td>
                        <td>
                            @if($user->is_admin)
                                <span class="badge badge-admin">Admin</span>
                            @else
                                <span class="badge badge-user">Gebruiker</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-small btn-edit">Bewerken</a>
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-small btn-delete" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">Verwijderen</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
