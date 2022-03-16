<x-layout>
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Badges RFID
                </h1>
                <a href="{{ route('badges::view', ['id' => 'new']) }}" class="button is-success" >
                    Nouveau badge
                </a>
                @if(Auth::hasRole('badges-admin'))
                <a href="{{ route('inject-roles') }}" class="button is-warning" >
                    Injecter roles
                </a>
                @endif
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Utilisateur</th>
                                <th>Accès</th>
                                <th>Bloqué</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Utilisateur</th>
                                <th>Accès</th>
                                <th>Bloqué</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($badges as $badge)
                            <tr>
                                <th><a href="{{ route('badges::view', ['id' => $badge->id]) }}">{{ $badge->id }}</a></th>
                                <th>{{ $badge->user }}</th>
                                <td>@foreach($badge->roles as $role) <span class="tag">{{$role['role_name']}}</span> @endforeach</td>
                                <td>{{ $badge->is_banned }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
</x-layout>
