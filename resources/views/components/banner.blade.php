<!--banner super admin-->
@if(request()->is('super-admin/*'))
    <div class="relative overflow-hidden rounded-2xl px-8 py-6 flex items-center justify-between" style="background-color:#6C63FF">
        <div class="z-10 relative">
            <p class="text-white/70 text-xs font-medium mb-1 uppercase tracking-wider">Microcredential Program</p>
            <h2 class="text-2xl font-bold text-white mb-1">Selamat datang, Super Admin! 👋</h2>
            <p class="text-white/80 text-sm mb-5">Ada <span class="font-semibold text-white">15 course</span> yang menunggu untuk dinilai.<br>Mari periksa perkembangan mereka!</p>
            <div class="flex items-center gap-3">
                <a href="/super-admin/tambah-course" class="bg-white font-semibold text-sm px-5 py-2 rounded-lg hover:-translate-y-0.5 transition duration-200" style="color:#6C63FF">
                    Buat Course
                </a>
            </div>
        </div>
        <!-- Progress ring untuk peserta -->
        <div class="relative z-10 hidden md:flex flex-col items-center gap-2">
            <div class="relative w-24 h-24">
                <svg class="w-24 h-24 -rotate-90" viewBox="0 0 96 96">
                    <circle cx="48" cy="48" r="38" stroke="rgba(255,255,255,0.2)" stroke-width="8" fill="none" />
                    <circle cx="48" cy="48" r="38" stroke="white" stroke-width="8" fill="none" stroke-dasharray="238.76" stroke-dashoffset="71.6" stroke-linecap="round" />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-xl font-bold text-white">70%</span>
                </div>
            </div>
            <p class="text-white/80 text-xs font-medium">Progress Overall</p>
        </div>
        <!-- Decorative -->
        <div class="absolute right-0 top-0 h-full flex items-center pr-48 opacity-10 pointer-events-none">
            <svg width="180" height="160" viewBox="0 0 180 160" fill="none">
                <circle cx="140" cy="80" r="80" stroke="white" stroke-width="2" />
                <circle cx="140" cy="80" r="55" stroke="white" stroke-width="2" />
                <circle cx="140" cy="80" r="28" fill="white" />
            </svg>
        </div>
    </div>

<!--banner instruktur-->
@elseif(request()->is('instructor/*'))

    <div class="relative overflow-hidden rounded-2xl px-8 py-6 flex items-center justify-between" style="background-color:#6C63FF">
        <div class="z-10 relative">
            <p class="text-white/70 text-xs font-medium mb-1 uppercase tracking-wider">Microcredential Program</p>
            <h2 class="text-2xl font-bold text-white mb-1">Selamat datang, Instruktur! 👋</h2>
            <p class="text-white/80 text-sm mb-5">Ada <span class="font-semibold text-white">15 tugas peserta</span> yang menunggu untuk dinilai.<br>Mari periksa perkembangan mereka!</p>
            <div class="flex items-center gap-3">
                <a href="/instructor/tugas" class="bg-white font-semibold text-sm px-5 py-2 rounded-lg hover:-translate-y-0.5 transition duration-200" style="color:#6C63FF">
                    Mulai Menilai
                </a>
                <a href="/instructor/courses" class="border border-white/40 text-white font-medium text-sm px-5 py-2 rounded-lg hover:bg-white/10 transition duration-200 inline-block">
                    Upload Materi
                </a>
            </div>
        </div>
        <!-- Progress ring (Tugas Dinilai) -->
        <div class="relative z-10 hidden md:flex flex-col items-center gap-2">
            <div class="relative w-24 h-24">
                <svg class="w-24 h-24 -rotate-90" viewBox="0 0 96 96">
                    <circle cx="48" cy="48" r="38" stroke="rgba(255,255,255,0.2)" stroke-width="8" fill="none" />
                    <circle cx="48" cy="48" r="38" stroke="white" stroke-width="8" fill="none" stroke-dasharray="238.76" stroke-dashoffset="143.25" stroke-linecap="round" />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-xl font-bold text-white">40%</span>
                </div>
            </div>
            <p class="text-white/80 text-xs font-medium">Tugas Dinilai</p>
        </div>
        <!-- Decorative -->
        <div class="absolute right-0 top-0 h-full flex items-center pr-48 opacity-10 pointer-events-none">
            <svg width="180" height="160" viewBox="0 0 180 160" fill="none">
                <circle cx="140" cy="80" r="80" stroke="white" stroke-width="2" />
                <circle cx="140" cy="80" r="55" stroke="white" stroke-width="2" />
                <circle cx="140" cy="80" r="28" fill="white" />
            </svg>
        </div>
    </div>


