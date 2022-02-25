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
            <div class="navbar-end">
                <a href="https://wiki.liegehacker.space/" target="_blank" class="navbar-item">
                    Wiki
                </a>
                <a href="https://chat.lghs.be/" target="_blank" class="navbar-item">
                    Chat
                </a>
                <a href="https://chaman.lghs.be/" target="_blank" class="navbar-item">
                    Chaman
                </a>
                <a href="https://accounting.lghs.be/" target="_blank" class="navbar-item">
                    Accounting
                </a>
            </div>

        </div>
    </nav>

    {{ $slot }}

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="name">Liège Hackerspace</div>
            </div>
        </div>
    </footer>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
        if ($navbarBurgers.length > 0) {
            $navbarBurgers.forEach( el => {
                el.addEventListener('click', () => {
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');
                });
            });
        }
    });
</script>
</body>
</html>
