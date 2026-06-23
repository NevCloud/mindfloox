<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tugas - Instruktur</title>
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
                            <h3 class="text-base font-semibold dark:text-white">Detail Tugas (Instruktur)</h3>
                            <a href="{{ route('instruktur.tugas') }}"
                                class="flex items-center gap-2 px-3 py-1.5 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-[#1A1A2E] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </a>
                        </div>

                        @if (session('success'))
                            <div
                                class="mb-4 p-4 rounded-xl bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-sm text-green-700 dark:text-green-300">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="card translate-none rounded-lg p-6 space-y-4">

                            <!-- Task Header -->
                            <div class="border-b border-gray-200 dark:border-gray-700">
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                                    {{ $jawabanTugas->tugas->judul }}
                                </h2>
                                <div class="flex flex-wrap gap-3 mb-3">
                                    @if ($jawabanTugas->tugas->batas_waktu)
                                        <span
                                            class="inline-block px-3 py-1 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 text-xs font-semibold rounded-full">
                                            Deadline: {{ $jawabanTugas->tugas->batas_waktu->format('d M Y') }}
                                        </span>
                                    @endif
                                    <span
                                        class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 text-xs font-semibold rounded-full">
                                        Peserta: {{ $jawabanTugas->pendaftaran->peserta->pengguna->nama ?? '-' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Upload Time -->
                            <div class="pb-4 border-b border-gray-200 dark:border-gray-700">
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Diunggah pada: {{ $jawabanTugas->disubmit_pada?->format('d M Y, H:i') ?? '-' }}
                                    @if ($jawabanTugas->tugas->batas_waktu && $jawabanTugas->disubmit_pada > $jawabanTugas->tugas->batas_waktu)
                                        <span class="ml-2 text-red-500 font-medium">(Terlambat)</span>
                                    @endif
                                </p>
                            </div>

                            <!-- File Section -->
                            <div class="pb-4 border-b border-gray-200 dark:border-gray-700">
                                <p
                                    class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-3 uppercase tracking-wide">
                                    File Jawaban Peserta</p>
                                @if ($jawabanTugas->url_file)
                                    <a href="{{ asset('storage/' . $jawabanTugas->url_file) }}" target="_blank"
                                        class="group flex items-center gap-3 p-3 rounded-xl hover:bg-primary/10 bg-gray-100 dark:bg-[#1A1A2E] transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="group-hover:text-primary transition-all duration-300 text-gray-700 dark:text-gray-300 shrink-0">
                                            <path
                                                d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z" />
                                            <path d="M14 2v5a1 1 0 0 0 1 1h5" />
                                        </svg>
                                        <span
                                            class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-primary transition">
                                            {{ basename($jawabanTugas->url_file) }}
                                        </span>
                                    </a>
                                @else
                                    <p class="text-sm text-gray-400">Tidak ada file.</p>
                                @endif
                            </div>

                            @if ($jawabanTugas->tugas->deskripsi)
                                <!-- Description Section -->
                                <div class="pb-4 border-b border-gray-200 dark:border-gray-700">
                                    <p
                                        class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-2 uppercase tracking-wide">
                                        Deskripsi Tugas</p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                        {{ $jawabanTugas->tugas->deskripsi }}</p>
                                </div>
                            @endif

                            <!-- Nilai Section -->
                            <div class="pt-2">
                                <p
                                    class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-3 uppercase tracking-wide">
                                    Masukkan Nilai</p>

                                @if ($nilaiTugas)
                                    <div
                                        class="mb-4 p-3 rounded-xl bg-primary/5 dark:bg-primary/10 flex items-center justify-between">
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Nilai saat ini (dinilai
                                            {{ $nilaiTugas->dinilai_pada?->format('d M Y') }})</p>
                                        <p class="text-2xl font-bold text-primary">
                                            {{ number_format($nilaiTugas->nilai_mentah, 1) }}</p>
                                    </div>
                                @endif

                                <form method="POST"
                                    action="{{ route('instruktur.evaluasi.tugas.nilai', $jawabanTugas->id) }}"
                                    class="flex items-end gap-3">
                                    @csrf
                                    <div class="flex-1">
                                        <label
                                            class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-1 block">
                                            Nilai (0–100)
                                        </label>
                                        <input type="number" name="nilai" min="0" max="100"
                                            step="0.1" value="{{ old('nilai', $nilaiTugas?->nilai_mentah) }}"
                                            class="input" required placeholder="mis. 85">
                                        @error('nilai')
                                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit"
                                        class="inline-flex items-center justify-center gap-1.5 bg-primary hover:bg-primary/90 text-white font-semibold py-2.5 px-4 rounded-lg transition duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>{{ $nilaiTugas ? 'Perbarui' : 'Simpan Nilai' }}</span>
                                    </button>
                                </form>
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
