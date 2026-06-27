<!DOCTYPE html>
<html lang="en" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Template' }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <!-- Tailwind CSS (CDN for immediate preview without npm build) -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    
    <!-- AlpineJS for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Inter', sans-serif;
        }
        @custom-variant dark (&:where(.dark, .dark *));
    </style>

    <!-- Prevent FOUC (Flash of Unstyled Content) for Dark Mode -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        /* CustomScrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .dark .glass-panel {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900" 
      x-data="appData()" 
      x-init="initApp()">

    <div class="dark:bg-slate-900 dark:text-slate-100 min-h-screen flex transition-colors duration-300">
        
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen overflow-hidden transition-all duration-300">
            <!-- Navbar -->
            <x-navbar />

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 dark:bg-slate-900/50 p-4 sm:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto space-y-6">
                    <!-- Page Header -->
                    @if(isset($header))
                        <div class="mb-6 flex flex-col sm:flex-row justify-between sm:items-end gap-4">
                            {{ $header }}
                        </div>
                    @endif

                    <!-- Main Slot -->
                    {{ $slot }}
                </div>
            </main>
            
            <!-- Footer -->
            <footer class="py-4 text-center text-sm text-slate-500 dark:text-slate-400 mt-auto">
                &copy; {{ date('Y') }} Premium Dashboard Template. All rights reserved.
            </footer>
        </div>
    </div>

    <!-- Global Toast Notification System -->
    <div class="fixed bottom-0 right-0 z-50 p-4 space-y-4 w-full max-w-sm pointer-events-none flex flex-col items-end">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-show="toast.visible" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="translate-y-10 opacity-0 sm:translate-y-0 sm:translate-x-10"
                 x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="pointer-events-auto w-full bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-xl rounded-xl p-4 flex items-start gap-4">
                 
                 <!-- Icon depending on type -->
                 <div class="shrink-0 mt-0.5">
                    <template x-if="toast.type === 'success'">
                        <div class="h-8 w-8 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-full flex items-center justify-center">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                    </template>
                    <template x-if="toast.type === 'error'">
                        <div class="h-8 w-8 bg-rose-100 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400 rounded-full flex items-center justify-center">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </div>
                    </template>
                 </div>
                 
                 <div class="flex-1">
                     <p class="text-sm font-bold text-slate-900 dark:text-white" x-text="toast.title"></p>
                     <p class="mt-1 text-sm text-slate-500 dark:text-slate-400" x-text="toast.message"></p>
                 </div>
                 
                 <button @click="removeToast(toast.id)" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                     <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                 </button>
            </div>
        </template>
    </div>

    <!-- App State Logic -->
    <script>
        function appData() {
            return {
                sidebarOpen: false,
                darkMode: false,
                toasts: [],
                
                initApp() {
                    // Initialize explicitly from DOM class so there's NO flicker or conflict
                    this.darkMode = document.documentElement.classList.contains('dark');
                    
                    // Watch for theme changes from navbar toggles
                    this.$watch('darkMode', value => {
                        localStorage.setItem('theme', value ? 'dark' : 'light');
                        if (value) {
                            document.documentElement.classList.add('dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                        }
                    });

                    // Listen to global events for toast notifications
                    window.addEventListener('notify', (e) => {
                        this.addToast(e.detail.title, e.detail.message, e.detail.type || 'success');
                    });
                },
                
                addToast(title, message, type = 'success') {
                    const id = Date.now();
                    const toast = { id, title, message, type, visible: true };
                    this.toasts.push(toast);
                    setTimeout(() => this.removeToast(id), 4000);
                },
                
                removeToast(id) {
                    const index = this.toasts.findIndex(t => t.id === id);
                    if (index !== -1) {
                        this.toasts[index].visible = false;
                        setTimeout(() => {
                            this.toasts = this.toasts.filter(t => t.id !== id);
                        }, 300);
                    }
                }
            }
        }
    </script>
</body>
</html>
