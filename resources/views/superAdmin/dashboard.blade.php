<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Dashboard - Super Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#6C63FF',
                        purple: {
                            500: '#6C63FF',
                            600: '#5B54E6',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .modal-backdrop { backdrop-filter: blur(4px); }
        
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
        
        .dark ::-webkit-scrollbar-track { background: #1a1a2e; }
        .dark ::-webkit-scrollbar-thumb { background: #4a4a6a; }
    </style>
</head>

<body x-data="dashboardApp()" class="bg-gray-100 dark:bg-[#0F0F1A] font-sans">

    <div class="flex h-screen overflow-hidden" x-init="init()">

        <!-- SIDEBAR -->
        <aside class="w-56 bg-white dark:bg-[#1A1A2E] border-r border-gray-200 dark:border-gray-800 flex flex-col flex-shrink-0">
            <div class="p-5 pb-4">
                <div class="text-2xl font-bold">
                    <span class="text-purple-600">FL</span><span class="text-purple-600">OOX</span>
                </div>
            </div>

            <nav class="flex-1 px-3 space-y-1">
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 font-medium text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7" />
                        <rect x="14" y="3" width="7" height="7" />
                        <rect x="14" y="14" width="7" height="7" />
                        <rect x="3" y="14" width="7" height="7" />
                    </svg>
                    Dashboard
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Courses
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Tugas
                </a>
            </nav>

            <div class="p-3 border-t border-gray-200 dark:border-gray-800">
                <div class="flex items-center gap-2 mb-2">
                    <img src="https://i.pravatar.cc/32?img=5" class="w-8 h-8 rounded-full" alt="User">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-gray-800 dark:text-white truncate">P Abraham</p>
                        <p class="text-xs text-gray-500">Peserta Aktif</p>
                    </div>
                </div>
                <button class="w-full flex items-center gap-2 px-3 py-2 text-xs text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 flex flex-col overflow-hidden">

            <!-- TOP BAR -->
            <header class="bg-white dark:bg-[#1A1A2E] border-b border-gray-200 dark:border-gray-800 px-5 py-3 flex-shrink-0">
                <div class="flex items-center justify-between">
                    <div class="flex-1 max-w-2xl">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.35-4.35" />
                            </svg>
                            <input type="text" placeholder="Cari course, tugas, materi..." class="w-full pl-10 pr-4 py-2 bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg text-sm text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                    </div>

                    <div class="flex items-center gap-2 ml-4">
                        <button class="relative p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                            <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                                <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                            </svg>
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <button @click="toggleDark()" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                            <svg x-show="!dark" class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                            </svg>
                            <svg x-show="dark" class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="4" />
                                <path d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41" />
                            </svg>
                        </button>

                        <div class="flex items-center gap-2 ml-2">
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-800 dark:text-white">Sara Abraham</p>
                                <a href="#" class="text-xs text-purple-600 hover:underline">Lihat profil</a>
                            </div>
                            <img src="https://i.pravatar.cc/40?img=1" class="w-9 h-9 rounded-full border-2 border-purple-200" alt="Profile">
                        </div>
                    </div>
                </div>
            </header>

            <!-- SCROLLABLE CONTENT -->
            <div class="flex-1 overflow-y-auto">
                <div class="p-5 space-y-5">

                    <!-- BANNER -->
                    <div class="relative bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-7 text-white overflow-hidden">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/4"></div>
                        <div class="absolute bottom-0 right-20 w-48 h-48 bg-white/5 rounded-full translate-y-1/2"></div>
                        
                        <div class="relative flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-xs font-semibold opacity-90 mb-2 tracking-wide">MICROCREDENTIAL PROGRAM</p>
                                <h2 class="text-3xl font-bold mb-2">Selamat datang, Sara! 👋</h2>
                                <p class="text-white/90 mb-1 text-sm">Kamu memiliki <strong>3 tugas</strong> yang mendekati deadline.</p>
                                <p class="text-white/80 mb-5 text-sm">Yuk selesaikan sebelum terlambat!</p>
                                
                                <div class="flex gap-3">
                                    <button class="px-5 py-2 bg-white text-purple-600 rounded-lg font-medium hover:bg-gray-50 transition text-sm">
                                        Lihat Tugas
                                    </button>
                                    <button class="px-5 py-2 bg-purple-400 text-white rounded-lg font-medium hover:bg-purple-300 transition text-sm">
                                        Lanjut Belajar
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-col items-center">
                                <div class="relative w-28 h-28">
                                    <svg class="w-full h-full transform -rotate-90">
                                        <circle cx="56" cy="56" r="50" stroke="currentColor" stroke-width="7" fill="none" class="text-white/20" />
                                        <circle cx="56" cy="56" r="50" stroke="currentColor" stroke-width="7" fill="none" class="text-white" 
                                            stroke-dasharray="314" 
                                            stroke-dashoffset="94"
                                            stroke-linecap="round" />
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-2xl font-bold">70%</span>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm font-medium">Progress Overall</p>
                            </div>
                        </div>
                    </div>

                    <!-- STAT CARDS -->
                    <div class="grid grid-cols-4 gap-4">
                        <div class="bg-white dark:bg-[#1A1A2E] rounded-xl p-4 border border-gray-200 dark:border-gray-800">
                            <div class="flex items-start justify-between mb-3">
                                <div class="w-10 h-10 bg-purple-100 dark:bg-purple-500/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <span class="px-2 py-0.5 bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-xs font-medium rounded">Aktif</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-1">4</h3>
                            <p class="text-xs text-gray-500">Course Diambil</p>
                        </div>

                        <div class="bg-white dark:bg-[#1A1A2E] rounded-xl p-4 border border-gray-200 dark:border-gray-800">
                            <div class="flex items-start justify-between mb-3">
                                <div class="w-10 h-10 bg-orange-100 dark:bg-orange-500/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <span class="px-2 py-0.5 bg-orange-100 dark:bg-orange-500/10 text-orange-600 dark:text-orange-400 text-xs font-medium rounded">3 pending</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-1">12</h3>
                            <p class="text-xs text-gray-500">Total Tugas</p>
                        </div>

                        <div class="bg-white dark:bg-[#1A1A2E] rounded-xl p-4 border border-gray-200 dark:border-gray-800">
                            <div class="flex items-start justify-between mb-3">
                                <div class="w-10 h-10 bg-green-100 dark:bg-green-500/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <span class="px-2 py-0.5 bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-xs font-medium rounded">1 Baik</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-1">87.5</h3>
                            <p class="text-xs text-gray-500">Rata-rata Nilai</p>
                        </div>

                        <div class="bg-white dark:bg-[#1A1A2E] rounded-xl p-4 border border-gray-200 dark:border-gray-800">
                            <div class="flex items-start justify-between mb-3">
                                <div class="w-10 h-10 bg-pink-100 dark:bg-pink-500/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                </div>
                                <span class="px-2 py-0.5 bg-purple-100 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 text-xs font-medium rounded">2 baru</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-1">5</h3>
                            <p class="text-xs text-gray-500">Sertifikat</p>
                        </div>
                    </div>

                    <!-- CRUD SECTIONS IN GRID -->
                    <div class="grid grid-cols-2 gap-5">

                        <!-- 1. JENIS MICROCREDENTIAL -->
                        <div class="bg-white dark:bg-[#1A1A2E] rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                            <div class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-pink-100 dark:bg-pink-500/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Jenis Microcredential</h3>
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
                        <div class="bg-white dark:bg-[#1A1A2E] rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                            <div class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-500/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Admin & Instruktur</h3>
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
                                                <p class="text-sm font-medium text-gray-800 dark:text-white" x-text="user.name"></p>
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
                        <div class="bg-white dark:bg-[#1A1A2E] rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                            <div class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-amber-100 dark:bg-amber-500/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Periode Akademik</h3>
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
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white" x-text="year.year"></p>
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
                        <div class="bg-white dark:bg-[#1A1A2E] rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                            <div class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-purple-100 dark:bg-purple-500/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Semester</h3>
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
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white" x-text="semester.name"></p>
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

        <!-- RIGHT SIDEBAR - Kalender -->
        <aside class="w-72 bg-white dark:bg-[#1A1A2E] border-l border-gray-200 dark:border-gray-800 overflow-y-auto flex-shrink-0">
            <div class="p-5 space-y-5">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Kalender</h3>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <button @click="prevMonth()" class="hover:text-gray-800 dark:hover:text-white">&lt;</button>
                            <span x-text="monthYear"></span>
                            <button @click="nextMonth()" class="hover:text-gray-800 dark:hover:text-white">&gt;</button>
                        </div>
                    </div>

                    <div class="grid grid-cols-7 gap-1 text-center text-xs mb-2">
                        <div class="text-gray-500 font-medium py-1">Sen</div>
                        <div class="text-gray-500 font-medium py-1">Sel</div>
                        <div class="text-gray-500 font-medium py-1">Rab</div>
                        <div class="text-gray-500 font-medium py-1">Kam</div>
                        <div class="text-gray-500 font-medium py-1">Jum</div>
                        <div class="text-gray-500 font-medium py-1">Sab</div>
                        <div class="text-gray-500 font-medium py-1">Min</div>
                    </div>

                    <div class="grid grid-cols-7 gap-1 text-center text-xs">
                        <template x-for="(day, idx) in calendarDays" :key="idx">
                            <div class="aspect-square flex items-center justify-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer transition"
                                 :class="{
                                    'bg-purple-600 text-white font-semibold': day === today && !isOtherMonth(idx),
                                    'bg-yellow-100 dark:bg-yellow-500/20 text-yellow-700 dark:text-yellow-400 font-medium': day === 22 && !isOtherMonth(idx),
                                    'text-red-600 font-medium': day === 19 && !isOtherMonth(idx),
                                    'bg-green-100 dark:bg-green-500/10 text-green-700 dark:text-green-400': day === 28 && !isOtherMonth(idx),
                                    'text-purple-600 font-medium': day === 25 && !isOtherMonth(idx),
                                    'text-gray-400': isOtherMonth(idx),
                                    'text-gray-800 dark:text-gray-300': !isOtherMonth(idx) && day !== today && day !== 22 && day !== 19 && day !== 28 && day !== 25
                                 }"
                                 x-text="day">
                            </div>
                        </template>
                    </div>

                    <div class="mt-4 space-y-2 text-xs">
                        <div class="flex items-center gap-2">
                            <div class="w-2.5 h-2.5 bg-red-500 rounded-full"></div>
                            <span class="text-gray-600 dark:text-gray-400">Terlambat</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-2.5 h-2.5 bg-yellow-500 rounded-full"></div>
                            <span class="text-gray-600 dark:text-gray-400">Segera</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-2.5 h-2.5 bg-purple-500 rounded-full"></div>
                            <span class="text-gray-600 dark:text-gray-400">Deadline</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-2.5 h-2.5 bg-green-500 rounded-full"></div>
                            <span class="text-gray-600 dark:text-gray-400">Tugas baru</span>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Semua Tugas</h3>
                        <button class="text-xs text-purple-600 hover:underline font-medium">Filter</button>
                    </div>

                    <div class="space-y-2">
                        <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg">
                            <div class="flex items-start justify-between mb-1">
                                <h4 class="text-xs font-medium text-gray-800 dark:text-white">UI/UX Case Study</h4>
                                <span class="px-1.5 py-0.5 bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs rounded font-medium">Terlambat</span>
                            </div>
                            <p class="text-xs text-gray-500">UI/UX Design · 19 Apr</p>
                        </div>

                        <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg">
                            <div class="flex items-start justify-between mb-1">
                                <h4 class="text-xs font-medium text-gray-800 dark:text-white">Analisis Sorting</h4>
                                <span class="px-1.5 py-0.5 bg-yellow-100 dark:bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 text-xs rounded font-medium">Segera</span>
                            </div>
                            <p class="text-xs text-gray-500">DSA · 22 Apr</p>
                        </div>

                        <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg">
                            <div class="flex items-start justify-between mb-1">
                                <h4 class="text-xs font-medium text-gray-800 dark:text-white">Business Model Canvas</h4>
                                <span class="px-1.5 py-0.5 bg-blue-100 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs rounded font-medium">On Track</span>
                            </div>
                            <p class="text-xs text-gray-500">Entrepreneurship · 25 Apr</p>
                        </div>

                        <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg">
                            <div class="flex items-start justify-between mb-1">
                                <h4 class="text-xs font-medium text-gray-800 dark:text-white">SEO Content Strategy</h4>
                                <span class="px-1.5 py-0.5 bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-xs rounded font-medium">Baru</span>
                            </div>
                            <p class="text-xs text-gray-500">Digital Marketing · 28 Apr</p>
                        </div>

                        <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg">
                            <div class="flex items-start justify-between mb-1">
                                <h4 class="text-xs font-medium text-gray-800 dark:text-white">Wireframe Prototype</h4>
                                <span class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs rounded font-medium">Selesai</span>
                            </div>
                            <p class="text-xs text-gray-500">UI/UX Design · 15 Apr</p>
                        </div>

                        <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg">
                            <div class="flex items-start justify-between mb-1">
                                <h4 class="text-xs font-medium text-gray-800 dark:text-white">Array & Linked List Quiz</h4>
                                <span class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs rounded font-medium">Selesai</span>
                            </div>
                            <p class="text-xs text-gray-500">DSA · 10 Apr</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

    </div>

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
                dark: false,
                
                // Calendar properties
                currentDate: new Date(),
                today: new Date().getDate(),
                monthYear: '',
                calendarDays: [],
                
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

                init() {
                    this.updateCalendar();
                },

                updateCalendar() {
                    const year = this.currentDate.getFullYear();
                    const month = this.currentDate.getMonth();
                    
                    // Update month year display
                    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 
                                      'July', 'August', 'September', 'October', 'November', 'December'];
                    this.monthYear = monthNames[month] + ' ' + year;
                    
                    // Get first day of month
                    const firstDay = new Date(year, month, 1).getDay();
                    const daysInMonth = new Date(year, month + 1, 0).getDate();
                    const daysInPrevMonth = new Date(year, month, 0).getDate();
                    
                    this.calendarDays = [];
                    
                    // Add previous month days
                    for (let i = firstDay - 1; i >= 0; i--) {
                        this.calendarDays.push(daysInPrevMonth - i);
                    }
                    
                    // Add current month days
                    for (let i = 1; i <= daysInMonth; i++) {
                        this.calendarDays.push(i);
                    }
                    
                    // Add next month days
                    const remainingDays = 42 - this.calendarDays.length;
                    for (let i = 1; i <= remainingDays; i++) {
                        this.calendarDays.push(i);
                    }

                    // Update today if in current month
                    const todayDate = new Date();
                    if (todayDate.getFullYear() === year && todayDate.getMonth() === month) {
                        this.today = todayDate.getDate();
                    } else {
                        this.today = -1;
                    }
                },

                isOtherMonth(index) {
                    const firstDay = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), 1).getDay();
                    const daysInMonth = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 0).getDate();
                    return index < firstDay || index >= firstDay + daysInMonth;
                },

                prevMonth() {
                    this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() - 1);
                    this.updateCalendar();
                },

                nextMonth() {
                    this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1);
                    this.updateCalendar();
                },

                toggleDark() {
                    this.dark = !this.dark;
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