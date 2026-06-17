<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pendaftaran - Peserta</title>
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
                            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Riwayat Pendaftaran</h1>
                            <p class="text-sm text-gray-500">Status pendaftaran Anda ke program microcredential</p>
                        </div>
                        <a href="{{ route('peserta.pendaftaran.index') }}"
                            class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-[#6C63FF] dark:text-purple-300 border border-purple-300 dark:border-purple-500/40 hover:bg-purple-50 dark:hover:bg-purple-500/10 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali ke Program
                        </a>
                    </div>

                    <!-- Stats Summary -->
                    @php
                        $counts = [
                            'menunggu' => $registrations->where('status', 'menunggu')->count(),
                            'diterima' => $registrations->where('status', 'diterima')->count(),
                            'ditolak'  => $registrations->where('status', 'ditolak')->count(),
                        ];
                    @endphp
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="card p-4 flex items-center gap-3">
                            <span class="flex items-center justify-center w-10 h-10 rounded-full bg-yellow-100 dark:bg-yellow-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </span>
                            <div>
                                <p class="text-xs text-gray-500">Menunggu</p>
                                <p class="text-lg font-bold dark:text-white">{{ $counts['menunggu'] }}</p>
                            </div>
                        </div>
                        <div class="card p-4 flex items-center gap-3">
                            <span class="flex items-center justify-center w-10 h-10 rounded-full bg-green-100 dark:bg-green-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </span>
                            <div>
                                <p class="text-xs text-gray-500">Diterima</p>
                                <p class="text-lg font-bold dark:text-white">{{ $counts['diterima'] }}</p>
                            </div>
                        </div>
                        <div class="card p-4 flex items-center gap-3">
                            <span class="flex items-center justify-center w-10 h-10 rounded-full bg-red-100 dark:bg-red-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </span>
                            <div>
                                <p class="text-xs text-gray-500">Ditolak</p>
                                <p class="text-lg font-bold dark:text-white">{{ $counts['ditolak'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="card overflow-hidden p-0">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="border-b border-gray-200 dark:border-gray-700">
                                    <tr class="text-xs text-gray-500 uppercase tracking-wider">
                                        <th class="px-5 py-3">Program</th>
                                        <th class="px-5 py-3">Tanggal Daftar</th>
                                        <th class="px-5 py-3">Status</th>
                                        <th class="px-5 py-3">Tanggal Verifikasi</th>
                                        <th class="px-5 py-3">Catatan Admin</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @forelse($registrations as $reg)
                                        @php
                                            $verifiedAt = $reg->tanggal_verifikasi ? \Carbon\Carbon::parse($reg->tanggal_verifikasi)->format('d M Y H:i') : '-';
                                            $registeredAt = $reg->tanggal_daftar ? \Carbon\Carbon::parse($reg->tanggal_daftar)->format('d M Y H:i') : '-';
                                        @endphp
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                                            <td class="px-5 py-3">
                                                <p class="font-medium text-gray-800 dark:text-white">{{ $reg->programMicrocredential->nama ?? '-' }}</p>
                                                <p class="text-xs text-gray-400">{{ $reg->programMicrocredential->jenisMicrocredential->nama ?? '-' }}</p>
                                            </td>
                                            <td class="px-5 py-3 text-gray-500 text-xs whitespace-nowrap">{{ $registeredAt }}</td>
                                            <td class="px-5 py-3">
                                                @if($reg->status === 'menunggu')
                                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-500/20 text-yellow-600 dark:text-yellow-400">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                                        Menunggu
                                                    </span>
                                                @elseif($reg->status === 'diterima')
                                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-500/20 text-green-600 dark:text-green-400">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                                        Diterima
                                                    </span>
                                                @elseif($reg->status === 'ditolak')
                                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                                        Ditolak
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-5 py-3 text-gray-500 text-xs whitespace-nowrap">{{ $verifiedAt }}</td>
                                            <td class="px-5 py-3 text-gray-500 text-xs max-w-xs truncate">{{ $reg->catatan_admin ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-5 py-12 text-center text-gray-400 dark:text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                <p class="text-xs">Belum ada riwayat pendaftaran.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </main>

            <x-rightPanel />
        </div>
    </div>

</body>
</html>
