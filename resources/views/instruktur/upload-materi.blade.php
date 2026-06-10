<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Materi - Instruktur</title>
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

<body x-data="{
    dark: localStorage.getItem('theme') === 'dark',
    toggleDark() {
        this.dark = !this.dark;
        localStorage.setItem('theme', this.dark ? 'dark' : 'light');
        document.documentElement.classList.toggle('dark', this.dark);
    },

    // Form state
    tipeMateri: '',
    judulMateri: '',
    deskripsi: '',
    minggu: '',
    deadline: '',
    fileName: '',
    linkVideo: '',
    durasi: '30',
    showSuccess: false,

    // Kuis state
    questions: [{ id: 1, type: 'multiple_choice', question: '', options: { A: '', B: '', C: '', D: '' }, answer: '', open: true, imageName: '' }],
    nextId: 2,

    addQuestion(type) {
        this.questions.push({ id: this.nextId++, type, question: '', options: type === 'multiple_choice' ? { A: '', B: '', C: '', D: '' } : {}, answer: '', open: true, imageName: '' });
    },
    removeQuestion(id) { if (this.questions.length > 1) this.questions = this.questions.filter(q => q.id !== id); },
    duplicateQuestion(id) {
        const q = this.questions.find(x => x.id === id);
        if (q) this.questions.push({ id: this.nextId++, type: q.type, question: q.question + ' (salinan)', options: { ...q.options }, answer: q.answer, open: true, imageName: '' });
    },
    handleQuestionImage(e, q) { const f = e.target.files[0]; if (f) { q.imageName = f.name; q.imagePreview = URL.createObjectURL(f); } },
    removeQuestionImage(q) { q.imageName = ''; q.imagePreview = ''; },

    handleFile(e) {
        const file = e.target.files[0];
        if (file) this.fileName = file.name;
    },

    resetForm() {
        this.tipeMateri = '';
        this.judulMateri = '';
        this.deskripsi = '';
        this.minggu = '';
        this.deadline = '';
        this.fileName = '';
        this.linkVideo = '';
        this.durasi = '30';
        this.questions = [{ id: 1, type: 'multiple_choice', question: '', options: { A: '', B: '', C: '', D: '' }, answer: '', open: true, imageName: '' }];
        this.nextId = 2;
    },

    submitForm() {
        this.showSuccess = true;
        setTimeout(() => {
            this.showSuccess = false;
            this.resetForm();
        }, 3000);
    }
}" x-init="document.documentElement.classList.toggle('dark', dark)" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">

        <!-- ===== LEFT PANEL ===== -->
        <x-leftPanel />

        <!-- ===== MAIN CONTENT ===== -->
        <div class="flex flex-1 min-w-0 overflow-hidden">

            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">

                <!-- Topbar -->
                <div
                    class="flex items-center gap-3 px-4 py-3 bg-gray-100 dark:bg-[#1A1A2E] border-b border-black/5 dark:border-white/5 flex-shrink-0 transition-all duration-300">
                    <!-- Mobile left toggle -->
                    <button onclick="document.getElementById('leftPanel').classList.toggle('-translate-x-full')"
                        class="md:hidden w-9 h-9 flex items-center justify-center rounded-lg bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <line x1="3" y1="12" x2="21" y2="12" />
                            <line x1="3" y1="18" x2="21" y2="18" />
                        </svg>
                    </button>

                    <!-- Search -->
                    <div
                        class="flex-1 flex items-center gap-2 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 flex-shrink-0"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                        <input type="text" placeholder="Cari course, tugas, materi..."
                            class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                    </div>

                    <!-- Notification -->
                    <button
                        class="relative w-9 h-9 flex items-center justify-center rounded-lg bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-primary transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- Dark mode toggle -->
                    <button @click="toggleDark()"
                        class="w-14 h-8 flex items-center rounded-full p-1 transition-all duration-300"
                        :class="dark ? 'bg-gray-700' : 'bg-gray-300'">
                        <div :class="dark ? 'translate-x-6' : 'translate-x-0'"
                            class="w-6 h-6 bg-white dark:bg-[#1A1A2E] rounded-full shadow-md transform transition-all duration-300 flex items-center justify-center">
                            <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4 text-gray-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                            </svg>
                            <svg x-show="dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4 text-yellow-300">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                            </svg>
                        </div>
                    </button>

                    <!-- Mobile right toggle -->
                    <button onclick="document.getElementById('rightPanel').classList.toggle('translate-x-full')"
                        class="lg:hidden w-9 h-9 flex items-center justify-center rounded-lg bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                    </button>
                </div>

                <!-- Scrollable content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    <!-- Success Alert -->
                    <div x-show="showSuccess" x-transition
                        class="p-4 rounded-xl bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600 dark:text-green-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm font-medium text-green-700 dark:text-green-300">Materi berhasil diupload!</p>
                    </div>

                    <!-- Header -->
                    <section>
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Upload Materi</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tambahkan materi baru ke dalam kursus</p>
                            </div>
                            <a href="/instruktur/detail-kursus"
                                class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </a>
                        </div>
                    </section>

                    <!-- Form Upload -->
                    <section>
                        <div class="card-fix p-6 space-y-6">

                            <!-- Tipe Materi -->
                            <div>
                                <label class="label dark:text-white">Tipe Materi <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                    <template x-for="tipe in [
                                        { value: 'dokumen', label: 'Dokumen', icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', color: 'red' },
                                        { value: 'video', label: 'Video', icon: 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z', color: 'blue' },
                                        { value: 'tugas', label: 'Tugas', icon: 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z', color: 'purple' },
                                        { value: 'kuis', label: 'Kuis', icon: 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', color: 'amber' }
                                    ]" :key="tipe.value">
                                        <button type="button" @click="tipeMateri = tipe.value"
                                            class="p-4 rounded-xl border-2 text-center transition-all duration-200 flex flex-col items-center gap-2"
                                            :class="tipeMateri === tipe.value
                                                ? 'border-primary bg-primary/5 dark:bg-primary/10 text-primary'
                                                : 'border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 hover:border-gray-300 dark:hover:border-gray-600'">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" :d="tipe.icon" />
                                            </svg>
                                            <span class="text-xs font-semibold" x-text="tipe.label"></span>
                                        </button>
                                    </template>
                                </div>
                            </div>

                            <!-- Judul + Minggu -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="md:col-span-2">
                                    <label class="label dark:text-white">Judul Materi <span class="text-red-500">*</span></label>
                                    <input type="text" x-model="judulMateri" placeholder="Contoh: Pengenalan HTML Dasar" class="input">
                                </div>
                                <div>
                                    <label class="label dark:text-white">Minggu Ke <span class="text-red-500">*</span></label>
                                    <select x-model="minggu" class="input">
                                        <option value="">Pilih Minggu</option>
                                        <option value="1">Minggu 1</option>
                                        <option value="2">Minggu 2</option>
                                        <option value="3">Minggu 3</option>
                                        <option value="4">Minggu 4</option>
                                        <option value="5">Minggu 5</option>
                                        <option value="6">Minggu 6</option>
                                        <option value="7">Minggu 7</option>
                                        <option value="8">Minggu 8</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label class="label dark:text-white">Deskripsi</label>
                                <textarea x-model="deskripsi" rows="4" placeholder="Tuliskan deskripsi atau instruksi materi..." class="textarea"></textarea>
                            </div>

                            <!-- Deadline (hanya untuk Tugas & Kuis) -->
                            <div x-show="tipeMateri === 'tugas' || tipeMateri === 'kuis'" x-transition>
                                <label class="label dark:text-white">Deadline <span class="text-red-500">*</span></label>
                                <input type="datetime-local" x-model="deadline" class="input">
                            </div>

                            <!-- ========== NON-KUIS FIELDS ========== -->
                            <div x-show="tipeMateri !== 'kuis'" x-transition>

                                <!-- Link Video (hanya untuk Video) -->
                                <div x-show="tipeMateri === 'video'" x-transition class="mb-6">
                                    <label class="label dark:text-white">Link Video (YouTube / Vimeo)</label>
                                    <input type="url" x-model="linkVideo" placeholder="https://youtube.com/watch?v=..." class="input">
                                    <p class="text-xs text-gray-400 mt-1">Opsional: Masukkan link jika video berasal dari platform eksternal</p>
                                </div>

                                <!-- Upload File -->
                                <div>
                                    <label class="label dark:text-white">Upload File</label>
                                    <label
                                        class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed rounded-xl cursor-pointer transition-all duration-200 hover:border-primary"
                                        :class="fileName ? 'border-primary bg-primary/5 dark:bg-primary/10' : 'border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-[#1A1A2E]'">
                                        <template x-if="!fileName">
                                            <div class="flex flex-col items-center justify-center py-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <p class="text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold text-primary">Klik untuk upload</span> atau drag & drop</p>
                                                <p class="text-xs text-gray-400 mt-1">PDF, DOCX, PPTX, MP4, ZIP (Maks. 50MB)</p>
                                            </div>
                                        </template>
                                        <template x-if="fileName">
                                            <div class="flex items-center gap-3 py-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-semibold text-primary" x-text="fileName"></p>
                                                    <p class="text-xs text-gray-400">Klik untuk mengganti file</p>
                                                </div>
                                            </div>
                                        </template>
                                        <input type="file" class="hidden" @change="handleFile($event)">
                                    </label>
                                </div>
                            </div>

                            <!-- ========== KUIS BUILDER ========== -->
                            <div x-show="tipeMateri === 'kuis'" x-transition>

                                <!-- Durasi -->
                                <div class="mb-6">
                                    <label class="label dark:text-white">Durasi Pengerjaan (menit)</label>
                                    <input type="number" x-model="durasi" placeholder="30" min="5" max="180" class="input">
                                </div>

                                <!-- Daftar Pertanyaan -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold dark:text-white flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        Daftar Pertanyaan
                                        <span class="text-xs font-normal text-gray-400" x-text="'(' + questions.length + ' soal)'"></span>
                                    </h4>
                                </div>

                                <div class="space-y-4">
                                    <template x-for="(q, index) in questions" :key="q.id">
                                        <div class="rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden bg-gray-50 dark:bg-[#1A1A2E]">

                                            <!-- Question Header -->
                                            <div class="flex items-center justify-between px-4 py-3 bg-white dark:bg-[#1A1A2E] border-b border-gray-200 dark:border-gray-700">
                                                <div @click="q.open = !q.open" class="flex items-center gap-3 cursor-pointer flex-1">
                                                    <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-xs" x-text="index + 1"></div>
                                                    <div>
                                                        <p class="font-semibold text-sm dark:text-white" x-text="q.type === 'multiple_choice' ? 'Pilihan Ganda' : 'Essay'"></p>
                                                        <p class="text-xs text-gray-400 truncate max-w-[200px]" x-text="q.question || 'Belum ada pertanyaan'"></p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <button @click="duplicateQuestion(q.id)" class="w-7 h-7 flex items-center justify-center rounded text-gray-400 hover:text-blue-500 transition">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
                                                    </button>
                                                    <button @click="removeQuestion(q.id)" class="w-7 h-7 flex items-center justify-center rounded text-gray-400 hover:text-red-500 transition" :class="questions.length <= 1 ? 'opacity-30' : ''">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                                                    </button>
                                                    <button @click="q.open = !q.open" class="w-7 h-7 flex items-center justify-center">
                                                        <svg :class="q.open ? 'rotate-180' : ''" class="w-3.5 h-3.5 text-gray-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Question Body -->
                                            <div x-show="q.open" x-transition class="p-4 space-y-4">

                                                <!-- Pertanyaan -->
                                                <div>
                                                    <label class="label dark:text-white">Pertanyaan <span class="text-red-500">*</span></label>
                                                    <textarea x-model="q.question" rows="2" placeholder="Tuliskan pertanyaan..." class="textarea"></textarea>
                                                </div>

                                                <!-- Upload Gambar Soal -->
                                                <div>
                                                    <label class="label dark:text-white">Gambar Soal (Opsional)</label>
                                                    <template x-if="!q.imageName">
                                                        <label class="flex items-center gap-3 p-3 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:border-primary transition">
                                                            <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                            <span class="text-sm text-gray-500"><span class="text-primary font-medium">Upload gambar</span> — PNG, JPG (Maks. 5MB)</span>
                                                            <input type="file" accept="image/*" class="hidden" @change="handleQuestionImage($event, q)">
                                                        </label>
                                                    </template>
                                                    <template x-if="q.imageName">
                                                        <div class="flex items-center gap-3 p-3 border border-primary/30 bg-primary/5 rounded-lg">
                                                            <img :src="q.imagePreview" class="w-16 h-16 object-cover rounded-lg border border-gray-200 dark:border-gray-700">
                                                            <div class="flex-1">
                                                                <p class="text-sm font-medium text-primary" x-text="q.imageName"></p>
                                                                <p class="text-xs text-gray-400">Gambar berhasil diupload</p>
                                                            </div>
                                                            <button @click="removeQuestionImage(q)" class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-100 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition">
                                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                                            </button>
                                                        </div>
                                                    </template>
                                                </div>

                                                <!-- PG Options -->
                                                <template x-if="q.type === 'multiple_choice'">
                                                    <div class="space-y-3">
                                                        <label class="label dark:text-white">Opsi Jawaban</label>
                                                        <template x-for="key in ['A', 'B', 'C', 'D']" :key="key">
                                                            <div class="flex items-center gap-2">
                                                                <div class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold shrink-0"
                                                                    :class="q.answer === key ? 'bg-green-500 text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-500'">
                                                                    <span x-text="key"></span>
                                                                </div>
                                                                <input type="text" x-model="q.options[key]" :placeholder="'Opsi ' + key" class="input flex-1">
                                                                <button @click="q.answer = key"
                                                                    class="text-xs px-2 py-1 rounded border transition"
                                                                    :class="q.answer === key ? 'bg-green-500 text-white border-green-500' : 'border-gray-300 dark:border-gray-600 text-gray-400 hover:text-green-500'">
                                                                    <span x-text="q.answer === key ? '✓ Benar' : 'Jawaban'"></span>
                                                                </button>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </template>

                                                <!-- Essay -->
                                                <template x-if="q.type === 'essay'">
                                                    <div>
                                                        <label class="label dark:text-white">Kunci Jawaban (Opsional)</label>
                                                        <textarea x-model="q.answer" rows="2" placeholder="Panduan penilaian untuk soal essay..." class="textarea"></textarea>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                                <!-- Add Question Buttons -->
                                <div class="flex items-center gap-3 mt-4 mb-2">
                                    <button @click="addQuestion('multiple_choice')"
                                        class="flex-1 py-2.5 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600 text-xs font-medium text-gray-500 hover:border-primary hover:text-primary transition flex items-center justify-center gap-2">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                        + Pilihan Ganda
                                    </button>
                                    <button @click="addQuestion('essay')"
                                        class="flex-1 py-2.5 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600 text-xs font-medium text-gray-500 hover:border-amber-500 hover:text-amber-500 transition flex items-center justify-center gap-2">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                        + Essay
                                    </button>
                                </div>

                                <!-- Soal Counter -->
                                <p class="text-xs text-gray-400 mb-2">
                                    Total: <span class="font-semibold text-primary" x-text="questions.length"></span> soal
                                    (<span x-text="questions.filter(q => q.type === 'multiple_choice').length"></span> PG,
                                    <span x-text="questions.filter(q => q.type === 'essay').length"></span> Essay)
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <a href="/instruktur/detail-kursus"
                                    class="px-6 py-2.5 rounded-xl text-sm font-medium border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    Batal
                                </a>
                                <button @click="submitForm()"
                                    class="px-6 py-2.5 rounded-xl text-sm font-medium bg-primary text-white hover:opacity-90 transition flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span x-text="tipeMateri === 'kuis' ? 'Simpan Kuis' : 'Upload Materi'"></span>
                                </button>
                            </div>

                        </div>
                    </section>

                </div><!-- end scrollable -->
            </main>

            <!-- ===== RIGHT PANEL ===== -->
            <x-rightPanel />

        </div><!-- end inner flex -->

    </div><!-- end outer flex -->

</body>

</html>
