<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $kursus->nama }} - Peserta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .week-card { transition: all 0.3s ease; }
        .week-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .dark .week-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.3); }
        .materi-card { transition: all 0.2s ease; }
    </style>
</head>

<body x-data="dashboardApp()" x-init="initApp()" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">
        <x-leftPanel />

        <div class="flex flex-1 min-w-0 overflow-hidden">
            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">
                <x-topNav />

                <div class="flex-1 overflow-y-auto">
                    <div class="p-5 space-y-5">

                        {{-- Header --}}
                        <div class="flex items-center justify-between flex-wrap gap-3">
                            <div>
                                <a href="{{ route('peserta.kursus') }}" class="text-xs text-gray-400 hover:text-primary flex items-center gap-1 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                                    Kursus Saya
                                </a>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Materi Kursus</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $kursus->nama }}</p>
                            </div>
                        </div>

                        {{-- Week List --}}
                        <section class="space-y-3" x-data="courseApp()">


                            <template x-if="weeks.length === 0">
                                <div class="text-center py-16 text-gray-400 dark:text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <p class="font-medium">Belum ada materi</p>
                                    <p class="text-xs mt-1">Instruktur belum mengunggah materi untuk kursus ini.</p>
                                </div>
                            </template>

                            <template x-for="(week, weekIdx) in weeks" :key="week.id">
                                <div class="week-card rounded-2xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700">

                                    {{-- Week Header --}}
                                    <div class="w-full flex items-center justify-between px-5 py-4 bg-white dark:bg-[#1A1A2E] border-b border-gray-200 dark:border-gray-700">
                                        <div @click="toggleWeek(week)" class="flex items-center gap-4 flex-1 min-w-0 cursor-pointer">
                                            {{-- Week number badge --}}
                                            <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm shrink-0 bg-primary/10 text-primary"
                                                x-text="week.nomor"></div>

                                            <div class="text-left min-w-0 flex-1">
                                                <div class="flex items-center gap-2 flex-wrap">
                                                    <h4 class="font-semibold text-gray-900 dark:text-white text-sm">
                                                        <span x-text="'Minggu ' + week.nomor + (week.judul ? ': ' + week.judul : '')"></span>
                                                    </h4>
                                                </div>
                                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5"
                                                    x-text="week.deskripsi || ('Materi minggu ke-' + week.nomor)"></p>
                                            </div>
                                        </div>

                                        {{-- Expand/Collapse --}}
                                        <button @click.stop="toggleWeek(week)" class="w-9 h-9 flex items-center justify-center">
                                            <svg :class="week.open ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        </button>
                                    </div>

                                    {{-- Week Content (expanded) --}}
                                    <div x-show="week.open" x-transition.duration.300ms
                                        class="border-t border-gray-200 dark:border-gray-700 p-5 space-y-0 bg-gray-50/50 dark:bg-[#14142B]/50">

                                        <template x-if="week.items.length === 0">
                                            <div class="text-center py-8">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <p class="text-sm text-gray-400 dark:text-gray-500 font-medium">Belum ada konten di minggu ini</p>
                                            </div>
                                        </template>

                                        <template x-for="(item, index) in week.items" :key="item.id + '_' + item.tipe">
                                            <div>
                                                {{-- Materi Card --}}
                                                <div class="materi-card p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#1A1A2E] hover:shadow-md flex items-stretch gap-3 mb-0">

                                                    {{-- Type icon --}}
                                                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                                                        :class="typeStyle(item.tipe_materi).bg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" :class="typeStyle(item.tipe_materi).text"
                                                            :fill="item.tipe_materi === 'video' ? 'currentColor' : 'none'"
                                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" :d="typeStyle(item.tipe_materi).icon" />
                                                        </svg>
                                                    </div>

                                                    {{-- Content --}}
                                                    <div class="flex-1 min-w-0">
                                                        <h5 class="font-semibold text-gray-900 dark:text-white text-sm" x-text="item.judul"></h5>
                                                        <div class="flex flex-wrap gap-3 mt-1.5 text-xs text-gray-500 dark:text-gray-400">
                                                            <span class="capitalize px-2 py-0.5 rounded-full"
                                                                :class="typeStyle(item.tipe_materi).pillBg"
                                                                x-text="item.tipe_materi"></span>
                                                            <template x-if="item.meta1">
                                                                <span class="flex items-center gap-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                                    <span x-text="item.meta1"></span>
                                                                </span>
                                                            </template>
                                                        </div>
                                                    </div>

                                                    {{-- Actions --}}
                                                    <div class="flex items-center gap-2 shrink-0">

                                                        {{-- Dokumen: Buka --}}
                                                        <template x-if="item.tipe_materi === 'dokumen' && item.url_file">
                                                            <div class="flex items-center gap-2">
                                                                <a :href="item.url_file" target="_blank" @click="markViewed(item)"
                                                                    class="inline-flex items-center gap-1.5 h-8 px-3 rounded-lg bg-primary/10 text-primary hover:bg-primary hover:text-white transition-all duration-200 text-xs font-medium">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                                                    Buka
                                                                </a>
                                                                <template x-if="item.dilihat">
                                                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-[10px] font-medium">
                                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                                        Dibaca
                                                                    </span>
                                                                </template>
                                                            </div>
                                                        </template>

                                                        {{-- Video: Tonton --}}
                                                        <template x-if="item.tipe_materi === 'video' && item.url_file">
                                                            <div class="flex items-center gap-2">
                                                                <a :href="item.url_file" target="_blank" @click="markViewed(item)"
                                                                    class="inline-flex items-center gap-1.5 h-8 px-3 rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200 text-xs font-medium">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                                                    Tonton
                                                                </a>
                                                                <template x-if="item.dilihat">
                                                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-[10px] font-medium">
                                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                                        Ditonton
                                                                    </span>
                                                                </template>
                                                            </div>
                                                        </template>

                                                        {{-- Tautan: Buka --}}
                                                        <template x-if="item.tipe_materi === 'tautan' && item.url_file">
                                                            <div class="flex items-center gap-2">
                                                                <a :href="item.url_file" target="_blank" @click="markViewed(item)"
                                                                    class="inline-flex items-center gap-1.5 h-8 px-3 rounded-lg bg-cyan-100 dark:bg-cyan-500/10 text-cyan-500 hover:bg-cyan-500 hover:text-white transition-all duration-200 text-xs font-medium">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                                                    Buka
                                                                </a>
                                                                <template x-if="item.dilihat">
                                                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-[10px] font-medium">
                                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                                        Dibuka
                                                                    </span>
                                                                </template>
                                                            </div>
                                                        </template>

                                                        {{-- Tugas --}}
                                                        <template x-if="item.tipe_materi === 'tugas'">
                                                            <div class="flex items-center gap-2">
                                                                <a :href="item.tugas_url"
                                                                    :class="item.dikumpulkan
                                                                        ? 'bg-green-100 dark:bg-green-500/10 text-green-600 hover:bg-green-500 hover:text-white'
                                                                        : 'bg-purple-100 dark:bg-purple-500/10 text-purple-500 hover:bg-purple-500 hover:text-white'"
                                                                    class="inline-flex items-center gap-1.5 h-8 px-3 rounded-lg transition-all duration-200 text-xs font-medium">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                                                    <span x-text="item.dikumpulkan ? 'Kumpulkan Ulang' : 'Kumpulkan'"></span>
                                                                </a>
                                                                <template x-if="item.dikumpulkan">
                                                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-[10px] font-medium">
                                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                                        Dikumpulkan
                                                                    </span>
                                                                </template>
                                                            </div>
                                                        </template>

                                                        {{-- Kuis --}}
                                                        <template x-if="item.tipe_materi === 'kuis'">
                                                            <div class="flex items-center gap-2">
                                                                <a :href="`{{ url('peserta/kuis') }}/${item.dbId}`"
                                                                    :class="item.selesai
                                                                        ? 'bg-green-100 dark:bg-green-500/10 text-green-600 hover:bg-green-500 hover:text-white'
                                                                        : 'bg-amber-100 dark:bg-amber-500/10 text-amber-600 hover:bg-amber-500 hover:text-white'"
                                                                    class="inline-flex items-center gap-1.5 h-8 px-3 rounded-lg transition-all duration-200 text-xs font-medium">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                                    <span x-text="item.selesai ? 'Lihat Kuis' : 'Kerjakan'"></span>
                                                                    <span x-show="item.durasi && !item.selesai" class="text-[10px] opacity-70" x-text="'(' + item.durasi + 'm)'"></span>
                                                                </a>
                                                                <template x-if="item.selesai">
                                                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-[10px] font-medium">
                                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                                        Selesai
                                                                    </span>
                                                                </template>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>

                                                {{-- Spacing between cards --}}
                                                <div class="h-3"></div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>

                            {{-- Summary footer --}}
                            <div class="text-center py-4">
                                <p class="text-xs text-gray-400 dark:text-gray-500">
                                    Total <span class="font-semibold" x-text="weeks.length"></span> minggu aktif
                                    · <span class="font-semibold" x-text="totalItems()"></span> konten
                                </p>
                            </div>

                        </section>

                    </div>
                </div>
            </main>

            <x-rightPanel />
        </div>
    </div>

    <script>
        const _serverWeeks  = @json($weeksJs);
        const _kursusId     = {{ $kursus->id }};
        const _csrfToken    = document.querySelector('meta[name="csrf-token"]').content;

        function courseApp() {
            return {
                weeks: [],

                init() {
                    let openedWeeks = [];
                    try {
                        const stored = localStorage.getItem('peserta_kursus_opened_weeks_' + _kursusId);
                        if (stored) openedWeeks = JSON.parse(stored);
                    } catch (e) {}

                    this.weeks = _serverWeeks.map(w => ({
                        ...w,
                        open: openedWeeks.includes(w.id)
                    }));
                },

                toggleWeek(week) {
                    week.open = !week.open;
                    const opened = this.weeks.filter(w => w.open).map(w => w.id);
                    localStorage.setItem('peserta_kursus_opened_weeks_' + _kursusId, JSON.stringify(opened));
                },

                totalItems() {
                    return this.weeks.reduce((sum, w) => sum + w.items.length, 0);
                },

                markViewed(item) {
                    if (!item.dbId || item.tipe_materi === 'tugas' || item.tipe_materi === 'kuis') return;
                    fetch(`/peserta/kursus/${_kursusId}/materi/${item.dbId}/viewed`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': _csrfToken,
                            'Accept': 'application/json',
                        },
                    }).then(r => {
                        if (r.ok) {
                            item.dilihat = true;
                        }
                    }).catch(() => {});
                },

                typeStyle(type) {
                    const map = {
                        dokumen: {
                            bg: 'bg-red-100 dark:bg-red-900/20',
                            text: 'text-red-600',
                            icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                            pillBg: 'bg-red-50 dark:bg-red-900/10 text-red-500',
                        },
                        video: {
                            bg: 'bg-blue-100 dark:bg-blue-900/20',
                            text: 'text-blue-600',
                            icon: 'M8 5v14l11-7z',
                            pillBg: 'bg-blue-50 dark:bg-blue-900/10 text-blue-500',
                        },
                        tautan: {
                            bg: 'bg-cyan-100 dark:bg-cyan-900/20',
                            text: 'text-cyan-600',
                            icon: 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1',
                            pillBg: 'bg-cyan-50 dark:bg-cyan-900/10 text-cyan-500',
                        },
                        kuis: {
                            bg: 'bg-amber-100 dark:bg-amber-900/20',
                            text: 'text-amber-600',
                            icon: 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                            pillBg: 'bg-amber-50 dark:bg-amber-900/10 text-amber-500',
                        },
                        tugas: {
                            bg: 'bg-purple-100 dark:bg-purple-900/20',
                            text: 'text-purple-600',
                            icon: 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                            pillBg: 'bg-purple-50 dark:bg-purple-900/10 text-purple-500',
                        },
                    };
                    return map[type] || map.dokumen;
                }
            };
        }

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
            };
        }
    </script>

</body>
</html>
