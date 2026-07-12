<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Saya - Peserta</title>
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

<body x-data="{ dark: localStorage.getItem('theme') === 'dark', toggleDark() { this.dark = !this.dark;
        localStorage.setItem('theme', this.dark ? 'dark' : 'light');
        document.documentElement.classList.toggle('dark', this.dark); } }" x-init="document.documentElement.classList.toggle('dark', dark)" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">
        <x-leftPanel />

        <div class="flex flex-1 min-w-0 overflow-hidden">
            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">
                <x-topNav />

                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    <section x-data="{ page: 1, perPage: 9, total: {{ $tugasList->count() }} }">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-semibold dark:text-white">Tugas Saya</h3>
                            <span class="text-xs text-gray-400">{{ $tugasList->count() }} tugas</span>
                        </div>

                        @if ($tugasList->isEmpty())
                            <div class="text-center py-16 text-gray-400 dark:text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <p class="text-sm">Belum ada tugas.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                @foreach ($tugasList as $index => $t)
                                    @php
                                        if ($t['nilai'] !== null) {
                                            $uiBorder = 'border-green-200 dark:border-green-800/50';
                                            $uiBadge =
                                                'bg-green-100 dark:bg-green-900/40 text-green-600 dark:text-green-300';
                                            $uiDot = 'bg-green-500';
                                            $label = 'Dinilai';
                                            $uiText = 'text-green-500 dark:text-green-400';
                                            $uiButton = 'bg-primary hover:opacity-90 text-white';
                                        } elseif ($t['dikumpulkan']) {
                                            $uiBorder = 'border-blue-200 dark:border-blue-800/50';
                                            $uiBadge =
                                                'bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-300';
                                            $uiDot = 'bg-blue-500';
                                            $label = 'Dikumpulkan';
                                            $uiText = 'text-blue-500 dark:text-blue-400';
                                            $uiButton = 'bg-gray-400 hover:bg-gray-500 text-white';
                                        } elseif ($t['batas_waktu'] && $t['batas_waktu']->isPast()) {
                                            $uiBorder = 'border-red-200 dark:border-red-800/50';
                                            $uiBadge = 'bg-red-100 dark:bg-red-900/40 text-red-600 dark:text-red-300';
                                            $uiDot = 'bg-red-500';
                                            $label = 'Terlambat';
                                            $uiText = 'text-red-500 dark:text-red-400';
                                            $uiButton = 'bg-red-500 hover:bg-red-600 text-white';
                                        } elseif (
                                            $t['batas_waktu'] &&
                                            now()->diffInDays($t['batas_waktu'], false) <= 3
                                        ) {
                                            $uiBorder = 'border-yellow-200 dark:border-yellow-800/50';
                                            $uiBadge =
                                                'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-600 dark:text-yellow-300';
                                            $uiDot = 'bg-yellow-500';
                                            $label = 'Segera';
                                            $uiText = 'text-yellow-500 dark:text-yellow-400';
                                            $uiButton = 'bg-yellow-500 hover:bg-yellow-600 text-white';
                                        } else {
                                            $uiBorder = 'border-gray-200 dark:border-gray-700';
                                            $uiBadge = 'bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400';
                                            $uiDot = 'bg-gray-400';
                                            $label = 'Belum';
                                            $uiText = 'text-gray-400';
                                            $uiButton = 'bg-purple-500 hover:bg-purple-600 text-white';
                                        }
                                    @endphp

                                    <div x-show="page === Math.ceil({{ $loop->iteration }} / perPage)" x-cloak
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 transform translate-y-2"
                                        x-transition:enter-end="opacity-100 transform translate-y-0"
                                        onclick="window.location='{{ $t['url'] }}'"
                                        class="card p-4 cursor-pointer {{ $uiBorder }}">

                                        <div class="flex items-start justify-between mb-2">
                                            <span
                                                class="inline-flex items-center gap-1 text-[10px] font-semibold px-2 py-0.5 rounded-full {{ $uiBadge }}">
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full animate-pulse inline-block {{ $uiDot }}"></span>
                                                {{ $label }}
                                            </span>
                                            <span class="text-[10px] text-gray-400">
                                                {{ $t['batas_waktu'] ? $t['batas_waktu']->diffForHumans() : '—' }}
                                            </span>
                                        </div>

                                        <h4 class="text-sm font-semibold dark:text-white mb-1 leading-tight">
                                            {{ $t['judul'] }}</h4>
                                        <p class="text-[11px] text-gray-400 mb-3">{{ $t['kursus'] }}</p>

                                        <div class="flex items-center justify-between">
                                            <div
                                                class="flex items-center gap-1.5 text-[11px] font-medium {{ $uiText }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <polyline points="12 6 12 12 16 14" />
                                                </svg>
                                                {{ $t['batas_waktu'] ? $t['batas_waktu']->format('d M Y') : 'Tanpa deadline' }}
                                            </div>

                                            <a href="{{ $t['url'] }}" onclick="event.stopPropagation()"
                                                class="inline-flex items-center justify-center gap-1.5 text-xs px-3 py-1 rounded-lg transition {{ $uiButton }}">
                                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                                </svg>
                                                <span>{{ $t['btn_label'] }}</span>
                                            </a>
                                        </div>

                                    </div>
                                @endforeach
                            </div>

                            <!-- Controls -->
                            <div class="flex items-center justify-between mt-6" x-show="total > perPage" x-cloak>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Halaman <span x-text="page"
                                        class="font-bold text-gray-700 dark:text-gray-200"></span>
                                    dari <span x-text="Math.ceil(total / perPage)"
                                        class="font-bold text-gray-700 dark:text-gray-200"></span>
                                </p>

                                <div class="flex items-center gap-2">
                                    <button @click="if(page > 1) page--"
                                        :class="{ 'opacity-50 cursor-not-allowed': page === 1 }"
                                        class="flex items-center justify-center w-8 h-8 rounded-full bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-[#22223a] transition shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 19.5 8.25 12l7.5-7.5" />
                                        </svg>
                                    </button>
                                    <button @click="if(page < Math.ceil(total / perPage)) page++"
                                        :class="{ 'opacity-50 cursor-not-allowed': page === Math.ceil(total / perPage) }"
                                        class="flex items-center justify-center w-8 h-8 rounded-full bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-[#22223a] transition shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </button>
                                </div>
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
