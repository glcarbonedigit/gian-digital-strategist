@extends('layouts.app')

@section('content')
@php
    $heroMain = $featuredProjects->get(0);
    $heroLeft = $featuredProjects->get(1);
    $heroRight = $featuredProjects->get(2);

    $tools = [
        ['name' => 'Laravel', 'file' => 'laravel.svg'],
        ['name' => 'WordPress', 'file' => 'wordpress.svg'],
        ['name' => 'Elementor', 'file' => 'elementor.svg'],
        ['name' => 'Shopify', 'file' => 'shopify.svg'],
        ['name' => 'WooCommerce', 'file' => 'woocommerce.svg'],
        ['name' => 'Google Ads', 'file' => 'google-ads.svg'],
        ['name' => 'Meta Ads', 'file' => 'meta-ads.svg'],
        ['name' => 'GA4', 'file' => 'ga4.svg'],
        ['name' => 'Search Console', 'file' => 'search-console.svg'],
        ['name' => 'Tag Manager', 'file' => 'tag-manager.svg'],
        ['name' => 'Figma', 'file' => 'figma.svg'],
        ['name' => 'Mailchimp', 'file' => 'mailchimp.svg'],
    ];
@endphp

@php
     $heroImages = [
        asset('images/home/hero-1.jpg'),
        asset('images/home/hero-2.jpg'),
        asset('images/home/hero-3.jpg'),
        asset('images/home/hero-4.jpg'),
        asset('images/home/hero-5.jpg'),
    ];
@endphp

<section class="home-hero-v3 home-reveal">
    <div class="site-wrap">
        <div class="home-hero-v3__head">
            <p class="home-hero-v3__eyebrow home-reveal home-reveal--delay-1">
                Digital strategist · web · performance
            </p>

            <h1 class="home-hero-v3__title home-reveal home-reveal--delay-2">
                Siti web e marketing
                <span>pensati per far crescere il business.</span>
            </h1>

            <p class="home-hero-v3__text home-reveal home-reveal--delay-3">
                Progetto esperienze digitali più chiare, autorevoli e orientate ai risultati:
                dal sito web alla strategia, fino alla visibilità online.
            </p>

            <div class="home-hero-v3__actions home-reveal home-reveal--delay-4">
                <a href="{{ route('projects.index') }}" class="btn-main btn-main--dark">
                    Guarda i progetti
                </a>

                <a href="{{ route('services') }}" class="btn-main btn-main--light">
                    Scopri i servizi
                </a>
            </div>
        </div>
    </div>

    <div class="home-hero-v3__visual-wrap">
       <div class="hero-stack hero-stack--reveal">
           @for($i = 0; $i < 5; $i++)
    <article class="hero-stack__card hero-stack__card--{{ $i + 1 }}">
                    <div class="hero-stack__media">
                        @if(!empty($heroImages[$i]))
                            <img src="{{ $heroImages[$i] }}" alt="Anteprima progetto">
                        @else
                            <div class="hero-stack__placeholder"></div>
                        @endif
                    </div>
                </article>
            @endfor
        </div>
    </div>
</section>

<section class="home-benefits-v2 home-reveal" data-brand-start>
    <div class="site-wrap">
        <div class="home-benefits-v2__head">
            <p class="home-benefits-v2__eyebrow">Benefici</p>
            <h2 class="home-benefits-v2__title">Un approccio che tiene insieme strategia, estetica e performance.</h2>
            <p class="home-benefits-v2__text">
                Ogni progetto viene costruito per essere più leggibile, più autorevole e più utile
                nel percorso che porta un utente a capire, fidarsi e contattarti.
            </p>
        </div>

        <div class="home-benefits-v2__grid">
    <article class="benefit-card reveal-fan reveal-fan--left reveal-fan--delay-1">
        <div class="benefit-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M8 16l-4-4 4-4"/>
                <path d="M16 8l4 4-4 4"/>
                <path d="M14 4l-4 16"/>
            </svg>
        </div>
        <h3>Libertà progettuale</h3>
        <p>Soluzioni costruite su misura, senza template rigidi e senza scelte standardizzate.</p>
    </article>

    <article class="benefit-card reveal-fan reveal-fan--center reveal-fan--delay-2">
        <div class="benefit-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M13 2L4 14h7l-1 8 10-14h-7l0-6z"/>
            </svg>
        </div>
        <h3>Prestazioni migliori</h3>
        <p>Siti più veloci, interfacce più leggere e una struttura che aiuta anche il marketing.</p>
    </article>

    <article class="benefit-card reveal-fan reveal-fan--right reveal-fan--delay-3">
        <div class="benefit-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <rect x="3" y="4" width="18" height="14" rx="2"/>
                <path d="M7 20h10"/>
                <path d="M8 9h8"/>
                <path d="M8 13h5"/>
            </svg>
        </div>
        <h3>SEO più solida</h3>
        <p>Gerarchie, contenuti e struttura tecnica pensati per migliorare leggibilità e posizionamento.</p>
    </article>

    <article class="benefit-card reveal-fan reveal-fan--left reveal-fan--delay-1">
        <div class="benefit-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M12 3l7 4v5c0 5-3.5 8-7 9-3.5-1-7-4-7-9V7l7-4z"/>
                <path d="M9.5 12l2 2 3-4"/>
            </svg>
        </div>
        <h3>Affidabilità</h3>
        <p>Un progetto più ordinato è anche più facile da gestire, evolvere e mantenere nel tempo.</p>
    </article>

    <article class="benefit-card reveal-fan reveal-fan--center reveal-fan--delay-2">
        <div class="benefit-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M8 12h8"/>
                <path d="M12 8v8"/>
                <circle cx="12" cy="12" r="9"/>
            </svg>
        </div>
        <h3>Integrazioni essenziali</h3>
        <p>Analytics, ADV, ecommerce, form, CRM e automazioni collegati in modo pulito e funzionale.</p>
    </article>

    <article class="benefit-card reveal-fan reveal-fan--right reveal-fan--delay-3">
        <div class="benefit-card__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M4 16l5-5 4 4 7-7"/>
                <path d="M14 8h6v6"/>
            </svg>
        </div>
        <h3>Scalabilità</h3>
        <p>Una base progettata bene permette di aggiungere servizi, funnel e nuove funzionalità senza caos.</p>
    </article>
