<x-app-layout>
    <div class="grid place-items-center min-h-[calc(100vh-8rem)] p-6">
        <div class="w-full max-w-md space-y-4">
            @foreach ($games as $game)
                <a href="{{ route('games.' . $game->slug . '.create') }}"
                    class="flex flex-col rounded-sm overflow-hidden
                           bg-white dark:bg-[#161615]
                           border border-[#3E3E3A]
                           transition-all duration-200 hover:shadow-[0px_0px_20px_rgba(255,255,255,0.15)]
                           aspect-square">

                    @if(file_exists(public_path('images/' . $game->slug . '-demo.gif')))
                        <img src="/images/{{ $game->slug }}-demo.gif"
                            alt="{{ $game->name }}"
                            class="w-full flex-[3] object-cover border-b border-[#3E3E3A]" />
                    @else
                        <div class="w-full flex-[3] bg-[#0a0a0a] flex items-center justify-center border-b border-[#3E3E3A]">
                            <span class="text-4xl text-[#3E3E3A]">?</span>
                        </div>
                    @endif

                    <div class="flex-[1] flex items-center justify-center bg-white dark:bg-[#161615]">
                        <h1 class="font-brand text-3xl font-medium text-[#1b1b18] dark:text-[#EDEDEC] text-center">{{ $game->name }}</h1>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>