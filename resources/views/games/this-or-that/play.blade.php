<x-app-layout>
    <div class="grid place-items-center min-h-[calc(100vh-8rem)] p-6"
         x-data='{
            entries: @json($entries),
            pool: [],
            left: null,
            right: null,
            winner: null,
            round: 0,
            totalRounds: 0,
            picked: null,
            transitioning: false,
 
            init() {
                this.pool = [...this.entries].sort(() => Math.random() - 0.5);
                this.totalRounds = this.pool.length - 1;
                this.left = this.pool.pop();
                this.right = this.pool.pop();
                this.round = 1;
            },
 
            pick(choice) {
                if (this.transitioning) return;
                this.picked = choice;
                this.transitioning = true;
 
                setTimeout(() => {
                    let selected = choice === "top" ? this.left : this.right;
 
                    if (this.pool.length === 0) {
                        this.winner = selected;
                        this.transitioning = false;
                        this.launchConfetti();
                        return;
                    }
 
                    let next = this.pool.pop();
                    this.round++;
 
                    if (Math.random() > 0.5) {
                        this.left = selected;
                        this.right = next;
                    } else {
                        this.left = next;
                        this.right = selected;
                    }
 
                    this.picked = null;
                    this.transitioning = false;
                }, 600);
            },
 
            launchConfetti() {
                const canvas = this.$refs.confetti;
                const ctx = canvas.getContext("2d");
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
 
                const particles = [];
                const colors = ["#10b981", "#f59e0b", "#ef4444", "#8b5cf6", "#3b82f6", "#ec4899"];
 
                for (let i = 0; i < 150; i++) {
                    particles.push({
                        x: canvas.width / 2 + (Math.random() - 0.5) * 200,
                        y: canvas.height / 2,
                        vx: (Math.random() - 0.5) * 18,
                        vy: (Math.random() - 1) * 20 - 5,
                        w: Math.random() * 10 + 4,
                        h: Math.random() * 6 + 2,
                        color: colors[Math.floor(Math.random() * colors.length)],
                        rotation: Math.random() * 360,
                        rotSpeed: (Math.random() - 0.5) * 15,
                        gravity: 0.4 + Math.random() * 0.2,
                        opacity: 1,
                    });
                }
 
                let frame = 0;
                const maxFrames = 180;
 
                const animate = () => {
                    if (frame > maxFrames) {
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        return;
                    }
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    particles.forEach(p => {
                        p.x += p.vx;
                        p.vy += p.gravity;
                        p.y += p.vy;
                        p.rotation += p.rotSpeed;
                        p.vx *= 0.98;
                        if (frame > maxFrames - 40) {
                            p.opacity = Math.max(0, p.opacity - 0.03);
                        }
                        ctx.save();
                        ctx.translate(p.x, p.y);
                        ctx.rotate((p.rotation * Math.PI) / 180);
                        ctx.globalAlpha = p.opacity;
                        ctx.fillStyle = p.color;
                        ctx.fillRect(-p.w / 2, -p.h / 2, p.w, p.h);
                        ctx.restore();
                    });
                    frame++;
                    requestAnimationFrame(animate);
                };
                animate();
            },
 
            get progress() {
                if (this.totalRounds === 0) return 0;
                return Math.round((this.round / this.totalRounds) * 100);
            }
         }'
    >
        <canvas x-ref="confetti" class="fixed inset-0 z-[9999] pointer-events-none"></canvas>
 
        {{-- Game screen --}}
        <div x-show="!winner"
             class="w-full max-w-xl">
 
            {{-- Progress --}}
            <div class="mb-6 text-center">
                <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] mb-2"
                   x-text="'Round ' + round + ' of ' + totalRounds"></p>
                <div class="w-full h-1 rounded-full bg-[#2a2a2a] overflow-hidden">
                    <div class="h-full bg-green-500 rounded-full transition-all duration-500 ease-out"
                         :style="'width: ' + progress + '%'"></div>
                </div>
            </div>
 
            {{-- VS Card --}}
            <div class="dark:text-[#EDEDEC]
                        shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
                        dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
                        rounded-sm p-6">
 
                <div class="flex flex-col items-center gap-4">
                    {{-- Top option --}}
                    <button @click="pick('top')"
                            :disabled="transitioning"
                            :class="{
                                'border-green-500 bg-green-500/10': picked === 'top',
                                'border-red-500/30 opacity-40 scale-95': picked === 'bottom',
                                'hover:border-[#62605b] hover:bg-[#1f1f1f]': !transitioning
                            }"
                            class="w-full rounded-sm border border-[#3E3E3A] p-6 text-center
                                   transition-all duration-500 ease-out cursor-pointer
                                   disabled:cursor-default">
                        <span class="text-lg font-medium block" x-text="left"></span>
                    </button>
 
                    {{-- OR divider --}}
                    <div class="flex items-center gap-3 w-full">
                        <div class="flex-1 h-px bg-[#3E3E3A]"></div>
                        <span class="text-xs font-medium text-[#706f6c] dark:text-[#A1A09A]">OR</span>
                        <div class="flex-1 h-px bg-[#3E3E3A]"></div>
                    </div>
 
                    {{-- Bottom option --}}
                    <button @click="pick('bottom')"
                            :disabled="transitioning"
                            :class="{
                                'border-green-500 bg-green-500/10': picked === 'bottom',
                                'border-red-500/30 opacity-40 scale-95': picked === 'top',
                                'hover:border-[#62605b] hover:bg-[#1f1f1f]': !transitioning
                            }"
                            class="w-full rounded-sm border border-[#3E3E3A] p-6 text-center
                                   transition-all duration-500 ease-out cursor-pointer
                                   disabled:cursor-default">
                        <span class="text-lg font-medium block" x-text="right"></span>
                    </button>
                </div>
            </div>
        </div>
 
        {{-- Winner screen --}}
        <div x-show="winner" x-cloak
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             class="w-full max-w-xl text-center">
            <div class="dark:text-[#EDEDEC]
                        shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
                        dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
                        rounded-sm p-8">
 
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-2">The winner is</p>
                <h1 class="text-3xl font-semibold mb-6 animate-pulse" x-text="winner"></h1>
 
                <div class="flex gap-3 justify-center">
                    <button @click="pool = [...entries].sort(() => Math.random() - 0.5); left = pool.pop(); right = pool.pop(); winner = null; round = 1; picked = null;"
                            class="rounded-sm border border-[#3E3E3A] bg-[#1f1f1f] text-white px-5 py-2 text-sm
                                   transition-all duration-200 hover:bg-[#2a2a2a] hover:border-[#62605b]">
                        Play Again
                    </button>
 
                    <a href="{{ route('games.this-or-that.edit', $userGame) }}"
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
    </div>
</x-app-layout>