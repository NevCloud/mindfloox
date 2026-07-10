<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Program - Peserta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark') { document.documentElement.classList.add('dark'); }
    </script>
</head>

<body x-data="{ dark: localStorage.getItem('theme') === 'dark', toggleDark() { this.dark = !this.dark; localStorage.setItem('theme', this.dark ? 'dark' : 'light'); document.documentElement.classList.toggle('dark', this.dark); } }"
    class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">
        <x-leftPanel />

        <div class="flex flex-1 min-w-0 overflow-hidden">
            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">
                <x-topNav />

                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    <!-- Header -->
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Program Tersedia</h1>
                            <p class="text-sm text-gray-500">Daftarkan diri ke program microcredential yang terbuka</p>
                        </div>
                        <a href="{{ route('peserta.pendaftaran.riwayat') }}"
                            class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-purple-600 dark:text-purple-300 border border-purple-300 dark:border-purple-500/40 hover:bg-purple-50 dark:hover:bg-purple-500/10 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Riwayat Pendaftaran
                        </a>
                    </div>

                    <!-- Flash Messages -->
                    <!-- Programs Grid -->
                    @forelse($programs as $program)
                        @php
                            $reg = $existingRegistrations->get($program->id);
                        @endphp
                        <div class="card translate-0 p-5 flex flex-col sm:flex-row gap-5">

                            <!-- Program Info -->
                            <div class="flex-1 min-w-0 space-y-2">
                                <div class="flex items-start justify-between gap-2">
                                    <h3 class="font-semibold text-gray-800 dark:text-white">{{ $program->nama }}</h3>
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-500/20 text-green-600 dark:text-green-400 whitespace-nowrap">Pendaftaran Buka</span>
                                </div>

                                <p class="text-sm text-gray-500 line-clamp-2">{{ $program->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

                                <div class="flex flex-wrap gap-3 text-xs text-gray-400">
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                        {{ $program->jenisMicrocredential->nama ?? '-' }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $program->periodePembelajaran->nama ?? '-' }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        {{ $program->kursus->count() }} kursus
                                    </span>
                                </div>
                            </div>

                            <!-- Action -->
                            <div class="flex-shrink-0 flex items-center">
                                @if($reg)
                                    @if($reg->status === 'menunggu')
                                        <span class="px-4 py-2 rounded-lg text-xs font-medium bg-yellow-100 dark:bg-yellow-500/20 text-yellow-600 dark:text-yellow-400 whitespace-nowrap">Menunggu Verifikasi</span>
                                    @elseif($reg->status === 'diterima')
                                        <span class="px-4 py-2 rounded-lg text-xs font-medium bg-green-100 dark:bg-green-500/20 text-green-600 dark:text-green-400 whitespace-nowrap">Diterima</span>
                                    @elseif($reg->status === 'ditolak')
                                        <span class="px-4 py-2 rounded-lg text-xs font-medium bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400 whitespace-nowrap">Pendaftaran Ditolak</span>
                                    @endif
                                @else
                                    <form action="{{ route('peserta.pendaftaran.store', $program->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mendaftar ke program ini?')">
                                        @csrf
                                        <button type="submit" class="px-5 py-2 rounded-lg text-white text-sm font-medium bg-[#6C63FF] hover:bg-[#5a52d5] transition whitespace-nowrap">Daftar Sekarang</button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    @empty
                        <div class="text-center py-16 text-gray-400 dark:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                            <p class="font-medium">Belum ada program yang dibuka</p>
                            <p class="text-xs mt-1">Saat ini belum ada program microcredential yang membuka pendaftaran.</p>
                        </div>
                    @endforelse

                </div>
            </main>

            <x-rightPanel />
        </div>
    </div>

</body>
</html>
