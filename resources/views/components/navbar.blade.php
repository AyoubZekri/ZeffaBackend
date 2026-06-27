<header class="h-16 flex items-center justify-between px-6 bg-white/80 dark:bg-slate-800/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-700/50 sticky top-0 z-30 shadow-sm">
    <!-- Mobile Hamburger and Search -->
    <div class="flex items-center space-x-4 flex-1">
        <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-400 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
            </svg>
        </button>

        <!-- Search Bar -->
        <div class="hidden sm:flex relative w-full max-w-md group">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400 dark:text-slate-500 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" placeholder="Search across dashboard..." class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-full leading-5 bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 dark:bg-slate-900/50 dark:border-slate-700/50 dark:text-slate-200 dark:placeholder-slate-500 dark:focus:ring-indigo-500/30">
        </div>
    </div>

    <!-- Right Side Actions -->
    <div class="flex items-center space-x-5 ml-4">
        
        <!-- Dark Mode Toggle -->
        <button @click="darkMode = !darkMode" class="text-slate-400 hover:text-indigo-500 dark:hover:text-indigo-400 transition-colors focus:outline-none relative">
            <svg x-show="!darkMode" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            <svg x-show="darkMode" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </button>

        <!-- Notifications -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" @click.away="open = false" class="text-slate-400 hover:text-indigo-500 dark:hover:text-indigo-400 transition-colors focus:outline-none relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <span class="absolute top-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white dark:ring-slate-800 bg-rose-500 animate-pulse"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="absolute right-0 mt-2 w-80 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-100 dark:border-slate-700/50 py-2 z-50">
                <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-700/50 flex justify-between items-center">
                    <span class="font-semibold text-slate-800 dark:text-slate-200">Notifications</span>
                    <a href="/notifications" class="text-xs text-indigo-600 dark:text-indigo-400 font-medium hover:underline">View all</a>
                </div>
                <a href="/notifications" class="block px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 flex gap-3 border-b border-slate-50 dark:border-slate-700/30">
                    <div class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0 dark:bg-indigo-900/40 dark:text-indigo-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                    <div>
                        <p class="text-sm font-medium text-slate-800 dark:text-slate-200">System updated</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Dashboard v2.0 has been launched</p>
                    </div>
                </a>
                <a href="/notifications" class="block bg-slate-50 dark:bg-slate-700/30 text-center py-2 text-xs font-semibold text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">See complete history</a>
            </div>
        </div>

        <!-- Profile Dropdown -->
        <div x-data="{ profileOpen: false }" class="relative">
            <button @click="profileOpen = !profileOpen" @click.away="profileOpen = false" class="flex items-center space-x-2 focus:outline-none ring-2 ring-transparent focus:ring-indigo-500/30 rounded-full transition-all">
                <img class="h-9 w-9 rounded-full object-cover border-2 border-indigo-100 dark:border-indigo-900/50 shadow-sm" src="https://ui-avatars.com/api/?name=Admin+User&background=6366f1&color=fff" alt="User avatar">
            </button>
            
            <div x-show="profileOpen" x-transition x-cloak class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-100 dark:border-slate-700/50 py-1 z-50">
                <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-700/50">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Signed in as</p>
                    <p class="text-sm font-bold text-slate-800 dark:text-slate-200 truncate">admin@tamblt.local</p>
                </div>
                <a href="/profile" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50 flex items-center">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Your Profile
                </a>
                <a href="/settings" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50 flex items-center">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Settings
                </a>
                <form method="POST" action="/" class="border-t border-slate-100 dark:border-slate-700/50 mt-1">
                    @csrf
                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 flex items-center">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Sign out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
