<header class="site-header">
    <div class="container site-header__inner">
        <a href="{{ route('home') }}" class="site-logo" aria-label="GL Carbone Digital Strategist - Home">
            <img src="{{ asset('images/gl_logo_head.png') }}" alt="GL Carbone Digital Strategist">
        </a>

        {{-- Nav desktop --}}
        <nav class="site-nav" aria-label="Menu principale">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
            <a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.*') ? 'is-active' : '' }}">Progetti</a>
            <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'is-active' : '' }}">Servizi</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'is-active' : '' }}">Contatti</a>
        </nav>

        {{-- Burger button --}}
        <button class="burger-btn" id="burgerBtn" aria-label="Apri menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

{{-- Overlay --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- Sidebar --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/gl_logo_head.png') }}" alt="GL Carbone Digital Strategist">
            </a>
            <button class="sidebar__close" id="sidebarClose" aria-label="Chiudi menu">✕</button>
        </div>

        <nav class="sidebar__nav">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
            <a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.*') ? 'is-active' : '' }}">Progetti</a>
            <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'is-active' : '' }}">Servizi</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'is-active' : '' }}">Contatti</a>
        </nav>

        <div class="sidebar__footer">
            <a href="{{ route('contact') }}" class="sidebar__cta">Richiedi un preventivo</a>
        </div>
    </div>
</aside>

@push('scripts')
<script>
    const burgerBtn = document.getElementById('burgerBtn');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar.classList.add('is-open');
        overlay.classList.add('is-visible');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('is-open');
        overlay.classList.remove('is-visible');
        document.body.style.overflow = '';
    }

    burgerBtn.addEventListener('click', openSidebar);
    sidebarClose.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);
</script>
@endpush