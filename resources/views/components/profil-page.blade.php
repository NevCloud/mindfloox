{{-- ============================================================
     PROFIL PAGE COMPONENT (Unified for all roles)
     Usage: <x-profil-page :user="$user" />
     Routes auto-detected from $user->role.
     ============================================================ --}}

@props(['user', 'programs'])

@php
    // Auto-detect route prefix & page title from user role
    $routePrefix = match ($user->role) {
        'super_admin' => 'superAdmin',
        'admin_microcredential' => 'admin',
        'instruktur' => 'instruktur',
        'peserta' => 'peserta',
        default => 'admin',
    };

    $pageTitle = match ($user->role) {
        'super_admin' => 'Super Admin',
        'admin_microcredential' => 'Admin',
        'instruktur' => 'Instruktur',
        'peserta' => 'Peserta',
        default => 'Admin',
    };

    $roleLabels = [
        'super_admin' => 'Super Admin',
        'admin_microcredential' => 'Admin Microcredential',
        'instruktur' => 'Instruktur',
        'peserta' => 'Peserta',
    ];
    $roleLabel = $roleLabels[$user->role] ?? ucfirst($user->role);

    $avatarUrl = $user->foto_profil
        ? asset('storage/' . $user->foto_profil)
        : 'https://ui-avatars.com/api/?name=' .
            urlencode($user->nama) .
            '&background=6C63FF&color=fff&size=256&font-size=0.4';

    $updateRoute = $routePrefix . '.profil.update';
    $checkUsernameRoute = $routePrefix . '.profil.checkUsername';
@endphp

