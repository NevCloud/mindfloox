{{-- ============================================================
    Instruktur — Speed Grader (Workspace Penilaian)
    Layout: layouts.instructor
============================================================ --}}

@extends('layouts.instructor')

@section('title', 'Penilaian Tugas')

@push('scripts')
<script>
    function gradingApp() {
        return {
            students: [
                {
                    id: 1, name: 'Budi Pratama', avatar: 'https://i.pravatar.cc/150?img=33', submittedAt: '23 April 2025, 14:30 WIB', status: 'Tepat Waktu', statusColor: 'green', grade: null, feedback: '', fileName: 'Laporan_Riset_Budi.pdf', fileSize: '2.4 MB', note: 'Selamat siang Kak,<br>Berikut saya lampirkan laporan risetnya. Untuk link prototype figma bisa diakses disini: https://figma.com/file/...<br>Terima kasih atas bimbingannya!'
                },
                {
                    id: 2, name: 'Siti Aminah', avatar: 'https://i.pravatar.cc/150?img=47', submittedAt: '25 April 2025, 08:15 WIB', status: 'Terlambat', statusColor: 'red', grade: null, feedback: '', fileName: 'Wireframe_Siti_Final.zip', fileSize: '15 MB', note: 'Maaf saya telat mengumpulkan karena ada kendala koneksi internet kemarin malam.'
                },
                {
                    id: 3, name: 'Ahmad Fauzi', avatar: 'https://i.pravatar.cc/150?img=11', submittedAt: '22 April 2025, 10:00 WIB', status: 'Tepat Waktu', statusColor: 'green', grade: 85, feedback: 'Analisis risetnya sangat bagus dan terstruktur. UI flow-nya juga mudah dipahami.', fileName: 'CaseStudy_Ahmad.pdf', fileSize: '4.1 MB', note: 'Semua instruksi sudah saya kerjakan. Mohon feedbacknya kak.'
                },
                {
                    id: 4, name: 'Rina Melati', avatar: 'https://i.pravatar.cc/150?img=60', submittedAt: '-', status: 'Belum Kumpul', statusColor: 'gray', grade: null, feedback: '', fileName: null, fileSize: null, note: null
                },
                {
                    id: 5, name: 'Joko Susanto', avatar: 'https://i.pravatar.cc/150?img=15', submittedAt: '24 April 2025, 09:00 WIB', status: 'Tepat Waktu', statusColor: 'green', grade: null, feedback: '', fileName: 'Tugas_Joko.pdf', fileSize: '1.2 MB', note: 'Terlampir tugas saya.'
                },
                {
                    id: 6, name: 'Dewi Lestari', avatar: 'https://i.pravatar.cc/150?img=20', submittedAt: '24 April 2025, 11:30 WIB', status: 'Tepat Waktu', statusColor: 'green', grade: 92, feedback: 'Sangat rapi dan mematuhi semua guideline!', fileName: 'UI_Dewi_Lestari.pdf', fileSize: '5.5 MB', note: 'Mohon direview.'
                },
                {
                    id: 7, name: 'Andika Pratama', avatar: 'https://i.pravatar.cc/150?img=8', submittedAt: '25 April 2025, 16:45 WIB', status: 'Terlambat', statusColor: 'red', grade: null, feedback: '', fileName: 'Andika_UIUX.zip', fileSize: '8 MB', note: 'Maaf terlambat mengumpulkan.'
                },
                {
                    id: 8, name: 'Maya Sari', avatar: 'https://i.pravatar.cc/150?img=9', submittedAt: '23 April 2025, 19:20 WIB', status: 'Tepat Waktu', statusColor: 'green', grade: null, feedback: '', fileName: 'Maya_Research.pdf', fileSize: '3.1 MB', note: 'Ini bagian riset user saya.'
                },
                {
                    id: 9, name: 'Reza Rahadian', avatar: 'https://i.pravatar.cc/150?img=12', submittedAt: '24 April 2025, 22:10 WIB', status: 'Tepat Waktu', statusColor: 'green', grade: null, feedback: '', fileName: 'Flowchart_Reza.pdf', fileSize: '2.0 MB', note: 'Flowchart e-commerce.'
                },
                {
                    id: 10, name: 'Putri Tanjung', avatar: 'https://i.pravatar.cc/150?img=5', submittedAt: '-', status: 'Belum Kumpul', statusColor: 'gray', grade: null, feedback: '', fileName: null, fileSize: null, note: null
                }
            ],
            activeId: 1,
            showSuccess: false,
            searchQuery: '',
            filterStatus: 'all',
            windowWidth: window.innerWidth,
            
            get filteredStudents() {
                return this.students.filter(s => {
                    const matchSearch = s.name.toLowerCase().includes(this.searchQuery.toLowerCase());
                    let matchStatus = true;
                    
                    if (this.filterStatus === 'perlu_dinilai') {
                        matchStatus = s.grade === null && s.status !== 'Belum Kumpul';
                    } else if (this.filterStatus === 'sudah_dinilai') {
                        matchStatus = s.grade !== null;
                    } else if (this.filterStatus === 'belum_kumpul') {
                        matchStatus = s.status === 'Belum Kumpul';
                    }
                    
                    return matchSearch && matchStatus;
                });
            },

            get activeStudent() {
                return this.students.find(s => s.id === this.activeId);
            },
            
            get gradedCount() {
                return this.students.filter(s => s.grade !== null).length;
            },

            saveGrade() {
                // Tampilkan notifikasi sukses kecil
                this.showSuccess = true;
                setTimeout(() => this.showSuccess = false, 2000);

                // Otomatis pindah ke siswa berikutnya jika ada
                const currentIndex = this.students.findIndex(s => s.id === this.activeId);
                if(currentIndex < this.students.length - 1) {
                    // Cari siswa berikutnya yang belum dinilai (jika mau otomatis skip)
                    // Tapi untuk saat ini, pindah ke orang berikutnya saja
                    setTimeout(() => {
                        this.activeId = this.students[currentIndex + 1].id;
                    }, 500);
                }
            }
        }
    }
