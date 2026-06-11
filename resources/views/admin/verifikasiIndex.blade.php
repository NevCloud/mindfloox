<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pendaftaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
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
    registrations: [
        { name: 'Budi Santoso', program: 'Data Science Bootcamp', date: '10 Okt 2024 09:00', verified_at: '-', verified_by: '-', notes: '-', status: 'pending' },
        { name: 'Siti Aminah', program: 'UI/UX Design Specialist', date: '09 Okt 2024 14:30', verified_at: '11 Okt 2024 10:15', verified_by: 'Super Admin', notes: 'Persyaratan lengkap dan sesuai', status: 'diterima' },
        { name: 'Andi Wijaya', program: 'Fullstack Web Development', date: '08 Okt 2024 11:20', verified_at: '10 Okt 2024 16:45', verified_by: 'Admin Micro', notes: 'Dokumen KTP buram', status: 'ditolak' }
    ],
    showVerifyModal: false,
    selectedItem: null,
    verifyForm: { status: 'diterima', notes: '' },
    openVerify(item) {
        this.selectedItem = item;
        this.verifyForm.status = 'diterima';
        this.verifyForm.notes = '';
        this.showVerifyModal = true;
    },
    submitVerify() {
        if (this.selectedItem) {
            this.selectedItem.status = this.verifyForm.status;
            this.selectedItem.notes = this.verifyForm.notes || '-';
            this.selectedItem.verified_at = '10 Okt 2024 12:00';
            this.selectedItem.verified_by = 'Admin (Anda)';
        }
        this.showVerifyModal = false;
        setTimeout(() => this.selectedItem = null, 300);
    }
}" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">
        <x-leftPanel />

        <main class="flex-1 flex flex-col overflow-hidden">

                <x-topNav />

                <!-- Content -->
                <div class="flex-1 overflow-y-auto">
                    <div class="p-5 space-y-5">

                        <!-- Header -->
                        <div>
                            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Verifikasi Pendaftaran</h1>
                            <p class="text-sm text-gray-500">Tinjau dan verifikasi pendaftaran peserta</p>
                        </div>

                        <!-- Success Message -->
                        @if(session('success'))
                        <div class="px-4 py-3 rounded-lg bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-300 text-sm">
                            {{ session('success') }}
                        </div>
                        @endif

                        <!-- Table Section -->
                        <div class="card translate-0 p-5">
                            <div class="flex items-center gap-3 mb-5">
                                <div class="flex-1 flex items-center gap-2 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 transition-all duration-300 focus-within:ring-2 focus-within:ring-primary focus-within:border-transparent">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <circle cx="11" cy="11" r="8" />
                                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                    </svg>
                                    <input type="text" placeholder="Cari pendaftaran peserta..." class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 w-full py-0.5">
                                </div>
                                <select class="px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-sm text-gray-800 dark:text-white focus:ring-2 focus:ring-primary outline-none transition">
                                    <option value="">Semua Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>

                            <!-- Table -->
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left whitespace-nowrap">
                                    <thead>
                                        <tr class="border-b border-gray-200 dark:border-gray-800">
                                            <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">No</th>
                                            <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Nama Peserta</th>
                                            <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Program</th>
                                            <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Tanggal Daftar</th>
                                            <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Tgl Verifikasi</th>
                                            <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Diverifikasi Oleh</th>
                                            <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase max-w-xs">Catatan Admin</th>
                                            <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Status</th>
                                            <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-800 dark:text-gray-300">
                                        <template x-for="(item, index) in registrations" :key="index">
                                            <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                                <td class="py-3 px-4" x-text="index + 1"></td>
                                                <td class="py-3 px-4 font-medium" x-text="item.name"></td>
                                                <td class="py-3 px-4 text-gray-500" x-text="item.program"></td>
                                                <td class="py-3 px-4 text-gray-500" x-text="item.date"></td>
                                                <td class="py-3 px-4 text-gray-500" x-text="item.verified_at"></td>
                                                <td class="py-3 px-4 text-gray-500" x-text="item.verified_by"></td>
                                                <td class="py-3 px-4 text-gray-500 truncate max-w-xs" x-text="item.notes" :title="item.notes"></td>
                                                <td class="py-3 px-4">
                                                    <template x-if="item.status === 'pending'">
                                                        <span class="px-2 py-1 bg-yellow-100 dark:bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 text-xs font-medium rounded-full">Pending</span>
                                                    </template>
                                                    <template x-if="item.status === 'diterima'">
                                                        <span class="px-2 py-1 bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-xs font-medium rounded-full">Diterima</span>
                                                    </template>
                                                    <template x-if="item.status === 'ditolak'">
                                                        <span class="px-2 py-1 bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs font-medium rounded-full">Ditolak</span>
                                                    </template>
                                                </td>
                                                <td class="py-3 px-4">
                                                    <div class="flex justify-center gap-1">
                                                        <template x-if="item.status === 'pending'">
                                                            <button @click="openVerify(item)" class="flex items-center gap-1 px-3 py-1.5 bg-[#6C63FF] hover:bg-[#5a52d5] text-white text-xs font-medium rounded-lg transition-all duration-200">
                                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                Verifikasi
                                                            </button>
                                                        </template>
                                                        <template x-if="item.status !== 'pending'">
                                                            <span class="text-xs text-gray-400">Telah diproses</span>
                                                        </template>
                                                    </div>
                                                </td>
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

    <!-- Verify Modal -->
    <div x-show="showVerifyModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0" x-cloak>
        <div x-show="showVerifyModal" x-transition.opacity class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="showVerifyModal = false"></div>
        <div x-show="showVerifyModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative bg-white dark:bg-[#1A1A2E] rounded-xl shadow-xl w-full max-w-lg border border-gray-200 dark:border-gray-800 p-6">

            <div class="flex justify-between items-center mb-5">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Verifikasi Pendaftaran</h3>
                <button @click="showVerifyModal = false" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-gray-800/50 rounded-full transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="space-y-4">
                <div class="p-3 bg-gray-50 dark:bg-[#0F0F1A] rounded-lg border border-gray-200 dark:border-gray-700">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Peserta</p>
                    <p class="text-sm font-medium text-gray-800 dark:text-white" x-text="selectedItem?.name"></p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 mb-1">Program</p>
                    <p class="text-sm font-medium text-gray-800 dark:text-white" x-text="selectedItem?.program"></p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status Verifikasi</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" x-model="verifyForm.status" value="diterima" class="text-[#6C63FF] focus:ring-[#6C63FF] bg-white dark:bg-[#0F0F1A] border-gray-300 dark:border-gray-700">
                            <span class="text-sm text-gray-700 dark:text-gray-300">Diterima</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" x-model="verifyForm.status" value="ditolak" class="text-[#6C63FF] focus:ring-[#6C63FF] bg-white dark:bg-[#0F0F1A] border-gray-300 dark:border-gray-700">
                            <span class="text-sm text-gray-700 dark:text-gray-300">Ditolak</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Catatan Admin <span class="text-gray-400 font-normal">(Opsional)</span></label>
                    <textarea x-model="verifyForm.notes" rows="3" class="w-full px-3 py-2 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg text-sm text-gray-800 dark:text-white focus:ring-2 focus:ring-[#6C63FF] focus:border-transparent outline-none transition" placeholder="Tambahkan alasan atau catatan khusus..."></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-200 dark:border-gray-800">
                <button @click="showVerifyModal = false" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    <span>Batal</span>
                </button>
                <button @click="submitVerify()" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-[#6C63FF] hover:bg-[#5a52d5] rounded-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Verifikasi
                </button>
            </div>
        </div>
    </div>

</body>
</html>
