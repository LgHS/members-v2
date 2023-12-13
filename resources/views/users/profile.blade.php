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
                        <input type="hidden" value="{{ $user->email }}" name="current_email"/>
                        <input type="hidden" value="{{ $user->id }}" name="id"/>
                        <input type="hidden" value="{{ $user->attributes['cardId'][0] ?? '' }}"
                               name="attributes[cardId]"/>
                        <input type="hidden" value="{{ $user->attributes['old_member_id'][0] ?? '' }}"
                               name="attributes[old_member_id]"/>
                        <input type="hidden" value="{{ $user->attributes['old_member_uuid'][0] ?? '' }}"
                               name="attributes[old_member_uuid]"/>
                        <input type="hidden" value="{{ $user->attributes['locale'][0] ?? '' }}"
                               name="attributes[locale]"/>
                        <div class="field is-horizontal">
                            <label class="label">Nom d'utilisateur</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="username" required placeholder="Nom d'utilisateur"
                                value="{{ $user->username }}">
                        </div>
                        <div class="field is-horizontal">
                            <label class="label">Nom & Prénom</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="lastName" required placeholder="Nom" value="{{ $user->lastName }}">
                        </div>
                        <div class="field is-horizontal">
                            <label class="label">Email</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="email" name="email" required placeholder="Email" disabled
                                value="{{ $user->email }}">
                        </div>

                        <div class="field is-horizontal">
                            <label class="label">Téléphone</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="tel" required name="attributes[phoneNumber]" placeholder="Numéro de téléphone"
                                value="{{ $user->attributes['phoneNumber'][0] ?? '' }}">

                        </div>

                        <div class="field is-horizontal">
                            <label class="label">Rue & Numéro</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" required name="attributes[street]" placeholder="Rue & numéro"
                                value="{{ $user->attributes['street'][0] ?? '' }}">

                        </div>

                        <div class="field is-horizontal">
                            <label class="label">Code postal & Localité</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" required name="attributes[postal_code]" placeholder="Code postal"
                                value="{{ $user->attributes['postal_code'][0] ?? '' }}">

                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" required name="attributes[locality]" placeholder="Localité"
                                value="{{ $user->attributes['locality'][0] ?? '' }}">
                        </div>

                        <div class="field is-horizontal">
                            <label class="label">Pays</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" required name="attributes[country]" placeholder="Pays"
                                value="{{ $user->attributes['country'][0] ?? '' }}">

                        </div>

                        <div class="field is-horizontal">
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-primary" type="submit">
                                            Enregistrer mes données
                                        </button>
                                        <a class="button is-link"
                                           href="https://auth.lghs.be/auth/realms/LGHS/account/password"
                                           target="_blank">
                                            Changer mon mot de passe
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
