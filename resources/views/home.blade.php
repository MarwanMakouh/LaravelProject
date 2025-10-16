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
            text-align: center;
            margin-bottom: 1rem;
            font-size: 2.5rem;
        }

        p.text-muted {
            color: #cccccc !important;
            text-align: center;
            margin-bottom: 1rem;
        }

        /* Header styling */
        .header-container {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 1rem;
        }

        /* Loading spinner */
        .loading-spinner {
            display: none;
            text-align: center;
            padding: 2rem;
            color: #ffffff;
        }

        .loading-spinner.active {
            display: block;
        }

        .spinner {
            border: 4px solid #333;
            border-top: 4px solid #6c63ff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Game cards grid */
        .row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin: 0 auto;
            padding: 0 4rem;
            max-width: 1400px;
        }

        .col-md-4 {
            width: 100%;
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

        body.light-theme .card {
            background-color: #F9FAFB;
            border: 1px solid #000000;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        body.light-theme .card-info-section {
            background-color: #F3F4F6;
        }

        .card:hover {
            transform: translateY(-10px);
            border-color: #ffffff;
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
        }

        body.light-theme .card:hover {
            border-color: #000000;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
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
            margin-bottom: 0;
        }

        .game-info-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        /* Button styling */
        .btn-primary {
            background-color: #000000;
            border: 2px solid #000000;
            padding: 0.5rem 1.25rem;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #ffffff;
            display: inline-block;
        }

        .btn-primary:hover {
            background-color: #ffffff;
            color: #000000;
            border-color: #000000;
            transform: scale(1.05);
            text-decoration: none;
        }

        /* Responsive aanpassingen */
        @media (max-width: 1200px) {
            .row {
                padding: 0 3rem;
                gap: 1.5rem;
            }
        }

        @media (max-width: 992px) {
            .row {
                grid-template-columns: repeat(2, 1fr);
                padding: 0 2rem;
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .row {
                grid-template-columns: 1fr;
                padding: 0 1rem;
                gap: 1.5rem;
            }

            h1 {
                font-size: 2rem;
            }

            .header-container {
                gap: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .row {
                padding: 0 0.5rem;
            }

            h1 {
                font-size: 1.75rem;
            }
        }
    </style>

    <div class="header-container">
        <h1 class="mb-2">🎮 Welkom bij GamePortal</h1>
        <p class="text-muted">Ontdek de nieuwste games, nieuws en community-reacties!</p>
    </div>

    <div class="row mt-4" id="games-container">
        @if(count($games) > 0)
            @foreach($games as $game)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $game['background_image'] }}" class="card-img-top" alt="{{ $game['name'] }}">
                    <div class="card-info-section">
                        <h5 class="card-title">{{ $game['name'] }}</h5>
                        <p class="mb-1">📅 Released: {{ $game['released'] }}</p>
                        <div class="game-info-bottom">
                            <p>⭐ {{ $game['rating'] }}/5</p>
                            <a href="{{ url('/games/' . Str::slug($game['name'])) }}" class="btn btn-primary">Bekijk meer</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12 text-center">
                <p style="color: #ffffff;">Geen games gevonden{{ $search ? ' voor "' . $search . '"' : '' }}.</p>
            </div>
        @endif
    </div>

    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loading-spinner">
        <div class="spinner"></div>
        <p style="margin-top: 1rem;">Meer games laden...</p>
    </div>

    <script>
        let currentPage = 1;
        let isLoading = false;
        let hasMore = {{ $hasMore ? 'true' : 'false' }};
        const searchQuery = "{{ $search ?? '' }}";

        // Infinite scroll functionaliteit
        window.addEventListener('scroll', function() {
            if (isLoading || !hasMore) return;

            const scrollPosition = window.innerHeight + window.scrollY;
            const documentHeight = document.documentElement.scrollHeight;

            // Laad meer games als we 200px van de onderkant zijn
            if (scrollPosition >= documentHeight - 200) {
                loadMoreGames();
            }
        });

        function loadMoreGames() {
            if (isLoading || !hasMore) return;

            isLoading = true;
            currentPage++;

            const spinner = document.getElementById('loading-spinner');
            spinner.classList.add('active');

            let url = '{{ route("games.loadMore") }}?page=' + currentPage;
            if (searchQuery) {
                url += '&search=' + encodeURIComponent(searchQuery);
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('games-container');

                    data.games.forEach(game => {
                        const gameCard = createGameCard(game);
                        container.insertAdjacentHTML('beforeend', gameCard);
                    });

                    hasMore = data.hasMore;
                    isLoading = false;
                    spinner.classList.remove('active');
                })
                .catch(error => {
                    console.error('Error loading games:', error);
                    isLoading = false;
                    spinner.classList.remove('active');
                });
        }

        function createGameCard(game) {
            const slug = game.name.toLowerCase().replace(/[^a-z0-9]+/g, '-');
            return `
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="${game.background_image}" class="card-img-top" alt="${game.name}">
                        <div class="card-info-section">
                            <h5 class="card-title">${game.name}</h5>
                            <p class="mb-1">📅 Released: ${game.released}</p>
                            <div class="game-info-bottom">
                                <p>⭐ ${game.rating}/5</p>
                                <a href="/games/${slug}" class="btn btn-primary">Bekijk meer</a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }
    </script>
@endsection
