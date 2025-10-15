@extends('layouts.app')
@section('title', 'Welkom bij GamePortal')

@section('content')
    <style>
        /* Home page specifieke styling */
        body {
            background-color: #1a1a1a !important;
        }

        h1 {
            color: #ffffff;
            text-align: left;
            margin-bottom: 1rem;
            font-size: 2.5rem;
        }

        p.text-muted {
            color: #cccccc !important;
            text-align: left;
            margin-bottom: 2rem;
        }

        /* Game cards grid */
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin: 0;
        }

        .col-md-4 {
            flex: 1;
            min-width: 300px;
            max-width: calc(33.333% - 1rem);
        }

        /* Game card styling */
        .card {
            background-color: #2a2a2a;
            border: 1px solid #444;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }

        .card:hover {
            transform: translateY(-10px);
            border-color: #ffffff;
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
        }

        .card-img-top {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .card-info-section {
            background-color: #333333;
            padding: 1.5rem;
        }

        .card-title {
            color: #ffffff;
            font-weight: bold;
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .card-info-section p {
            color: #cccccc;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .card-info-section p:last-of-type {
            margin-bottom: 1rem;
        }

        /* Button styling */
        .btn-primary {
            background-color: #6c63ff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #5a52d5;
            transform: scale(1.05);
        }

        /* Responsive aanpassingen */
        @media (max-width: 992px) {
            .col-md-4 {
                max-width: calc(50% - 1rem);
            }
        }

        @media (max-width: 768px) {
            .col-md-4 {
                max-width: 100%;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>

    <h1 class="mb-4">🎮 Welkom bij GamePortal</h1>
    <p class="text-muted">Ontdek de nieuwste games, nieuws en community-reacties!</p>

    <div class="row mt-4">
        @php
            $games = [
              ['name' => 'Elden Ring', 'released' => '2022-02-25', 'rating' => 4.8, 'background_image' => 'https://images.rawg.io/media/games/456/456dea5e1c7e3cd07060c14e96612001.jpg'],
              ['name' => 'Cyberpunk 2077', 'released' => '2020-12-10', 'rating' => 3.9, 'background_image' => 'https://images.rawg.io/media/games/73e/73e3dc2a6ff8cbd2f76e5b2a29f52ac9.jpg'],
              ['name' => 'Hollow Knight', 'released' => '2017-02-24', 'rating' => 4.6, 'background_image' => 'https://images.rawg.io/media/games/fd9/fd92a9a8d054d9f54dce7d4e5bdf6a07.jpg'],
              ['name' => 'The Witcher 3', 'released' => '2015-05-19', 'rating' => 4.7, 'background_image' => 'https://images.rawg.io/media/games/618/618c2031a07bbff6b4f611f10b6bcdbc.jpg'],
              ['name' => 'God of War', 'released' => '2018-04-20', 'rating' => 4.6, 'background_image' => 'https://images.rawg.io/media/games/4be/4be6a6ad0364751a96229c56bf69be59.jpg'],
              ['name' => 'Red Dead Redemption 2', 'released' => '2018-10-26', 'rating' => 4.6, 'background_image' => 'https://images.rawg.io/media/games/511/5118aff5091cb3efec399c808f8c598f.jpg'],
              ['name' => 'Minecraft', 'released' => '2011-11-18', 'rating' => 4.4, 'background_image' => 'https://images.rawg.io/media/games/b4e/b4e4c73d5aa4ec66bbf75375c4847a2b.jpg'],
              ['name' => 'GTA V', 'released' => '2013-09-17', 'rating' => 4.5, 'background_image' => 'https://images.rawg.io/media/games/456/456dea5e1c7e3cd07060c14e96612001.jpg'],
              ['name' => 'Stardew Valley', 'released' => '2016-02-26', 'rating' => 4.5, 'background_image' => 'https://images.rawg.io/media/games/713/713269608dc8f2f40f5a670a14b2de94.jpg'],
            ];
        @endphp
        @foreach($games as $game)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $game['background_image'] }}" class="card-img-top" alt="{{ $game['name'] }}">
                    <div class="card-info-section">
                        <h5 class="card-title">{{ $game['name'] }}</h5>
                        <p class="mb-1">📅 Released: {{ $game['released'] }}</p>
                        <p>⭐ {{ $game['rating'] }}/5</p>
                        <a href="{{ url('/games/' . Str::slug($game['name'])) }}" class="btn btn-primary w-100">Bekijk meer</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
