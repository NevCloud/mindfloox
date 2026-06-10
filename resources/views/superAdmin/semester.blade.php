<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semester - Super Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
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
}" x-init="document.documentElement.classList.toggle('dark', dark)" class="min-h-screen bg-gray-50 dark:bg-[#0F0F1A] flex">

    <x-leftPanel />

    <main class="flex-1 flex flex-col overflow-hidden">
        <x-topNav />

        <div class="flex-1 overflow-y-auto">
            <div class="p-5 space-y-5">

                <!-- Header -->
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 dark:text-white">Semester</h1>
                        <p class="text-sm text-gray-500 mt-1">Kelola data semester</p>
                    </div>
                </div>

                <!-- Search + Add -->
                <div class="card translate-0 p-5">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex-1 flex items-center gap-2 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 transition-all duration-300 focus-within:ring-2 focus-within:ring-primary focus-within:border-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                            <input type="text" placeholder="Cari semester..." class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 w-full py-0.5">
                        </div>
                        <button
                            class="px-4 py-2 bg-[#6C63FF] hover:bg-[#282ff3] dark:hover:bg-[#4b4bd9] rounded-lg text-sm font-medium transition flex items-center gap-2 text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah Semester
                        </button>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left whitespace-nowrap">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-800">
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Tahun Ajaran</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Jenis Semester</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Tanggal Mulai</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Tanggal Selesai</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800 dark:text-gray-300">
                                <tr
                                    class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                    <td class="py-3 px-4">1</td>
                                    <td class="py-3 px-4 font-medium">2024/2025</td>
                                    <td class="py-3 px-4">
                                        <span
                                            class="px-2 py-1 bg-blue-100 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs font-medium rounded-full">Ganjil</span>
                                    </td>
                                    <td class="py-3 px-4 text-gray-500">2024-09-01</td>
                                    <td class="py-3 px-4 text-gray-500">2024-12-31</td>
                                    <td class="py-3 px-4">
                                        <div class="flex justify-center gap-1">
                                            <button class="group w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                                </svg>
                                            </button>
                                            <button class="group w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr
                                    class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                    <td class="py-3 px-4">2</td>
                                    <td class="py-3 px-4 font-medium">2024/2025</td>
                                    <td class="py-3 px-4">
                                        <span
                                            class="px-2 py-1 bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-xs font-medium rounded-full">Genap</span>
                                    </td>
                                    <td class="py-3 px-4 text-gray-500">2025-01-15</td>
                                    <td class="py-3 px-4 text-gray-500">2025-06-30</td>
                                    <td class="py-3 px-4">
                                        <div class="flex justify-center gap-1">
                                            <button class="group w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                                </svg>
                                            </button>
                                            <button class="group w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>



</body>

</html>
