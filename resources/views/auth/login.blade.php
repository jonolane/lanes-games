<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="bg-white dark:bg-[#161615] dark:text-[#EDEDEC]
            shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
            dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
            rounded-sm p-6 w-full max-w-md">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="bg-white dark:bg-[#161615] dark:text-[#EDEDEC]
            shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
            dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
            rounded-sm p-6 w-full max-w-md">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="bg-white dark:bg-[#161615] dark:text-[#EDEDEC]
            shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
            dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
            rounded-sm p-6 w-full max-w-md block">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="bg-white dark:bg-[#161615] dark:text-[#EDEDEC]
            shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
            dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
            rounded-sm p-6 flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="space-y-2 mt-4">
            <a href="{{ route('oauth.redirect', ['provider' => 'google']) }}" class="inline-flex w-full items-center justify-center rounded-sm px-4 py-2 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                Continue with Google
            </a>

            <a href="{{ route('oauth.redirect', ['provider' => 'facebook']) }}" class="inline-flex w-full items-center justify-center rounded-sm px-4 py-2 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                Continue with Facebook
            </a>
        </div>

    </form>
</x-guest-layout>
