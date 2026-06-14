<!----->

{{-- Data user yang sedang login (dipakai di semua panel) --}}
@php
    $user = Auth::user();
    // Label role berdasarkan nilai di database
    $roleLabels = [
        'super_admin' => 'Super Admin',
        'admin_microcredential' => 'Admin Microcredential',
        'instruktur' => 'Instruktur',
        'peserta' => 'Peserta',
    ];
    $roleLabel = $roleLabels[$user->role] ?? ucfirst($user->role);

    // Link profil sesuai role
    $profileLinks = [
        'super_admin' => route('superAdmin.profil'),
        'admin_microcredential' => route('admin.profil'),
        'instruktur' => route('instruktur.profil'),
        'peserta' => route('peserta.profil'),
    ];
    $profileLink = $profileLinks[$user->role] ?? '#';

    // Foto profil: pakai foto asli kalau ada, atau fallback ke avatar API (inisial)
    $avatarUrl = $user->foto_profil
        ? asset('storage/' . $user->foto_profil)
        : 'https://ui-avatars.com/api/?name=' . urlencode($user->nama) . '&background=6C63FF&color=fff&size=64&font-size=0.4';
@endphp


{{-- LEFT PANEL SUPER-ADMIN --}}
@if (request()->is('super-admin/*'))
    <aside id="leftPanel" x-data="{ open: false }" @toggle-left-panel.window="open = !open" @click.outside="open = false"
        :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed z-40 inset-y-0 left-0 w-64 flex flex-col bg-gray-100 dark:bg-[#1A1A2E] border-r border-gray-200 dark:border-gray-800
                   transform transition-all duration-300
                   md:static md:translate-x-0 md:flex-shrink-0">

        <!-- Logo -->
        <div class="px-5 py-3 flex-shrink-0">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="object-cover w-30 h-10 block dark:hidden">
            <img src="{{ asset('img/logo-dark.png') }}" alt="Logo" class="object-cover w-30 h-10 hidden dark:block">
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-3 space-y-1 overflow-y-auto">

            <!-- Dashboard -->
            <a href="{{ url('/super-admin/dasbor') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('super-admin/dashboard*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Dashboard
            </a>

            <!-- Jenis Microcredential -->
            <a href="{{ url('/super-admin/jenis-microcredential') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('super-admin/jenis-microcredential*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Jenis Microcredential
            </a>

            <!-- Admin & Instruktur -->
            <a href="{{ url('/super-admin/admin-instruktur') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('super-admin/admin-instruktur*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Admin & Instruktur
            </a>

            <!-- Periode Pembelajaran -->
            <a href="{{ url('/super-admin/semester') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('super-admin/semester*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Periode Pembelajaran
            </a>



            <!-- Program Microcredential -->
            <a href="{{ url('/super-admin/program-microcredential') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('super-admin/program-microcredential*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                </svg>
                Program Microcredential
            </a>

        </nav>

        <!-- User info + Logout -->
        <div class="px-3 py-4 border-t border-black/5 dark:border-white/5 space-y-1 flex-shrink-0">
            <!-- Profil: klik untuk ke halaman profil -->
            <a href="{{ $profileLink }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 transition">
                <img src="{{ $avatarUrl }}"
                    class="w-8 h-8 rounded-full object-cover ring-2 ring-offset-0 flex-shrink-0"
                    style="box-shadow:0 0 0 2px rgba(108,99,255,0.3)">
                <div class="min-w-0">
                    <p class="text-xs font-semibold dark:text-white truncate">{{ $user->nama }}</p>
                    <p class="text-[10px] text-gray-400 truncate">{{ $roleLabel }}</p>
                </div>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-500 dark:text-gray-400 hover:bg-red-500/10 hover:text-red-500 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- LEFT PANEL ADMIN --}}
@elseif(request()->is('admin/*'))
    <aside id="leftPanel" x-data="{ open: false }" @toggle-left-panel.window="open = !open" @click.outside="open = false"
        :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed z-40 inset-y-0 left-0 w-64 flex flex-col bg-gray-100 dark:bg-[#1A1A2E] border-r border-gray-200 dark:border-gray-800
                   transform transition-all duration-300
                   md:static md:translate-x-0 md:flex-shrink-0">

        <!-- Logo -->
        <div class="px-5 py-3 flex-shrink-0">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="object-cover w-30 h-10 block dark:hidden">
            <img src="{{ asset('img/logo-dark.png') }}" alt="Logo"
                class="object-cover w-30 h-10 hidden dark:block">
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-3 space-y-1 overflow-y-auto">

            <!-- Dashboard -->
            <a href="{{ url('/admin/dasbor') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('admin/dasbor*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Dashboard
            </a>

            <!-- Program Microcredential -->
            <a href="{{ url('/admin/program') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('admin/program*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                </svg>
                Program Microcredential
            </a>

            <!-- Verifikasi Pendaftaran -->
            <a href="{{ url('/admin/verifikasi') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('admin/verifikasi*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Verifikasi Pendaftaran
            </a>

        </nav>

        <!-- User info + Logout -->
        <div class="px-3 py-4 border-t border-black/5 dark:border-white/5 space-y-1 flex-shrink-0">
            <!-- Profil: klik untuk ke halaman profil -->
            <a href="{{ $profileLink }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 transition">
                <img src="{{ $avatarUrl }}"
                    class="w-8 h-8 rounded-full object-cover ring-2 ring-offset-0 flex-shrink-0"
                    style="box-shadow:0 0 0 2px rgba(108,99,255,0.3)">
                <div class="min-w-0">
                    <p class="text-xs font-semibold dark:text-white truncate">{{ $user->nama }}</p>
                    <p class="text-[10px] text-gray-400 truncate">{{ $roleLabel }}</p>
                </div>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-500 dark:text-gray-400 hover:bg-red-500/10 hover:text-red-500 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- LEFT PANEL INSTRUCTOR --}}
