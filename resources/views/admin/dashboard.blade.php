<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Microcredential</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
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

    <div class="flex h-screen overflow-hidden">
        <x-leftPanel />

        <div class="flex flex-1 min-w-0 overflow-hidden">
            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">

                <!-- Topbar -->
                <div class="flex items-center gap-3 px-4 py-3 bg-gray-100 dark:bg-[#1A1A2E] border-b border-black/5 dark:border-white/5 flex-shrink-0">
                    <div class="flex-1 flex items-center gap-2 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                        <input type="text" placeholder="Cari program, kursus..." class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400">
                    </div>
                    <button @click="toggleDark()" class="w-14 h-8 flex items-center rounded-full p-1 transition-all duration-300" :class="dark ? 'bg-gray-700' : 'bg-gray-300'">
                        <div :class="dark ? 'translate-x-6' : 'translate-x-0'" class="w-6 h-6 bg-white dark:bg-[#1A1A2E] rounded-full shadow-md transform transition-all duration-300 flex items-center justify-center">
                            <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-gray-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                            </svg>
                            <svg x-show="dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-yellow-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                            </svg>
                        </div>
                    </button>
                </div>

                <!-- Scrollable content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    <!-- Welcome Banner -->
                    <div class="rounded-2xl p-6 flex items-center justify-between" style="background: linear-gradient(135deg, #6C63FF 0%, #9B59B6 100%)">
                        <div>
                            <p class="text-white/70 text-sm font-medium uppercase tracking-wider mb-1">Admin Microcredential</p>
                            <h2 class="text-2xl font-bold text-white mb-1">Selamat datang, Admin! 👋</h2>
                            <p class="text-white/80 text-sm">Kelola program, kursus, dan verifikasi pendaftaran peserta.</p>
                            <div class="flex gap-3 mt-4">
                                <a href="#" class="px-4 py-2 bg-white text-primary font-semibold text-sm rounded-xl hover:bg-gray-100 transition">
                                    Tambah Program
                                </a>
                                <a href="#" class="px-4 py-2 bg-white/20 text-white font-semibold text-sm rounded-xl hover:bg-white/30 transition">
                                    Lihat Verifikasi
                                </a>
                            </div>
                        </div>
                        <div class="hidden md:block text-white/20 text-9xl font-bold">MC</div>
                    </div>

                    <!-- Stat Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="card translate-0 p-4 flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-purple-100 dark:bg-purple-500/20 text-purple-500 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800 dark:text-white">0</p>
                                <p class="text-sm text-gray-500">Total Program</p>
                            </div>
                        </div>

                        <div class="card translate-0 p-4 flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-500/20 text-blue-500 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800 dark:text-white">0</p>
                                <p class="text-sm text-gray-500">Total Kursus</p>
                            </div>
                        </div>

                        <div class="card translate-0 p-4 flex items-center gap-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-yellow-100 dark:bg-yellow-500/20 text-yellow-500 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800 dark:text-white">0</p>
                                <p class="text-sm text-gray-500">Pending Verifikasi</p>
                            </div>
                        </div>
                    </div>

                    <!-- Main Grid -->
                    <section class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                        <!-- Program Terbaru -->
                        <div class="card translate-0 p-4">
                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-purple-100 dark:bg-purple-500/20 text-purple-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">Program Akademik</h3>
                                        <p class="text-xs text-gray-500">Daftar program microcredential</p>
                                    </div>
                                </div>
                                <a href="#" class="text-xs text-primary font-medium px-3 py-1.5 rounded-lg transition" style="background:rgba(108,99,255,0.10)">Lihat Semua</a>
                            </div>

                            <div class="space-y-3">
                                <p class="text-center text-gray-400 text-sm py-4">Belum ada program</p>
                            </div>
                        </div>

                        <!-- Verifikasi Terbaru -->
                        <div class="card translate-0 p-4">
                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-yellow-100 dark:bg-yellow-500/20 text-yellow-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">Pendaftaran Terbaru</h3>
                                        <p class="text-xs text-gray-500">Menunggu verifikasi</p>
                                    </div>
                                </div>
                                <a href="#" class="text-xs text-primary font-medium px-3 py-1.5 rounded-lg transition" style="background:rgba(108,99,255,0.10)">Lihat Semua</a>
                            </div>

                            <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800">
                                <table class="w-full text-sm">
                                    <thead class="text-gray-500 border-b border-gray-200 dark:border-gray-800">
                                        <tr class="text-left">
                                            <th class="px-3 py-3">Nama</th>
                                            <th class="px-3 py-3">Program</th>
                                            <th class="px-3 py-3 text-right">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                        <tr>
                                            <td colspan="3" class="px-3 py-6 text-center text-gray-400">Belum ada pendaftaran</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </section>

                </div>
            </main>
        </div>
    </div>

</body>
</html>
