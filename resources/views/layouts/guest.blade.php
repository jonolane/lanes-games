<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Match welcome font + assets -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex items-center justify-center p-6">
  <main class="w-full max-w-[335px] sm:max-w-md">
    {{-- card wrapper --}}
    <div class="bg-white dark:bg-[#161615] dark:text-[#EDEDEC]
                rounded-sm shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
                dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] p-6">
      {{ $slot }}
    </div>
  </main>
</body>
</html>

