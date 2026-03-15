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
  {{-- Header --}}
  <header class="border-b border-[#3E3E3A] backdrop-blur">
    <div class="mx-auto max-w-5xl px-8 sm:px-10 h-16 flex items-center justify-between">
      <a href="{{ route('dashboard') }}" class="font-brand text-white font-medium text-xl sm:text-2xl">
        LANE'S GAMES
      </a>

      @auth
        {{-- Plus icon button (replace href with your actual "create" route) --}}
        <a href="{{ route('games.create') }}"
           class="text-white h-10 w-10 grid place-items-center rounded-sm border border-[#19140035] dark:border-[#3E3E3A]
                  hover:border-[#1915014a] dark:hover:border-[#62605b]"
           aria-label="Add">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
            <path d="M12 5v14" />
            <path d="M5 12h14" />
          </svg>
        </a>
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
        <nav class="h-16 flex flex-nowrap items-center justify-center gap-12 text-base sm:text-lg">
            <a href="{{ route('profile.edit') }}"
               class="px-4 py-2 whitespace-nowrap hover:underline underline-offset-4 dark:text-[#EDEDEC]">
                Profile
            </a>

            <a href="{{ route('legal') }}"
               class="px-4 py-2 whitespace-nowrap hover:underline underline-offset-4 dark:text-[#EDEDEC]">
                Legal
            </a>

            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit"
                        class="px-4 py-2 whitespace-nowrap hover:underline underline-offset-4 dark:text-[#EDEDEC]">
                    Log Out
                </button>
            </form>
        </nav>
    </div>
</footer>
@endauth

<x-toast />
</body>
</html>
