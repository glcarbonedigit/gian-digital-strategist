@extends('layouts.app')

@section('title', 'Progetti | GL Carbone Digital Strategist')

@section('content')
    <section class="masonry-gallery-page">
        <div class="site-wrap">
            <header class="masonry-gallery-page__hero masonry-gallery-page__hero--page">
                <p class="masonry-gallery-page__eyebrow">Portfolio</p>
                <h1 class="masonry-gallery-page__title masonry-gallery-page__title--page">
                    Progetti che uniscono strategia, design e visione digitale.
                </h1>
                <p class="masonry-gallery-page__intro masonry-gallery-page__intro--page">
                    Una selezione di lavori tra siti web, branding, advertising e strategia digitale.
                    Ogni progetto nasce per dare più forza, chiarezza e credibilità alla presenza online di un brand.
                </p>
            </header>

            @if($projects->count())
                <div class="masonry-gallery">
                    @foreach($projects as $project)
                        <article class="masonry-gallery__item">
                            <a href="{{ route('projects.show', $project) }}" class="masonry-card" aria-label="Apri il progetto {{ $project->title }}">
                                <div class="masonry-card__media">
                                    @if($project->cover_image)
                                        <img
                                            src="{{ asset('storage/' . $project->cover_image) }}"
                                            alt="{{ $project->title }}"
                                            class="masonry-card__image"
                                        >
                                    @else
                                        <div class="masonry-card__placeholder"></div>
                                    @endif

                                    <div class="masonry-card__overlay"></div>

                                    <div class="masonry-card__content">
                                        <div class="masonry-card__meta">
                                            @if($project->category)
                                                <span class="masonry-card__category">{{ $project->category }}</span>
                                            @endif

                                        </div>

                                        <h2 class="masonry-card__title">{{ $project->title }}</h2>

                                        @if($project->client_name)
                                            <p class="masonry-card__client">Cliente: {{ $project->client_name }}</p>
                                        @endif


                                        <span class="masonry-card__link">Scopri il progetto</span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>

                <div class="masonry-gallery-page__pagination">
                    {{ $projects->links() }}
                </div>
            @else
                <div class="home-empty-box home-empty-box--projects">
                    <strong>I progetti saranno pubblicati a breve.</strong><br>
                    Sto costruendo una selezione più curata dei lavori più rappresentativi.
                </div>
            @endif

            <section class="masonry-gallery-cta">
                <div class="masonry-gallery-cta__inner">
                    <p class="masonry-gallery-cta__eyebrow">Hai un progetto in mente?</p>
                    <h2 class="masonry-gallery-cta__title">
                        Posso aiutarti a trasformarlo in una presenza digitale più forte, coerente e professionale.
                    </h2>
                    <a href="{{ route('contact') }}" class="masonry-gallery-cta__link">Parliamone</a>
                </div>
            </section>
        </div>
    </section>
@endsection