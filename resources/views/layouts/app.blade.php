<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@hasSection('title') @yield('title') · @endif {{ config('app.name', 'GL Carbone') }}</title>
    <meta name="description" content="@yield('meta_description', 'GL Carbone — Digital Strategist. Siti web, SEO e strategie digitali per far crescere la tua presenza online.')">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('meta_description', 'GL Carbone — Digital Strategist. Siti web, SEO e strategie digitali.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('img/og-default.jpg'))">
    <meta property="og:locale" content="it_IT">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('partials.site-header')

    <main class="site-main">
        @yield('content')
    </main>

    @include('partials.site-footer')
    @stack('scripts')
</body>
</html>