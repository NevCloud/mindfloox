<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program - Super Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{
    dark: localStorage.getItem('theme') === 'dark',
    toggleDark() {
        this.dark = !this.dark;
        localStorage.setItem('theme', this.dark ? 'dark' : 'light');
        document.documentElement.classList.toggle('dark', this.dark);
    },
    programs: [
        {
            title: 'Web Development',
            status: 'Aktif',
            description: 'Belajar membangun aplikasi web modern menggunakan Laravel.',
            participants: 120,
            progress: 78,
            image: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085'
        },
        {
            title: 'UI/UX Design',
            status: 'Pending',
            description: 'Mendesain antarmuka modern dan user friendly.',
            participants: 80,
            progress: 65,
            image: 'https://images.unsplash.com/photo-1559028012-481c04fa702d'
        }
    ],
    programModal: {
        show: false,
        data: { title: '', type: 'Microcredential', status: 'Aktif', description: '' }
    },
    deleteModal: { show: false, index: null },
    openCreateModal() {
        this.programModal.data = {
            title: '',
            type: 'Microcredential',
            status: 'Aktif',
            description: ''
        };
        this.programModal.show = true;
    },
    saveProgram() {
        if (!this.programModal.data.title) {
            alert('Judul program harus diisi!');
            return;
        }
        
        this.programs.push({
            ...this.programModal.data,
            participants: 0,
            progress: 0,
            image: 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97' // default cover
        });
        
        this.programModal.show = false;
    },
    openDeleteProgram(index) {
        this.deleteModal.index = index;
        this.deleteModal.show = true;
    },
    confirmDeleteProgram() {
        this.programs.splice(this.deleteModal.index, 1);
        this.deleteModal.show = false;
    }
}" x-init="document.documentElement.classList.toggle('dark', dark)" class="min-h-screen bg-gray-50 dark:bg-[#0F0F1A] flex">

    <!-- LEFT PANEL -->
    <x-leftPanel />

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">

        <!-- TOP NAV -->
        <x-topNav />

        <!-- SCROLLABLE CONTENT -->
        <div class="flex-1 overflow-y-auto">

        <!-- TOPBAR -->
        <div class="flex items-center justify-between p-5">

            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">
                    Program Microcredential
                </h1>

                <p class="text-gray-500 text-sm mt-1">
                    Kelola semua program
                </p>
            </div>

            <button @click="openCreateModal()"
                class="bg-primary text-white px-5 py-3 rounded-xl shadow-lg hover:scale-105 transition">
                + Tambah Program
            </button>

        </div>

        <!-- CONTENT -->
        <div class="p-5 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            <template x-for="(program, index) in programs" :key="index">
                <!-- CARD -->
                <div class="bg-white dark:bg-[#1A1A2E] rounded-3xl p-5 shadow-sm">
                    <img :src="program.image" class="w-full h-44 object-cover rounded-2xl">
                    <div class="mt-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white" x-text="program.title"></h3>
                            <span :class="program.status === 'Aktif' ? 'bg-green-100 text-green-600' : (program.status === 'Pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-gray-100 text-gray-600')" 
                                  class="text-xs px-3 py-1 rounded-full" x-text="program.status">
                            </span>
                        </div>
                        <p class="text-gray-500 text-sm mt-3 min-h-[40px]" x-text="program.description"></p>

                        <!-- STATS -->
                        <div class="flex gap-3 mt-5">
                            <div class="flex-1 bg-gray-100 dark:bg-[#0F0F1A] p-3 rounded-xl">
                                <p class="text-xs text-gray-500">Peserta</p>
                                <h4 class="font-bold text-lg dark:text-white" x-text="program.participants"></h4>
                            </div>
                            <div class="flex-1 bg-gray-100 dark:bg-[#0F0F1A] p-3 rounded-xl">
                                <p class="text-xs text-gray-500">Progress</p>
                                <h4 class="font-bold text-lg dark:text-white" x-text="program.progress + '%'"></h4>
                            </div>
                        </div>

                        <!-- BUTTON -->
                        <div class="flex gap-2 mt-5">
                            <a href="{{ url('/super-admin/program/edit') }}" class="flex-1 bg-primary text-white py-3 rounded-xl text-center">
                                Edit
                            </a>
                            <button @click="openDeleteProgram(index)" class="flex-1 bg-red-500 text-white py-3 rounded-xl">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Modal Form Program -->
        <div x-show="programModal.show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4" x-transition.opacity style="display: none;">
            <div @click.outside="programModal.show = false" class="bg-white dark:bg-[#1A1A2E] rounded-2xl w-full max-w-lg p-6 shadow-2xl" x-transition.scale>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Tambah Program Baru</h3>
                    <button @click="programModal.show = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Program</label>
                        <input type="text" x-model="programModal.data.title" class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-primary outline-none" placeholder="Masukkan nama program">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                        <textarea x-model="programModal.data.description" rows="3" class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-primary outline-none" placeholder="Deskripsi program..."></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis</label>
                        <select x-model="programModal.data.type" class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-primary outline-none">
                            <option value="Microcredential">Microcredential</option>
                            <option value="Bootcamp">Bootcamp</option>
                            <option value="Kursus Singkat">Kursus Singkat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                        <select x-model="programModal.data.status" class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#0F0F1A] text-gray-800 dark:text-white focus:ring-2 focus:ring-primary outline-none">
                            <option value="Aktif">Aktif</option>
                            <option value="Pending">Pending</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button @click="programModal.show = false" class="px-5 py-2.5 text-gray-600 dark:text-gray-400 font-medium hover:bg-gray-100 dark:hover:bg-gray-800 rounded-xl transition">Batal</button>
                    <button @click="saveProgram()" class="px-5 py-2.5 bg-primary hover:bg-indigo-600 text-white font-medium rounded-xl transition">Simpan</button>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <div x-show="deleteModal.show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4" x-transition.opacity style="display: none;">
            <div @click.outside="deleteModal.show = false" class="bg-white dark:bg-[#1A1A2E] rounded-2xl w-full max-w-sm p-6 shadow-2xl text-center" x-transition.scale>
                <div class="w-16 h-16 bg-red-100 dark:bg-red-500/10 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Hapus Program?</h3>
                <p class="text-gray-500 text-sm mb-6">Program yang dihapus tidak dapat dikembalikan. Lanjutkan?</p>
                <div class="flex justify-center gap-3">
                    <button @click="deleteModal.show = false" class="px-5 py-2.5 text-gray-600 dark:text-gray-400 font-medium hover:bg-gray-100 dark:hover:bg-gray-800 rounded-xl transition">Batal</button>
                    <button @click="confirmDeleteProgram()" class="px-5 py-2.5 bg-red-500 hover:bg-red-600 text-white font-medium rounded-xl transition">Ya, Hapus</button>
                </div>
            </div>
        </div>
        </div>
    </main>

</body>
</html>