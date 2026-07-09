<div class="space-y-6">

    {{-- Tipe Materi — hidden when type is pre-selected (edit mode or specific create button) --}}
    @php $lockedTipe = $item || $tipe; @endphp
    <div @if ($lockedTipe) style="display:none" @endif>
        <label class="label dark:text-white">Tipe Konten <span class="text-red-500">*</span></label>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach ([['value' => 'dokumen', 'label' => 'Dokumen', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'], ['value' => 'video', 'label' => 'Video', 'icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'], ['value' => 'tugas', 'label' => 'Tugas', 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'], ['value' => 'kuis', 'label' => 'Kuis', 'icon' => 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z']] as $opt)
                <button type="button" @click="tipeMateri = '{{ $opt['value'] }}'"
                    class="p-4 rounded-xl border-2 text-center transition-all duration-200 flex flex-col items-center gap-2"
                    :class="tipeMateri === '{{ $opt['value'] }}'
                        ?
                        'border-primary bg-primary/5 dark:bg-primary/10 text-primary' :
                        'border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 hover:border-gray-300'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $opt['icon'] }}" />
                    </svg>
                    <span class="text-xs font-semibold">{{ $opt['label'] }}</span>
                </button>
            @endforeach
        </div>
    </div>

    {{-- Judul --}}
    <div>
        <label class="label dark:text-white">Judul <span class="text-red-500">*</span></label>
        <input type="text" name="judul" x-model="judulMateri" placeholder="Judul konten..." class="input"
            required>
    </div>

    {{-- Deskripsi --}}
    <div x-show="tipeMateri !== 'dokumen' && tipeMateri !== 'tautan'">
        <label class="label dark:text-white">Deskripsi</label>
        <textarea name="deskripsi" x-model="deskripsi" rows="3" placeholder="Deskripsi atau instruksi..."
            class="textarea"></textarea>
    </div>

    {{-- Minggu (Hidden since it's pre-selected from the URL) --}}
    <input type="hidden" name="minggu_ke" x-model="minggu">
    <input type="hidden" name="posisi" x-model="posisi">



    {{-- Tanggal Mulai (tugas) --}}
    <div x-show="tipeMateri === 'tugas'" x-transition>
        <label class="label dark:text-white">Tanggal Mulai</label>
        <input type="text" name="tanggal_mulai" x-model="tanggalMulaiTugas" class="input flatpickr-datetime"
            placeholder="Pilih tanggal dan waktu">
        <p class="text-xs text-gray-400 mt-1">Kapan tugas mulai bisa diakses peserta.</p>
    </div>

    {{-- Deadline (tugas) --}}
    <div x-show="tipeMateri === 'tugas'" x-transition>
        <label class="label dark:text-white">Batas Waktu (Deadline)</label>
        <input type="text" name="batas_waktu" x-model="deadline" class="input flatpickr-datetime"
            placeholder="Pilih tanggal dan waktu">
        <p class="text-xs text-gray-400 mt-1">Kapan tugas terakhir bisa dikumpulkan.</p>
    </div>

    {{-- Durasi (kuis) --}}
    <div x-show="tipeMateri === 'kuis'" x-transition>
        <label class="label dark:text-white">Durasi Pengerjaan (menit)</label>
        <input type="number" name="batas_waktu_menit" x-model="batas_waktu_menit" placeholder="Contoh: 30"
            min="1" max="300" class="input">
    </div>

    {{-- Tanggal Mulai (kuis) --}}
    <div x-show="tipeMateri === 'kuis'" x-transition>
        <label class="label dark:text-white">Tanggal Mulai</label>
        <input type="text" name="tanggal_mulai" x-model="tanggalMulaiKuis" class="input flatpickr-datetime"
            placeholder="Pilih tanggal dan waktu">
        <p class="text-xs text-gray-400 mt-1">Kapan kuis mulai bisa diakses peserta.</p>
    </div>

    {{-- Batas Waktu / Deadline (kuis) --}}
    <div x-show="tipeMateri === 'kuis'" x-transition>
        <label class="label dark:text-white">Batas Waktu (Deadline)</label>
        <input type="text" name="batas_waktu_kuis" x-model="batasWaktuKuis" class="input flatpickr-datetime"
            placeholder="Pilih tanggal dan waktu">
        <p class="text-xs text-gray-400 mt-1">Kapan kuis ditutup / tidak bisa diakses lagi.</p>
    </div>

    {{-- ===== MATERI: Link / File ===== --}}
    <div x-show="tipeMateri === 'video' || tipeMateri === 'tautan'" x-transition>
        <label class="label dark:text-white">URL / Link <span x-show="tipeMateri === 'tautan'"
                class="text-red-500">*</span></label>
        <input type="url" name="url_file" x-model="linkVideo" placeholder="https://..."
            :disabled="tipeMateri !== 'video' && tipeMateri !== 'tautan'" class="input">
        <p class="text-xs text-gray-400 mt-1">YouTube, Vimeo, atau tautan eksternal lainnya.</p>
    </div>

    <div x-show="tipeMateri === 'dokumen'" x-transition>
        <label class="label dark:text-white">Upload File</label>
        <label
            class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed rounded-xl cursor-pointer transition-all duration-200 hover:border-primary relative"
            x-data="{ isDragging: false }" @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
            @drop.prevent="isDragging = false; if($event.dataTransfer.files.length) { $refs.fileInput.files = $event.dataTransfer.files; handleFile({target: {files: $event.dataTransfer.files}}) }"
            :class="[
                fileName ? 'border-primary bg-primary/5 dark:bg-primary/10' :
                'border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-[#1A1A2E]',
                isDragging ? 'border-primary bg-primary/10 dark:bg-primary/20 scale-[1.02]' : ''
            ]">
            <template x-if="!fileName">
                <div class="flex flex-col items-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400 mb-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    <p class="text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold text-primary">Klik
                            untuk upload</span> atau drag & drop</p>
                    <p class="text-xs text-gray-400 mt-1">PDF, DOCX, PPTX, ZIP (Maks. 50MB)</p>
                </div>
            </template>
            <template x-if="fileName">
                <div class="flex items-center gap-3 py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-primary" x-text="fileName"></p>
                        <p class="text-xs text-gray-400">Klik untuk mengganti file</p>
                    </div>
                </div>
            </template>
            <input type="file" x-ref="fileInput" name="file" class="hidden" accept=".pdf,.docx,.pptx,.zip"
                @change="handleFile($event)">
        </label>
        @if ($tipe === 'materi' && $item && $item->url_file)
            <p class="text-xs text-gray-400 mt-2">File saat ini: <span
                    class="text-primary">{{ basename($item->url_file) }}</span> (kosongkan untuk mempertahankan)</p>
        @endif
    </div>

    {{-- ===== KUIS: Question Builder ===== --}}
    <div x-show="tipeMateri === 'kuis'" x-transition>
        <h4 class="text-sm font-semibold dark:text-white mb-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            Daftar Pertanyaan
            <span class="text-xs font-normal text-gray-400" x-text="'(' + questions.length + ' soal)'"></span>
        </h4>

        <div class="space-y-4">
            <template x-for="(q, index) in questions" :key="q.id">
                <div
                    class="rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden bg-gray-50 dark:bg-[#1A1A2E]">
                    <div
                        class="flex items-center justify-between px-4 py-3 bg-white dark:bg-[#1A1A2E] border-b border-gray-200 dark:border-gray-700">
                        <div @click="q.open = !q.open" class="flex items-center gap-3 cursor-pointer flex-1">
                            <div class="relative">
                                <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-xs"
                                    x-text="index + 1"></div>
                                <span x-show="q.type === 'multiple_choice' && !q.answer"
                                    class="absolute -top-1 -right-1 w-3 h-3 rounded-full bg-red-500"></span>
                            </div>
                            <div>
                                <p class="font-semibold text-sm dark:text-white"
                                    x-text="q.type === 'multiple_choice' ? 'Pilihan Ganda' : 'Essay'"></p>
                                <p class="text-xs truncate max-w-[200px]"
                                    :class="q.type === 'multiple_choice' && !q.answer ? 'text-red-400' : 'text-gray-400'"
                                    x-text="q.type === 'multiple_choice' && !q.answer ? 'Belum ada jawaban benar' : (q.question || 'Belum ada pertanyaan')">
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <button type="button" @click="duplicateQuestion(q.id)"
                                class="w-7 h-7 flex items-center justify-center rounded text-gray-400 hover:text-blue-500 transition">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <rect x="9" y="9" width="13" height="13" rx="2" />
                                    <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1" />
                                </svg>
                            </button>
                            <button type="button" @click="removeQuestion(q.id)" :disabled="questions.length <= 1"
                                class="w-7 h-7 flex items-center justify-center rounded text-gray-400 hover:text-red-500 transition"
                                :class="questions.length <= 1 ? 'opacity-30' : ''">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <polyline points="3 6 5 6 21 6" />
                                    <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6" />
                                    <path d="M10 11v6" />
                                    <path d="M14 11v6" />
                                </svg>
                            </button>
                            <button type="button" @click="q.open = !q.open"
                                class="w-7 h-7 flex items-center justify-center">
                                <svg :class="q.open ? 'rotate-180' : ''" class="w-3.5 h-3.5 text-gray-500 transition"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div x-show="q.open" x-transition class="p-4 space-y-4">
                        <div>
                            <label class="label dark:text-white">Pertanyaan <span
                                    class="text-red-500">*</span></label>
                            <textarea x-model="q.question" rows="2" placeholder="Tuliskan pertanyaan..." class="textarea" :required="tipeMateri === 'kuis'"></textarea>
                        </div>

                        <template x-if="q.type === 'multiple_choice'">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <label class="label dark:text-white">Opsi Jawaban</label>
                                    <span x-show="!q.answer" class="text-xs text-red-500 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                                        </svg>
                                        Pilih jawaban benar
                                    </span>
                                    <span x-show="q.answer"
                                        class="text-xs text-green-600 dark:text-green-400 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Jawaban: <span class="font-bold" x-text="q.answer"></span>
                                    </span>
                                </div>
                                <template x-for="key in ['A', 'B', 'C', 'D']" :key="key">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded flex items-center justify-center text-xs font-bold shrink-0"
                                            :class="q.answer === key ? 'bg-green-500 text-white' :
                                                'bg-gray-100 dark:bg-gray-800 text-gray-500'">
                                            <span x-text="key"></span>
                                        </div>
                                        <input type="text" x-model="q.options[key]" :placeholder="'Opsi ' + key"
                                            class="input flex-1">
                                        <button type="button" @click="q.answer = key"
                                            class="text-xs px-2 py-1 rounded border transition"
                                            :class="q.answer === key ? 'bg-green-500 text-white border-green-500' :
                                                'border-gray-300 dark:border-gray-600 text-gray-400 hover:text-green-500'">
                                            <span x-text="q.answer === key ? '✓ Benar' : 'Jawaban'"></span>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </template>

                        <template x-if="q.type === 'essay'">
                            <div class="space-y-3">

                                <div>
                                    <label class="label dark:text-white">
                                        Kunci Jawaban
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <textarea x-model="q.answer" rows="2" placeholder="Panduan penilaian untuk soal essay..." class="textarea"
                                        required></textarea>
                                </div>

                                <!-- CASE SENSITIVE -->
                                <label class="flex items-start gap-3">

                                    <input type="checkbox" x-model="q.case_sensitive"
                                        class="mt-1 rounded border-gray-300 text-primary focus:ring-primary">

                                    <div>

                                        <p class="text-sm font-medium dark:text-white">
                                            Case Sensitive
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            Jika diaktifkan, jawaban harus sama persis termasuk huruf besar dan huruf
                                            kecil.
                                        </p>

                                    </div>

                                </label>

                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>

        <div class="flex items-center gap-3 mt-4">
            <button type="button" @click="addQuestion('multiple_choice')"
                class="flex-1 py-2.5 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600 text-xs font-medium text-gray-500 hover:border-primary hover:text-primary transition flex items-center justify-center gap-2">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                + Pilihan Ganda
            </button>
            <button type="button" @click="addQuestion('essay')"
                class="flex-1 py-2.5 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600 text-xs font-medium text-gray-500 hover:border-amber-500 hover:text-amber-500 transition flex items-center justify-center gap-2">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                + Essay
            </button>
        </div>
        <p class="text-xs text-gray-400 mt-2">
            Total: <span class="font-semibold text-primary" x-text="questions.length"></span> soal
            (<span x-text="questions.filter(q => q.type === 'multiple_choice').length"></span> PG,
            <span x-text="questions.filter(q => q.type === 'essay').length"></span> Essay)
        </p>
    </div>

</div>
