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
    <div class="mx-auto max-w-5xl px-6 h-14 flex items-center justify-between">
      <a href="{{ url('/') }}" class="font-medium">Home</a>
      <form method="POST" action="{{ route('logout') }}" class="m-0">@csrf
        <button class="px-4 py-1.5 rounded-sm border border-[#19140035] hover:border-[#1915014a] transition">
          Log out
        </button>
      </form>
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
