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
            <li class="nav-item"><a class="nav-link" href="{{ url('/news') }}">Nieuws</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/faq') }}">FAQ</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
        </ul>

        <ul class="navbar-nav ms-auto mb-0">
            <li class="nav-item"><a class="nav-link" href="#">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Registreren</a></li>
        </ul>
    </div>
</nav>
