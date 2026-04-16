<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'Gian Digital Strategist') }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Siti web, strategia digitale, advertising e progetti su misura.' }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-body">
    <header class="site-header-public">
        <div class="site-wrap">
            <div class="site-header-public__inner">
                <a href="{{ route('home') }}" class="site-brand">
                    Gian Digital Strategist
                </a>

                <nav class="site-nav-public">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('projects.index') }}">Progetti</a>
                </nav>
            </div>
        </div>
    </header>

    <main class="site-main">
        @yield('content')
    </main>

    <footer class="site-footer-public">
        <div class="site-wrap">
            <div class="site-footer-public__grid">
                <div class="site-footer-public__col">
                    <p class="site-footer-public__kicker">Gian Digital Strategist</p>
                    <p class="site-footer-public__text">
                        Strategia, web e progetti digitali pensati per dare più forza,
                        chiarezza e valore alla presenza online di brand e aziende.
                    </p>
                </div>

                <div class="site-footer-public__col">
                    <p class="site-footer-public__title">Navigazione</p>
                    <div class="site-footer-public__links">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('projects.index') }}">Progetti</a>
                    </div>
                </div>
            </div>

            <div class="site-footer-public__bottom">
    <span>© {{ date('Y') }} Gian Digital Strategist</span>

    <div class="site-footer-public__bottom-links">
        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Login</a>
        @endauth
    </div>
</div>
        </div>
    </footer>
</body>
</html>