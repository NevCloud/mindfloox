<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus - {{ $program->name }}</title>
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
                <x-topNav />

                <!-- Content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    <!-- Header -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.program.index') }}"
                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-300 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <polyline points="15 18 9 12 15 6"/>
                                </svg>
                            </a>
                            <div>
                                <h1 class="text-xl font-bold text-gray-800 dark:text-white">Kursus - {{ $program->name }}</h1>
                                <p class="text-sm text-gray-500">Kelola kursus dalam program ini</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.program.kursus.create', $program) }}"
                            class="flex items-center gap-2 px-4 py-2 rounded-lg text-white text-sm font-medium transition"
                            style="background: #6C63FF">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Tambah Kursus
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
                                        <th class="px-4 py-3">Nama Kursus</th>
                                        <th class="px-4 py-3">Deskripsi</th>
                                        <th class="px-4 py-3">Instruktur</th>
                                        <th class="px-4 py-3 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @forelse($courses as $index => $course)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-200">
                                        <td class="px-4 py-4 text-gray-500">{{ $index + 1 }}</td>
                                        <td class="px-4 py-4 font-medium text-gray-800 dark:text-white">{{ $course->name }}</td>
                                        <td class="px-4 py-4 text-gray-500">{{ Str::limit($course->description, 50) }}</td>
                                        <td class="px-4 py-4 text-gray-500">
                                            {{ $course->instructor ? $course->instructor->name : 'Belum ada instruktur' }}
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex justify-end items-center gap-2">
                                                <a href="{{ route('admin.program.kursus.edit', [$program, $course]) }}"
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.program.kursus.destroy', [$program, $course]) }}" method="POST" onsubmit="return confirm('Yakin hapus kursus ini?')">
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
                                        <td colspan="5" class="px-4 py-8 text-center text-gray-400">Belum ada kursus dalam program ini</td>
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
