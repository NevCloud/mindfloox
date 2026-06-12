<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Detail Kursus - Instruktur</title>
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
        [x-cloak] { display: none !important; }
        .modal-backdrop { backdrop-filter: blur(4px); }
    </style>
</head>

<body x-data="dashboardApp()" x-init="initApp()" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">

        <x-leftPanel />

        <main class="flex-1 flex flex-col overflow-hidden">

            <x-topNav />

            <div class="flex-1 overflow-y-auto" id="scrollContainer">
                <div class="p-5 space-y-5">

                    <section class="space-y-5" x-data="courseManager()">
                        <div class="flex items-center justify-between flex-wrap gap-3">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Materi Kursus</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Kelola 14 minggu materi secara terstruktur</p>
                            </div>
                            <div class="hidden md:flex items-center gap-3">
                                <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 bg-white dark:bg-[#1A1A2E] px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <circle cx="9" cy="6" r="1.5"/><circle cx="15" cy="6" r="1.5"/>
                                        <circle cx="9" cy="12" r="1.5"/><circle cx="15" cy="12" r="1.5"/>
                                        <circle cx="9" cy="18" r="1.5"/><circle cx="15" cy="18" r="1.5"/>
                                    </svg>
                                    Drag untuk urutkan
                                </div>
                                <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 bg-white dark:bg-[#1A1A2E] px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Terlihat
                                    </span>
                                    <span class="text-gray-300 dark:text-gray-700">|</span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                        Tersembunyi
                                    </span>
                                </div>
                            </div>
                        </div>

                        <template x-for="week in weeks" :key="week.id">
                            <div class="card translate-0 rounded-2xl overflow-hidden shadow-sm border transition-all duration-300"
                                :class="week.visible
                                    ? 'border-gray-200 dark:border-gray-700'
                                    : 'border-dashed border-gray-300 dark:border-gray-600 opacity-80'">

                                <div class="w-full flex items-center justify-between px-5 py-4 bg-white dark:bg-[#1A1A2E] border-b border-gray-200 dark:border-gray-700">

                                    <template x-if="editingWeekId !== week.id">
                                        <div class="flex items-center gap-4 flex-1 min-w-0">
                                            <div @click="week.open = !week.open" class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold shrink-0 cursor-pointer"
                                                x-text="week.id"></div>
                                            <div @click="week.open = !week.open" class="text-left min-w-0 cursor-pointer flex-1">
                                                <div class="flex items-center gap-2 flex-wrap">
                                                    <h4 class="font-semibold text-gray-900 dark:text-white" x-text="'Minggu ' + week.id + ': ' + week.title"></h4>
                                                    <template x-if="!week.visible">
                                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                                            TERSEMBUNYI
                                                        </span>
                                                    </template>
                                                </div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400" x-text="week.desc"></p>
                                            </div>
                                        </div>
                                    </template>

                                    <template x-if="editingWeekId === week.id">
                                        <div class="flex-1 min-w-0 space-y-2 pr-2">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs font-semibold text-primary whitespace-nowrap">Minggu <span x-text="week.id"></span></span>
                                            </div>
                                            <input type="text"
                                                x-model="editTitle"
                                                class="w-full px-3 py-1.5 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-[#0F0F1A] text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-primary outline-none"
                                                placeholder="Judul minggu..."
                                                @keydown.enter="saveEditWeek()">
                                            <textarea x-model="editDesc"
                                                rows="2"
                                                class="w-full px-3 py-1.5 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-[#0F0F1A] text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-primary outline-none resize-none"
                                                placeholder="Deskripsi minggu..."
                                                @keydown.escape="cancelEditWeek()"></textarea>
                                            <div class="flex gap-2">
                                                <button @click="saveEditWeek()"
                                                    class="px-3 py-1 text-xs font-medium rounded-lg bg-primary text-white hover:opacity-90 transition flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                    Simpan
                                                </button>
                                                <button @click="cancelEditWeek()"
                                                    class="px-3 py-1 text-xs font-medium rounded-lg border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                                    Batal
                                                </button>
                                            </div>
                                        </div>
                                    </template>

                                    <div class="flex items-center gap-1 shrink-0">
                                        <button x-show="editingWeekId !== week.id" @click.stop="startEditWeek(week)"
                                            class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-500/10 transition-all duration-200"
                                            title="Edit minggu">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                            </svg>
                                        </button>

                                        <button x-show="editingWeekId !== week.id" @click.stop="toggleVisibility(week.id)"
                                            class="w-9 h-9 flex items-center justify-center rounded-lg transition-all duration-200"
                                            :class="week.visible
                                                ? 'text-gray-400 hover:text-primary hover:bg-primary/10'
                                                : 'text-amber-500 bg-amber-50 dark:bg-amber-900/20 hover:bg-amber-100 dark:hover:bg-amber-900/30'"
                                            :title="week.visible ? 'Sembunyikan dari peserta' : 'Tampilkan ke peserta'">
                                            <svg x-show="week.visible" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            <svg x-show="!week.visible" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                            </svg>
                                        </button>

                                        <a x-show="editingWeekId !== week.id" :href="'/instruktur/upload-materi?week=' + week.id"
                                            @click.stop
                                            class="hidden sm:flex px-3 py-2 rounded-lg bg-primary text-white text-xs font-medium hover:opacity-90 transition items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                            Upload
                                        </a>

                                        <button x-show="editingWeekId !== week.id" @click.stop="week.open = !week.open" class="w-9 h-9 flex items-center justify-center">
                                            <svg :class="week.open ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div x-show="week.open" x-transition class="border-t border-gray-200 dark:border-gray-700 p-5 space-y-3 bg-gray-50/50 dark:bg-[#14142B]/50">

                                    <template x-for="(item, index) in week.items" :key="item.id">
                                        <div class="flex flex-col">

                                            {{-- MATERI CARD (DRAGGABLE) --}}
                                            <div class="materi-card p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#1A1A2E] hover:shadow-md flex items-stretch gap-3"
                                                :data-item-id="item.id"
                                                :data-week-id="week.id"
                                                :data-index="index"
                                                :class="{
                                                    'is-dragging': dragState.isDragging && dragState.sourceItemId === item.id,
                                                    'is-drag-over': dragState.isDragging && dragState.overItemId === item.id && dragState.sourceItemId !== item.id,
                                                    'drop-before': dragState.isDragging && dragState.overItemId === item.id && dragState.dropPosition === 'before' && dragState.sourceItemId !== item.id,
                                                    'drop-after': dragState.isDragging && dragState.overItemId === item.id && dragState.dropPosition === 'after' && dragState.sourceItemId !== item.id
                                                }"
                                                @dragover.prevent.stop="handleDragOver($event, week.id, item.id, index)"
                                                @dragenter.prevent.stop
                                                @drop.prevent.stop="handleDrop($event, week.id, item.id, index)"
                                                @dragleave="handleDragLeave($event, item.id)">

                                                {{-- Drag Handle --}}
                                                <div class="drag-handle flex items-center pt-1"
                                                    draggable="true"
                                                    @dragstart="handleDragStart($event, week.id, item.id, index)"
                                                    @dragend="handleDragEnd($event)"
                                                    title="Drag untuk pindahkan">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <circle cx="9" cy="6" r="1.5"/>
                                                        <circle cx="15" cy="6" r="1.5"/>
                                                        <circle cx="9" cy="12" r="1.5"/>
                                                        <circle cx="15" cy="12" r="1.5"/>
                                                        <circle cx="9" cy="18" r="1.5"/>
                                                        <circle cx="15" cy="18" r="1.5"/>
                                                    </svg>
                                                </div>

                                                {{-- Icon --}}
                                                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                                                    :class="typeStyle(item.type).bg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" :class="typeStyle(item.type).text"
                                                        :fill="item.type === 'video' ? 'currentColor' : 'none'"
                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" :d="typeStyle(item.type).icon" />
                                                    </svg>
                                                </div>

                                                <div class="flex-1 min-w-0">
                                                    <h5 class="font-semibold text-gray-900 dark:text-white" x-text="item.title"></h5>
                                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1" x-text="item.desc"></p>

                                                    <div class="flex flex-wrap gap-3 mt-3 text-xs text-gray-500 dark:text-gray-400">
                                                        <template x-if="item.meta1">
                                                            <span class="flex items-center gap-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                                <span x-text="item.meta1"></span>
                                                            </span>
                                                        </template>
                                                        <template x-if="item.meta2">
                                                            <span class="flex items-center gap-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                                <span x-text="item.meta2"></span>
                                                            </span>
                                                        </template>
                                                        <template x-if="item.deadline">
                                                            <span class="flex items-center gap-1 text-red-500">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                                <span x-text="'Deadline: ' + item.deadline"></span>
                                                            </span>
                                                        </template>
                                                    </div>

                                                    <div class="flex justify-between gap-2 mt-4 flex-wrap">
                                                        <div>
                                                            <template x-if="item.type === 'dokumen'">
                                                                <button class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white text-sm hover:opacity-90 transition font-medium">
                                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                                    </svg>
                                                                    Download File
                                                                </button>
                                                            </template>
                                                            <template x-if="item.type === 'video'">
                                                                <button class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white text-sm hover:opacity-90 transition font-medium">
                                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                                        <path d="M8 5v14l11-7z"/>
                                                                    </svg>
                                                                    Tonton Video
                                                                </button>
                                                            </template>
                                                            <template x-if="item.type === 'tugas'">
                                                                <button class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white text-sm hover:opacity-90 transition font-medium">
                                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                                                    </svg>
                                                                    Kumpulkan Tugas
                                                                </button>
                                                            </template>
                                                            <template x-if="item.type === 'kuis'">
                                                                <button class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white text-sm hover:opacity-90 transition font-medium">
                                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                    </svg>
                                                                    Kerjakan Kuis
                                                                </button>
                                                            </template>
                                                        </div>

                                                        <div class="flex gap-2">
                                                            <a :href="'/instruktur/upload-materi?edit=' + item.id"
                                                                class="group inline-flex items-center gap-1.5 h-9 px-3 rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200 text-xs font-medium"
                                                                title="Edit materi">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                                                </svg>
                                                                <span class="hidden sm:inline">Edit</span>
                                                            </a>
                                                            <button @click.prevent="removeItem(week.id, item.id)"
                                                                class="group inline-flex items-center gap-1.5 h-9 px-3 rounded-lg bg-red-100 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200 text-xs font-medium"
                                                                title="Hapus materi">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                                                </svg>
                                                                <span class="hidden sm:inline">Hapus</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- INSERT ZONE --}}
                                            <div class="insert-row">
                                                <div class="insert-zone">
                                                    <div class="insert-inner">
                                                        <div class="insert-line"></div>
                                                        <a :href="'/instruktur/upload-materi?week=' + week.id + '&after=' + item.id"
                                                           class="insert-btn"
                                                           title="Sisipkan materi baru di sini">
                                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                                            </svg>
                                                            Tambah materi di sini
                                                        </a>
                                                        <div class="insert-line"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </template>

                                </div>
                            </div>
                        </template>

                        <div class="text-center py-4 text-xs text-gray-400 dark:text-gray-500">
                            Total <span class="font-semibold text-gray-700 dark:text-gray-300" x-text="weeks.length"></span> minggu •
                            <span class="font-semibold text-gray-700 dark:text-gray-300" x-text="weeks.filter(w => w.visible).length"></span> terlihat peserta •
                            <span class="font-semibold text-gray-700 dark:text-gray-300" x-text="weeks.filter(w => !w.visible).length"></span> tersembunyi
                        </div>
                    </section>

                </div>
            </div>

        </main>

        <x-rightPanel />

    </div>

    <script>
        function courseManager() {
            return {
                weeks: [],
                editingWeekId: null,
                editTitle: '',
                editDesc: '',

                dragState: {
                    isDragging: false,
                    sourceWeekId: null,
                    sourceItemId: null,
                    sourceIndex: null,
                    overItemId: null,
                    dropPosition: null
                },

                init() {
                    this.generateWeeks();
                },

                generateWeeks() {
                    const topik = [
                        'Pengenalan HTML', 'CSS Dasar & Styling', 'JavaScript Fundamentals', 'Responsive Design',
                        'UI Components & Bootstrap', 'Layout dengan Flexbox & Grid', 'Animasi CSS & Transitions',
                        'Framework CSS Modern', 'JavaScript Lanjutan (ES6+)', 'API & Fetch Data',
                        'State Management', 'Testing & Debugging', 'Deployment & Hosting', 'Final Project'
                    ];

                    this.weeks = Array.from({ length: 14 }, (_, i) => {
                        const w = i + 1;
                        return {
                            id: w,
                            title: topik[i],
                            desc: 'Materi minggu ke-' + w + ' - ' + topik[i],
                            open: w === 1,
                            visible: w <= 3,
                            items: [
                                { id: 'm' + w, type: 'dokumen', title: 'Panduan ' + topik[i], desc: 'Bahan bacaan lengkap untuk minggu ' + w, meta1: '2.' + w + ' MB', meta2: '15 Jan 2024', deadline: null },
                                { id: 'v' + w, type: 'video', title: 'Video Tutorial ' + topik[i], desc: 'Tutorial video interaktif minggu ' + w, meta1: (10 + w) + ':30', meta2: '234 views', deadline: null },
                                { id: 't' + w, type: 'tugas', title: 'Tugas Praktik: ' + topik[i], desc: 'Latihan mandiri untuk mengasah skill minggu ' + w, meta1: null, meta2: null, deadline: (15 + w) + ' Jan 2024' },
                                { id: 'q' + w, type: 'kuis', title: 'Kuis Evaluasi Minggu ' + w, desc: 'Uji pemahaman materi minggu ' + w, meta1: '15 Menit', meta2: null, deadline: null },
                            ]
                        };
                    });
                },

                startEditWeek(week) {
                    this.editingWeekId = week.id;
                    this.editTitle = week.title;
                    this.editDesc = week.desc;
                },

                saveEditWeek() {
                    const week = this.weeks.find(w => w.id === this.editingWeekId);
                    if (week && this.editTitle.trim()) {
                        week.title = this.editTitle.trim();
                        week.desc = this.editDesc.trim();
                        this.cancelEditWeek();
                    }
                },

                cancelEditWeek() {
                    this.editingWeekId = null;
                    this.editTitle = '';
                    this.editDesc = '';
                },

                handleDragStart(event, weekId, itemId, index) {
                    event.dataTransfer.effectAllowed = 'move';
                    event.dataTransfer.setData('text/plain', JSON.stringify({ weekId, itemId, index }));

                    const card = event.target.closest('.materi-card');
                    if (card) {
                        try {
                            event.dataTransfer.setDragImage(card, 50, 30);
                        } catch (e) {}
                    }

                    this.dragState = {
                        isDragging: true,
                        sourceWeekId: weekId,
                        sourceItemId: itemId,
                        sourceIndex: index,
                        overItemId: null,
                        dropPosition: null
                    };

                    document.body.classList.add('is-dragging');
                },

                handleDragOver(event, weekId, itemId, index) {
                    if (this.dragState.sourceWeekId !== weekId) {
                        event.dataTransfer.dropEffect = 'none';
                        return;
                    }

                    if (this.dragState.sourceItemId === itemId) {
                        event.dataTransfer.dropEffect = 'none';
                        return;
                    }

                    event.dataTransfer.dropEffect = 'move';

                    const card = event.currentTarget;
                    const rect = card.getBoundingClientRect();
                    const mouseY = event.clientY;
                    const cardMiddle = rect.top + (rect.height / 2);

                    const newPosition = mouseY < cardMiddle ? 'before' : 'after';

                    if (this.dragState.overItemId !== itemId || this.dragState.dropPosition !== newPosition) {
                        this.dragState.overItemId = itemId;
                        this.dragState.dropPosition = newPosition;
                    }
                },

                handleDragLeave(event, itemId) {
                    const card = event.currentTarget;
                    const related = event.relatedTarget;

                    if (related && card.contains(related)) {
                        return;
                    }

                    if (this.dragState.overItemId === itemId) {
                        this.dragState.overItemId = null;
                        this.dragState.dropPosition = null;
                    }
                },

                handleDrop(event, targetWeekId, targetItemId, targetIndex) {
                    event.preventDefault();

                    if (this.dragState.sourceWeekId !== targetWeekId) {
                        this.handleDragEnd(event);
                        return;
                    }

                    if (this.dragState.sourceItemId === targetItemId) {
                        this.handleDragEnd(event);
                        return;
                    }

                    const week = this.weeks.find(w => w.id === targetWeekId);
                    if (!week) {
                        this.handleDragEnd(event);
                        return;
                    }

                    const sourceIndex = this.dragState.sourceIndex;
                    const draggedItem = week.items[sourceIndex];

                    if (!draggedItem) {
                        this.handleDragEnd(event);
                        return;
                    }

                    let finalIndex = targetIndex;
                    if (this.dragState.dropPosition === 'after') {
                        finalIndex = targetIndex + 1;
                    }

                    if (sourceIndex < finalIndex) {
                        finalIndex--;
                    }

                    if (sourceIndex === finalIndex) {
                        this.handleDragEnd(event);
                        return;
                    }

                    week.items.splice(sourceIndex, 1);
                    week.items.splice(finalIndex, 0, draggedItem);

                    console.log('✅ Materi berhasil dipindahkan!', {
                        item: draggedItem.title,
                        from: sourceIndex,
                        to: finalIndex
                    });

                    this.handleDragEnd(event);
                },

                handleDragEnd(event) {
                    this.dragState = {
                        isDragging: false,
                        sourceWeekId: null,
                        sourceItemId: null,
                        sourceIndex: null,
                        overItemId: null,
                        dropPosition: null
                    };

                    document.body.classList.remove('is-dragging');
                },

                toggleVisibility(weekId) {
                    const week = this.weeks.find(w => w.id === weekId);
                    if (!week) return;
                    const action = week.visible ? 'menyembunyikan' : 'menampilkan';
                    if (confirm(`Yakin ingin ${action} Minggu ${weekId} dari peserta?`)) {
                        week.visible = !week.visible;
                    }
                },

                removeItem(weekId, itemId) {
                    if (!confirm('Yakin ingin menghapus materi ini?')) return;
                    const week = this.weeks.find(w => w.id === weekId);
                    if (week) week.items = week.items.filter(i => i.id !== itemId);
                },

                typeStyle(type) {
                    const map = {
                        dokumen: { bg: 'bg-red-100 dark:bg-red-900/20', text: 'text-red-600', icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' },
                        video:  { bg: 'bg-blue-100 dark:bg-blue-900/20', text: 'text-blue-600', icon: 'M8 5v14l11-7z' },
                        tugas:  { bg: 'bg-purple-100 dark:bg-purple-900/20', text: 'text-purple-600', icon: 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z' },
                        kuis:   { bg: 'bg-amber-100 dark:bg-amber-900/20', text: 'text-amber-600', icon: 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
                    };
                    return map[type] || map.dokumen;
                }
            };
        }
    </script>

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
