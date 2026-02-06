<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @stack('meta')
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product-card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about-us.css') }}">
    <link rel="stylesheet" href="{{ asset('css/support.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    @stack('styles')
</head>
<body class="@yield('body-class')">
    @include('layouts.header')
    <main>
        @yield('content')
    </main>
    @include('layouts.footer')
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
