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
</body>
</html>
