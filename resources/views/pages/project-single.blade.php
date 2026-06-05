@extends('layouts.app')

@section('title', $project->title)

@section('content')

<article class="case-project">
    <div class="container case-project__container">

        <a href="{{ route('projects.index') }}" class="case-project__back">
            ← Torna ai progetti
        </a>

        <header class="case-project__hero">
            @if($project->category)
                <span class="case-project__kicker">{{ $project->category }}</span>
            @endif
            <h1 class="case-project__title">{{ $project->title }}</h1>
            @if($project->excerpt)
                <p class="case-project__lead">{{ $project->excerpt }}</p>
            @endif
        </header>

        @if($project->cover_image)
            <figure class="case-project__cover">
                <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}">
            </figure>
        @endif

        <div class="case-project__meta">
            @if($project->client_name)
                <div class="case-project__meta-item">
                    <span class="case-project__meta-label">Cliente</span>
                    <strong>{{ $project->client_name }}</strong>
                </div>
            @endif
            @if($project->category)
                <div class="case-project__meta-item">
                    <span class="case-project__meta-label">Ambito</span>
                    <strong>{{ $project->category }}</strong>
                </div>
            @endif
            @if($project->project_url)
                <div class="case-project__meta-item">
                    <span class="case-project__meta-label">Sito</span>
                    <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer">
                        Visita il progetto →
                    </a>
                </div>
            @endif
        </div>

        @php $sectionNum = 1; @endphp

        @if($project->challenge)
            <section class="case-section case-section--reveal">
                <div class="case-section__aside">
                    <span class="case-section__number">0{{ $sectionNum }}</span>
                    <span class="case-section__label">La sfida</span>
                </div>
                <div class="case-section__body">
                    <div class="case-section__bar"></div>
                    <div class="case-section__text">{!! $project->challenge !!}</div>
                </div>
            </section>
            @php $sectionNum++; @endphp
        @endif

        @if($project->approach)
            <section class="case-section case-section--reveal">
                <div class="case-section__aside">
                    <span class="case-section__number">0{{ $sectionNum }}</span>
                    <span class="case-section__label">Il nostro approccio</span>
                </div>
                <div class="case-section__body">
                    <div class="case-section__bar"></div>
                    <div class="case-section__text">{!! $project->approach !!}</div>
                </div>
            </section>
            @php $sectionNum++; @endphp
        @endif

        @if($project->result)
            <section class="case-section case-section--reveal">
                <div class="case-section__aside">
                    <span class="case-section__number">0{{ $sectionNum }}</span>
                    <span class="case-section__label">Il risultato</span>
                </div>
                <div class="case-section__body">
                    <div class="case-section__bar"></div>
                    <div class="case-section__text">{!! $project->result !!}</div>
                </div>
            </section>
            @php $sectionNum++; @endphp
        @endif

        @if($project->content)
            <section class="case-section case-section--reveal">
                <div class="case-section__aside">
                    <span class="case-section__number">0{{ $sectionNum }}</span>
                    <span class="case-section__label">Note</span>
                </div>
                <div class="case-section__body">
                    <div class="case-section__bar"></div>
                    <div class="case-section__text">{!! $project->content !!}</div>
                </div>
            </section>
        @endif

        @if($project->images->count())
            <section class="case-gallery case-section--reveal">
                <div class="case-gallery__head">
                    <span class="case-project__meta-label">Gallery</span>
                    <h2>Dettagli e sviluppo visivo</h2>
                </div>
                <div class="case-gallery__grid">
                    @foreach($project->images as $i => $image)
                        <figure class="case-gallery__item {{ $loop->first ? 'case-gallery__item--full' : '' }}">
                            @if($image->media_type === 'video' && $image->video_path)
                                <video class="js-autoplay-video" loop muted playsinline preload="metadata">
                                    <source src="{{ asset('storage/' . $image->video_path) }}">
                                </video>
                            @else
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $project->title }}" loading="lazy">
                            @endif
                        </figure>
                    @endforeach
                </div>
            </section>
        @endif

        @if($project->project_url)
            <section class="case-cta case-section--reveal">
                <div class="case-cta__box">
                    <div class="case-cta__text">
                        <span class="case-project__meta-label">Progetto online</span>
                        <h2>Vuoi vedere il progetto online?</h2>
                        <p>Esplora il sito e guarda il risultato finale pubblicato.</p>
                    </div>
                    <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="case-cta__btn">
                        Apri il sito →
                    </a>
                </div>
            </section>
        @endif

    </div>
</article>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const reveals = document.querySelectorAll('.case-section--reveal');
    const revealObs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('is-visible');
                revealObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    reveals.forEach(el => revealObs.observe(el));

    const videos = document.querySelectorAll('.js-autoplay-video');
    if (videos.length) {
        const vidObs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting && e.intersectionRatio >= 0.45) {
                    e.target.play().catch(() => {});
                } else {
                    e.target.pause();
                }
            });
        }, { threshold: [0, 0.45, 0.75, 1] });
        videos.forEach(v => { v.pause(); vidObs.observe(v); });
    }
});
</script>
@endpush

@endsection