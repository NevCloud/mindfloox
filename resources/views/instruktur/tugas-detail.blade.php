<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Instruktur</title>
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

    <div class="flex h-screen overflow-hidden">

        <!-- ===== LEFT PANEL ===== -->
        <x-leftPanel />

        <!-- ===== MAIN CONTENT ===== -->
        <div class="flex flex-1 min-w-0 overflow-hidden">

            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">

                <!-- Topbar -->
                <x-topNav />

                <!-- Scrollable content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    <section>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-semibold dark:text-white">Detail Tugas (Instruktur)</h3>
                            <button onclick="history.back()" class="flex items-center gap-2 px-3 py-1.5 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-[#1A1A2E] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </button>
                        </div>
                        <div class="">
                            <div class="card translate-none rounded-lg p-6 space-y-4">

                                <!-- Task Header -->
                                <div class="border-b border-gray-200 dark:border-gray-700">
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Analisis Algoritma Sorting</h2>
                                    <div class="flex flex-wrap gap-3 mb-3">
                                        <span class="inline-block px-3 py-1 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 text-xs font-semibold rounded-full">Deadline: 15 Jan 2024</span>
                                        <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 text-xs font-semibold rounded-full">Total Pengumpulan: 25 Peserta</span>
                                    </div>
                                </div>

                                <!-- Upload Time -->
                                <div class="pb-4 border-b border-gray-200 dark:border-gray-700">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Diunggah pada: 10 Jan 2024, 14:30</p>
                                </div>

                                <!-- File Section -->
                                <div class="pb-4 border-b border-gray-200 dark:border-gray-700">
                                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-3 uppercase tracking-wide">
                                        File Soal Tugas</p>
                                    <a href="#" class="group flex items-center gap-3 p-3 rounded-xl hover:bg-primary/10 bg-gray-100 dark:bg-[#1A1A2E] transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:text-primary transition-all duration-300 text-gray-700 dark:text-gray-300 shrink-0">
                                            <path d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z" />
                                            <path d="M14 2v5a1 1 0 0 0 1 1h5" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-primary transition">soal_tugas.pdf</span>
                                    </a>
                                </div>

                                <!-- Description Section -->
                                <div class="pb-4 border-b border-gray-200 dark:border-gray-700">
                                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-2 uppercase tracking-wide">
                                        Deskripsi Tugas</p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">Deskripsi tugas akan ditampilkan di sini dengan detail lengkap mengenai apa yang perlu dikerjakan oleh peserta.</p>
                                </div>

                                <!-- View Submissions Button -->
                                <div class="pt-2 flex gap-3">
                                    <a href="#" class="inline-flex items-center justify-center gap-1.5 bg-primary hover:bg-primary/90 text-white font-semibold py-2.5 px-4 rounded-lg transition duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>Lihat Pengumpulan</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>

                </div><!-- end scrollable -->
            </main>

            <!-- ===== RIGHT PANEL ===== -->
            <x-rightPanel />

        </div><!-- end inner flex -->

    </div><!-- end outer flex -->

</body>

</html>
