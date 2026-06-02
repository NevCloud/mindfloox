<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Detail - Peserta</title>
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

                <!-- ============================================= -->
                <!-- SCROLLABLE CONTENT — Nilai Detail              -->
                <!-- ============================================= -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5"
                    x-data="{
                        type: 'tugas',
                        init() {
                            // Baca tipe dari localStorage (di-set oleh tombol Lihat Nilai)
                            this.type = localStorage.getItem('nilaiType') || 'tugas';
                        }
                    }">

                    <!-- Back Button -->
                    <a href="course-detail"
                        class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-primary transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali ke Course
                    </a>

                    <section class="max-w-3xl mx-auto space-y-6">

                        <!-- ========== SCORE CARD ========== -->
                        <div class="card translate-none rounded-2xl p-8 text-center space-y-4">

                            <!-- Judul (dinamis) -->
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white"
                                x-text="type === 'kuis' ? 'Kuis Evaluasi' : 'Tugas Praktik'"></h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400"
                                x-text="type === 'kuis' ? 'Dikerjakan pada 16 Jan 2024, 10:30' : 'Dikumpulkan pada 16 Jan 2024, 09:45'"></p>



                            <!-- Lingkaran Skor -->
                            <div class="flex justify-center my-6">
                                <div class="relative w-36 h-36">
                                    <svg class="w-full h-full -rotate-90" viewBox="0 0 120 120">
                                        <circle cx="60" cy="60" r="52" fill="none"
                                            stroke="currentColor"
                                            class="text-gray-200 dark:text-gray-700"
                                            stroke-width="10" />
                                        <circle cx="60" cy="60" r="52" fill="none"
                                            stroke="url(#scoreGradient)"
                                            stroke-width="10"
                                            stroke-linecap="round"
                                            stroke-dasharray="326.73"
                                            stroke-dashoffset="49"
                                            class="transition-all duration-1000" />
                                        <defs>
                                            <linearGradient id="scoreGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                                <stop offset="0%" stop-color="#6366f1" />
                                                <stop offset="100%" stop-color="#8b5cf6" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                                        <span class="text-4xl font-extrabold text-gray-900 dark:text-white">85</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">dari 100</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ========== KUIS: Hasil Jawaban ========== -->
                        <template x-if="type === 'kuis'">
                            <div class="card translate-none rounded-2xl p-6 space-y-4">
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">Hasil Jawaban</h3>

                                <div class="grid grid-cols-3 gap-3 text-center">
                                    <div class="p-4 rounded-xl bg-green-50 dark:bg-green-900/20">
                                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">17</p>
                                        <p class="text-xs text-green-700 dark:text-green-400 mt-1">Benar</p>
                                    </div>
                                    <div class="p-4 rounded-xl bg-red-50 dark:bg-red-900/20">
                                        <p class="text-2xl font-bold text-red-600 dark:text-red-400">3</p>
                                        <p class="text-xs text-red-700 dark:text-red-400 mt-1">Salah</p>
                                    </div>
                                    <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-800">
                                        <p class="text-2xl font-bold text-gray-700 dark:text-gray-300">20</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Total Soal</p>
                                    </div>
                                </div>

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Waktu pengerjaan: 12 menit 30 detik
                                </p>
                            </div>
                        </template>

                        <!-- ========== TUGAS: Feedback Instruktur ========== -->
                        <template x-if="type === 'tugas'">
                            <div class="card translate-none rounded-2xl p-6 space-y-4">
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">Feedback Instruktur</h3>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">
                                        SW
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-900 dark:text-white">Sarah Wijaya</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Instruktur • 17 Jan 2024</p>
                                    </div>
                                </div>

                                <div class="bg-gray-50 dark:bg-[#1A1A2E] rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                        Kerja bagus! Jawaban sudah tepat dan sesuai dengan materi yang diajarkan.
                                        Untuk tugas selanjutnya, coba lebih detailkan bagian analisis dan tambahkan referensi pendukung agar lebih kuat argumentasinya.
                                        Tetap semangat! 👍
                                    </p>
                                </div>
                            </div>
                        </template>

                        <!-- ========== TUGAS: File yang Dikumpulkan ========== -->
                        <template x-if="type === 'tugas'">
                            <div class="card translate-none rounded-2xl p-6 space-y-4">
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">File yang Dikumpulkan</h3>

                                <a href="#"
                                    class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-[#1A1A2E] border border-gray-200 dark:border-gray-700 hover:border-primary transition">
                                    <div class="w-10 h-10 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300 truncate">tugas_praktik_minggu1.pdf</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">1.2 MB • PDF Document</p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 shrink-0"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </a>
                            </div>
                        </template>

                    </section>

                </div><!-- end scrollable -->
            </main>

            <!-- ===== RIGHT PANEL ===== -->
            <x-rightPanel />

        </div><!-- end inner flex -->

    </div><!-- end outer flex -->

</body>

</html>
