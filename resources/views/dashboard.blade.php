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
                        rounded-sm p-6">
 
                        {{-- Title and game type --}}
                        <div class="text-center mb-3">
                            <h2 class="text-xl font-medium">{{ $game->title }}</h2>
                            <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">{{ $game->game->name }}</p>
                            @if ($game->game->slug === 'this-or-that')
                                <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mt-1">
                                    {{ $game->entries->count() }} entries · {{ $game->entries->count() - 1 }} rounds
                                </p>
                            @endif
                        </div>
 
                        {{-- Action buttons --}}
                        <div class="flex items-center justify-center gap-2 mt-4">
                            <a href="{{ route('games.this-or-that.play', $game) }}"
                               class="group flex items-center gap-1.5 rounded-sm border border-[#3E3E3A] px-4 py-2 text-sm
                                      text-[#A1A09A] transition-all duration-200
                                      hover:border-green-500/50 hover:text-green-400 hover:bg-green-500/5">
                                <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                                Play
                            </a>
 
                            <a href="{{ route('games.this-or-that.edit', $game) }}"
                               class="group flex items-center gap-1.5 rounded-sm border border-[#3E3E3A] px-4 py-2 text-sm
                                      text-[#A1A09A] transition-all duration-200
                                      hover:border-[#62605b] hover:text-white hover:bg-[#1f1f1f]">
                                <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
 
                            <button type="button"
                                x-data
                                x-on:click="$dispatch('open-modal', 'confirm-game-deletion-{{ $game->id }}')"
                                class="group flex items-center gap-1.5 rounded-sm border border-[#3E3E3A] px-4 py-2 text-sm
                                       text-[#A1A09A] transition-all duration-200
                                       hover:border-red-500/50 hover:text-red-400 hover:bg-red-500/5">
                                <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
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