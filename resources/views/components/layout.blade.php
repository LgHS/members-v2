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
<main>
    <nav id="nav__main" class="md:sticky top-0 z-50 bg-white shadow flex flex-col" aria-label="main navigation">
        <div class="flex items-center justify-between p-4">
            <a class="flex items-center" href="{{ route("profile") }}">
                <img src="https://github.com/LgHS/branding/blob/master/horizontal/text.svg?raw=true" alt="logo" class="logo">
            </a>

            <div id="navbarBasicExample">
                <div class="p-4 flex flex-col md:flex-row relative gap-2">
                    <a href="{{ route('profile') }}" class="hidden py-2 px-2 border-b hover:bg-gray-50 md:block">
                        Mon profil
                    </a>
                    <a href="{{ route('roles') }}" class="hidden py-2 px-2 border-b hover:bg-gray-50 md:block">
                        Accès
                    </a>
                    <a href="{{ route('badges::list') }}" class="hidden py-2 px-2 border-b hover:bg-gray-50 md:block">
                        Badges
                    </a>
                    @if(Auth::hasRole('members-admin'))
                        <a href="{{ route('accesses::list') }}" class="hidden py-2 px-2 border-b hover:bg-gray-50 md:block">
                            Clés API
                        </a>
                    @endif
                    <div id="appButton" class="hidden py-2 px-2 border-b hover:bg-gray-50 text-left relative md:block" tabindex="0">
                        Apps
                        <div id="appMenu" class="hidden p-2 absolute top-10 left-0 bg-white shadow w-full md:w-72">
                            <div class="flex flex-col gap-2">
                                <a href="https://wiki.liegehacker.space/" target="_blank" class="block p-2 hover:bg-gray-50">
                                    Bookstack - Wiki
                                </a>
                                <a href="https://chat.lghs.be/" target="_blank" class="block p-2 hover:bg-gray-50">
                                    Rocket.Chat - Chat
                                </a>
                                <a href="https://chaman.lghs.be/" target="_blank" class="block p-2 hover:bg-gray-50">
                                    Chaman - Inventaire
                                </a>
                                <a href="https://cloud.lghs.be/" target="_blank" class="block p-2 hover:bg-gray-50">
                                    Nextcloud - Espace de stockage
                                </a>
                                <a href="https://accounting.lghs.be/" target="_blank" class="block p-2 hover:bg-gray-50">
                                    Accounting - Comptabilité
                                </a>
                            </div>
                        </div>
                    </div>
                    @if(!Auth::check())
                        <a href="{{ route('keycloak.login') }}" class="justify-end border border-slate-500 text-sm text-black py-1 px-2 mx-2 rounded hover:bg-slate-200 self-start">Connexion</a>
                    @else
                        <a href="{{ route('keycloak.logout') }}" class="justify-end bg-red-500 text-sm text-white py-1 px-2 mx-2 rounded hover:bg-red-200  hover:text-black self-start">Déconnexion</a>
                    @endif
                </div>
                <div class="p-4 flex flex-col md:flex-row relative gap-2 md:hidden">
                    <a href="{{ route('profile') }}" class="block py-2 px-2 border-b hover:bg-gray-50">
                        Mon profil
                    </a>
                    <a href="{{ route('roles') }}" class="block py-2 px-2 border-b hover:bg-gray-50">
                        Accès
                    </a>
                    <a href="{{ route('badges::list') }}" class="block py-2 px-2 border-b hover:bg-gray-50">
                        Badges
                    </a>
                    @if(Auth::hasRole('members-admin'))
                        <a href="{{ route('accesses::list') }}" class="block py-2 px-2 border-b hover:bg-gray-50">
                            Clés API
                        </a>
                    @endif
                    <div id="appButton" class="block py-2 px-2 border-b hover:bg-gray-50 text-left relative" tabindex="0">
                        Apps
                        <div id="appMenu" class="hidden p-2 absolute top-10 left-0 bg-white shadow w-full md:w-72">
                            <div class="flex flex-col gap-2">
                                <a href="https://wiki.liegehacker.space/" target="_blank" class="block p-2 hover:bg-gray-50">
                                    Bookstack - Wiki
                                </a>
                                <a href="https://chat.lghs.be/" target="_blank" class="block p-2 hover:bg-gray-50">
                                    Rocket.Chat - Chat
                                </a>
                                <a href="https://chaman.lghs.be/" target="_blank" class="block p-2 hover:bg-gray-50">
                                    Chaman - Inventaire
                                </a>
                                <a href="https://cloud.lghs.be/" target="_blank" class="block p-2 hover:bg-gray-50">
                                    Nextcloud - Espace de stockage
                                </a>
                                <a href="https://accounting.lghs.be/" target="_blank" class="block p-2 hover:bg-gray-50">
                                    Accounting - Comptabilité
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    {{ $slot }}

    <footer class="bg-gray-100 pb-16">
        <div class="container mx-auto py-4">
            <div class="text-left text-xs">
                <div>Liège Hackerspace [<a href="https://github.com/LgHS/members-v2" class="text-slate-600 font-bold">Passport</a>] formerly members-v2.</div>
            </div>
        </div>
    </footer>
</main>
</body>
</html>