<!--banner peserta-->
@elseif(request()->is('peserta/*'))
    <div class="relative overflow-hidden rounded-2xl px-8 py-6 flex items-center justify-between" style="background-color:#6C63FF">
        <div class="z-10 relative">
            <p class="text-white/70 text-xs font-medium mb-1 uppercase tracking-wider">Microcredential Program</p>
            <h2 class="text-2xl font-bold text-white mb-1">Selamat datang, Peserta! 👋</h2>
            <p class="text-white/80 text-sm mb-5">Kamu memiliki <span class="font-semibold text-white">3 tugas</span> yang mendekati deadline.<br>Yuk selesaikan sebelum terlambat!</p>
            <div class="flex items-center gap-3">
                <button class="bg-white font-semibold text-sm px-5 py-2 rounded-lg hover:-translate-y-0.5 transition duration-200" style="color:#6C63FF">
                    Lihat Tugas
                </button>
                <button class="border border-white/40 text-white font-medium text-sm px-5 py-2 rounded-lg hover:bg-white/10 transition duration-200">
                    Lanjut Belajar
                </button>
            </div>
        </div>
        <!-- Progress ring untuk peserta -->
        <div class="relative z-10 hidden md:flex flex-col items-center gap-2">
            <div class="relative w-24 h-24">
                <svg class="w-24 h-24 -rotate-90" viewBox="0 0 96 96">
                    <circle cx="48" cy="48" r="38" stroke="rgba(255,255,255,0.2)" stroke-width="8" fill="none" />
                    <circle cx="48" cy="48" r="38" stroke="white" stroke-width="8" fill="none" stroke-dasharray="238.76" stroke-dashoffset="71.6" stroke-linecap="round" />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-xl font-bold text-white">70%</span>
                </div>
            </div>
            <p class="text-white/80 text-xs font-medium">Progress Overall</p>
        </div>
        <!-- Decorative -->
        <div class="absolute right-0 top-0 h-full flex items-center pr-48 opacity-10 pointer-events-none">
            <svg width="180" height="160" viewBox="0 0 180 160" fill="none">
                <circle cx="140" cy="80" r="80" stroke="white" stroke-width="2" />
                <circle cx="140" cy="80" r="55" stroke="white" stroke-width="2" />
                <circle cx="140" cy="80" r="28" fill="white" />
            </svg>
        </div>
    </div>
<!--banner admin-->
@elseif(request()->is('admin/*'))
    <div class="relative overflow-hidden rounded-2xl px-8 py-6 flex items-center justify-between" style="background-color:#6C63FF">
        <div class="z-10 relative">
            <p class="text-white/70 text-xs font-medium mb-1 uppercase tracking-wider">Microcredential Program</p>
            <h2 class="text-2xl font-bold text-white mb-1">Selamat datang, ADMIN! 👋</h2>
            <p class="text-white/80 text-sm mb-5">Selamat bekerja dan mengelola sistem dengan baik hari ini.</p>
        </div>
        <!-- Decorative -->
        <div class="absolute right-0 top-0 h-full flex items-center pr-48 opacity-10 pointer-events-none">
            <svg width="180" height="160" viewBox="0 0 180 160" fill="none">
                <circle cx="140" cy="80" r="80" stroke="white" stroke-width="2" />
                <circle cx="140" cy="80" r="55" stroke="white" stroke-width="2" />
                <circle cx="140" cy="80" r="28" fill="white" />
            </svg>
        </div>
    </div>
@else
    <!-- Tampilkan sesuatu yang default atau kosongkan jika tidak ada stats khusus -->
@endif
