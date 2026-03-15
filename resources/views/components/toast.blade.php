<div x-data="{ show: false, message: '' }" x-init="
    window.addEventListener('toast', (e) => {
        let key = 'toast-' + (e.detail.key || e.detail.message);
        if (sessionStorage.getItem(key)) return;
        sessionStorage.setItem(key, '1');
        message = e.detail.message;
        show = true;
        setTimeout(() => show = false, 3000);
    });
">
    <div
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-x-2"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed top-6 right-6 z-[9999] flex items-center gap-2 rounded-sm
               bg-[#1b1b18] dark:bg-[#161615]
               text-sm text-[#EDEDEC]
               shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]
               dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]
               px-4 py-3"
    >
        <svg class="h-4 w-4 shrink-0 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        <span x-text="message"></span>
    </div>
</div>