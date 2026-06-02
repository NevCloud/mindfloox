<div class="grid grid-cols-2 md:grid-cols-4 gap-3">
    <!-- Course Diajar -->
    <div onclick="window.location.href='/instructor/courses'" class="card p-4 cursor-pointer hover:shadow-md transition">
        <div class="flex items-start justify-between mb-3">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:rgba(108,99,255,0.15)">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
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
    <div onclick="window.location.href='/instructor/tugas'" class="card p-4 cursor-pointer hover:shadow-md transition">
        <div class="flex items-start justify-between mb-3">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:rgba(239,68,68,0.15)">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span
                class="text-[10px] font-medium text-red-600 bg-red-100 dark:bg-red-500/20 dark:text-red-400 px-2 py-0.5 rounded-full">Perlu Tindakan</span>
        </div>
        <p class="text-2xl font-bold dark:text-white">2</p>
        <p class="text-xs text-gray-400 mt-0.5">Terlambat Evaluasi</p>
    </div>

    <!-- Menunggu Penilaian -->
    <div onclick="window.location.href='/instructor/tugas'" class="card p-4 cursor-pointer hover:shadow-md transition">
        <div class="flex items-start justify-between mb-3">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:rgba(245,158,11,0.15)">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
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
    <div onclick="window.location.href='/instructor/tugas'" class="card p-4 cursor-pointer hover:shadow-md transition">
        <div class="flex items-start justify-between mb-3">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:rgba(108,99,255,0.15)">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <span
                class="text-[10px] font-medium text-primary bg-primary/10 px-2 py-0.5 rounded-full">Minggu Ini</span>
        </div>
        <p class="text-2xl font-bold dark:text-white">3</p>
        <p class="text-xs text-gray-400 mt-0.5">Deadline</p>
    </div>
</div>
