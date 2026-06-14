<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerjakan Kuis - Peserta</title>
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
                <div
                    class="flex items-center gap-3 px-4 py-3 bg-gray-100 dark:bg-[#1A1A2E] border-b border-black/5 dark:border-white/5 flex-shrink-0 transition-all duration-300">
                    <!-- Mobile left toggle -->
                    <button onclick="document.getElementById('leftPanel').classList.toggle('-translate-x-full')"
                        class="md:hidden w-9 h-9 flex items-center justify-center rounded-lg bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <line x1="3" y1="12" x2="21" y2="12" />
                            <line x1="3" y1="18" x2="21" y2="18" />
                        </svg>
                    </button>

                    <!-- Search -->
                    <div
                        class="flex-1 flex items-center gap-2 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 flex-shrink-0"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                        <input type="text" placeholder="Cari course, tugas, materi..."
                            class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                    </div>

                    <!-- Dark mode toggle -->
                    <button @click="toggleDark()"
                        class="w-14 h-8 flex items-center rounded-full p-1 transition-all duration-300"
                        :class="dark ? 'bg-gray-700' : 'bg-gray-300'">

                        <div :class="dark ? 'translate-x-6' : 'translate-x-0'"
                            class="w-6 h-6 bg-white dark:bg-[#1A1A2E] rounded-full shadow-md transform transition-all duration-300 flex items-center justify-center">

                            {{-- Moon Icon --}}
                            <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4 text-gray-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                            </svg>

                            {{-- Sun Icon --}}
                            <svg x-show="dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4 text-yellow-300">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                            </svg>
                        </div>
                    </button>

                    <!-- Mobile right toggle -->
                    <button onclick="document.getElementById('rightPanel').classList.toggle('translate-x-full')"
                        class="lg:hidden w-9 h-9 flex items-center justify-center rounded-lg bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                    </button>
                </div>

                <!-- Scrollable content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    <section>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-semibold dark:text-white">Kerjakan Kuis</h3>
                            <button onclick="history.back()" type="button" class="flex items-center gap-2 px-3 py-1.5 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-[#1A1A2E] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </button>
                        </div>

                        @if(session('success'))
                            <div class="mb-4 p-4 rounded-xl bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-sm text-green-700 dark:text-green-300">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($sesiSelesai)
                            {{-- Already completed: show result --}}
                            <div class="card translate-none rounded-lg p-6 space-y-4">

                                <div class="border-b border-gray-200 dark:border-gray-700">
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                                        {{ $kuis->judul }}
                                    </h2>
                                    @if($kuis->batas_waktu_menit)
                                        <div class="mb-3">
                                            <span class="inline-block px-3 py-1 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 text-xs font-semibold rounded-full">
                                                Durasi: {{ $kuis->batas_waktu_menit }} menit
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="space-y-4">
                                    <div class="p-5 rounded-xl bg-green-50 dark:bg-green-900/10 border border-green-300 dark:border-green-700 text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-sm font-semibold text-green-700 dark:text-green-300 mb-1">Kuis Sudah Dikerjakan</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            Selesai pada {{ $sesiSelesai->diselesaikan_pada?->format('d M Y, H:i') }}
                                        </p>
                                    </div>

                                    @if($sesiSelesai->nilaiKuis)
                                        <div class="p-5 rounded-xl bg-primary/5 dark:bg-primary/10 border border-primary/20 flex items-center justify-between">
                                            <div>
                                                <p class="text-sm font-semibold text-gray-700 dark:text-white">Nilai Kuis</p>
                                                <p class="text-xs text-gray-400">dari {{ $kuis->nilai ?? 100 }} poin</p>
                                            </div>
                                            <p class="text-4xl font-bold text-primary">{{ number_format($sesiSelesai->nilaiKuis->nilai_mentah, 1) }}</p>
                                        </div>
                                    @else
                                        <div class="p-4 rounded-xl bg-yellow-50 dark:bg-yellow-900/10 border border-yellow-200 dark:border-yellow-800 text-sm text-yellow-700 dark:text-yellow-300 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Menunggu penilaian dari instruktur (terdapat soal esai).
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            {{-- Show quiz form --}}
                            <form method="POST" action="{{ route('peserta.kuis.submit', $kuis->id) }}"
                                class="card translate-none rounded-lg p-6 space-y-4">
                                @csrf

                                <!-- Quiz Header -->
                                <div class="border-b border-gray-200 dark:border-gray-700">
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                                        {{ $kuis->judul }}
                                    </h2>
                                    @if($kuis->batas_waktu_menit)
                                        <div class="mb-3">
                                            <span class="inline-block px-3 py-1 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 text-xs font-semibold rounded-full">
                                                Durasi: {{ $kuis->batas_waktu_menit }} menit
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Questions -->
                                <div class="space-y-6">
                                    @foreach ($kuis->pertanyaanKuis as $index => $pertanyaan)
                                        <div class="border-b border-gray-200 dark:border-gray-700 pb-4 last:border-b-0">
                                            <div class="mb-4">
                                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">
                                                    <span class="text-primary">{{ $index + 1 }}.</span>
                                                    {{ $pertanyaan->teks_pertanyaan }}
                                                </h4>
                                            </div>

                                            @if($pertanyaan->tipe_pertanyaan === 'pilihan_ganda')
                                                <div class="space-y-2 ml-4">
                                                    @foreach ($pertanyaan->pilihanJawaban as $pi => $pilihan)
                                                        <label
                                                            class="flex items-center gap-3 cursor-pointer p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:border-primary dark:hover:border-primary/50 transition duration-200">
                                                            <input type="radio" required
                                                                name="pertanyaan_{{ $pertanyaan->id }}"
                                                                value="{{ $pilihan->id }}">
                                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                <strong class="text-primary">{{ chr(65 + $pi) }}</strong>.
                                                                {{ $pilihan->teks_pilihan }}
                                                            </span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            @elseif($pertanyaan->tipe_pertanyaan === 'esai')
                                                <div class="ml-4">
                                                    <input type="text" placeholder="Masukkan jawaban Anda..." required
                                                        name="pertanyaan_{{ $pertanyaan->id }}"
                                                        class="input">
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Submit -->
                                <div class="pt-2 flex gap-2">
                                    <button type="submit"
                                        class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white font-semibold py-2.5 px-4 rounded-lg transition duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Kumpulkan
                                    </button>
                                </div>
                            </form>
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
