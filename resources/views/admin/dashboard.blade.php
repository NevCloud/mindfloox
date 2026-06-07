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

        <!-- Navbar admin -->
        <x-topNav />

                <!-- Scrollable content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">

        <!--banner admin-->
        <x-banner />

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
