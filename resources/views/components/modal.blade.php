@props(['name', 'title' => '', 'maxWidth' => '2xl'])

@php
$maxWidthClass = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth] ?? 'sm:max-w-2xl';
@endphp

<div x-data="{ show: false, name: '{{ $name }}' }"
     x-show="show"
     @open-modal.window="if ($event.detail === name) { show = true; setTimeout(() => $focus.first(), 50); }"
     @close-modal.window="if ($event.detail === name) show = false"
     @keydown.escape.window="show = false"
     style="display: none;"
     class="fixed inset-0 z-50 overflow-y-auto"
     aria-labelledby="modal-title" role="dialog" aria-modal="true">
     
    <!-- Backdrop -->
    <div x-show="show" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="show = false"
         class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity"></div>

    <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
        <!-- Modal panel -->
        <div x-show="show"
             x-transition:enter="ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-slate-800 text-left shadow-xl transition-all sm:my-8 w-full {{ $maxWidthClass }} border border-slate-100 dark:border-slate-700/50">
            
            <!-- Header -->
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700/50 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/50">
                <h3 class="text-lg font-bold leading-6 text-slate-900 dark:text-white" id="modal-title">{{ $title }}</h3>
                <button @click="show = false" type="button" class="text-slate-400 hover:text-slate-500 dark:hover:text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg p-1 transition-colors">
                    <span class="sr-only">Close panel</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Body -->
            <div class="px-6 py-5">
                {{ $slot }}
            </div>
            
            <!-- Footer (optional but injected via slot) -->
            @if(isset($footer))
            <div class="bg-slate-50 dark:bg-slate-700/30 px-6 py-4 border-t border-slate-100 dark:border-slate-700/50 flex justify-end gap-3 flex-row-reverse sm:flex-row">
                {{ $footer }}
            </div>
            @endif
        </div>
    </div>
</div>
