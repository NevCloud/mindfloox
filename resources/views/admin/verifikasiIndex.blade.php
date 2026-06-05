<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pendaftaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
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
}" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">
        <x-leftPanel />

        <div class="flex flex-1 min-w-0 overflow-hidden">
            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">

                <!-- Topbar -->
                <div class="flex items-center gap-3 px-4 py-3 bg-gray-100 dark:bg-[#1A1A2E] border-b border-black/5 dark:border-white/5 flex-shrink-0">
                    <div class="flex-1 flex items-center gap-2 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                        <input type="text" placeholder="Cari pendaftaran..." class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400">
                    </div>
                    <button @click="toggleDark()" class="w-14 h-8 flex items-center rounded-full p-1 transition-all duration-300" :class="dark ? 'bg-gray-700' : 'bg-gray-300'">
                        <div :class="dark ? 'translate-x-6' : 'translate-x-0'" class="w-6 h-6 bg-white dark:bg-[#1A1A2E] rounded-full shadow-md transform transition-all duration-300"></div>
                    </button>
                </div>

                <!-- Content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    <!-- Header -->
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 dark:text-white">Verifikasi Pendaftaran</h1>
                        <p class="text-sm text-gray-500">Tinjau dan verifikasi pendaftaran peserta</p>
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                    <div class="px-4 py-3 rounded-lg bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-300 text-sm">
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- Table -->
                    <div class="card translate-0 p-4">
                        <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800">
                            <table class="w-full text-sm">
                                <thead class="text-gray-500 border-b border-gray-200 dark:border-gray-800">
                                    <tr class="text-left">
                                        <th class="px-4 py-3">No</th>
                                        <th class="px-4 py-3">Nama Peserta</th>
                                        <th class="px-4 py-3">Program</th>
                                        <th class="px-4 py-3">Tanggal Daftar</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @forelse($registrations as $index => $reg)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-200">
                                        <td class="px-4 py-4 text-gray-500">{{ $index + 1 }}</td>
                                        <td class="px-4 py-4 font-medium text-gray-800 dark:text-white">
                                            {{ $reg->user->name ?? '-' }}
                                        </td>
                                        <td class="px-4 py-4 text-gray-500">
                                            {{ $reg->program->name ?? '-' }}
                                        </td>
                                        <td class="px-4 py-4 text-gray-500">
                                            {{ $reg->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-4 py-4">
                                            @if($reg->status === 'pending')
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-500/20 dark:text-yellow-300">Pending</span>
                                            @elseif($reg->status === 'diterima')
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-300">Diterima</span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-300">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex justify-end items-center gap-2">
                                                @if($reg->status === 'pending')
                                                <form action="{{ route('admin.verifikasi.approve', $reg) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium text-white bg-green-500 hover:bg-green-600 transition">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <polyline points="20 6 9 17 4 12"/>
                                                        </svg>
                                                        Terima
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.verifikasi.reject', $reg) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium text-white bg-red-500 hover:bg-red-600 transition">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                                                        </svg>
                                                        Tolak
                                                    </button>
                                                </form>
                                                @else
                                                <span class="text-xs text-gray-400">Sudah diverifikasi</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-8 text-center text-gray-400">Belum ada pendaftaran masuk</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

</body>
</html>
