<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>

    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])
</head>
<body class="admin-body">

<header class="site-header">
    <div class="container site-header__inner">
        <a class="brand" href="{{ route('dashboard.projects.index') }}">
            Admin
        </a>

        <nav class="nav">
            <a href="{{ route('dashboard.projects.index') }}">Progetti</a>
            <a href="{{ route('dashboard.projects.create') }}">Nuovo progetto</a>
            <a href="{{ route('home') }}">Vai al sito</a>

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="nav-logout-btn">Logout</button>
            </form>
        </nav>
    </div>
</header>

<main class="page">
    <div class="container">
        @yield('content')
    </div>
</main>

<footer class="site-footer">
    <div class="container">
        Area admin riservata
    </div>
</footer>

</body>
</html>