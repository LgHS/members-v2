<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div>
    <nav id="nav__main" class="navbar is-sticky" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <g-link class="navbar-item" to="/">
                <img src="https://github.com/LgHS/branding/blob/master/horizontal/text.svg?raw=true" class="logo">
            </g-link>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample" @>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
            </div>

        </div>
    </nav>

    {{ $slot }}

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="name">Liège HackerSpace</div>
                <div>
                    <ul class="footer-social-links">

                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
