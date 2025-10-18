<style>
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
        flex-shrink: 0;
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
        flex-wrap: nowrap;
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
        box-sizing: border-box;
    }

    .nav-link:hover {
        background-color: #ffffff;
        color: #000000 !important;
    }

    /* User welcome styling */
    .user-welcome {
        cursor: pointer;
        white-space: nowrap;
        box-sizing: border-box;
    }

    /* Logout button styling */
    .logout-btn {
        background: none;
        border: none;
        cursor: pointer;
    }

    body.light-theme .logout-btn {
        background-color: #ffffff;
        color: #000000 !important;
    }

    body.light-theme .logout-btn:hover {
        background-color: #000000;
        color: #ffffff !important;
    }

    @media (max-width: 768px) {
        .user-welcome {
            margin-top: 1rem;
        }
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

    /* Hamburger menu styling */
    .navbar-toggler {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
        margin-left: auto;
    }

    .navbar-toggler-icon {
        display: block;
        width: 30px;
        height: 3px;
        background-color: #ffffff;
        position: relative;
        transition: all 0.3s ease;
    }

    .navbar-toggler-icon::before,
    .navbar-toggler-icon::after {
        content: '';
        display: block;
        width: 30px;
        height: 3px;
        background-color: #ffffff;
        position: absolute;
        transition: all 0.3s ease;
    }

    .navbar-toggler-icon::before {
        top: -8px;
    }

    .navbar-toggler-icon::after {
        top: 8px;
    }

    body.light-theme .navbar-toggler-icon,
    body.light-theme .navbar-toggler-icon::before,
    body.light-theme .navbar-toggler-icon::after {
        background-color: #000000;
    }

    /* Active state voor hamburger (X vorm) */
    .navbar-toggler.active .navbar-toggler-icon {
        background-color: transparent;
    }

    .navbar-toggler.active .navbar-toggler-icon::before {
        transform: rotate(45deg);
        top: 0;
    }

    .navbar-toggler.active .navbar-toggler-icon::after {
        transform: rotate(-45deg);
        top: 0;
    }

    .navbar-collapse {
        display: flex;
        align-items: center;
        flex: 1;
    }

    .navbar-brand {
        flex-shrink: 0;
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
        .navbar-toggler {
            display: block;
            margin-bottom: 5px;
        }

        .navbar-collapse {
            display: none;
            width: 100%;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 5px;
        }

        .navbar-collapse.show {
            display: flex;
        }

        .navbar .container-fluid {
            flex-wrap: wrap;
        }

        .navbar-nav {
            flex-direction: column;
            width: 100%;
            gap: 0;
        }

        .navbar-nav.me-auto {
            margin-left: 0;
            margin-bottom: 1rem;
        }

        .navbar-nav.ms-auto {
            margin-left: 0;
            width: 100%;
            margin-bottom: 1rem;
        }

        .nav-item {
            width: 100%;
        }

        .nav-link {
            display: block;
            width: 100%;
            padding: 12px 15px !important;
        }

        .navbar-search {
            flex-direction: column;
            gap: 0.5rem;
            width: 100%;
            margin: 0;
            order: initial;
        }

        .navbar-search-input {
            width: 100%;
            max-width: 100%;
        }

        .navbar-search-btn,
        .navbar-clear-btn {
            width: 100%;
        }

        .theme-toggle {
            width: 100%;
            margin-left: 0;
            margin-top: 0.5rem;
        }
    }
</style>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">🎮 GamePortal</a>

        <button class="navbar-toggler" type="button" onclick="toggleNavbar()">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-0">
                <li class="nav-item"><a class="nav-link" href="{{ url('/news') }}">Nieuws</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/community') }}">Community</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/faq') }}">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
            </ul>

            @if(request()->is('/'))
            <form action="{{ route('home') }}" method="GET" class="navbar-search" id="search-form">
                <input
                    type="text"
                    name="search"
                    id="search-input"
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
                    @if(Auth::user()->is_admin)
                        <li class="nav-item">
                            <a href="{{ route('admin.news.index') }}" class="nav-link">Admin Panel</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('profile.edit') }}" class="nav-link user-welcome">Welkom, {{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" style="display: inline; width: 100%;">
                            @csrf
                            <button type="submit" class="nav-link logout-btn">Uitloggen</button>
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
    </div>
</nav>

<script>
    function toggleNavbar() {
        const navbarContent = document.getElementById('navbarContent');
        const toggler = document.querySelector('.navbar-toggler');

        navbarContent.classList.toggle('show');
        toggler.classList.toggle('active');
    }

    // Sluit navbar wanneer je op een link klikt (optioneel)
    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                const navbarContent = document.getElementById('navbarContent');
                const toggler = document.querySelector('.navbar-toggler');
                navbarContent.classList.remove('show');
                toggler.classList.remove('active');
            }
        });
    });

    // Debounce functie voor zoeken - wacht 500ms na laatste keystroke
    let searchTimeout;
    const searchInput = document.getElementById('search-input');
    const searchForm = document.getElementById('search-form');

    if (searchInput && searchForm) {
        searchInput.addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            const searchValue = e.target.value.trim();

            // Als het veld leeg is, submit niet automatisch
            if (searchValue.length === 0) {
                return;
            }

            // Wacht 500ms voordat we zoeken
            searchTimeout = setTimeout(function() {
                if (searchValue.length >= 2) {
                    searchForm.submit();
                }
            }, 500);
        });

        // Voorkom dat de form te snel wordt gesubmit bij Enter
        searchForm.addEventListener('submit', function(e) {
            const searchValue = searchInput.value.trim();
            if (searchValue.length > 0 && searchValue.length < 2) {
                e.preventDefault();
            }
        });
    }
</script>
