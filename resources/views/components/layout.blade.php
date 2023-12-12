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
    <nav id="nav__main" class="sticky top-0 z-50 bg-white shadow" aria-label="main navigation">
        <div class="flex items-center justify-between p-4">
            <g-link class="flex items-center" to="/">
                <img src="https://github.com/LgHS/branding/blob/master/horizontal/text.svg?raw=true" alt="logo" class="logo">
            </g-link>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarBasicExample">
            <div class="p-4 flex flex-row">
                <a href="{{ route('profile') }}" class="block py-2 px-2 mx-2 border-b">
                    Mon profil
                </a>
                <a href="{{ route('roles') }}" class="block py-2 px-2 mx-2 border-b">
                    Accès
                </a>
                <a href="{{ route('badges::list') }}" class="block py-2 px-2 mx-2 border-b">
                    Badges
                </a>
                @if(Auth::hasRole('members-admin'))
                    <a href="{{ route('accesses::list') }}" class="block py-2 px-2 mx-2 border-b">
                        Clés API
                    </a>
                @endif
                    <a class="justify-end bg-red-500 text-white py-2 px-4 mx-2 rounded" href="https://auth.lghs.be/auth/realms/LGHS/protocol/openid-connect/logout?redirect_uri=https%3A%2F%2Fpassport.lghs.be">
                        Déconnexion
                    </a>
            </div>

            <div class="block p-2">
                <div class="py-2">
                    Apps
                    <div class="py-2 flex flex-row">
                        <a href="https://wiki.liegehacker.space/" target="_blank" class="block p-2">
                            Bookstack - Wiki
                        </a>
                        <a href="https://chat.lghs.be/" target="_blank" class="block p-2 m-2">
                            Rocket.Chat - Chat
                        </a>
                        <a href="https://chaman.lghs.be/" target="_blank" class="block p-2 m-2">
                            Chaman - Inventaire
                        </a>
                        <a href="https://cloud.lghs.be/" target="_blank" class="block p-2 m-2">
                            Nextcloud - Espace de stockage
                        </a>
                        <a href="https://accounting.lghs.be/" target="_blank" class="block p-2 m-2">
                            Accounting - Comptabilité
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{ $slot }}

    <footer class="bg-gray-100">
        <div class="container mx-auto py-4">
            <div class="text-center">
                <div>Liège Hackerspace - <a href="https://github.com/LgHS/members-v2" class="text-blue-600">Passport</a> formerly members-v2.</div>
            </div>
        </div>
    </footer>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
        if ($navbarBurgers.length > 0) {
            $navbarBurgers.forEach(el => {
                el.addEventListener('click', () => {
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');
                });
            });
        }
    });
