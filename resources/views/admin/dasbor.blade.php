<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Microcredential</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
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
}" x-init="document.documentElement.classList.toggle('dark', dark)" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">
        <x-leftPanel />

        <main class="flex-1 flex flex-col overflow-hidden">

        <!-- Navbar admin -->
        <x-topNav />

                <!-- Scrollable content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">

        <!--banner admin-->
        <x-banner />

                    <!-- Stat Cards -->
                    <x-stats :totalKursus="$totalKursus" :pendingVerifikasi="$pendingVerifikasi" />

                    <!-- Main Grid -->
                    <section class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                        <!-- Program Terbaru -->
                        <div class="card translate-0">
                            <div class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-pink-100 dark:bg-pink-500/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">{{ $programs->count() ? 'Kursus Program ' . $programs->first()->nama : 'Kursus Program' }}</h3>
                                        <p class="text-xs text-gray-500">Daftar Kursus</p>
                                    </div>
                                </div>
                                <a href="{{ url('/admin/program') }}" class="flex items-center gap-1 px-3 py-1.5 text-xs text-[#6C63FF] hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg transition font-medium">
                                    Lihat Semua
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>

                            <div class="p-5">
                                <table class="w-full text-xs">
                                    <thead class="text-gray-500 border-b border-gray-200 dark:border-gray-800">
                                        <tr class="text-left">
                                            <th class="pb-3 font-medium">Nama Kursus</th>
                                            <th class="pb-3 font-medium">Instruktur</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-800 dark:text-gray-300">
                                        @forelse($kursusList as $item)
                                            <tr class="border-b border-gray-100 dark:border-gray-800 last:border-b-0">
                                                <td class="py-3 font-medium">{{ $item['name'] }}</td>
                                                <td class="py-3 text-gray-500">{{ $item['instruktur'] }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="py-6 text-center text-gray-400">Belum ada kursus</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Verifikasi Terbaru -->
                        <div class="card translate-0">
                            <div class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-yellow-100 dark:bg-yellow-500/10 text-yellow-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-white">Pendaftaran Terbaru</h3>
                                        <p class="text-xs text-gray-500">Menunggu verifikasi</p>
                                    </div>
                                </div>
                                <a href="{{ url('/admin/verifikasi') }}" class="flex items-center gap-1 px-3 py-1.5 text-xs text-[#6C63FF] hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg transition font-medium">
                                    Lihat Semua
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>

                            <div class="p-5 space-y-3">
                                @forelse($pendaftaranList as $item)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                                                {{ $item['initial'] }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800 dark:text-white">{{ $item['name'] }}</p>
                                                <p class="text-xs text-gray-500">{{ $item['course'] }}</p>
                                            </div>
                                        </div>
                                        <span class="px-2 py-0.5 bg-yellow-100 dark:bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 text-[10px] font-medium rounded-full">
                                            Menunggu
                                        </span>
                                    </div>
                                @empty
                                    <p class="text-center text-gray-400 text-xs py-4">Belum ada pendaftaran menunggu</p>
                                @endforelse
                            </div>
                        </div>

                    </section>

                </div>
            </main>

    <x-rightPanel />

    <x-toast />

</body>
</html>
