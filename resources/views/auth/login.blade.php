<x-guest-layout>
    @if (session('toast'))
        <div x-data x-init="setTimeout(() => $dispatch('toast', { message: '{{ session('toast') }}', key: '{{ now()->timestamp }}' }), 300)"></div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div>
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-[#3E3E3A] bg-[#1f1f1f] text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-[#706f6c] dark:text-[#A1A09A]">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-white rounded-md focus:outline-none" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="space-y-2">
            <a href="{{ route('oauth.redirect', ['provider' => 'google']) }}" class="inline-flex w-full items-center justify-center rounded-sm px-4 py-2 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] text-sm leading-normal">
                Continue with Google
            </a>

            <!--
            <a href="{{ route('oauth.redirect', ['provider' => 'facebook']) }}" class="inline-flex w-full items-center justify-center rounded-sm px-4 py-2 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] text-sm leading-normal">
                Continue with Facebook
            </a>
            -->
        </div>
        <div class="text-center">
            <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-sm underline underline-offset-4 text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-white ms-1">
                Register
            </a>
        </div>
    </form>
</x-guest-layout>