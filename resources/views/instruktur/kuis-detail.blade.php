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

                    @foreach ($kuis ?? [] as $quiz)
                        <section>
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-base font-semibold dark:text-white">Detail Kuis (Instruktur)</h3>
                                <button onclick="history.back()" type="button" class="flex items-center gap-2 px-3 py-1.5 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-[#1A1A2E] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    Kembali
                                </button>
                            </div>

                            <div class="card translate-none rounded-lg p-6 space-y-4">

                                <!-- Quiz Header -->
                                <div class="border-b border-gray-200 dark:border-gray-700">
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                                        {{ $quiz['title'] ?? 'Kuis' }}</h2>
                                    <div class="mb-3">
                                        <span class="inline-block px-3 py-1 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 text-xs font-semibold rounded-full">Deadline:
                                            {{ $quiz['deadline'] ?? '-' }}</span>
                                    </div>
                                </div>

                                <!-- Submissions view -->
                                <div class="space-y-6">
                                    <p class="text-sm text-gray-500">Daftar nilai dan pengumpulan peserta akan ditampilkan di sini.</p>
                                </div>

                                <!-- Action Buttons -->
                                <div class="pt-2 flex gap-2">
                                    <button type="button" class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white font-semibold py-2.5 px-4 rounded-lg transition duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        Unduh Rekap Nilai
                                    </button>
                                </div>
                            </div>
                        </section>
                    @endforeach

                </div><!-- end scrollable -->
            </main>

            <!-- ===== RIGHT PANEL ===== -->
            <x-rightPanel />

        </div><!-- end inner flex -->

    </div><!-- end outer flex -->

</body>

</html>
