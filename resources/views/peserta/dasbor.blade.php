<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Peserta</title>
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
}" x-init="document.documentElement.classList.toggle('dark', dark)" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <!-- Alpine.js -->

    <div class="flex h-screen overflow-hidden">

        <!-- ===== LEFT PANEL ===== -->
        <x-leftPanel />

        <!-- ===== MAIN CONTENT ===== -->
        <div class="flex flex-1 min-w-0 overflow-hidden">

            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">

                <!-- Top Nav -->
                <x-topNav />

                <!-- Scrollable content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    <!-- Welcome Banner -->
                    <x-banner />

                    <!-- Stat Cards -->
                    <x-stats />




                    <!-- Course Saya -->
                    <section>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-semibold dark:text-white">Kursus Saya</h3>
                            <a href="{{ url('/peserta/kursus') }}"
                                class="flex items-center gap-1 px-3 py-1.5 text-xs text-[#6C63FF] hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg transition font-medium">
                                Lihat Semua
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        @php
                            $peserta = Auth::user()->peserta;
                            $kursus = collect();
                            if ($peserta) {
                                $pendaftaran = $peserta
                                    ->pendaftaran()
                                    ->where('status', 'diterima')
                                    ->with(['programMicrocredential.kursus.instruktur.pengguna'])
                                    ->get();

                                $kursus = $pendaftaran
                                    ->flatMap(fn($p) => $p->programMicrocredential->kursus)
                                    ->unique('id')
                                    ->values();
                            }
                        @endphp

                        @if ($kursus->isEmpty())
                            <div class="text-center py-10 text-gray-400 dark:text-gray-500">
                                <p class="text-sm font-medium">Belum ada kursus</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($kursus as $k)
                                    @php
                                        // Week-based Progress Calculation
                                        $pendaftaranItem = \App\Models\Pendaftaran::where('id_peserta', $peserta->id)
                                            ->where('id_program_microcredential', $k->id_program_microcredential)
                                            ->first();

                                        $allWeeks = \App\Models\Minggu::where('id_kursus', $k->id)->get();
                                        $totalVisibleWeeks = $allWeeks->count();
                                        $completedWeeks = 0;

                                        if ($pendaftaranItem && $totalVisibleWeeks > 0) {
                                            $dilihatIds = \App\Models\MateriDilihat::where('id_pendaftaran', $pendaftaranItem->id)
                                                ->pluck('id_materi_pembelajaran')->flip()->toArray();
                                            $submittedTugasIds = \App\Models\JawabanTugas::where('id_pendaftaran', $pendaftaranItem->id)
                                                ->where('status', 'final')
                                                ->pluck('id_tugas')->flip()->toArray();
                                            $completedKuisIds = \App\Models\SesiKuis::where('id_pendaftaran', $pendaftaranItem->id)
                                                ->where('status', 'selesai')
                                                ->pluck('id_kuis')->flip()->toArray();

                                            foreach ($allWeeks as $week) {
                                                $materiIds = \App\Models\MateriPembelajaran::where('id_kursus', $k->id)
                                                    ->where('id_minggu', $week->id)->pluck('id')->toArray();
                                                $tugasIds = \App\Models\Tugas::where('id_kursus', $k->id)
                                                    ->where('id_minggu', $week->id)->pluck('id')->toArray();
                                                $kuisIds = \App\Models\Kuis::where('id_kursus', $k->id)
                                                    ->where('id_minggu', $week->id)->pluck('id')->toArray();

                                                $totalItems = count($materiIds) + count($tugasIds) + count($kuisIds);
                                                if ($totalItems === 0) continue;

                                                $allMateriViewed = empty($materiIds) || empty(array_diff($materiIds, array_keys($dilihatIds)));
                                                $allTugasDone = empty($tugasIds) || empty(array_diff($tugasIds, array_keys($submittedTugasIds)));
                                                $allKuisDone = empty($kuisIds) || empty(array_diff($kuisIds, array_keys($completedKuisIds)));

                                                if ($allMateriViewed && $allTugasDone && $allKuisDone) {
                                                    $completedWeeks++;
                                                }
                                            }
                                        }

                                        $progress = $totalVisibleWeeks > 0 ? round(($completedWeeks / $totalVisibleWeeks) * 100) : 0;

                                        $statusText =
                                            $progress === 100 && $totalVisibleWeeks > 0
                                                ? 'Selesai'
                                                : ($progress > 50
                                                    ? 'Hampir selesai'
                                                    : ($progress > 0
                                                        ? 'Berjalan'
                                                        : 'Baru mulai'));

                                        $colors = ['#2196f3', '#9c27b0', '#ff9800', '#f44336', '#4caf50', '#00bcd4'];
                                        $color = $colors[$loop->index % count($colors)];
                                        $bgRgba =
                                            'rgba(' .
                                            implode(',', sscanf(substr($color, 1), '%02x%02x%02x')) .
                                            ',0.15)';

                                        $imgSrc = $k->foto_kursus 
                                            ? (str_starts_with($k->foto_kursus, 'http') ? $k->foto_kursus : asset('storage/' . $k->foto_kursus))
                                            : ($k->programMicrocredential && $k->programMicrocredential->foto_program 
                                                ? (str_starts_with($k->programMicrocredential->foto_program, 'http') ? $k->programMicrocredential->foto_program : asset('storage/' . $k->programMicrocredential->foto_program)) 
                                                : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=400');

                                        $instrukturName =
                                            $k->instruktur && $k->instruktur->isNotEmpty()
                                                ? $k->instruktur->first()->pengguna->nama
                                                : 'Instruktur tidak diketahui';
                                    @endphp
                                    <div class="card p-0 overflow-hidden flex flex-row border rounded-xl transition">
                                        <div class="flex-1 p-4">
                                            <div class="flex items-stretch gap-3">
                                                <div class="w-36 h-24 flex-shrink-0 rounded-xl overflow-hidden"
                                                    style="background:{{ $bgRgba }}">
                                                    <img src="{{ $imgSrc }}" class="w-full h-full object-cover"
                                                        alt="icon">
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between gap-2 mb-0.5">
                                                        <h4 class="text-sm font-semibold dark:text-white truncate">
                                                            {{ $k->nama }}</h4>
                                                        <span class="text-xs font-bold flex-shrink-0"
                                                            style="color:{{ $color }}">{{ $progress }}%</span>
                                                    </div>
                                                    <p class="text-[11px] text-gray-400 mb-2">Instruktur:
                                                        {{ $instrukturName }}</p>
                                                    <div
                                                        class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-1.5 mb-2">
                                                        <div class="h-1.5 rounded-full"
                                                            style="width:{{ $progress }}%;background:{{ $color }}">
                                                        </div>
                                                    </div>
                                                    @if($totalVisibleWeeks > 0)
                                                    <div
                                                        class="flex items-center justify-between text-[10px] text-gray-400">
                                                        <span>{{ $completedWeeks }}/{{ $totalVisibleWeeks }} Minggu
                                                            Selesai</span>
                                                        @if($statusText !== 'Baru mulai')
                                                        <span class="text-gray-400">{{ $statusText }}</span>
                                                        @endif
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </section>

                </div><!-- end scrollable -->
            </main>

            <!-- ===== RIGHT PANEL ===== -->
            <x-rightPanel />

        </div><!-- end inner flex -->

    </div><!-- end outer flex -->

</body>

</html>
