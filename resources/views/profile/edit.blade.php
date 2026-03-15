<x-app-layout>
    <div class="grid place-items-center min-h-[calc(100vh-8rem)] p-6">
        <div class="w-full max-w-md space-y-4">
            @if (session('toast'))
                <div x-data x-init="setTimeout(() => $dispatch('toast', { message: '{{ session('toast') }}', key: '{{ now()->timestamp }}' }), 300)"></div>
            @endif

            @include('profile.partials.update-profile-information-form')

            @unless(auth()->user()->provider_name)
                @include('profile.partials.update-password-form')
            @endunless

            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>