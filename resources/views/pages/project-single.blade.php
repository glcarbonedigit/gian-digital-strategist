@extends('layouts.app')

@section('title', $project->title)

@section('content')
@php
    $paragraphs = $project->content
        ? array_values(array_filter(array_map('trim', preg_split('/\r\n\r\n|\n\n|\r\r/', trim($project->content)))))
        : [];

    $introParagraph = $paragraphs[0] ?? null;
    $bodyParagraphs = array_slice($paragraphs, 1);
@endphp

<article class="case-project">
    <div class="container case-project__container">
        <a href="{{ route('projects.index') }}" class="case-project__back">
            ← Torna ai progetti
        </a>

        <header class="case-project__hero">
            <div class="case-project__hero-copy">
                @if($project->category)
                    <span class="case-project__kicker">{{ $project->category }}</span>
                @endif

                <h1 class="case-project__title">{{ $project->title }}</h1>

                @if($project->excerpt)
                    <p class="case-project__lead">{{ $project->excerpt }}</p>
                @endif
            </div>
        </header>

        @if($project->cover_image)
            <section class="case-project__cover-section">
                <figure class="case-project__cover">
                    <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}">
                </figure>
            </section>
        @endif

        <section class="case-project__summary">
            <div class="case-project__summary-label">
                <span class="case-project__section-label">Dettagli progetto</span>
            </div>

            <div class="case-project__summary-grid">
                @if($project->client_name)
                    <div class="case-project__summary-card">
                        <span>Cliente</span>
                        <strong>{{ $project->client_name }}</strong>
                    </div>
                @endif

                @if($project->category)
                    <div class="case-project__summary-card">
                        <span>Ambito</span>
                        <strong>{{ $project->category }}</strong>
                    </div>
                @endif

                @if($project->project_url)
                    <div class="case-project__summary-card">
                        <span>Sito</span>
                        <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer">
                            Visita il progetto
                        </a>
                    </div>
                @endif
            </div>
        </section>

        @if($introParagraph || count($bodyParagraphs))
            <section class="case-project__story">
                <div class="case-project__story-head">
                    <span class="case-project__section-label">Panoramica</span>
                </div>

                <div class="case-project__story-content">
                    @if($introParagraph)
                        <p class="case-project__story-intro">{!! nl2br(e($introParagraph)) !!}</p>
                    @endif

                    @if(count($bodyParagraphs))
                        <div class="case-project__story-body">
                            @foreach($bodyParagraphs as $paragraph)
                                <p>{!! nl2br(e($paragraph)) !!}</p>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        @endif

        @if($project->images->count())
            <section class="case-project__gallery-section">
                <div class="case-project__gallery-head">
                    <span class="case-project__section-label">Gallery</span>
                    <h2>Dettagli e sviluppo visivo del progetto</h2>
                </div>

                <div class="case-project__gallery">
                    @foreach($project->images as $image)
                        <figure class="case-project__gallery-item">
                            @if($image->media_type === 'video' && $image->video_path)
                                <video
                                    class="case-project__gallery-video js-autoplay-video"
                                    loop
                                    muted
                                    playsinline
                                    preload="metadata"
                                >
                                    <source src="{{ asset('storage/' . $image->video_path) }}">
                                </video>
                            @else
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $project->title }}">
                            @endif
                        </figure>
                    @endforeach
                </div>
            </section>
        @endif

        @if($project->project_url)
            <section class="case-project__final-cta">
                <div class="case-project__final-cta-box">
                    <span class="case-project__section-label">Progetto online</span>
                    <h2>Vuoi vedere il progetto online?</h2>
                    <p>Esplora il sito e guarda il risultato finale pubblicato.</p>
                    <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="case-project__cta">
                        Apri il sito
                    </a>
                </div>
            </section>
        @endif
    </div>
</article>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const videos = document.querySelectorAll('.js-autoplay-video');

    if (!videos.length) return;

    const playVideo = (video) => {
        const promise = video.play();
        if (promise !== undefined) {
            promise.catch(() => {});
        }
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            const video = entry.target;

            if (entry.isIntersecting && entry.intersectionRatio >= 0.45) {
                playVideo(video);
            } else {
                video.pause();
            }
        });
    }, {
        threshold: [0, 0.45, 0.75, 1]
    });

    videos.forEach((video) => {
        video.pause();
        observer.observe(video);
    });
});
</script>
@endpush
@endsection