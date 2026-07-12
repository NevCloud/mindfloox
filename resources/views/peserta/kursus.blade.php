<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus Saya - Peserta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body x-data="{ dark: localStorage.getItem('theme') === 'dark', toggleDark() { this.dark = !this.dark; localStorage.setItem('theme', this.dark ? 'dark' : 'light'); document.documentElement.classList.toggle('dark', this.dark); } }"
    x-init="document.documentElement.classList.toggle('dark', dark)"
    class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">
        <x-leftPanel />

        <div class="flex flex-1 min-w-0 overflow-hidden">
            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">
                <x-topNav />

                <div class="flex-1 overflow-y-auto p-5 space-y-5">


                    <section>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-semibold dark:text-white">Kursus Saya</h3>
                            <span class="text-sm text-gray-400">{{ $kursus->count() }} kursus</span>
                        </div>

                        @if($kursus->isEmpty())
                            <div class="text-center py-16 text-gray-400 dark:text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                                <p class="font-medium">Belum ada kursus</p>
                                <p class="text-xs mt-1">Daftarkan diri ke program microcredential untuk mengakses kursus.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($kursus as $k)
                                    @php
                                        $colors   = ['#2196f3','#9c27b0','#ff9800','#f44336','#4caf50','#00bcd4'];
                                        $color    = $colors[$loop->index % count($colors)];
                                        $bgRgba   = 'rgba(' . implode(',', sscanf(substr($color,1), '%02x%02x%02x')) . ',0.15)';
                                        $btnMap   = ['#2196f3'=>'bg-blue-500 hover:bg-blue-600','#9c27b0'=>'bg-purple-500 hover:bg-purple-600','#ff9800'=>'bg-orange-500 hover:bg-orange-600','#f44336'=>'bg-red-500 hover:bg-red-600','#4caf50'=>'bg-green-500 hover:bg-green-600','#00bcd4'=>'bg-cyan-500 hover:bg-cyan-600'];
                                        $btnClass = $btnMap[$color] ?? 'bg-blue-500 hover:bg-blue-600';
                                        $imgSrc = $k->foto_kursus
                                            ? (str_starts_with($k->foto_kursus, 'http') ? $k->foto_kursus : asset('storage/' . $k->foto_kursus))
                                            : ($k->programMicrocredential && $k->programMicrocredential->foto_program
                                                ? (str_starts_with($k->programMicrocredential->foto_program, 'http') ? $k->programMicrocredential->foto_program : asset('storage/' . $k->programMicrocredential->foto_program))
                                                : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=400');

                                        // Calculate Progress
                                        $pendaftaranItem = \App\Models\Pendaftaran::where('id_peserta', $peserta->id)
                                            ->where('id_program_microcredential', $k->id_program_microcredential)
                                            ->first();

                                        $allWeeks = \App\Models\Minggu::where('id_kursus', $k->id)->get();
                                        $totalVisibleWeeks = $allWeeks->count();
                                        $completedWeeks = 0;

                                        if ($pendaftaranItem && $totalVisibleWeeks > 0) {
                                            $dilihatIds = \App\Models\MateriDilihat::where('id_pendaftaran', $pendaftaranItem->id)
                                                ->pluck('id_materi_pembelajaran')->flip()->toArray();
                                            $gradedTugasIds = \App\Models\NilaiTugas::where('id_pendaftaran', $pendaftaranItem->id)
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
                                                $allTugasDone = empty($tugasIds) || empty(array_diff($tugasIds, array_keys($gradedTugasIds)));
                                                $allKuisDone = empty($kuisIds) || empty(array_diff($kuisIds, array_keys($completedKuisIds)));

                                                if ($allMateriViewed && $allTugasDone && $allKuisDone) {
                                                    $completedWeeks++;
                                                }
                                            }
                                        }

                                        $progress = $totalVisibleWeeks > 0 ? round(($completedWeeks / $totalVisibleWeeks) * 100) : 0;
                                    @endphp
                                    <a href="{{ route('peserta.kursus.show', $k->id) }}"
                                        class="card p-0 overflow-hidden flex flex-row cursor-pointer hover:shadow-md transition">
                                        <div class="flex-1 p-4">
                                            <div class="flex items-stretch gap-3">
                                                <div class="w-36 h-24 flex-shrink-0 rounded-xl overflow-hidden" style="background:{{ $bgRgba }}">
                                                    <img src="{{ $imgSrc }}" class="w-full h-full object-cover" alt="{{ $k->nama }}">
                                                </div>
                                                <div class="flex-1 min-w-0 flex flex-col">
                                                    <div class="flex items-center justify-between gap-2">
                                                        <h4 class="text-sm font-semibold dark:text-white truncate">{{ $k->nama }}</h4>
                                                        <span class="text-sm font-bold flex-shrink-0" style="color:{{ $color }}">{{ $progress }}%</span>
                                                    </div>
                                                    <p class="text-[11px] text-gray-400 mt-1 mb-auto line-clamp-2">{{ $k->deskripsi }}</p>
                                                    <div class="mt-3">
                                                        <button class="inline-flex items-center gap-2 px-3 py-1.5 {{ $btnClass }} text-white text-xs font-semibold rounded-lg transition">
                                                            Pelajari
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </section>
                </div>
            </main>

            <x-rightPanel />
        </div>
    </div>

</body>
</html>
