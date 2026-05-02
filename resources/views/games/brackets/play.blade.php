<x-app-layout>
    <style>
        @keyframes titleReveal {
            0% { opacity: 0; transform: scale(0.7); }
            50% { opacity: 1; transform: scale(1.08); }
            100% { opacity: 1; transform: scale(1); }
        }
        @keyframes fadeSlideUp {
            0% { opacity: 0; transform: translateY(12px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 8px rgba(234, 179, 8, 0.3); }
            50% { box-shadow: 0 0 20px rgba(234, 179, 8, 0.6); }
        }
        @keyframes crownDrop {
            0% { opacity: 0; transform: translateY(-60px) rotate(-10deg); }
            60% { opacity: 1; transform: translateY(4px) rotate(3deg); }
            80% { transform: translateY(-2px) rotate(-1deg); }
            100% { opacity: 1; transform: translateY(0) rotate(0deg); }
        }
        @keyframes crownShine {
            0% { opacity: 0; }
            30% { opacity: 1; }
            100% { opacity: 0; transform: scale(1.5); }
        }
        @keyframes starBurst {
            0% { opacity: 1; transform: scale(0) rotate(0deg); }
            50% { opacity: 1; }
            100% { opacity: 0; transform: scale(1) rotate(180deg); }
        }
        @keyframes winnerTextReveal {
            0% { opacity: 0; transform: translateY(20px); letter-spacing: 0.3em; }
            100% { opacity: 1; transform: translateY(0); letter-spacing: 0.05em; }
        }
        @keyframes goldenPulse {
            0%, 100% { text-shadow: 0 0 10px rgba(234, 179, 8, 0.3); }
            50% { text-shadow: 0 0 30px rgba(234, 179, 8, 0.6), 0 0 60px rgba(234, 179, 8, 0.2); }
        }
        @keyframes jewelSparkle {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }
        .match-active { animation: pulseGlow 2s ease-in-out infinite; }
        .bracket-slot { 
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); 
        }
        .bracket-slot.dimmed { opacity: 0.3; }
        .bracket-slot.eliminated {
            opacity: 0.25;
        }
        .bracket-slot.advanced {
            border-color: rgba(234, 179, 8, 0.5) !important;
            color: #eab308 !important;
        }
        .jewel-sparkle { animation: jewelSparkle 2s ease-in-out infinite; }
        @media (min-width: 768px) {
            .bracket-slot {
                width: 11rem !important;
                padding: 0.5rem 0.75rem !important;
                font-size: 0.8rem !important;
            }
        }
        @media (min-width: 1280px) {
            .bracket-slot {
                width: 11rem !important;
                padding: 0.5rem !important;
                font-size: 0.875rem !important;
            }
        }
    </style>

    <div class="min-h-[calc(100vh-8rem)] px-1 py-2 sm:p-4 flex flex-col"
         x-data="bracketGame()"
         x-cloak>

        {{-- INTRO OVERLAY --}}
        <div x-show="phase === 'intro'"
             x-transition:leave="transition ease-in duration-500"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center bg-[#0a0a0a]">
            <div class="text-center">
                <h1 class="font-brand text-5xl sm:text-7xl text-white mb-4"
                    style="animation: titleReveal 1.2s ease-out forwards">
                    {{ $userGame->title }}
                </h1>
                <p class="text-[#A1A09A] text-sm sm:text-base"
                   style="animation: fadeSlideUp 0.8s ease-out 0.8s both">
                    <span x-text="seeds.length"></span> entries · <span x-text="totalRounds"></span> rounds
                </p>
                <p class="text-[#A1A09A] text-xs mt-2"
                   style="animation: fadeSlideUp 0.8s ease-out 1.2s both">
                    Tournament Bracket
                </p>
            </div>
        </div>

        {{-- WINNER OVERLAY --}}
        <div x-show="phase === 'winner'"
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="fixed inset-0 z-50 flex items-center justify-center bg-[#0a0a0a]/95">
            <div class="text-center relative" style="min-width: 300px; min-height: 400px;">
                {{-- Crown SVG --}}
                <div class="mb-6" style="animation: crownDrop 1s ease-out 0.3s both">
                    <svg width="140" height="120" viewBox="0 0 140 120" fill="none" class="mx-auto">
                        {{-- Crown base band --}}
                        <path d="M25,85 Q30,90 70,92 Q110,90 115,85 L115,95 Q110,100 70,102 Q30,100 25,95 Z"
                              fill="#eab308" fill-opacity="0.25" stroke="#eab308" stroke-width="1.5"/>
                        <path d="M22,95 Q30,100 70,103 Q110,100 118,95 L118,103 Q110,108 70,110 Q30,108 22,103 Z"
                              fill="#eab308" fill-opacity="0.15" stroke="#eab308" stroke-width="1.5"/>
                        {{-- Crown body --}}
                        <path d="M25,85 L15,40 L40,60 L55,20 L70,55 L85,20 L100,60 L125,40 L115,85 Q110,90 70,92 Q30,90 25,85 Z"
                              fill="#eab308" fill-opacity="0.12" stroke="#eab308" stroke-width="2" stroke-linejoin="round"/>
                        {{-- Inner crown lines --}}
                        <path d="M30,82 L22,48 L42,63 L55,28 L70,58 L85,28 L98,63 L118,48 L110,82"
                              stroke="#eab308" stroke-width="0.8" fill="none" opacity="0.3"/>
                        {{-- Jewels at points --}}
                        <circle cx="55" cy="20" r="5" fill="#ef4444" fill-opacity="0.7" stroke="#eab308" stroke-width="1.5"/>
                        <circle cx="55" cy="20" r="2" fill="white" fill-opacity="0.4" class="jewel-sparkle"/>
                        <circle cx="70" cy="55" r="5" fill="#3b82f6" fill-opacity="0.7" stroke="#eab308" stroke-width="1.5"/>
                        <circle cx="70" cy="55" r="2" fill="white" fill-opacity="0.4" class="jewel-sparkle" style="animation-delay: 0.3s"/>
                        <circle cx="85" cy="20" r="5" fill="#10b981" fill-opacity="0.7" stroke="#eab308" stroke-width="1.5"/>
                        <circle cx="85" cy="20" r="2" fill="white" fill-opacity="0.4" class="jewel-sparkle" style="animation-delay: 0.6s"/>
                        {{-- Jewels on band --}}
                        <circle cx="45" cy="89" r="3.5" fill="#8b5cf6" fill-opacity="0.7" stroke="#eab308" stroke-width="1"/>
                        <circle cx="45" cy="89" r="1.5" fill="white" fill-opacity="0.3" class="jewel-sparkle" style="animation-delay: 0.9s"/>
                        <circle cx="70" cy="91" r="4" fill="#ef4444" fill-opacity="0.7" stroke="#eab308" stroke-width="1"/>
                        <circle cx="70" cy="91" r="1.5" fill="white" fill-opacity="0.3" class="jewel-sparkle" style="animation-delay: 0.4s"/>
                        <circle cx="95" cy="89" r="3.5" fill="#3b82f6" fill-opacity="0.7" stroke="#eab308" stroke-width="1"/>
                        <circle cx="95" cy="89" r="1.5" fill="white" fill-opacity="0.3" class="jewel-sparkle" style="animation-delay: 0.7s"/>
                        {{-- Top point ornaments --}}
                        <circle cx="15" cy="40" r="3" fill="#eab308" fill-opacity="0.5" stroke="#eab308" stroke-width="1"/>
                        <circle cx="125" cy="40" r="3" fill="#eab308" fill-opacity="0.5" stroke="#eab308" stroke-width="1"/>
                    </svg>
                </div>
                {{-- Shine burst --}}
                <div class="absolute top-0 left-1/2 -translate-x-1/2" style="animation: crownShine 1.5s ease-out 1s both">
                    <div class="w-40 h-40 rounded-full" style="background: radial-gradient(circle, rgba(234,179,8,0.3) 0%, transparent 70%);"></div>
                </div>
                {{-- Star bursts --}}
                <template x-for="i in 8" :key="i">
                    <div class="absolute"
                         :style="'top: ' + (10 + Math.random()*70) + '%; left: ' + (5 + Math.random()*90) + '%; animation: starBurst 1s ease-out ' + (0.5 + i*0.15) + 's both;'">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="#eab308">
                            <polygon points="8,0 10,6 16,8 10,10 8,16 6,10 0,8 6,6"/>
                        </svg>
                    </div>
                </template>

                <h1 class="text-4xl sm:text-6xl font-semibold text-white mb-4 relative z-10"
                    style="animation: winnerTextReveal 1s ease-out 1.4s both"
                    x-text="winner"></h1>
                <p class="text-[#eab308] text-sm relative z-10 mb-8"
                   style="animation: goldenPulse 3s ease-in-out 2s infinite, fadeSlideUp 0.6s ease-out 1.8s both">
                    &#9733; Champion &#9733;
                </p>

                <div class="flex gap-3 justify-center relative z-10"
                     style="animation: fadeSlideUp 0.6s ease-out 2.2s both">
                    <button @click="resetGame()"
                            class="rounded-sm border border-[#3E3E3A] bg-[#1f1f1f] text-white px-5 py-2 text-sm
                                   transition-all duration-200 hover:bg-[#2a2a2a] hover:border-[#62605b]">
                        Play Again
                    </button>
                    <a href="{{ route('games.brackets.edit', $userGame) }}"
                       class="rounded-sm border border-[#3E3E3A] px-5 py-2 text-sm text-[#A1A09A]
                              transition-all duration-200 hover:border-[#62605b] hover:text-white">
                        Edit
                    </a>
                    <a href="{{ route('dashboard') }}"
                       class="rounded-sm border border-[#3E3E3A] px-5 py-2 text-sm text-[#A1A09A]
                              transition-all duration-200 hover:border-[#62605b] hover:text-white">
                        Dashboard
                    </a>
                </div>
            </div>
        </div>

        {{-- FINALS VIEW (mobile/tablet only) --}}
        <div x-show="phase === 'finals'" class="flex-1 flex flex-col xl:hidden">
            <div class="text-center">
                <h2 class="text-xl sm:text-2xl font-medium text-[#EDEDEC]">{{ $userGame->title }}</h2>
                <p class="text-xs text-[#A1A09A] mt-1">Finals</p>
            </div>
            <div class="flex-1 flex items-center justify-center">
                <div class="flex flex-col items-center gap-10 w-full max-w-sm px-4">
                    <button @click="pickFinal(0)"
                            :class="{
                                'match-active': finalsResult === null,
                                'hover:border-[#eab308] hover:bg-[#eab308]/5 cursor-pointer': finalsResult === null,
                                'eliminated': finalsResult !== null && finalsResult !== 0,
                                'advanced': finalsResult === 0
                            }"
                            class="text-center rounded-sm border border-[#3E3E3A] bg-[#161615] text-[#EDEDEC] font-medium transition-all w-full px-6 py-4 text-base md:py-12 md:text-3xl md:px-16 xl:py-4 xl:text-base xl:px-6"
                            x-text="finals[0] || '—'">
                    </button>

                    <div class="flex items-center gap-3 w-full">
                        <div class="flex-1 h-px bg-[#3E3E3A]"></div>
                        <span class="text-xs font-medium text-[#A1A09A]">VS</span>
                        <div class="flex-1 h-px bg-[#3E3E3A]"></div>
                    </div>

                    <button @click="pickFinal(1)"
                            :class="{
                                'match-active': finalsResult === null,
                                'hover:border-[#eab308] hover:bg-[#eab308]/5 cursor-pointer': finalsResult === null,
                                'eliminated': finalsResult !== null && finalsResult !== 1,
                                'advanced': finalsResult === 1
                            }"
                            class="text-center rounded-sm border border-[#3E3E3A] bg-[#161615] text-[#EDEDEC] font-medium transition-all w-full px-6 py-4 text-base md:py-12 md:text-3xl md:px-16 xl:py-4 xl:text-base xl:px-6"
                            x-text="finals[1] || '—'">
                    </button>
                </div>
            </div>
        </div>

        {{-- BRACKET VIEW --}}
        <div x-show="phase === 'playing' || (phase === 'finals' && isDesktop)" class="flex-1 flex flex-col"
             :class="{ 'hidden xl:flex': phase === 'finals' }">

            {{-- Title bar --}}
            <div class="text-center mb-4">
                <h2 class="text-lg sm:text-xl lg:text-2xl font-medium text-[#EDEDEC]">{{ $userGame->title }}</h2>
                <p class="text-xs text-[#A1A09A] mt-1">
                    Round <span x-text="currentRoundDisplay"></span> · <span x-text="currentSideDisplay"></span> side
                </p>
            </div>

            {{-- Mobile/Tablet: Side toggle --}}
            <div class="flex xl:hidden justify-center gap-2 mb-4">
                <button @click="mobileView = 'left'"
                        :class="mobileView === 'left' ? 'border-[#eab308] text-[#eab308]' : 'border-[#3E3E3A] text-[#A1A09A]'"
                        class="px-4 py-1.5 lg:px-6 lg:py-2 text-xs lg:text-sm rounded-sm border transition-all">
                    Left Bracket
                </button>
                <button @click="mobileView = 'right'"
                        :class="mobileView === 'right' ? 'border-[#eab308] text-[#eab308]' : 'border-[#3E3E3A] text-[#A1A09A]'"
                        class="px-4 py-1.5 lg:px-6 lg:py-2 text-xs lg:text-sm rounded-sm border transition-all">
                    Right Bracket
                </button>
            </div>

            {{-- Bracket Grid --}}
            <div class="flex-1 flex items-stretch justify-center overflow-hidden px-4 sm:px-8 md:px-12 lg:px-16 xl:px-0">
                <div class="flex items-stretch gap-1 sm:gap-2 md:gap-5 lg:gap-8 xl:gap-6 w-full xl:w-auto">

                    {{-- LEFT SIDE --}}
                    <template x-for="(round, ri) in leftRounds" :key="'L'+ri">
                        <div class="flex flex-col justify-around flex-1 items-center xl:items-start"
                            :class="{ 'hidden xl:flex': mobileView !== 'left' }">
                            <template x-for="(match, mi) in round" :key="'L'+ri+'-'+mi">
                                <div class="flex flex-col gap-1" :style="'margin: ' + (ri * 8) + 'px 0'">
                                    <template x-for="(entry, ei) in match" :key="'L'+ri+'-'+mi+'-'+ei">
                                        <button
                                            @click="pickEntry('left', ri, mi, ei)"
                                            :disabled="!isActiveMatch('left', ri, mi)"
                                            :class="{
                                                'match-active': isActiveMatch('left', ri, mi),
                                                'dimmed': phase === 'playing' && !isActiveMatch('left', ri, mi) && !isCompleted('left', ri, mi),
                                                'eliminated': isEliminated('left', ri, mi, ei),
                                                'advanced': isAdvanced('left', ri, mi, ei),
                                                'hover:border-[#eab308] hover:bg-[#eab308]/5 cursor-pointer': isActiveMatch('left', ri, mi),
                                                'cursor-default': !isActiveMatch('left', ri, mi)
                                            }"
                                            class="bracket-slot w-24 xl:w-44 px-2 py-2 xl:px-2 xl:py-2 text-[11px] xl:text-sm text-left rounded-sm border border-[#3E3E3A] bg-[#161615] text-[#EDEDEC] truncate disabled:cursor-default transition-all"
                                            x-text="entry || '—'">
                                        </button>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </template>

                    {{-- FINALS (desktop only) --}}
                    <div class="hidden xl:flex flex-col items-center justify-center gap-4 mx-2 sm:mx-4">
                        <div class="flex flex-col gap-1">
                            <template x-for="(entry, ei) in finals" :key="'F-'+ei">
                                <button
                                    @click="pickFinal(ei)"
                                    :disabled="!isFinalsActive()"
                                    :class="{
                                        'match-active': isFinalsActive(),
                                        'hover:border-[#eab308] hover:bg-[#eab308]/5 cursor-pointer': isFinalsActive(),
                                        'eliminated': isFinalEliminated(ei),
                                        'advanced': isFinalAdvanced(ei),
                                        'cursor-default': !isFinalsActive()
                                    }"
                                    class="bracket-slot w-24 xl:w-44 px-2 py-2 xl:px-2 xl:py-2 text-[11px] xl:text-sm text-left rounded-sm border border-[#3E3E3A] bg-[#161615] text-[#EDEDEC] truncate disabled:cursor-default transition-all"
                                    x-text="entry || '—'">
                                </button>
                            </template>
                        </div>
                        <div class="text-[10px] text-[#A1A09A] uppercase tracking-widest">Finals</div>
                    </div>

                    {{-- RIGHT SIDE (reversed display) --}}
                    <template x-for="(round, ri) in rightRoundsReversed" :key="'R'+ri">
                        <div class="flex flex-col justify-around flex-1 items-center xl:items-start"
                            :class="{ 'hidden xl:flex': mobileView !== 'right' }">
                            <template x-for="(match, mi) in round" :key="'R'+ri+'-'+mi">
                                <div class="flex flex-col gap-1" :style="'margin: ' + ((rightRoundsReversed.length - 1 - ri) * 8) + 'px 0'">
                                    <template x-for="(entry, ei) in match" :key="'R'+ri+'-'+mi+'-'+ei">
                                        <button
                                            @click="pickEntry('right', rightRoundsReversed.length - 1 - ri, mi, ei)"
                                            :disabled="!isActiveMatch('right', rightRoundsReversed.length - 1 - ri, mi)"
                                            :class="{
                                                'match-active': isActiveMatch('right', rightRoundsReversed.length - 1 - ri, mi),
                                                'dimmed': phase === 'playing' && !isActiveMatch('right', rightRoundsReversed.length - 1 - ri, mi) && !isCompleted('right', rightRoundsReversed.length - 1 - ri, mi),
                                                'eliminated': isEliminated('right', rightRoundsReversed.length - 1 - ri, mi, ei),
                                                'advanced': isAdvanced('right', rightRoundsReversed.length - 1 - ri, mi, ei),
                                                'hover:border-[#eab308] hover:bg-[#eab308]/5 cursor-pointer': isActiveMatch('right', rightRoundsReversed.length - 1 - ri, mi),
                                                'cursor-default': !isActiveMatch('right', rightRoundsReversed.length - 1 - ri, mi)
                                            }"
                                            class="bracket-slot w-24 xl:w-44 px-2 py-2 xl:px-2 xl:py-2 text-[11px] xl:text-sm text-left rounded-sm border border-[#3E3E3A] bg-[#161615] text-[#EDEDEC] truncate disabled:cursor-default transition-all"
                                            x-text="entry || '—'">
                                        </button>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </template>

                </div>
            </div>
            {{-- Undo button, Shuffle, Reset --}}
            <div class="flex justify-center gap-3 mt-auto pt-4 pb-2">
                <button @click="undo()"
                    :disabled="history.length === 0"
                    :class="history.length > 0 ? 'text-[#A1A09A] hover:border-[#62605b] hover:text-white' : 'text-[#2a2a2a] border-[#2a2a2a] cursor-default'"
                    class="px-4 py-2 lg:px-6 lg:py-2.5 text-xs lg:text-sm rounded-sm border border-[#3E3E3A] transition-all">
                        Undo
                </button>
                <button @click="resetKeepOrder()"
                    :disabled="history.length === 0"
                    :class="history.length > 0 ? 'text-[#A1A09A] hover:border-[#62605b] hover:text-white' : 'text-[#2a2a2a] border-[#2a2a2a] cursor-default'"
                    class="px-4 py-2 lg:px-6 lg:py-2.5 text-xs lg:text-sm rounded-sm border border-[#3E3E3A] transition-all">
                        Reset
                </button>
                <button @click="resetGame()"
                    class="px-4 py-2 lg:px-6 lg:py-2.5 text-xs lg:text-sm rounded-sm border border-[#3E3E3A] text-[#A1A09A] transition-all hover:border-[#62605b] hover:text-white">
                        Shuffle
                </button>
            </div>
        </div>
    </div>

    <script>
        var _bracketEntries = @json($entries);
        var _bracketTitle = @json($userGame->title);

        function bracketGame() {
            var seeds = [..._bracketEntries].sort(function() { return Math.random() - 0.5; });
            var half = seeds.length / 2;
            var leftSeeds = seeds.slice(0, half);
            var rightSeeds = seeds.slice(half);

            function buildRounds(sideSeeds) {
                var rounds = [];
                var numR = Math.log2(sideSeeds.length);
                var r0 = [];
                for (var i = 0; i < sideSeeds.length; i += 2) {
                    r0.push([sideSeeds[i], sideSeeds[i + 1]]);
                }
                rounds.push(r0);
                for (var r = 1; r < numR; r++) {
                    var prev = rounds[r - 1];
                    var next = [];
                    for (var j = 0; j < prev.length; j += 2) {
                        next.push(['', '']);
                    }
                    rounds.push(next);
                }
                return rounds;
            }

            return {
                seeds: seeds,
                title: _bracketTitle,
                phase: 'intro',
                mobileView: 'left',
                winner: null,
                totalRounds: Math.log2(seeds.length),
                isDesktop: window.innerWidth >= 1280,

                leftRounds: buildRounds(leftSeeds),
                rightRounds: buildRounds(rightSeeds),
                finals: ['', ''],
                finalsResult: null,

                currentSide: 'left',
                currentRound: 0,
                currentMatch: 0,

                completed: {},
                results: {},
                history: [],

                get rightRoundsReversed() {
                    return [...this.rightRounds].reverse();
                },

                get currentRoundDisplay() {
                    if (this.currentSide === 'finals') return 'Final';
                    return this.currentRound + 1;
                },

                get currentSideDisplay() {
                    if (this.currentSide === 'finals') return 'Finals';
                    return this.currentSide.charAt(0).toUpperCase() + this.currentSide.slice(1);
                },

                init() {
                    var self = this;
                    setTimeout(function() {
                        self.phase = 'playing';
                    }, 3000);
                    window.addEventListener('resize', function() {
                        self.isDesktop = window.innerWidth >= 1280;
                    });
                },

                matchKey(side, round, match) {
                    return side + '-' + round + '-' + match;
                },

                isActiveMatch(side, round, match) {
                    if (this.phase !== 'playing') return false;
                    if (this.currentSide === 'finals') return false;
                    return this.currentSide === side && this.currentRound === round && this.currentMatch === match;
                },

                isFinalsActive() {
                    return (this.phase === 'playing' || this.phase === 'finals') && this.currentSide === 'finals' && this.finalsResult === null;
                },

                isCompleted(side, round, match) {
                    return !!this.completed[this.matchKey(side, round, match)];
                },

                isEliminated(side, round, match, entryIndex) {
                    var key = this.matchKey(side, round, match);
                    var result = this.results[key];
                    if (result === undefined) return false;
                    return result !== entryIndex;
                },

                isAdvanced(side, round, match, entryIndex) {
                    var key = this.matchKey(side, round, match);
                    var result = this.results[key];
                    if (result === undefined) return false;
                    return result === entryIndex;
                },

                isFinalEliminated(ei) {
                    if (this.finalsResult === null) return false;
                    return this.finalsResult !== ei;
                },

                isFinalAdvanced(ei) {
                    if (this.finalsResult === null) return false;
                    return this.finalsResult === ei;
                },

                pickEntry(side, round, match, entryIndex) {
                    if (!this.isActiveMatch(side, round, match)) return;

                    var rounds = side === 'left' ? this.leftRounds : this.rightRounds;
                    var selected = rounds[round][match][entryIndex];
                    var key = this.matchKey(side, round, match);

                    this.history.push({
                        side: side,
                        round: round,
                        match: match,
                        entryIndex: entryIndex,
                        currentSide: this.currentSide,
                        currentRound: this.currentRound,
                        currentMatch: this.currentMatch,
                        mobileView: this.mobileView
                    });

                    this.results[key] = entryIndex;
                    this.completed[key] = true;

                    var self = this;
                    setTimeout(function() {
                        var nextRound = round + 1;
                        var nextMatch = Math.floor(match / 2);
                        var nextSlot = match % 2;

                        if (nextRound < rounds.length) {
                            rounds[nextRound][nextMatch][nextSlot] = selected;
                        } else {
                            var finalSlot = side === 'left' ? 0 : 1;
                            self.finals[finalSlot] = selected;
                        }

                        self.advanceCursor(side, round, match, rounds);
                    }, 500);
                },

                advanceCursor(side, round, match, rounds) {
                    if (match + 1 < rounds[round].length) {
                        this.currentMatch = match + 1;
                        return;
                    }

                    if (side === 'left') {
                        this.currentSide = 'right';
                        this.currentRound = round;
                        this.currentMatch = 0;
                        this.mobileView = 'right';
                        return;
                    }

                    if (side === 'right') {
                        var nextRound = round + 1;
                        if (nextRound < rounds.length) {
                            this.currentSide = 'left';
                            this.currentRound = nextRound;
                            this.currentMatch = 0;
                            this.mobileView = 'left';
                            return;
                        }

                        this.currentSide = 'finals';
                        this.currentMatch = 0;
                        if (!this.isDesktop) {
                            this.phase = 'finals';
                        }
                    }
                },

                pickFinal(entryIndex) {
                    if (!this.isFinalsActive()) return;

                    this.history.push({
                        type: 'final',
                        currentSide: this.currentSide,
                        currentRound: this.currentRound,
                        currentMatch: this.currentMatch,
                        mobileView: this.mobileView,
                        phase: this.phase
                    });

                    this.finalsResult = entryIndex;
                    this.winner = this.finals[entryIndex];

                    var self = this;
                    setTimeout(function() {
                        self.phase = 'winner';
                    }, 800);
                },

                undo() {
                    if (this.history.length === 0) return;

                    var last = this.history.pop();

                    if (last.type === 'final') {
                        this.finalsResult = null;
                        this.winner = null;
                        this.currentSide = last.currentSide;
                        this.currentRound = last.currentRound;
                        this.currentMatch = last.currentMatch;
                        this.mobileView = last.mobileView;
                        this.phase = last.phase;
                        return;
                    }

                    var side = last.side;
                    var round = last.round;
                    var match = last.match;
                    var key = this.matchKey(side, round, match);
                    var rounds = side === 'left' ? this.leftRounds : this.rightRounds;

                    delete this.results[key];
                    delete this.completed[key];

                    var nextRound = round + 1;
                    var nextMatch = Math.floor(match / 2);
                    var nextSlot = match % 2;

                    if (nextRound < rounds.length) {
                        rounds[nextRound][nextMatch][nextSlot] = '';
                    } else {
                        var finalSlot = side === 'left' ? 0 : 1;
                        this.finals[finalSlot] = '';
                    }

                    this.currentSide = last.currentSide;
                    this.currentRound = last.currentRound;
                    this.currentMatch = last.currentMatch;
                    this.mobileView = last.mobileView;
                    this.phase = 'playing';
                },

                resetKeepOrder() {
                    var half = this.seeds.length / 2;
                    var ls = this.seeds.slice(0, half);
                    var rs = this.seeds.slice(half);

                    function buildRounds(sideSeeds) {
                        var rounds = [];
                        var numR = Math.log2(sideSeeds.length);
                        var r0 = [];
                        for (var i = 0; i < sideSeeds.length; i += 2) {
                            r0.push([sideSeeds[i], sideSeeds[i + 1]]);
                        }
                        rounds.push(r0);
                        for (var r = 1; r < numR; r++) {
                            var prev = rounds[r - 1];
                            var next = [];
                            for (var j = 0; j < prev.length; j += 2) {
                                next.push(['', '']);
                            }
                            rounds.push(next);
                        }
                        return rounds;
                    }

                    this.leftRounds = buildRounds(ls);
                    this.rightRounds = buildRounds(rs);
                    this.finals = ['', ''];
                    this.finalsResult = null;
                    this.winner = null;
                    this.completed = {};
                    this.results = {};
                    this.history = [];
                    this.currentSide = 'left';
                    this.currentRound = 0;
                    this.currentMatch = 0;
                    this.mobileView = 'left';
                    this.phase = 'playing';
                },

                resetGame() {
                    var shuffled = [...this.seeds].sort(function() { return Math.random() - 0.5; });
                    var half = shuffled.length / 2;
                    var ls = shuffled.slice(0, half);
                    var rs = shuffled.slice(half);

                    function buildRounds(sideSeeds) {
                        var rounds = [];
                        var numR = Math.log2(sideSeeds.length);
                        var r0 = [];
                        for (var i = 0; i < sideSeeds.length; i += 2) {
                            r0.push([sideSeeds[i], sideSeeds[i + 1]]);
                        }
                        rounds.push(r0);
                        for (var r = 1; r < numR; r++) {
                            var prev = rounds[r - 1];
                            var next = [];
                            for (var j = 0; j < prev.length; j += 2) {
                                next.push(['', '']);
                            }
                            rounds.push(next);
                        }
                        return rounds;
                    }

                    this.leftRounds = buildRounds(ls);
                    this.rightRounds = buildRounds(rs);
                    this.finals = ['', ''];
                    this.finalsResult = null;
                    this.winner = null;
                    this.completed = {};
                    this.results = {};
                    this.history = [];
                    this.currentSide = 'left';
                    this.currentRound = 0;
                    this.currentMatch = 0;
                    this.mobileView = 'left';
                    this.phase = 'playing';
                }
            };
        }
    </script>
</x-app-layout>