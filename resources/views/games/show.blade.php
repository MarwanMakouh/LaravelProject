
@extends('layouts.app')
@section('title', 'Game Detail')

@section('content')
    <h2 class="mb-4">🎮 Game: {{ ucfirst(str_replace('-', ' ', request()->slug)) }}</h2>

    <p>Hier kun je informatie tonen over de geselecteerde game.</p>

    <hr>
    <h4>💬 Reacties</h4>

    <form>
        <div class="mb-3">
            <textarea class="form-control" placeholder="Typ je bericht..." required></textarea>
        </div>
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
@endsection
