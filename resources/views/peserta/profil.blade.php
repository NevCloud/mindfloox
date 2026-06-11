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

                <!-- Scrollable content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">


                    <!-- PROFILE CONTENT -->
                    <section>

                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">

                            <!-- LEFT SIDEBAR -->
                            <div class="lg:col-span-3">

                                <div class="card-fix p-5 text-left">

                                    <!-- Foto -->
                                    <div class="flex justify-center mb-4">
                                        <img src="https://i.pravatar.cc/300"
                                            class="w-36 h-36 rounded-full object-cover border-2 border-primary shadow-lg"
                                            alt="foto profil">
                                    </div>

                                    <!-- Nama -->
                                    <h2 class="text-xl font-bold dark:text-white">Muhammad Fahad Arifin</h2>
                                    <p class="text-sm text-gray-400 mb-1">@nevcloud</p>

                                    <!-- Role -->
                                    <div class="mb-5">
                                        <span class="text-xs px-3 py-1 rounded-full text-primary"
                                            style="background:rgba(108,99,255,0.10)">
                                            Web Developer
                                        </span>
                                    </div>

                                    <!-- Button -->
                                    <button
                                        class="flex items-center justify-center gap-2 w-full py-2 rounded-xl text-sm font-medium text-white bg-primary hover:opacity-90 transition mb-5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        Edit Profile
                                    </button>

                                    <!-- Contact -->
                                    <div class="space-y-3 text-left">

                                        <div
                                            class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300 border-b border-black/5 dark:border-white/5 pb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M3 8l7.89 4.26a2 2 0 0 0 2.22 0L21 8" />
                                                <path d="M21 8v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8" />
                                            </svg>
                                            nevcloud@gmail.com
                                        </div>

                                        <div
                                            class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300 border-b border-black/5 dark:border-white/5 pb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path
                                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.08 4.18 2 2 0 0 1 4.06 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.77.63 2.6a2 2 0 0 1-.45 2.11L8.1 9.91a16 16 0 0 0 6 6l1.48-1.14a2 2 0 0 1 2.11-.45c.83.3 1.7.51 2.6.63A2 2 0 0 1 22 16.92z" />
                                            </svg>
                                            +62 812-3456-7890
                                        </div>

                                    </div>

                                    <!-- Social -->
                                    <div class="mt-5">
                                        <h4 class="text-sm font-semibold dark:text-white mb-3 text-left">
                                            Social Media
                                        </h4>

                                        <div class="space-y-2">

                                            <!-- LinkedIn -->
                                            <a href="#"
                                                class="flex items-center justify-between px-3 py-2 rounded-xl bg-gray-100 dark:bg-[#0F0F1A] hover:bg-primary hover:text-white transition text-sm text-gray-600 dark:text-gray-300 group">

                                                <div class="flex items-center gap-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                                    </svg>

                                                    <span>LinkedIn</span>
                                                </div>

                                                <span class="group-hover:text-white">↗</span>
                                            </a>

                                            <!-- Instagram -->
                                            <a href="#"
                                                class="flex items-center justify-between px-3 py-2 rounded-xl bg-gray-100 dark:bg-[#0F0F1A] hover:bg-primary hover:text-white transition text-sm text-gray-600 dark:text-gray-300 group">

                                                <div class="flex items-center gap-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                                    </svg>

                                                    <span>Instagram</span>
                                                </div>

                                                <span class="group-hover:text-white">↗</span>
                                            </a>

                                            <!-- X / Twitter -->
                                            <a href="#"
                                                class="flex items-center justify-between px-3 py-2 rounded-xl bg-gray-100 dark:bg-[#0F0F1A] hover:bg-primary hover:text-white transition text-sm text-gray-600 dark:text-gray-300 group">

                                                <div class="flex items-center gap-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                                    </svg>

                                                    <span>X / Twitter</span>
                                                </div>

                                                <span class="group-hover:text-white">↗</span>
                                            </a>

                                            <!-- Facebook -->
                                            <a href="#"
                                                class="flex items-center justify-between px-3 py-2 rounded-xl bg-gray-100 dark:bg-[#0F0F1A] hover:bg-primary hover:text-white transition text-sm text-gray-600 dark:text-gray-300 group">

                                                <div class="flex items-center gap-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                                    </svg>

                                                    <span>Facebook</span>
                                                </div>

                                                <span class="group-hover:text-white">↗</span>
                                            </a>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- RIGHT CONTENT -->
                            <div class="lg:col-span-9 space-y-5">

                                <!-- DETAIL PROFILE -->
                                <section>

                                    <div class="card-fix p-6">

                                        <div class="flex items-center justify-between mb-6">
                                            <h3 class="text-base font-semibold dark:text-white">
                                                Detail Profile
                                            </h3>

                                            <button
                                                class="flex items-center gap-1.5 text-xs text-primary px-3 py-1.5 rounded-lg transition hover:text-white hover:bg-primary"
                                                style="background:rgba(108,99,255,0.10)">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                Edit Data
                                            </button>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                            <!-- Nama Lengkap -->
                                            <div>
                                                <label class="text-xs text-gray-400 mb-1 block">
                                                    Nama Lengkap
                                                </label>

                                                <input type="text" value="Muhammad Fahad Arifin" disabled
                                                    class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none disabled:opacity-100 disabled:cursor-not-allowed">
                                            </div>

                                            <!-- Username -->
                                            <div>
                                                <label class="text-xs text-gray-400 mb-1 block">
                                                    Username
                                                </label>

                                                <input type="text" value="nevcloud" disabled
                                                    class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none disabled:opacity-100 disabled:cursor-not-allowed">
                                            </div>

                                            <!-- Email -->
                                            <div>
                                                <label class="text-xs text-gray-400 mb-1 block">
                                                    Email
                                                </label>

                                                <input type="email" value="nevcloud@gmail.com" disabled
                                                    class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none disabled:opacity-100 disabled:cursor-not-allowed">
                                            </div>

                                            <!-- Role -->
                                            <div>
                                                <label class="text-xs text-gray-400 mb-1 block">
                                                    Role
                                                </label>

                                                <input type="text" value="Web Developer" disabled
                                                    class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none disabled:opacity-100 disabled:cursor-not-allowed">
                                            </div>

                                            <!-- Kata Sandi -->
                                            <div>
                                                <label class="text-xs text-gray-400 mb-1 block">
                                                    Kata Sandi
                                                </label>

                                                <input type="password" value="password123" disabled
                                                    class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none disabled:opacity-100 disabled:cursor-not-allowed">
                                            </div>

                                            <!-- Tanggal Lahir -->
                                            <div>
                                                <label class="text-xs text-gray-400 mb-1 block">
                                                    Tanggal Lahir
                                                </label>

                                                <input type="text" value="12 Mei 2005" disabled
                                                    class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none disabled:opacity-100 disabled:cursor-not-allowed">
                                            </div>

                                            <!-- Alamat -->
                                            <div class="md:col-span-2">
                                                <label class="text-xs text-gray-400 mb-1 block">
                                                    Alamat
                                                </label>

                                                <textarea disabled rows="3"
                                                    class="w-full textarea text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none resize-none disabled:opacity-100 disabled:cursor-not-allowed">Jl. Teknologi No. 88, Jakarta, Indonesia</textarea>
                                            </div>

                                        </div>

                                    </div>

                                </section>

                                <!-- PROGRAM MICROCREDENTIAL -->
                                <section>

                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-base font-semibold dark:text-white">
                                            Program Microcredential
                                        </h3>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                        <!-- card-fix -->
                                        <div class="card-fix p-5">
                                            <div class="flex items-start justify-between mb-4">
                                                <div>
                                                    <h4 class="text-sm font-semibold dark:text-white mb-1">
                                                        Fullstack Web Development
                                                    </h4>
                                                    <p class="text-xs text-gray-400">
                                                        Laravel • TailwindCSS
                                                    </p>
                                                </div>

                                                <span
                                                    class="text-[10px] px-2 py-1 rounded-full bg-green-500/10 text-green-500">
                                                    Done
                                                </span>
                                            </div>

                                            <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                                                Program pembelajaran fullstack modern menggunakan Laravel dan Tailwind
                                                CSS.
                                            </p>

                                            <a href="#"
                                                class="mt-4 flex items-center gap-2 px-4 py-2 w-fit rounded-xl text-sm font-medium text-white bg-primary hover:opacity-90 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                Download Sertifikat
                                            </a>

                                        </div>

                                        <div class="card-fix p-5">
                                            <div class="flex items-start justify-between mb-4">
                                                <div>
                                                    <h4 class="text-sm font-semibold dark:text-white mb-1">
                                                        UI/UX Design
                                                    </h4>
                                                    <p class="text-xs text-gray-400">
                                                        Figma • Design System
                                                    </p>
                                                </div>

                                                <span
                                                    class="text-[10px] px-2 py-1 rounded-full bg-yellow-500/10 text-yellow-500">
                                                    Ongoing
                                                </span>
                                            </div>

                                            <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                                                Belajar dasar hingga advanced UI/UX design menggunakan Figma.
                                            </p>
                                        </div>

                                    </div>
                                </section>

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
