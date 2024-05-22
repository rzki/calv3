<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }} - Kalibrasi</title>
    <!-- Styles -->
        @vite('resources/sass/app.scss')

    <!-- Scripts -->
    @vite('resources/js/app.js')
</head>

<body>
    @include('layouts.nav')
    @include('layouts.sidenav')
    <main class="content">
        @include('layouts.topbar')
        {{ $slot }}
    </main>
</body>

</html>
