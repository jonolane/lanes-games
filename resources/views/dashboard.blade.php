<x-app-layout>
    <main class="grid place-items-center min-h-[calc(100vh-4rem)] p-6">
        <div class="w-full max-w-md space-y-4">
            @if ($games->isEmpty())
                <div class="dark:text-[#EDEDEC]
                            shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
                            dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
                            rounded-sm p-6 text-center">
                    <h1 class="text-xl font-medium mb-2">Select the plus icon to get started</h1>
                    <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                        {{ __("= )") }}
                    </p>
                </div>
            @else
                @foreach ($games as $game)
                    <div class="dark:text-[#EDEDEC]
                        shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
                        dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
                        rounded-sm p-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <div class="font-medium">{{ $game->title }}</div>
                                <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                    {{ $game->game->name }}
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <a href="#"
                                    class="text-[#A1A09A] hover:text-white transition-colors duration-150"
                                    aria-label="Play">
                                        ▶
                                </a>

                                <a href="{{ route('games.this-or-that.edit', $game) }}"
                                    class="text-[#A1A09A] hover:text-white transition-colors duration-150"
                                    aria-label="Edit">
                                        ✎
                                </a>

                                <form method="POST" action="{{ route('games.destroy', $game) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="text-[#A1A09A] hover:text-red-400 transition-colors"
                                        title="Delete"
                                        onclick="return confirm('Delete this game?')">
                                        🗑
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </main>
</x-app-layout>
