@extends('layouts.instructor')
@section('title', 'Course')
@section('content')

<section class="space-y-5" x-data="courseManager()">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Materi Kursus</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Pelajari materi per minggu secara terstruktur</p>
        </div>
    </div>

    <!-- WEEK CARD -->
    <div class="card translate-0 rounded-2xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700">

        <!-- HEADER -->
        <div class="w-full flex items-center justify-between px-5 py-4 bg-white dark:bg-[#1A1A2E] border-b border-gray-200 dark:border-gray-700">
            <div @click="weekOpen = !weekOpen" class="flex items-center gap-4 cursor-pointer flex-1">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold">1</div>
                <div class="text-left">
                    <h4 class="font-semibold text-gray-900 dark:text-white">Minggu 1: Pengenalan HTML</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Dasar struktur halaman web</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="/instructor/upload-materi" @click.stop class="flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white text-sm hover:opacity-90 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    Upload Materi
                </a>
                <button @click.stop="weekOpen = !weekOpen" class="w-9 h-9 flex items-center justify-center">
                    <svg :class="weekOpen ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- CONTENT -->
        <div x-show="weekOpen" x-transition class="border-t border-gray-200 dark:border-gray-700 p-5 space-y-0">

            <template x-for="(item, index) in items" :key="item.id">
                <div>
                    {{-- ===== ADD BUTTON (di atas setiap item kecuali item pertama) ===== --}}
                    <template x-if="index > 0">
                        <div class="relative py-2 group/add">
                            {{-- Garis tipis --}}
                            <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 h-px bg-gray-200 dark:bg-gray-700 opacity-0 group-hover/add:opacity-100 transition"></div>
                            {{-- Tombol + --}}
                            <div class="flex justify-center">
                                <button @click="insertAt = index; showAddForm = (insertAt === index && !showAddForm) || insertAt !== index"
                                    class="relative z-10 w-7 h-7 rounded-full border-2 border-dashed border-gray-300 dark:border-gray-600 bg-white dark:bg-[#1A1A2E] flex items-center justify-center opacity-0 group-hover/add:opacity-100 hover:!opacity-100 hover:border-primary hover:text-primary text-gray-400 transition-all duration-200 text-lg font-light"
                                    title="Tambah materi di sini">
                                    +
                                </button>
                            </div>
                            {{-- Inline Add Form --}}
                            <template x-if="showAddForm && insertAt === index">
                                <div class="mt-2 p-4 rounded-xl border-2 border-dashed border-primary/40 bg-primary/5 dark:bg-primary/10 space-y-3" @click.away="showAddForm = false">
                                    <p class="text-xs font-semibold text-primary">Tambah Materi Baru</p>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                        <button @click="addItem(index, 'dokumen')" class="p-3 rounded-lg border border-gray-200 dark:border-gray-600 text-center hover:border-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-auto mb-1 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            <span class="text-xs font-medium text-gray-600 dark:text-gray-300">Dokumen</span>
                                        </button>
                                        <button @click="addItem(index, 'video')" class="p-3 rounded-lg border border-gray-200 dark:border-gray-600 text-center hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-auto mb-1 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                            <span class="text-xs font-medium text-gray-600 dark:text-gray-300">Video</span>
                                        </button>
                                        <button @click="addItem(index, 'tugas')" class="p-3 rounded-lg border border-gray-200 dark:border-gray-600 text-center hover:border-purple-400 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-auto mb-1 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            <span class="text-xs font-medium text-gray-600 dark:text-gray-300">Tugas</span>
                                        </button>
                                        <button @click="addItem(index, 'kuis')" class="p-3 rounded-lg border border-gray-200 dark:border-gray-600 text-center hover:border-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-auto mb-1 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            <span class="text-xs font-medium text-gray-600 dark:text-gray-300">Kuis</span>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>

                    {{-- ===== MATERI CARD ===== --}}
                    <div class="p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-[#1A1A2E] hover:shadow-md transition">
                        <div class="flex items-start gap-4">
                            {{-- Icon --}}
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                                :class="typeStyle(item.type).bg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" :class="typeStyle(item.type).text"
                                    :fill="item.type === 'video' ? 'currentColor' : 'none'"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" :d="typeStyle(item.type).icon" />
                                </svg>
                            </div>

                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-900 dark:text-white" x-text="item.title"></h5>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1" x-text="item.desc"></p>

                                {{-- Meta --}}
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
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            <span x-text="'Deadline: ' + item.deadline"></span>
                                        </span>
                                    </template>
                                </div>

                                {{-- Actions --}}
                                <div class="flex justify-between gap-2 mt-4">
                                    <div>
                                        <button class="flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white text-sm hover:opacity-90 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                            Download
                                        </button>
                                    </div>
                                    <div class="flex gap-2">
                                        <button onclick="window.location.href='/instructor/upload-materi'"
                                            class="group w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9" /><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                                            </svg>
                                        </button>
                                        <button @click.prevent="removeItem(item.id)"
                                            class="group w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6" /><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" /><path d="M10 11v6" /><path d="M14 11v6" /><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            {{-- ===== ADD BUTTON DI BAWAH (selalu terlihat) ===== --}}
            <div class="pt-4">
                <div class="relative group/bottom">
                    <button @click="insertAt = items.length; showAddForm = (insertAt === items.length && !showAddForm) || insertAt !== items.length"
                        class="w-full py-3 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600 text-gray-400 hover:border-primary hover:text-primary transition-all duration-200 flex items-center justify-center gap-2 text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Tambah Materi
                    </button>

                    <template x-if="showAddForm && insertAt === items.length">
                        <div class="mt-3 p-4 rounded-xl border-2 border-dashed border-primary/40 bg-primary/5 dark:bg-primary/10 space-y-3" @click.away="showAddForm = false">
                            <p class="text-xs font-semibold text-primary">Pilih Tipe Materi</p>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                <button @click="addItem(items.length, 'dokumen')" class="p-3 rounded-lg border border-gray-200 dark:border-gray-600 text-center hover:border-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-auto mb-1 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span class="text-xs font-medium text-gray-600 dark:text-gray-300">Dokumen</span>
                                </button>
                                <button @click="addItem(items.length, 'video')" class="p-3 rounded-lg border border-gray-200 dark:border-gray-600 text-center hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-auto mb-1 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    <span class="text-xs font-medium text-gray-600 dark:text-gray-300">Video</span>
                                </button>
                                <button @click="addItem(items.length, 'tugas')" class="p-3 rounded-lg border border-gray-200 dark:border-gray-600 text-center hover:border-purple-400 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-auto mb-1 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    <span class="text-xs font-medium text-gray-600 dark:text-gray-300">Tugas</span>
                                </button>
                                <button @click="addItem(items.length, 'kuis')" class="p-3 rounded-lg border border-gray-200 dark:border-gray-600 text-center hover:border-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-auto mb-1 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span class="text-xs font-medium text-gray-600 dark:text-gray-300">Kuis</span>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    function courseManager() {
        return {
            weekOpen: true,
            showAddForm: false,
            insertAt: -1,
            nextId: 4,

            // Data materi (demo)
            items: [
                { id: 1, type: 'dokumen', title: 'Dasar HTML - Panduan Lengkap', desc: 'Panduan komprehensif tentang struktur HTML, tag dasar, dan best practice.', meta1: '2.4 MB', meta2: '15 Jan 2024', deadline: null },
                { id: 2, type: 'video', title: 'Pengenalan Tag HTML Dasar', desc: 'Video tutorial tag HTML seperti heading, paragraph, list, dan link.', meta1: '12:45', meta2: '234 views', deadline: null },
                { id: 3, type: 'tugas', title: 'Tugas: Halaman HTML Sederhana', desc: 'Buat halaman HTML biodata pribadi dengan minimal 5 tag.', meta1: null, meta2: null, deadline: '20 Jan 2024' },
            ],

            // Tambah item baru di posisi tertentu
            addItem(atIndex, type) {
                const defaults = {
                    dokumen: { title: 'Dokumen Baru', desc: 'Deskripsi dokumen...', meta1: '0 MB', meta2: new Date().toLocaleDateString('id-ID', {day:'numeric',month:'short',year:'numeric'}) },
                    video:   { title: 'Video Baru', desc: 'Deskripsi video...', meta1: '00:00', meta2: '0 views' },
                    tugas:   { title: 'Tugas Baru', desc: 'Deskripsi tugas...', deadline: 'Belum diatur' },
                    kuis:    { title: 'Kuis Baru', desc: 'Deskripsi kuis...', meta1: '15 Menit', meta2: null },
                };
                const d = defaults[type];
                this.items.splice(atIndex, 0, {
                    id: this.nextId++,
                    type: type,
                    title: d.title,
                    desc: d.desc,
                    meta1: d.meta1 || null,
                    meta2: d.meta2 || null,
                    deadline: d.deadline || null
                });
                this.showAddForm = false;
            },

            // Hapus item
            removeItem(id) {
                if (confirm('Yakin ingin menghapus item ini?')) {
                    this.items = this.items.filter(i => i.id !== id);
                }
            },

            // Style helper per tipe
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

@endsection

