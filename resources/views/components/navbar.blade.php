{{-- NAVBAR --}}
<nav class="bg-white dark:bg-[#1A1A2E] border-b dark:border-gray-700 sticky top-0 z-50 transition-all duration-300"
    x-cloak x-data="{
        menuOpen: false,
        // Ambil status langsung dari class <html> yang sudah di-set di HEAD
        dark: document.documentElement.classList.contains('dark'),

        toggleDark() {
            this.dark = !this.dark;
            if (this.dark) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        }
    }">

    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        {{-- LOGO --}}
        <div class="flex items-center">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="object-cover w-30 h-10 block dark:hidden">
            <img src="{{ asset('img/logo-dark.png') }}" alt="Logo" class="object-cover w-30 h-10 hidden dark:block">
        </div>

        {{-- MENU --}}
        <ul :class="menuOpen ? 'flex' : 'hidden'"
            class="md:flex flex-col md:flex-row gap-6 md:gap-8 text-sm md:items-center absolute md:static top-16 left-0 w-full md:w-auto backdrop-blur-md md:border-none border-gray-200 dark:border-gray-700 px-6 py-6 md:p-0">
            <li><a href="/" class="relative group py-1 block">Home
                    <span
                        class="absolute left-0 -bottom-1 w-0 h-[2px] bg-primary duration-300 group-hover:w-full {{ request()->routeIs('index') ? 'w-full' : 'w-0' }}"></span>
                </a></li>
            <li><a href="/about" class="relative group py-1 block">About
                    <span
                        class="absolute left-0 -bottom-1 w-0 h-[2px] bg-primary duration-300 group-hover:w-full {{ request()->routeIs('about') ? 'w-full' : 'w-0' }}"></span>
                </a></li>
            <li><a href="/courses" class="relative group py-1 block">Course
                    <span
                        class="absolute left-0 -bottom-1 w-0 h-[2px] bg-primary duration-300 group-hover:w-full {{ request()->routeIs('courses') ? 'w-full' : 'w-0' }}"></span>
                </a></li>
            <li><a href="/instructors" class="relative group py-1 block">Instructors
                    <span
                        class="absolute left-0 -bottom-1 w-0 h-[2px] bg-primary duration-300 group-hover:w-full {{ request()->routeIs('instructors') ? 'w-full' : 'w-0' }}"></span>
                </a></li>
        </ul>

        <div class="flex items-center gap-2 md:gap-4">
            {{-- TOGGLE DARK MODE --}}
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

            <a href="/enroll"
                class="bg-primary text-white px-3 md:px-5 py-1.5 md:py-2 text-sm md:text-base rounded-full hover:opacity-90">
                Enroll
            </a>

            {{-- MOBILE MENU BUTTON --}}
            <button @click="menuOpen = !menuOpen"
                class="md:hidden relative w-8 h-8 flex flex-col justify-center items-center gap-1">
                <span :class="menuOpen ? 'rotate-45 translate-y-1.5' : ''"
                    class="w-6 h-0.5 bg-black dark:bg-white transition-all"></span>
                <span :class="menuOpen ? 'opacity-0' : ''"
                    class="w-6 h-0.5 bg-black dark:bg-white transition-all"></span>
                <span :class="menuOpen ? '-rotate-45 -translate-y-1.5' : ''"
                    class="w-6 h-0.5 bg-black dark:bg-white transition-all"></span>
            </button>
        </div>
    </div>
</nav>
