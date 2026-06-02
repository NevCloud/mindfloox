@extends('layouts.instructor')
@section('title', 'Course')
@section('content')

<section class="space-y-5">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Materi Kursus</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Pelajari materi per minggu secara terstruktur</p>
        </div>
    </div>

    <!-- WEEK CARD -->
    <div class="card translate-0 rounded-2xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700"
        x-data="{ open: true }">

        <!-- HEADER -->
        <div class="w-full flex items-center justify-between px-5 py-4 bg-white dark:bg-[#1A1A2E] border-b border-gray-200 dark:border-gray-700">
            <div @click="open = !open" class="flex items-center gap-4 cursor-pointer flex-1">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold">1</div>
                <div class="text-left">
                    <h4 class="font-semibold text-gray-900 dark:text-white">Minggu 1: Pengenalan HTML</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Dasar struktur halaman web</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="/instructor/upload-materi" @click.stop class="px-4 py-2 rounded-lg bg-primary text-white text-sm hover:opacity-90 transition">Upload Materi</a>
                <button @click.stop="open = !open" class="w-9 h-9 flex items-center justify-center">
                    <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- CONTENT -->
        <div x-show="open" x-transition class="border-t border-gray-200 dark:border-gray-700 p-5 space-y-4">

            <!-- DOKUMEN -->
            @include('instructor.partials.materi-item', [
                'type' => 'dokumen',
                'iconBg' => 'bg-red-100 dark:bg-red-900/20',
                'iconColor' => 'text-red-600',
                'iconPath' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                'title' => 'Dasar HTML - Panduan Lengkap',
                'desc' => 'Panduan komprehensif tentang struktur HTML, tag dasar, dan best practice.',
                'meta1Icon' => 'M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10',
                'meta1' => '2.4 MB',
                'meta2Icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                'meta2' => '15 Jan 2024',
            ])

            <!-- VIDEO -->
            @include('instructor.partials.materi-item', [
                'type' => 'video',
                'iconBg' => 'bg-blue-100 dark:bg-blue-900/20',
                'iconColor' => 'text-blue-600',
                'iconSvg' => '<path d="M8 5v14l11-7z" />',
                'title' => 'Pengenalan Tag HTML Dasar',
                'desc' => 'Video tutorial tag HTML seperti heading, paragraph, list, dan link.',
                'meta1Icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                'meta1' => '12:45',
                'meta2Icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z',
                'meta2IconExtra' => 'M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z',
                'meta2' => '234 views',
            ])

            <!-- TUGAS -->
            @include('instructor.partials.materi-item', [
                'type' => 'tugas',
                'iconBg' => 'bg-purple-100 dark:bg-purple-900/20',
                'iconColor' => 'text-purple-600',
                'iconPath' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                'title' => 'Tugas: Halaman HTML Sederhana',
                'desc' => 'Buat halaman HTML biodata pribadi dengan minimal 5 tag.',
                'deadline' => '20 Jan 2024',
            ])

        </div>
    </div>
</section>

@endsection
