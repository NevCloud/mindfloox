<!--banner super admin-->
@if(request()->is('super-admin/*'))
    <div class="relative overflow-hidden rounded-2xl px-8 py-6 flex items-center justify-between" style="background-color:#6C63FF">
        <div class="z-10 relative">
            <p class="text-white/70 text-xs font-medium mb-1 uppercase tracking-wider">Microcredential Program</p>
            <h2 class="text-2xl font-bold text-white mb-1">Selamat datang, Super Admin! 👋</h2>
            <p class="text-white/80 text-sm mb-5">Anda memiliki akses penuh untuk mengelola seluruh data sistem dan pengguna.</p>
            <div class="flex items-center gap-3">
                <a href="/super-admin/admin-instruktur" class="bg-white font-semibold text-sm px-5 py-2 rounded-lg hover:-translate-y-0.5 transition duration-200" style="color:#6C63FF">
                    Kelola Pengguna
                </a>
                <a href="/super-admin/program-microcredential" class="border border-white/40 text-white font-medium text-sm px-5 py-2 rounded-lg hover:bg-white/10 transition duration-200 inline-block">
                    Kelola Program
                </a>
            </div>
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
@elseif(request()->is('instruktur/*'))

    <div class="relative overflow-hidden rounded-2xl px-8 py-6 flex items-center justify-between" style="background-color:#6C63FF">
        <div class="z-10 relative">
            <p class="text-white/70 text-xs font-medium mb-1 uppercase tracking-wider">Microcredential Program</p>
            <h2 class="text-2xl font-bold text-white mb-1">Selamat datang, Instruktur! 👋</h2>
            @php
                $kiIds = auth()->user()->instruktur ? \App\Models\KursusInstruktur::where('id_instruktur', auth()->user()->instruktur->id)->pluck('id')->toArray() : [];
                $pendingTasks = \App\Models\JawabanTugas::whereHas('tugas', fn($q) => $q->whereIn('id_kursus_instruktur', $kiIds))
                    ->whereDoesntHave('pendaftaran.nilaiTugas', fn($q) => $q->whereColumn('nilai_tugas.id_tugas', 'jawaban_tugas.id_tugas'))
                    ->count();
                $pendingKuis = \App\Models\SesiKuis::whereHas('kuis', fn($q) => $q->whereIn('id_kursus_instruktur', $kiIds))
                    ->where('status', 'selesai')
                    ->whereDoesntHave('nilaiKuis')
                    ->count();
                $totalPending = $pendingTasks + $pendingKuis;
            @endphp
            <p class="text-white/80 text-sm mb-5">Ada <span class="font-semibold text-white">{{ $totalPending }} tugas peserta</span> yang menunggu untuk dinilai.<br>Mari periksa perkembangan mereka!</p>
            <div class="flex items-center gap-3">
                <a href="/instruktur/tugas" class="bg-white font-semibold text-sm px-5 py-2 rounded-lg hover:-translate-y-0.5 transition duration-200" style="color:#6C63FF">
                    Mulai Menilai
                </a>
                <a href="/instruktur/kursus" class="border border-white/40 text-white font-medium text-sm px-5 py-2 rounded-lg hover:bg-white/10 transition duration-200 inline-block">
                    Lanjut Mengajar
                </a>
            </div>
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
            <p class="text-white/80 text-sm mb-5">Mari lanjutkan progres belajarmu hari ini!<br>Periksa kursus dan tugasmu agar tidak ada yang terlewat.</p>
            <div class="flex items-center gap-3">
                <a href="{{ url('/peserta/tugas') }}" class="bg-white font-semibold text-sm px-5 py-2 rounded-lg hover:-translate-y-0.5 transition duration-200 inline-block" style="color:#6C63FF">
                    Lihat Tugas
                </a>
                <a href="{{ url('/peserta/kursus') }}" class="border border-white/40 text-white font-medium text-sm px-5 py-2 rounded-lg hover:bg-white/10 transition duration-200 inline-block">
                    Lanjut Belajar
                </a>
            </div>
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
            <h2 class="text-2xl font-bold text-white mb-1">Selamat datang, Admin! 👋</h2>
            <p class="text-white/80 text-sm mb-5">Anda memiliki akses untuk mengelola data program dan pengguna sistem.</p>
            <div class="flex items-center gap-3">
                <a href="/admin/verifikasi" class="bg-white font-semibold text-sm px-5 py-2 rounded-lg hover:-translate-y-0.5 transition duration-200" style="color:#6C63FF">
                    Cek Verifikasi
                </a>
                <a href="/admin/program" class="border border-white/40 text-white font-medium text-sm px-5 py-2 rounded-lg hover:bg-white/10 transition duration-200 inline-block">
                    Kelola Kursus
                </a>
            </div>
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
