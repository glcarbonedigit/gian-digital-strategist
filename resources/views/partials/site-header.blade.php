<header class="site-header">
    <div class="container site-header__inner">
        <a href="{{ route('home') }}" class="site-logo" aria-label="GL Carbone Digital Strategist - Home">
            <img src="{{ asset('images/gl_logo_head.png') }}" alt="GL Carbone Digital Strategist">
        </a>

        <nav class="site-nav" aria-label="Menu principale">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
            <a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.*') ? 'is-active' : '' }}">Progetti</a>
            <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'is-active' : '' }}">Servizi</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'is-active' : '' }}">Contatti</a>
        </nav>
    </div>
</header>