<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Microcredential - Super Admin</title>
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
<body x-data="programPage()" x-init="init()" class="min-h-screen bg-gray-50 dark:bg-[#0F0F1A] flex">

    <x-leftPanel />

    <main class="flex-1 flex flex-col overflow-hidden">
        <x-topNav />

        <div class="flex-1 overflow-y-auto">
            <div class="p-5 space-y-5">


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
                        <div x-data="{ open: false, current: '{{ request('jenis', '') }}', options: [{id:'',nama:'Semua Jenis'}, ...jenisList.map(j => ({id: String(j.id), nama: j.nama}))], get selectedLabel() { const f = this.options.find(o => o.id == this.current); return f ? f.nama : 'Semua Jenis' }, selectJenis(id) { const url = new URL(window.location); if(id) { url.searchParams.set('jenis', id); } else { url.searchParams.delete('jenis'); } window.location = url; } }">
                            <div class="relative">
                                <div @click="open = !open" @click.outside="open = false"
                                    :class="open ? 'border-[#6C63FF]' : 'border-gray-200 dark:border-gray-700'"
                                    class="px-3 py-2 rounded-lg border bg-white dark:bg-[#0F0F1A] text-sm text-gray-800 dark:text-white cursor-pointer flex items-center gap-2 transition">
                                    <span x-text="selectedLabel" :class="!selectedLabel && 'text-gray-400'"></span>
                                    <svg class="w-3.5 h-3.5 text-gray-400 transition" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                                <div x-show="open" x-transition class="absolute z-50 mt-1 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg overflow-hidden min-w-[180px]">
                                    <div class="max-h-[84px] overflow-y-auto">
                                        <template x-for="o in options" :key="o.id">
                                            <div @click="selectJenis(o.id)"
                                                class="px-4 py-2.5 text-sm cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition whitespace-nowrap"
                                                :class="current == o.id ? 'bg-primary/10 text-primary font-medium' : 'text-gray-800 dark:text-white'"
                                                x-text="o.nama"></div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button @click="openCreate()" class="px-4 py-2 bg-[#6C63FF] hover:bg-[#5A52D9] dark:hover:bg-[#4b4bd9] rounded-lg text-sm font-medium transition flex items-center gap-2 text-white">
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
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Periode Akademik</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Waktu Pendaftaran</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Admin</th>
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
                                            @if ($item->periodePembelajaran)
                                                {{ $item->periodePembelajaran->jenis }} {{ $item->periodePembelajaran->tahun }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 text-gray-500 text-xs">
                                            @if ($item->tanggal_mulai_pendaftaran && $item->tanggal_akhir_pendaftaran)
                                                <span class="whitespace-nowrap">{{ $item->tanggal_mulai_pendaftaran->translatedFormat('d F Y') }} - {{ $item->tanggal_akhir_pendaftaran->translatedFormat('d F Y') }}</span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            @php
                                                $now = now();
                                                $sd = $item->tanggal_mulai_pendaftaran ? \Carbon\Carbon::parse($item->tanggal_mulai_pendaftaran)->startOfDay() : null;
                                                $ed = $item->tanggal_akhir_pendaftaran ? \Carbon\Carbon::parse($item->tanggal_akhir_pendaftaran)->endOfDay() : null;
                                                
                                                $isOpen = false;
                                                if ($item->status_pendaftaran === 'buka' && $sd && $ed && $now->between($sd, $ed)) {
                                                    $isOpen = true;
                                                }
                                            @endphp
                                            
                                            @if ($isOpen)
                                                <span class="px-2 py-1 bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-xs font-medium rounded-full">Buka</span>
                                            @else
                                                <span class="px-2 py-1 bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs font-medium rounded-full">Tutup</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 text-gray-500">
                                            {{ $item->adminMicrocredential->pengguna->nama ?? '-' }}
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
                                        <td colspan="8" class="py-8 text-center text-gray-500 text-sm">
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

    {{-- ============ MODAL CREATE / EDIT ============ --}}
    <div x-show="modal.show" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);" @click.self="modal.show = false">
        <div x-show="modal.show" x-transition
            class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto border border-gray-100 dark:border-gray-800">

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
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:outline-none focus:border-primary focus:ring-0 transition"
                            placeholder="Contoh: UI/UX Design Specialist">
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi" x-model="modal.data.deskripsi" rows="3" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:outline-none focus:border-primary focus:ring-0 transition"
                            placeholder="Deskripsi singkat program"></textarea>
                    </div>

                    {{-- Jenis Microcredential --}}
                    <div x-data="{ open: false, options: [], init() { this.options = jenisList.map(j => ({id: j.id, nama: j.nama})); }, get selectedLabel() { const f = this.options.find(j => j.id == modal.data.id_jenis_microcredential); return f ? f.nama : '' } }">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jenis Microcredential <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div @click="open = !open" @click.outside="open = false"
                                :class="open ? 'border-[#6C63FF]' : 'border-gray-300 dark:border-gray-700'"
                                class="w-full px-4 py-3 rounded-lg border bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white cursor-pointer flex items-center justify-between transition">
                                <span x-text="selectedLabel || 'Pilih jenis microcredential'" :class="!selectedLabel && 'text-gray-400'"></span>
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

                    {{-- Periode Akademik --}}
                    <div x-data="{ open: false, options: [], init() { this.options = periodePembelajaranList.map(s => ({id: s.id, label: s.jenis + ' - ' + s.tahun})); }, get selectedLabel() { const f = this.options.find(s => s.id == modal.data.id_periode_pembelajaran); return f ? f.label : '' } }">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Periode Akademik <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div @click="open = !open" @click.outside="open = false"
                                :class="open ? 'border-[#6C63FF]' : 'border-gray-300 dark:border-gray-700'"
                                class="w-full px-4 py-3 rounded-lg border bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white cursor-pointer flex items-center justify-between transition">
                                <span x-text="selectedLabel || 'Pilih periode akademik'" :class="!selectedLabel && 'text-gray-400'"></span>
                                <svg class="w-4 h-4 text-gray-400 transition" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                            <div x-show="open" x-transition class="absolute z-50 w-full mt-1 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg overflow-hidden">
                                <div class="max-h-[84px] overflow-y-auto">
                                    <template x-for="s in options" :key="s.id">
                                        <div @click="modal.data.id_periode_pembelajaran = s.id; open = false"
                                            class="px-4 py-2.5 text-sm cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                                            :class="modal.data.id_periode_pembelajaran == s.id ? 'bg-primary/10 text-primary font-medium' : 'text-gray-800 dark:text-white'"
                                            x-text="s.label"></div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_periode_pembelajaran" :value="modal.data.id_periode_pembelajaran">
                    </div>

                    {{-- Waktu Pendaftaran --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Mulai Pendaftaran <span class="text-red-500">*</span></label>
                            <input type="text" id="tanggal-mulai" name="tanggal_mulai_pendaftaran" x-model="modal.data.tanggal_mulai_pendaftaran" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:outline-none focus:border-primary focus:ring-0 transition"
                                placeholder="Pilih tanggal mulai">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Akhir Pendaftaran <span class="text-red-500">*</span></label>
                            <input type="text" id="tanggal-akhir" name="tanggal_akhir_pendaftaran" x-model="modal.data.tanggal_akhir_pendaftaran" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:outline-none focus:border-primary focus:ring-0 transition"
                                placeholder="Pilih tanggal akhir">
                        </div>
                    </div>

                    {{-- Status Pendaftaran --}}
                    <div x-data="{ open: false, options: [{id:'buka',nama:'Buka'},{id:'tutup',nama:'Tutup'}], get selectedLabel() { const f = this.options.find(o => o.id == modal.data.status_pendaftaran); return f ? f.nama : '' } }">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status Pendaftaran <span class="text-red-500">*</span></label>
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
                                        <div @click="modal.data.status_pendaftaran = o.id; open = false"
                                            class="px-4 py-2.5 text-sm cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                                            :class="modal.data.status_pendaftaran == o.id ? 'bg-primary/10 text-primary font-medium' : 'text-gray-800 dark:text-white'"
                                            x-text="o.nama"></div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="status_pendaftaran" :value="modal.data.status_pendaftaran">
                    </div>

                    {{-- Kaitkan Admin --}}
                    <div x-show="modal.data.id_jenis_microcredential" x-data="{ open: false, get selectedLabel() { const f = filteredAdmins.find(a => a.id == modal.data.id_admin_microcredential); return f ? f.nama : '' } }">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kaitkan Admin <span class="text-red-500">*</span> <span class="text-xs text-gray-400">(sesuai jenis yang dipilih)</span></label>
                        <div class="relative">
                            <div @click="open = !open" @click.outside="open = false"
                                :class="open ? 'border-[#6C63FF]' : 'border-gray-300 dark:border-gray-700'"
                                class="w-full px-4 py-3 rounded-lg border bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white cursor-pointer flex items-center justify-between transition">
                                <div class="flex items-center gap-2">
                                    <template x-if="selectedLabel">
                                        <img :src="filteredAdmins.find(a => a.id == modal.data.id_admin_microcredential)?.foto_profil ? '{{ asset('storage') }}/' + filteredAdmins.find(a => a.id == modal.data.id_admin_microcredential).foto_profil : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(selectedLabel) + '&background=6C63FF&color=fff&size=64&font-size=0.4'" class="w-6 h-6 rounded-full object-cover flex-shrink-0" alt="">
                                    </template>
                                    <span x-text="selectedLabel || 'Pilih admin'" :class="!selectedLabel && 'text-gray-400'"></span>
                                </div>
                                <svg class="w-4 h-4 text-gray-400 transition" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                            <div x-show="open" x-transition class="absolute z-50 w-full mt-1 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg overflow-hidden">
                                <div class="max-h-[84px] overflow-y-auto">
                                    <template x-for="admin in filteredAdmins" :key="admin.id">
                                        <div @click="modal.data.id_admin_microcredential = admin.id; open = false"
                                            class="px-4 py-2.5 text-sm cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition flex items-center gap-3"
                                            :class="modal.data.id_admin_microcredential == admin.id ? 'bg-primary/10 text-primary font-medium' : 'text-gray-800 dark:text-white'">
                                            <img :src="admin.foto_profil ? '{{ asset('storage') }}/' + admin.foto_profil : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(admin.nama) + '&background=6C63FF&color=fff&size=64&font-size=0.4'" class="w-6 h-6 rounded-full object-cover flex-shrink-0" alt="">
                                            <span x-text="admin.nama"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_admin_microcredential" :value="modal.data.id_admin_microcredential">
                    </div>

                    {{-- Foto Program --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Foto Program <span x-show="modal.mode === 'create'" class="text-red-400">*</span> <span class="text-xs text-gray-400">Maks. 2MB</span>
                        </label>
                        <input type="file" name="foto_program" accept="image/jpeg,image/png,image/jpg,image/webp" :required="modal.mode === 'create'"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white text-sm outline-none focus:border-primary transition file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                        <p class="text-xs text-gray-400 mt-1.5">Gambar harus berorientasi landscape (Rekomendasi ukuran: 800x450 pixel atau Rasio 16:9)</p>
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
        style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);" @click.self="deleteModal.show = false">
        <div x-show="deleteModal.show" x-transition
            class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl max-w-md w-full p-6 border border-gray-100 dark:border-gray-800">
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
                periodePembelajaranList: @json($periodePembelajaranList),
                adminList: @json($adminList),

                modal: {
                    show: false,
                    mode: 'create',
                    title: '',
                    action: '',
                    data: {
                        nama: '',
                        deskripsi: '',
                        id_jenis_microcredential: '',
                        id_periode_pembelajaran: '',
                        id_admin_microcredential: '',
                        status_pendaftaran: 'buka',
                        tanggal_mulai_pendaftaran: '',
                        tanggal_akhir_pendaftaran: ''
                    }
                },
                deleteModal: {
                    show: false,
                    action: '',
                    nama: ''
                },

                get filteredAdmins() {
                    const jenisId = this.modal.data.id_jenis_microcredential;
                    if (!jenisId) return [];
                    return this.adminList.filter(a => {
                        if (String(a.id_jenis_microcredential) !== String(jenisId)) return false;
                        if (!a.assigned_program_ids || a.assigned_program_ids.length === 0) return true;
                        if (this.modal.mode === 'edit' && a.assigned_program_ids.includes(this.modal.current_program_id)) return true;
                        return false;
                    });
                },

                init() {
                    document.documentElement.classList.toggle('dark', this.dark);
                },

                initFlatpickr() {
                    this.$nextTick(() => {
                        const mulaiEl = document.getElementById('tanggal-mulai');
                        const akhirEl = document.getElementById('tanggal-akhir');
                        if (mulaiEl && mulaiEl._flatpickr) mulaiEl._flatpickr.destroy();
                        if (akhirEl && akhirEl._flatpickr) akhirEl._flatpickr.destroy();

                        if (mulaiEl) {
                            flatpickr(mulaiEl, {
                                dateFormat: 'Y-m-d',
                                defaultDate: this.modal.data.tanggal_mulai_pendaftaran || null,
                                onChange: (selectedDates, dateStr) => {
                                    this.modal.data.tanggal_mulai_pendaftaran = dateStr;
                                }
                            });
                        }
                        if (akhirEl) {
                            flatpickr(akhirEl, {
                                dateFormat: 'Y-m-d',
                                defaultDate: this.modal.data.tanggal_akhir_pendaftaran || null,
                                onChange: (selectedDates, dateStr) => {
                                    this.modal.data.tanggal_akhir_pendaftaran = dateStr;
                                }
                            });
                        }
                    });
                },

                openCreate() {
                    this.modal = {
                        show: true,
                        mode: 'create',
                        current_program_id: null,
                        title: 'Tambah Program Microcredential',
                        action: '{{ route('superAdmin.programMicrocredential.store') }}',
                        data: {
                            nama: '',
                            deskripsi: '',
                            id_jenis_microcredential: '',
                            id_periode_pembelajaran: '',
                            id_admin_microcredential: '',
                            status_pendaftaran: 'buka',
                            tanggal_mulai_pendaftaran: '',
                            tanggal_akhir_pendaftaran: ''
                        }
                    };
                    this.initFlatpickr();
                },

                openEdit(item) {
                    const fmt = (d) => {
                        if (!d) return '';
                        // d is ISO string, parse to local Date
                        const dateObj = new Date(d);
                        if (isNaN(dateObj)) return d.substring(0, 10);
                        const yyyy = dateObj.getFullYear();
                        const mm = String(dateObj.getMonth() + 1).padStart(2, '0');
                        const dd = String(dateObj.getDate()).padStart(2, '0');
                        return `${yyyy}-${mm}-${dd}`;
                    };
                    this.modal = {
                        show: true,
                        mode: 'edit',
                        current_program_id: item.id,
                        title: 'Edit Program Microcredential',
                        action: '/super-admin/program-microcredential/' + item.id,
                        data: {
                            nama: item.nama || '',
                            deskripsi: item.deskripsi || '',
                            id_jenis_microcredential: item.id_jenis_microcredential || '',
                            id_periode_pembelajaran: item.id_periode_pembelajaran || '',
                            id_admin_microcredential: item.id_admin_microcredential || '',
                            status_pendaftaran: item.status_pendaftaran || 'buka',
                            tanggal_mulai_pendaftaran: fmt(item.tanggal_mulai_pendaftaran),
                            tanggal_akhir_pendaftaran: fmt(item.tanggal_akhir_pendaftaran)
                        }
                    };
                    // Force Alpine to re-evaluate select bindings after DOM update
                    this.$nextTick(() => {
                        this.modal.data.id_jenis_microcredential = item.id_jenis_microcredential || '';
                        this.modal.data.id_periode_pembelajaran = item.id_periode_pembelajaran || '';
                        this.modal.data.id_admin_microcredential = item.id_admin_microcredential || '';
                        this.modal.data.status_pendaftaran = item.status_pendaftaran || 'buka';
                    });
                    this.initFlatpickr();
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
