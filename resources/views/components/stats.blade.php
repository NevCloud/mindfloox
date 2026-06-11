<!--STATS SUPER ADMIN-->
@if (request()->is('super-admin/*'))
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <!-- Total Program -->
        <div class="card p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:rgba(108,99,255,0.15)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold dark:text-white">{{ \App\Models\ProgramMicrocredential::count() ?? 0 }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Total Program</p>
        </div>

        <!-- Total Admin -->
        <div class="card p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                    style="background:rgba(255,107,53,0.15)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color:#ff6b35" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold dark:text-white">{{ \App\Models\AdminMicrocredential::count() ?? 0 }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Total Admin</p>
        </div>

        <!-- Total Instruktur -->
        <div class="card p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                    style="background:rgba(76,175,80,0.15)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color:#4caf50" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold dark:text-white">{{ \App\Models\Instruktur::count() ?? 0 }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Total Instruktur</p>
        </div>

        <!-- Total Peserta -->
        <div class="card p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                    style="background:rgba(233,30,140,0.15)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color:#e91e8c" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold dark:text-white">{{ \App\Models\Peserta::count() ?? 0 }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Total Peserta</p>
        </div>
    </div>

    <!--STATS ADMIN-->
@elseif(request()->is('admin/*'))
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <!-- Total Program -->
        <div class="card p-4">
            <div class="flex items-start justify-between mb-3">
                <div
                    class="w-9 h-9 rounded-xl flex items-center justify-center bg-purple-100 dark:bg-purple-500/20 text-purple-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold dark:text-white">{{ \App\Models\ProgramMicrocredential::count() ?? 0 }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Total Program</p>
        </div>

        <!-- Total Kursus -->
        <div class="card p-4">
            <div class="flex items-start justify-between mb-3">
                <div
                    class="w-9 h-9 rounded-xl flex items-center justify-center bg-blue-100 dark:bg-blue-500/20 text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                        <path d="M6 12v5c3 3 9 3 12 0v-5" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold dark:text-white">{{ \App\Models\Kursus::count() ?? 0 }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Total Kursus</p>
        </div>

        <!-- Pending Verifikasi -->
        <div class="card p-4">
            <div class="flex items-start justify-between mb-3">
                <div
                    class="w-9 h-9 rounded-xl flex items-center justify-center bg-yellow-100 dark:bg-yellow-500/20 text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold dark:text-white">
                {{ \App\Models\Pendaftaran::where('status', 'pending')->count() ?? 0 }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Pending Verifikasi</p>
        </div>
    </div>



    <!--STATS INSTRUUKTUR-->
@elseif(request()->is('instruktur/*'))
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <!-- Course Diajar -->
        <div class="card p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                    style="background:rgba(108,99,255,0.15)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                    </svg>
                </div>
                <span
                    class="text-[10px] font-medium text-green-600 bg-green-100 dark:bg-green-500/20 dark:text-green-400 px-2 py-0.5 rounded-full">Aktif</span>
            </div>
            <p class="text-2xl font-bold dark:text-white">4</p>
            <p class="text-xs text-gray-400 mt-0.5">Course Diajar</p>
        </div>

        <!-- Terlambat Evaluasi -->
        <div class="card p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                    style="background:rgba(239,68,68,0.15)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span
                    class="text-[10px] font-medium text-red-600 bg-red-100 dark:bg-red-500/20 dark:text-red-400 px-2 py-0.5 rounded-full">Perlu
                    Tindakan</span>
            </div>
            <p class="text-2xl font-bold dark:text-white">2</p>
            <p class="text-xs text-gray-400 mt-0.5">Terlambat Evaluasi</p>
        </div>

        <!-- Menunggu Penilaian -->
        <div class="card p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                    style="background:rgba(245,158,11,0.15)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <span
                    class="text-[10px] font-medium text-yellow-600 bg-yellow-100 dark:bg-yellow-500/20 dark:text-yellow-400 px-2 py-0.5 rounded-full">Pending</span>
            </div>
            <p class="text-2xl font-bold dark:text-white">15</p>
            <p class="text-xs text-gray-400 mt-0.5">Menunggu Penilaian</p>
        </div>

        <!-- Deadline -->
        <div class="card p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                    style="background:rgba(108,99,255,0.15)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <span class="text-[10px] font-medium text-primary bg-primary/10 px-2 py-0.5 rounded-full">Minggu
                    Ini</span>
            </div>
            <p class="text-2xl font-bold dark:text-white">3</p>
            <p class="text-xs text-gray-400 mt-0.5">Deadline</p>
        </div>
    </div>

    <!--STATS PESERTA-->
@elseif(request()->is('peserta/*'))
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <div class="card p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                    style="background:rgba(108,99,255,0.15)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                    </svg>
                </div>
                <span
                    class="text-[10px] font-medium text-green-600 bg-green-100 dark:bg-green-500/20 dark:text-green-400 px-2 py-0.5 rounded-full">Aktif</span>
            </div>
            <p class="text-2xl font-bold dark:text-white">4</p>
            <p class="text-xs text-gray-400 mt-0.5">Course Diambil</p>
        </div>
        <div class="card p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                    style="background:rgba(255,107,53,0.15)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color:#ff6b35" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <polyline points="9 11 12 14 22 4" />
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                    </svg>
                </div>
                <span
                    class="text-[10px] font-medium text-orange-600 bg-orange-100 dark:bg-orange-500/20 dark:text-orange-400 px-2 py-0.5 rounded-full">3
                    pending</span>
            </div>
            <p class="text-2xl font-bold dark:text-white">12</p>
            <p class="text-xs text-gray-400 mt-0.5">Total Tugas</p>
        </div>
        <div class="card p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                    style="background:rgba(76,175,80,0.15)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color:#4caf50" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
                    </svg>
                </div>
                <span
                    class="text-[10px] font-medium text-green-600 bg-green-100 dark:bg-green-500/20 dark:text-green-400 px-2 py-0.5 rounded-full">↑
                    Baik</span>
            </div>
            <p class="text-2xl font-bold dark:text-white">87.5</p>
            <p class="text-xs text-gray-400 mt-0.5">Rata-rata Nilai</p>
        </div>
        <div class="card p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                    style="background:rgba(233,30,140,0.15)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color:#e91e8c" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="8" r="7" />
                        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88" />
                    </svg>
                </div>
                <span
                    class="text-[10px] font-medium text-purple-600 bg-purple-100 dark:bg-purple-500/20 dark:text-purple-400 px-2 py-0.5 rounded-full">2
                    baru</span>
            </div>
            <p class="text-2xl font-bold dark:text-white">5</p>
            <p class="text-xs text-gray-400 mt-0.5">Sertifikat</p>
        </div>
    </div>
@else
    <!-- Tampilkan sesuatu yang default atau kosongkan jika tidak ada stats khusus -->
@endif

