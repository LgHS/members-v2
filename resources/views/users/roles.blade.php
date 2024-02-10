<x-layout>
    <section class="bg-blue-500 text-white px-4 md:px-0">
        <div class="py-16">
            <div class="container mx-auto">
                <h1 class="text-3xl font-semibold">
                    Mes accès
                </h1>
            </div>
        </div>
    </section>
    <section class="py-8 px-4 md:px-0">
        <div class="container mx-auto">
            <div class="flex flex-wrap">
                <div class="flex-grow">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold mb-3">Groupes</h2>
                        <ul class="list-disc pl-5">
                            @foreach ($groups as $group)
                                <li>{{$group['path']}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="w-screen md:w-full -m-4 md:-m-0 p-4 md:p-0 overflow-x-auto overflow-hidden">
                        <h2 class="text-2xl font-semibold mb-3">Rôles (Permissions)</h2>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rôle
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$key}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$role}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
