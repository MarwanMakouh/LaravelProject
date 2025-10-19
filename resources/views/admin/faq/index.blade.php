@extends('layouts.app')

@section('title', 'FAQ Beheer - Admin')

@section('content')
<style>
    .admin-container {
        max-width: 1200px;
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

    .btn-primary {
        background-color: #6366f1;
        color: #ffffff;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .btn-primary:hover {
        background-color: #4f46e5;
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

    .faqs-table {
        width: 100%;
        background-color: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        overflow: hidden;
    }

    body.light-theme .faqs-table {
        background-color: #ffffff;
        border-color: #ddd;
    }

    .faqs-table thead {
        background-color: #1a1a1a;
    }

    body.light-theme .faqs-table thead {
        background-color: #f3f4f6;
    }

    .faqs-table th {
        padding: 15px;
        color: #ffffff;
        font-weight: 600;
        text-align: left;
        border-bottom: 2px solid #444;
    }

    body.light-theme .faqs-table th {
        color: #000000;
        border-bottom-color: #ddd;
    }

    .faqs-table td {
        padding: 15px;
        color: #cccccc;
        border-bottom: 1px solid #333;
    }

    body.light-theme .faqs-table td {
        color: #333333;
        border-bottom-color: #e5e7eb;
    }

    .faqs-table tr:last-child td {
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

    .badge-published {
        background-color: #10b981;
        color: #ffffff;
    }

    .badge-draft {
        background-color: #6b7280;
        color: #ffffff;
    }

    body.light-theme .badge-published {
        background-color: #d1fae5;
        color: #065f46;
    }

    body.light-theme .badge-draft {
        background-color: #e5e7eb;
        color: #374151;
    }

    .category-badge {
        background-color: #6366f1;
        color: #ffffff;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }

    body.light-theme .category-badge {
        background-color: #e0e7ff;
        color: #4338ca;
    }
</style>

<div class="admin-container">
    <div class="admin-header">
        <h1>FAQ Beheer</h1>
        <a href="{{ route('admin.faq.create') }}" class="btn-primary">+ Nieuwe FAQ</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($faqs->isEmpty())
        <p style="text-align: center; color: #999; padding: 40px;">
            Nog geen FAQ's. Klik op "Nieuwe FAQ" om er een aan te maken.
        </p>
    @else
        <table class="faqs-table">
            <thead>
                <tr>
                    <th>Volgorde</th>
                    <th>Vraag</th>
                    <th>Categorie</th>
                    <th>Status</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $faq)
                    <tr>
                        <td>{{ $faq->order }}</td>
                        <td>{{ Str::limit($faq->question, 60) }}</td>
                        <td><span class="category-badge">{{ $faq->category }}</span></td>
                        <td>
                            @if($faq->is_published)
                                <span class="badge badge-published">Gepubliceerd</span>
                            @else
                                <span class="badge badge-draft">Concept</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.faq.edit', $faq->id) }}" class="btn-small btn-edit">Bewerken</a>
                            <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-small btn-delete" onclick="return confirm('Weet je zeker dat je deze FAQ wilt verwijderen?')">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
