<x-layout>
    <section class="bg-blue-500 text-white">
        <div class="py-16">
            <div class="container mx-auto">
                <h1 class="text-3xl font-semibold">
                    Profil
                </h1>
            </div>
        </div>
    </section>
    <section class="py-8">
        <div class="container mx-auto">
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="flex flex-wrap">
                <div class="flex-grow">
                    <form method="POST" action="/users">
                        @csrf

                        <!-- Inputs cachés -->
                        <input type="hidden" value="{{ $user->email }}" name="current_email" />
                        <!-- Plus d'inputs cachés ici -->

                        <!-- Champs de formulaire -->
                        <div class="flex items-center mb-6">
                            <!-- Plus de champs ici -->

                            <div class="w-full">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Nom d'utilisateur</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="username" required placeholder="Nom d'utilisateur" value="{{ $user->username }}">
                            </div>
                        </div>

                        <!-- Plus de champs ici -->

                        <div class="flex items-center mb-6">
                            <div class="w-full">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                    Enregistrer mes données
                                </button>
                                <a class="bg-blue-100 hover:bg-blue-200 text-blue-800 font-semibold py-2 px-4 border border-blue-500 rounded" href="https://auth.lghs.be/auth/realms/LGHS/account/password" target="_blank">
                                    Changer mon mot de passe
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
