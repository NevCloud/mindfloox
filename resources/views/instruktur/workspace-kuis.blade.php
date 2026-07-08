<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workspace Penilaian Kuis</title>
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

<body class="bg-gray-50 dark:bg-[#0F0F1A]">
    <x-toast />
    <div class="min-h-screen text-gray-900 dark:text-white flex flex-col font-sans">
        {{-- Navbar / Header --}}
        <header
            class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-[#1A1A2E]">
            <div class="flex items-center gap-3">
                <a href="{{ route('instruktur.evaluasi.kuis') }}"
                    class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">
                    Kuis
                </a>
                <span class="text-gray-400 dark:text-gray-600">/</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $kuis->judul }}</span>
            </div>
            <div class="flex items-center gap-4">
                <div
                    class="px-3 py-1.5 bg-[#6C63FF]/10 dark:bg-[#6C63FF]/20 text-[#6C63FF] rounded-full text-sm font-medium">
                    Workspace Penilaian
                </div>
                <a href="{{ route('instruktur.evaluasi.kuis') }}"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-white text-sm font-medium rounded-lg transition border border-gray-200 dark:border-gray-700">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Tutup Workspace
                </a>
            </div>
        </header>



        <div class="flex flex-1 overflow-hidden">
            {{-- Sidebar Peserta --}}
            <aside class="w-80 border-r border-gray-200 dark:border-gray-800 bg-white dark:bg-[#1A1A2E] flex flex-col">
                <div class="p-4 border-b border-gray-200 dark:border-gray-800 space-y-3">
                    <div class="relative">
                        <input type="text" placeholder="Cari nama peserta..."
                            class="w-full bg-gray-50 dark:bg-[#0B0B14] border border-gray-200 dark:border-gray-700 rounded-lg py-2 pl-3 pr-10 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-[#6C63FF]">
                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500 absolute right-3 top-2.5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto">
                    @foreach ($pendaftaranList as $pendaftaran)
                        @php
                            $sk = $pendaftaran->sesiKuis->first();
                            $nk = $sk ? $sk->nilaiKuis : null;

                            $statusClass = 'text-gray-500';
                            $statusText = 'Belum Mengerjakan';
                            $indicatorClass = 'bg-gray-600';

                            if ($sk) {
                                if ($nk) {
                                    $statusClass = 'text-green-400';
                                    $statusText = '✓ ' . number_format($nk->nilai_mentah, 0) . '/100';
                                    $indicatorClass = 'bg-green-500';
                                } else {
                                    $statusClass = 'text-orange-400';
                                    $statusText = 'Perlu Dinilai';
                                    $indicatorClass = 'bg-orange-500';
                                }
                            }

                            $isSelected = request('pendaftaran_id') == $pendaftaran->id;
                        @endphp

                        <a href="{{ route('instruktur.evaluasi.kuis.workspace', ['kuis' => $kuis->id, 'pendaftaran_id' => $pendaftaran->id]) }}"
                            class="flex items-center gap-3 p-4 border-b border-gray-100 dark:border-gray-800/50 hover:bg-gray-50 dark:hover:bg-[#1A1A2E] transition relative {{ $isSelected ? 'bg-gray-50 dark:bg-[#1A1A2E]' : '' }}">

                            @if ($isSelected)
                                <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#6C63FF]"></div>
                            @endif

                            <div
                                class="w-10 h-10 rounded-full bg-gray-700 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                @if ($pendaftaran->peserta->pengguna->foto_profil)
                                    <img src="{{ asset('storage/' . $pendaftaran->peserta->pengguna->foto_profil) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <span class="text-sm font-medium text-gray-300">
                                        {{ mb_strtoupper(mb_substr($pendaftaran->peserta->pengguna->nama, 0, 2)) }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-gray-200 truncate">
                                    {{ $pendaftaran->peserta->pengguna->nama }}</h4>
                                @if ($sk && $sk->diselesaikan_pada)
                                    <p class="text-[11px] text-gray-500 truncate mt-0.5">Selesai:
                                        {{ $sk->diselesaikan_pada->format('d M Y, H:i') }}</p>
                                @else
                                    <p class="text-[11px] text-gray-500 truncate mt-0.5">-</p>
                                @endif
                                <p class="text-xs font-medium {{ $statusClass }} mt-1">{{ $statusText }}</p>
                            </div>

                            <div class="w-2 h-2 rounded-full {{ $indicatorClass }}"></div>
                        </a>
                    @endforeach
                </div>

                @if ($pendaftaranList->hasPages())
                    <div class="p-3 border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-[#1A1A2E]">
                        {{ $pendaftaranList->appends(request()->query())->links('pagination::simple-tailwind') }}
                    </div>
                @endif
            </aside>

            {{-- Main Panel --}}
            <main class="flex-1 overflow-y-auto p-8 bg-gray-50 dark:bg-[#0F0F1A]">
                @if ($selectedPendaftaran)
                    <div class="max-w-4xl mx-auto space-y-6">
                        {{-- Header Peserta --}}
                        <div
                            class="bg-white dark:bg-[#1A1A2E] rounded-xl border border-gray-200 dark:border-gray-800 p-6 flex items-start justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 rounded-full bg-gray-700 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                    @if ($selectedPendaftaran->peserta->pengguna->foto_profil)
                                        <img src="{{ asset('storage/' . $selectedPendaftaran->peserta->pengguna->foto_profil) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <span class="text-lg font-medium text-gray-300">
                                            {{ mb_strtoupper(mb_substr($selectedPendaftaran->peserta->pengguna->nama, 0, 2)) }}
                                        </span>
                                    @endif
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                                        {{ $selectedPendaftaran->peserta->pengguna->nama }}</h2>
                                    @if ($sesiKuis && $sesiKuis->diselesaikan_pada)
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Diselesaikan pada:
                                            {{ $sesiKuis->diselesaikan_pada->format('d F Y, H:i T') }}</p>
                                    @else
                                        <p class="text-sm text-gray-500 mt-1">Belum menyelesaikan kuis</p>
                                    @endif
                                </div>
                            </div>

                            @if ($sesiKuis)
                                @php
                                    $isLate =
                                        $kuis->batas_waktu &&
                                        $sesiKuis->diselesaikan_pada &&
                                        $sesiKuis->diselesaikan_pada->gt($kuis->batas_waktu);
                                @endphp
                                @if ($isLate)
                                    <span
                                        class="px-3 py-1 rounded-full bg-red-500/10 text-red-400 border border-red-500/20 text-xs font-medium">Terlambat</span>
                                @else
                                    <span
                                        class="px-3 py-1 rounded-full bg-green-500/10 text-green-400 border border-green-500/20 text-xs font-medium">Tepat
                                        Waktu</span>
                                @endif
                            @endif
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            {{-- Kolom Kiri: Q&A Section --}}
                            <div class="lg:col-span-2 space-y-6">
                                @if ($sesiKuis)
                                    <div
                                        class="bg-white dark:bg-[#1A1A2E] rounded-xl border border-gray-200 dark:border-gray-800 p-6">
                                        <h3
                                            class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-6">
                                            Jawaban Peserta</h3>

                                        @php $jawabanMap = $sesiKuis->jawabanKuis->keyBy('id_pertanyaan'); @endphp

                                        <div class="space-y-6">
                                            @foreach ($kuis->pertanyaanKuis as $index => $pertanyaan)
                                                @php
                                                    $jawaban = $jawabanMap->get($pertanyaan->id);
                                                    $isBenar =
                                                        $pertanyaan->tipe_pertanyaan === 'pilihan_ganda' && $jawaban
                                                            ? $jawaban->pilihanJawaban?->adalah_benar ?? false
                                                            : false;
                                                @endphp

                                                <div
                                                    class="border-b border-gray-200 dark:border-gray-800 pb-6 last:border-b-0 last:pb-0">
                                                    <div class="mb-3 flex items-start justify-between gap-2">
                                                        <h4
                                                            class="text-sm font-semibold text-gray-900 dark:text-gray-200">
                                                            <span class="text-[#6C63FF]">{{ $index + 1 }}.</span>
                                                            {{ $pertanyaan->teks_pertanyaan }}
                                                        </h4>
                                                        @if ($pertanyaan->tipe_pertanyaan === 'pilihan_ganda')
                                                            <span
                                                                class="shrink-0 text-xs font-medium px-2 py-0.5 rounded-full {{ $isBenar ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                                                                {{ $isBenar ? '✓ Benar' : '✗ Salah' }}
                                                            </span>
                                                        @else
                                                            <span
                                                                class="shrink-0 text-xs px-2 py-0.5 rounded-full bg-orange-500/10 text-orange-400 border border-orange-500/20">Esai</span>
                                                        @endif
                                                    </div>

                                                    @if ($pertanyaan->tipe_pertanyaan === 'pilihan_ganda')
                                                        <div class="space-y-2 ml-4">
                                                            @foreach ($pertanyaan->pilihanJawaban as $pi => $pilihan)
                                                                <div
                                                                    class="flex items-center gap-3 cursor-default p-3 rounded-lg border text-sm
                                                                {{ $pilihan->adalah_benar ? 'border-green-300 dark:border-green-500/50 bg-green-50 dark:bg-green-500/10' : '' }}
                                                                {{ $jawaban && $jawaban->id_pilihan_jawaban == $pilihan->id && !$pilihan->adalah_benar ? 'border-red-300 dark:border-red-500/50 bg-red-50 dark:bg-red-500/10' : '' }}
                                                                {{ !$pilihan->adalah_benar && (!$jawaban || $jawaban->id_pilihan_jawaban != $pilihan->id) ? 'border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-[#0B0B14]' : '' }}">
                                                                    <span class="text-gray-700 dark:text-gray-300">
                                                                        <strong
                                                                            class="text-[#6C63FF]">{{ chr(65 + $pi) }}</strong>.
                                                                        {{ $pilihan->teks_pilihan }}
                                                                    </span>
                                                                    @if ($jawaban && $jawaban->id_pilihan_jawaban == $pilihan->id)
                                                                        <span
                                                                            class="text-xs text-gray-500 ml-auto">(jawaban
                                                                            peserta)</span>
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div
                                                            class="ml-4 p-3 rounded-lg bg-gray-50 dark:bg-[#0B0B14] border border-gray-200 dark:border-gray-800 text-sm text-gray-700 dark:text-gray-300">
                                                            {{ $jawaban?->teks_jawaban ?? '(tidak menjawab)' }}
                                                        </div>
                                                        @php $kunci = $pertanyaan->kunciJawabanEsai->first(); @endphp
                                                        @if ($kunci)
                                                            <div
                                                                class="ml-4 mt-2 p-3 rounded-lg bg-blue-500/10 border border-blue-500/20 text-xs text-blue-300">
                                                                <span class="font-semibold text-blue-400">Kunci:</span>
                                                                {{ $kunci->teks_kunci }}
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Kolom Kanan: Panel Penilaian --}}
                            <div class="lg:col-span-1">
                                @if ($sesiKuis)
                                    <div
                                        class="bg-white dark:bg-[#1A1A2E] rounded-xl border border-gray-200 dark:border-gray-800 p-6 sticky top-8">
                                        <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-6">Panel Penilaian
                                        </h3>

                                        <div>
                                            @csrf

                                            <div class="mb-6">
                                                <label
                                                    class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Nilai
                                                    Akhir (0-100) <span class="text-red-500">*</span></label>
                                                <div class="flex items-center gap-2">
                                                    <span class="text-2xl font-bold text-gray-900 dark:text-white">
                                                        {{ $sesiKuis->nilaiKuis ? round($sesiKuis->nilaiKuis->nilai_mentah) : '-' }}
                                                    </span>
                                                    <span class="text-gray-500 font-medium text-xl">/ 100</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="bg-white dark:bg-[#1A1A2E] rounded-xl border border-gray-200 dark:border-gray-800 p-6 flex flex-col items-center justify-center text-center h-48">
                                        <div
                                            class="w-12 h-12 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-400 dark:text-gray-500 mb-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Peserta belum mengerjakan
                                            kuis ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="h-full flex flex-col items-center justify-center text-center">
                        <div
                            class="w-20 h-20 bg-gray-100 dark:bg-gray-800/50 rounded-full flex items-center justify-center mb-6 border border-gray-200 dark:border-gray-800">
                            <svg class="w-10 h-10 text-gray-400 dark:text-gray-600" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Pilih Peserta</h2>
                        <p class="text-gray-500 dark:text-gray-400 max-w-sm">Pilih peserta dari daftar di sebelah kiri
                            untuk melihat detail kuis dan memberikan nilai.</p>
                    </div>
                @endif
            </main>
        </div>
    </div>
</body>

</html>
