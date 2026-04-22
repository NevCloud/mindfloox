<aside id="leftPanel"
    class="fixed z-40 inset-y-0 left-0 w-64 flex flex-col bg-gray-100 dark:bg-[#1A1A2E] border-r border-gray-200 dark:border-gray-800
                   transform -translate-x-full transition-all duration-300
                   md:static md:translate-x-0 md:flex-shrink-0">

    <!-- Logo -->
    <div class="px-5 py-3 flex-shrink-0">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="object-cover w-30 h-10 block dark:hidden">
        <img src="{{ asset('img/logo-dark.png') }}" alt="Logo" class="object-cover w-30 h-10 hidden dark:block">
    </div>

    <!-- Nav -->
    <nav class="flex-1 px-3 space-y-1 overflow-y-auto">

        <!-- Dashboard -->
        <a href="dashboard"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('peserta.dashboard') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7" rx="1" />
                <rect x="14" y="3" width="7" height="7" rx="1" />
                <rect x="3" y="14" width="7" height="7" rx="1" />
                <rect x="14" y="14" width="7" height="7" rx="1" />
            </svg>
            Dashboard
        </a>

        <!-- Courses -->
        <a href="courses"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('peserta.courses') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
            </svg>
            Courses
        </a>

        <!-- Nilai -->
        <a href="tugas"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('peserta.tugas') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
            </svg>
            Tugas
        </a>

    </nav>

    <!-- User info + Logout -->
    <div class="px-3 py-4 border-t border-black/5 dark:border-white/5 space-y-1 flex-shrink-0">
        <div class="flex items-center gap-3 px-3 py-2">
            <img src="https://i.pravatar.cc/150?img=47"
                class="w-8 h-8 rounded-full object-cover ring-2 ring-offset-0 flex-shrink-0"
                style="box-shadow:0 0 0 2px rgba(108,99,255,0.3)">
            <div class="min-w-0">
                <p class="text-xs font-semibold dark:text-white truncate">P Abraham</p>
                <p class="text-[10px] text-gray-400 truncate">Peserta Aktif</p>
            </div>
        </div>
        <a href="#"
            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-500 dark:text-gray-400 hover:bg-red-500/10 hover:text-red-500 transition-all duration-200  border-transparent">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                <polyline points="16 17 21 12 16 7" />
                <line x1="21" y1="12" x2="9" y2="12" />
            </svg>
            Logout
        </a>
    </div>
</aside>
