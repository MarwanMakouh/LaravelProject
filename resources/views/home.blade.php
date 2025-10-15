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
            margin-bottom: 1rem;
        }

        /* Header with search */
        .header-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 2rem;
            gap: 3rem;
            flex-wrap: wrap;
            padding: 0 1rem;
        }

        .header-text {
            flex: 1;
            min-width: 300px;
        }

        /* Search bar styling */
        .search-container {
            flex: 1;
            max-width: 500px;
        }

        .search-form {
            display: flex;
            gap: 1rem;
        }

        .search-input {
            flex: 1;
            padding: 0.75rem 1.25rem;
            border: 2px solid #444;
            border-radius: 8px;
            background-color: #2a2a2a;
            color: #ffffff;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #6c63ff;
            background-color: #333333;
        }

        .search-input::placeholder {
            color: #888;
        }

        .search-btn {
            padding: 0.75rem 2rem;
            background-color: #000000;
            color: #ffffff;
            border: 2px solid #000000;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background-color: #ffffff;
            color: #000000;
            border-color: #000000;
            transform: translateY(-2px);
        }

        .clear-btn {
            padding: 0.75rem 1.5rem;
            background-color: #444;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .clear-btn:hover {
            background-color: #555;
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
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin: 0;
            padding: 0 1rem;
        }

        .col-md-4 {
            flex: 1;
            min-width: 280px;
            max-width: calc(25% - 1.5rem);
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
        @media (max-width: 1400px) {
            .col-md-4 {
                max-width: calc(33.333% - 1.5rem);
            }
        }

        @media (max-width: 992px) {
            .col-md-4 {
                max-width: calc(50% - 1.5rem);
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

    <div class="header-container">
        <div class="header-text">
            <h1 class="mb-2">🎮 Welkom bij GamePortal</h1>
            <p class="text-muted">Ontdek de nieuwste games, nieuws en community-reacties!</p>
        </div>

        <!-- Search Bar -->
        <div class="search-container">
            <form action="{{ route('home') }}" method="GET" class="search-form">
                <input
                    type="text"
                    name="search"
                    class="search-input"
                    placeholder="Zoek naar games..."
                    value="{{ $search ?? '' }}"
                >
                <button type="submit" class="search-btn">Zoeken</button>
                @if($search)
                    <a href="{{ route('home') }}" class="clear-btn" style="text-decoration: none; display: flex; align-items: center;">Wissen</a>
                @endif
            </form>
        </div>
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
