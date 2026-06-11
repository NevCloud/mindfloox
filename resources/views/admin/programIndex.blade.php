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
    },
    programs: [
        { nama: 'UI/UX Design Specialist', jenis: 'UI/UX Design', semester: 'Ganjil 2024/2025', status: 'buka' },
        { nama: 'Data Science Bootcamp', jenis: 'Data Science', semester: 'Ganjil 2024/2025', status: 'tutup' }
    ]
}" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">
        <x-leftPanel />

        <main class="flex-1 flex flex-col overflow-hidden">

            <x-topNav />

            <!-- Content -->
            <div class="flex-1 overflow-y-auto">
                <div class="p-5 space-y-5">

                    <!-- Header -->
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Program Microcredential</h1>
                            <p class="text-sm text-gray-500">Lihat daftar program dan kelola kursus di dalamnya</p>
                        </div>
                    </div>

                    <!-- Success Message -->
                    @if (session('success'))
                        <div
                            class="px-4 py-3 rounded-lg bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-300 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Table Section -->
                    <div class="card translate-0 p-5">
                        <div class="flex items-center gap-3 mb-5">
                            <div
                                class="flex-1 flex items-center gap-2 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 transition-all duration-300 focus-within:ring-2 focus-within:ring-primary focus-within:border-transparent">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 flex-shrink-0"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8" />
                                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                </svg>
                                <input type="text" placeholder="Cari program microcredential..."
                                    class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 w-full py-0.5">
                            </div>
                            <select
                                class="px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-sm text-gray-800 dark:text-white focus:ring-2 focus:ring-primary outline-none transition">
                                <option value="">Semua Status</option>
                                <option value="buka">Buka</option>
                                <option value="tutup">Tutup</option>
                            </select>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left whitespace-nowrap">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-800">
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">No</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Program</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Jenis
                                            Microcredential</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Semester</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Status
                                            Pendaftaran</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase text-center">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-800 dark:text-gray-300">
                                    <template x-for="(item, index) in programs" :key="index">
                                        <tr
                                            class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                            <td class="py-3 px-4" x-text="index + 1"></td>
                                            <td class="py-3 px-4 font-medium" x-text="item.nama"></td>
                                            <td class="py-3 px-4 text-gray-500" x-text="item.jenis"></td>
                                            <td class="py-3 px-4 text-gray-500" x-text="item.semester"></td>
                                            <td class="py-3 px-4">
                                                <template x-if="item.status === 'buka'">
                                                    <span
                                                        class="px-2 py-1 bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-xs font-medium rounded-full">Buka</span>
                                                </template>
                                                <template x-if="item.status === 'tutup'">
                                                    <span
                                                        class="px-2 py-1 bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs font-medium rounded-full">Tutup</span>
                                                </template>
                                            </td>
                                            <td class="py-3 px-4">
                                                <div class="flex justify-center gap-1">
                                                    <a href="#"
                                                        class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 hover:bg-blue-500 hover:text-white transition-all duration-200 text-xs font-medium">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                        </svg>
                                                        Kelola Kursus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </main>

        <x-rightPanel />

</body>

</html>