</script>
@endpush

@section('content')

<div x-data="gradingApp()" 
     @resize.window="windowWidth = window.innerWidth"
     class="flex flex-col" 
     style="min-height: 700px; height: calc(100vh - 8rem);">

    <!-- Header & Breadcrumb -->
    <div class="flex items-center justify-between mb-4 flex-shrink-0">
        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-1">
                <a href="{{ route('instructor.tugas') }}" class="hover:text-primary transition">Tugas</a>
                <span>/</span>
                <span class="text-gray-900 dark:text-white font-medium">UI/UX Case Study</span>
            </div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                Workspace Penilaian
                <span class="text-xs px-2.5 py-1 bg-primary/10 text-primary rounded-lg" x-text="gradedCount + ' dari ' + students.length + ' Dinilai'"></span>
            </h2>
        </div>
        <a href="{{ route('instructor.tugas') }}"
            class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Tutup Workspace
        </a>
    </div>

    <!-- Main Workspace (Split-Pane) -->
    <div class="flex flex-col md:flex-row gap-5 flex-1 min-h-0 pb-4">
        
        <!-- KOLOM KIRI: Daftar Peserta (Inbox Style) -->
        <div class="w-full md:w-1/3 card p-0 border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#1A1A2E] rounded-2xl shadow-sm flex flex-col overflow-hidden shrink-0" 
             :style="windowWidth < 768 ? 'height: 320px;' : 'max-height: 100%;'">
            
            <div class="p-4 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-[#0F0F1A]/50 shrink-0 flex flex-col gap-3">
                <input type="text" placeholder="Cari nama peserta..." x-model="searchQuery" class="w-full pl-4 pr-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-[#1A1A2E] text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-primary outline-none transition">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <select x-model="filterStatus" class="flex-1 text-xs py-1.5 px-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-[#1A1A2E] text-gray-700 dark:text-gray-300 font-medium outline-none focus:ring-1 focus:ring-primary cursor-pointer transition hover:border-primary">
                        <option value="all">Semua Peserta</option>
                        <option value="perlu_dinilai">Perlu Dinilai</option>
                        <option value="sudah_dinilai">Sudah Dinilai</option>
                        <option value="belum_kumpul">Belum Mengumpulkan</option>
                    </select>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto divide-y divide-gray-100 dark:divide-gray-800">
                
                <template x-for="student in filteredStudents" :key="student.id">
                    <div @click="activeId = student.id"
                        class="p-4 cursor-pointer transition-all duration-200 border-l-4"
                        :class="activeId === student.id ? 'bg-primary/5 border-primary' : 'border-transparent hover:bg-gray-50 dark:hover:bg-gray-800/50'">
                        
                        <div class="flex items-start justify-between mb-1">
                            <div class="flex items-center gap-3">
                                <img :src="student.avatar" class="w-9 h-9 rounded-full object-cover">
                                <div>
                                    <h4 class="text-sm font-bold dark:text-white" :class="activeId === student.id ? 'text-primary' : 'text-gray-900'" x-text="student.name"></h4>
                                    <p class="text-[10px] text-gray-400" x-text="student.submittedAt"></p>
                                </div>
                            </div>
                            <!-- Badge Status -->
                            <span x-show="student.status !== 'Belum Kumpul'" class="w-2.5 h-2.5 rounded-full mt-1" 
                                  :class="student.statusColor === 'green' ? 'bg-green-500' : (student.statusColor === 'red' ? 'bg-red-500' : 'bg-gray-400')"></span>
                        </div>
                        
                        <!-- Mini Preview -->
                        <div class="pl-12 flex items-center justify-between mt-1">
                            <span x-show="student.grade !== null" class="text-xs font-bold text-green-600 dark:text-green-400 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span x-text="student.grade + '/100'"></span>
                            </span>
                            <span x-show="student.grade === null && student.status !== 'Belum Kumpul'" class="text-xs font-medium text-orange-500">Perlu Dinilai</span>
                            <span x-show="student.status === 'Belum Kumpul'" class="text-xs font-medium text-gray-400 italic">Belum Mengumpulkan</span>
                        </div>
                    </div>
                </template>

            </div>
        </div>

        <!-- KOLOM KANAN: Detail & Form Penilaian -->
        <div class="w-full md:w-2/3 flex-1 card border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#1A1A2E] rounded-2xl shadow-sm flex flex-col overflow-hidden relative">
            
            <!-- Success Toast -->
            <div x-show="showSuccess" x-transition.opacity
                class="absolute top-4 right-4 z-10 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg text-sm font-medium flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                Nilai Disimpan!
            </div>

            <template x-if="activeStudent">
                <div class="flex-1 overflow-y-auto flex flex-col h-full">
                    
                    <!-- Header Info -->
                    <div class="p-6 border-b border-gray-100 dark:border-gray-800">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-4">
                                <img :src="activeStudent.avatar" class="w-14 h-14 rounded-full object-cover ring-4 ring-gray-50 dark:ring-gray-800">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white" x-text="activeStudent.name"></h3>
                                    <p class="text-xs text-gray-500" x-text="'Dikumpulkan pada: ' + activeStudent.submittedAt"></p>
                                </div>
                            </div>
                            <span x-show="activeStudent.status !== 'Belum Kumpul'" class="px-3 py-1 text-xs font-semibold rounded-full"
                                :class="activeStudent.statusColor === 'green' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'"
                                x-text="activeStudent.status">
                            </span>
                        </div>
                    </div>

                    <!-- Pengecekan jika belum kumpul -->
                    <div x-show="activeStudent.status === 'Belum Kumpul'" class="flex-1 flex flex-col items-center justify-center p-6 opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-lg font-medium text-gray-500 dark:text-gray-400">Peserta belum mengumpulkan tugas.</p>
                    </div>

                    <!-- Konten Tugas & Form Penilaian -->
                    <div x-show="activeStudent.status !== 'Belum Kumpul'" class="flex-1 p-6 flex flex-col xl:flex-row gap-8 overflow-y-auto">
                        
                        <!-- File & Catatan -->
                        <div class="w-full xl:w-1/2 space-y-6">
                            
                            <!-- Instruksi Pengingat -->
                            <div class="p-4 rounded-xl border border-blue-200 dark:border-blue-900/30 bg-blue-50/50 dark:bg-blue-900/10">
                                <h4 class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-wider mb-2">Instruksi Tugas</h4>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Buatlah Wireframe dan Prototype high-fidelity untuk aplikasi e-commerce lokal. Pastikan alur checkout jelas.</p>
                            </div>

                            <!-- File Attachment -->
                            <div>
                                <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">File Terlampir</p>
                                <div class="flex items-center justify-between p-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/30 group hover:border-primary transition">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-red-100 dark:bg-red-900/20 text-red-500 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white" x-text="activeStudent.fileName"></p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400" x-text="activeStudent.fileSize"></p>
                                        </div>
                                    </div>
                                    <button class="w-9 h-9 flex items-center justify-center rounded-lg bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-500 hover:text-primary hover:border-primary transition shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Form Penilaian -->
                        <div class="w-full xl:w-1/2 bg-gray-50/50 dark:bg-gray-800/30 rounded-2xl p-6 border border-gray-200 dark:border-gray-700 flex flex-col">
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-4">Panel Penilaian</h4>
                            
                            <form @submit.prevent="saveGrade" class="flex-1 flex flex-col">
                                
                                <div class="mb-5">
                                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Nilai Akhir (0-100) <span class="text-red-500">*</span></label>
                                    <div class="relative max-w-[200px]">
                                        <input type="number" min="0" max="100" required placeholder="0" x-model="activeStudent.grade"
                                            class="w-full pl-4 pr-12 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-[#0F0F1A] text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-primary outline-none transition text-2xl font-bold">
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 font-medium">/ 100</span>
                                    </div>
                                </div>

                                <div class="mb-6 flex-1 flex flex-col">
                                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Catatan Instruktur</label>
                                    <textarea placeholder="Tuliskan evaluasi, saran, atau perbaikan untuk peserta..." x-model="activeStudent.feedback"
                                        class="w-full flex-1 min-h-[120px] p-4 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-[#0F0F1A] text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-primary outline-none transition text-sm resize-none"></textarea>
                                </div>

                                <div class="pt-4 border-t border-gray-200 dark:border-gray-700 flex gap-3 mt-auto">
                                    <button type="submit" class="flex-1 py-3 rounded-xl bg-primary text-white font-semibold text-sm hover:opacity-90 transition-all flex items-center justify-center gap-2">
                                        Simpan & Lanjut
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </template>

        </div>
    </div>

</div>

@endsection