@elseif(request()->is('instruktur/*'))
    <aside id="leftPanel" x-data="{ open: false }" @toggle-left-panel.window="open = !open"
        @click.outside="open = false" :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed z-40 inset-y-0 left-0 w-64 flex flex-col bg-gray-100 dark:bg-[#1A1A2E] border-r border-gray-200 dark:border-gray-800
                   transform transition-all duration-300
                   md:static md:translate-x-0 md:flex-shrink-0">

        <!-- Logo -->
        <div class="px-5 py-3 flex-shrink-0">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="object-cover w-30 h-10 block dark:hidden">
            <img src="{{ asset('img/logo-dark.png') }}" alt="Logo"
                class="object-cover w-30 h-10 hidden dark:block">
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-3 space-y-1 overflow-y-auto">

            <!-- Dashboard -->
            <a href="{{ route('instruktur.dasbor') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('instruktur.dasbor') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Dashboard
            </a>

            <!-- Courses -->
            <a href="{{ route('instruktur.kursus.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('instruktur.kursus*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                </svg>
                Courses
            </a>

            <!-- Tugas -->
            <a href="{{ route('instruktur.tugas') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('instruktur.tugas') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                Evaluasi Tugas
            </a>

            <!-- Evaluasi Kuis -->
            <a href="{{ route('instruktur.evaluasi.kuis') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('instruktur.evaluasi.kuis*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Evaluasi Kuis
            </a>
        </nav>

        <!-- User info + Logout -->
        <div class="px-3 py-4 border-t border-black/5 dark:border-white/5 space-y-1 flex-shrink-0">
            <!-- Profil: klik untuk ke halaman profil -->
            <a href="{{ $profileLink }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 transition">
                <img src="{{ $avatarUrl }}"
                    class="w-8 h-8 rounded-full object-cover ring-2 ring-offset-0 flex-shrink-0"
                    style="box-shadow:0 0 0 2px rgba(108,99,255,0.3)">
                <div class="min-w-0">
                    <p class="text-xs font-semibold dark:text-white truncate">{{ $user->nama }}</p>
                    <p class="text-[10px] text-gray-400 truncate">{{ $roleLabel }}</p>
                </div>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-500 dark:text-gray-400 hover:bg-red-500/10 hover:text-red-500 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- LEFT PANEL PESERTA --}}
@elseif(request()->is('peserta/*'))
    <aside id="leftPanel" x-data="{ open: false }" @toggle-left-panel.window="open = !open"
        @click.outside="open = false" :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed z-40 inset-y-0 left-0 w-64 flex flex-col bg-gray-100 dark:bg-[#1A1A2E] border-r border-gray-200 dark:border-gray-800
                   transform transition-all duration-300
                   md:static md:translate-x-0 md:flex-shrink-0">

        <!-- Logo -->
        <div class="px-5 py-3 flex-shrink-0">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="object-cover w-30 h-10 block dark:hidden">
            <img src="{{ asset('img/logo-dark.png') }}" alt="Logo"
                class="object-cover w-30 h-10 hidden dark:block">
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-3 space-y-1 overflow-y-auto">

            <!-- Dashboard -->
            <a href="{{ route('peserta.dasbor') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('peserta.dasbor') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Dashboard
            </a>

            <!-- Courses -->
            <a href="{{ route('peserta.kursus') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('peserta.kursus') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                </svg>
                Kursus
            </a>

            <!-- Tugas -->
            <a href="{{ route('peserta.tugas') }}"
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
            <!-- Profil: klik untuk ke halaman profil -->
            <a href="{{ $profileLink }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 transition">
                <img src="{{ $avatarUrl }}"
                    class="w-8 h-8 rounded-full object-cover ring-2 ring-offset-0 flex-shrink-0"
                    style="box-shadow:0 0 0 2px rgba(108,99,255,0.3)">
                <div class="min-w-0">
                    <p class="text-xs font-semibold dark:text-white truncate">{{ $user->nama }}</p>
                    <p class="text-[10px] text-gray-400 truncate">{{ $roleLabel }}</p>
                </div>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-500 dark:text-gray-400 hover:bg-red-500/10 hover:text-red-500 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>

    </aside>
@endif