<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - {{ $pageTitle }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body x-data="profilApp()" x-init="init();
document.documentElement.classList.toggle('dark', dark)" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">

        <!-- ===== LEFT PANEL ===== -->
        <x-leftPanel />

        <!-- ===== MAIN CONTENT ===== -->
        <div class="flex flex-1 min-w-0 overflow-hidden">

            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">

                <!-- Topbar -->
                <x-topNav />

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
                                        <img src="{{ $avatarUrl }}"
                                            class="w-36 h-36 rounded-full object-cover border-2 border-primary shadow-lg"
                                            alt="foto profil">
                                    </div>

                                    <!-- Nama -->
                                    <h2 class="text-xl font-bold dark:text-white">{{ $user->nama }}</h2>
                                    <p class="text-sm text-gray-400 mb-1">{{ '@' . $user->username }}</p>

                                    <!-- Role -->
                                    <div class="mb-5">
                                        <span class="text-xs px-3 py-1 rounded-full text-primary"
                                            style="background:rgba(108,99,255,0.10)">
                                            {{ $roleLabel }}
                                        </span>
                                    </div>

                                    <!-- Button -->
                                    <button @click="openEditModal()"
                                        class="w-full py-2 rounded-xl text-sm font-medium text-white bg-primary hover:opacity-90 transition mb-5">
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
                                            {{ $user->email }}
                                        </div>

                                        <div
                                            class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300 border-b border-black/5 dark:border-white/5 pb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path
                                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.08 4.18 2 2 0 0 1 4.06 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.77.63 2.6a2 2 0 0 1-.45 2.11L8.1 9.91a16 16 0 0 0 6 6l1.48-1.14a2 2 0 0 1 2.11-.45c.83.3 1.7.51 2.6.63A2 2 0 0 1 22 16.92z" />
                                            </svg>
                                            @if ($user->nomor_telepon)
                                                {{ $user->nomor_telepon }}
                                            @else
                                                <span class="italic text-gray-400 text-xs">Belum diisi</span>
                                            @endif
                                        </div>

                                    </div>

                                    <!-- Social -->
                                    <div class="mt-5">
                                        <h4 class="text-sm font-semibold dark:text-white mb-3 text-left">Social Media
                                        </h4>

                                        <div class="space-y-2">

                                            <!-- LinkedIn -->
                                            <a href="{{ $user->linkedin ?: '#' }}"
                                                target="{{ $user->linkedin ? '_blank' : '' }}"
                                                class="flex items-center justify-between px-3 py-2 rounded-xl bg-gray-100 dark:bg-[#0F0F1A] hover:bg-primary hover:text-white transition text-sm text-gray-600 dark:text-gray-300 group">
                                                <div class="flex items-center gap-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                                    </svg>
                                                    <span>LinkedIn</span>
                                                </div>
                                                @if ($user->linkedin)
                                                    <span class="group-hover:text-white">↗</span>
                                                @else
                                                    <span class="text-[10px] italic text-gray-400">Belum diisi</span>
                                                @endif
                                            </a>

                                            <!-- Instagram -->
                                            <a href="{{ $user->instagram ?: '#' }}"
                                                target="{{ $user->instagram ? '_blank' : '' }}"
                                                class="flex items-center justify-between px-3 py-2 rounded-xl bg-gray-100 dark:bg-[#0F0F1A] hover:bg-primary hover:text-white transition text-sm text-gray-600 dark:text-gray-300 group">
                                                <div class="flex items-center gap-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                                    </svg>
                                                    <span>Instagram</span>
                                                </div>
                                                @if ($user->instagram)
                                                    <span class="group-hover:text-white">↗</span>
                                                @else
                                                    <span class="text-[10px] italic text-gray-400">Belum diisi</span>
                                                @endif
                                            </a>

                                            <!-- X / Twitter -->
                                            <a href="{{ $user->x ?: '#' }}" target="{{ $user->x ? '_blank' : '' }}"
                                                class="flex items-center justify-between px-3 py-2 rounded-xl bg-gray-100 dark:bg-[#0F0F1A] hover:bg-primary hover:text-white transition text-sm text-gray-600 dark:text-gray-300 group">
                                                <div class="flex items-center gap-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                                    </svg>
                                                    <span>X / Twitter</span>
                                                </div>
                                                @if ($user->x)
                                                    <span class="group-hover:text-white">↗</span>
                                                @else
                                                    <span class="text-[10px] italic text-gray-400">Belum diisi</span>
                                                @endif
                                            </a>

                                            <!-- Facebook -->
                                            <a href="{{ $user->facebook ?: '#' }}"
                                                target="{{ $user->facebook ? '_blank' : '' }}"
                                                class="flex items-center justify-between px-3 py-2 rounded-xl bg-gray-100 dark:bg-[#0F0F1A] hover:bg-primary hover:text-white transition text-sm text-gray-600 dark:text-gray-300 group">
                                                <div class="flex items-center gap-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                                    </svg>
                                                    <span>Facebook</span>
                                                </div>
                                                @if ($user->facebook)
                                                    <span class="group-hover:text-white">↗</span>
                                                @else
                                                    <span class="text-[10px] italic text-gray-400">Belum diisi</span>
                                                @endif
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

                                            <button @click="openEditModal()"
                                                class="flex items-center gap-1.5 text-xs text-primary px-3 py-1.5 rounded-lg transition hover:text-white hover:bg-primary"
                                                style="background:rgba(108,99,255,0.10)">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                                Edit Data
                                            </button>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                            <!-- Nama Lengkap (TIDAK bisa diubah) -->
                                            <div>
                                                <label class="text-xs text-gray-400 mb-1 block">Nama Lengkap</label>
                                                <input type="text" value="{{ $user->nama }}" disabled
                                                    class="w-full input text-sm text-gray-400 bg-gray-200 dark:bg-white/[0.03] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none disabled:cursor-not-allowed">
                                            </div>

                                            <!-- Username (bisa diubah) -->
                                            <div>
                                                <label class="text-xs text-gray-400 mb-1 block">Username</label>
                                                <button @click="openEditModal()" type="button"
                                                    class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none text-left cursor-pointer hover:border-primary/50 transition">{{ $user->username }}</button>
                                            </div>

                                            <!-- Email (bisa diubah) -->
                                            <div>
                                                <label class="text-xs text-gray-400 mb-1 block">Email</label>
                                                <button @click="openEditModal()" type="button"
                                                    class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none text-left cursor-pointer hover:border-primary/50 transition">{{ $user->email }}</button>
                                            </div>

                                            <!-- Role (TIDAK bisa diubah) -->
                                            <div>
                                                <label class="text-xs text-gray-400 mb-1 block">Role</label>
                                                <input type="text" value="{{ $roleLabel }}" disabled
                                                    class="w-full input text-sm text-gray-400 bg-gray-200 dark:bg-white/[0.03] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none disabled:cursor-not-allowed">
                                            </div>

                                            <!-- Kata Sandi (bisa diubah) -->
                                            <div>
                                                <label class="text-xs text-gray-400 mb-1 block">Kata Sandi</label>
                                                <button @click="openEditModal()" type="button"
                                                    class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none text-left cursor-pointer hover:border-primary/50 transition">••••••••</button>
                                            </div>

                                            <!-- Tanggal Lahir (bisa diubah) -->
                                            <div>
                                                <label class="text-xs text-gray-400 mb-1 block">Tanggal Lahir</label>
                                                <button @click="openEditModal()" type="button"
                                                    class="w-full input text-sm {{ $user->tanggal_lahir ? 'dark:text-white' : 'italic text-gray-400' }} bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none text-left cursor-pointer hover:border-primary/50 transition">{{ $user->tanggal_lahir ? $user->tanggal_lahir->translatedFormat('d F Y') : 'Belum diisi' }}</button>
                                            </div>

                                            <!-- Alamat (bisa diubah) -->
                                            <div class="md:col-span-2">
                                                <label class="text-xs text-gray-400 mb-1 block">Alamat</label>
                                                <button @click="openEditModal()" type="button"
                                                    class="w-full textarea text-sm {{ $user->alamat ? 'dark:text-white' : 'italic text-gray-400' }} bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none resize-none text-left cursor-pointer hover:border-primary/50 transition">{{ $user->alamat ?: 'Belum diisi' }}</button>
                                            </div>

                                        </div>

                                    </div>

                                </section>

                                <!-- PROGRAM MICROCREDENTIAL -->
                                @if (in_array($user->role, ['admin_microcredential', 'peserta']))
                                    <section>

                                        <div class="flex items-center justify-between mb-4">
                                            <h3 class="text-base font-semibold dark:text-white">
                                                Program Microcredential
                                            </h3>
                                        </div>

                                        @if (isset($programs) && $programs->count())

                                            <div class="space-y-3">

                                                @php
                                                    $badge = [
                                                        'buka' =>
                                                            'bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400',
                                                        'diterima' =>
                                                            'bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400',

                                                        'tutup' =>
                                                            'bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-400',
                                                        'ditolak' =>
                                                            'bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-400',

                                                        'menunggu' =>
                                                            'bg-yellow-100 dark:bg-yellow-500/10 text-yellow-600 dark:text-yellow-400',
                                                    ];
                                                @endphp

                                                @foreach ($programs as $program)
                                                    <div class="card-fix p-4">

                                                        <h4 class="text-sm font-semibold dark:text-white">
                                                            {{ $program->nama }}
                                                        </h4>

                                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                            {{ $program->jenisMicrocredential->nama ?? '-' }}

                                                            @if ($program->semester)
                                                                · {{ $program->semester->jenis }}
                                                                {{ $program->semester->tahun }}
                                                            @endif
                                                        </p>

                                                        <div class="mt-2">
                                                            <span
                                                                class="px-2 py-1 text-xs font-medium rounded-full {{ $badge[$program->status_tampil] ?? 'bg-gray-100 text-gray-500' }}">
                                                                {{ ucfirst($program->status_tampil) }}
                                                            </span>
                                                        </div>

                                                        {{-- ========================= --}}
                                                        {{-- ACTION PESERTA --}}
                                                        {{-- ========================= --}}
                                                        @if ($user->role === 'peserta')
                                                            <div class="mt-4 flex flex-wrap gap-2">

                                                                @if (!$program->program_selesai)
                                                                    <span
                                                                        class="px-3 py-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-500 text-xs">
                                                                        Program masih berlangsung
                                                                    </span>
                                                                @else
                                                                    {{-- Rating --}}
                                                                    @if (!$program->sudah_rating)
                                                                        <a href="{{ route('peserta.ulasan.create', $program->id_pendaftaran) }}"
                                                                            class="px-3 py-2 rounded-lg bg-yellow-500 text-white text-xs hover:bg-yellow-600 transition">
                                                                            Beri Rating
                                                                        </a>
                                                                    @endif


                                                                    {{-- Sertifikat --}}
                                                                    @if ($program->boleh_download)
                                                                        <div class="flex gap-2">

                                                                            <a href="{{ route('peserta.sertifikat.show', $program->id_pendaftaran) }}"
                                                                                class="px-3 py-2 rounded-lg bg-blue-600 text-white text-xs hover:bg-blue-700">

                                                                                Preview

                                                                            </a>

                                                                            <a href="{{ route('peserta.sertifikat.download', $program->id_pendaftaran) }}"
                                                                                class="px-3 py-2 rounded-lg bg-green-600 text-white text-xs hover:bg-green-700 transition">

                                                                                Download Sertifikat

                                                                            </a>

                                                                        </div>
                                                                    @else
                                                                        <button disabled
                                                                            class="px-3 py-2 rounded-lg bg-gray-300 dark:bg-gray-700 text-gray-500 text-xs cursor-not-allowed">
                                                                            Download Sertifikat
                                                                        </button>
                                                                    @endif
                                                                @endif

                                                            </div>
                                                        @endif

                                                    </div>
                                                @endforeach

                                            </div>
                                        @else
                                            <div class="card-fix p-8 text-center">

                                                <svg class="w-12 h-12 mx-auto text-gray-300 dark:text-gray-600 mb-3"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>

                                                <p class="text-sm text-gray-400 dark:text-gray-500">
                                                    Belum ada program microcredential.
                                                </p>

                                            </div>

                                        @endif

                                    </section>
                                @endif

                            </div>

                        </div>

                    </section>

                </div><!-- end scrollable -->
            </main>

            <!-- ===== RIGHT PANEL ===== -->
            <x-rightPanel />

        </div><!-- end inner flex -->

    </div><!-- end outer flex -->


    {{-- ========================================= --}}
    {{-- MODAL EDIT PROFIL --}}
    {{-- ========================================= --}}
    <div x-show="showEditModal" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="background:rgba(0,0,0,0.5)">

        <div @click.outside="if (!$event.target.closest('.flatpickr-calendar')) showEditModal = false"
            x-show="showEditModal" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            class="w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-2xl bg-white dark:bg-[#1A1A2E] shadow-2xl p-6">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold dark:text-white">Edit Profil</h3>
                <button @click="showEditModal = false"
                    class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>



            {{-- Form edit profil --}}
            <form method="POST" action="{{ route($updateRoute) }}" enctype="multipart/form-data"
                class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Upload foto profil --}}
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <img :src="photoPreview || '{{ $avatarUrl }}'"
                            class="w-20 h-20 rounded-full object-cover border-2 border-primary" alt="preview foto">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Foto Profil</label>
                        <input type="file" name="foto_profil" accept="image/*" @change="previewPhoto($event)"
                            class="text-sm text-gray-500 dark:text-gray-400 file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                        <p class="text-[10px] text-gray-400 mt-1">JPG, PNG, WebP. Maks 2MB.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Nama (TIDAK bisa diubah) --}}
                    <div>
                        <label class="text-xs text-gray-400 mb-1 block">Nama Lengkap <span
                                class="text-[10px] text-gray-500">(tidak bisa diubah)</span></label>
                        <input type="hidden" name="nama" :value="form.nama">
                        <input type="text" :value="form.nama" disabled
                            class="w-full input text-sm text-gray-400 bg-gray-200 dark:bg-white/[0.03] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none disabled:cursor-not-allowed">
                    </div>

                    {{-- Username (editable + AJAX check) --}}
                    <div>
                        <label class="text-xs text-gray-400 mb-1 block">Username <span
                                class="text-red-400">*</span></label>
                        <div class="relative">
                            <input type="text" name="username" x-model="form.username"
                                @input.debounce.500ms="checkUsername()" required
                                class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none focus:border-primary pr-8"
                                :class="{ 'border-red-400': usernameStatus === 'taken', 'border-green-400': usernameStatus === 'available' }">
                            <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                <template x-if="usernameChecking"><svg class="w-4 h-4 animate-spin text-primary"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                    </svg></template>
                                <template x-if="usernameStatus === 'taken'"><svg class="w-4 h-4 text-red-400"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg></template>
                                <template x-if="usernameStatus === 'available'"><svg class="w-4 h-4 text-green-400"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg></template>
                            </div>
                        </div>
                        <p x-show="usernameMessage" class="text-[11px] mt-1"
                            :class="usernameStatus === 'taken' ? 'text-red-400' : 'text-green-400'"
                            x-text="usernameMessage"></p>
                        <p class="text-[10px] text-gray-400 mt-0.5">Huruf, angka, underscore, dan titik saja.</p>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="text-xs text-gray-400 mb-1 block">Email <span
                                class="text-red-400">*</span></label>
                        <input type="email" name="email" x-model="form.email" required
                            class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none focus:border-primary">
                    </div>

                    {{-- Role (readonly) --}}
                    <div>
                        <label class="text-xs text-gray-400 mb-1 block">Role <span
                                class="text-[10px] text-gray-500">(tidak bisa diubah)</span></label>
                        <input type="text" value="{{ $roleLabel }}" disabled
                            class="w-full input text-sm text-gray-400 bg-gray-200 dark:bg-white/[0.03] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none disabled:cursor-not-allowed">
                    </div>

                    {{-- Nomor Telepon --}}
                    <div>
                        <label class="text-xs text-gray-400 mb-1 block">Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" x-model="form.nomor_telepon"
                            placeholder="Contoh: +62 812-3456-7890"
                            class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none focus:border-primary">
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="text-xs text-gray-400 mb-1 block">Tanggal Lahir</label>
                        <input type="text" id="flatpickrTanggalLahir" name="tanggal_lahir"
                            x-model="form.tanggal_lahir" readonly placeholder="Pilih tanggal lahir"
                            class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none focus:border-primary cursor-pointer">
                    </div>

                    {{-- Alamat --}}
                    <div class="md:col-span-2">
                        <label class="text-xs text-gray-400 mb-1 block">Alamat</label>
                        <textarea name="alamat" x-model="form.alamat" rows="2" placeholder="Contoh: Jl. Teknologi No. 88, Jakarta"
                            class="w-full textarea text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none focus:border-primary resize-none"></textarea>
                    </div>
                </div>

                {{-- Social Media --}}
                <div>
                    <h4 class="text-sm font-semibold dark:text-white mb-3">Social Media</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs text-gray-400 mb-1 block">LinkedIn</label>
                            <input type="text" name="linkedin" x-model="form.linkedin"
                                placeholder="https://linkedin.com/in/..."
                                class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 mb-1 block">Instagram</label>
                            <input type="text" name="instagram" x-model="form.instagram" placeholder="@username"
                                class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 mb-1 block">X / Twitter</label>
                            <input type="text" name="x" x-model="form.x" placeholder="@username"
                                class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 mb-1 block">Facebook</label>
                            <input type="text" name="facebook" x-model="form.facebook"
                                placeholder="https://facebook.com/..."
                                class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none focus:border-primary">
                        </div>
                    </div>
                </div>

                {{-- Ganti Kata Sandi --}}
                <div>
                    <h4 class="text-sm font-semibold dark:text-white mb-3">Ganti Kata Sandi <span
                            class="text-xs font-normal text-gray-400">(default: sama dengan username)</span></h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs text-gray-400 mb-1 block">Kata Sandi Baru</label>
                            <input type="password" name="kata_sandi" placeholder="Minimal 6 karakter"
                                class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 mb-1 block">Konfirmasi Kata Sandi</label>
                            <input type="password" name="kata_sandi_confirmation" placeholder="Ulangi kata sandi"
                                class="w-full input text-sm dark:text-white bg-gray-50 dark:bg-[#0F0F1A] border border-gray-200 dark:border-white/5 rounded-xl focus:outline-none focus:border-primary">
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah. Default password =
                        username Anda.</p>
                </div>

                {{-- Tombol aksi --}}
                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button" @click="showEditModal = false"
                        class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white transition">
                        Batal
                    </button>
                    <button type="submit" :disabled="usernameStatus === 'taken'"
                        class="px-6 py-2 text-sm font-medium text-white bg-primary rounded-xl hover:opacity-90 transition disabled:opacity-50 disabled:cursor-not-allowed">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>


    {{-- Script Alpine.js --}}
    <script>
        function profilApp() {
            return {
                // Dark mode toggle
                dark: localStorage.getItem('theme') === 'dark',
                toggleDark() {
                    this.dark = !this.dark;
                    localStorage.setItem('theme', this.dark ? 'dark' : 'light');
                    document.documentElement.classList.toggle('dark', this.dark);
                },

                // State modal
                showEditModal: false,
                photoPreview: null,

                // Username AJAX check
                usernameChecking: false,
                usernameStatus: null,
                usernameMessage: '',
                originalUsername: @json($user->username),

                // Data form edit
                form: {
                    nama: @json($user->nama),
                    username: @json($user->username),
                    email: @json($user->email),
                    nomor_telepon: @json($user->nomor_telepon),
                    alamat: @json($user->alamat),
                    tanggal_lahir: @json($user->tanggal_lahir ? $user->tanggal_lahir->format('Y-m-d') : ''),
                    linkedin: @json($user->linkedin),
                    instagram: @json($user->instagram),
                    facebook: @json($user->facebook),
                    x: @json($user->x),
                },

                init() {
                    @if ($errors->any())
                        this.showEditModal = true;
                        this.$nextTick(() => this.initFlatpickr());
                    @endif
                },

                initFlatpickr() {
                    const el = document.getElementById('flatpickrTanggalLahir');
                    if (el) {
                        // Destroy existing instance if any
                        if (el._flatpickr) el._flatpickr.destroy();
                        flatpickr(el, {
                            dateFormat: 'Y-m-d',
                            altInput: true,
                            altFormat: 'd F Y',
                            defaultDate: this.form.tanggal_lahir || null,
                            onChange: (selectedDates, dateStr) => {
                                this.form.tanggal_lahir = dateStr;
                            }
                        });
                    }
                },

                openEditModal() {
                    this.showEditModal = true;
                    this.photoPreview = null;
                    this.usernameStatus = null;
                    this.usernameMessage = '';

                    // Initialize flatpickr when modal opens
                    this.$nextTick(() => this.initFlatpickr());
                },

                async checkUsername() {
                    const val = this.form.username.trim();
                    if (!val || val === this.originalUsername) {
                        this.usernameStatus = null;
                        this.usernameMessage = '';
                        return;
                    }
                    this.usernameChecking = true;
                    try {
                        const res = await fetch('{{ route($checkUsernameRoute) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                username: val
                            }),
                        });
                        const data = await res.json();
                        this.usernameStatus = data.available ? 'available' : 'taken';
                        this.usernameMessage = data.message;
                    } catch (e) {
                        this.usernameStatus = null;
                        this.usernameMessage = '';
                    }
                    this.usernameChecking = false;
                },

                previewPhoto(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.photoPreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },
            };
        }
    </script>

</body>

</html>
