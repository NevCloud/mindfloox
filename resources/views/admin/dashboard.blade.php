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
                <x-topNav/>

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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-contact-round-icon lucide-contact-round">
                                            <path d="M16 2v2" />
                                            <path d="M17.915 22a6 6 0 0 0-12 0" />
                                            <path d="M8 2v2" />
                                            <circle cx="12" cy="12" r="4" />
                                            <rect x="3" y="4" width="18" height="18" rx="2" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">
                                            Pendaftaran Terbaru
                                        </h3>
                                        <p class="text-xs text-gray-500">Daftar pendaftar terbaru</p>
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <button class="text-xs text-primary  font-medium px-3 py-1.5 rounded-lg transition"
                                        style="background:rgba(108,99,255,0.10)">Lihat Semua</button>
                                </div>
                            </div>

                            <!-- Table -->
                            <div
                                class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800 transition-all duration-300">
                                <table class="w-full text-sm">
                                    <thead class="text-gray-500 transition-all duration-300">
                                        <tr class="text-left">
                                            <th class="px-4 py-3">Nama</th>
                                            <th class="px-4 py-3">Program</th>
                                            <th class="px-4 py-3 text-right">Status</th>
                                        </tr>
                                    </thead>

                                    <tbody class="">
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-300">
                                            <td class="px-4 py-4 font-medium">Narolin</td>
                                            <td class="px-4 py-4 text-gray-500">Web Development</td>
                                            <td class="px-4 py-4 text-right space-x-2">
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold text-white bg-green-600 rounded-full">Diterima</span>

                                                {{-- <span
                                                    class="px-2 py-1 text-xs font-semibold text-white bg-yellow-500 rounded-full">Menunggu</span>

                                                <span
                                                    class="px-2 py-1 text-xs font-semibold text-white bg-red-600 rounded-full">Ditolak</span> --}}
                                            </td>
                                        </tr>

                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-300">
                                            <td class="px-4 py-4 font-medium">Nofitri</td>
                                            <td class="px-4 py-4 text-gray-500">Animasi</td>
                                            <td class="px-4 py-4 text-right space-x-2">
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold text-white bg-red-600 rounded-full">Ditolak</span>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-graduation-cap-icon lucide-graduation-cap">
                                            <path
                                                d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z" />
                                            <path d="M22 10v6" />
                                            <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">
                                            Program Microcredential
                                        </h3>
                                        <p class="text-xs text-gray-500">Daftar program microcredential</p>
                                    </div>
                                </div>

                                <button class="text-xs text-primary font-medium px-3 py-1.5 rounded-lg transition"
                                    style="background:rgba(108,99,255,0.10)">Lihat Semua</button>
                            </div>

                            <!-- Content -->
                            <div class="space-y-3">
                                <!-- Item -->
                                <div
                                    class="flex items-center justify-between p-4 rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                                    <div>
                                        <p class="font-semibold text-gray-800 dark:text-white">UI/UX Design</p>
                                        <p class="text-xs text-gray-500 mt-1">Status: Aktif</p>
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

                    <!-- Tahun Akademik & Semester Section -->
                    <section class="">

                        <div class="card translate-0 xl:col-span-2 p-4">

                            <!-- Header -->
                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 flex items-center justify-center rounded-xl bg-pink-100 dark:bg-pink-500/20 text-pink-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">
                                            Kursus Terbaru
                                        </h3>
                                        <p class="text-xs text-gray-500">Daftar kursus terbaru</p>
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <button class="text-xs text-primary  font-medium px-3 py-1.5 rounded-lg transition"
                                        style="background:rgba(108,99,255,0.10)">Lihat Semua</button>
                                </div>
                            </div>

                            <!-- Table -->
                            <div
                                class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800 transition-all duration-300">
                                <table class="w-full text-sm">

                                    <!-- HEADER -->
                                    <thead class="text-gray-500 border-b border-gray-200 dark:border-gray-800">
                                        <tr class="text-left">
                                            <th class="px-4 py-3">Nama Kursus</th>
                                            <th class="px-4 py-3">Instruktur</th>
                                            <th class="px-4 py-3">Program Terkait</th>
                                            <th class="px-4 py-3 text-right">Aksi</th>
                                        </tr>
                                    </thead>

                                    <!-- BODY -->
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-200">

                                            <!-- Nama -->
                                            <td
                                                class="px-4 py-4 font-medium text-gray-800 dark:text-white align-middle">
                                                UI/UX Design
                                            </td>

                                            <!-- Instruktur -->
                                            <td class="px-4 py-4 text-gray-500 align-middle">
                                                Arkam Khan
                                            </td>

                                            <!-- Program -->
                                            <td class="px-4 py-4 text-gray-500 align-middle">
                                                Web Development
                                            </td>

                                            <!-- Aksi -->
                                            <td class="px-4 py-4 align-middle">
                                                <div class="flex justify-end items-center gap-2">

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

                    </section>
                </div>

            </main>

            <!-- ===== RIGHT PANEL ===== -->
            <x-rightPanel />

        </div><!-- end inner flex -->

    </div><!-- end outer flex -->

</body>

</html>
