<div x-data="{ loading: false }"
     x-init="
         document.addEventListener('click', (e) => {
             let link = e.target.closest('a[href]');
             if (link && link.href && !link.href.startsWith('javascript') && !link.hasAttribute('x-on:click') && link.target !== '_blank') {
                 setTimeout(() => loading = true, 300);
             }
         });
         document.querySelectorAll('form').forEach(f => {
             f.addEventListener('submit', () => {
                 setTimeout(() => loading = true, 300);
             });
         });
     "
     x-show="loading"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     style="display: none;"
     class="fixed inset-0 z-[9999] flex items-center justify-center bg-[#0a0a0a]">
    <svg class="animate-spin" width="180" height="180" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="44" stroke="white" stroke-width="3" fill="none"/>
        <circle cx="50" cy="50" r="36" stroke="white" stroke-width="2" fill="none"/>
        <circle cx="50" cy="50" r="10" stroke="white" stroke-width="2.5" fill="currentColor"/>
        <circle cx="50" cy="50" r="4" fill="white"/>
        @for ($i = 0; $i < 8; $i++)
            @php
                $angle = $i * 45;
                $rad = deg2rad($angle);
                $x1 = 50 + 10 * cos($rad);
                $y1 = 50 + 10 * sin($rad);
                $x2 = 50 + 36 * cos($rad);
                $y2 = 50 + 36 * sin($rad);
            @endphp
            <line x1="{{ $x1 }}" y1="{{ $y1 }}" x2="{{ $x2 }}" y2="{{ $y2 }}"
                  stroke="white" stroke-width="2.5" stroke-linecap="round"/>
        @endfor
        @for ($i = 0; $i < 8; $i++)
            @php
                $angle = $i * 45;
                $rad = deg2rad($angle);
                $cx = 50 + 44 * cos($rad);
                $cy = 50 + 44 * sin($rad);
                $hx = 50 + 50 * cos($rad);
                $hy = 50 + 50 * sin($rad);
            @endphp
            <line x1="{{ $cx }}" y1="{{ $cy }}" x2="{{ $hx }}" y2="{{ $hy }}"
                  stroke="white" stroke-width="2.5" stroke-linecap="round"/>
            <circle cx="{{ $hx }}" cy="{{ $hy }}" r="3" fill="white"/>
        @endfor
    </svg>
</div>