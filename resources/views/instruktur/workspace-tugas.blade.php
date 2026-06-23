<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workspace Penilaian Tugas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-[#0F0F1A]">
<div class="min-h-screen text-gray-900 dark:text-white flex flex-col font-sans">
    {{-- Navbar / Header --}}
    <header class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-[#1A1A2E]">
        <div class="flex items-center gap-3">
            <a href="{{ route('instruktur.tugas') }}" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">
                Tugas
            </a>
            <span class="text-gray-400 dark:text-gray-600">/</span>
            <span class="font-medium text-gray-900 dark:text-white">{{ $tugas->judul }}</span>
        </div>
        <div class="flex items-center gap-4">
            <div class="px-3 py-1.5 bg-[#6C63FF]/10 dark:bg-[#6C63FF]/20 text-[#6C63FF] rounded-full text-sm font-medium">
                Workspace Penilaian
            </div>
            <a href="{{ route('instruktur.tugas') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-white text-sm font-medium rounded-lg transition border border-gray-200 dark:border-gray-700">
                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Tutup Workspace
            </a>
        </div>
    </header>

    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
        class="fixed top-20 right-6 z-50 px-4 py-3 rounded-lg shadow-lg bg-green-500/20 border border-green-500/50 text-green-300 flex items-center gap-3">
        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="flex flex-1 overflow-hidden">
        {{-- Sidebar Peserta --}}
        <aside class="w-80 border-r border-gray-200 dark:border-gray-800 bg-white dark:bg-[#1A1A2E] flex flex-col">
            <div class="p-4 border-b border-gray-200 dark:border-gray-800 space-y-3">
                <div class="relative">
                    <input type="text" placeholder="Cari nama peserta..." 
                        class="w-full bg-gray-50 dark:bg-[#0B0B14] border border-gray-200 dark:border-gray-700 rounded-lg py-2 pl-3 pr-10 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:border-[#6C63FF]">
                    <svg class="w-4 h-4 text-gray-400 dark:text-gray-500 absolute right-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto">
                @foreach($pendaftaranList as $pendaftaran)
                    @php
                        $jt = $pendaftaran->jawabanTugas->first();
                        $nt = $pendaftaran->nilaiTugas->first();
                        
                        $statusClass = 'text-gray-500';
                        $statusText = 'Belum Mengumpulkan';
                        $indicatorClass = 'bg-gray-600';
                        
                        if ($jt) {
                            if ($nt) {
                                $statusClass = 'text-green-400';
                                $statusText = '✓ ' . number_format($nt->nilai_mentah, 0) . '/100';
                                $indicatorClass = 'bg-green-500';
                            } else {
                                $statusClass = 'text-orange-400';
                                $statusText = 'Perlu Dinilai';
                                $indicatorClass = 'bg-orange-500';
                            }
                        }
                        
                        $isSelected = request('pendaftaran_id') == $pendaftaran->id;
                    @endphp

                    <a href="{{ route('instruktur.evaluasi.tugas.workspace', ['tugas' => $tugas->id, 'pendaftaran_id' => $pendaftaran->id]) }}" 
                        class="flex items-center gap-3 p-4 border-b border-gray-100 dark:border-gray-800/50 hover:bg-gray-50 dark:hover:bg-[#1A1A2E] transition relative {{ $isSelected ? 'bg-gray-50 dark:bg-[#1A1A2E]' : '' }}">
                        
                        @if($isSelected)
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#6C63FF]"></div>
                        @endif

                        <div class="w-10 h-10 rounded-full bg-gray-700 flex-shrink-0 flex items-center justify-center overflow-hidden">
                            @if($pendaftaran->peserta->pengguna->foto_profil)
                                <img src="{{ asset('storage/' . $pendaftaran->peserta->pengguna->foto_profil) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-sm font-medium text-gray-300">
                                    {{ mb_strtoupper(mb_substr($pendaftaran->peserta->pengguna->nama, 0, 2)) }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-200 truncate">{{ $pendaftaran->peserta->pengguna->nama }}</h4>
                            @if($jt)
                                <p class="text-[11px] text-gray-500 truncate mt-0.5">Dikumpulkan: {{ $jt->disubmit_pada->format('d M Y, H:i') }}</p>
                            @else
                                <p class="text-[11px] text-gray-500 truncate mt-0.5">-</p>
                            @endif
                            <p class="text-xs font-medium {{ $statusClass }} mt-1">{{ $statusText }}</p>
                        </div>

                        <div class="w-2 h-2 rounded-full {{ $indicatorClass }}"></div>
                    </a>
                @endforeach
            </div>
            
            @if($pendaftaranList->hasPages())
            <div class="p-3 border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-[#1A1A2E]">
                {{ $pendaftaranList->appends(request()->query())->links('pagination::simple-tailwind') }}
            </div>
            @endif
        </aside>

        {{-- Main Panel --}}
        <main class="flex-1 overflow-y-auto p-8 bg-gray-50 dark:bg-[#0F0F1A]">
            @if($selectedPendaftaran)
                <div class="max-w-4xl mx-auto space-y-6">
                    {{-- Header Peserta --}}
                    <div class="bg-white dark:bg-[#1A1A2E] rounded-xl border border-gray-200 dark:border-gray-800 p-6 flex items-start justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full bg-gray-700 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                @if($selectedPendaftaran->peserta->pengguna->foto_profil)
                                    <img src="{{ asset('storage/' . $selectedPendaftaran->peserta->pengguna->foto_profil) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-lg font-medium text-gray-300">
                                        {{ mb_strtoupper(mb_substr($selectedPendaftaran->peserta->pengguna->nama, 0, 2)) }}
                                    </span>
                                @endif
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $selectedPendaftaran->peserta->pengguna->nama }}</h2>
                                @if($jawabanTugas)
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Dikumpulkan pada: {{ $jawabanTugas->disubmit_pada->format('d F Y, H:i T') }}</p>
                                @else
                                    <p class="text-sm text-gray-500 mt-1">Belum mengumpulkan tugas</p>
                                @endif
                            </div>
                        </div>

                        @if($jawabanTugas)
                            @php
                                $isLate = $tugas->batas_waktu && $jawabanTugas->disubmit_pada->gt($tugas->batas_waktu);
                            @endphp
                            @if($isLate)
                                <span class="px-3 py-1 rounded-full bg-red-500/10 text-red-400 border border-red-500/20 text-xs font-medium">Terlambat</span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-green-500/10 text-green-400 border border-green-500/20 text-xs font-medium">Tepat Waktu</span>
                            @endif
                        @endif
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        {{-- Kolom Kiri: Instruksi & File --}}
                        <div class="lg:col-span-2 space-y-6">
                            {{-- Instruksi --}}
                            <div class="bg-white dark:bg-[#1A1A2E] rounded-xl border border-gray-200 dark:border-gray-800 p-6">
                                <h3 class="text-xs font-bold text-[#6C63FF] uppercase tracking-wider mb-3">Instruksi Tugas</h3>
                                <div class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed prose dark:prose-invert max-w-none">
                                    {{ $tugas->deskripsi ?: 'Tidak ada deskripsi/instruksi tambahan.' }}
                                </div>
                            </div>

                            {{-- File Terlampir --}}
                            @if($jawabanTugas)
                                <div class="bg-white dark:bg-[#1A1A2E] rounded-xl border border-gray-200 dark:border-gray-800 p-6">
                                    <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">File Terlampir</h3>
                                    
                                    @if($jawabanTugas->url_file)
                                        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-[#0B0B14] border border-gray-200 dark:border-gray-700 rounded-lg hover:border-gray-300 dark:hover:border-gray-600 transition">
                                            <div class="flex items-center gap-4 min-w-0">
                                                <div class="w-10 h-10 rounded bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-500 flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ basename($jawabanTugas->url_file) }}</p>
                                                    <p class="text-xs text-gray-500">File Tugas</p>
                                                </div>
                                            </div>
                                            <a href="{{ asset('storage/' . $jawabanTugas->url_file) }}" target="_blank" download
                                                class="p-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-300 transition" title="Download">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                            </a>
                                        </div>
                                    @else
                                        <p class="text-sm text-gray-500">Peserta ini tidak melampirkan file.</p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        {{-- Kolom Kanan: Panel Penilaian --}}
                        <div class="lg:col-span-1">
                            @if($jawabanTugas)
                                <div class="bg-white dark:bg-[#1A1A2E] rounded-xl border border-gray-200 dark:border-gray-800 p-6 sticky top-8">
                                    <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-6">Panel Penilaian</h3>

                                    <form action="{{ route('instruktur.evaluasi.tugas.workspace.nilai', ['tugas' => $tugas->id, 'pendaftaran' => $selectedPendaftaran->id]) }}" method="POST">
                                        @csrf
                                        
                                        <div class="mb-6">
                                            <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Nilai Akhir (0-100) <span class="text-red-500">*</span></label>
                                            <div class="flex items-center gap-3">
                                                <input type="number" name="nilai" required min="0" max="100" step="0.01"
                                                    value="{{ $nilaiTugas ? (float) $nilaiTugas->nilai_mentah : '' }}"
                                                    class="w-24 px-4 py-3 bg-gray-50 dark:bg-[#0B0B14] border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white font-medium text-lg focus:outline-none focus:border-[#6C63FF] focus:ring-1 focus:ring-[#6C63FF]">
                                                <span class="text-gray-500 font-medium">/ 100</span>
                                            </div>
                                        </div>

                                        <button type="submit" class="w-full py-3 bg-[#6C63FF] hover:bg-[#5a52d5] text-white font-medium rounded-lg transition shadow-lg shadow-[#6C63FF]/20">
                                            Simpan
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="bg-white dark:bg-[#1A1A2E] rounded-xl border border-gray-200 dark:border-gray-800 p-6 flex flex-col items-center justify-center text-center h-48">
                                    <div class="w-12 h-12 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-400 dark:text-gray-500 mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Peserta belum mengumpulkan tugas, belum dapat dinilai.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="h-full flex flex-col items-center justify-center text-center">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-gray-800/50 rounded-full flex items-center justify-center mb-6 border border-gray-200 dark:border-gray-800">
                        <svg class="w-10 h-10 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/></svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Pilih Peserta</h2>
                    <p class="text-gray-500 dark:text-gray-400 max-w-sm">Pilih peserta dari daftar di sebelah kiri untuk melihat detail tugas dan memberikan nilai.</p>
                </div>
            @endif
        </main>
    </div>
</div>
</body>
</html>
