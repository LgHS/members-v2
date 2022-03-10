<x-layout>
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Liste des clés API
                </h1>
                <form action="{{route('accesses::generate')}}" method="POST">
                    @csrf
                    <div class="field has-addons">
                        <div class="control">
                            <input class="input" type="text" name="id" placeholder="Description">
                        </div>
                        <div class="control">
                            <button type="submit" class="button is-info">
                                Générer une clé
                            </button>
                        </div>
                    </div>
                </form>
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
                                <th>Description</th>
                                <th>Token</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Description</th>
                                <th>Token</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($accesses as $access)
                            <tr>
                                <td>{{ $access->id }}</td>
                                <td>{{ $access->api_token }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
</x-layout>
