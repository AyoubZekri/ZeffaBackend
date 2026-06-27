<aside x-cloak :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0 lg:static'"
    class="fixed inset-y-0 left-0 bg-white dark:bg-slate-800 w-64 shadow-xl flex flex-col z-40 transition-transform duration-300 ease-in-out border-r border-slate-200 dark:border-slate-700/50">
    <!-- Logo -->
    <div
        class="h-16 flex items-center justify-between px-6 border-b border-slate-200 dark:border-slate-700/50 relative">
        <a href="/"
            class="flex items-center space-x-3 text-indigo-600 dark:text-indigo-400 font-bold text-xl tracking-tight">
            <!-- Icon -->
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                </path>
            </svg>
            <span>Tamblt</span>
        </a>

        <!-- Mobile close btn -->
        <button @click="sidebarOpen = false"
            class="lg:hidden text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Nav Items -->
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto CustomScrollbar text-sm font-medium">
        <p class="px-3 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">Main Menu
        </p>

        <!-- Dashboard Link -->
        <a href="/"
            class="{{ request()->is('/') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/60 hover:text-slate-900 dark:hover:text-slate-200' }} group flex items-center px-3 py-2.5 rounded-xl transition-colors">
            <svg class="mr-3 h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
            <span class="truncate">Dashboard</span>
            <!-- Badge -->
            <span
                class="ml-auto bg-indigo-100 text-indigo-600 py-0.5 px-2 rounded-full text-xs font-bold shadow-sm dark:bg-indigo-900/40 dark:text-indigo-400">New</span>
        </a>

        <!-- Users Link -->
        <a href="/users"
            class="{{ request()->is('users') ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/60 hover:text-slate-900 dark:hover:text-slate-200' }} group flex items-center px-3 py-2.5 rounded-xl transition-colors">
            <svg class="mr-3 h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
            </svg>
            <span class="truncate">Users list</span>
        </a>


        <!-- Logout Link -->
        <form method="POST" action="/" class="mt-4">
            @csrf
            <button type="submit"
                class="w-full group flex items-center px-3 py-2.5 rounded-xl transition-colors cursor-pointer text-rose-500 hover:bg-rose-50 hover:text-rose-600 dark:hover:bg-rose-500/10 dark:hover:text-rose-400">
                <svg class="mr-3 h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                <span class="truncate">Sign out</span>
            </button>
        </form>
    </nav>
</aside>

<!-- Mobile sidebar overlay -->
<div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
    class="fixed inset-0 z-30 bg-slate-900/50 backdrop-blur-sm lg:hidden" x-cloak></div>