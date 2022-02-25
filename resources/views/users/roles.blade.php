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

                    <h2 class="is-size-4 mt-4">Roles</h2>
                    <ul>
                    @foreach ($roles as $key => $role)
                        <li><strong>{{$key}}:</strong> {{$role}}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </section>
</x-layout>
