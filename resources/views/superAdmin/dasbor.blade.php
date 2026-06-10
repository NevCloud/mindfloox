<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Dashboard - Super Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        .modal-backdrop { backdrop-filter: blur(4px); }
    </style>
</head>

<body x-data="dashboardApp()" x-init="initApp()" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <x-leftPanel />

            <!-- MAIN CONTENT -->
            <main class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Nav -->
            <x-topNav/>

            <!-- SCROLLABLE CONTENT -->
            <div class="flex-1 overflow-y-auto">
            <div class="p-5 space-y-5">

            <!-- BANNER -->
            <x-banner />

            <!-- STATS -->
            <x-stats />

                    <!-- CRUD SECTIONS IN GRID -->
                    <div class="grid grid-cols-2 gap-5">

                        <!-- 1. JENIS MICROCREDENTIAL -->
                        <div class="card translate-0">
                            <div class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-pink-100 dark:bg-pink-500/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">Jenis Microcredential</h3>
                                        <p class="text-xs text-gray-500">Kelola kategori sertifikasi</p>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button @click="openModal('microcredential', 'view')" class="px-3 py-1.5 text-xs text-purple-600 hover:bg-purple-50 dark:hover:bg-purple-500/10 rounded-lg transition font-medium">
                                        Lihat Semua
                                    </button>
                                    <button @click="openModal('microcredential', 'create')" class="px-3 py-1.5 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-xs font-medium transition">
                                        + Tambah
                                    </button>
                                </div>
                            </div>

                            <div class="p-5">
                                <table class="w-full text-xs">
                                    <thead class="text-gray-500 border-b border-gray-200 dark:border-gray-800">
                                        <tr class="text-left">
                                            <th class="pb-3 font-medium">Jenis</th>
                                            <th class="pb-3 font-medium">Deskripsi</th>
                                            <th class="pb-3 font-medium text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-800 dark:text-gray-300">
                                        <template x-for="(item, index) in microcredentials.slice(0, 2)" :key="index">
                                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                                <td class="py-3 font-medium" x-text="item.name"></td>
                                                <td class="py-3 text-gray-500" x-text="item.description"></td>
                                                <td class="py-3">
                                                    <div class="flex items-center justify-end gap-1">
                                                        <button @click="editMicrocredential(index)" class="p-1.5 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-500/10 rounded transition">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                        </button>
                                                        <button @click="openDeleteModal('microcredential', index)" class="p-1.5 text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10 rounded transition">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- 2. ADMIN & INSTRUKTUR -->
                        <div class="card translate-0">
                            <div class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-500/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">Admin & Instruktur</h3>
                                        <p class="text-xs text-gray-500">Manajemen pengguna</p>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button @click="openModal('admin', 'view')" class="px-3 py-1.5 text-xs text-purple-600 hover:bg-purple-50 dark:hover:bg-purple-500/10 rounded-lg transition font-medium">
                                        Lihat Semua
                                    </button>
                                    <button @click="openModal('admin', 'create')" class="px-3 py-1.5 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-xs font-medium transition">
                                        + Tambah
                                    </button>
                                </div>
                            </div>

                            <div class="p-5 space-y-3">
                                <template x-for="(user, index) in users.slice(0, 2)" :key="index">
                                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                        <div class="flex items-center gap-3">
                                            <img :src="'https://i.pravatar.cc/40?img=' + (index + 3)" class="w-10 h-10 rounded-full" alt="User">
                                            <div>
                                                <p class="font-medium text-gray-800 dark:text-white" x-text="user.name"></p>
                                                <p class="text-xs text-gray-500" x-text="user.role"></p>
                                            </div>
                                        </div>
                                        <div class="flex gap-1">
                                            <button @click="openModal('admin', 'edit', user, index)" class="p-1.5 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-500/10 rounded transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button @click="openDeleteModal('admin', index)" class="p-1.5 text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10 rounded transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- 3. TAHUN AKADEMIK -->
                        <div class="card translate-0">
                            <div class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-amber-100 dark:bg-amber-500/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">Periode Akademik</h3>
                                        <p class="text-xs text-gray-500">Kalender tahun akademik</p>
                                    </div>
                                </div>
                                <button @click="openModal('academic', 'create')" class="px-3 py-1.5 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-xs font-medium transition">
                                    + Tambah
                                </button>
                            </div>

                            <div class="p-5 space-y-3">
                                <template x-for="(year, index) in academicYears" :key="index">
                                    <div class="flex items-center justify-between p-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                        <div>
                                            <p class="font-semibold text-gray-800 dark:text-white" x-text="year.year"></p>
                                            <p class="text-xs text-gray-500 mt-0.5">Status: <span x-text="year.status"></span></p>
                                        </div>
                                        <div class="flex gap-1">
                                            <button @click="openModal('academic', 'edit', year, index)" class="p-1.5 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-500/10 rounded transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button @click="openDeleteModal('academic', index)" class="p-1.5 text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10 rounded transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- 4. SEMESTER -->
                        <div class="card translate-0">
                            <div class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-purple-100 dark:bg-purple-500/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">Semester</h3>
                                        <p class="text-xs text-gray-500">Manajemen semester (ganjil/genap)</p>
                                    </div>
                                </div>
                                <button @click="openModal('semester', 'create')" class="px-3 py-1.5 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-xs font-medium transition">
                                    + Tambah
                                </button>
                            </div>

                            <div class="p-5 space-y-3">
                                <template x-for="(semester, index) in semesters" :key="index">
                                    <div class="flex items-center justify-between p-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800 dark:text-white" x-text="semester.name"></p>
                                            <p class="text-xs text-gray-500 mt-0.5" x-text="'Status: ' + semester.status + ' • ' + semester.period"></p>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <span x-show="semester.status === 'Aktif'" class="px-2 py-0.5 bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-xs font-medium rounded mr-1">
                                                Aktif
                                            </span>
                                            <button @click="openModal('semester', 'edit', semester, index)" class="p-1.5 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-500/10 rounded transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button @click="openDeleteModal('semester', index)" class="p-1.5 text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10 rounded transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </main>

    <!-- UNIVERSAL MODAL -->
    <div x-show="modal.show" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-backdrop" style="background: rgba(0,0,0,0.5);">
        <div @click.away="closeModal()" x-show="modal.show" x-transition class="bg-white dark:bg-[#1A1A2E] rounded-2xl shadow-2xl w-full p-6"
             :class="modal.mode === 'view' ? 'max-w-4xl' : 'max-w-lg'">
            
            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6" x-text="modal.title"></h3>
            
            <div x-show="modal.mode !== 'view'">
                <div class="space-y-4">
                    <template x-for="field in modal.fields" :key="field.name">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" x-text="field.label"></label>
                            <input x-show="field.type !== 'textarea' && field.type !== 'select'" 
                                   :type="field.type || 'text'"
                                   :value="modal.data[field.name] || ''"
                                   @input="modal.data[field.name] = $event.target.value"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" 
                                   :placeholder="field.placeholder">
                            
                            <textarea x-show="field.type === 'textarea'"
                                      :value="modal.data[field.name] || ''"
                                      @input="modal.data[field.name] = $event.target.value"
                                      rows="4"
                                      class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                      :placeholder="field.placeholder"></textarea>
                            
                            <select x-show="field.type === 'select'"
                                    :value="modal.data[field.name] || ''"
                                    @change="modal.data[field.name] = $event.target.value"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                                <template x-for="option in field.options" :key="option">
                                    <option :value="option" x-text="option"></option>
                                </template>
                            </select>
                        </div>
                    </template>
                </div>

                <div class="flex gap-3 mt-6">
                    <button @click="closeModal()" class="flex-1 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition font-medium">
                        Batal
                    </button>
                    <button @click="saveData()" class="flex-1 px-4 py-3 rounded-lg bg-purple-600 text-white hover:bg-purple-700 transition font-medium">
                        Simpan
                    </button>
                </div>
            </div>

            <!-- View All Mode -->
            <div x-show="modal.mode === 'view'">
                <div class="overflow-x-auto max-h-96">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-900/50 sticky top-0">
                            <tr>
                                <template x-for="header in modal.headers" :key="header">
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase" x-text="header"></th>
                                </template>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(item, index) in modal.viewData" :key="index">
                                <tr class="border-t border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                    <template x-for="key in modal.viewKeys" :key="key">
                                        <td class="px-4 py-3 text-gray-800 dark:text-gray-300" x-text="item[key]"></td>
                                    </template>
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <button @click="openEditFromView(modal.type, index)" class="p-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-500/10 rounded transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button @click="openDeleteModal(modal.type, index)" class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-500/10 rounded transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end mt-6">
                    <button @click="closeModal()" class="px-6 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-600 transition font-medium">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- DELETE CONFIRMATION MODAL -->
    <div x-show="deleteModal.show" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-backdrop" style="background: rgba(0,0,0,0.5);">
        <div @click.away="deleteModal.show = false" x-show="deleteModal.show" x-transition class="bg-white dark:bg-[#1A1A2E] rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full bg-red-100 dark:bg-red-500/20">
                <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            
            <h3 class="text-xl font-bold text-center text-gray-800 dark:text-white mb-2">Hapus Data?</h3>
            <p class="text-sm text-center text-gray-500 mb-6">Data yang dihapus tidak dapat dikembalikan. Apakah Anda yakin ingin melanjutkan?</p>

            <div class="flex gap-3">
                <button @click="deleteModal.show = false" class="flex-1 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition font-medium">
                    Batal
                </button>
                <button @click="confirmDelete()" class="flex-1 px-4 py-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition font-medium">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        function dashboardApp() {
            return {
                dark: localStorage.getItem('theme') === 'dark',
                toggleDark() {
                    this.dark = !this.dark;
                    localStorage.setItem('theme', this.dark ? 'dark' : 'light');
                    document.documentElement.classList.toggle('dark', this.dark);
                },
                
                microcredentials: [
                    { name: 'UI/UX Design', description: 'Desain antarmuka modern' },
                    { name: 'Web Development', description: 'Aplikasi web modern' },
                    { name: 'Data Science', description: 'Analisis data dan ML' },
                ],
                
                users: [
                    { name: 'Admin Microcredential', role: 'Kelola sertifikasi' },
                    { name: 'Instruktur', role: 'Mentor kursus' }
                ],
                
                academicYears: [
                    { year: '2024/2025', status: 'Aktif' },
                    { year: '2023/2024', status: 'Tidak Aktif' }
                ],
                
                semesters: [
                    { name: 'Semester Ganjil (2024/2025)', status: 'Aktif', period: 'Sept - Des 2024' }
                ],

                modal: {
                    show: false,
                    mode: 'create',
                    type: '',
                    title: '',
                    fields: [],
                    data: {},
                    editIndex: null,
                    headers: [],
                    viewKeys: [],
                    viewData: []
                },

                deleteModal: {
                    show: false,
                    type: '',
                    index: null
                },

                initApp() {
                    document.documentElement.classList.toggle('dark', this.dark);
                },


                editMicrocredential(index) {
                    const item = this.microcredentials[index];
                    this.openModal('microcredential', 'edit', item, index);
                },

                openModal(type, mode, item = null, index = null) {
                    this.modal.type = type;
                    this.modal.mode = mode;
                    this.modal.editIndex = index;

                    const configs = {
                        microcredential: {
                            title: mode === 'create' ? 'Tambah Jenis Microcredential' : mode === 'edit' ? 'Edit Jenis Microcredential' : 'Semua Jenis Microcredential',
                            fields: [
                                { name: 'name', label: 'Jenis', type: 'text', placeholder: 'Contoh: UI/UX Design' },
                                { name: 'description', label: 'Deskripsi', type: 'textarea', placeholder: 'Deskripsi singkat' }
                            ],
                            headers: ['Jenis', 'Deskripsi'],
                            viewKeys: ['name', 'description'],
                            viewData: this.microcredentials
                        },
                        admin: {
                            title: mode === 'create' ? 'Tambah Admin/Instruktur' : mode === 'edit' ? 'Edit Admin/Instruktur' : 'Semua Admin & Instruktur',
                            fields: [
                                { name: 'name', label: 'Nama', type: 'text', placeholder: 'Nama lengkap' },
                                { name: 'role', label: 'Role', type: 'select', options: ['Admin Microcredential', 'Instruktur', 'Admin Sistem'] }
                            ],
                            headers: ['Nama', 'Role'],
                            viewKeys: ['name', 'role'],
                            viewData: this.users
                        },
                        academic: {
                            title: mode === 'create' ? 'Tambah Periode Akademik' : 'Edit Periode Akademik',
                            fields: [
                                { name: 'year', label: 'Tahun Akademik', type: 'text', placeholder: 'Contoh: 2024/2025' },
                                { name: 'status', label: 'Status', type: 'select', options: ['Aktif', 'Tidak Aktif'] }
                            ],
                            headers: ['Tahun', 'Status'],
                            viewKeys: ['year', 'status'],
                            viewData: this.academicYears
                        },
                        semester: {
                            title: mode === 'create' ? 'Tambah Semester' : 'Edit Semester',
                            fields: [
                                { name: 'name', label: 'Nama Semester', type: 'text', placeholder: 'Contoh: Semester Ganjil (2024/2025)' },
                                { name: 'period', label: 'Periode', type: 'text', placeholder: 'Contoh: Sept - Des 2024' },
                                { name: 'status', label: 'Status', type: 'select', options: ['Aktif', 'Tidak Aktif'] }
                            ],
                            headers: ['Nama Semester', 'Periode', 'Status'],
                            viewKeys: ['name', 'period', 'status'],
                            viewData: this.semesters
                        }
                    };

                    const config = configs[type];
                    this.modal.title = config.title;
                    this.modal.fields = config.fields || [];
                    
                    // Set modal data dengan nilai default
                    if (mode === 'edit' && item) {
                        this.modal.data = { ...item };
                    } else {
                        const defaultData = {};
                        config.fields.forEach(field => {
                            defaultData[field.name] = '';
                        });
                        this.modal.data = defaultData;
                    }
                    
                    this.modal.headers = config.headers || [];
                    this.modal.viewKeys = config.viewKeys || [];
                    this.modal.viewData = config.viewData || [];
                    this.modal.show = true;
                },

                openEditFromView(type, index) {
                    const dataArrays = {
                        microcredential: this.microcredentials,
                        admin: this.users,
                        academic: this.academicYears,
                        semester: this.semesters
                    };

                    const item = dataArrays[type][index];
                    this.openModal(type, 'edit', item, index);
                },

                saveData() {
                    // Validasi input
                    if (!this.modal.data.name || this.modal.data.name.trim() === '') {
                        alert('Nama/Jenis harus diisi!');
                        return;
                    }

                    const dataArrays = {
                        microcredential: this.microcredentials,
                        admin: this.users,
                        academic: this.academicYears,
                        semester: this.semesters
                    };

                    const targetArray = dataArrays[this.modal.type];
                    
                    if (!targetArray) {
                        console.error('Invalid modal type:', this.modal.type);
                        return;
                    }
                    
                    if (this.modal.mode === 'create') {
                        // Pastikan data di-copy dengan benar
                        const newData = {};
                        this.modal.fields.forEach(field => {
                            newData[field.name] = this.modal.data[field.name] || '';
                        });
                        targetArray.push(newData);
                        console.log('Data ditambah:', newData);
                    } else if (this.modal.mode === 'edit' && this.modal.editIndex !== null) {
                        const updatedData = {};
                        this.modal.fields.forEach(field => {
                            updatedData[field.name] = this.modal.data[field.name] || '';
                        });
                        targetArray[this.modal.editIndex] = updatedData;
                        console.log('Data diubah:', updatedData);
                    }

                    this.closeModal();
                },

                openDeleteModal(type, index) {
                    this.deleteModal.type = type;
                    this.deleteModal.index = index;
                    this.deleteModal.show = true;
                },

                confirmDelete() {
                    const dataArrays = {
                        microcredential: this.microcredentials,
                        admin: this.users,
                        academic: this.academicYears,
                        semester: this.semesters
                    };

                    dataArrays[this.deleteModal.type].splice(this.deleteModal.index, 1);
                    this.deleteModal.show = false;
                },

                closeModal() {
                    this.modal.show = false;
                }
            }
        }
    </script>

</body>
</html>