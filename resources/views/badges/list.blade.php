<x-layout>
    <section class="bg-primary text-white">
        <div class="py-16">
            <div class="container mx-auto">
                <h1 class="text-3xl font-semibold">
                    Badge
                </h1>
            </div>
        </div>
    </section>
    <section class="py-8">
        <div class="container mx-auto">
            <div class="flex flex-wrap">
                <div class="flex-grow">
                    <form method="POST">
                        @csrf
                        <div class="flex items-center mb-6">
                            <div class="w-1/4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">UUID</label>
                            </div>
                            <div class="w-3/4">
                                <div>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="uuid" placeholder="UUID" disabled value="{{ $cardId ?? '' }}">
                                    <p class="text-sm text-gray-600 mt-2">
                                        Attention, si vous regénérez votre UUID, l'intégralité de vos badges seront désactivés. Vous devrez les flasher à nouveau. N'utilisez cette fonction que dans le cas d'une perte de badge.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mb-6">
                            <div class="w-1/4">
                                <!-- Left empty for spacing -->
                            </div>
                            <div class="w-3/4">
                                <div class="flex items-center">
                                    <input class="mr-2 leading-tight" type="checkbox" required>
                                    <span class="text-sm">
                                        J'ai compris
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mb-6">
                            <div class="w-1/4">
                                <!-- Left empty for spacing -->
                            </div>
                            <div class="w-3/4">
                                <button class="btn" type="submit">
                                    Regénérer un nouvel UUID
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
