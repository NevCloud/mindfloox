<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Program - Super Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <x-topNav />

        <div class="flex-1 overflow-y-auto p-5 space-y-5">
            <div class="flex items-center gap-3">
                <a href="{{ url('/super-admin/program') }}"
                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-300 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-xl font-bold text-gray-800 dark:text-white">Edit Program</h1>
                    <p class="text-sm text-gray-500">Ubah data program microcredential</p>
                </div>
            </div>

            <div class="card translate-0 p-6 max-w-2xl">
                <form action="{{ url('/super-admin/program') }}" method="GET" class="space-y-5">
                    
                    <!-- Cover Image with Hover Edit -->
                    <div class="flex justify-center mb-6">
                        <div class="relative group cursor-pointer w-48 h-48">
                            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085"
                                class="w-full h-full rounded-2xl object-cover border-2 border-primary shadow-lg transition duration-300 group-hover:opacity-70"
                                alt="cover program">
                            
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/30 rounded-2xl backdrop-blur-[1px]">
                                <div class="bg-white/20 p-2 rounded-full backdrop-blur-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 13.5v3.75z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.06 6.19l3.75 3.75" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Program</label>
                        <input type="text" value="Web Development"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white text-sm outline-none focus:border-primary transition">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                        <textarea rows="4"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white text-sm outline-none focus:border-primary transition resize-none">Belajar membangun aplikasi web modern menggunakan Laravel.</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis</label>
                        <select class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white text-sm outline-none focus:border-primary transition">
                            <option value="Microcredential" selected>Microcredential</option>
                            <option value="Bootcamp">Bootcamp</option>
                            <option value="Kursus Singkat">Kursus Singkat</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                        <select class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white text-sm outline-none focus:border-primary transition">
                            <option value="Aktif" selected>Aktif</option>
                            <option value="Pending">Pending</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100 dark:border-gray-800">
                        <button type="submit"
                            class="px-6 py-2.5 rounded-xl text-white text-sm font-medium transition shadow-lg hover:shadow-xl hover:-translate-y-0.5"
                            style="background: #6C63FF">
                            Simpan Perubahan
                        </button>
                        <a href="{{ url('/super-admin/program') }}"
                            class="px-6 py-2.5 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-300 bg-gray-200 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700 transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
