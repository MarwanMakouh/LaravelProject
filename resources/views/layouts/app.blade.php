<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GamePortal')</title>
    <style>
        * {
            font-family: Arial, sans-serif;
        }

        /* Main container styling */
        .container {
            max-width: 100%;
            margin: 0;
            padding: 0;
        }

        /* Light theme styles */
        body.light-theme {
            background-color: #ffffff !important;
        }

        body.light-theme h1,
        body.light-theme h2,
        body.light-theme h4,
        body.light-theme p {
            color: #000000 !important;
        }

        body.light-theme .navbar {
            background-color: #f0f0f0 !important;
        }

        body.light-theme .navbar-brand,
        body.light-theme .nav-link {
            color: #000000 !important;
        }

        body.light-theme .navbar-brand:hover,
        body.light-theme .nav-link:hover {
            background-color: #000000 !important;
            color: #ffffff !important;
        }

        body.light-theme .theme-toggle {
            background-color: #000000;
            color: #ffffff;
        }

        body.light-theme .theme-toggle:hover {
            background-color: #ffffff;
            color: #000000;
            border: 2px solid #000000;
        }

        body.light-theme .card {
            background-color: #ffffff !important;
            border: 1px solid #ddd !important;
        }

        body.light-theme .card:hover {
            border-color: #000000 !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
        }

        body.light-theme .card-info-section {
            background-color: #f5f5f5 !important;
        }

        body.light-theme .card-title {
            color: #000000 !important;
        }

        body.light-theme .card-info-section p {
            color: #333333 !important;
        }

        body.light-theme .btn-primary {
            background-color: #000000 !important;
            color: #ffffff !important;
        }

        body.light-theme .btn-primary:hover {
            background-color: #ffffff !important;
            color: #000000 !important;
        }

        body.light-theme .search-input {
            background-color: #f5f5f5 !important;
            border-color: #ddd !important;
            color: #000000 !important;
        }

        body.light-theme .search-input:focus {
            background-color: #ffffff !important;
            border-color: #000000 !important;
        }

        body.light-theme .search-input::placeholder {
            color: #666 !important;
        }

        body.light-theme .search-btn {
            background-color: #000000 !important;
            color: #ffffff !important;
        }

        body.light-theme .search-btn:hover {
            background-color: #ffffff !important;
            color: #000000 !important;
        }

        body.light-theme .clear-btn {
            background-color: #ddd !important;
            color: #000000 !important;
        }

        body.light-theme .clear-btn:hover {
            background-color: #ccc !important;
        }

        body.light-theme .loading-spinner {
            color: #000000 !important;
        }

        body.light-theme .spinner {
            border-color: #ddd !important;
            border-top-color: #000000 !important;
        }

        body.light-theme p.text-muted {
            color: #666 !important;
        }

        body.light-theme .text-center p {
            color: #000000 !important;
        }
    </style>
</head>
<body>
@include('layouts.navbar')

<main class="container mt-4">
    @yield('content')
</main>

<footer class="text-center mt-5 py-3 border-top">
    <p class="text-muted mb-0">&copy; {{ date('Y') }} GamePortal - gemaakt met Laravel</p>
</footer>

<script>
    // Theme toggle functionaliteit
    function toggleTheme() {
        const body = document.body;
        const themeIcon = document.getElementById('theme-icon');

        if (body.classList.contains('light-theme')) {
            // Schakel naar dark theme
            body.classList.remove('light-theme');
            themeIcon.textContent = '☀️';
            localStorage.setItem('theme', 'dark');
        } else {
            // Schakel naar light theme
            body.classList.add('light-theme');
            themeIcon.textContent = '🌙';
            localStorage.setItem('theme', 'light');
        }
    }

    // Laad opgeslagen thema bij pagina load
    document.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('theme');
        const themeIcon = document.getElementById('theme-icon');

        if (savedTheme === 'light') {
            document.body.classList.add('light-theme');
            if (themeIcon) {
                themeIcon.textContent = '🌙';
            }
        } else {
            if (themeIcon) {
                themeIcon.textContent = '☀️';
            }
        }
    });
</script>
</body>
</html>
