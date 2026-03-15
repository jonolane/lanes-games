<x-app-layout>
    @php
        $initialCount = old('count', isset($userGame)
            ? ($userGame->settings['count'] ?? $userGame->entries->count())
            : 10);

        $initialEntries = old('entries', isset($userGame)
            ? $userGame->entries->pluck('label')->values()->toArray()
            : []);

        $initialTitle = old('title', $userGame->title ?? '');
    @endphp

    <main class="grid place-items-center min-h-[calc(100vh-4rem)] p-6">
        <div class="w-full max-w-md">
            <div
                class="dark:text-[#EDEDEC]
                       shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
                       dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
                       rounded-sm p-6"
                x-data='{
                    count: {{ (int) $initialCount }},
                    entries: (() => {
                        let arr = @json($initialEntries);
                        while (arr.length < {{ (int) $initialCount }}) {
                            arr.push("");
                        }
                        return arr.slice(0, {{ (int) $initialCount }});
                    })(),
                    increase() {
                        if (this.count < 50) {
                            this.count += 2;
                            this.entries.push("", "");
                        }
                    },
                    decrease() {
                        if (this.count > 10) {
                            this.count -= 2;
                            this.entries.splice(-2, 2);
                        }
                    }
                }'
            >
                <h1 class="text-xl font-medium mb-4 text-center">
                    {{ isset($userGame) ? 'Edit This or That' : 'Create This or That' }}
                </h1>

                <form method="POST"
                      action="{{ isset($userGame) ? route('games.this-or-that.update', $userGame) : route('games.this-or-that.store') }}"
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
                        <label class="block text-sm mb-2">Number of Entries</label>

                        <div class="flex items-center justify-center gap-4">
                            <button type="button"
                                    @click="decrease()"
                                    class="rounded-sm border border-[#3E3E3A] bg-[#1f1f1f] text-white px-4 py-2 transition-colors duration-150 hover:bg-[#2a2a2a]">
                                −
                            </button>

                            <div class="min-w-[60px] text-center text-lg font-medium" x-text="count"></div>

                            <button type="button"
                                    @click="increase()"
                                    class="rounded-sm border border-[#3E3E3A] bg-[#1f1f1f] text-white px-4 py-2 transition-colors duration-150 hover:bg-[#2a2a2a]">
                                +
                            </button>
                        </div>

                        <input type="hidden" name="count" :value="count">

                        @error('count')
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
    </main>
</x-app-layout>
