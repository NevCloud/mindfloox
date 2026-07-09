<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin & Instruktur - Super Admin</title>
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

<body x-data="adminInstrukturApp()" x-init="initApp()" x-cloak
    class="min-h-screen bg-gray-50 dark:bg-[#0F0F1A] flex">

    <x-leftPanel />

    <main class="flex-1 flex flex-col overflow-hidden">
        <x-topNav />

        <div class="flex-1 overflow-y-auto">
            <div class="p-5 space-y-5">

{{-- Validation Errors - ditampilkan di dalam modal, bukan di sini --}}

                <!-- Header -->
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 dark:text-white">Admin & Instruktur</h1>
                        <p class="text-sm text-gray-500 mt-1">Kelola data admin microcredential dan instruktur</p>
                    </div>
                </div>

                <!-- Search + Add -->
                <div class="card translate-0 p-5">
                    <div class="flex items-center gap-3 mb-5">
                        {{-- Search Form --}}
                        <form method="GET" action="{{ route('superAdmin.adminInstruktur') }}" class="flex-1 flex items-center gap-2">
                            <div class="flex-1 flex items-center gap-2 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 transition-all duration-300 focus-within:ring-2 focus-within:ring-primary focus-within:border-transparent">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8" />
                                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                </svg>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari admin atau instruktur..."
                                    class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 w-full py-0.5">
                            </div>
                            <div x-data="{ open: false, current: '{{ request('role', '') }}', options: [{id:'',nama:'Semua Role'},{id:'admin_microcredential',nama:'Admin Microcredential'},{id:'instruktur',nama:'Instruktur'}], get selectedLabel() { const f = this.options.find(o => o.id == this.current); return f ? f.nama : 'Semua Role' }, selectRole(id) { const url = new URL(window.location); if(id) { url.searchParams.set('role', id); } else { url.searchParams.delete('role'); } window.location = url; } }">
                                <div class="relative">
                                    <div @click="open = !open" @click.outside="open = false"
                                        :class="open ? 'border-[#6C63FF]' : 'border-gray-200 dark:border-gray-700'"
                                        class="px-3 py-2 rounded-lg border bg-white dark:bg-[#0F0F1A] text-sm text-gray-800 dark:text-white cursor-pointer flex items-center gap-2 transition">
                                        <span x-text="selectedLabel"></span>
                                        <svg class="w-3.5 h-3.5 text-gray-400 transition" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                    <div x-show="open" x-transition class="absolute z-50 mt-1 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg overflow-hidden min-w-[180px]">
                                        <div class="max-h-[84px] overflow-y-auto">
                                            <template x-for="o in options" :key="o.id">
                                                <div @click="selectRole(o.id)"
                                                    class="px-4 py-2.5 text-sm cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition whitespace-nowrap"
                                                    :class="current == o.id ? 'bg-primary/10 text-primary font-medium' : 'text-gray-800 dark:text-white'"
                                                    x-text="o.nama"></div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (request('search') || request('role'))
                                <a href="{{ route('superAdmin.adminInstruktur') }}" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg text-sm font-medium transition text-gray-500">
                                    Reset
                                </a>
                            @endif
                        </form>
                        <button @click="openCreateModal()"
                            class="px-4 py-2 bg-[#6C63FF] hover:bg-[#5A52D9] dark:hover:bg-[#4b4bd9] rounded-lg text-sm font-medium transition flex items-center gap-2 text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah
                        </button>
                    </div>

                    <!-- Table -->
                    <div class="overflow-auto max-h-[65vh]">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-800">
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Nama</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Username</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Email</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Role</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800 dark:text-gray-300">
                                @forelse ($admins as $index => $admin)
                                    <tr
                                        class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                        <td class="py-3 px-4">{{ $admins->firstItem() + $index }}</td>
                                        <td class="py-3 px-4">
                                            <span class="font-medium break-words">{{ $admin->nama }}</span>
                                        </td>
                                        <td class="py-3 px-4 text-gray-500">
                                            <code class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-700 rounded text-xs text-gray-700 dark:text-white break-words">{{ $admin->username }}</code>
                                        </td>
                                        <td class="py-3 px-4 text-gray-500 break-words">{{ $admin->email }}</td>
                                        <td class="py-3 px-4">
                                            @if ($admin->role === 'admin_microcredential')
                                                <span
                                                    class="px-2 py-1 bg-blue-100 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-xs font-medium rounded-full">Admin
                                                    Microcredential</span>
                                            @elseif ($admin->role === 'instruktur')
                                                <span
                                                    class="px-2 py-1 bg-purple-100 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 text-xs font-medium rounded-full">Instruktur</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            @if ($admin->aktif === 'aktif')
                                                <span
                                                    class="px-2 py-1 bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-xs font-medium rounded-full">Aktif</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs font-medium rounded-full">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex justify-center gap-1">
                                                <button @click="openEditModal({{ $index }})"
                                                    class="group w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-4 h-4 transform group-hover:scale-110 transition"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path d="M12 20h9" />
                                                        <path
                                                            d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                                                    </svg>
                                                </button>
                                                <button @click="openDeleteModal({{ $admin->id }}, '{{ addslashes($admin->nama) }}')"
                                                    class="group w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-4 h-4 transform group-hover:scale-110 transition"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <polyline points="3 6 5 6 21 6" />
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                        <path d="M10 11v6" />
                                                        <path d="M14 11v6" />
                                                        <path
                                                            d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-8 text-center text-gray-400">
                                            <p>Belum ada data.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($admins->hasPages())
                        <div class="mt-4">
                            {{ $admins->links() }}
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
                <input type="hidden" name="_method" :value="modal.method">

                <div class="space-y-4">
                    {{-- Nama --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" x-model="modal.data.nama" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:outline-none focus:border-primary focus:ring-0 transition"
                            placeholder="Nama lengkap">
                    </div>

                    {{-- Username --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Username <span class="text-red-500">*</span></label>
                        <input type="text" name="username" x-model="modal.data.username" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:outline-none focus:border-primary focus:ring-0 transition"
                            placeholder="Username untuk login">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" x-model="modal.data.email" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:outline-none focus:border-primary focus:ring-0 transition"
                            placeholder="email@example.com">
                    </div>

                    {{-- Password disembunyikan: default = username, di-set otomatis di controller --}}

                    {{-- Role --}}
                    {{-- Role tidak bisa diubah saat edit (disabled) --}}
                    <div x-data="{ open: false, options: [{id:'admin_microcredential',nama:'Admin Microcredential'},{id:'instruktur',nama:'Instruktur'}], get selectedLabel() { const f = this.options.find(o => o.id == modal.data.role); return f ? f.nama : '' } }">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Role <span class="text-red-500">*</span>
                            <span x-show="modal.mode === 'edit'" class="text-gray-400 text-xs">(tidak dapat diubah)</span>
                        </label>
                        {{-- Hidden input: kirim nilai role saat select disabled (disabled input tidak ter-submit) --}}
                        <input type="hidden" name="role" :value="modal.data.role">
                        <div class="relative">
                            <div @click="if (modal.mode !== 'edit') open = !open" @click.outside="open = false"
                                :class="[open ? 'border-[#6C63FF]' : 'border-gray-300 dark:border-gray-700', modal.mode === 'edit' ? 'opacity-50 cursor-not-allowed' : '']"
                                class="w-full px-4 py-3 rounded-lg border bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white cursor-pointer flex items-center justify-between transition">
                                <span x-text="selectedLabel || 'Pilih role'" :class="!selectedLabel && 'text-gray-400'"></span>
                                <svg class="w-4 h-4 text-gray-400 transition" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                            <div x-show="open" x-transition class="absolute z-50 w-full mt-1 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg overflow-hidden">
                                <div class="max-h-[84px] overflow-y-auto">
                                    <template x-for="o in options" :key="o.id">
                                        <div @click="modal.data.role = o.id; open = false"
                                            class="px-4 py-2.5 text-sm cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                                            :class="modal.data.role == o.id ? 'bg-primary/10 text-primary font-medium' : 'text-gray-800 dark:text-white'"
                                            x-text="o.nama"></div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Jenis Microcredential (hanya muncul jika role = admin_microcredential) --}}
                    <div x-show="modal.data.role === 'admin_microcredential'" x-data="{ open: false, options: [], init() { this.options = jenisList.map(j => ({id: j.id, nama: j.nama})); }, get selectedLabel() { const f = this.options.find(j => j.id == modal.data.id_jenis_microcredential); return f ? f.nama : '' } }">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Microcredential <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div @click="open = !open" @click.outside="open = false"
                                :class="open ? 'border-[#6C63FF]' : 'border-gray-300 dark:border-gray-700'"
                                class="w-full px-4 py-3 rounded-lg border bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white cursor-pointer flex items-center justify-between transition">
                                <span x-text="selectedLabel || '-- Pilih Jenis --'" :class="!selectedLabel && 'text-gray-400'"></span>
                                <svg class="w-4 h-4 text-gray-400 transition" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                            <div x-show="open" x-transition class="absolute z-50 w-full mt-1 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg overflow-hidden">
                                <div class="max-h-[84px] overflow-y-auto">
                                    <template x-for="j in options" :key="j.id">
                                        <div @click="modal.data.id_jenis_microcredential = j.id; open = false"
                                            class="px-4 py-2.5 text-sm cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                                            :class="modal.data.id_jenis_microcredential == j.id ? 'bg-primary/10 text-primary font-medium' : 'text-gray-800 dark:text-white'"
                                            x-text="j.nama"></div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_jenis_microcredential" :value="modal.data.id_jenis_microcredential">
                    </div>

                    {{-- Status (hanya muncul saat edit) --}}
                    <div x-show="modal.mode === 'edit'" x-data="{ open: false, options: [{id:'aktif',nama:'Aktif'},{id:'nonaktif',nama:'Nonaktif'}], get selectedLabel() { const f = this.options.find(o => o.id == modal.data.aktif); return f ? f.nama : '' } }">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div @click="open = !open" @click.outside="open = false"
                                :class="open ? 'border-[#6C63FF]' : 'border-gray-300 dark:border-gray-700'"
                                class="w-full px-4 py-3 rounded-lg border bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white cursor-pointer flex items-center justify-between transition">
                                <span x-text="selectedLabel || 'Pilih status'" :class="!selectedLabel && 'text-gray-400'"></span>
                                <svg class="w-4 h-4 text-gray-400 transition" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                            <div x-show="open" x-transition class="absolute z-50 w-full mt-1 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg overflow-hidden">
                                <div class="max-h-[84px] overflow-y-auto">
                                    <template x-for="o in options" :key="o.id">
                                        <div @click="modal.data.aktif = o.id; open = false"
                                            class="px-4 py-2.5 text-sm cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                                            :class="modal.data.aktif == o.id ? 'bg-primary/10 text-primary font-medium' : 'text-gray-800 dark:text-white'"
                                            x-text="o.nama"></div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="aktif" :value="modal.data.aktif">
                    </div>
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="button" @click="modal.show = false"
                        class="inline-flex items-center justify-center gap-1.5 flex-1 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition font-medium">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span>Batal</span>
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
            <div
                class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full bg-red-100 dark:bg-red-500/20">
                <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>

            <h3 class="text-xl font-bold text-center text-gray-800 dark:text-white mb-2">Hapus Data?</h3>
            <p class="text-sm text-center text-gray-500 mb-6">
                Data yang dihapus tidak dapat dikembalikan. Apakah Anda yakin ingin melanjutkan?
            </p>

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
        // Data dari server (aman, tidak di-inline ke HTML attribute)
        const serverData = @json($admins->values());

        function adminInstrukturApp() {
            return {
                // Dark mode state - sinkron dengan localStorage
                dark: localStorage.getItem('theme') === 'dark',
                toggleDark() {
                    this.dark = !this.dark;
                    localStorage.setItem('theme', this.dark ? 'dark' : 'light');
                    document.documentElement.classList.toggle('dark', this.dark);
                },

                dataList: serverData,
                jenisList: @json($jenisList),

                modal: {
                    show: false,
                    mode: 'create',
                    title: '',
                    action: '',
                    method: 'POST',
                    data: {
                        nama: '',
                        username: '',
                        email: '',
                        role: '',
                        id_jenis_microcredential: '',
                        aktif: 'aktif',
                    }
                },

                deleteModal: {
                    show: false,
                    action: '',
                    nama: '',
                },

                initApp() {
                    // dark mode sudah ditangani di <head>

                    // Auto-open modal jika ada validation errors dari server
                    @if ($errors->any())
                        this.openCreateModal();
                        this.modal.data.nama = @json(old('nama', ''));
                        this.modal.data.username = @json(old('username', ''));
                        this.modal.data.email = @json(old('email', ''));
                        this.modal.data.role = @json(old('role', 'admin_microcredential'));
                        this.modal.data.id_jenis_microcredential = @json(old('id_jenis_microcredential', ''));
                    @endif
                },

                openCreateModal() {
                    this.modal.mode = 'create';
                    this.modal.title = 'Tambah Admin/Instruktur';
                    this.modal.action = '{{ route('superAdmin.adminInstruktur.store') }}';
                    this.modal.method = 'POST';
                    this.modal.data = {
                        nama: '',
                        username: '',
                        email: '',
                        role: '',
                        id_jenis_microcredential: '',
                        aktif: 'aktif',
                    };
                    this.modal.show = true;
                },

                openEditModal(index) {
                    const item = this.dataList[index];
                    this.modal.mode = 'edit';
                    this.modal.title = 'Edit Admin/Instruktur';
                    this.modal.action = '{{ url('super-admin/admin-instruktur') }}/' + item.id;
                    this.modal.method = 'PUT';
                    this.modal.data = {
                        nama: item.nama || '',
                        username: item.username || '',
                        email: item.email || '',
                        role: item.role || 'admin_microcredential',
                        id_jenis_microcredential: item.admin_microcredential ? String(item.admin_microcredential.id_jenis_microcredential) : '',
                        aktif: item.aktif || 'aktif',
                    };
                    this.modal.show = true;
                },

                openDeleteModal(id, nama) {
                    this.deleteModal.action = '{{ url('super-admin/admin-instruktur') }}/' + id;
                    this.deleteModal.nama = nama;
                    this.deleteModal.show = true;
                },
            }
        }
    </script>

</body>

</html>
