<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Dashboard - Super Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .modal-backdrop {
            backdrop-filter: blur(4px);
        }
    </style>
</head>

<body x-data="dashboardApp()" x-init="initApp()" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <x-leftPanel />

        <!-- MAIN CONTENT -->
        <main class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Nav -->
            <x-topNav />

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
                            <div
                                class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-pink-100 dark:bg-pink-500/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">Jenis Microcredential
                                        </h3>
                                        <p class="text-xs text-gray-500">Kelola kategori sertifikasi</p>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ url('/super-admin/jenis-microcredential') }}"
                                        class="flex items-center gap-1 px-3 py-1.5 text-xs text-[#6C63FF] hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg transition font-medium">
                                        Lihat Semua
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div class="p-5">
                                <table class="w-full text-xs">
                                    <thead class="text-gray-500 border-b border-gray-200 dark:border-gray-800">
                                        <tr class="text-left">
                                            <th class="pb-3 font-medium">Jenis</th>
                                            <th class="pb-3 font-medium">Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-800 dark:text-gray-300">
                                        <template x-for="(item, index) in microcredentials.slice(0, 3)"
                                            :key="index">
                                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                                <td class="py-3 font-medium" x-text="item.name"></td>
                                                <td class="py-3 text-gray-500" x-text="item.description"></td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- 2. ADMIN & INSTRUKTUR -->
                        <div class="card translate-0">
                            <div
                                class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-blue-100 dark:bg-blue-500/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">Admin & Instruktur</h3>
                                        <p class="text-xs text-gray-500">Manajemen pengguna</p>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ url('/super-admin/program-microcredential') }}"
                                        class="flex items-center gap-1 px-3 py-1.5 text-xs text-[#6C63FF] hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg transition font-medium">
                                        Lihat Semua
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div class="p-5 space-y-3">
                                <template x-for="(user, index) in users.slice(0, 3)" :key="index">
                                    <div
                                        class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                        <div class="flex items-center gap-3">
                                            <img :src="'https://i.pravatar.cc/40?img=' + (index + 3)"
                                                class="w-10 h-10 rounded-full" alt="User">
                                            <div>
                                                <p class="font-medium text-gray-800 dark:text-white" x-text="user.name">
                                                </p>
                                                <p class="text-xs text-gray-500" x-text="user.role"></p>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <span x-show="user.status === 'Aktif'" class="px-2 py-0.5 bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-[10px] font-medium rounded">Aktif</span>
                                            <span x-show="user.status === 'Tidak Aktif'" class="px-2 py-0.5 bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-[10px] font-medium rounded">Tidak Aktif</span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>



                        <!-- 3. PROGRAM MICROCREDENTIAL -->
                        <div class="card translate-0">
                            <div
                                class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-indigo-100 dark:bg-indigo-500/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">Program Microcredential
                                        </h3>
                                        <p class="text-xs text-gray-500">Manajemen program & kursus</p>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ url('/super-admin/program') }}"
                                        class="flex items-center gap-1 px-3 py-1.5 text-xs text-[#6C63FF] hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg transition font-medium">
                                        Lihat Semua
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div class="p-5 space-y-3">
                                <template x-for="(program, index) in programs.slice(0, 3)" :key="index">
                                    <div
                                        class="flex items-center justify-between p-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800 dark:text-white"
                                                x-text="program.name"></p>
                                            <p class="text-xs text-gray-500 mt-0.5" x-text="program.type"></p>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <span x-show="program.status === 'buka'"
                                                class="px-2 py-0.5 bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-xs font-medium rounded mr-1">Buka</span>
                                            <span x-show="program.status === 'tutup'"
                                                class="px-2 py-0.5 bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs font-medium rounded mr-1">Tutup</span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- 4. SEMESTER -->
                        <div class="card translate-0">
                            <div
                                class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-purple-100 dark:bg-purple-500/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">Semester</h3>
                                        <p class="text-xs text-gray-500">Manajemen semester (ganjil/genap)</p>
                                    </div>
                                </div>
                                <a href="{{ url('/super-admin/semester') }}"
                                    class="flex items-center gap-1 px-3 py-1.5 text-xs text-[#6C63FF] hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg transition font-medium">
                                    Lihat Semua
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>

                            <div class="p-5 space-y-3">
                                <template x-for="(semester, index) in semesters.slice(0, 3)" :key="index">
                                    <div
                                        class="flex items-center justify-between p-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800 dark:text-white"
                                                x-text="semester.name"></p>
                                            <p class="text-xs text-gray-500 mt-0.5"
                                                x-text="'Status: ' + semester.status + ' • ' + semester.period"></p>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <span x-show="semester.status === 'Aktif'"
                                                class="px-2 py-0.5 bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-xs font-medium rounded mr-1">
                                                Aktif
                                            </span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </main>

        <!--right panel-->
        <x-rightPanel />



        <!-- UNIVERSAL MODAL -->
        <div x-show="modal.show" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-backdrop"
            style="background: rgba(0,0,0,0.5);">
            <div @click.away="closeModal()" x-show="modal.show" x-transition
                class="bg-white dark:bg-[#1A1A2E] rounded-2xl shadow-2xl w-full p-6"
                :class="modal.mode === 'view' ? 'max-w-4xl' : 'max-w-lg'">

                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6" x-text="modal.title"></h3>

                <div x-show="modal.mode !== 'view'">
                    <div class="space-y-4">
                        <template x-for="field in modal.fields" :key="field.name">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                    x-text="field.label"></label>
                                <input x-show="field.type !== 'textarea' && field.type !== 'select'"
                                    :type="field.type || 'text'" :value="modal.data[field.name] || ''"
                                    @input="modal.data[field.name] = $event.target.value"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                    :placeholder="field.placeholder">

                                <textarea x-show="field.type === 'textarea'" :value="modal.data[field.name] || ''"
                                    @input="modal.data[field.name] = $event.target.value" rows="4"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                    :placeholder="field.placeholder"></textarea>

                                <select x-show="field.type === 'select'" :value="modal.data[field.name] || ''"
                                    @change="modal.data[field.name] = $event.target.value"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition">
                                    <template x-for="option in field.options" :key="option">
                                        <option :value="option" x-text="option"></option>
                                    </template>
                                </select>
                            </div>
                        </template>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <button @click="closeModal()"
                            class="inline-flex items-center justify-center gap-1.5 flex-1 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition font-medium">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span>Batal</span>
                        </button>
                        <button @click="saveData()"
                            class="flex-1 px-4 py-3 rounded-lg bg-purple-600 text-white hover:bg-purple-700 transition font-medium">
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
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase"
                                            x-text="header"></th>
                                    </template>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase text-center">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(item, index) in modal.viewData" :key="index">
                                    <tr
                                        class="border-t border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                        <template x-for="key in modal.viewKeys" :key="key">
                                            <td class="px-4 py-3 text-gray-800 dark:text-gray-300" x-text="item[key]">
                                            </td>
                                        </template>
                                        <td class="px-4 py-3 text-right">
                                            <div class="flex justify-center gap-1">
                                                <button @click="openEditFromView(modal.type, index)"
                                                    class="group w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200"
                                                    title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-4 h-4 transform group-hover:scale-110 transition"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path d="M12 20h9" />
                                                        <path
                                                            d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                                                    </svg>
                                                </button>
                                                <button @click="openDeleteModal(modal.type, index)"
                                                    class="group w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-4 h-4 transform group-hover:scale-110 transition"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <polyline points="3 6 5 6 21 6" />
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                        <path d="M10 11v6" />
                                                        <path d="M14 11v6" />
                                                        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
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
                        <button @click="closeModal()"
                            class="px-6 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-600 transition font-medium">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- DELETE CONFIRMATION MODAL -->
        <div x-show="deleteModal.show" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-backdrop"
            style="background: rgba(0,0,0,0.5);">
            <div @click.away="deleteModal.show = false" x-show="deleteModal.show" x-transition
                class="bg-white dark:bg-[#1A1A2E] rounded-2xl shadow-2xl max-w-md w-full p-6">
                <div
                    class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full bg-red-100 dark:bg-red-500/20">
                    <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-center text-gray-800 dark:text-white mb-2">Hapus Data?</h3>
                <p class="text-sm text-center text-gray-500 mb-6">Data yang dihapus tidak dapat dikembalikan. Apakah
                    Anda yakin ingin melanjutkan?</p>

                <div class="flex gap-3">
                    <button @click="deleteModal.show = false"
                        class="flex-1 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition font-medium">
                        Batal
                    </button>
                    <button @click="confirmDelete()"
                        class="flex-1 px-4 py-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition font-medium">
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

                    microcredentials: [{
                            name: 'UI/UX Design',
                            description: 'Desain antarmuka modern'
                        },
                        {
                            name: 'Web Development',
                            description: 'Aplikasi web modern'
                        },
                        {
                            name: 'Data Science',
                            description: 'Analisis data dan ML'
                        },
                    ],

                    users: [{
                            name: 'Admin Microcredential',
                            role: 'Kelola sertifikasi',
                            status: 'Aktif'
                        },
                        {
                            name: 'Instruktur',
                            role: 'Mentor kursus',
                            status: 'Tidak Aktif'
                        }
                    ],

                    academicYears: [{
                            year: '2024/2025',
                            status: 'Aktif'
                        },
                        {
                            year: '2023/2024',
                            status: 'Tidak Aktif'
                        }
                    ],

                    programs: [{
                            name: 'UI/UX Design Specialist',
                            type: 'UI/UX Design',
                            status: 'buka'
                        },
                        {
                            name: 'Data Science Bootcamp',
                            type: 'Data Science',
                            status: 'tutup'
                        }
                    ],

                    semesters: [{
                        name: 'Semester Ganjil (2024/2025)',
                        status: 'Aktif',
                        period: 'Sept - Des 2024'
                    }],

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
                                title: mode === 'create' ? 'Tambah Jenis Microcredential' : mode === 'edit' ?
                                    'Edit Jenis Microcredential' : 'Semua Jenis Microcredential',
                                fields: [{
                                        name: 'name',
                                        label: 'Jenis',
                                        type: 'text',
                                        placeholder: 'Contoh: UI/UX Design'
                                    },
                                    {
                                        name: 'description',
                                        label: 'Deskripsi',
                                        type: 'textarea',
                                        placeholder: 'Deskripsi singkat'
                                    }
                                ],
                                headers: ['Jenis', 'Deskripsi'],
                                viewKeys: ['name', 'description'],
                                viewData: this.microcredentials
                            },
                            admin: {
                                title: mode === 'create' ? 'Tambah Admin/Instruktur' : mode === 'edit' ?
                                    'Edit Admin/Instruktur' : 'Semua Admin & Instruktur',
                                fields: [{
                                        name: 'name',
                                        label: 'Nama',
                                        type: 'text',
                                        placeholder: 'Nama lengkap'
                                    },
                                    {
                                        name: 'role',
                                        label: 'Role',
                                        type: 'select',
                                        options: ['Admin Microcredential', 'Instruktur', 'Admin Sistem']
                                    },
                                    {
                                        name: 'status',
                                        label: 'Status',
                                        type: 'select',
                                        options: ['Aktif', 'Tidak Aktif']
                                    }
                                ],
                                headers: ['Nama', 'Role', 'Status'],
                                viewKeys: ['name', 'role', 'status'],
                                viewData: this.users
                            },
                            academic: {
                                title: mode === 'create' ? 'Tambah Periode Akademik' : 'Edit Periode Akademik',
                                fields: [{
                                        name: 'year',
                                        label: 'Tahun Akademik',
                                        type: 'text',
                                        placeholder: 'Contoh: 2024/2025'
                                    },
                                    {
                                        name: 'status',
                                        label: 'Status',
                                        type: 'select',
                                        options: ['Aktif', 'Tidak Aktif']
                                    }
                                ],
                                headers: ['Tahun', 'Status'],
                                viewKeys: ['year', 'status'],
                                viewData: this.academicYears
                            },
                            semester: {
                                title: mode === 'create' ? 'Tambah Semester' : 'Edit Semester',
                                fields: [{
                                        name: 'name',
                                        label: 'Nama Semester',
                                        type: 'text',
                                        placeholder: 'Contoh: Semester Ganjil (2024/2025)'
                                    },
                                    {
                                        name: 'period',
                                        label: 'Periode',
                                        type: 'text',
                                        placeholder: 'Contoh: Sept - Des 2024'
                                    },
                                    {
                                        name: 'status',
                                        label: 'Status',
                                        type: 'select',
                                        options: ['Aktif', 'Tidak Aktif']
                                    }
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
                            this.modal.data = {
                                ...item
                            };
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
