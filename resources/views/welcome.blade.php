<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Voyage</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=My+Soul&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen flex items-center justify-center bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] p-6">
    <x-loader />

    <div id="stars" class="fixed inset-0 pointer-events-none z-0"></div>

    <div class="flex flex-col items-center z-10 relative">
        <h1 class="font-brand text-white text-6xl sm:text-8xl lg:text-9xl mb-14 sm:mb-10 lg:mb-12 text-center break-words">VOYAGE</h1>
        <div class="w-full max-w-sm sm:max-w-2xl lg:max-w-4xl mb-16 sm:mb-12 lg:mb-14">
            <x-ship />
        </div>
        <div class="flex flex-col sm:flex-row gap-5 sm:gap-4 w-full max-w-sm sm:max-w-none sm:w-auto">
            <a href="{{ route('login') }}"
                class="inline-block px-10 py-4 sm:px-12 sm:py-4 md:px-16 md:py-5 md:text-lg sm:text-base lg:px-12 lg:py-4 lg:text-base rounded-sm border border-[#3E3E3A] bg-[#151515] text-white text-base text-center
                transition-all duration-200 hover:bg-[#134e45] hover:border-[#2dd4a8] active:bg-[#0f3d36]">
                Log In
            </a>
            <a href="#"
                class="inline-block px-10 py-4 sm:px-12 sm:py-4 md:px-16 md:py-5 md:text-lg sm:text-base lg:px-12 lg:py-4 lg:text-base rounded-sm border border-[#3E3E3A] bg-transparent text-base text-[#A1A09A] text-center
                transition-all duration-200 hover:bg-[#133050] hover:border-[#2da8d4] hover:text-white active:bg-[#0f2840]">
                Enter as Guest
            </a>
        </div>
    </div>

    <script>
        const container = document.getElementById('stars');
        const w = window.innerWidth;
        const interval = w < 640 ? 800 : w < 1024 ? 500 : 250;
        const initial = w < 640 ? 8 : w < 1024 ? 15 : 25;

        function createStar() {
            const star = document.createElement('div');
            const size = Math.random() * 4 + 2;
            const rotation = Math.random() * 360;
            star.innerHTML = `<svg width="${size * 3}" height="${size * 3}" viewBox="0 0 24 24" fill="white">
                <path d="M12 0L14.5 8.5L24 12L14.5 15.5L12 24L9.5 15.5L0 12L9.5 8.5Z" transform="rotate(${rotation} 12 12)"/>
            </svg>`;
            star.style.cssText = `
                position: absolute;
                left: ${Math.random() * 100}%;
                top: ${Math.random() * 100}%;
                opacity: 0;
                transition: opacity ${Math.random() * 1 + 0.5}s ease-in-out;
            `;
            container.appendChild(star);
            requestAnimationFrame(() => {
                star.style.opacity = Math.random() * 0.6 + 0.1;
            });
            setTimeout(() => {
                star.style.opacity = 0;
                setTimeout(() => star.remove(), 1500);
            }, Math.random() * 3000 + 1000);
        }
        setInterval(createStar, interval);
        for (let i = 0; i < initial; i++) setTimeout(createStar, Math.random() * 2000);
    </script>
</body>
</html>