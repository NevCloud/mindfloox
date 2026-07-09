<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jenis Microcredential - Super Admin</title>
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
<body x-data="jenisPage()" x-init="init()" class="min-h-screen bg-gray-50 dark:bg-[#0F0F1A] flex">

    <x-leftPanel />

    <main class="flex-1 flex flex-col overflow-hidden">
        <x-topNav />

        <div class="flex-1 overflow-y-auto">
            <div class="p-5 space-y-5">



                {{-- Header --}}
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 dark:text-white">Jenis Microcredential</h1>
                        <p class="text-sm text-gray-500 mt-1">Kelola data kategori atau jenis program microcredential</p>
                    </div>
                </div>

                {{-- Search + Add --}}
                <div class="card translate-0 p-5">
                    <div class="flex items-center gap-3 mb-5">
                        <form action="{{ route('superAdmin.jenisMicrocredential') }}" method="GET" class="flex-1 flex items-center gap-2 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 transition-all duration-300 focus-within:ring-2 focus-within:ring-primary focus-within:border-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari jenis microcredential..." class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 w-full py-0.5">
                        </form>
                        <button @click="openCreate()" class="px-4 py-2 bg-[#6C63FF] hover:bg-[#5A52D9] dark:hover:bg-[#4b4bd9] rounded-lg text-sm font-medium transition flex items-center gap-2 text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            Tambah Jenis
                        </button>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left whitespace-nowrap">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-800">
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Nama Jenis</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Dibuat</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800 dark:text-gray-300">
                                @forelse ($jenisMicrocredentials as $index => $item)
                                    <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                        <td class="py-3 px-4">{{ $jenisMicrocredentials->firstItem() + $index }}</td>
                                        <td class="py-3 px-4 font-medium">{{ $item->nama }}</td>
                                        <td class="py-3 px-4 text-gray-500">{{ Str::limit($item->deskripsi, 50) }}</td>
                                        <td class="py-3 px-4 text-gray-500">{{ $item->dibuat_pada ? $item->dibuat_pada->format('Y-m-d') : '-' }}</td>
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
                                        <td colspan="5" class="py-8 text-center text-gray-500 text-sm">
                                            Belum ada data jenis microcredential.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($jenisMicrocredentials->hasPages())
                        <div class="mt-4">
                            {{ $jenisMicrocredentials->appends(request()->query())->links() }}
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
        <div @click.away="modal.show = false" x-show="modal.show" x-transition
            class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-lg p-6 border border-gray-100 dark:border-gray-800">

            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6" x-text="modal.title"></h3>

            <form :action="modal.action" method="POST">
                @csrf
                <template x-if="modal.mode === 'edit'">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Jenis <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" x-model="modal.data.nama" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:outline-none focus:border-primary focus:ring-0 transition"
                            placeholder="Contoh: UI/UX Design">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi" x-model="modal.data.deskripsi" rows="4" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:outline-none focus:border-primary focus:ring-0 transition"
                            placeholder="Deskripsi singkat jenis microcredential"></textarea>
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
            <p class="text-sm text-center text-gray-500 mb-2">Anda akan menghapus jenis microcredential:</p>
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
        function jenisPage() {
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
                    data: { nama: '', deskripsi: '' }
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
                        title: 'Tambah Jenis Microcredential',
                        action: '{{ route('superAdmin.jenisMicrocredential.store') }}',
                        data: { nama: '', deskripsi: '' }
                    };
                },

                openEdit(item) {
                    this.modal = {
                        show: true,
                        mode: 'edit',
                        title: 'Edit Jenis Microcredential',
                        action: '/super-admin/jenis-microcredential/' + item.id,
                        data: {
                            nama: item.nama || '',
                            deskripsi: item.deskripsi || ''
                        }
                    };
                },

                openDelete(id, nama) {
                    this.deleteModal = {
                        show: true,
                        action: '/super-admin/jenis-microcredential/' + id,
                        nama: nama
                    };
                }
            };
        }
    </script>

</body>
</html>
