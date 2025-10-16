<style>
    /* Navbar wrapper met witte ruimte */
    body {
        margin: 0;
        padding: 0;
    }

    /* Navbar styling met zwarte achtergrond */
    .navbar {
        background-color: #000000 !important;
        padding: 1rem 2rem;
        margin: 0;
        width: 100%;
        display: flex;
        align-items: center;
        box-sizing: border-box;
        overflow-x: hidden;
    }

    .navbar .container-fluid {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        max-width: 100%;
        padding-left: 0;
        padding-right: 0;
        box-sizing: border-box;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .navbar-brand {
        color: #ffffff !important;
        transition: all 0.3s ease;
        padding: 8px 15px;
        border-radius: 5px;
        font-weight: bold;
        text-decoration: none;
        font-size: 1.25rem;
        white-space: nowrap;
    }

    .navbar-brand:hover {
        background-color: #ffffff;
        color: #000000 !important;
    }

    /* Navbar navigatie items */
    .navbar-nav {
        display: flex;
        flex-direction: row;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 0.5rem;
        align-items: center;
    }

    .navbar-nav.me-auto {
        margin-left: 2rem;
        flex: 1;
    }

    .navbar-nav.ms-auto {
        margin-left: auto;
    }

    .nav-item {
        display: inline-block;
    }

    /* Search bar in navbar */
    .navbar-search {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        margin-left: 1rem;
        margin-right: 1rem;
    }

    .navbar-search-input {
        padding: 8px 16px;
        border: 2px solid #ffffff;
        border-radius: 5px;
        background-color: #000000;
        color: #ffffff;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        width: 250px;
    }

    .navbar-search-input:focus {
        outline: none;
        background-color: #333333;
        width: 300px;
    }

    .navbar-search-input::placeholder {
        color: #888;
    }

    body.light-theme .navbar-search-input {
        background-color: #ffffff;
        color: #000000;
        border-color: #000000;
    }

    body.light-theme .navbar-search-input:focus {
        background-color: #f5f5f5;
    }

    .navbar-search-btn {
        padding: 8px 20px;
        background-color: #ffffff;
        color: #000000;
        border: none;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .navbar-search-btn:hover {
        background-color: #000000;
        color: #ffffff;
        border: 2px solid #ffffff;
    }

    body.light-theme .navbar-search-btn {
        background-color: #000000;
        color: #ffffff;
    }

    body.light-theme .navbar-search-btn:hover {
        background-color: #ffffff;
        color: #000000;
        border: 2px solid #000000;
    }

    .navbar-clear-btn {
        padding: 8px 16px;
        background-color: #444;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        white-space: nowrap;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .navbar-clear-btn:hover {
        background-color: #555;
        text-decoration: none;
        color: #ffffff;
    }

    body.light-theme .navbar-clear-btn {
        background-color: #ddd;
        color: #000000;
    }

    body.light-theme .navbar-clear-btn:hover {
        background-color: #ccc;
    }

    .nav-link {
        color: #ffffff !important;
        transition: all 0.3s ease;
        border-radius: 5px;
        padding: 8px 15px !important;
        text-decoration: none;
        display: inline-block;
        white-space: nowrap;
    }

    .nav-link:hover {
        background-color: #ffffff;
        color: #000000 !important;
    }

    /* Theme toggle button */
    .theme-toggle {
        background-color: #ffffff;
        color: #000000;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-left: 0.5rem;
    }

    .theme-toggle:hover {
        background-color: #000000;
        color: #ffffff;
        border: 2px solid #ffffff;
    }

    /* Responsive aanpassingen */
    @media (max-width: 1200px) {
        .navbar-search-input {
            width: 180px;
        }

        .navbar-search-input:focus {
            width: 220px;
        }
    }

    @media (max-width: 992px) {
        .navbar .container-fluid {
            flex-wrap: wrap;
        }

        .navbar-search {
            order: 3;
            width: 100%;
            margin: 1rem 0 0 0;
            justify-content: center;
        }

        .navbar-search-input {
            flex: 1;
            max-width: 300px;
        }

        .navbar-search-input:focus {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .navbar .container-fluid {
            flex-direction: column;
            gap: 1rem;
        }

        .navbar-nav.me-auto {
            margin-left: 0;
        }

        .navbar-search {
            flex-direction: column;
            gap: 0.5rem;
            width: 100%;
        }

        .navbar-search-input {
            width: 100%;
            max-width: 100%;
        }

        .navbar-search-btn,
        .navbar-clear-btn {
            width: 100%;
        }
    }
</style>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">🎮 GamePortal</a>

        <ul class="navbar-nav me-auto mb-0">
            <li class="nav-item"><a class="nav-link" href="{{ url('/community') }}">Community</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/faq') }}">FAQ</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
        </ul>

        @if(request()->is('/'))
        <form action="{{ route('home') }}" method="GET" class="navbar-search">
            <input
                type="text"
                name="search"
                class="navbar-search-input"
                placeholder="Zoek games..."
                value="{{ request('search') }}"
            >
            <button type="submit" class="navbar-search-btn">Zoek</button>
            @if(request('search'))
                <a href="{{ route('home') }}" class="navbar-clear-btn">Wis</a>
            @endif
        </form>
        @endif

        <ul class="navbar-nav ms-auto mb-0">
            @auth
                <li class="nav-item">
                    <span class="nav-link" style="cursor: default;">Welkom, {{ Auth::user()->name }}</span>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer;">Uitloggen</button>
                    </form>
                </li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registreren</a></li>
            @endauth
            <li class="nav-item">
                <button class="theme-toggle" id="theme-toggle" onclick="toggleTheme()">
                    <span id="theme-icon">☀️</span>
                </button>
            </li>
        </ul>
    </div>
</nav>
