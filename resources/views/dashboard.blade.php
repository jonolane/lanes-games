<x-app-layout>
    <main class="grid place-items-center min-h-[calc(100vh-4rem)] p-6">
        <div class="w-full max-w-md">
            <div class="bg-white dark:bg-[#161615] dark:text-[#EDEDEC]
                        shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
                        dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
                        rounded-sm p-6 text-center">
                <h1 class="text-xl font-medium mb-2">Dashboard</h1>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                    {{ __("You're logged in!") }}
                </p>
            </div>
        </div>
    </main>
</x-app-layout>
