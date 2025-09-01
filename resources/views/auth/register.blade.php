<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-3">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-white mb-1" />
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="block w-full rounded-md px-3 py-2 border-0
                          bg-[#2b2b2b] text-white
                          focus:ring-2 focus:ring-indigo-500" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white mb-1" />
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="block w-full rounded-md px-3 py-2 border-0
                          bg-[#2b2b2b] text-white
                          focus:ring-2 focus:ring-indigo-500" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-white mb-1" />
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="block w-full rounded-md px-3 py-2 border-0
                          bg-[#2b2b2b] text-white
                          focus:ring-2 focus:ring-indigo-500" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white mb-1" />
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="block w-full rounded-md px-3 py-2 border-0
                          bg-[#2b2b2b] text-white
                          focus:ring-2 focus:ring-indigo-500" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('login') }}" class="underline text-sm text-gray-400 hover:text-white">
                {{ __('Already registered?') }}
            </a>

            <button type="submit"
                    class="rounded-md px-4 py-2
                           bg-[#2b2b2b] hover:bg-[#3a3a3a]
                           text-white focus:ring-2 focus:ring-indigo-500">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>
