<x-layout>
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Mes accès
                </h1>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column content">
                    <h2 class="is-size-4">Groupes</h2>
                    <ul>
                    @foreach ($groups as $group)
                        <li>{{$group['path']}}</li>
                    @endforeach
                    </ul>
                    <h2 class="is-size-4">Roles</h2>
                    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>Rôle</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Rôle</th>
                                <th>Description</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <th>{{$key}}</th>
                                <td>{{$role}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-layout>
