<x-layout>
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Profil
                </h1>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            @if ($errors->any())
                <div class="notification is-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="columns">
                <div class="column is-three-quarters">
                    <form method="POST" action="/users">
                        @csrf

                        <input type="hidden" value="{{ $user->email }}" name="current_email" />
                        <input type="hidden" value="{{ $user->id }}" name="id" />
                        <input type="hidden" value="{{ $user->attributes['old_member_id'][0] ?? '' }}" name="attributes[old_member_id]" />
                        <input type="hidden" value="{{ $user->attributes['old_member_uuid'][0] ?? '' }}" name="attributes[old_member_uuid]" />
                        <input type="hidden" value="{{ $user->attributes['locale'][0] ?? '' }}" name="attributes[locale]" />
                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Nom d'utilisateur</label>
                            </div>
                            <div class="field-body">
                                <div class="field is-expanded">
                                    <p class="control is-expanded">
                                        <input class="input" type="text" name="username" placeholder="Nom d'utilisateur" value="{{ $user->username }}">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Nom & Prénom</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded">
                                        <input class="input" type="text" name="lastName" placeholder="Nom" value="{{ $user->lastName }}">
                                    </p>
                                </div>
                                <div class="field">
                                    <p class="control is-expanded">
                                        <input class="input" type="text" name="firstName" placeholder="Prénom" value="{{ $user->firstName }}">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Email</label>
                            </div>
                            <div class="field-body">
                                <div class="field is-expanded">
                                    <p class="control is-expanded">
                                        <input class="input" type="email" name="email" placeholder="Email" disabled value="{{ $user->email }}">
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Téléphone</label>
                            </div>
                            <div class="field-body">
                                <div class="field is-expanded">
                                    <div class="field has-addons">
                                        <p class="control">
                                            <a class="button is-static">
                                                +
                                            </a>
                                        </p>
                                        <p class="control is-expanded">
                                            <input class="input" type="tel" name="attributes[phoneNumber]" placeholder="Numéro de téléphone" value="{{ $user->attributes['phoneNumber'][0] ?? '' }}">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Rue & Numéro</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded">
                                        <input class="input" type="text" name="attributes[street]" placeholder="Rue & numéro" value="{{ $user->attributes['street'][0] ?? '' }}">
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Code postal & Localité</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded">
                                        <input class="input" type="text" name="attributes[postal_code]" placeholder="Code postal" value="{{ $user->attributes['postal_code'][0] ?? '' }}">
                                    </p>
                                </div>
                                <div class="field">
                                    <p class="control is-expanded">
                                        <input class="input" type="text" name="attributes[locality]" placeholder="Localité" value="{{ $user->attributes['locality'][0] ?? '' }}">
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Pays</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded">
                                        <input class="input" type="text" name="attributes[country]" placeholder="Pays" value="{{ $user->attributes['country'][0] ?? '' }}">
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <!-- Left empty for spacing -->
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-primary" type="submit">
                                            Enregistrer mes données
                                        </button>
                                        <a class="button is-link" href="https://auth.lghs.be/auth/realms/LGHS/account/password" target="_blank">
                                            Changer mon mot de passe
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="column">
                    <h2 class="is-size-4">Groupes</h2>
                    <ul>
                    @foreach ($groups as $group)
                        <li>{{$group['path']}}</li>
                    @endforeach
                    </ul>

                    <h2 class="is-size-4 mt-4">Roles</h2>
                    @foreach ($roles as $key => $role)
                        <div><strong>{{$key}}:</strong> {{$role}}</div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>
</x-layout>
