<div id="page-loader"
     style="display: none; position: fixed; inset: 0; z-index: 9999; align-items: center; justify-content: center; background: #0a0a0a;"
     class="loader-target">
    <svg class="animate-spin" width="200" height="200" viewBox="0 0 160 160" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="80" cy="80" r="40" stroke="white" stroke-width="3.5" fill="none"/>
        <circle cx="80" cy="80" r="32" stroke="white" stroke-width="2" fill="none"/>
        <circle cx="80" cy="80" r="10" stroke="white" stroke-width="2.5" fill="#0a0a0a"/>
        <circle cx="80" cy="80" r="4" fill="white"/>
        @for ($i = 0; $i < 8; $i++)
            @php
                $angle = $i * 45;
                $rad = deg2rad($angle);
                $x1 = 80 + 10 * cos($rad);
                $y1 = 80 + 10 * sin($rad);
                $x2 = 80 + 48 * cos($rad);
                $y2 = 80 + 48 * sin($rad);
            @endphp
            <line x1="{{ $x1 }}" y1="{{ $y1 }}" x2="{{ $x2 }}" y2="{{ $y2 }}"
                  stroke="white" stroke-width="3" stroke-linecap="round"/>
        @endfor
        @for ($i = 0; $i < 8; $i++)
            <g transform="translate(80,80) rotate({{ $i * 45 }})">
                <rect x="48" y="-3" width="8" height="6" rx="3" fill="white"/>
                <circle cx="57" cy="0" r="2.5" fill="white"/>
            </g>
        @endfor
    </svg>
</div>
<script>
    (function() {
        var loader = document.getElementById('page-loader');
        var timer = null;

        document.addEventListener('click', function(e) {
            var link = e.target.closest('a[href]');
            if (link && link.href && !link.href.startsWith('javascript') && !link.hasAttribute('x-on:click') && link.target !== '_blank') {
                timer = setTimeout(function() {
                    loader.style.display = 'flex';
                }, 300);
            }
        });

        document.querySelectorAll('form').forEach(function(f) {
            f.addEventListener('submit', function() {
                timer = setTimeout(function() {
                    loader.style.display = 'flex';
                }, 300);
            });
        });

        window.addEventListener('pageshow', function() {
            clearTimeout(timer);
            loader.style.display = 'none';
        });
    })();
</script>