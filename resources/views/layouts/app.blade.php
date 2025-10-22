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

        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #1a1a1a !important;
            color: #ffffff;
        }

        /* Main container styling */
        .container {
            max-width: 100%;
            margin: 0;
            padding: 0;
            flex: 1;
        }

        /* Default dark theme text colors */
        h1, h2, h3, h4, h5, h6 {
            color: #ffffff;
        }

        p, span, div, label {
            color: #cccccc;
        }

        a {
            color: #6366f1;
        }

        a:hover {
            color: #4f46e5;
        }

        /* Light theme styles */
        body.light-theme {
            background-color: #f0f0f0 !important;
            color: #000000;
        }

        body.light-theme h1,
        body.light-theme h2,
        body.light-theme h3,
        body.light-theme h4,
        body.light-theme h5,
        body.light-theme h6 {
            color: #000000;
        }

        body.light-theme p,
        body.light-theme span,
        body.light-theme div,
        body.light-theme label {
            color: #333333;
        }

        body.light-theme a {
            color: #4338ca;
        }

        body.light-theme a:hover {
            color: #3730a3;
        }

        body.light-theme .navbar {
            background-color: #d0d0d0 !important;
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

    </style>
</head>
<body>
@include('layouts.navbar')

<main class="container mt-4">
    @yield('content')
</main>

@include('layouts.footer')

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
