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
</head>
<body x-data="{
    dark: localStorage.getItem('theme') === 'dark',
    toggleDark() {
        this.dark = !this.dark;
        localStorage.setItem('theme', this.dark ? 'dark' : 'light');
        document.documentElement.classList.toggle('dark', this.dark);
    },
    showAddForm: false,
    newProgram: { nama: '', jenis: '', periode: '', instruktur: '', status: 'Buka' },
    programs: [
        { id: 1, nama: 'UI/UX Design Specialist', jenis: 'UI/UX Design', semester: 'Ganjil 2024/2025', foto_program: 'https://i.pravatar.cc/40?img=12', status: 'buka' },
        { id: 2, nama: 'Data Science Bootcamp', jenis: 'Data Science', semester: 'Ganjil 2024/2025', foto_program: 'https://i.pravatar.cc/40?img=3', status: 'tutup' }
    ],
    nextId: 3,
    submitAdd() {
        if (!this.newProgram.nama.trim()) return;
        this.programs.push({
            id: this.nextId++,
            nama: this.newProgram.nama,
            jenis: this.newProgram.jenis,
            semester: this.newProgram.semester,
            foto_program: 'https://i.pravatar.cc/40?img=' + this.nextId,
            status: this.newProgram.status
        });
        this.newProgram = { nama: '', jenis: '', semester: '', status: 'buka' };
        this.showAddForm = false;
    },
    deleteProgram(id) {
        if (confirm('Yakin ingin menghapus program ini?')) {
            this.programs = this.programs.filter(p => p.id !== id);
        }
    }
}" x-init="document.documentElement.classList.toggle('dark', dark)" class="min-h-screen bg-gray-50 dark:bg-[#0F0F1A] flex">

    <x-leftPanel />

    <main class="flex-1 flex flex-col overflow-hidden">
        <x-topNav />

        <div class="flex-1 overflow-y-auto">
            <div class="p-5 space-y-5">

                <!-- Header -->
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 dark:text-white">Program Microcredential</h1>
                        <p class="text-sm text-gray-500 mt-1">Kelola data program dan kursus microcredential</p>
                    </div>
                </div>

                <!-- Search + Add -->
                <div class="card translate-0 p-5">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex-1 flex items-center gap-2 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 transition-all duration-300 focus-within:ring-2 focus-within:ring-primary focus-within:border-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                            <input type="text" placeholder="Cari program microcredential..." class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 w-full py-0.5">
                        </div>
                        <select class="px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-sm text-gray-800 dark:text-white focus:ring-2 focus:ring-primary outline-none transition">
                            <option value="">Semua Jenis</option>
                            <option value="uiux">UI/UX Design</option>
                            <option value="web">Web Development</option>
                        </select>
                        <button @click="showAddForm = !showAddForm" class="px-4 py-2 bg-[#6C63FF] hover:bg-[#282ff3] dark:hover:bg-[#4b4bd9] rounded-lg text-sm font-medium transition flex items-center gap-2 text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            Tambah Program
                        </button>
                    </div>

                    <!-- Inline Add Form -->
                    <template x-if="showAddForm">
                        <div class="mb-5 p-4 rounded-xl border-2 border-dashed border-primary/40 bg-primary/5 dark:bg-primary/10 space-y-3" @click.away="showAddForm = false">
                            <p class="text-xs font-semibold text-primary">Tambah Program Baru</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Nama Program <span class="text-red-500">*</span></label>
                                    <input x-model="newProgram.nama" type="text" placeholder="Contoh: UI/UX Design Specialist"
                                        class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-[#1A1A2E] text-sm text-gray-800 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Jenis</label>
                                    <input x-model="newProgram.jenis" type="text" placeholder="Contoh: UI/UX Design"
                                        class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-[#1A1A2E] text-sm text-gray-800 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Semester</label>
                                    <input x-model="newProgram.semester" type="text" placeholder="Contoh: Ganjil 2024/2025"
                                        class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-[#1A1A2E] text-sm text-gray-800 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Status Pendaftaran</label>
                                    <select x-model="newProgram.status"
                                        class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-[#1A1A2E] text-sm text-gray-800 dark:text-white focus:ring-2 focus:ring-primary transition">
                                        <option value="buka">Buka</option>
                                        <option value="tutup">Tutup</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex items-center justify-end gap-2 pt-1">
                                <button @click="showAddForm = false" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    <span>Batal</span>
                                </button>
                                <button @click="submitAdd()" class="px-4 py-1.5 rounded-lg bg-[#6C63FF] hover:bg-[#282ff3] text-white text-sm font-medium transition">Simpan Program</button>
                            </div>
                        </div>
                    </template>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left whitespace-nowrap">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-800">
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Program</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Jenis Microcredential</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Semester</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase">Status Pendaftaran</th>
                                    <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800 dark:text-gray-300">
                                <template x-for="(program, index) in programs" :key="program.id">
                                    <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">
                                        <td class="py-3 px-4" x-text="index + 1"></td>
                                        <td class="py-3 px-4 font-medium" x-text="program.nama"></td>
                                        <td class="py-3 px-4 text-gray-500" x-text="program.jenis"></td>
                                        <td class="py-3 px-4 text-gray-500" x-text="program.semester"></td>
                                        <td class="py-3 px-4">
                                            <template x-if="program.status === 'buka'">
                                                <span class="px-2 py-1 bg-green-100 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-xs font-medium rounded-full">Buka</span>
                                            </template>
                                            <template x-if="program.status === 'tutup'">
                                                <span class="px-2 py-1 bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs font-medium rounded-full">Tutup</span>
                                            </template>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex justify-center gap-1">
                                                <button class="group w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                                    </svg>
                                                </button>
                                                <button @click="deleteProgram(program.id)" class="group w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                                    </svg>
                                                </button>
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

</body>
</html>
