<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periode Pembelajaran - Super Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
    </style>
</head>
<body x-data="semesterPage()" x-init="init()" class="min-h-screen bg-gray-50 dark:bg-[#0F0F1A] flex">

    <x-leftPanel />

    <main class="flex-1 flex flex-col overflow-hidden">
        <x-topNav />

        <div class="flex-1 overflow-y-auto">
            <div class="p-5 space-y-5">



                {{-- Header --}}
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 dark:text-white">Periode Pembelajaran</h1>
                        <p class="text-sm text-gray-500 mt-1">Kelola data periode pembelajaran (ganjil/genap)</p>
                    </div>
                </div>

                {{-- Search + Add --}}
                <div class="card translate-0 p-5">
                    <div class="flex items-center gap-3 mb-5">
                        <form action="{{ route('superAdmin.periodePembelajaran') }}" method="GET" class="flex-1 flex items-center gap-2 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 transition-all duration-300 focus-within:ring-2 focus-within:ring-primary focus-within:border-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari periode pembelajaran..." class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 w-full py-0.5">
                        </form>
                        <button @click="openCreate()" class="px-4 py-2 bg-[#6C63FF] hover:bg-[#5A52D9] dark:hover:bg-[#4b4bd9] rounded-lg text-sm font-medium transition flex items-center gap-2 text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            Tambah Periode
                        </button>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left whitespace-nowrap">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-800">
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Tahun Ajaran</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Jenis Periode</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Tanggal Mulai</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Tanggal Selesai</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800 dark:text-gray-300">
                                @forelse ($semesters as $index => $item)
                                    <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                        <td class="py-3 px-4">{{ $semesters->firstItem() + $index }}</td>
                                        <td class="py-3 px-4 font-medium">{{ $item->tahun }}</td>
                                        <td class="py-3 px-4">
                                            @if (strtolower($item->jenis) === 'ganjil')
                                                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs font-medium rounded-full">Ganjil</span>
                                            @else
                                                <span class="px-2 py-1 bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-xs font-medium rounded-full">Genap</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 text-gray-500">{{ $item->tanggal_mulai ? $item->tanggal_mulai->format('Y-m-d') : '-' }}</td>
                                        <td class="py-3 px-4 text-gray-500">{{ $item->tanggal_selesai ? $item->tanggal_selesai->format('Y-m-d') : '-' }}</td>
                                        <td class="py-3 px-4">
                                            <div class="flex justify-center gap-1">
                                                <button @click='openEdit(@json($item))'
                                                    class="group w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200"
                                                    title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                                    </svg>
                                                </button>
                                                <button @click="openDelete('{{ $item->id }}', '{{ $item->tahun }} {{ $item->jenis }}')"
                                                    class="group w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-8 text-center text-gray-500 text-sm">
                                            Belum ada data periode pembelajaran.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($semesters->hasPages())
                        <div class="mt-4">
                            {{ $semesters->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </main>

    <x-rightPanel />

    {{-- ============ MODAL CREATE / EDIT ============ --}}
    <div x-show="modal.show" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">
        <div @click.away="if (!$event.target.closest('.flatpickr-calendar')) modal.show = false" x-show="modal.show" x-transition
            class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-lg p-6 border border-gray-100 dark:border-gray-800">

            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6" x-text="modal.title"></h3>

            <form :action="modal.action" method="POST">
                @csrf
                <template x-if="modal.mode === 'edit'">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="space-y-4">
                    {{-- Tahun Ajaran --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tahun Ajaran <span class="text-red-500">*</span></label>
                        <input type="text" name="tahun" x-model="modal.data.tahun" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:outline-none focus:border-primary focus:ring-0 transition"
                            placeholder="Contoh: 2024/2025">
                    </div>

                    {{-- Jenis Semester --}}
                    <div x-data="{ open: false, options: [{id:'ganjil',nama:'Ganjil'},{id:'genap',nama:'Genap'}], get selectedLabel() { const f = this.options.find(o => o.id == modal.data.jenis); return f ? f.nama.charAt(0).toUpperCase() + f.nama.slice(1) : '' } }">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jenis Periode <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div @click="open = !open" @click.outside="open = false"
                                :class="open ? 'border-[#6C63FF]' : 'border-gray-300 dark:border-gray-700'"
                                class="w-full px-4 py-3 rounded-lg border bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white cursor-pointer flex items-center justify-between transition">
                                <span x-text="selectedLabel || 'Pilih jenis periode'" :class="!selectedLabel && 'text-gray-400'"></span>
                                <svg class="w-4 h-4 text-gray-400 transition" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                            <div x-show="open" x-transition class="absolute z-50 w-full mt-1 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg overflow-hidden">
                                <div class="max-h-[84px] overflow-y-auto">
                                    <template x-for="o in options" :key="o.id">
                                        <div @click="modal.data.jenis = o.id; open = false"
                                            class="px-4 py-2.5 text-sm cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                                            :class="modal.data.jenis == o.id ? 'bg-primary/10 text-primary font-medium' : 'text-gray-800 dark:text-white'"
                                            x-text="o.nama"></div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="jenis" :value="modal.data.jenis">
                    </div>

                    {{-- Tanggal Mulai --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Mulai <span class="text-red-500">*</span></label>
                        <input type="text" id="tanggal-mulai" name="tanggal_mulai" x-model="modal.data.tanggal_mulai" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:outline-none focus:border-primary focus:ring-0 transition"
                            placeholder="Pilih tanggal mulai">
                    </div>

                    {{-- Tanggal Selesai --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Selesai <span class="text-red-500">*</span></label>
                        <input type="text" id="tanggal-selesai" name="tanggal_selesai" x-model="modal.data.tanggal_selesai" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:outline-none focus:border-primary focus:ring-0 transition"
                            placeholder="Pilih tanggal selesai">
                    </div>
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="button" @click="modal.show = false"
                        class="inline-flex items-center justify-center gap-1.5 flex-1 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition font-medium">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-3 rounded-lg bg-[#6C63FF] hover:bg-[#5A52D9] text-white transition font-medium inline-flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
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

            <h3 class="text-xl font-bold text-center text-gray-800 dark:text-white mb-2">Hapus Data?</h3>
            <p class="text-sm text-center text-gray-500 mb-2">Anda akan menghapus periode pembelajaran:</p>
            <p class="text-sm text-center font-semibold text-gray-700 dark:text-gray-200 mb-6" x-text="deleteModal.nama"></p>

            <form :action="deleteModal.action" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex gap-3">
                    <button type="button" @click="deleteModal.show = false"
                        class="flex-1 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition font-medium">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition font-medium">
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function semesterPage() {
            return {
                dark: localStorage.getItem('theme') === 'dark',
                toggleDark() {
                    this.dark = !this.dark;
                    localStorage.setItem('theme', this.dark ? 'dark' : 'light');
                    document.documentElement.classList.toggle('dark', this.dark);
                },

                modal: {
                    show: false,
                    mode: 'create',
                    title: '',
                    action: '',
                    data: { tahun: '', jenis: '', tanggal_mulai: '', tanggal_selesai: '' }
                },
                deleteModal: {
                    show: false,
                    action: '',
                    nama: ''
                },

                init() {
                    document.documentElement.classList.toggle('dark', this.dark);
                },

                initFlatpickr() {
                    this.$nextTick(() => {
                        // Destroy existing instances
                        const mulaiEl = document.getElementById('tanggal-mulai');
                        const selesaiEl = document.getElementById('tanggal-selesai');
                        if (mulaiEl && mulaiEl._flatpickr) mulaiEl._flatpickr.destroy();
                        if (selesaiEl && selesaiEl._flatpickr) selesaiEl._flatpickr.destroy();

                        if (mulaiEl) {
                            flatpickr(mulaiEl, {
                                dateFormat: 'Y-m-d',
                                defaultDate: this.modal.data.tanggal_mulai || null,
                                onChange: (selectedDates, dateStr) => {
                                    this.modal.data.tanggal_mulai = dateStr;
                                }
                            });
                        }
                        if (selesaiEl) {
                            flatpickr(selesaiEl, {
                                dateFormat: 'Y-m-d',
                                defaultDate: this.modal.data.tanggal_selesai || null,
                                onChange: (selectedDates, dateStr) => {
                                    this.modal.data.tanggal_selesai = dateStr;
                                }
                            });
                        }
                    });
                },

                openCreate() {
                    this.modal = {
                        show: true,
                        mode: 'create',
                        title: 'Tambah Periode Pembelajaran',
                        action: '{{ route('superAdmin.periodePembelajaran.store') }}',
                        data: { tahun: '', jenis: '', tanggal_mulai: '', tanggal_selesai: '' }
                    };
                    this.initFlatpickr();
                },

                openEdit(item) {
                    // Format dates to YYYY-MM-DD for date input
                    const fmt = (d) => {
                        if (!d) return '';
                        return d.substring(0, 10);
                    };
                    this.modal = {
                        show: true,
                        mode: 'edit',
                        title: 'Edit Periode Pembelajaran',
                        action: '/super-admin/periode-pembelajaran/' + item.id,
                        data: {
                            tahun: item.tahun || '',
                            jenis: item.jenis || '',
                            tanggal_mulai: fmt(item.tanggal_mulai),
                            tanggal_selesai: fmt(item.tanggal_selesai)
                        }
                    };
                    // Force Alpine to re-evaluate select bindings after DOM update
                    this.$nextTick(() => {
                        this.modal.data.jenis = item.jenis || '';
                    });
                    this.initFlatpickr();
                },

                openDelete(id, nama) {
                    this.deleteModal = {
                        show: true,
                        action: '/super-admin/periode-pembelajaran/' + id,
                        nama: nama
                    };
                }
            };
        }
    </script>

</body>
</html>
