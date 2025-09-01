<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18]">
  <header class="border-b border-[#19140035] bg-white/70 backdrop-blur">
  <div class="mx-auto max-w-5xl px-6 h-14 flex items-center justify-between" x-data="{ open:false }">
    <a href="{{ url('/') }}" class="text-white font-medium">Lane's Games</a>

        @auth
        <div class="relative">
            <button @click="open = !open" @keydown.escape.window="open = false" class="h-10 w-10 me-1 rounded-full ring-1 ring-black/10 dark:ring-white/10 grid place-items-center overflow-hidden" aria-haspopup="menu" :aria-expanded="open">
            @if(Auth::user()->avatar)
            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }} avatar" class="h-full w-full object-cover object-center" />
            @else
            <span class="text-sm font-medium text-white/90 bg-[#3b3b3b] h-full w-full grid place-items-center">
                {{ strtoupper(substr(trim(Auth::user()->name ?? 'U'), 0, 1)) }}
            </span>
            @endif
            </button>


        <div x-cloak x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-44 rounded-md border border-black/10 dark:border-white/10 bg-white dark:bg-[#161615] shadow-lg" role="menu">
            <a href="{{ route('profile.edit') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal" role="menuitem">
                    Profile
            </a>

            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal" role="menuitem">
                    Log out
                </button>
            </form>
        </div>
        </div>
        @endauth

        @guest
        <a href="{{ route('login') }}" class="inline-block px-4 py-1.5 border border-[#19140035] dark:border-[#3E3E3A] rounded-sm text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:border-[#1915014a] dark:hover:border-[#62605b]">
            Log in
        </a>
        @endguest
    </div>
    </header>


  <main class="min-h-[calc(100vh-3.5rem)] flex items-center justify-center p-6">
    <div class="w-full max-w-[335px] sm:max-w-xl">
      {{-- Optional card to mirror welcome style --}}
      <div class="bg-white dark:bg-[#161615] dark:text-[#EDEDEC]
                  rounded-sm shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
                  dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] p-6">
        {{ $slot }}
      </div>
    </div>
  </main>
</body>
</html>
