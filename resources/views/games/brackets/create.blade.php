<x-app-layout>
    @php
        $entryCount = 16;
        $initialEntries = old('entries', isset($userGame)
            ? $userGame->entries->pluck('label')->values()->toArray()
            : []);
        $initialTitle = old('title', $userGame->title ?? '');
    @endphp

    <div class="grid place-items-center min-h-[calc(100vh-8rem)] p-6">
        <div class="w-full max-w-2xl">
            <div
                class="dark:text-[#EDEDEC]
                       shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
                       dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
                       rounded-sm p-6"
                x-cloak
                x-data='{
                    entries: (() => {
                        let arr = @json($initialEntries);
                        while (arr.length < {{ $entryCount }}) {
                            arr.push("");
                        }
                        return arr.slice(0, {{ $entryCount }});
                    })()
                }'
            >
                <h1 class="text-xl font-medium mb-4 text-center">
                    {{ isset($userGame) ? 'Edit Brackets' : 'Create Brackets' }}
                </h1>

                <form method="POST"
                      action="{{ isset($userGame) ? route('games.brackets.update', $userGame) : route('games.brackets.store') }}"
                      class="space-y-4">
                    @csrf
                    @if(isset($userGame))
                        @method('PUT')
                    @endif

                    <div>
                        <label for="title" class="block text-sm mb-1">Title</label>
                        <input
                            id="title"
                            name="title"
                            type="text"
                            value="{{ $initialTitle }}"
                            class="w-full rounded-sm border border-[#3E3E3A] bg-[#1f1f1f] text-white p-2 transition-colors duration-150 hover:bg-[#2a2a2a] focus:bg-[#2e2e2e] focus:outline-none"
                            required
                        >
                        @error('title')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm mb-2">Entries</label>

                        <template x-for="(entry, index) in entries" :key="index">
                            <div class="mb-3">
                                <x-text-input
                                    name="entries[]"
                                    type="text"
                                    x-model="entries[index]"
                                    x-bind:placeholder="'Entry ' + (index + 1)"
                                    required
                                />
                            </div>
                        </template>

                        @error('entries')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror

                        @error('entries.*')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button
                            type="submit"
                            class="w-full rounded-sm border border-[#3E3E3A] bg-[#1f1f1f] text-white p-2 transition-colors duration-150 hover:bg-[#2a2a2a]"
                        >
                            {{ isset($userGame) ? 'Update Game' : 'Save Game' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>