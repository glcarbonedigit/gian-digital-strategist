<footer class="site-footer site-footer--v2">
    <div class="container site-footer__inner site-footer__inner--v2">
        <div class="site-footer__brand site-footer__brand--v2">
            <a href="{{ route('home') }}" class="site-footer__logo" aria-label="GL Creative - Home">
                <img src="{{ asset('images/logo-glcreative.png') }}" alt="GL Creative">
            </a>

            <p class="site-footer__intro">
                Strategia digitale, siti web, performance marketing e progetti su misura
                per costruire una presenza online più solida, chiara e autorevole.
            </p>

            <a href="{{ route('contact') }}" class="site-footer__cta">
                Richiedi un confronto
            </a>
        </div>

        <div class="site-footer__nav">
            <span class="site-footer__label">Navigazione</span>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('projects.index') }}">Progetti</a>
            <a href="{{ route('services') }}">Servizi</a>
            <a href="{{ route('contact') }}">Contatti</a>
        </div>

        <div class="site-footer__nav">
            <span class="site-footer__label">Competenze</span>
            <a href="{{ route('services') }}">Siti web</a>
            <a href="{{ route('services') }}">Laravel & WordPress</a>
            <a href="{{ route('services') }}">Google Ads</a>
            <a href="{{ route('services') }}">Meta Ads</a>
            <a href="{{ route('services') }}">SEO & contenuti</a>
        </div>

        <div class="site-footer__admin">
            <span class="site-footer__label">Area riservata</span>

            @auth
                <a href="{{ route('dashboard.projects.index') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Accedi</a>
            @endauth

            <div class="site-footer__micro">
                <span>GL Creative</span>
                <span>Digital strategist</span>
                <span>Web · Strategy · Performance</span>
            </div>
        </div>
    </div>

    <div class="container site-footer__bottom site-footer__bottom--v2">
        <span>© {{ date('Y') }} GL Creative</span>
        <span>Progetti digitali costruiti con metodo, identità e direzione.</span>
    </div>
</footer>