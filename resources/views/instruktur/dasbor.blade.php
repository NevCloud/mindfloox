{{-- ============================================================
    Instruktur — Dashboard
    Layout: layouts.instructor
============================================================ --}}

@extends('layouts.instruktur')

@section('title', 'Dashboard')

@section('content')

    <!-- Welcome Banner -->
    <x-banner />

    <!-- Stat Cards -->
    <x-stats />

    <!-- Course Saya -->
    <section>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-semibold dark:text-white">Course Saya</h3>
            <a href="{{ url('/instruktur/kursus') }}"
                class="flex items-center gap-1 px-3 py-1.5 text-xs text-[#6C63FF] hover:bg-gray-100 dark:hover:bg-gray-800/50 rounded-lg transition font-medium">
                Lihat Semua
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">

            <!-- Course 1 -->
            <div class="card p-0 overflow-hidden flex flex-row">
                <div class="flex-1 p-4">
                    <div class="flex items-stretch gap-3">
                        <div class="w-30 flex-shrink-0 rounded-xl overflow-hidden" style="background:rgba(33,150,243,0.15)">
                            <img src="../img/momo.png" class="w-full h-full object-cover" alt="icon">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2 mb-0.5">
                                <h4 class="text-sm font-semibold dark:text-white truncate">UI/UX
                                    Design Specialist</h4>
                            </div>
                            <p class="text-[11px] text-gray-400 mb-3">Peserta Aktif: 120 Orang</p>
                            <a href="{{ url('/instruktur/detail-kursus') }}" class="inline-flex items-center gap-2 px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold rounded-lg transition mt-2 w-max">
                                Kelola Kursus
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course 2 -->
            <div class="card p-0 overflow-hidden flex flex-row">
                <div class="flex-1 p-4">
                    <div class="flex items-stretch gap-3">
                        <div class="w-30 flex-shrink-0 rounded-xl overflow-hidden" style="background:rgba(156,39,176,0.15)">
                            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085"
                                class="w-full h-full object-cover" alt="icon">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2 mb-0.5">
                                <h4 class="text-sm font-semibold dark:text-white truncate">Data
                                    Science Bootcamp</h4>
                            </div>
                            <p class="text-[11px] text-gray-400 mb-3">Peserta Aktif: 85 Orang</p>
                            <a href="{{ url('/instruktur/detail-kursus') }}" class="inline-flex items-center gap-2 px-3 py-1.5 bg-purple-500 hover:bg-purple-600 text-white text-xs font-semibold rounded-lg transition mt-2 w-max">
                                Kelola Kursus
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course 3 -->
            <div class="card p-0 overflow-hidden flex flex-row">
                <div class="flex-1 p-4">
                    <div class="flex items-stretch gap-3">
                        <div class="w-30 flex-shrink-0 rounded-xl overflow-hidden" style="background:rgba(255,152,0,0.15)">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f"
                                class="w-full h-full object-cover" alt="icon">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2 mb-0.5">
                                <h4 class="text-sm font-semibold dark:text-white truncate">
                                    Full-stack Laravel</h4>
                            </div>
                            <p class="text-[11px] text-gray-400 mb-3">Peserta Aktif: 210 Orang</p>
                            <a href="{{ url('/instruktur/detail-kursus') }}" class="inline-flex items-center gap-2 px-3 py-1.5 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold rounded-lg transition mt-2 w-max">
                                Kelola Kursus
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course 4 -->
            <div class="card p-0 overflow-hidden flex flex-row border rounded-xl">
                <div class="flex-1 p-4">
                    <div class="flex items-stretch gap-3">
                        <div class="w-30 flex-shrink-0 rounded-xl overflow-hidden" style="background:rgba(244,67,54,0.15)">
                            <img src="https://plus.unsplash.com/premium_photo-1661877737564-3dfd7282efcb?q=80&w=2100&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="w-full h-full object-cover" alt="icon">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2 mb-0.5">
                                <h4 class="text-sm font-semibold dark:text-white truncate">Cyber
                                    Security Basic</h4>
                            </div>
                            <p class="text-[11px] text-gray-400 mb-3">Peserta Aktif: 95 Orang</p>
                            <a href="{{ url('/instruktur/detail-kursus') }}" class="inline-flex items-center gap-2 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded-lg transition mt-2 w-max">
                                Kelola Kursus
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
