<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Microcredential - Super Admin</title>
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
    </style>
</head>
<body x-data="programPage()" x-init="init()" class="min-h-screen bg-gray-50 dark:bg-[#0F0F1A] flex">

    <x-leftPanel />

    <main class="flex-1 flex flex-col overflow-hidden">
        <x-topNav />

        <div class="flex-1 overflow-y-auto">
            <div class="p-5 space-y-5">

                {{-- Flash Success --}}
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                        x-transition
                        class="flex items-center gap-3 p-4 rounded-lg bg-green-100 dark:bg-green-500/10 border border-green-300 dark:border-green-700 text-green-700 dark:text-green-400 text-sm">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                        <button @click="show = false" class="ml-auto text-green-600 hover:text-green-800">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                @endif

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="flex items-center gap-3 p-4 rounded-lg bg-red-100 dark:bg-red-500/10 border border-red-300 dark:border-red-700 text-red-700 dark:text-red-400 text-sm">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Header --}}
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 dark:text-white">Program Microcredential</h1>
                        <p class="text-sm text-gray-500 mt-1">Kelola data program dan kursus microcredential</p>
                    </div>
                </div>

                {{-- Search + Filter + Add --}}
                <div class="card translate-0 p-5">
                    <div class="flex items-center gap-3 mb-5 flex-wrap">
                        <form action="{{ route('superAdmin.programMicrocredential') }}" method="GET" class="flex-1 min-w-[200px] flex items-center gap-2 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 transition-all duration-300 focus-within:ring-2 focus-within:ring-primary focus-within:border-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari program..." class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 w-full py-0.5">
                        </form>
                        <select name="jenis" onchange="this.form ? this.form.submit() : window.location='?jenis='+this.value"
                            class="px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-sm text-gray-800 dark:text-white focus:ring-2 focus:ring-primary outline-none transition">
                            <option value="">Semua Jenis</option>
                            @foreach ($jenisList as $j)
                                <option value="{{ $j->id }}" {{ request('jenis') == $j->id ? 'selected' : '' }}>{{ $j->nama }}</option>
                            @endforeach
                        </select>
                        <button @click="openCreate()" class="px-4 py-2 bg-[#6C63FF] hover:bg-[#282ff3] dark:hover:bg-[#4b4bd9] rounded-lg text-sm font-medium transition flex items-center gap-2 text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            Tambah Program
                        </button>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left whitespace-nowrap">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-800">
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Program</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Jenis Microcredential</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Semester</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800 dark:text-gray-300">
                                @forelse ($programs as $index => $item)
                                    <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                        <td class="py-3 px-4">{{ $programs->firstItem() + $index }}</td>
                                        <td class="py-3 px-4 font-medium">{{ $item->nama }}</td>
                                        <td class="py-3 px-4 text-gray-500">{{ $item->jenisMicrocredential->nama ?? '-' }}</td>
                                        <td class="py-3 px-4 text-gray-500">
                                            @if ($item->semester)
                                                {{ $item->semester->jenis }} {{ $item->semester->tahun }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            @if ($item->status_pendaftaran === 'buka')
                                                <span class="px-2 py-1 bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-xs font-medium rounded-full">Buka</span>
                                            @else
                                                <span class="px-2 py-1 bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs font-medium rounded-full">Tutup</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex justify-center gap-1">
                                                <button @click='openEdit(@json($item))'
                                                    class="group w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200"
                                                    title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                                    </svg>
                                                </button>
                                                <button @click="openDelete('{{ $item->id }}', '{{ $item->nama }}')"
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
                                            Belum ada data program microcredential.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($programs->hasPages())
                        <div class="mt-4">
                            {{ $programs->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </main>

    <x-rightPanel />

    {{-- CREATE / EDIT MODAL --}}
    <div x-show="modal.show" x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">
        <div @click.away="modal.show = false" x-show="modal.show" x-transition
            class="bg-white dark:bg-[#1A1A2E] rounded-2xl shadow-2xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">

            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6" x-text="modal.title"></h3>

            <form :action="modal.action" method="POST" enctype="multipart/form-data">
                @csrf
                <template x-if="modal.mode === 'edit'">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="space-y-4">
                    {{-- Nama Program --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Program <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" x-model="modal.data.nama" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition"
                            placeholder="Contoh: UI/UX Design Specialist">
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" x-model="modal.data.deskripsi" rows="3"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition"
                            placeholder="Deskripsi singkat program"></textarea>
                    </div>

                    {{-- Jenis Microcredential --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jenis Microcredential <span class="text-red-500">*</span></label>
                        <select name="id_jenis_microcredential" x-model="modal.data.id_jenis_microcredential" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition">
                            <option value="" disabled>Pilih jenis microcredential</option>
                            <template x-for="j in jenisList" :key="j.id">
                                <option :value="j.id" x-text="j.nama"></option>
                            </template>
                        </select>
                    </div>

                    {{-- Semester --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Semester <span class="text-red-500">*</span></label>
                        <select name="id_semester" x-model="modal.data.id_semester" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition">
                            <option value="" disabled>Pilih semester</option>
                            <template x-for="s in semesterList" :key="s.id">
                                <option :value="s.id" x-text="s.jenis + ' - ' + s.tahun"></option>
                            </template>
                        </select>
                    </div>

                    {{-- Status Pendaftaran --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status Pendaftaran <span class="text-red-500">*</span></label>
                        <select name="status_pendaftaran" x-model="modal.data.status_pendaftaran" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition">
                            <option value="buka">Buka</option>
                            <option value="tutup">Tutup</option>
                        </select>
                    </div>

                    {{-- Foto Program --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Foto Program <span class="text-xs text-gray-400">(opsional, maks 2MB)</span></label>
                        <input type="file" name="foto_program" accept="image/*"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition text-sm">
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
                        class="flex-1 px-4 py-3 rounded-lg bg-[#6C63FF] hover:bg-[#282ff3] text-white transition font-medium">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- DELETE CONFIRMATION MODAL --}}
    <div x-show="deleteModal.show" x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">
        <div @click.away="deleteModal.show = false" x-show="deleteModal.show" x-transition
            class="bg-white dark:bg-[#1A1A2E] rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full bg-red-100 dark:bg-red-500/20">
                <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>

            <h3 class="text-xl font-bold text-center text-gray-800 dark:text-white mb-2">Hapus Data?</h3>
            <p class="text-sm text-center text-gray-500 mb-2">Anda akan menghapus program:</p>
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
        function programPage() {
            return {
                dark: localStorage.getItem('theme') === 'dark',
                toggleDark() {
                    this.dark = !this.dark;
                    localStorage.setItem('theme', this.dark ? 'dark' : 'light');
                    document.documentElement.classList.toggle('dark', this.dark);
                },

                jenisList: @json($jenisList),
                semesterList: @json($semesterList),

                modal: {
                    show: false,
                    mode: 'create',
                    title: '',
                    action: '',
                    data: {
                        nama: '',
                        deskripsi: '',
                        id_jenis_microcredential: '',
                        id_semester: '',
                        status_pendaftaran: 'buka'
                    }
                },
                deleteModal: {
                    show: false,
                    action: '',
                    nama: ''
                },

                init() {
                    document.documentElement.classList.toggle('dark', this.dark);
                },

                openCreate() {
                    this.modal = {
                        show: true,
                        mode: 'create',
                        title: 'Tambah Program Microcredential',
                        action: '{{ route('superAdmin.programMicrocredential.store') }}',
                        data: {
                            nama: '',
                            deskripsi: '',
                            id_jenis_microcredential: '',
                            id_semester: '',
                            status_pendaftaran: 'buka'
                        }
                    };
                },

                openEdit(item) {
                    this.modal = {
                        show: true,
                        mode: 'edit',
                        title: 'Edit Program Microcredential',
                        action: '/super-admin/program-microcredential/' + item.id,
                        data: {
                            nama: item.nama || '',
                            deskripsi: item.deskripsi || '',
                            id_jenis_microcredential: item.id_jenis_microcredential || '',
                            id_semester: item.id_semester || '',
                            status_pendaftaran: item.status_pendaftaran || 'buka'
                        }
                    };
                    // Force Alpine to re-evaluate select bindings after DOM update
                    this.$nextTick(() => {
                        this.modal.data.id_jenis_microcredential = item.id_jenis_microcredential || '';
                        this.modal.data.id_semester = item.id_semester || '';
                        this.modal.data.status_pendaftaran = item.status_pendaftaran || 'buka';
                    });
                },

                openDelete(id, nama) {
                    this.deleteModal = {
                        show: true,
                        action: '/super-admin/program-microcredential/' + id,
                        nama: nama
                    };
                }
            };
        }
    </script>

</body>
</html>
