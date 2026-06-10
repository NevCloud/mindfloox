<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Detail - Peserta</title>
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
                <!-- SCROLLABLE CONTENT — Alpine data: courseApp   -->
                <!-- ============================================= -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5"
                    x-data="courseApp"
                    x-init="loadProgress()"
                >

                    <section class="space-y-5">
                        <!-- Section Header -->
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                    Materi Kursus
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Pelajari materi per minggu secara terstruktur (Total 14 Minggu)
                                </p>
                            </div>
                        </div>

                        <!-- Loop setiap minggu -->
                        <template x-for="week in weeks" :key="week.id">
                            <div class="card translate-0 rounded-2xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700 mb-5">

                                <!-- HEADER MINGGU (klik untuk buka/tutup) -->
                                <button @click="week.open = !week.open"
                                    class="w-full flex items-center justify-between px-5 py-4 bg-white dark:bg-[#1A1A2E] hover:bg-gray-50 dark:hover:bg-[#252541] transition">

                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold"
                                            x-text="week.id"></div>
                                        <div class="text-left">
                                            <h4 class="font-semibold text-gray-900 dark:text-white"
                                                x-text="week.title"></h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400"
                                                x-text="week.desc"></p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <!-- Badge jumlah item yang sudah done / total -->
                                        <span class="text-xs font-medium px-3 py-1 rounded-full"
                                            :class="weekDoneCount(week) === 4
                                                ? 'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300'
                                                : 'bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300'"
                                            x-text="weekDoneCount(week) + '/4 Selesai'">
                                        </span>
                                        <!-- Arrow icon -->
                                        <svg :class="week.open ? 'rotate-180' : ''"
                                            class="w-5 h-5 text-gray-500 transition duration-300"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </button>

                                <!-- CONTENT (item-item di dalam minggu) -->
                                <div x-show="week.open" x-transition
                                    class="border-t border-gray-200 dark:border-gray-700 p-5 space-y-4">

                                    <template x-for="item in week.items" :key="item.id">
                                        <div class="relative p-4 rounded-xl border transition-all duration-300 hover:shadow-md"
                                            :class="isDone(item.id)
                                                ? 'border-green-300 bg-green-50/30 dark:bg-green-900/10 dark:border-green-700'
                                                : 'border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-[#1A1A2E]'">

                                            <!-- ✅ Done Badge (pojok kanan atas) -->
                                            <div x-show="isDone(item.id)"
                                                class="absolute top-3 right-3 flex items-center gap-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 px-2.5 py-1 rounded-full text-xs font-bold">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Selesai
                                            </div>

                                            <div class="flex items-start gap-4">
                                                <!-- Icon berdasarkan type -->
                                                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                                                    :class="iconClass(item.type)">
                                                    <template x-if="item.type === 'materi'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </template>
                                                    <template x-if="item.type === 'video'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                            fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M8 5v14l11-7z" />
                                                        </svg>
                                                    </template>
                                                    <template x-if="item.type === 'tugas'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </template>
                                                    <template x-if="item.type === 'kuis'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </template>
                                                </div>

                                                <!-- Info & Actions -->
                                                <div class="flex-1 pr-16">
                                                    <h5 class="font-semibold text-gray-900 dark:text-white"
                                                        x-text="item.title"></h5>
                                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1"
                                                        x-text="item.desc"></p>

                                                    <!-- Meta info -->
                                                    <div
                                                        class="flex flex-wrap gap-3 mt-3 text-xs text-gray-500 dark:text-gray-400">
                                                        <template x-if="item.type === 'materi'">
                                                            <span class="flex items-center gap-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                                                </svg>
                                                                <span x-text="item.size"></span>
                                                            </span>
                                                        </template>
                                                        <template x-if="item.type === 'video'">
                                                            <span class="flex items-center gap-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                <span x-text="item.duration"></span>
                                                            </span>
                                                        </template>
                                                        <template x-if="item.type === 'tugas'">
                                                            <span class="flex items-center gap-1 text-red-500">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                </svg>
                                                                <span
                                                                    x-text="'Deadline: ' + item.deadline"></span>
                                                            </span>
                                                        </template>
                                                        <template x-if="item.type === 'kuis'">
                                                            <span class="flex items-center gap-1 text-orange-500">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                <span
                                                                    x-text="'Durasi: ' + item.duration"></span>
                                                            </span>
                                                        </template>
                                                    </div>

                                                    <!-- Action Buttons -->
                                                    <div class="mt-4 flex flex-wrap items-center gap-3">

                                                        {{-- Materi: klik = download + auto done --}}
                                                        <template x-if="item.type === 'materi'">
                                                            <button @click="markDone(item.id)"
                                                                class="flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white text-sm hover:opacity-90 transition">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                                Download File
                                                            </button>
                                                        </template>

                                                        {{-- Video: klik = tonton + auto done --}}
                                                        <template x-if="item.type === 'video'">
                                                            <button @click="markDone(item.id)"
                                                                class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-lg bg-primary text-white text-sm hover:opacity-90 transition">
                                                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                <span>Tonton Video</span>
                                                            </button>
                                                        </template>

                                                        {{-- Tugas: harus kumpulkan dulu --}}
                                                        <template x-if="item.type === 'tugas'">
                                                            <a href="tugas-detail"
                                                                @click="localStorage.setItem('currentMockTask', item.id)"
                                                                class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-lg bg-primary text-white text-sm hover:opacity-90 transition">
                                                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                                                <span>Kumpulkan Tugas</span>
                                                            </a>
                                                        </template>

                                                        {{-- Kuis: harus kerjakan dulu --}}
                                                        <template x-if="item.type === 'kuis'">
                                                            <a href="kuis-mulai"
                                                                @click="localStorage.setItem('currentMockQuiz', item.id)"
                                                                class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-lg bg-primary text-white text-sm hover:opacity-90 transition">
                                                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                                <span>Kerjakan Kuis</span>
                                                            </a>
                                                        </template>

                                                        {{-- Lihat Nilai (muncul setelah tugas/kuis selesai) --}}
                                                        <template
                                                            x-if="isDone(item.id) && (item.type === 'tugas' || item.type === 'kuis')">
                                                            <a href="nilai-detail"
                                                                @click="localStorage.setItem('nilaiType', item.type)"
                                                                class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm hover:bg-gray-300 dark:hover:bg-gray-600 transition font-medium">
                                                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                                <span>Lihat Nilai</span>
                                                            </a>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </section>

                </div><!-- end scrollable -->
            </main>

            <!-- ===== RIGHT PANEL ===== -->
            <x-rightPanel />

        </div><!-- end inner flex -->

    </div><!-- end outer flex -->

    {{-- ============================================================
         ALPINE JS — courseApp
         Semua logic data & fungsi dipindahkan ke sini agar rapi.
    ============================================================ --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('courseApp', () => ({

                // ---- STATE ----
                progress: {},   // object: { 'm1': true, 'v1': true, ... }
                weeks: [],      // array minggu 1-14

                // ---- INIT ----
                loadProgress() {
                    // Baca progress dari localStorage
                    this.progress = JSON.parse(localStorage.getItem('courseProgressDemo')) || {};

                    // Generate data 14 minggu, masing-masing punya 4 item
                    const topik = [
                        'Pengenalan HTML', 'CSS Dasar', 'JavaScript Dasar', 'Responsive Design',
                        'UI Components', 'Layout & Grid', 'Animasi CSS', 'Framework CSS',
                        'JavaScript Lanjutan', 'API & Fetch', 'State Management', 'Testing',
                        'Deployment', 'Final Project'
                    ];

                    this.weeks = Array.from({ length: 14 }, (_, i) => {
                        const w = i + 1;
                        return {
                            id: w,
                            title: 'Minggu ' + w + ': ' + topik[i],
                            desc: 'Topik pembelajaran untuk minggu ke-' + w,
                            open: w === 1, // Hanya minggu 1 yang terbuka
                            items: [
                                { id: 'm' + w, type: 'materi', title: 'Materi Panduan ' + w, desc: 'Bahan bacaan minggu ' + w, size: '2.' + w + ' MB' },
                                { id: 'v' + w, type: 'video', title: 'Video Interaktif ' + w, desc: 'Tutorial video minggu ' + w, duration: (10 + w) + ':30' },
                                { id: 't' + w, type: 'tugas', title: 'Tugas Praktik ' + w, desc: 'Latihan mandiri minggu ' + w, deadline: (15 + w) + ' Jan 2024' },
                                { id: 'q' + w, type: 'kuis', title: 'Kuis Evaluasi ' + w, desc: 'Uji pemahaman minggu ' + w, duration: '15 Menit' }
                            ]
                        };
                    });
                },

                // ---- METHODS ----

                // Tandai item sebagai selesai
                markDone(itemId) {
                    this.progress[itemId] = true;
                    this.saveProgress();
                },

                // Cek apakah item sudah selesai
                isDone(itemId) {
                    return this.progress[itemId] === true;
                },

                // Hitung berapa item yg sudah done di 1 minggu
                weekDoneCount(week) {
                    return week.items.filter(item => this.isDone(item.id)).length;
                },

                // Simpan progress ke localStorage
                saveProgress() {
                    localStorage.setItem('courseProgressDemo', JSON.stringify(this.progress));
                },

                // Helper: CSS class untuk icon berdasarkan type (light + dark)
                iconClass(type) {
                    const map = {
                        'materi': 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400',
                        'video': 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400',
                        'tugas': 'bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400',
                        'kuis': 'bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400'
                    };
                    return map[type] || 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400';
                }
            }));
        });
    </script>

</body>

</html>
