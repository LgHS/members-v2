<x-layout>
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Roles pour Badges RFID
                </h1>
                @if(Auth::hasRole('badges-admin'))
                    <a href="{{ route('badges::roles::inject') }}" class="button is-success" >
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
                                <th>Role</th>
                                <th>Inclus</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Role</th>
                                <th>Inclus</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <th>{{ $role->id }}</th>
                                <th>{{ $role->role_name }}</th>
                                <td><a href="{{ route('badges::roles::badgesOrNot', ['id' => $role->id]) }}">{{ $role->badges == 0 ? 'Exclu' : 'Inclus' }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
</x-layout>
