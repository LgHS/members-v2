<x-layout>
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Mon badge
                </h1>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-three-quarters">
                    <form method="POST" action="/badges">
                        @csrf

                        @if($id) <input type="hidden" name="id" value="{{ $id }}"/> @endif
                        @if(Auth::hasRole('badges-admin'))
                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Utilisateur</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control is-expanded">
                                        <div class="select">
                                            <select name="user_id">
                                                <option>----</option>
                                                @foreach ($users as $user)
                                                    <option value="{{$user['id']}}" @if($id && $user['id'] == $badge->user_id) selected @endif>{{$user['username']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                            <input type="hidden" name="user_id" value="{{ $current_id }}">
                        @endif

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Welcome Name</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control is-expanded">
                                        <input class="input" type="text" name="welcome_name" placeholder="Welcome Name" value="{{ $badge->welcome_name ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Accès</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control is-expanded">
                                        <div class="select is-multiple">
                                            <select multiple size="8" name="roles_ids[]">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role['id'] }}" @if($id && in_array($role['id'], explode(',', $badge->roles_ids))) selected @endif >{{ $role['role_name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Bloqué</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox">
                                            <input type="checkbox" name="is_banned" @if($id && $badge->is_banned == 'on') checked @endif>
                                            Oui
                                        </label>
                                    </div>
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
                                            Enregistrer
                                        </button>
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
