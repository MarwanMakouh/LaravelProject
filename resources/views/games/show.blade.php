@extends('layouts.app')
@section('title', 'Game Detail')

@section('content')
<style>
    /* Game detail page styling */
    .game-detail-container h2 {
        color: #ffffff;
        margin-bottom: 1.5rem;
    }

    .game-detail-container h4 {
        color: #ffffff;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .game-detail-container p {
        color: #cccccc;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .game-detail-container hr {
        border-color: #444;
        margin: 2rem 0;
    }

    body.light-theme .game-detail-container h2,
    body.light-theme .game-detail-container h4 {
        color: #000000;
    }

    body.light-theme .game-detail-container p {
        color: #333333;
    }

    body.light-theme .game-detail-container hr {
        border-color: #ddd;
    }

    /* Form styling */
    .comment-form {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
        max-width: 800px;
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

    body.light-theme .btn-primary {
        background-color: #000000;
        color: #ffffff !important;
    }

    body.light-theme .btn-primary:hover {
        background-color: #ffffff;
        color: #000000 !important;
        border-color: #000000;
    }
</style>

<div class="game-detail-container">
    <h2 class="mb-4">🎮 Game: {{ ucfirst(str_replace('-', ' ', request()->slug)) }}</h2>

    <p>Hier kun je informatie tonen over de geselecteerde game.</p>

    <hr>
    <h4>💬 Reacties</h4>

    <form class="comment-form">
        <textarea class="form-control" rows="4" placeholder="Typ je bericht..." required></textarea>
        <button type="submit" class="btn btn-primary">Plaats reactie</button>
    </form>

    <div class="mt-4">
        <div class="card mb-2">
            <div class="card-body">
                <strong>Gebruiker123</strong>
                <p>Fantastische game! 😍</p>
                <small class="text-muted">2 uur geleden</small>
            </div>
        </div>
    </div>
</div>
@endsection
