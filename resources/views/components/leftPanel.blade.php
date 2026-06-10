<!----->
@php
    $nama = '';
    $linkProfil = '';
    $subName = '';
    $avatar = '';

    if (request()->is('super-admin/*')) {
        $nama = 'SUPER ADMIN';
        $linkProfil = route('superAdmin.profil');
        $subName = 'Super Admin';
        $avatar = 'https://i.pravatar.cc/150?img=47';
    } elseif (request()->is('admin/*')) {
        $nama = 'ADMIN';
        $linkProfil = route('admin.profil');
        $subName = 'ADMIN MICROCREDENTIAL';
        $avatar = 'https://i.pravatar.cc/150?img=47';
    } elseif (request()->is('instruktur/*')) {
        $nama = 'Instruktur';
        $linkProfil = route('instruktur.profil');
        $subName = 'Instruktur';
        $avatar = 'https://i.pravatar.cc/150?img=12';
    } elseif (request()->is('peserta/*')) {
        $nama = 'Sara Abraham'; 
        $linkProfil = route('peserta.profil');
        $subName = 'Peserta Aktif';
        $avatar = 'https://i.pravatar.cc/150?img=47';
    }
@endphp

<aside id="leftPanel"
    x-data="{ open: false }"
    @toggle-left-panel.window="open = !open"
    @click.outside="open = false"
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
        @if(request()->is('super-admin/*'))
            <!-- Dasbor -->
            <a href="{{ url('/super-admin/dasbor') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('super-admin/dasbor*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Dasbor
            </a>

            <!-- Kursus -->
            <a href="{{ url('/super-admin/program') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('super-admin/program*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                </svg>
                Program
            </a>

            <!-- Tugas -->
            <a href="{{ url('/super-admin/tugas') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('super-admin/tugas*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                Tugas
            </a>

        @elseif(request()->is('admin/*'))
            <!-- Dasbor -->
            <a href="{{ url('/admin/dasbor') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('admin/dasbor*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Dasbor
            </a>

            <!-- Program Akademik -->
            <a href="{{ url('/admin/program') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('admin/program*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                </svg>
                Program Akademik
            </a>

            <!-- Verifikasi Pendaftaran -->
            <a href="{{ url('/admin/verifikasi') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is('admin/verifikasi*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Verifikasi Pendaftaran
            </a>

        @elseif(request()->is('instruktur/*'))
            <!-- Dasbor -->
            <a href="{{ route('instruktur.dasbor') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('instruktur.dasbor') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Dasbor
            </a>

            <!-- Kursus -->
            <a href="{{ route('instruktur.kursus') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('instruktur.kursus', 'instruktur.detail-kursus') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                </svg>
                Kursus
            </a>

            <!-- Tugas -->
            <a href="{{ route('instruktur.tugas') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('instruktur.tugas*') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                Tugas
            </a>

        @elseif(request()->is('peserta/*'))
            <!-- Dasbor -->
            <a href="dasbor"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('peserta.dasbor') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" rx="1" />
                    <rect x="14" y="3" width="7" height="7" rx="1" />
                    <rect x="3" y="14" width="7" height="7" rx="1" />
                    <rect x="14" y="14" width="7" height="7" rx="1" />
                </svg>
                Dasbor
            </a>

            <!-- Kursus -->
            <a href="kursus"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('peserta.kursus') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                </svg>
                Kursus
            </a>

            <!-- Tugas -->
            <a href="tugas"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('peserta.tugas') ? 'bg-primary/10 text-primary' : 'text-gray-500 dark:text-gray-400 hover:bg-primary/5 hover:text-primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                Tugas
            </a>
        @endif
    </nav>

    <!-- User info + Logout -->
    <div class="px-3 py-4 border-t border-black/5 dark:border-white/5 space-y-1 flex-shrink-0">
        @if($nama && $linkProfil)
        <a href="{{ $linkProfil }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 transition-all duration-200 group">
            <img src="{{ $avatar }}"
                class="w-8 h-8 rounded-full object-cover ring-2 ring-offset-0 flex-shrink-0"
                style="box-shadow:0 0 0 2px rgba(108,99,255,0.3)">
            <div class="min-w-0 flex-1">
                <p class="text-xs font-semibold dark:text-white truncate group-hover:text-primary transition-colors">{{ $nama }}</p>
                <p class="text-[10px] text-gray-400 truncate">{{ $subName }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-400 group-hover:text-primary transition-colors ml-auto flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </a>
        @endif
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-500 dark:text-gray-400 hover:bg-red-500/10 hover:text-red-500 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
                Keluar
            </button>
        </form>
    </div>

</aside>
