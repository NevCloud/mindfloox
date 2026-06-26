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

        /* Drag-and-drop styles */
        .materi-card { transition: all 0.2s ease; }
        .materi-card.is-dragging { opacity: 0.35; transform: scale(0.98); }
        .materi-card.drag-over-top { border-top: 3px solid #6366f1 !important; margin-top: -1px; }
        .materi-card.drag-over-bottom { border-bottom: 3px solid #6366f1 !important; margin-bottom: -1px; }

        /* Insert zone between items */
        .insert-row {
            height: 0;
            overflow: visible;
            position: relative;
            z-index: 10;
        }
        .insert-zone {
            position: absolute;
            left: 0; right: 0;
            top: -16px;
            height: 32px;
            display: flex;
            align-items: center;
            opacity: 0;
            transition: opacity 0.25s ease;
            pointer-events: none;
        }
        .materi-card:hover + .insert-row .insert-zone,
        .insert-zone:hover {
            opacity: 1;
            pointer-events: auto;
        }
        .insert-inner {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 0 1rem;
        }
        .insert-line {
            flex: 1;
            height: 1.5px;
            background: linear-gradient(90deg, transparent, #6366f1, transparent);
        }
        .insert-btn {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 3px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            color: #6366f1;
            background: white;
            border: 1.5px solid #6366f1;
            cursor: pointer;
            white-space: nowrap;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(99,102,241,0.15);
            transition: all 0.2s;
        }
        .insert-btn:hover {
            background: #6366f1;
            color: white;
            transform: scale(1.05);
        }
        .dark .insert-btn {
            background: #1A1A2E;
        }
        .dark .insert-btn:hover {
            background: #6366f1;
            color: white;
        }

        /* Drag handle */
        .drag-handle {
            cursor: grab;
            color: #9ca3af;
            opacity: 0.4;
            transition: all 0.2s;
            user-select: none;
        }
        .materi-card:hover .drag-handle {
            opacity: 1;
        }
        .drag-handle:hover { color: #6366f1; }
        .drag-handle:active { cursor: grabbing; }
        body.is-dragging * { cursor: grabbing !important; }
        body.is-dragging .insert-zone { opacity: 0 !important; pointer-events: none !important; }

        /* Week card hover */
        .week-card { transition: all 0.3s ease; }
        .week-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .dark .week-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.3); }

        /* Inline edit */
        .inline-edit {
            background: transparent;
            border: 1px solid transparent;
            border-radius: 6px;
            padding: 2px 6px;
            transition: all 0.2s;
            outline: none;
        }
        .inline-edit:hover { border-color: #6366f133; }
        .inline-edit:focus {
            border-color: #6366f1;
            background: rgba(99,102,241,0.05);
        }
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
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Materi Kursus</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Kelola 14 minggu materi secara terstruktur</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <!-- Removed Tambah Konten button -->
                        </div>
                    </div>

                    {{-- Stats bar --}}
                    <section class="space-y-3" x-data="courseManager()">

                        <div class="flex items-center justify-between px-1">
                            <p class="text-xs text-gray-400 dark:text-gray-500">
                                Total <span class="font-semibold text-gray-600 dark:text-gray-300" x-text="weeks.length"></span> minggu
                                · <span class="font-semibold text-gray-600 dark:text-gray-300" x-text="totalItems()"></span> konten
                                · <span class="font-semibold text-gray-600 dark:text-gray-300" x-text="weeks.filter(w => w.status !== 'aktif').length"></span> tersembunyi
                            </p>
                        </div>

                        {{-- Week List --}}
                        <template x-if="weeks.length === 0">
                            <div class="text-center py-16 text-gray-400 dark:text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                                <p class="font-medium">Belum ada konten</p>
                                <p class="text-xs mt-1">Klik "Tambah Konten" untuk mulai menambahkan materi, tugas, atau kuis.</p>
                            </div>
                        </template>

                        <template x-for="(week, weekIdx) in weeks" :key="week.id">
                            <div class="week-card rounded-2xl overflow-hidden shadow-sm border"
                                :class="week.status === 'aktif'
                                    ? 'border-gray-200 dark:border-gray-700'
                                    : 'border-dashed border-gray-300 dark:border-gray-600 opacity-80'">

                                {{-- Week Header --}}
                                <div class="w-full flex items-center justify-between px-5 py-4 bg-white dark:bg-[#1A1A2E] border-b border-gray-200 dark:border-gray-700">
                                    <div @click="toggleWeek(week)" class="flex items-center gap-4 flex-1 min-w-0 cursor-pointer">
                                        {{-- Week number badge --}}
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm shrink-0"
                                            :class="week.status === 'aktif'
                                                ? 'bg-primary/10 text-primary'
                                                : 'bg-amber-100 dark:bg-amber-900/20 text-amber-600'"
                                            x-text="week.nomor"></div>

                                        <div class="text-left min-w-0 flex-1">
                                            <!-- Read Mode -->
                                            <div x-show="editingWeekId !== week.id">
                                                <div class="flex items-center gap-2 flex-wrap">
                                                    <h4 class="font-semibold text-gray-900 dark:text-white text-sm">
                                                        <span x-text="'Minggu ' + week.nomor + (week.judul ? ': ' + week.judul : '')"></span>
                                                    </h4>
                                                    <template x-if="week.status !== 'aktif'">
                                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                                            TERSEMBUNYI
                                                        </span>
                                                    </template>
                                                </div>
                                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5"
                                                    x-text="week.deskripsi || ('Materi minggu ke-' + week.nomor)"></p>
                                            </div>

                                            <!-- Edit Mode -->
                                            <div x-show="editingWeekId === week.id" @click.stop class="w-full pr-2 py-0.5">
                                                <div class="mb-1 w-full max-w-lg">
                                                    <input type="text" x-model="editForm.judul" 
                                                        class="w-full px-2 py-1 text-sm rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-[#0F0F1A] text-gray-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none" 
                                                        placeholder="Judul Minggu (opsional)" @keydown.enter="saveEditWeek(week)" @keydown.escape="cancelEditWeek()">
                                                </div>
                                                <div class="flex items-center gap-2 w-full max-w-lg">
                                                    <input type="text" x-model="editForm.deskripsi" 
                                                        class="flex-1 min-w-0 px-2 py-1 text-xs rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-[#0F0F1A] text-gray-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none" 
                                                        placeholder="Deskripsi" @keydown.enter="saveEditWeek(week)" @keydown.escape="cancelEditWeek()">
                                                    
                                                    <div class="flex items-center gap-1 shrink-0">
                                                        <button @click.stop="saveEditWeek(week)" class="px-2.5 py-1 bg-primary text-white text-[11px] rounded hover:bg-primary/90 font-medium">Simpan</button>
                                                        <button @click.stop="cancelEditWeek()" class="px-2.5 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-[11px] rounded hover:bg-gray-200 dark:hover:bg-gray-600 font-medium">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Week actions --}}
                                    <div class="flex items-center gap-1 shrink-0">
                                        {{-- Edit week title --}}
                                        <button @click.stop="startEditWeek(week)" x-show="editingWeekId !== week.id"
                                            class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-400 hover:text-primary hover:bg-primary/10 transition-all duration-200"
                                            title="Edit judul minggu">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                        </button>

                                        {{-- Toggle visibility --}}
                                        <button @click.stop="toggleMinggu(week.id)"
                                            class="w-9 h-9 flex items-center justify-center rounded-lg transition-all duration-200"
                                            :class="week.status === 'aktif'
                                                ? 'text-gray-400 hover:text-primary hover:bg-primary/10'
                                                : 'text-amber-500 bg-amber-50 dark:bg-amber-900/20 hover:bg-amber-100 dark:hover:bg-amber-900/30'"
                                            :title="week.status === 'aktif' ? 'Sembunyikan dari peserta' : 'Tampilkan ke peserta'">
                                            <svg x-show="week.status === 'aktif'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            <svg x-show="week.status !== 'aktif'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                        </button>

                                        {{-- Upload/Add --}}
                                        <a :href="addKontenUrl + '?minggu=' + week.nomor"
                                            @click.stop
                                            class="hidden sm:flex px-3 py-2 rounded-lg bg-primary text-white text-xs font-medium hover:opacity-90 transition items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                            Upload
                                        </a>

                                        {{-- Expand/Collapse --}}
                                        <button @click.stop="toggleWeek(week)" class="w-9 h-9 flex items-center justify-center">
                                            <svg :class="week.open ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        </button>
                                    </div>
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
                                            <a :href="addKontenUrl + '?minggu=' + week.nomor"
                                                class="inline-flex items-center gap-1.5 mt-3 px-4 py-2 rounded-lg bg-primary/10 text-primary text-xs font-medium hover:bg-primary hover:text-white transition-all duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                                Tambah konten pertama
                                            </a>
                                        </div>
                                    </template>

                                    <template x-for="(item, index) in week.items" :key="item.id + '_' + item.tipe">
                                        <div>
                                            {{-- Materi Card --}}
                                            <div class="materi-card p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#1A1A2E] hover:shadow-md flex items-stretch gap-3 mb-0"
                                                :class="{'is-dragging': dragging && dragItemId === item.id && dragItemTipe === item.tipe}"
                                                draggable="true"
                                                @dragstart="dragStart($event, week.id, index, item)"
                                                @dragover.prevent="dragOver($event, week.id, index)"
                                                @dragleave="dragLeave($event)"
                                                @drop.prevent="drop($event, week.id, index)"
                                                @dragend="dragEnd()">

                                                {{-- Drag handle --}}
                                                <div class="drag-handle flex items-center px-1 -ml-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                                        <circle cx="9" cy="6" r="1.5"/><circle cx="15" cy="6" r="1.5"/>
                                                        <circle cx="9" cy="12" r="1.5"/><circle cx="15" cy="12" r="1.5"/>
                                                        <circle cx="9" cy="18" r="1.5"/><circle cx="15" cy="18" r="1.5"/>
                                                    </svg>
                                                </div>

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
                                                    <a :href="editKontenUrl(item.tipe, item.id)"
                                                        class="inline-flex items-center gap-1.5 h-8 px-3 rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200 text-xs font-medium">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                                        Edit
                                                    </a>
                                                    <button @click.prevent="removeItem(item.tipe, item.id, item.judul)"
                                                        class="inline-flex items-center gap-1.5 h-8 px-3 rounded-lg bg-red-100 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200 text-xs font-medium">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- Insert zone (appears on hover between items) --}}
                                            <div class="insert-row" x-show="index < week.items.length - 1">
                                                <div class="insert-zone">
                                                    <div class="insert-inner">
                                                        <div class="insert-line"></div>
                                                        <a :href="addKontenUrl + '?minggu=' + week.nomor + '&posisi=' + (index + 2)"
                                                            class="insert-btn">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                                            Tambah materi di sini
                                                        </a>
                                                        <div class="insert-line"></div>
                                                    </div>
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
                                Total <span class="font-semibold" x-text="weeks.length"></span> minggu
                                · <span class="font-semibold" x-text="totalItems()"></span> konten
                                · <span class="font-semibold" x-text="weeks.filter(w => w.status !== 'aktif').length"></span> tersembunyi
                            </p>
                        </div>

                        {{-- ============ MODAL DELETE CONFIRMATION ============ --}}
                        <div x-show="deleteModal.show" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4"
                            style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">
                            <div @click.away="deleteModal.show = false" x-show="deleteModal.show" x-transition
                                class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl max-w-md w-full p-6 border border-gray-100 dark:border-gray-800">
                                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full bg-red-100 dark:bg-red-500/20">
                                    <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>

                                <h3 class="text-xl font-bold text-center text-gray-800 dark:text-white mb-2">Hapus Konten?</h3>
                                <p class="text-sm text-center text-gray-500 mb-2">Anda yakin ingin menghapus konten ini?</p>
                                <p class="text-sm text-center font-semibold text-gray-700 dark:text-gray-200 mb-6" x-text="deleteModal.nama"></p>

                                <div class="flex gap-3">
                                    <button type="button" @click="deleteModal.show = false"
                                        class="flex-1 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition font-medium">
                                        Batal
                                    </button>
                                    <button type="button" @click="confirmDelete()"
                                        class="flex-1 px-4 py-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition font-medium">
                                        Ya, Hapus
                                    </button>
                                </div>
                            </div>
                        </div>

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

                // Drag state
                dragging: false,
                dragItemId: null,
                dragItemTipe: null,
                dragSourceWeekId: null,
                dragSourceIndex: null,

                init() {
                    let openedWeeks = [];
                    try {
                        const stored = localStorage.getItem('kursus_opened_weeks_' + _kursusId);
                        if (stored) openedWeeks = JSON.parse(stored);
                    } catch (e) {}
                    
                    this.weeks = _serverWeeks.map(w => ({ 
                        ...w, 
                        open: openedWeeks.includes(w.id) 
                    }));
                },

                toggleWeek(week) {
                    week.open = !week.open;
                    this.saveOpenedWeeks();
                },

                saveOpenedWeeks() {
                    const opened = this.weeks.filter(w => w.open).map(w => w.id);
                    localStorage.setItem('kursus_opened_weeks_' + _kursusId, JSON.stringify(opened));
                },

                totalItems() {
                    return this.weeks.reduce((sum, w) => sum + w.items.length, 0);
                },

                editKontenUrl(tipe, id) {
                    return _baseUrl + '/konten/' + tipe + '/' + id + '/edit';
                },

                // ── Week actions (Inline Edit) ──
                editingWeekId: null,
                editForm: { judul: '', deskripsi: '' },

                startEditWeek(week) {
                    this.editingWeekId = week.id;
                    this.editForm = { 
                        judul: week.judul || '', 
                        deskripsi: week.deskripsi || '' 
                    };
                },
                cancelEditWeek() {
                    this.editingWeekId = null;
                },
                saveEditWeek(week) {
                    fetch(_baseUrl + '/minggu/' + week.id, {
                        method: 'PUT',
                        headers: { 
                            'X-CSRF-TOKEN': _csrfToken, 
                            'Content-Type': 'application/json',
                            'Accept': 'application/json' 
                        },
                        body: JSON.stringify({
                            judul: this.editForm.judul,
                            deskripsi: this.editForm.deskripsi
                        })
                    }).then(async r => {
                        if (r.ok) {
                            const data = await r.json();
                            week.judul = data.minggu.judul;
                            week.deskripsi = data.minggu.deskripsi;
                            this.editingWeekId = null;
                        } else {
                            alert('Gagal menyimpan minggu.');
                        }
                    }).catch(() => alert('Terjadi kesalahan jaringan.'));
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

                deleteModal: {
                    show: false,
                    tipe: '',
                    id: '',
                    nama: ''
                },

                removeItem(tipe, id, nama) {
                    this.deleteModal = {
                        show: true,
                        tipe: tipe,
                        id: id,
                        nama: nama || 'Konten tanpa judul'
                    };
                },

                confirmDelete() {
                    const tipe = this.deleteModal.tipe;
                    const id = this.deleteModal.id;
                    fetch(_baseUrl + '/konten/' + tipe + '/' + id, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': _csrfToken, 'Accept': 'application/json' },
                    }).then(r => {
                        if (r.ok || r.redirected) location.reload();
                        else {
                            alert('Gagal menghapus konten.');
                            this.deleteModal.show = false;
                        }
                    }).catch(() => {
                        alert('Terjadi kesalahan jaringan.');
                        this.deleteModal.show = false;
                    });
                },

                // ── Drag and Drop ──
                dragStart(event, weekId, index, item) {
                    this.dragging = true;
                    this.dragItemId = item.id;
                    this.dragItemTipe = item.tipe;
                    this.dragSourceWeekId = weekId;
                    this.dragSourceIndex = index;
                    document.body.classList.add('is-dragging');
                    event.dataTransfer.effectAllowed = 'move';
                    event.dataTransfer.setData('text/plain', JSON.stringify({ weekId, index, itemId: item.id, tipe: item.tipe }));
                },

                dragOver(event, weekId, index) {
                    event.preventDefault();
                    event.dataTransfer.dropEffect = 'move';

                    // Visual feedback
                    const card = event.currentTarget;
                    const rect = card.getBoundingClientRect();
                    const midY = rect.top + rect.height / 2;

                    // Remove previous classes
                    document.querySelectorAll('.drag-over-top, .drag-over-bottom').forEach(el => {
                        el.classList.remove('drag-over-top', 'drag-over-bottom');
                    });

                    if (event.clientY < midY) {
                        card.classList.add('drag-over-top');
                    } else {
                        card.classList.add('drag-over-bottom');
                    }
                },

                dragLeave(event) {
                    event.currentTarget.classList.remove('drag-over-top', 'drag-over-bottom');
                },

                dragEnd() {
                    this.dragging = false;
                    this.dragItemId = null;
                    this.dragItemTipe = null;
                    document.body.classList.remove('is-dragging');
                    document.querySelectorAll('.drag-over-top, .drag-over-bottom').forEach(el => {
                        el.classList.remove('drag-over-top', 'drag-over-bottom');
                    });
                },

                drop(event, targetWeekId, targetIndex) {
                    event.preventDefault();
                    this.dragEnd();

                    const data = JSON.parse(event.dataTransfer.getData('text/plain'));
                    const sourceWeekId = data.weekId;
                    const sourceIndex = data.index;

                    // Find source and target weeks
                    const sourceWeek = this.weeks.find(w => w.id === sourceWeekId);
                    const targetWeek = this.weeks.find(w => w.id === targetWeekId);
                    if (!sourceWeek || !targetWeek) return;

                    // Determine insert position
                    const card = event.currentTarget;
                    const rect = card.getBoundingClientRect();
                    const insertAfter = event.clientY >= rect.top + rect.height / 2;
                    let insertIndex = insertAfter ? targetIndex + 1 : targetIndex;

                    // Same week reorder
                    if (sourceWeekId === targetWeekId) {
                        if (sourceIndex === insertIndex || sourceIndex + 1 === insertIndex) return;
                        const [moved] = sourceWeek.items.splice(sourceIndex, 1);
                        if (sourceIndex < insertIndex) insertIndex--;
                        sourceWeek.items.splice(insertIndex, 0, moved);
                    } else {
                        // Cross-week move
                        const [moved] = sourceWeek.items.splice(sourceIndex, 1);
                        targetWeek.items.splice(insertIndex, 0, moved);
                    }

                    // Save to server
                    this.saveOrder(targetWeek);
                    if (sourceWeekId !== targetWeekId) {
                        this.saveOrder(sourceWeek);
                    }
                },

                saveOrder(week) {
                    const items = week.items.map((item, idx) => ({
                        id: item.id,
                        tipe: item.tipe,
                        nomor_urut: idx + 1,
                    }));

                    fetch(_baseUrl + '/minggu/' + week.id + '/reorder', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': _csrfToken,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({ items }),
                    }).then(r => {
                        if (!r.ok) console.error('Failed to save order');
                    });
                },

                // ── Type styles ──
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
