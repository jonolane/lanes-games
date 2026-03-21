<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=My+Soul&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18]">
  {{-- Loader --}}
  <x-loader />
  
  {{-- Header --}}
  <header class="border-b border-[#3E3E3A] backdrop-blur">
    <div class="mx-auto max-w-5xl px-8 sm:px-10 h-16 flex items-center justify-between">
      <a href="{{ route('dashboard') }}" class="font-brand text-white font-medium text-xl sm:text-2xl">
        VOYAGE
      </a>

      @auth
      <div class="flex items-center gap-2 sm:gap-4">
        <a href="{{ route('games.create') }}"
          class="text-white h-10 w-10 sm:w-auto sm:h-auto sm:px-4 sm:py-2 grid sm:flex place-items-center sm:items-center sm:gap-2 rounded-sm border border-[#19140035] dark:border-[#3E3E3A]
           hover:border-[#1915014a] dark:hover:border-[#62605b]"
          aria-label="Add">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 sm:hidden">
              <path d="M12 5v14" />
              <path d="M5 12h14" />
          </svg>
          <span class="hidden sm:inline text-sm">New Game</span>
        </a>

        <div class="relative" x-data="{ open: false, isMobile: window.innerWidth < 1024 }"
          x-init="window.addEventListener('resize', () => isMobile = window.innerWidth < 1024)"
          @mouseenter="if (!isMobile) open = true"
          @mouseleave="if (!isMobile) open = false"
          @click.away="if (isMobile) open = false">
          <div class="flex items-center cursor-pointer group relative"
              @click="if (isMobile) open = !open">
              @if(auth()->user()->avatar)
              <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}"
                class="h-10 w-10 rounded-full object-cover border border-[#3E3E3A] group-hover:border-[#62605b] transition-colors" />
              @else
              <div class="h-10 w-10 rounded-full border border-[#3E3E3A] group-hover:border-[#62605b] flex items-center justify-center text-sm font-medium text-[#EDEDEC] bg-[#1f1f1f] transition-colors">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
              </div>
              @endif
              <svg class="h-3 w-3 text-[#A1A09A] absolute bottom-0.5 right-0.5 transition-transform duration-300 ease-out"
                :class="open ? 'rotate-90' : 'rotate-0'"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
              </svg>
        </div>

        <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
            x-cloak
            class="absolute right-0 mt-2 w-40 rounded-sm border border-[#3E3E3A]
                bg-[#161615] shadow-lg overflow-hidden">
            <a href="{{ route('profile.edit') }}"
            class="block px-4 py-2.5 text-sm text-[#EDEDEC] hover:bg-[#1f1f1f] transition-colors">
              Profile
            </a>
            <a href="{{ route('legal') }}"
              class="block px-4 py-2.5 text-sm text-[#EDEDEC] hover:bg-[#1f1f1f] transition-colors">
              Legal
            </a>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
              @csrf
              <button type="submit"
                    class="block w-full text-left px-4 py-2.5 text-sm text-[#EDEDEC] hover:bg-[#1f1f1f] transition-colors">
                Log Out
              </button>
            </form>
          </div>
        </div>
      </div>
      @endauth

      @guest
        <a href="{{ route('login') }}"
           class="inline-block px-4 py-1.5 border border-[#19140035] dark:border-[#3E3E3A]
                  rounded-sm text-sm text-[#1b1b18] dark:text-[#EDEDEC]
                  hover:border-[#1915014a] dark:hover:border-[#62605b]">
          Log in
        </a>
      @endguest
    </div>
  </header>

  {{-- Main --}}
    {{ $slot }}

  {{-- Footer (sticky, not fixed) --}}
  @auth
  <footer class="mt-auto border-t border-[#19140035] bg-white/90 backdrop-blur dark:bg-[#0a0a0a]/90">
    <div class="mx-auto max-w-5xl px-6">
        <div class="h-16 flex items-start justify-center pt-3">
            <span class="text-xs text-[#3E3E3A]">&copy; made with <span class="text-red-500">&hearts;</span> by Jono Lane</span>
        </div>
    </div>
  </footer>
  @endauth

<x-toast />
</body>
</html>
