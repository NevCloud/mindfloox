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
                    <x-banner/>

                    <!-- Stat Cards -->
                    <x-stats/>


                    <!-- Course Saya -->
                    <section>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-semibold dark:text-white">Course Saya</h3>
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

        </div>

    </div>

</body>

</html>
