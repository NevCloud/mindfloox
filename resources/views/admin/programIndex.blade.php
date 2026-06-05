<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Akademik</title>
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
                        <input type="text" placeholder="Cari program..." class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400">
                    </div>
                    <button @click="toggleDark()" class="w-14 h-8 flex items-center rounded-full p-1 transition-all duration-300" :class="dark ? 'bg-gray-700' : 'bg-gray-300'">
                        <div :class="dark ? 'translate-x-6' : 'translate-x-0'" class="w-6 h-6 bg-white dark:bg-[#1A1A2E] rounded-full shadow-md transform transition-all duration-300"></div>
                    </button>
                </div>

                <!-- Content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    <!-- Header -->
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Program Akademik</h1>
                            <p class="text-sm text-gray-500">Kelola program microcredential</p>
                        </div>
                        <a href="{{ route('admin.program.create') }}"
                            class="flex items-center gap-2 px-4 py-2 rounded-lg text-white text-sm font-medium transition"
                            style="background: #6C63FF">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Tambah Program
                        </a>
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
                                        <th class="px-4 py-3">Nama Program</th>
                                        <th class="px-4 py-3">Deskripsi</th>
                                        <th class="px-4 py-3">Jumlah Kursus</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @forelse($programs as $index => $program)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-200">
                                        <td class="px-4 py-4 text-gray-500">{{ $index + 1 }}</td>
                                        <td class="px-4 py-4 font-medium text-gray-800 dark:text-white">{{ $program->name }}</td>
                                        <td class="px-4 py-4 text-gray-500">{{ Str::limit($program->description, 50) }}</td>
                                        <td class="px-4 py-4 text-gray-500">
                                            <a href="{{ route('admin.program.kursus.index', $program) }}"
                                                class="text-primary hover:underline">
                                                {{ $program->courses_count }} Kursus
                                            </a>
                                        </td>
                                        <td class="px-4 py-4">
                                            @if($program->status === 'aktif')
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-300">Aktif</span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-300">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex justify-end items-center gap-2">
                                                <a href="{{ route('admin.program.edit', $program) }}"
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.program.destroy', $program) }}" method="POST" onsubmit="return confirm('Yakin hapus program ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M10 11v6"/><path d="M14 11v6"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-8 text-center text-gray-400">Belum ada program akademik</td>
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
