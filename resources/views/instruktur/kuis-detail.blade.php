<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kuis - Instruktur</title>
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

    <div class="flex h-screen overflow-hidden">

        <!-- ===== LEFT PANEL ===== -->
        <x-leftPanel />

        <!-- ===== MAIN CONTENT ===== -->
        <div class="flex flex-1 min-w-0 overflow-hidden">

            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">

                <!-- Topbar -->
                <x-topNav />

                <!-- Scrollable content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    <section>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-semibold dark:text-white">Detail Kuis (Instruktur)</h3>
                            <a href="{{ route('instruktur.evaluasi.kuis') }}" class="flex items-center gap-2 px-3 py-1.5 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-[#1A1A2E] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </a>
                        </div>

                        @if(session('success'))
                            <div class="mb-4 p-4 rounded-xl bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-sm text-green-700 dark:text-green-300">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="card translate-none rounded-lg p-6 space-y-4">

                            <!-- Quiz Header -->
                            <div class="border-b border-gray-200 dark:border-gray-700">
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                                    {{ $sesiKuis->kuis->judul }}
                                </h2>
                                <div class="flex flex-wrap gap-3 mb-3">
                                    <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 text-xs font-semibold rounded-full">
                                        Peserta: {{ $sesiKuis->pendaftaran->peserta->pengguna->nama ?? '-' }}
                                    </span>
                                    <span class="inline-block px-3 py-1 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 text-xs font-semibold rounded-full">
                                        Selesai: {{ $sesiKuis->diselesaikan_pada?->format('d M Y, H:i') ?? '-' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Q&A Section -->
                            @php $jawabanMap = $sesiKuis->jawabanKuis->keyBy('id_pertanyaan'); @endphp

                            <div class="space-y-6">
                                @foreach($sesiKuis->kuis->pertanyaanKuis as $index => $pertanyaan)
                                    @php
                                        $jawaban = $jawabanMap->get($pertanyaan->id);
                                        $isBenar = $pertanyaan->tipe_pertanyaan === 'pilihan_ganda' && $jawaban
                                            ? ($jawaban->pilihanJawaban?->adalah_benar ?? false)
                                            : false;
                                    @endphp

                                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4 last:border-b-0">
                                        <div class="mb-3 flex items-start justify-between gap-2">
                                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">
                                                <span class="text-primary">{{ $index + 1 }}.</span>
                                                {{ $pertanyaan->teks_pertanyaan }}
                                            </h4>
                                            @if($pertanyaan->tipe_pertanyaan === 'pilihan_ganda')
                                                <span class="shrink-0 text-xs font-medium px-2 py-0.5 rounded-full {{ $isBenar ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300' : 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400' }}">
                                                    {{ $isBenar ? '✓ Benar' : '✗ Salah' }}
                                                </span>
                                            @else
                                                <span class="shrink-0 text-xs px-2 py-0.5 rounded-full bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300">Esai</span>
                                            @endif
                                        </div>

                                        @if($pertanyaan->tipe_pertanyaan === 'pilihan_ganda')
                                            <div class="space-y-2 ml-4">
                                                @foreach($pertanyaan->pilihanJawaban as $pi => $pilihan)
                                                    <label class="flex items-center gap-3 cursor-default p-3 rounded-lg border
                                                        {{ $pilihan->adalah_benar ? 'border-green-300 dark:border-green-700 bg-green-50 dark:bg-green-900/10' : '' }}
                                                        {{ $jawaban && $jawaban->id_pilihan_jawaban == $pilihan->id && !$pilihan->adalah_benar ? 'border-red-300 dark:border-red-700 bg-red-50 dark:bg-red-900/10' : '' }}
                                                        {{ !$pilihan->adalah_benar && (!$jawaban || $jawaban->id_pilihan_jawaban != $pilihan->id) ? 'border-gray-200 dark:border-gray-700' : '' }}">
                                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                            <strong class="text-primary">{{ chr(65 + $pi) }}</strong>.
                                                            {{ $pilihan->teks_pilihan }}
                                                        </span>
                                                        @if($jawaban && $jawaban->id_pilihan_jawaban == $pilihan->id)
                                                            <span class="text-xs text-gray-400 ml-auto">(jawaban peserta)</span>
                                                        @endif
                                                    </label>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="ml-4 p-3 rounded-lg bg-gray-100 dark:bg-[#1A1A2E] text-sm text-gray-700 dark:text-gray-300">
                                                {{ $jawaban?->teks_jawaban ?? '(tidak menjawab)' }}
                                            </div>
                                            @php $kunci = $pertanyaan->kunciJawabanEsai->first(); @endphp
                                            @if($kunci)
                                                <div class="ml-4 mt-2 p-3 rounded-lg bg-blue-50 dark:bg-blue-900/10 text-xs text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                                    <span class="font-semibold">Kunci:</span> {{ $kunci->teks_kunci }}
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <!-- Nilai Form -->
                            <div class="pt-2 border-t border-gray-200 dark:border-gray-700">
                                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-3 uppercase tracking-wide">Nilai Kuis</p>

                                @if($sesiKuis->nilaiKuis)
                                    <div class="mb-4 p-3 rounded-xl bg-primary/5 dark:bg-primary/10 flex items-center justify-between">
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Nilai saat ini</p>
                                        <p class="text-2xl font-bold text-primary">{{ number_format($sesiKuis->nilaiKuis->nilai_mentah, 1) }}</p>
                                    </div>
                                @endif

                                <div class="flex items-end gap-3">
                                    <form method="POST" action="{{ route('instruktur.evaluasi.kuis.nilai', $sesiKuis->id) }}" class="flex items-end gap-3 flex-1">
                                        @csrf
                                        <div class="flex-1">
                                            <label class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-1 block">Nilai (0–100)</label>
                                            <input type="number" name="nilai" min="0" max="100" step="0.1"
                                                value="{{ old('nilai', $sesiKuis->nilaiKuis?->nilai_mentah) }}"
                                                class="input" required placeholder="mis. 85">
                                            @error('nilai')
                                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white font-semibold py-2.5 px-4 rounded-lg transition duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            {{ $sesiKuis->nilaiKuis ? 'Perbarui' : 'Simpan Nilai' }}
                                        </button>
                                    </form>
                                    <button type="button" class="flex items-center gap-2 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 font-semibold py-2.5 px-4 rounded-lg transition duration-200 hover:bg-gray-50 dark:hover:bg-[#1A1A2E]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        Unduh Rekap Nilai
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>

                </div><!-- end scrollable -->
            </main>

            <!-- ===== RIGHT PANEL ===== -->
            <x-rightPanel />

        </div><!-- end inner flex -->

    </div><!-- end outer flex -->

</body>

</html>
