<x-layout>
    <section class="bg-blue-500 text-white">
        <div class="py-16">
            <div class="container mx-auto">
                <h1 class="text-3xl font-semibold">
                    Liste des clés API
                </h1>
                <form action="{{route('accesses::generate')}}" method="POST" class="mt-4">
                    @csrf
                    <div class="flex">
                        <input class="flex-grow appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white rounded-r-none" type="text" name="id" placeholder="Description">
                        <button type="submit" class="btn rounded-l-none flex-shrink-0 whitespace-nowrap">
                            Générer une clé
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="py-8">
        <div class="container mx-auto">
            <div class="flex flex-wrap">
                <div class="flex-grow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Token
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($accesses as $access)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $access->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $access->api_token }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('accesses::destroy', ['api_token' => $access->api_token]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-layout>
