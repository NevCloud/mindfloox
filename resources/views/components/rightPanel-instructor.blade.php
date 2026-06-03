<aside id="rightPanel"
    class="fixed z-40 inset-y-0 right-0 w-72 flex flex-col gap-5 p-5
                       bg-gray-100 dark:bg-[#1A1A2E] border-l border-black/5 dark:border-white/5
                       transform translate-x-full transition-all duration-300 overflow-y-auto
                       lg:static lg:translate-x-0 lg:flex-shrink-0">

    <!-- Profile -->
    <div class="flex items-center justify-end gap-3 pt-1">
        <div class="text-right">
            <p class="text-sm font-semibold dark:text-white">Sarah Wijaya</p>
            <a href="#" class="text-xs text-primary cursor-pointer hover:underline">Lihat profil</a>
        </div>
        <img src="https://i.pravatar.cc/150?img=12" alt="Sarah"
            class="w-10 h-10 rounded-full object-cover flex-shrink-0" style="box-shadow:0 0 0 2px rgba(108,99,255,0.3)">
    </div>

    <!-- Kalender -->
        <aside class="w-72 bg-white dark:bg-[#1A1A2E] border-l border-gray-200 dark:border-gray-800 overflow-y-auto flex-shrink-0">
            <div class="p-5 space-y-5">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Kalender</h3>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <button @click="prevMonth()" class="hover:text-gray-800 dark:hover:text-white">&lt;</button>
                            <span x-text="monthYear"></span>
                            <button @click="nextMonth()" class="hover:text-gray-800 dark:hover:text-white">&gt;</button>
                        </div>
                    </div>

                    <div class="grid grid-cols-7 gap-1 text-center text-xs mb-2">
                        <div class="text-gray-500 font-medium py-1">Sen</div>
                        <div class="text-gray-500 font-medium py-1">Sel</div>
                        <div class="text-gray-500 font-medium py-1">Rab</div>
                        <div class="text-gray-500 font-medium py-1">Kam</div>
                        <div class="text-gray-500 font-medium py-1">Jum</div>
                        <div class="text-gray-500 font-medium py-1">Sab</div>
                        <div class="text-gray-500 font-medium py-1">Min</div>
                    </div>

                    <div class="grid grid-cols-7 gap-1 text-center text-xs">
                        <template x-for="(day, idx) in calendarDays" :key="idx">
                            <div class="aspect-square flex items-center justify-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer transition"
                                 :class="{
                                    'bg-purple-600 text-white font-semibold': day === today && !isOtherMonth(idx),
                                    'bg-yellow-100 dark:bg-yellow-500/20 text-yellow-700 dark:text-yellow-400 font-medium': day === 22 && !isOtherMonth(idx),
                                    'text-red-600 font-medium': day === 19 && !isOtherMonth(idx),
                                    'bg-green-100 dark:bg-green-500/10 text-green-700 dark:text-green-400': day === 28 && !isOtherMonth(idx),
                                    'text-purple-600 font-medium': day === 25 && !isOtherMonth(idx),
                                    'text-gray-400': isOtherMonth(idx),
                                    'text-gray-800 dark:text-gray-300': !isOtherMonth(idx) && day !== today && day !== 22 && day !== 19 && day !== 28 && day !== 25
                                 }"
                                 x-text="day">
                            </div>
                        </template>
                    </div>

        <div class="mt-3 flex flex-wrap gap-x-3 gap-y-1.5">
            <div class="flex items-center gap-1">
                <div class="w-2 h-2 rounded-full bg-red-500"></div><span
                    class="text-[9px] text-gray-400">Terlambat Evaluasi</span>
            </div>
            <div class="flex items-center gap-1">
                <div class="w-2 h-2 rounded-full bg-yellow-500"></div><span
                    class="text-[9px] text-gray-400">Perlu Penilaian</span>
            </div>
            <div class="flex items-center gap-1">
                <div class="w-2 h-2 rounded-full" style="background:#6C63FF"></div><span
                    class="text-[9px] text-gray-400">Deadline</span>
            </div>
            <div class="flex items-center gap-1">
                <div class="w-2 h-2 rounded-full bg-green-500"></div><span class="text-[9px] text-gray-400">Tugas
                    Baru</span>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terkini -->
    <div>
        <div class="flex items-center justify-between mb-3">
            <h4 class="text-sm font-semibold dark:text-white">Tugas Perlu Dinilai</h4>
            <button class="text-xs text-primary hover:underline">Semua</button>
        </div>
        <div class="space-y-2">
            <div class="rounded-xl p-3 bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20">
                <div class="flex items-start justify-between gap-2 mb-1">
                    <p class="text-xs font-semibold text-red-700 dark:text-red-400 leading-tight">UI/UX
                        Case Study</p>
                    <span
                        class="text-[9px] font-bold bg-red-500 text-white px-1.5 py-0.5 rounded-full flex-shrink-0">15 Peserta</span>
                </div>
                <p class="text-[10px] text-red-500/80 dark:text-red-400/70">UI/UX Design · Melewati Batas</p>
            </div>
            <div
                class="rounded-xl p-3 bg-yellow-50 dark:bg-yellow-500/10 border border-yellow-200 dark:border-yellow-500/20">
                <div class="flex items-start justify-between gap-2 mb-1">
                    <p class="text-xs font-semibold text-yellow-700 dark:text-yellow-400 leading-tight">
                        Analisis Sorting</p>
                    <span
                        class="text-[9px] font-bold bg-yellow-400 text-white px-1.5 py-0.5 rounded-full flex-shrink-0">8 Peserta</span>
                </div>
                <p class="text-[10px] text-yellow-600/70 dark:text-yellow-400/70">DSA · Menunggu Penilaian</p>
            </div>
            <div class="rounded-xl p-3 border"
                style="background:rgba(108,99,255,0.05);border-color:rgba(108,99,255,0.20)">
                <div class="flex items-start justify-between gap-2 mb-1">
                    <p class="text-xs font-semibold text-primary leading-tight">Business Model Canvas</p>
                    <span class="text-[9px] font-bold text-white px-1.5 py-0.5 rounded-full flex-shrink-0"
                        style="background:#6C63FF">32/40 Terkumpul</span>
                </div>
                <p class="text-[10px] text-primary/70">Entrepreneurship · Berlangsung</p>
            </div>
            <div class="rounded-xl p-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                <div class="flex items-start justify-between gap-2 mb-1">
                    <p class="text-xs font-semibold text-gray-400 line-through leading-tight">Wireframe
                        Prototype</p>
                    <span
                        class="text-[9px] font-bold bg-gray-300 dark:bg-white/20 text-gray-600 dark:text-white/60 px-1.5 py-0.5 rounded-full flex-shrink-0">Selesai Dinilai</span>
                </div>
                <p class="text-[10px] text-gray-400">UI/UX Design · 15 Apr</p>
            </div>
        </div>
    </div>

</aside>
