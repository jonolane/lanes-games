<style>
    @keyframes rock { 0%,100%{transform:rotate(-1.2deg) translateY(0)} 50%{transform:rotate(1.2deg) translateY(-4px)} }
    @keyframes wd1 { 0%,100%{transform:translateX(0)} 50%{transform:translateX(-8px)} }
    @keyframes wd2 { 0%,100%{transform:translateX(0)} 50%{transform:translateX(6px)} }
    @keyframes wd3 { 0%,100%{transform:translateX(0)} 50%{transform:translateX(-5px)} }
    @keyframes wd4 { 0%,100%{transform:translateX(0)} 50%{transform:translateX(7px)} }
    @keyframes wd5 { 0%,100%{transform:translateX(0)} 50%{transform:translateX(-4px)} }
    .ship-rock{animation:rock 4.5s ease-in-out infinite;transform-origin:340px 330px}
    .sw1{animation:wd1 3s ease-in-out infinite}
    .sw2{animation:wd2 3.5s ease-in-out infinite .4s}
    .sw3{animation:wd3 2.8s ease-in-out infinite .8s}
    .sw4{animation:wd4 3.2s ease-in-out infinite .6s}
    .sw5{animation:wd5 3.8s ease-in-out infinite .2s}
</style>
<svg {{ $attributes->merge(['class' => '']) }} width="100%" viewBox="0 0 680 400" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g class="ship-rock">
        {{-- Hull --}}
        <path d="M150,310 Q250,310 340,310 Q430,310 520,310 Q500,345 460,360 Q400,378 340,380 Q280,378 220,360 Q180,345 150,310 Z" stroke="white" stroke-width="4" fill="none" stroke-linejoin="round"/>
        <path d="M180,325 Q270,335 340,337 Q410,335 480,325" stroke="#5ba8c8" stroke-width="2" fill="none" opacity="0.35"/>
        <circle cx="250" cy="330" r="6" stroke="#c8a86e" stroke-width="3" fill="none"/>
        <circle cx="310" cy="335" r="6" stroke="#c8a86e" stroke-width="3" fill="none"/>
        <circle cx="370" cy="335" r="6" stroke="#c8a86e" stroke-width="3" fill="none"/>
        <circle cx="430" cy="330" r="6" stroke="#c8a86e" stroke-width="3" fill="none"/>

        {{-- Masts --}}
        <line x1="340" y1="55" x2="340" y2="310" stroke="white" stroke-width="4.5" stroke-linecap="round"/>
        <line x1="255" y1="100" x2="255" y2="310" stroke="white" stroke-width="4" stroke-linecap="round"/>
        <line x1="430" y1="115" x2="430" y2="310" stroke="white" stroke-width="4" stroke-linecap="round"/>

        {{-- Main mast sails - warm cream filled --}}
        <path d="M260,160 L340,160 L340,65 Q320,100 260,160 Z" fill="#e8d5b5" fill-opacity="0.15" stroke="#e8d5b5" stroke-width="3.5" stroke-linejoin="round"/>
        <path d="M265,260 L340,260 L340,170 Q325,205 265,260 Z" fill="#e8d5b5" fill-opacity="0.15" stroke="#e8d5b5" stroke-width="3.5" stroke-linejoin="round"/>

        {{-- Left mast sails - soft coral filled --}}
        <path d="M175,192 L255,192 L255,108 Q233,140 175,192 Z" fill="#d4a090" fill-opacity="0.15" stroke="#d4a090" stroke-width="3.5" stroke-linejoin="round"/>
        <path d="M180,280 L255,280 L255,202 Q235,230 180,280 Z" fill="#d4a090" fill-opacity="0.15" stroke="#d4a090" stroke-width="3.5" stroke-linejoin="round"/>

        {{-- Right mast sails - soft seafoam filled --}}
        <path d="M355,210 L430,210 L430,123 Q410,160 355,210 Z" fill="#8ac4b0" fill-opacity="0.15" stroke="#8ac4b0" stroke-width="3.5" stroke-linejoin="round"/>
        <path d="M360,298 L430,298 L430,220 Q413,250 360,298 Z" fill="#8ac4b0" fill-opacity="0.15" stroke="#8ac4b0" stroke-width="3.5" stroke-linejoin="round"/>

        {{-- Flag - filled shape with sun --}}
        <g transform="translate(340,55)">
            <line x1="0" y1="0" x2="0" y2="-30" stroke="white" stroke-width="3" stroke-linecap="round"/>
            <path fill="none" stroke="white" stroke-width="2" stroke-linejoin="round">
                <animate attributeName="d" values="M0,-30 Q14,-34 28,-30 Q42,-26 50,-30 L50,-8 Q42,-4 28,-8 Q14,-12 0,-8 Z;M0,-30 Q14,-26 28,-30 Q42,-34 50,-30 L50,-8 Q42,-12 28,-8 Q14,-4 0,-8 Z;M0,-30 Q14,-34 28,-30 Q42,-26 50,-30 L50,-8 Q42,-4 28,-8 Q14,-12 0,-8 Z" dur="1.8s" repeatCount="indefinite"/>
            </path>
            {{-- Sun on flag --}}
            <circle cx="25" r="4" stroke="#f0c65a" stroke-width="1.8" fill="#f0c65a" fill-opacity="0.3">
                <animate attributeName="cy" values="-19;-19;-19" dur="1.8s" repeatCount="indefinite"/>
            </circle>
            <line x1="25" y1="-26" x2="25" y2="-28" stroke="#f0c65a" stroke-width="1.2" stroke-linecap="round"/>
            <line x1="25" y1="-12" x2="25" y2="-10" stroke="#f0c65a" stroke-width="1.2" stroke-linecap="round"/>
            <line x1="18" y1="-19" x2="16" y2="-19" stroke="#f0c65a" stroke-width="1.2" stroke-linecap="round"/>
            <line x1="32" y1="-19" x2="34" y2="-19" stroke="#f0c65a" stroke-width="1.2" stroke-linecap="round"/>
            <line x1="20" y1="-24" x2="18.5" y2="-25.5" stroke="#f0c65a" stroke-width="1.2" stroke-linecap="round"/>
            <line x1="30" y1="-14" x2="31.5" y2="-12.5" stroke="#f0c65a" stroke-width="1.2" stroke-linecap="round"/>
            <line x1="30" y1="-24" x2="31.5" y2="-25.5" stroke="#f0c65a" stroke-width="1.2" stroke-linecap="round"/>
            <line x1="20" y1="-14" x2="18.5" y2="-12.5" stroke="#f0c65a" stroke-width="1.2" stroke-linecap="round"/>
        </g>
    </g>

    {{-- Water --}}
    <g class="sw1" opacity="0.6">
        <path d="M155,370 Q165,363 175,370 L185,361 L195,370" stroke="#4a9ec4" stroke-width="2.5" fill="none" stroke-linejoin="round"/>
    </g>
    <g class="sw2" opacity="0.5">
        <path d="M440,369 L452,361 Q460,369 468,361 L476,369 L484,360 L492,369" stroke="#3d8db5" stroke-width="2.5" fill="none" stroke-linejoin="round"/>
    </g>
    <g class="sw3" opacity="0.45">
        <path d="M215,375 L225,368 L235,375 Q243,368 251,375" stroke="#5bb8d8" stroke-width="2.5" fill="none" stroke-linejoin="round"/>
    </g>
    <g class="sw4" opacity="0.3">
        <path d="M380,380 Q392,374 404,380 L416,373 Q426,380 436,373" stroke="#4a9ec4" stroke-width="2" fill="none" stroke-linejoin="round"/>
    </g>
    <g class="sw5" opacity="0.25">
        <path d="M270,384 L280,379 L290,384 L300,378" stroke="#3d8db5" stroke-width="2" fill="none" stroke-linejoin="round"/>
    </g>
    <g class="sw1" opacity="0.18">
        <path d="M130,378 L140,372 L150,378" stroke="#5bb8d8" stroke-width="1.8" fill="none" stroke-linejoin="round"/>
    </g>
    <g class="sw3" opacity="0.15">
        <path d="M500,377 L510,372 L520,377 L530,371 L540,377" stroke="#4a9ec4" stroke-width="1.8" fill="none" stroke-linejoin="round"/>
    </g>
    <g class="sw2" opacity="0.12">
        <path d="M340,392 L350,388 L360,392 Q368,388 376,392" stroke="#3d8db5" stroke-width="1.5" fill="none" stroke-linejoin="round"/>
    </g>
</svg>