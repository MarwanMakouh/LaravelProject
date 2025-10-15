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
    @media (max-width: 768px) {
        .navbar .container-fluid {
            flex-direction: column;
            gap: 1rem;
        }

        .navbar-nav.me-auto {
            margin-left: 0;
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
