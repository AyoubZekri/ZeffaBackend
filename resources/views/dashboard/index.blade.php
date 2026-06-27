<x-app-layout>
    <x-slot name="title">لوحة التحكم الرئيسية - زفة</x-slot>
    <x-slot name="header">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">الرئيسية</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">مرحباً بك في لوحة تحكم تطبيق زفة لإدارة القاعات.</p>
        </div>
    </x-slot>

    <!-- Welcome Hero Section -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 via-indigo-700 to-indigo-800 p-8 md:p-12 shadow-xl border border-indigo-500/20 text-white mb-8">
        <div class="relative z-10 max-w-2xl space-y-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-indigo-100 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                النظام يعمل بشكل ممتاز
            </span>
            <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight">مرحباً بك، المدير العام!</h2>
            <p class="text-indigo-100 text-sm md:text-base leading-relaxed">
                هنا يمكنك مراقبة إحصائيات القاعات المسجلة، إدارة صلاحيات الأجهزة، وتمديد التراخيص وتتبع حالة المستخدمين الفعّالة بكل سهولة ويسر.
            </p>
            <div class="pt-4 flex flex-wrap gap-3">
                <a href="/users" class="bg-white hover:bg-indigo-50 text-indigo-700 px-6 py-3 rounded-xl text-sm font-bold shadow-md transition-all active:scale-95 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    إدارة القاعات والمستخدمين
                </a>
            </div>
        </div>
        <!-- Abstract premium shape styling background -->
        <div class="absolute -right-10 -bottom-10 w-96 h-96 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-indigo-500/30 rounded-full blur-2xl pointer-events-none"></div>
    </div>

    <!-- Quick Navigation Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Quick Action Card 1 -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-700/50 flex flex-col justify-between group transition-all duration-300 hover:shadow-md">
            <div class="space-y-4">
                <div class="h-12 w-12 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">إدارة القاعات</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                    استعرض قائمة القاعات الكاملة، ابحث بالاسم، البريد أو رقم الهاتف. يمكنك تفعيل سطح المكتب أو تطبيق الهاتف والمزيد.
                </p>
            </div>
            <div class="pt-6 border-t border-slate-50 dark:border-slate-700/50 mt-6">
                <a href="/users" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 font-semibold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">
                    الذهاب لإدارة القاعات
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>

        <!-- Quick Action Card 2 -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-700/50 flex flex-col justify-between group transition-all duration-300 hover:shadow-md">
            <div class="space-y-4">
                <div class="h-12 w-12 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">إعدادات النظام</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                    تحقق من إعدادات المشرف، كلمات المرور، الخصائص العامة وقواعد التشفير للبيانات المزامنة داخل تطبيق زفة.
                </p>
            </div>
            <div class="pt-6 border-t border-slate-50 dark:border-slate-700/50 mt-6">
                <a href="#" class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 font-semibold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">
                    تعديل الإعدادات العامة
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
