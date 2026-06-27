<x-app-layout>
    <x-slot name="title">Users - Tamblt</x-slot>
    <x-slot name="header">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Users Management</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">View, create, edit, or delete users within your system.</p>
        </div>
        <div>
            <button @click="$dispatch('open-modal', 'add-user-modal')" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-all shadow-md shadow-indigo-600/20 active:scale-95 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Add New User
            </button>
        </div>
    </x-slot>

    <!-- Alpine Data Component for Interactivity -->
    <div x-data="usersData()" x-init="init()">
        <!-- Filter & Search -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-4 mb-6">
            <div class="flex flex-col sm:flex-row justify-between gap-4">
                <div class="flex gap-2">
                    <select x-model="roleFilter" class="form-select w-full sm:w-auto px-4 py-2 border border-slate-200 dark:border-slate-700/50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-slate-900 dark:text-slate-200 transition-colors">
                        <option value="">All Roles</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                        <option value="Editor">Editor</option>
                    </select>
                </div>
                <div class="relative w-full sm:w-72">
                    <input type="text" x-model="searchQuery" placeholder="Search users by name, email..." class="w-full pl-10 pr-4 py-2 border border-slate-200 dark:border-slate-700/50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-slate-900 dark:text-slate-200 transition-colors">
                    <div class="absolute left-3 top-2.5 text-slate-400 dark:text-slate-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/50 overflow-hidden min-h-[400px] flex flex-col">
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700/50">
                        <tr class="text-slate-500 dark:text-slate-400 font-semibold uppercase tracking-wider text-xs">
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50 text-slate-700 dark:text-slate-300">
                        <template x-for="user in paginatedUsers" :key="user.id">
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/20 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img :src="`https://ui-avatars.com/api/?name=${user.name.replace(' ', '+')}&background=random&color=fff`" class="h-10 w-10 rounded-full border-2 border-white dark:border-slate-800 shadow-sm" alt="">
                                        <div>
                                            <p class="font-bold text-slate-900 dark:text-slate-100" x-text="user.name"></p>
                                            <p class="text-xs text-slate-500 dark:text-slate-400" x-text="user.email"></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-lg text-xs font-semibold" 
                                          :class="{
                                              'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-400': user.role === 'Admin',
                                              'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300': user.role === 'User',
                                              'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-400': user.role === 'Editor'
                                          }" x-text="user.role"></span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold"
                                          :class="{
                                              'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400': user.status === 'Active',
                                              'bg-rose-100 text-rose-700 dark:bg-rose-900/40 dark:text-rose-400': user.status === 'Inactive'
                                          }">
                                        <span class="w-1.5 h-1.5 rounded-full" :class="user.status === 'Active' ? 'bg-emerald-500' : 'bg-rose-500'"></span> 
                                        <span x-text="user.status"></span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <!-- Edit Btn -->
                                    <button @click="editUser(user)" class="text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 p-1 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <!-- Delete Btn -->
                                    <button @click="confirmDelete(user)" class="text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 p-1 ml-2 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="paginatedUsers.length === 0">
                            <td colspan="4" class="px-6 py-10 text-center text-slate-500 dark:text-slate-400">
                                No users found matching your criteria.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Footer -->
            <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-700/50 bg-slate-50/50 dark:bg-slate-700/20 flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-slate-500 dark:text-slate-400">
                <div x-show="filteredUsers.length > 0">
                    Showing <span class="font-bold text-slate-700 dark:text-slate-300" x-text="startIndex + 1"></span> to 
                    <span class="font-bold text-slate-700 dark:text-slate-300" x-text="Math.min(endIndex, filteredUsers.length)"></span> 
                    of <span class="font-bold text-slate-700 dark:text-slate-300" x-text="filteredUsers.length"></span> results
                </div>
                <div x-show="filteredUsers.length === 0">
                    No results
                </div>

                <div class="flex gap-2" x-show="totalPages > 1">
                    <button @click="currentPage--" :disabled="currentPage === 1" class="px-3 py-1.5 border border-slate-200 dark:border-slate-600 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed hover:bg-slate-100 dark:hover:bg-slate-600 transition-colors bg-white dark:bg-slate-800">Previous</button>
                    
                    <div class="flex gap-1 hidden sm:flex">
                        <template x-for="page in totalPages" :key="page">
                            <button @click="currentPage = page" 
                                    :class="currentPage === page ? 'bg-indigo-600 text-white border-transparent' : 'border-slate-200 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-600 bg-white dark:bg-slate-800'" 
                                    class="w-8 py-1.5 border rounded-lg transition-colors text-center font-medium" 
                                    x-text="page"></button>
                        </template>
                    </div>

                    <button @click="currentPage++" :disabled="currentPage === totalPages" class="px-3 py-1.5 border border-slate-200 dark:border-slate-600 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed hover:bg-slate-100 dark:hover:bg-slate-600 transition-colors bg-white dark:bg-slate-800">Next</button>
                </div>
            </div>
        </div>

        <!-- Add User Modal -->
        <x-modal name="add-user-modal" title="Add New User" maxWidth="md">
            <form @submit.prevent="saveNewUser" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Full Name</label>
                    <input type="text" x-model="newUser.name" required class="w-full px-4 py-2 border border-slate-200 dark:border-slate-700/50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-slate-50 dark:bg-slate-900 dark:text-slate-200 transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Email</label>
                    <input type="email" x-model="newUser.email" required class="w-full px-4 py-2 border border-slate-200 dark:border-slate-700/50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-slate-50 dark:bg-slate-900 dark:text-slate-200 transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Role</label>
                    <select x-model="newUser.role" class="w-full px-4 py-2 border border-slate-200 dark:border-slate-700/50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-slate-50 dark:bg-slate-900 dark:text-slate-200 transition-colors">
                        <option value="User">User</option>
                        <option value="Editor">Editor</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <!-- Action Buttons in Footer slot -->
                <div class="mt-6 flex justify-end gap-3 border-t border-slate-100 dark:border-slate-700/50 pt-4">
                    <button type="button" @click="$dispatch('close-modal', 'add-user-modal')" class="px-5 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-700 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">Cancel</button>
                    <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-md shadow-indigo-600/20">Create User</button>
                </div>
            </form>
        </x-modal>

        <!-- Edit User Modal -->
        <x-modal name="edit-user-modal" title="Edit User" maxWidth="md">
            <form @submit.prevent="updateUser" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Full Name</label>
                    <input type="text" x-model="editingUser.name" required class="w-full px-4 py-2 border border-slate-200 dark:border-slate-700/50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-slate-50 dark:bg-slate-900 dark:text-slate-200 transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Email</label>
                    <input type="email" x-model="editingUser.email" required class="w-full px-4 py-2 border border-slate-200 dark:border-slate-700/50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-slate-50 dark:bg-slate-900 dark:text-slate-200 transition-colors">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Role</label>
                        <select x-model="editingUser.role" class="w-full px-4 py-2 border border-slate-200 dark:border-slate-700/50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-slate-50 dark:bg-slate-900 dark:text-slate-200 transition-colors">
                            <option value="User">User</option>
                            <option value="Editor">Editor</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Status</label>
                        <select x-model="editingUser.status" class="w-full px-4 py-2 border border-slate-200 dark:border-slate-700/50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-slate-50 dark:bg-slate-900 dark:text-slate-200 transition-colors">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="mt-6 flex justify-end gap-3 border-t border-slate-100 dark:border-slate-700/50 pt-4">
                    <button type="button" @click="$dispatch('close-modal', 'edit-user-modal')" class="px-5 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-700 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">Cancel</button>
                    <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-md shadow-indigo-600/20">Save Changes</button>
                </div>
            </form>
        </x-modal>

        <!-- Delete User Modal -->
        <x-modal name="delete-user-modal" title="Delete Confirmation" maxWidth="sm">
            <div class="py-2">
                <div class="mx-auto flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full bg-rose-100 dark:bg-rose-900/40 sm:mx-0 mb-4 sm:h-12 sm:w-12">
                    <svg class="h-6 w-6 text-rose-600 dark:text-rose-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    Are you sure you want to delete <strong class="text-slate-800 dark:text-slate-200" x-text="userToDelete?.name"></strong>? This action cannot be undone.
                </p>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" @click="$dispatch('close-modal', 'delete-user-modal')" class="px-5 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-700 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">Cancel</button>
                    <button @click="deleteUser" class="px-5 py-2 text-sm font-medium text-white bg-rose-600 rounded-xl hover:bg-rose-700 transition-colors shadow-md shadow-rose-600/20">Delete</button>
                </div>
            </div>
        </x-modal>
    </div>

    <!-- Alpine Interactive Logic -->
    <script>
        function usersData() {
            return {
                searchQuery: '',
                roleFilter: '',
                currentPage: 1,
                perPage: 5,
                users: [
                    { id: 1, name: 'Ali Ahmed', email: 'ali.ahmed@example.com', role: 'Admin', status: 'Active' },
                    { id: 2, name: 'Sara Khaled', email: 'sara.k@example.com', role: 'User', status: 'Inactive' },
                    { id: 3, name: 'Omar Fahd', email: 'omar.f@example.com', role: 'Editor', status: 'Active' },
                    { id: 4, name: 'Khaled Hassan', email: 'khaled@example.com', role: 'User', status: 'Active' },
                    { id: 5, name: 'Mona Youssef', email: 'mona.y@example.com', role: 'Admin', status: 'Active' },
                    { id: 6, name: 'Ahmed Zaki', email: 'ahmed.z@example.com', role: 'Editor', status: 'Inactive' },
                    { id: 7, name: 'Nour Ali', email: 'nour.a@example.com', role: 'User', status: 'Active' },
                    { id: 8, name: 'Tarek Fathy', email: 'tarek.f@example.com', role: 'User', status: 'Inactive' },
                    { id: 9, name: 'Salma Ibrahim', email: 'salma.i@example.com', role: 'Admin', status: 'Active' },
                    { id: 10, name: 'Yassin', email: 'yassin@example.com', role: 'User', status: 'Active' },
                    { id: 11, name: 'Karim', email: 'karim@example.com', role: 'User', status: 'Active' },
                    { id: 12, name: 'Dina', email: 'dina@example.com', role: 'Editor', status: 'Active' }
                ],
                newUser: { name: '', email: '', role: 'User' },
                editingUser: { id: null, name: '', email: '', role: '', status: '' },
                userToDelete: null,

                init() {
                    // Reset to first page when filtering
                    this.$watch('searchQuery', () => this.currentPage = 1);
                    this.$watch('roleFilter', () => this.currentPage = 1);
                },

                get filteredUsers() {
                    return this.users.filter(u => {
                        const matchesSearch = u.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || 
                                              u.email.toLowerCase().includes(this.searchQuery.toLowerCase());
                        const matchesRole = this.roleFilter === '' || u.role === this.roleFilter;
                        return matchesSearch && matchesRole;
                    });
                },

                get totalPages() {
                    return Math.max(1, Math.ceil(this.filteredUsers.length / this.perPage));
                },

                get startIndex() {
                    return (this.currentPage - 1) * this.perPage;
                },

                get endIndex() {
                    return this.currentPage * this.perPage;
                },

                get paginatedUsers() {
                    return this.filteredUsers.slice(this.startIndex, this.endIndex);
                },

                saveNewUser() {
                    this.users.unshift({
                        id: Date.now(),
                        name: this.newUser.name,
                        email: this.newUser.email,
                        role: this.newUser.role,
                        status: 'Active'
                    });
                    this.newUser = { name: '', email: '', role: 'User' };
                    // Optionally jump to page 1
                    this.currentPage = 1;
                    this.$dispatch('close-modal', 'add-user-modal');
                    window.dispatchEvent(new CustomEvent('notify', { detail: { title: 'Success', message: 'User created successfully.', type: 'success' } }));
                },

                editUser(user) {
                    this.editingUser = { ...user };
                    this.$dispatch('open-modal', 'edit-user-modal');
                },

                updateUser() {
                    const index = this.users.findIndex(u => u.id === this.editingUser.id);
                    if (index !== -1) {
                        this.users[index] = { ...this.editingUser };
                        this.$dispatch('close-modal', 'edit-user-modal');
                        window.dispatchEvent(new CustomEvent('notify', { detail: { title: 'Updated', message: 'User has been updated.', type: 'success' } }));
                    }
                },

                confirmDelete(user) {
                    this.userToDelete = user;
                    this.$dispatch('open-modal', 'delete-user-modal');
                },

                deleteUser() {
                    this.users = this.users.filter(u => u.id !== this.userToDelete.id);
                    
                    // Prevent being stuck on an empty page after deletion
                    if(this.paginatedUsers.length === 0 && this.currentPage > 1) {
                        this.currentPage--;
                    }

                    this.$dispatch('close-modal', 'delete-user-modal');
                    window.dispatchEvent(new CustomEvent('notify', { detail: { title: 'Deleted', message: 'User was removed from the system.', type: 'error' } }));
                }
            }
        }
    </script>
</x-app-layout>
