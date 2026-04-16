@extends('layouts.app')

@section('title', 'Contatti | GL Carbone Digital Strategist')

@section('content')
    <section class="contact-page">
        <div class="site-wrap">
            <header class="contact-page__hero">
                <p class="contact-page__eyebrow">Contatti</p>

                <h1 class="contact-page__title">
                    Parliamo del tuo prossimo progetto digitale
                </h1>

                <p class="contact-page__lead">
                    Se vuoi sviluppare un sito, migliorare la tua presenza online
                    o impostare una strategia di acquisizione più efficace,
                    puoi contattarmi qui.
                </p>
            </header>

            <section class="contact-page__layout">
                <div class="contact-page__info">
                    <div class="contact-card">
                        <p class="contact-card__label">Contatto diretto</p>
                        <h2 class="contact-card__title">Richiedi una consulenza</h2>

                        <div class="contact-card__items">
                            <div class="contact-item">
                                <span>Email</span>
                                <a href="mailto:hello@glcarbone.it">hello@glcarbone.it</a>
                            </div>

                            <div class="contact-item">
                                <span>Telefono</span>
                                <a href="tel:+393296368299">+39 3296368299</a>
                            </div>

                            <div class="contact-item">
                                <span>Operatività</span>
                                <strong>Online e su progetti in tutta Italia</strong>
                            </div>
                        </div>
                    </div>

                    <div class="contact-card">
                        <p class="contact-card__label">Canali social</p>
                        <h2 class="contact-card__title">Dove puoi trovarmi</h2>

                        <div class="contact-socials">
                            <span class="contact-socials__item">LinkedIn</span>
                            <span class="contact-socials__item">Instagram</span>
                            <span class="contact-socials__item">Inbounce</span>
                            <span class="contact-socials__item">Behance</span>
                        </div>
                    </div>
                </div>

                <div class="contact-page__form-wrap">
                    <div class="contact-form-card">
                        <p class="contact-card__label">Form contatti</p>
                        <h2 class="contact-card__title">Scrivimi il tuo progetto</h2>
                        <p class="contact-form-card__text">
                            Raccontami in breve di cosa hai bisogno e ti ricontatterò
                            con una prima valutazione.
                        </p>

                        @if (session('success'))
    <div class="contact-form-alert contact-form-alert--success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="contact-form-alert contact-form-alert--error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form class="contact-form" method="POST" action="{{ route('contact.send') }}">
            @csrf

            <div class="contact-form__grid">
                <div class="contact-form__group">
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Il tuo nome">
                </div>

                <div class="contact-form__group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="La tua email">
                </div>
            </div>

            <div class="contact-form__group">
                <label for="phone">Telefono</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Il tuo numero">
            </div>

            <div class="contact-form__group">
                <label for="service">Servizio di interesse</label>
                <select id="service" name="service">
                    <option value="">Seleziona un servizio</option>
                    <option value="strategia" @selected(old('service') === 'strategia')>Strategia digitale</option>
                    <option value="siti" @selected(old('service') === 'siti')>Siti web e landing page</option>
                    <option value="advertising" @selected(old('service') === 'advertising')>Advertising e performance marketing</option>
                    <option value="seo" @selected(old('service') === 'seo')>SEO e ottimizzazione</option>
                    <option value="altro" @selected(old('service') === 'altro')>Altro</option>
                </select>
            </div>

            <div class="contact-form__group">
                <label for="message">Messaggio</label>
                <textarea id="message" name="message" rows="6" placeholder="Descrivi il progetto, gli obiettivi o quello di cui hai bisogno">{{ old('message') }}</textarea>
            </div>

            <div class="contact-form__actions">
                <button type="submit" class="btn-main btn-main--dark">
                    Invia richiesta
                </button>
            </div>
        </form>
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection