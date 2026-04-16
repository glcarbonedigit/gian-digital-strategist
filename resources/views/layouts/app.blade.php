<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@hasSection('title') @yield('title') · @endif {{ config('app.name', 'GL Creative') }}</title>
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