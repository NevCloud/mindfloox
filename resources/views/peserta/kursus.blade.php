<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - Peserta</title>
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

                    <!-- Course Saya -->
                    <section>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-semibold dark:text-white">Course Saya</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">

                            {{-- Course 1 — Progress tracking via localStorage --}}
                            <div onclick="window.location.href='detail-kursus'"
                                x-data="{ done: 0, total: 56, pct: 0 }"
                                x-init="
                                    let p = JSON.parse(localStorage.getItem('courseProgressDemo') || '{}');
                                    done = Object.keys(p).length;
                                    pct = Math.round((done / total) * 100);
                                "
                                class="card p-0 overflow-hidden flex flex-row cursor-pointer hover:shadow-md transition">
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
                                                    style="color:#2196f3"
                                                    x-text="pct + '%'">0%</span>
                                            </div>
                                            <p class="text-[11px] text-gray-400 mb-2">Instruktur: Sarah Wijaya</p>
                                            <div class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-1.5 mb-2">
                                                <div class="h-1.5 rounded-full transition-all duration-500"
                                                    :style="'background:#2196f3; width:' + pct + '%'">
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between text-[10px] text-gray-400 mb-3">
                                                <span x-text="done + '/' + total + ' Modul selesai'">0/56 Modul selesai</span>
                                                <span class="text-gray-400"
                                                    x-text="pct >= 100 ? 'Selesai ✓' : (pct > 50 ? 'Hampir selesai' : 'Sedang berjalan')">Sedang berjalan</span>
                                            </div>
                                            <button class="inline-flex items-center gap-2 px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold rounded-lg transition">
                                                Lanjutkan
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div onclick="window.location.href='detail-kursus'" class="card p-0 overflow-hidden flex flex-row cursor-pointer hover:shadow-md transition">
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
                                            <div class="flex items-center justify-between text-[10px] text-gray-400 mb-3">
                                                <span>6/12 Modul selesai</span>
                                                <span class="text-gray-400">Berjalan</span>
                                            </div>
                                            <button class="inline-flex items-center gap-2 px-3 py-1.5 bg-purple-500 hover:bg-purple-600 text-white text-xs font-semibold rounded-lg transition">
                                                Lanjutkan
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div onclick="window.location.href='detail-kursus'" class="card p-0 overflow-hidden flex flex-row cursor-pointer hover:shadow-md transition">
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
                                            <div class="flex items-center justify-between text-[10px] text-gray-400 mb-3">
                                                <span>1/8 Modul selesai</span>
                                                <span class="text-gray-400">Baru mulai</span>
                                            </div>
                                            <button class="inline-flex items-center gap-2 px-3 py-1.5 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold rounded-lg transition">
                                                Lanjutkan
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div onclick="window.location.href='detail-kursus'" class="card p-0 overflow-hidden flex flex-row cursor-pointer hover:shadow-md transition">
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
                                            <div class="flex items-center justify-between text-[10px] text-gray-400 mb-3">
                                                <span>5/5 Modul selesai</span>
                                                <span class="text-gray-400">Selesai</span>
                                            </div>
                                            <button class="inline-flex items-center gap-2 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded-lg transition">
                                                Lanjutkan
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>
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

        </div>

    </div>

</body>

</html>
