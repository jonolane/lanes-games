<x-app-layout>
    <div class="grid place-items-center min-h-[calc(100vh-8rem)] p-6">
        <div class="w-full max-w-md space-y-4">

            @foreach ($games as $game)
                <a href="{{ route('games.' . $game->slug . '.create') }}"
                   class="block dark:text-[#EDEDEC]
                          shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
                          dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
                          rounded-sm p-6 text-center">

                    <h1 class="text-xl font-medium mb-2">
                        {{ $game->name }}
                    </h1>

                    <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                        Create a new game
                    </p>

                </a>
            @endforeach

        </div>
    </div>
</x-app-layout>