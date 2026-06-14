<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kursus->nama }} - Peserta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
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
}" x-init="document.documentElement.classList.toggle('dark', dark)"
    class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">
        <x-leftPanel />

        <div class="flex flex-1 min-w-0 overflow-hidden">
            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">
                <x-topNav />

                <div class="flex-1 overflow-y-auto p-5 space-y-5"
                    x-data="courseApp()"
                    x-init="init()">

                    {{-- Header --}}
                    <section>
                        <div class="flex items-center justify-between">
                            <div>
                                <a href="{{ route('peserta.kursus') }}"
                                    class="text-xs text-gray-400 hover:text-primary flex items-center gap-1 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                    Kursus Saya
                                </a>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $kursus->nama }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $kursus->deskripsi }}</p>
                            </div>
                        </div>
                    </section>

                    {{-- Materi per Minggu --}}
                    <section class="space-y-4">
                        <h4 class="text-base font-semibold dark:text-white">Materi Pembelajaran</h4>

                        <template x-if="weeks.length === 0">
                            <div class="text-center py-12 text-gray-400 dark:text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-sm">Belum ada materi yang diunggah.</p>
                            </div>
                        </template>

                        <template x-for="week in weeks" :key="week.id">
                            <div class="bg-white dark:bg-gray-900 rounded-2xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700">

                                <button @click="week.open = !week.open"
                                    class="w-full flex items-center justify-between px-5 py-4 bg-white dark:bg-[#1A1A2E] hover:bg-gray-50 dark:hover:bg-[#252541] transition">
                                    <div class="flex items-center gap-4">
                                        <div class="px-3 py-1.5 rounded-xl bg-primary/10 text-primary font-bold text-sm whitespace-nowrap"
                                            x-text="'Minggu ' + week.nomor"></div>
                                        <div class="text-left">
                                            <p class="text-xs text-gray-400" x-text="week.items.length + ' item'"></p>
                                        </div>
                                    </div>
                                    <svg :class="week.open ? 'rotate-180' : ''"
                                        class="w-5 h-5 text-gray-500 transition duration-300"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div x-show="week.open" x-transition
                                    class="border-t border-gray-200 dark:border-gray-700 p-5 space-y-4">

                                    <template x-for="item in week.items" :key="item.id">
                                        <div class="relative p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-[#1A1A2E] hover:shadow-md transition">
                                            <div class="flex items-start gap-4">

                                                {{-- Icon --}}
                                                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                                                    :class="iconClass(item.tipe)">
                                                    <template x-if="item.tipe === 'dokumen'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </template>
                                                    <template x-if="item.tipe === 'video' || item.tipe === 'tautan'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M8 5v14l11-7z" />
                                                        </svg>
                                                    </template>
                                                    <template x-if="item.tipe === 'kuis'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </template>
                                                </div>

                                                {{-- Info --}}
                                                <div class="flex-1">
                                                    <h5 class="font-semibold text-gray-900 dark:text-white" x-text="item.judul"></h5>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5" x-text="item.deskripsi"></p>

                                                    <div class="mt-3 flex flex-wrap gap-2">

                                                        {{-- Dokumen: download --}}
                                                        <template x-if="item.tipe === 'dokumen' && item.url_file">
                                                            <a :href="item.url_file" target="_blank"
                                                                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white text-sm hover:opacity-90 transition">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                                Download File
                                                            </a>
                                                        </template>

                                                        {{-- Video/Tautan: buka link --}}
                                                        <template x-if="(item.tipe === 'video' || item.tipe === 'tautan') && item.url_file">
                                                            <a :href="item.url_file" target="_blank"
                                                                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white text-sm hover:opacity-90 transition">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                Tonton Video
                                                            </a>
                                                        </template>

                                                        {{-- Kuis --}}
                                                        <template x-if="item.tipe === 'kuis'">
                                                            <div class="flex items-center gap-2 flex-wrap">
                                                                <a :href="`{{ url('peserta/kuis') }}/${item.dbId}`"
                                                                    :class="item.selesai ? 'bg-gray-400 hover:bg-gray-500' : 'bg-orange-500 hover:bg-orange-600'"
                                                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-white text-sm transition">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                                    <span x-text="item.selesai ? 'Lihat Kuis' : 'Kerjakan Kuis'"></span>
                                                                    <span x-show="item.durasi && !item.selesai" class="text-xs opacity-80" x-text="'(' + item.durasi + ' mnt)'"></span>
                                                                </a>
                                                                <template x-if="item.selesai">
                                                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-medium">
                                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                                        Selesai
                                                                    </span>
                                                                </template>
                                                            </div>
                                                        </template>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </section>

                    {{-- Tugas --}}
                    @if($tugasJs->isNotEmpty())
                    <section class="space-y-4">
                        <h4 class="text-base font-semibold dark:text-white">Daftar Tugas</h4>
                        @foreach($tugasJs as $t)
                        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm p-4">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-xl {{ $t['dikumpulkan'] ? 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400' : 'bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400' }} flex items-center justify-center shrink-0">
                                        @if($t['dikumpulkan'])
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <h5 class="font-semibold text-gray-900 dark:text-white text-sm">{{ $t['judul'] }}</h5>
                                            @if($t['dikumpulkan'])
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-medium">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                    Dikumpulkan
                                                </span>
                                            @endif
                                        </div>
                                        @if($t['deskripsi'])
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $t['deskripsi'] }}</p>
                                        @endif
                                        @if($t['batas_waktu'])
                                            <p class="text-xs text-red-500 mt-1 flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                Deadline: {{ $t['batas_waktu'] }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ route('peserta.tugas.show', $t['id']) }}"
                                    class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg {{ $t['dikumpulkan'] ? 'bg-gray-400 hover:bg-gray-500' : 'bg-purple-500 hover:bg-purple-600' }} text-white text-xs font-medium transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                    {{ $t['dikumpulkan'] ? 'Kumpulkan Ulang' : 'Kumpulkan' }}
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </section>
                    @endif

                </div>
            </main>

            <x-rightPanel />
        </div>
    </div>

    <script>
        const _serverWeeks = @json($weeksJs);

        function courseApp() {
            return {
                weeks: [],

                init() {
                    this.weeks = _serverWeeks || [];
                },

                iconClass(tipe) {
                    const map = {
                        'dokumen': 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400',
                        'video':   'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400',
                        'tautan':  'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400',
                        'kuis':    'bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400',
                    };
                    return map[tipe] || 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400';
                },
            };
        }
    </script>

</body>
</html>
