{{-- ============================================================
    Instruktur — Evaluasi Kuis
============================================================ --}}
<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Evaluasi Kuis - Instruktur</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body x-data="dashboardApp()" x-init="initApp()" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <x-leftPanel />

        <!-- MAIN CONTENT -->
        <main class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Nav -->
            <x-topNav />

            <!-- SCROLLABLE CONTENT -->
            <div class="flex-1 overflow-y-auto">
                <div class="p-5 space-y-5">

    <x-banner />

    <div class="flex items-center justify-between mb-4">
        <h3 class="text-base font-semibold dark:text-white">Evaluasi Kuis</h3>
    </div>

    @if($sesiList->isEmpty())
        <div class="text-center py-16 text-gray-400 dark:text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm">Belum ada pengerjaan kuis.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

            @foreach ($sesiList as $sesi)
                @php
                    if ($sesi->nilaiKuis) {
                        $uiBorder = 'border-green-200 dark:border-green-800/50';
                        $uiBadge  = 'bg-green-100 dark:bg-green-900/40 text-green-600 dark:text-green-300';
                        $uiDot    = 'bg-green-500';
                        $label    = 'Dinilai';
                        $uiText   = 'text-green-500 dark:text-green-400';
                        $uiButton = 'bg-primary hover:bg-primary/90 text-white';
                    } else {
                        $uiBorder = 'border-orange-200 dark:border-orange-800/50';
                        $uiBadge  = 'bg-orange-100 dark:bg-orange-900/40 text-orange-600 dark:text-orange-300';
                        $uiDot    = 'bg-orange-500';
                        $label    = 'Perlu Dinilai';
                        $uiText   = 'text-orange-500 dark:text-orange-400';
                        $uiButton = 'bg-orange-500 hover:bg-orange-600 text-white';
                    }
                @endphp

                <div onclick="window.location='{{ route('instruktur.evaluasi.kuis.detail', $sesi->id) }}'"
                    class="card p-4 cursor-pointer {{ $uiBorder }}">

                    <div class="flex items-start justify-between mb-2">
                        <span class="inline-flex items-center gap-1 text-[10px] font-semibold px-2 py-0.5 rounded-full {{ $uiBadge }}">
                            <span class="w-1.5 h-1.5 rounded-full animate-pulse inline-block {{ $uiDot }}"></span>
                            {{ $label }}
                        </span>
                        <span class="text-[10px] text-gray-400">{{ $sesi->diselesaikan_pada?->diffForHumans() ?? '-' }}</span>
                    </div>

                    <h4 class="text-sm font-semibold dark:text-white mb-1 leading-tight">
                        {{ $sesi->kuis->judul }}
                    </h4>

                    <p class="text-[11px] text-gray-400 mb-1">{{ $sesi->kuis->kursus->nama }}</p>
                    <p class="text-[11px] text-gray-500 dark:text-gray-400 mb-3">
                        {{ $sesi->pendaftaran->peserta->pengguna->nama ?? '-' }}
                    </p>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5 text-[11px] font-medium {{ $uiText }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            @if($sesi->nilaiKuis)
                                Nilai: {{ number_format($sesi->nilaiKuis->nilai_mentah, 1) }}
                            @else
                                Belum dinilai
                            @endif
                        </div>

                        <a href="{{ route('instruktur.evaluasi.kuis.detail', $sesi->id) }}"
                            onclick="event.stopPropagation()"
                            class="flex items-center gap-1.5 text-xs px-3 py-1 rounded-lg transition {{ $uiButton }}">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            Detail
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="mt-4">{{ $sesiList->links() }}</div>
    @endif

                </div>
            </div>

        </main>

        <!--right panel-->
        <x-rightPanel />

    </div>

    <script>
        function dashboardApp() {
            return {
                dark: localStorage.getItem('theme') === 'dark',
                toggleDark() {
                    this.dark = !this.dark;
                    localStorage.setItem('theme', this.dark ? 'dark' : 'light');
                    document.documentElement.classList.toggle('dark', this.dark);
                },
                initApp() {
                    document.documentElement.classList.toggle('dark', this.dark);
                }
            }
        }
    </script>

</body>

</html>
