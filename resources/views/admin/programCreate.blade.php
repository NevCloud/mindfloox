<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Program</title>
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
                        <a href="{{ route('admin.program.index') }}"
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-300 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <polyline points="15 18 9 12 15 6"/>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Tambah Program</h1>
                            <p class="text-sm text-gray-500">Buat program akademik baru</p>
                        </div>
                    </div>

                    <!-- Form -->
                    <div class="card translate-0 p-6 max-w-2x2">
                        <form action="{{ route('admin.program.create') }}" method="POST" class="space-y-5">
                            @csrf

                            <!-- Nama Program -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Program</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    placeholder="Contoh: Web Development"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white text-sm outline-none focus:border-primary transition">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                                <textarea name="description" rows="4"
                                    placeholder="Deskripsi program akademik..."
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white text-sm outline-none focus:border-primary transition resize-none">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                <select name="status"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white text-sm outline-none focus:border-primary transition">
                                    <option value="aktif" {{ old('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="flex items-center gap-3 pt-2">
                                <button type="submit"
                                    class="px-6 py-2.5 rounded-lg text-white text-sm font-medium transition"
                                    style="background: #6C63FF">
                                    Simpan Program
                                </button>
                                <a href="{{ route('admin.program.index') }}"
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