</div>
    </div>
</section>

<section class="home-tools home-reveal" data-brand-end>
    <div class="site-wrap">
        <div class="home-tools__head">
            <p class="home-tools__eyebrow">Strumenti</p>
            <h2 class="home-tools__title">Tecnologie e piattaforme che utilizzo nel mio lavoro.</h2>
        </div>
    </div>

    <div class="home-tools__marquee">
        <div class="home-tools__track">
            @foreach($tools as $tool)
                <div class="home-tools__item">
                    <img
                        src="{{ asset('images/tools/' . $tool['file']) }}"
                        alt="{{ $tool['name'] }}"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-flex';"
                    >
                    <span class="home-tools__fallback">{{ $tool['name'] }}</span>
                </div>
            @endforeach

            @foreach($tools as $tool)
                <div class="home-tools__item">
                    <img
                        src="{{ asset('images/tools/' . $tool['file']) }}"
                        alt="{{ $tool['name'] }}"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-flex';"
                    >
                    <span class="home-tools__fallback">{{ $tool['name'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="home-featured home-reveal" id="home-featured">
    <div class="site-wrap">
        <div class="section-head">
            <div>
                <p class="section-head__kicker">Selezione</p>
                <h2 class="section-head__title">Progetti in evidenza</h2>
            </div>

            <a href="{{ route('projects.index') }}" class="section-head__link">
                Vedi tutti i progetti
            </a>
        </div>

        @if($featuredProjects->count())
            @php
                $mainProject = $featuredProjects->first();
                $secondaryProjects = $featuredProjects->slice(1);
            @endphp

            <div class="home-works">
                <article class="home-work-main reveal-fan reveal-fan--center reveal-fan--delay-2">
                    <a href="{{ route('projects.show', $mainProject) }}" class="home-work-main__media">
                        @if($mainProject->cover_image)
                            <img
                                src="{{ asset('storage/' . $mainProject->cover_image) }}"
                                alt="{{ $mainProject->title }}"
                            >
                        @else
                            <div class="home-work-main__placeholder"></div>
                        @endif
                    </a>

                    <div class="home-work-main__body">
                        @if($mainProject->category)
                            <p class="home-work-main__category">{{ $mainProject->category }}</p>
                        @endif

                        <h3 class="home-work-main__title">
                            <a href="{{ route('projects.show', $mainProject) }}">
                                {{ $mainProject->title }}
                            </a>
                        </h3>

                        @if($mainProject->client_name)
                            <p class="home-work-main__client">{{ $mainProject->client_name }}</p>
                        @endif

                      

                        <div class="home-work-main__actions">
                            <a href="{{ route('projects.show', $mainProject) }}" class="home-work-main__link">
                                Scopri il progetto
                            </a>

                            @if($mainProject->project_url)
                                <a href="{{ $mainProject->project_url }}" target="_blank" rel="noopener noreferrer" class="home-work-main__link home-work-main__link--secondary">
                                    Visita il progetto
                                </a>
                            @endif
                        </div>
                    </div>
                </article>

                @if($secondaryProjects->count())
                    <div class="home-work-grid">
                        @foreach($secondaryProjects as $project)
<article class="home-work-card reveal-fan {{ $loop->odd ? 'reveal-fan--left' : 'reveal-fan--right' }} reveal-fan--delay-3">                                <a href="{{ route('projects.show', $project) }}" class="home-work-card__media">
                                    @if($project->cover_image)
                                        <img
                                            src="{{ asset('storage/' . $project->cover_image) }}"
                                            alt="{{ $project->title }}"
                                        >
                                    @else
                                        <div class="home-work-card__placeholder"></div>
                                    @endif
                                </a>

                                <div class="home-work-card__body">
                                    @if($project->category)
                                        <p class="home-work-card__category">{{ $project->category }}</p>
                                    @endif

                                    <h3 class="home-work-card__title">
                                        <a href="{{ route('projects.show', $project) }}">
                                            {{ $project->title }}
                                        </a>
                                    </h3>

                                    @if($project->client_name)
                                        <p class="home-work-card__client">{{ $project->client_name }}</p>
                                    @endif

        

                                    <a href="{{ route('projects.show', $project) }}" class="home-work-card__link">
                                        Scopri il progetto
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div class="home-empty-box">
                Nessun progetto in evidenza disponibile al momento.
            </div>
        @endif
    </div>
</section>

<section class="home-cta home-reveal" id="cta-home">
    <div class="site-wrap">
        <div class="home-cta__box">
            <p class="home-cta__kicker">Contatto</p>
            <h2 class="home-cta__title">
                Hai un progetto da costruire, riposizionare o far crescere?
            </h2>
            <p class="home-cta__text">
                Posso aiutarti a trasformarlo in una presenza digitale più chiara,
                più forte e più efficace.
            </p>

            <div class="home-cta__actions">
                <a href="{{ route('contact') }}" class="btn-main btn-main--dark">
                    Parliamone
                </a>
            </div>
        </div>
    </div>
</section>
@endsection