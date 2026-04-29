<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Peserta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body x-data="{
    dark: localStorage.getItem('theme') === 'dark',
    toggleDark() {
        this.dark = !this.dark;
        localStorage.setItem('theme', this.dark ? 'dark' : 'light');
        document.documentElement.classList.toggle('dark', this.dark);
    }
}" x-init="document.documentElement.classList.toggle('dark', dark)" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <!-- Alpine.js -->

    <div class="flex h-screen overflow-hidden">

        <!-- ===== LEFT PANEL ===== -->
        <x-leftPanel />

        <!-- ===== MAIN CONTENT ===== -->
        <div class="flex flex-1 min-w-0 overflow-hidden">

            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">

                <!-- Topbar -->
                <div
                    class="flex items-center gap-3 px-4 py-3 bg-gray-100 dark:bg-[#1A1A2E] border-b border-black/5 dark:border-white/5 flex-shrink-0 transition-all duration-300">
                    <!-- Mobile left toggle -->
                    <button onclick="document.getElementById('leftPanel').classList.toggle('-translate-x-full')"
                        class="md:hidden w-9 h-9 flex items-center justify-center rounded-lg bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <line x1="3" y1="12" x2="21" y2="12" />
                            <line x1="3" y1="18" x2="21" y2="18" />
                        </svg>
                    </button>

                    <!-- Search -->
                    <div
                        class="flex-1 flex items-center gap-2 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 flex-shrink-0"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                        <input type="text" placeholder="Cari course, tugas, materi..."
                            class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                    </div>

                    <!-- Notification -->
                    <button
                        class="relative w-9 h-9 flex items-center justify-center rounded-lg bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-primary transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- Dark mode toggle -->
                    <button @click="toggleDark()"
                        class="w-14 h-8 flex items-center rounded-full p-1 transition-all duration-300"
                        :class="dark ? 'bg-gray-700' : 'bg-gray-300'">

                        <div :class="dark ? 'translate-x-6' : 'translate-x-0'"
                            class="w-6 h-6 bg-white dark:bg-[#1A1A2E] rounded-full shadow-md transform transition-all duration-300 flex items-center justify-center">

                            {{-- Moon Icon --}}
                            <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4 text-gray-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                            </svg>

                            {{-- Sun Icon --}}
                            <svg x-show="dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4 text-yellow-300">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                            </svg>
                        </div>
                    </button>


                    <!-- Mobile right toggle -->
                    <button onclick="document.getElementById('rightPanel').classList.toggle('translate-x-full')"
                        class="lg:hidden w-9 h-9 flex items-center justify-center rounded-lg bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                    </button>
                </div>

                <!-- Scrollable content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    <!-- Welcome Banner -->
                    <x-banner />

                    <!-- Stat Cards -->
                    <x-stats />

                    <!-- Main Grid -->
                    <section class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                        <!-- LEFT: TABLE -->
                        <div class="card translate-0 xl:col-span-2 p-4">

                            <!-- Header -->
                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 flex items-center justify-center rounded-xl bg-pink-100 dark:bg-pink-500/20 text-pink-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                            <path d="M14 2v6h6" />
                                            <path d="M8 10h8" />
                                            <path d="M8 14h4" />
                                            <path d="M8 18h4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">
                                            Jenis Microcredential
                                        </h3>
                                        <p class="text-xs text-gray-500">Kelola kategori sertifikasi</p>
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <button class="text-xs text-primary  font-medium px-3 py-1.5 rounded-lg transition"
                                        style="background:rgba(108,99,255,0.10)">Lihat Semua</button>
                                    <button
                                        class="bg-primary text-white text-sm px-3 py-1.5 rounded-lg shadow-sm transition">
                                        + Tambah
                                    </button>
                                </div>
                            </div>

                            <!-- Table -->
                            <div
                                class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800 transition-all duration-300">
                                <table class="w-full text-sm">
                                    <thead class="text-gray-500 transition-all duration-300">
                                        <tr class="text-left">
                                            <th class="px-4 py-3">Jenis</th>
                                            <th class="px-4 py-3">Deskripsi</th>
                                            <th class="px-4 py-3 text-right">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="">
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-300">
                                            <td class="px-4 py-4 font-medium">UI/UX Design</td>
                                            <td class="px-4 py-4 text-gray-500">Desain antarmuka modern</td>
                                            <td class="px-4 py-4 text-right space-x-2">
                                                <div class="flex justify-end gap-2">

                                                    <!-- Edit -->
                                                    <button
                                                        class="group w-9 h-9 flex items-center justify-center rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200">

                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-4 h-4 transform group-hover:scale-110 transition"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path d="M12 20h9" />
                                                            <path
                                                                d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                                                        </svg>
                                                    </button>

                                                    <!-- Delete -->
                                                    <button
                                                        class="group w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200">

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

                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-300">
                                            <td class="px-4 py-4 font-medium">Web Development</td>
                                            <td class="px-4 py-4 text-gray-500">Aplikasi web modern</td>
                                            <td class="px-4 py-4 text-right space-x-2">
                                                <div class="flex justify-end gap-2">

                                                    <!-- Edit -->
                                                    <button
                                                        class="group w-9 h-9 flex items-center justify-center rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200">

                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-4 h-4 transform group-hover:scale-110 transition"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path d="M12 20h9" />
                                                            <path
                                                                d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                                                        </svg>
                                                    </button>

                                                    <!-- Delete -->
                                                    <button
                                                        class="group w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200">

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
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <!-- RIGHT: LIST -->
                        <div class="card translate-0 p-4">

                            <!-- Header -->
                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 flex items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-500/20 text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                            <circle cx="9" cy="7" r="4" />
                                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">
                                            Admin & Instruktur
                                        </h3>
                                        <p class="text-xs text-gray-500">Manajemen pengguna</p>
                                    </div>
                                </div>

                                <button class="text-xs text-primary font-medium px-3 py-1.5 rounded-lg transition"
                                    style="background:rgba(108,99,255,0.10)">Lihat Semua</button>
                            </div>

                            <!-- List -->
                            <div class="space-y-3">

                                <!-- Item -->
                                <div
                                    class="group flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition cursor-pointer">
                                    <div class="flex items-center gap-3">
                                        <img src="https://i.pravatar.cc/40?img=1"
                                            class="w-11 h-11 rounded-full ring-2 ring-pink-500/30">

                                        <div>
                                            <p class="text-sm font-medium text-gray-800 dark:text-white">
                                                Admin Microcredential
                                            </p>
                                            <p class="text-xs text-gray-500">Kelola sertifikasi</p>
                                        </div>
                                    </div>

                                    <a href="https://wa.me/628123456789?text=Halo%20Admin%20Microcredential%2C%20saya%20ingin%20bertanya"
                                        target="_blank" rel="noopener noreferrer"
                                        class="flex items-center justify-center w-9 h-9 rounded-lg bg-green-50 dark:bg-green-500/10 text-green-500 hover:bg-green-500 hover:text-white transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-4 h-4 transform group-hover:scale-110 transition">
                                            <path
                                                d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z" />
                                            <path d="m21.854 2.147-10.94 10.939" />
                                        </svg>
                                    </a>
                                </div>

                                <!-- Item -->
                                <div
                                    class="group flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition cursor-pointer">
                                    <div class="flex items-center gap-3">
                                        <img src="https://i.pravatar.cc/40?img=2"
                                            class="w-11 h-11 rounded-full ring-2 ring-pink-500/30">

                                        <div>
                                            <p class="text-sm font-medium text-gray-800 dark:text-white">
                                                Instruktur
                                            </p>
                                            <p class="text-xs text-gray-500">Mentor kursus</p>
                                        </div>
                                    </div>

                                    <a href="https://wa.me/628123456789?text=Halo%20Instruktur%2C%20saya%20mau%20bertanya"
                                        target="_blank" rel="noopener noreferrer"
                                        class="flex items-center justify-center w-9 h-9 rounded-lg bg-green-50 dark:bg-green-500/10 text-green-500 hover:bg-green-500 hover:text-white transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-4 h-4 transform group-hover:scale-110 transition">
                                            <path
                                                d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z" />
                                            <path d="m21.854 2.147-10.94 10.939" />
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        </div>

                    </section>

                    <!-- Tahun Akademik & Semester Section -->
                    <section class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                        <!-- Tahun Akademik Card -->
                        <div class="card translate-0 p-4">
                            <!-- Header -->
                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 flex items-center justify-center shrink-0 rounded-xl bg-amber-100 dark:bg-amber-500/20 text-amber-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path
                                                d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">
                                            Tahun Akademik
                                        </h3>
                                        <p class="text-xs text-gray-500">Manajemen tahun akademik</p>
                                    </div>
                                </div>

                                <button
                                    class="bg-primary text-white text-sm px-3 py-1.5 rounded-lg shadow-sm transition">
                                    + Tambah
                                </button>
                            </div>

                            <!-- Content -->
                            <div class="space-y-3">
                                <!-- Item -->
                                <div
                                    class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                                    <div>
                                        <p class="font-semibold text-gray-800 dark:text-white">2024/2025</p>
                                        <p class="text-xs text-gray-500 mt-1">Status: Aktif</p>
                                    </div>
                                    <div class="flex gap-2">
                                        <button
                                            class="group w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9" />
                                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                                            </svg>
                                        </button>
                                        <button
                                            class="group w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                <path d="M10 11v6" />
                                                <path d="M14 11v6" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Item -->
                                <div
                                    class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                                    <div>
                                        <p class="font-semibold text-gray-800 dark:text-white">2023/2024</p>
                                        <p class="text-xs text-gray-500 mt-1">Status: Tidak Aktif</p>
                                    </div>
                                    <div class="flex gap-2">
                                        <button
                                            class="group w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9" />
                                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                                            </svg>
                                        </button>
                                        <button
                                            class="group w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                <path d="M10 11v6" />
                                                <path d="M14 11v6" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Semester Card -->
                        <div class="card translate-0 p-4">
                            <!-- Header -->
                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 flex items-center justify-center shrink-0 rounded-xl bg-purple-100 dark:bg-purple-500/20 text-purple-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            <circle cx="12" cy="12" r="10" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">
                                            Semester
                                        </h3>
                                        <p class="text-xs text-gray-500">Manajemen semester (ganjil/genap)</p>
                                    </div>
                                </div>

                                <button
                                    class="bg-primary text-white text-sm px-3 py-1.5 rounded-lg shadow-sm transition">
                                    + Tambah
                                </button>
                            </div>

                            <!-- Content -->
                            <div class="space-y-3">
                                <!-- Item -->
                                <div
                                    class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                                    <div>
                                        <p class="font-semibold text-gray-800 dark:text-white">Semester Ganjil
                                            (2024/2025)</p>
                                        <p class="text-xs text-gray-500 mt-1">Status: Aktif • Sept - Des 2024</p>
                                    </div>
                                    <div class="flex gap-2">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-300">
                                            Aktif
                                        </span>
                                        <button
                                            class="group w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9" />
                                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                                            </svg>
                                        </button>
                                        <button
                                            class="group w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                <path d="M10 11v6" />
                                                <path d="M14 11v6" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

            </main>

            <!-- ===== RIGHT PANEL ===== -->
            <x-rightPanel />

        </div><!-- end inner flex -->

    </div><!-- end outer flex -->

</body>

</html>
