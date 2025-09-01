<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-3">
        @csrf

        <!-- Name -->
        <div class="bg-white dark:bg-[#161615] dark:text-[#EDEDEC]
            shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
            dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
            rounded-sm p-6 w-full max-w-md">
            <x-input-label for="name" :value="__('Name')" class="text-white mb-1" />
            <x-text-input id="name" name="name" type="text"
                  class="block w-full"
                  :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div class="bg-white dark:bg-[#161615] dark:text-[#EDEDEC]
            shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
            dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
            rounded-sm p-6 w-full max-w-md">
            <x-input-label for="email" :value="__('Email')" class="text-white mb-1" />
            <x-text-input id="email" name="email" type="email"
                  class="block w-full"
                  :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="bg-white dark:bg-[#161615] dark:text-[#EDEDEC]
            shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
            dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
            rounded-sm p-6 w-full max-w-md">
            <x-input-label for="password" :value="__('Password')" class="text-white mb-1" />
            <x-text-input id="password" name="password" type="password"
                  class="block w-full"
                  required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div class="bg-white dark:bg-[#161615] dark:text-[#EDEDEC]
            shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
            dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
            rounded-sm p-6 w-full max-w-md">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white mb-1" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                  class="block w-full"
                  required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('login') }}" class="underline text-sm text-gray-400 hover:text-white">
                {{ __('Already registered?') }}
            </a>

            <button type="submit"
                    class="rounded-md px-4 py-2 inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>
