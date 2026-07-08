<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item ? 'Edit Konten' : 'Tambah Konten' }} - Instruktur</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body x-data="uploadApp()" x-init="init()"
    class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">
        <x-leftPanel />

        <div class="flex flex-1 min-w-0 overflow-hidden">
            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">
                <x-topNav />

                <div class="flex-1 overflow-y-auto p-5 space-y-5">



                    {{-- Header --}}
                    <section>
                        <div class="flex items-center justify-between">
                            <div>
                                <a href="{{ route('instruktur.kursus.show', $kursus->id) }}"
                                    class="text-xs text-gray-400 hover:text-primary flex items-center gap-1 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                                    {{ $kursus->nama }}
                                </a>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                    {{ $item ? 'Edit Konten' : 'Tambah Konten' }}
                                </h3>
                            </div>
                        </div>
                    </section>

                    {{-- Client-side validation error --}}
                    <div x-show="validationError" x-cloak
                        class="p-4 rounded-xl bg-red-100 dark:bg-red-900/30 border border-red-300 dark:border-red-700 text-sm text-red-700 dark:text-red-300 flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                        <span x-text="validationError"></span>
                    </div>

                    {{-- Form --}}
                    <section>
                        <div class="card-fix p-6 space-y-6">

                            @if($item)
                                {{-- EDIT MODE --}}
                                @php
                                    $updateRoute = route('instruktur.kursus.konten.update', [$kursus->id, $tipe, $item->id]);
                                    $tipoInit    = match($tipe) {
                                        'materi' => $item->tipe ?? 'dokumen',
                                        'tugas'  => 'tugas',
                                        'kuis'   => 'kuis',
                                        default  => 'dokumen',
                                    };
                                @endphp
                                <form method="POST" action="{{ $updateRoute }}" enctype="multipart/form-data"
                                    @submit.prevent="submitForm($event)">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="tipe_materi" x-bind:value="tipeMateri">
                                    <input type="hidden" name="questions_json" x-bind:value="tipeMateri === 'kuis' ? JSON.stringify(questions) : ''">
                                    @include('instruktur.partials.upload-form-fields')
                                    @include('instruktur.partials.upload-form-actions')
                                </form>
                            @else
                                {{-- CREATE MODE --}}
                                <form method="POST" action="{{ route('instruktur.kursus.konten.store', $kursus->id) }}" enctype="multipart/form-data"
                                    @submit.prevent="submitForm($event)">
                                    @csrf
                                    <input type="hidden" name="tipe_materi" x-bind:value="tipeMateri">
                                    <input type="hidden" name="questions_json" x-bind:value="tipeMateri === 'kuis' ? JSON.stringify(questions) : ''">
                                    @include('instruktur.partials.upload-form-fields')
                                    @include('instruktur.partials.upload-form-actions')
                                </form>
                            @endif

                        </div>
                    </section>

                </div>
            </main>

            <x-rightPanel />
        </div>
    </div>

    @php
        $jsInitTipe   = $tipoInit ?? ($tipe === 'tugas' ? 'tugas' : ($tipe === 'kuis' ? 'kuis' : 'dokumen'));
        $jsInitMinggu = $tipe === 'materi' && $item
            ? optional($item->minggu)->nomor_minggu
            : ($tipe === 'kuis' && $item ? optional($item->minggu)->nomor_minggu : (request('minggu') ?? ''));
        $jsInitKuis = null;
        if ($tipe === 'kuis' && $item) {
            $jsInitKuis = $item->pertanyaanKuis->map(function ($p) {
                $pilihanList    = $p->pilihanJawaban;
                $correctPilihan = $pilihanList->where('adalah_benar', true)->first();
                $answerLetter   = $correctPilihan
                    ? chr(65 + $pilihanList->search(fn($x) => $x->id === $correctPilihan->id))
                    : '';
                return [
                    'id'              => $p->id,
                    'type'            => $p->tipe_pertanyaan === 'esai' ? 'essay' : 'multiple_choice',
                    'tipe_pertanyaan' => $p->tipe_pertanyaan,
                    'question'        => $p->teks_pertanyaan,
                    'options'         => $pilihanList->count()
                        ? $pilihanList->mapWithKeys(fn($o, $i) => [chr(65 + $i) => $o->teks_pilihan])->toArray()
                        : ['A' => '', 'B' => '', 'C' => '', 'D' => ''],
                    'answer'          => $p->tipe_pertanyaan === 'esai'
                        ? optional($p->kunciJawabanEsai->first())->teks_kunci
                        : $answerLetter,
                    'open'            => false,
                    'imageName'       => '',
                ];
            })->values();
        }
    @endphp

    <script>
        const _initialTipe   = @json($jsInitTipe);
        const _initialMinggu = @json($jsInitMinggu);
        const _initialKuis   = @json($jsInitKuis);

        function uploadApp() {
            return {
                dark: localStorage.getItem('theme') === 'dark',
                tipeMateri: _initialTipe || '',
                judulMateri: @json($item?->judul ?? ''),
                deskripsi: @json($item?->deskripsi ?? ''),
                minggu: _initialMinggu ?? '',
                posisi: @json(request('posisi') ?? ''),
                validationError: '',
                tanggalMulaiTugas: @json(
                    $tipe === 'tugas' && $item && $item->tanggal_mulai
                        ? $item->tanggal_mulai->format('Y-m-d\TH:i')
                        : ''
                ),
                deadline: @json(
                    $tipe === 'tugas' && $item && $item->batas_waktu
                        ? $item->batas_waktu->format('Y-m-d\TH:i')
                        : ''
                ),
                nilai: @json($item?->nilai ?? ''),
                batas_waktu_menit: @json($tipe === 'kuis' && $item ? $item->batas_waktu_menit : ''),
                tanggalMulaiKuis: @json(
                    $tipe === 'kuis' && $item && $item->tanggal_mulai
                        ? $item->tanggal_mulai->format('Y-m-d\TH:i')
                        : ''
                ),
                batasWaktuKuis: @json(
                    $tipe === 'kuis' && $item && $item->batas_waktu
                        ? $item->batas_waktu->format('Y-m-d\TH:i')
                        : ''
                ),
                fileName: '',
                linkVideo: @json($tipe === 'materi' && $item ? ($item->url_file ?? '') : ''),

                questions: _initialKuis && _initialKuis.length
                    ? _initialKuis
                    : [{ id: 1, type: 'multiple_choice', tipe_pertanyaan: 'pilihan_ganda', question: '', options: { A: '', B: '', C: '', D: '' }, answer: '', open: true, imageName: '' }],
                nextId: 2,

                init() {
                    document.documentElement.classList.toggle('dark', this.dark);
                    if (_initialTipe) this.tipeMateri = _initialTipe;

                    this.$watch('tipeMateri', () => {
                        this.$nextTick(() => this.initFlatpickr());
                    });
                    this.$nextTick(() => this.initFlatpickr());
                },

                initFlatpickr() {
                    const elems = document.querySelectorAll('.flatpickr-datetime');
                    elems.forEach(el => {
                        if (el._flatpickr) el._flatpickr.destroy();
                        
                        const modelName = el.getAttribute('x-model');
                        
                        flatpickr(el, {
                            enableTime: true,
                            dateFormat: "Y-m-d H:i",
                            defaultDate: this[modelName] || null,
                            onChange: (selectedDates, dateStr) => {
                                this[modelName] = dateStr;
                            }
                        });
                    });
                },

                toggleDark() {
                    this.dark = !this.dark;
                    localStorage.setItem('theme', this.dark ? 'dark' : 'light');
                    document.documentElement.classList.toggle('dark', this.dark);
                },

                addQuestion(type) {
                    this.questions.push({
                        id: this.nextId++,
                        type,
                        tipe_pertanyaan: type === 'multiple_choice' ? 'pilihan_ganda' : 'esai',
                        question: '',
                        options: type === 'multiple_choice' ? { A: '', B: '', C: '', D: '' } : {},
                        answer: '',
                        open: true,
                        imageName: '',
                    });
                },

                removeQuestion(id) {
                    if (this.questions.length > 1) this.questions = this.questions.filter(q => q.id !== id);
                },

                duplicateQuestion(id) {
                    const q = this.questions.find(x => x.id === id);
                    if (q) this.questions.push({ ...q, id: this.nextId++, question: q.question + ' (salinan)', open: true });
                },

                handleFile(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const allowedExtensions = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'zip'];
                        const ext = file.name.split('.').pop().toLowerCase();
                        if (!allowedExtensions.includes(ext)) {
                            this.validationError = 'Format file tidak didukung! Hanya bisa PDF, DOCX, PPTX, dan ZIP.';
                            this.fileName = '';
                            if (this.$refs && this.$refs.fileInput) this.$refs.fileInput.value = '';
                            else e.target.value = '';
                            return;
                        }
                        this.fileName = file.name;
                        this.validationError = '';
                    }
                },

                submitForm(e) {
                    this.validationError = '';

                    if (this.tipeMateri === 'kuis') {
                        const unanswered = this.questions
                            .map((q, i) => ({ q, i }))
                            .filter(({ q }) =>
                                (q.type === 'multiple_choice' || q.tipe_pertanyaan === 'pilihan_ganda') &&
                                !q.answer
                            );

                        if (unanswered.length > 0) {
                            unanswered.forEach(({ q }) => q.open = true);
                            const nums = unanswered.map(({ i }) => i + 1).join(', ');
                            this.validationError = `Pilih jawaban benar untuk soal nomor: ${nums}.`;
                            e.target.closest('section').previousElementSibling?.scrollIntoView({ behavior: 'smooth' });
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            return;
                        }

                        e.target.querySelector('[name="questions_json"]').value = JSON.stringify(
                            this.questions.map(q => ({
                                tipe_pertanyaan: q.tipe_pertanyaan || (q.type === 'essay' ? 'esai' : 'pilihan_ganda'),
                                question: q.question,
                                options: q.options,
                                answer: q.answer,
                            }))
                        );
                    }

                    e.target.querySelector('[name="tipe_materi"]').value = this.tipeMateri;
                    e.target.submit();
                },
            };
        }
    </script>

</body>
</html>
