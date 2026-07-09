<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus - {{ $program->nama }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body x-data="kursusPage" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">
        <x-leftPanel />

        <main class="flex-1 flex flex-col overflow-hidden">

            <x-topNav />

            <!-- Content -->
            <div class="flex-1 overflow-y-auto">
                <div class="p-5 space-y-5">

                    <!-- Header -->
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Kursus Program {{ $program->nama }}</h1>
                            <p class="text-sm text-gray-500">Kelola kursus dalam program ini</p>
                        </div>
                        <button @click="openCreate()"
                            class="flex items-center gap-2 px-4 py-2 rounded-lg text-white text-sm font-medium transition hover:opacity-90"
                            style="background: #6C63FF">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Tambah Kursus
                        </button>
                    </div>

                    <!-- Success Message -->
                    <!-- Table Section -->
                    <div class="card translate-0 p-5">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left whitespace-nowrap">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-800">
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">No</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Nama Kursus</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase text-center">Instruktur</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase text-center">Nilai Kelulusan</th>
                                        <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-800 dark:text-gray-300">
                                    <template x-for="(item, index) in courses" :key="item.id">
                                        <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                            <td class="py-3 px-4" x-text="index + 1"></td>
                                            <td class="py-3 px-4 font-medium" x-text="item.nama"></td>
                                            <td class="py-3 px-4 text-gray-500 whitespace-normal max-w-xs" x-text="item.deskripsi ? item.deskripsi.substring(0, 60) + (item.deskripsi.length > 60 ? '...' : '') : '-'"></td>
                                            <td class="py-3 px-4 text-center">
                                                <div class="flex flex-wrap gap-1 justify-center">
                                                    <template x-if="item.instruktur_ids && item.instruktur_ids.length > 0">
                                                        <template x-for="insId in item.instruktur_ids" :key="insId">
                                                            <span class="px-2 py-1 bg-blue-100 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs font-medium rounded-full" x-text="getInstrukturName(insId)"></span>
                                                        </template>
                                                    </template>
                                                    <template x-if="!item.instruktur_ids || item.instruktur_ids.length === 0">
                                                        <span class="text-gray-400">-</span>
                                                    </template>
                                                </div>
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                <span class="px-2 py-1 bg-purple-100 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 text-xs font-medium rounded-full" x-text="Math.round(item.nilai)"></span>
                                            </td>
                                            <td class="py-3 px-4">
                                                <div class="flex justify-center gap-1">
                                                    <button @click="openEdit(item)"
                                                        class="group w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200"
                                                        title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                                        </svg>
                                                    </button>
                                                    <button @click="deleteCourse(item.id, item.nama)"
                                                        class="group w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200"
                                                        title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M10 11v6"/><path d="M14 11v6"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                    <template x-if="courses.length === 0">
                                        <tr>
                                            <td colspan="6" class="py-8 text-center text-gray-400 text-sm">Belum ada kursus dalam program ini.</td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </main>

        <x-rightPanel />
    </div>

    <!-- Create / Edit Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0" x-cloak>
        <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="showModal = false"></div>
        <div x-show="showModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative bg-white dark:bg-[#1A1A2E] rounded-xl shadow-xl w-full max-w-lg border border-gray-200 dark:border-gray-800 p-6 max-h-[90vh] overflow-y-auto">

            <div class="flex justify-between items-center mb-5">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white"
                    x-text="modalMode === 'create' ? 'Tambah Kursus' : 'Edit Kursus'"></h3>
                <button @click="showModal = false" :disabled="submitting"
                    class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-gray-800/50 rounded-full transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="space-y-4">
                <!-- Nama Kursus -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Kursus <span class="text-red-400">*</span></label>
                    <input type="text" x-model="form.nama" :disabled="submitting"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white text-sm outline-none focus:border-primary transition"
                        placeholder="Masukkan nama kursus">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi <span class="text-red-400">*</span></label>
                    <textarea x-model="form.deskripsi" rows="3" :disabled="submitting"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white text-sm outline-none focus:border-primary transition resize-none"
                        placeholder="Deskripsi kursus (opsional)"></textarea>
                </div>

                <!-- Nilai Kelulusan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nilai Kelulusan <span class="text-red-400">*</span> <span class="text-xs text-gray-400">(0–100, default 75)</span></label>
                    <input type="number" x-model.number="form.nilai" min="0" max="100" step="0.01" :disabled="submitting"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white text-sm outline-none focus:border-primary transition"
                        placeholder="75">
                </div>

                <!-- Instruktur (multi-select dropdown with checkboxes) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Instruktur <span class="text-red-400">*</span></label>
                    <div class="relative">
                        <button type="button" @click="showInstrukturDropdown = !showInstrukturDropdown" :disabled="submitting"
                            class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-sm text-left outline-none focus:border-primary transition">
                            <span class="text-gray-800 dark:text-white truncate"
                                x-text="form.instruktur_ids.length ? form.instruktur_ids.map(id => getInstrukturName(id)).join(', ') : 'Pilih instruktur...'"></span>
                            <svg class="w-4 h-4 text-gray-400 transition-transform" :class="showInstrukturDropdown ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="showInstrukturDropdown" @click.away="showInstrukturDropdown = false"
                            class="absolute z-10 w-full mt-1 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg max-h-48 overflow-y-auto">
                            <template x-for="ins in instructors" :key="ins.id">
                                <label class="flex items-center gap-3 px-4 py-2.5 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                    <input type="checkbox" :value="ins.id" :checked="form.instruktur_ids.includes(ins.id)"
                                        @change="toggleInstruktur(ins.id)" :disabled="submitting"
                                        class="rounded border-gray-300 dark:border-gray-700 text-[#6C63FF] focus:ring-[#6C63FF]">
                                    <img :src="ins.foto_profil ? '{{ asset('storage') }}/' + ins.foto_profil : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(ins.nama) + '&background=6C63FF&color=fff&size=64&font-size=0.4'" class="w-6 h-6 rounded-full object-cover flex-shrink-0" alt="">
                                    <span class="text-sm text-gray-800 dark:text-white" x-text="ins.nama"></span>
                                </label>
                            </template>
                            <template x-if="instructors.length === 0">
                                <p class="px-4 py-3 text-xs text-gray-400 text-center">Belum ada instruktur tersedia.</p>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Foto Kursus -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Foto Kursus <span x-show="modalMode === 'create'" class="text-red-400">*</span> <span class="text-xs text-gray-400">Maks. 2MB</span>
                    </label>
                    <input type="file" @change="form.foto = $event.target.files[0]" accept="image/jpeg,image/png,image/jpg,image/webp" :disabled="submitting"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white text-sm outline-none focus:border-primary transition file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                    <p class="text-xs text-gray-400 mt-1.5">Rasio disarankan 3:2 (misal: 600x400).</p>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200 dark:border-gray-800">
                <button @click="showModal = false" :disabled="submitting"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition">
                    Batal
                </button>
                <button @click="submitForm()" :disabled="submitting || !form.nama.trim() || (modalMode === 'create' && !form.foto)"
                    :class="(submitting || !form.nama.trim() || (modalMode === 'create' && !form.foto)) ? 'opacity-60 cursor-not-allowed' : ''"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-[#6C63FF] hover:bg-[#5a52d5] rounded-lg transition">
                    <template x-if="!submitting">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </template>
                    <template x-if="submitting">
                        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/></svg>
                    </template>
                    <span x-text="submitting ? 'Menyimpan...' : (modalMode === 'create' ? 'Tambah Kursus' : 'Simpan Perubahan')"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Alpine Component Script -->
    <script>
        // Server data
        const kursusData = @js($courses->map(fn($c) => [
            'id'             => $c->id,
            'nama'           => $c->nama,
            'deskripsi'      => $c->deskripsi ?? '',
            'nilai'          => (float) $c->nilai_kelulusan_kursus,
            'instruktur_ids' => $c->instruktur->pluck('id')->toArray(),
        ])->values());

        const instrukturList = @js($instructors->map(fn($i) => [
            'id'   => $i->id,
            'nama' => $i->pengguna?->nama ?? '-',
            'foto_profil' => $i->pengguna?->foto_profil ?? null,
        ])->values());

        const storeUrl  = "{{ route('admin.program.kursus.store', $program) }}";
        const baseUrl   = "{{ url('/admin/program/' . $program->id . '/kursus') }}";

        document.addEventListener('alpine:init', () => {
            Alpine.data('kursusPage', () => ({
                dark: localStorage.getItem('theme') === 'dark',
                toggleDark() {
                    this.dark = !this.dark;
                    localStorage.setItem('theme', this.dark ? 'dark' : 'light');
                    document.documentElement.classList.toggle('dark', this.dark);
                },
                courses: kursusData,
                instructors: instrukturList,
                showModal: false,
                modalMode: 'create',
                editId: null,
                submitting: false,
                showInstrukturDropdown: false,
                form: { nama: '', deskripsi: '', nilai: 75, instruktur_ids: [], foto: null },

                resetForm() {
                    this.form = { nama: '', deskripsi: '', nilai: 75, instruktur_ids: [], foto: null };
                    this.editId = null;
                    this.submitting = false;
                    this.showInstrukturDropdown = false;
                },

                openCreate() {
                    this.modalMode = 'create';
                    this.resetForm();
                    this.showModal = true;
                },

                openEdit(item) {
                    this.modalMode = 'edit';
                    this.resetForm();
                    this.editId = item.id;
                    this.form.nama = item.nama;
                    this.form.deskripsi = item.deskripsi;
                    this.form.nilai = item.nilai;
                    this.form.instruktur_ids = [...item.instruktur_ids];
                    this.showModal = true;
                },

                toggleInstruktur(id) {
                    const idx = this.form.instruktur_ids.indexOf(id);
                    if (idx === -1) this.form.instruktur_ids.push(id);
                    else this.form.instruktur_ids.splice(idx, 1);
                },

                getInstrukturName(id) {
                    const ins = this.instructors.find(i => i.id === id);
                    return ins ? ins.nama : '-';
                },

                async submitForm() {
                    if (this.submitting) return;
                    this.submitting = true;
                    try {
                        const url = this.modalMode === 'create'
                            ? storeUrl
                            : baseUrl + '/' + this.editId;

                        const formData = new FormData();
                        formData.append('nama', this.form.nama);
                        if (this.form.deskripsi) formData.append('deskripsi', this.form.deskripsi);
                        formData.append('nilai_kelulusan_kursus', this.form.nilai);
                        
                        this.form.instruktur_ids.forEach(id => {
                            formData.append('id_instruktur[]', id);
                        });

                        if (this.form.foto) {
                            formData.append('foto_kursus', this.form.foto);
                        }

                        if (this.modalMode === 'edit') {
                            formData.append('_method', 'PUT');
                        }

                        const res = await fetch(url, {
                            method: 'POST', // Always POST for FormData, override with _method if PUT
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: formData,
                        });
                        const data = await res.json();
                        if (res.ok && data.success) {
                            this.showModal = false;
                            setTimeout(() => location.reload(), 500);
                        } else {
                            alert(data.message || 'Terjadi kesalahan.');
                        }
                    } catch (e) {
                        alert('Terjadi kesalahan jaringan.');
                    } finally {
                        this.submitting = false;
                    }
                },

                async deleteCourse(id, nama) {
                    if (!confirm('Yakin hapus kursus "' + nama + '"?')) return;
                    try {
                        const res = await fetch(baseUrl + '/' + id, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                                'X-HTTP-Method-Override': 'DELETE',
                            },
                        });
                        const data = await res.json();
                        if (res.ok && data.success) {
                            setTimeout(() => location.reload(), 500);
                        } else {
                            alert(data.message || 'Gagal menghapus.');
                        }
                    } catch (e) {
                        alert('Terjadi kesalahan jaringan.');
                    }
                },
            }));
        });
    </script>

</body>
</html>
