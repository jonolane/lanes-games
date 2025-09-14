<section class="space-y-6 bg-white dark:bg-[#161615] dark:text-[#EDEDEC]
                shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
                dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
                rounded-sm p-6">
    <header class="text-center">
        <h2 class="text-xl font-medium mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-[#706f6c] dark:text-[#A1A09A]">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        class="mt-4"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white dark:bg-[#161615] dark:text-[#EDEDEC]">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-[#1b1b18] dark:text-[#EDEDEC]">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-[#706f6c] dark:text-[#A1A09A]">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button class="border-[#19140035] dark:border-[#3E3E3A]" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
