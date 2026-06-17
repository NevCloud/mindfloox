<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kursus</title>
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
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.program.kursus.index', $program) }}"
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-300 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <polyline points="15 18 9 12 15 6"/>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Edit Kursus</h1>
                            <p class="text-sm text-gray-500">Ubah data kursus dalam program {{ $program->nama }}</p>
                        </div>
                    </div>

                    <!-- Form -->
                    <div class="card translate-0 p-6 max-w-2xl">
                        <form action="{{ route('admin.program.kursus.update', [$program, $course]) }}" method="POST" class="space-y-5">
                            @csrf
                            @method('PUT')

                            <!-- Nama Kursus -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Kursus</label>
                                <input type="text" name="nama" value="{{ old('nama', $course->nama) }}"
                                    placeholder="Contoh: UI/UX Design"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white text-sm outline-none focus:border-primary transition">
                                @error('nama')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                                <textarea name="deskripsi" rows="4"
                                    placeholder="Deskripsi kursus..."
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white text-sm outline-none focus:border-primary transition resize-none">{{ old('deskripsi', $course->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Instruktur -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Instruktur (F011 - Assign Instruktur)</label>
                                <select name="id_instruktur"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white text-sm outline-none focus:border-primary transition">
                                    <option value="">-- Pilih Instruktur --</option>
                                    @foreach($instructors as $instructor)
                                        <option value="{{ $instructor->id }}" {{ old('id_instruktur', $selectedInstrukturId) == $instructor->id ? 'selected' : '' }}>
                                            {{ $instructor->pengguna->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_instruktur')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="flex items-center gap-3 pt-2">
                                <button type="submit"
                                    class="px-6 py-2.5 rounded-lg text-white text-sm font-medium transition"
                                    style="background: #6C63FF">
                                    Update Kursus
                                </button>
                                <a href="{{ route('admin.program.kursus.index', $program) }}"
                                    class="px-6 py-2.5 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 transition">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>

                </div>
            </main>
        </div>
    </div>

</body>
</html>
