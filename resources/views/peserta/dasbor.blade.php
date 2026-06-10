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
        <x-leftPanel/>

        <!-- ===== MAIN CONTENT ===== -->
        <div class="flex flex-1 min-w-0 overflow-hidden">

            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">

                <!-- Top Nav -->
                <x-topNav/>

                <!-- Scrollable content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    <!-- Welcome Banner -->
                    <x-banner/>

                    <!-- Stat Cards -->
                    <x-stats/>


                    <!-- Deadline Mendekati -->
                    <section>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-semibold dark:text-white">Deadline Mendekati</h3>
                            <a href="{{ url('/peserta/tugas') }}" class="flex items-center gap-1 px-3 py-1.5 text-xs text-[#6C63FF] hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg transition font-medium">
                                Lihat Semua
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                            <!-- Tugas 1 — Overdue -->
                            <div class="card p-4   border-red-500 dark:border-red-500/30">
                                <div class="flex items-start justify-between mb-2">
                                    <span
                                        class="inline-flex items-center gap-1 text-[10px] font-semibold px-2 py-0.5 rounded-full bg-red-100 text-red-600 dark:bg-red-500/20 dark:text-red-400">
                                        <span
                                            class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse inline-block"></span>Terlambat
                                    </span>
                                    <span class="text-[10px] text-gray-400">2 hari lalu</span>
                                </div>
                                <h4 class="text-sm font-semibold dark:text-white mb-1 leading-tight">UI/UX Case Study —
                                    Redesign App</h4>
                                <p class="text-[11px] text-gray-400 mb-3">UI/UX Design Fundamentals</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1.5 text-[11px] text-red-500 font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10" />
                                            <polyline points="12 6 12 12 16 14" />
                                        </svg>
                                        19 Apr 2025
                                    </div>
                                    <button
                                        class="inline-flex items-center justify-center gap-1.5 text-xs bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                        <span>Kumpulkan</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Tugas 2 — Due Soon -->
                            <div class="card p-4 border-yellow-400 dark:border-yellow-400/30">
                                <div class="flex items-start justify-between mb-2">
                                    <span
                                        class="inline-flex items-center gap-1 text-[10px] font-semibold px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-600 dark:bg-yellow-500/20 dark:text-yellow-400">
                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 inline-block"></span>Segera
                                    </span>
                                    <span class="text-[10px] text-gray-400">1 hari lagi</span>
                                </div>
                                <h4 class="text-sm font-semibold dark:text-white mb-1 leading-tight">Analisis Algoritma
                                    Sorting</h4>
                                <p class="text-[11px] text-gray-400 mb-3">Data Structures & Algorithms</p>
                                <div class="flex items-center justify-between">
                                    <div
                                        class="flex items-center gap-1.5 text-[11px] text-yellow-600 dark:text-yellow-400 font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10" />
                                            <polyline points="12 6 12 12 16 14" />
                                        </svg>
                                        22 Apr 2025
                                    </div>
                                    <button
                                        class="inline-flex items-center justify-center gap-1.5 text-xs bg-yellow-400 text-white px-3 py-1 rounded-lg hover:bg-yellow-500 transition">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                        <span>Kumpulkan</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Tugas 3 — On Track -->
                            <div class="card p-4 border-blue-400 dark:border-blue-400/30">
                                <div class="flex items-start justify-between mb-2">
                                    <span
                                        class="inline-flex items-center gap-1 text-[10px] font-semibold px-2 py-0.5 rounded-full text-primary"
                                        style="background:rgba(108,99,255,0.10)">
                                        <span class="w-1.5 h-1.5 rounded-full bg-primary inline-block"></span>On Track
                                    </span>
                                    <span class="text-[10px] text-gray-400">4 hari lagi</span>
                                </div>
                                <h4 class="text-sm font-semibold dark:text-white mb-1 leading-tight">Business Model
                                    Canvas — Startup Pitch</h4>
                                <p class="text-[11px] text-gray-400 mb-3">Digital Entrepreneurship</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1.5 text-[11px] text-primary font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10" />
                                            <polyline points="12 6 12 12 16 14" />
                                        </svg>
                                        25 Apr 2025
                                    </div>
                                    <button
                                        class="inline-flex items-center justify-center gap-1.5 text-xs text-primary px-3 py-1 rounded-lg transition hover:text-white hover:bg-primary"
                                        style="background:rgba(108,99,255,0.10)">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        <span>Kerjakan</span>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </section>

                    <!-- Course Saya -->
                    <section>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-semibold dark:text-white">Course Saya</h3>
                            <a href="{{ url('/peserta/courses') }}" class="flex items-center gap-1 px-3 py-1.5 text-xs text-[#6C63FF] hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg transition font-medium">
                                Lihat Semua
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">

                            <!-- Course 1 -->

                            <div class="card p-0 overflow-hidden flex flex-row">
                                <div class="flex-1 p-4">
                                    <div class="flex items-stretch gap-3">
                                        <div class="w-30 flex-shrink-0 rounded-xl overflow-hidden"
                                            style="background:rgba(33,150,243,0.15)">
                                            <img src="../img/momo.png" class="w-full h-full object-cover"
                                                alt="icon">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between gap-2 mb-0.5">
                                                <h4 class="text-sm font-semibold dark:text-white truncate">UI/UX
                                                    Design Specialist</h4>
                                                <span class="text-xs font-bold flex-shrink-0"
                                                    style="color:#2196f3">80%</span>
                                            </div>
                                            <p class="text-[11px] text-gray-400 mb-2">Instruktur: Sarah Wijaya</p>
                                            <div class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-1.5 mb-2">
                                                <div class="h-1.5 rounded-full" style="width:80%;background:#2196f3">
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between text-[10px] text-gray-400">
                                                <span>8/10 Modul selesai</span>
                                                <span class="text-gray-400">Hampir selesai</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card p-0 overflow-hidden flex flex-row">
                                <div class="flex-1 p-4">
                                    <div class="flex items-stretch gap-3">
                                        <div class="w-30 flex-shrink-0 rounded-xl overflow-hidden"
                                            style="background:rgba(156,39,176,0.15)">
                                            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085"
                                                class="w-full h-full object-cover" alt="icon">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between gap-2 mb-0.5">
                                                <h4 class="text-sm font-semibold dark:text-white truncate">Data
                                                    Science Bootcamp</h4>
                                                <span class="text-xs font-bold flex-shrink-0"
                                                    style="color:#9c27b0">50%</span>
                                            </div>
                                            <p class="text-[11px] text-gray-400 mb-2">Instruktur: Budi Santoso</p>
                                            <div class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-1.5 mb-2">
                                                <div class="h-1.5 rounded-full" style="width:50%;background:#9c27b0">
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between text-[10px] text-gray-400">
                                                <span>6/12 Modul selesai</span>
                                                <span class="text-gray-400">Berjalan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card p-0 overflow-hidden flex flex-row">
                                <div class="flex-1 p-4">
                                    <div class="flex items-stretch gap-3">
                                        <div class="w-30 flex-shrink-0 rounded-xl overflow-hidden"
                                            style="background:rgba(255,152,0,0.15)">
                                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f"
                                                class="w-full h-full object-cover" alt="icon">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between gap-2 mb-0.5">
                                                <h4 class="text-sm font-semibold dark:text-white truncate">
                                                    Full-stack Laravel</h4>
                                                <span class="text-xs font-bold flex-shrink-0"
                                                    style="color:#ff9800">15%</span>
                                            </div>
                                            <p class="text-[11px] text-gray-400 mb-2">Instruktur: Andi Hermawan</p>
                                            <div class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-1.5 mb-2">
                                                <div class="h-1.5 rounded-full" style="width:15%;background:#ff9800">
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between text-[10px] text-gray-400">
                                                <span>1/8 Modul selesai</span>
                                                <span class="text-gray-400">Baru mulai</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div onclick="window.location.href='/halaman-tujuan'"
                                class="card cursor-pointer p-0 overflow-hidden flex flex-row border rounded-xl hover:shadow-md transition">

                                <div class="flex-1 p-4">
                                    <div class="flex items-stretch gap-3">
                                        <div class="w-30 flex-shrink-0 rounded-xl overflow-hidden"
                                            style="background:rgba(244,67,54,0.15)">
                                            <img src="https://plus.unsplash.com/premium_photo-1661877737564-3dfd7282efcb?q=80&w=2100&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                                class="w-full h-full object-cover" alt="icon">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between gap-2 mb-0.5">
                                                <h4 class="text-sm font-semibold dark:text-white truncate">Cyber
                                                    Security Basic</h4>
                                                <span class="text-xs font-bold flex-shrink-0"
                                                    style="color:#f44336">100%</span>
                                            </div>
                                            <p class="text-[11px] text-gray-400 mb-2">Instruktur: Rina Amelia</p>
                                            <div class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-1.5 mb-2">
                                                <div class="h-1.5 rounded-full" style="width:100%;background:#f44336">
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between text-[10px] text-gray-400">
                                                <span>5/5 Modul selesai</span>
                                                <span class="text-gray-400">Selesai</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </section>

                </div><!-- end scrollable -->
            </main>

            <!-- ===== RIGHT PANEL ===== -->
            <x-rightPanel/>

        </div><!-- end inner flex -->

    </div><!-- end outer flex -->

</body>

</html>
