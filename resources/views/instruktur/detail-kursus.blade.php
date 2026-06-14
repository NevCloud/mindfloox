<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $kursus->nama }} - Instruktur</title>
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
        .materi-card.is-dragging { opacity: 0.4; }
        .materi-card.drop-before { border-top: 2px solid #6366f1; }
        .materi-card.drop-after  { border-bottom: 2px solid #6366f1; }
        .insert-row { height: 0; overflow: visible; position: relative; z-index: 10; }
        .insert-zone { position: absolute; left: 0; right: 0; top: -14px; height: 28px; display: flex; align-items: center; opacity: 0; transition: opacity 0.2s; }
        .materi-card:hover + .insert-row .insert-zone,
        .insert-zone:hover { opacity: 1; }
        .insert-inner { display: flex; align-items: center; gap: 8px; width: 100%; padding: 0 1rem; }
        .insert-line { flex: 1; height: 1px; background: #6366f1; }
        .insert-btn { display: flex; align-items: center; gap: 4px; padding: 2px 10px; border-radius: 999px; font-size: 11px; font-weight: 600; color: #6366f1; background: white; border: 1.5px solid #6366f1; cursor: pointer; white-space: nowrap; text-decoration: none; }
        .dark .insert-btn { background: #1A1A2E; }
        .drag-handle { cursor: grab; color: #9ca3af; }
        .drag-handle:hover { color: #6366f1; }
        body.is-dragging * { cursor: grabbing !important; }
    </style>
</head>

<body x-data="dashboardApp()" x-init="initApp()" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">
        <x-leftPanel />

        <main class="flex-1 flex flex-col overflow-hidden">
            <x-topNav />

            <div class="flex-1 overflow-y-auto" id="scrollContainer">
                <div class="p-5 space-y-5">

                    {{-- Flash messages --}}
                    @if(session('success'))
                        <div class="p-4 rounded-xl bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-sm text-green-700 dark:text-green-300 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Header --}}
                    <div class="flex items-center justify-between flex-wrap gap-3">
                        <div>
                            <a href="{{ route('instruktur.kursus.index') }}" class="text-xs text-gray-400 hover:text-primary flex items-center gap-1 mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                                Kursus Saya
                            </a>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $kursus->nama }}</h3>
                            @if($kursus->programMicrocredential)
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $kursus->programMicrocredential->nama }}</p>
                            @endif
                        </div>
                        <a href="{{ route('instruktur.kursus.konten.create', $kursus->id) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary text-white text-sm font-medium hover:opacity-90 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Tambah Konten
                        </a>
                    </div>

                    {{-- Weeks Section --}}
                    <section class="space-y-5" x-data="courseManager()">

                        <template x-if="weeks.length === 0">
                            <div class="text-center py-16 text-gray-400 dark:text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                                <p class="font-medium">Belum ada konten</p>
                                <p class="text-xs mt-1">Klik "Tambah Konten" untuk mulai menambahkan materi, tugas, atau kuis.</p>
                            </div>
                        </template>

                        <template x-for="week in weeks" :key="week.id">
                            <div class="rounded-2xl overflow-hidden shadow-sm border transition-all duration-300"
                                :class="week.status === 'aktif'
                                    ? 'border-gray-200 dark:border-gray-700'
                                    : 'border-dashed border-gray-300 dark:border-gray-600 opacity-80'">

                                <div class="w-full flex items-center justify-between px-5 py-4 bg-white dark:bg-[#1A1A2E] border-b border-gray-200 dark:border-gray-700">
                                    <div @click="week.open = !week.open" class="flex items-center gap-4 flex-1 min-w-0 cursor-pointer">
                                        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold shrink-0" x-text="week.nomor"></div>
                                        <div class="text-left min-w-0 flex-1">
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <h4 class="font-semibold text-gray-900 dark:text-white" x-text="'Minggu ' + week.nomor"></h4>
                                                <template x-if="week.status !== 'aktif'">
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                                        TERSEMBUNYI
                                                    </span>
                                                </template>
                                            </div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400" x-text="week.items.length + ' konten'"></p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-1 shrink-0">
                                        <button @click.stop="toggleMinggu(week.id)"
                                            class="w-9 h-9 flex items-center justify-center rounded-lg transition-all duration-200"
                                            :class="week.status === 'aktif'
                                                ? 'text-gray-400 hover:text-primary hover:bg-primary/10'
                                                : 'text-amber-500 bg-amber-50 dark:bg-amber-900/20 hover:bg-amber-100 dark:hover:bg-amber-900/30'"
                                            :title="week.status === 'aktif' ? 'Sembunyikan dari peserta' : 'Tampilkan ke peserta'">
                                            <svg x-show="week.status === 'aktif'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            <svg x-show="week.status !== 'aktif'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                        </button>

                                        <a :href="addKontenUrl + '?minggu=' + week.nomor"
                                            @click.stop
                                            class="hidden sm:flex px-3 py-2 rounded-lg bg-primary text-white text-xs font-medium hover:opacity-90 transition items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                            Tambah
                                        </a>

                                        <button @click.stop="week.open = !week.open" class="w-9 h-9 flex items-center justify-center">
                                            <svg :class="week.open ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        </button>
                                    </div>
                                </div>

                                <div x-show="week.open" x-transition class="border-t border-gray-200 dark:border-gray-700 p-5 space-y-3 bg-gray-50/50 dark:bg-[#14142B]/50">

                                    <template x-if="week.items.length === 0">
                                        <p class="text-center text-sm text-gray-400 dark:text-gray-500 py-4">Belum ada konten di minggu ini.</p>
                                    </template>

                                    <template x-for="(item, index) in week.items" :key="item.id + '_' + item.tipe">
                                        <div class="materi-card p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#1A1A2E] hover:shadow-md flex items-stretch gap-3">

                                            <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                                                :class="typeStyle(item.tipe_materi).bg">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" :class="typeStyle(item.tipe_materi).text"
                                                    :fill="item.tipe_materi === 'video' ? 'currentColor' : 'none'"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" :d="typeStyle(item.tipe_materi).icon" />
                                                </svg>
                                            </div>

                                            <div class="flex-1 min-w-0">
                                                <h5 class="font-semibold text-gray-900 dark:text-white" x-text="item.judul"></h5>
                                                <div class="flex flex-wrap gap-3 mt-2 text-xs text-gray-500 dark:text-gray-400">
                                                    <span class="capitalize" x-text="item.tipe_materi"></span>
                                                    <template x-if="item.meta1">
                                                        <span x-text="item.meta1"></span>
                                                    </template>
                                                </div>
                                                <div class="flex gap-2 mt-4">
                                                    <a :href="editKontenUrl(item.tipe, item.id)"
                                                        class="inline-flex items-center gap-1.5 h-9 px-3 rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200 text-xs font-medium">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                                        Edit
                                                    </a>
                                                    <button @click.prevent="removeItem(item.tipe, item.id)"
                                                        class="inline-flex items-center gap-1.5 h-9 px-3 rounded-lg bg-red-100 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200 text-xs font-medium">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>

                    </section>

                    {{-- Tugas Section --}}
                    <section x-data="{ open: true }">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-base font-semibold text-gray-900 dark:text-white">Daftar Tugas</h4>
                            <a href="{{ route('instruktur.kursus.konten.create', $kursus->id) }}?tipe=tugas"
                                class="text-xs text-primary hover:underline flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                Tambah Tugas
                            </a>
                        </div>
                        @forelse($tugasJs as $t)
                            @php $t = (object)$t; @endphp
                            <div class="p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#1A1A2E] mb-3 flex items-start justify-between gap-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-900/20 text-purple-600 flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white text-sm">{{ $t->judul }}</p>
                                        @if($t->batas_waktu)
                                            <p class="text-xs text-red-500 mt-0.5">Deadline: {{ $t->batas_waktu }}</p>
                                        @endif
                                        <p class="text-xs text-gray-400 mt-0.5">Bobot nilai: {{ $t->nilai }}</p>
                                    </div>
                                </div>
                                <div class="flex gap-2 shrink-0">
                                    <a href="{{ route('instruktur.kursus.konten.edit', [$kursus->id, 'tugas', $t->id]) }}"
                                        class="inline-flex items-center gap-1.5 h-9 px-3 rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all text-xs font-medium">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('instruktur.kursus.konten.destroy', [$kursus->id, 'tugas', $t->id]) }}"
                                        onsubmit="return confirm('Hapus tugas ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1.5 h-9 px-3 rounded-lg bg-red-100 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all text-xs font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-400 dark:text-gray-500 py-3">Belum ada tugas.</p>
                        @endforelse
                    </section>

                </div>
            </div>
        </main>

        <x-rightPanel />
    </div>

    <script>
        const _serverWeeks  = @json($weeksJs);
        const _kursusId     = {{ $kursus->id }};
        const _baseUrl      = '/instruktur/kursus/' + _kursusId;
        const _csrfToken    = document.querySelector('meta[name="csrf-token"]').content;

        function courseManager() {
            return {
                weeks: [],
                addKontenUrl: _baseUrl + '/konten/create',

                init() {
                    this.weeks = _serverWeeks.map(w => ({ ...w, open: false }));
                },

                editKontenUrl(tipe, id) {
                    return _baseUrl + '/konten/' + tipe + '/' + id + '/edit';
                },

                toggleMinggu(mingguId) {
                    fetch(_baseUrl + '/minggu/' + mingguId + '/toggle', {
                        method: 'PATCH',
                        headers: { 'X-CSRF-TOKEN': _csrfToken, 'Accept': 'application/json' },
                    }).then(r => {
                        if (r.ok || r.redirected) location.reload();
                        else alert('Gagal mengubah status minggu.');
                    });
                },

                removeItem(tipe, id) {
                    if (!confirm('Yakin ingin menghapus konten ini?')) return;
                    fetch(_baseUrl + '/konten/' + tipe + '/' + id, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': _csrfToken, 'Accept': 'application/json' },
                    }).then(r => {
                        if (r.ok || r.redirected) location.reload();
                        else alert('Gagal menghapus konten.');
                    });
                },

                typeStyle(type) {
                    const map = {
                        dokumen: { bg: 'bg-red-100 dark:bg-red-900/20',    text: 'text-red-600',    icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' },
                        video:   { bg: 'bg-blue-100 dark:bg-blue-900/20',   text: 'text-blue-600',   icon: 'M8 5v14l11-7z' },
                        tautan:  { bg: 'bg-cyan-100 dark:bg-cyan-900/20',   text: 'text-cyan-600',   icon: 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1' },
                        kuis:    { bg: 'bg-amber-100 dark:bg-amber-900/20', text: 'text-amber-600',  icon: 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
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
