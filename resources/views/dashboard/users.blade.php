<x-app-layout>
    <x-slot name="title">لوحة التحكم - القاعات</x-slot>
    <x-slot name="header">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">إدارة القاعات</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">إدارة ومتابعة قاعات الأفراح وتراخيص المستخدمين في النظام.</p>
        </div>
    </x-slot>

    <!-- Alpine Data Component for Dashboard Interactivity -->
    <div x-data="{
        editingUser: { id: null, username: '', date: '' },
        openDateModal(id, username, date) {
            this.editingUser = { id: id, username: username, date: date ? date.split(' ')[0] : '' };
            this.$dispatch('open-modal', 'date-modal');
        }
    }">
        <!-- Session Toasts Connector -->
        @if(session('success'))
            <div x-data x-init="window.dispatchEvent(new CustomEvent('notify', { detail: { title: 'نجاح', message: '{{ session('success') }}', type: 'success' } }))"></div>
        @endif

        <!-- Stats Summary Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Halls -->
            <div class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-6 transition-all duration-300 hover:shadow-md group">
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-indigo-500"></div>
                <div class="flex justify-between items-start">
                    <div class="space-y-2">
                        <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">إجمالي القاعات</p>
                        <p class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">{{ $stats['total'] }}</p>
                    </div>
                    <div class="h-12 w-12 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Desktop Only -->
            <div class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-6 transition-all duration-300 hover:shadow-md group">
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-amber-500"></div>
                <div class="flex justify-between items-start">
                    <div class="space-y-2">
                        <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">تطبيق سطح المكتب فقط</p>
                        <p class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">{{ $stats['desktop_only'] }}</p>
                    </div>
                    <div class="h-12 w-12 bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Desktop + Mobile -->
            <div class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-6 transition-all duration-300 hover:shadow-md group">
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-cyan-500"></div>
                <div class="flex justify-between items-start">
                    <div class="space-y-2">
                        <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">مكتب + هاتف</p>
                        <p class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">{{ $stats['desktop_mobile'] }}</p>
                    </div>
                    <div class="h-12 w-12 bg-cyan-50 dark:bg-cyan-900/30 text-cyan-600 dark:text-cyan-400 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Permanent Activation -->
            <div class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-6 transition-all duration-300 hover:shadow-md group">
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-emerald-500"></div>
                <div class="flex justify-between items-start">
                    <div class="space-y-2">
                        <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">تفعيل دائم</p>
                        <p class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">{{ $stats['permanent'] }}</p>
                    </div>
                    <div class="h-12 w-12 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Search Bar -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-4 mb-6">
            <form action="{{ route('dashboard.users') }}" method="GET" class="flex flex-col sm:flex-row gap-3 items-center w-full">
                <div class="relative w-full flex-1">
                    <input type="text" name="search" value="{{ $search }}" placeholder="ابحث باسم المستخدم، البريد الإلكتروني، أو اسم القاعة..." class="w-full pl-10 pr-4 py-2 border border-slate-200 dark:border-slate-700/50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50 dark:bg-slate-900 dark:text-slate-200 transition-colors">
                    <div class="absolute left-3 top-2.5 text-slate-400 dark:text-slate-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex gap-2 w-full sm:w-auto">
                    <button type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-all shadow-md shadow-indigo-600/20 active:scale-95 flex items-center justify-center gap-2 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        بحث
                    </button>
                    @if(!empty($search))
                        <a href="{{ route('dashboard.users') }}" class="w-full sm:w-auto bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 px-5 py-2.5 rounded-xl text-sm font-medium transition-colors text-center">
                            إلغاء الفلترة
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table Card -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/50 overflow-hidden min-h-[400px] flex flex-col">
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700/50">
                        <tr class="text-slate-500 dark:text-slate-400 font-semibold uppercase tracking-wider text-xs">
                            <th class="px-6 py-4">اسم المستخدم</th>
                            <th class="px-6 py-4">اسم القاعة</th>
                            <th class="px-6 py-4">العنوان</th>
                            <th class="px-6 py-4">البريد الإلكتروني</th>
                            <th class="px-6 py-4">رقم الهاتف</th>
                            <th class="px-6 py-4">تاريخ الانتهاء</th>
                            <th class="px-6 py-4">الحالة</th>
                            <th class="px-6 py-4 text-right">الإجراءات والتحكم</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50 text-slate-700 dark:text-slate-300">
                        @forelse($users as $user)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/20 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-900 dark:text-slate-100">
                                    <div class="flex items-center gap-3">
                                        <div class="h-9 w-9 rounded-full bg-indigo-100 text-indigo-600 dark:bg-indigo-900/40 dark:text-indigo-400 flex items-center justify-center font-bold">
                                            {{ strtoupper(substr($user->username, 0, 1)) }}
                                        </div>
                                        <span>{{ $user->username }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">{{ $user->hallname ?? '—' }}</td>
                                <td class="px-6 py-4">{{ $user->adresse ?? '—' }}</td>
                                <td class="px-6 py-4 font-medium">{{ $user->email }}</td>
                                <td class="px-6 py-4 font-medium">{{ $user->numperPhone ?? '—' }}</td>
                                <td class="px-6 py-4 font-medium">
                                    {{ $user->date_experiment ? \Carbon\Carbon::parse($user->date_experiment)->format('Y-m-d') : 'غير محدد' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->status == 2)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-400">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            سطح المكتب فقط
                                        </span>
                                    @elseif($user->status == 3)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-cyan-100 text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-400">
                                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-500"></span>
                                            مكتب وهاتف
                                        </span>
                                    @elseif($user->status == 4)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            تفعيل دائم
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                            غير مفعل ({{ $user->status }})
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Status 2 (Desktop Only) -->
                                        <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="status" value="2">
                                            <button type="submit" title="تفعيل سطح المكتب فقط" class="text-slate-400 hover:text-amber-500 dark:hover:text-amber-400 p-1.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:border-amber-200 dark:hover:border-amber-900/50 bg-white dark:bg-slate-800 transition-all cursor-pointer">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                            </button>
                                        </form>

                                        <!-- Status 3 (Desktop + Mobile) -->
                                        <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="status" value="3">
                                            <button type="submit" title="تفعيل مكتب وهاتف" class="text-slate-400 hover:text-cyan-500 dark:hover:text-cyan-400 p-1.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:border-cyan-200 dark:hover:border-cyan-900/50 bg-white dark:bg-slate-800 transition-all cursor-pointer">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                            </button>
                                        </form>

                                        <!-- Status 4 (Permanent) -->
                                        <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="status" value="4">
                                            <button type="submit" title="تفعيل دائم" class="text-slate-400 hover:text-emerald-500 dark:hover:text-emerald-400 p-1.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:border-emerald-200 dark:hover:border-emerald-900/50 bg-white dark:bg-slate-800 transition-all cursor-pointer">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                                </svg>
                                            </button>
                                        </form>

                                        <!-- Date Edit -->
                                        <button @click="openDateModal('{{ $user->id }}', '{{ $user->username }}', '{{ $user->date_experiment }}')" title="تعديل تاريخ الصلاحية" class="text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 p-1.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:border-indigo-200 dark:hover:border-indigo-900/50 bg-white dark:bg-slate-800 transition-all cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                    <svg class="w-12 h-12 mx-auto text-slate-300 dark:text-slate-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0V9a2 2 0 00-2-2H6a2 2 0 00-2 2v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    لا يوجد قاعات لعرضها.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-700/50 bg-slate-50/50 dark:bg-slate-700/20">
                    {{ $users->appends(['search' => $search])->links() }}
                </div>
            @endif
        </div>

        <!-- Expiration Date Picker Modal -->
        <x-modal name="date-modal" title="تغيير تاريخ انتهاء الصلاحية" maxWidth="md">
            <form :action="'/users/' + editingUser.id + '/expiration'" method="POST" class="space-y-4">
                @csrf
                <div>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">
                        تعديل تاريخ الصلاحية للمستخدم: <strong class="text-slate-800 dark:text-slate-200" x-text="editingUser.username"></strong>
                    </p>
                    <label for="date_experiment" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">تاريخ الصلاحية الجديد:</label>
                    <input type="date" name="date_experiment" id="date_experiment" x-model="editingUser.date" required class="w-full px-4 py-2 border border-slate-200 dark:border-slate-700/50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-slate-50 dark:bg-slate-900 dark:text-slate-200 transition-colors">
                </div>
                <!-- Action Buttons -->
                <div class="mt-6 flex justify-end gap-3 border-t border-slate-100 dark:border-slate-700/50 pt-4">
                    <button type="button" @click="$dispatch('close-modal', 'date-modal')" class="px-5 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-700 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors cursor-pointer">إلغاء</button>
                    <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-md shadow-indigo-600/20 cursor-pointer">حفظ التغييرات</button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
