<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Kalibrasi</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/brands.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/regular.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/solid.min.css')}}">

    <!-- Styles -->
    @vite('resources/sass/app.scss')
</head>

<body>
    <main>
        <section class="mt-5 vh-lg-100 mt-lg-0 bg-soft d-flex justify-content-center align-items-center">
            {{ $slot }}
        </section>
    </main>
</body>

</html>
