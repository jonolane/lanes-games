<x-app-layout>
    <div class="grid place-items-center min-h-[calc(100vh-8rem)] p-6">
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

                                <button type="button"
                                    x-data
                                    x-on:click="$dispatch('open-modal', 'confirm-game-deletion-{{ $game->id }}')"
                                    class="text-[#A1A09A] hover:text-red-400 transition-colors"
                                    title="Delete">
                                    🗑
                                </button>
                            </div>
                        </div>
                    </div>

                    <x-modal name="confirm-game-deletion-{{ $game->id }}" focusable>
                        <div class="p-6 bg-white dark:bg-[#161615] dark:text-[#EDEDEC]">
                            <h2 class="text-lg font-medium text-[#1b1b18] dark:text-[#EDEDEC]">
                                {{ __('Delete this game?') }}
                            </h2>

                            <p class="mt-1 text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                {{ __('Are you sure you want to delete "' . $game->title . '"? This action cannot be undone.') }}
                            </p>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button class="border-[#19140035] dark:border-[#3E3E3A]" x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <form method="POST" action="{{ route('games.destroy', $game) }}" class="ms-3">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button>
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                </form>
                            </div>
                        </div>
                    </x-modal>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>