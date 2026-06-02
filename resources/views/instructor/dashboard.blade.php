{{-- ============================================================
    Instruktur — Dashboard
    Layout: layouts.instructor
============================================================ --}}

@extends('layouts.instructor')

@section('title', 'Dashboard')

@section('content')

    <!-- Welcome Banner -->
    <x-banner />

    <!-- Stat Cards -->
    <x-stats-instructor />
        
    <!-- Course Saya -->
    <section>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-semibold dark:text-white">Course Saya</h3>
            <button onclick="window.location.href='/instructor/courses'" class="text-xs text-primary font-medium px-3 py-1.5 rounded-lg transition hover:bg-primary/20"
                style="background:rgba(108,99,255,0.10)">Lihat Semua</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">

            <!-- Course 1 -->
            <div onclick="window.location.href='/instructor/course'" class="card cursor-pointer hover:shadow-md transition p-0 overflow-hidden flex flex-row">
                <div class="flex-1 p-4">
                    <div class="flex items-stretch gap-3">
                        <div class="w-30 flex-shrink-0 rounded-xl overflow-hidden"
                            style="background:rgba(33,150,243,0.15)">
                            <img src="../img/momo.png" class="w-full h-full object-cover" alt="icon">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2 mb-0.5">
                                <h4 class="text-sm font-semibold dark:text-white truncate">UI/UX
                                    Design Specialist</h4>
                                <span class="text-xs font-bold flex-shrink-0"
                                    style="color:#2196f3">80%</span>
                            </div>
                            <p class="text-[11px] text-gray-400 mb-2">Instruktur: Sarah Wijaya</p>
                            <div class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-1.5 mb-2">
                                <div class="h-1.5 rounded-full" style="width:80%;background:#2196f3">
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-gray-400">
                                <span>8/10 Modul selesai</span>
                                <span class="text-gray-400">Hampir selesai</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course 2 -->
            <div onclick="window.location.href='/instructor/course'" class="card cursor-pointer hover:shadow-md transition p-0 overflow-hidden flex flex-row">
                <div class="flex-1 p-4">
                    <div class="flex items-stretch gap-3">
                        <div class="w-30 flex-shrink-0 rounded-xl overflow-hidden"
                            style="background:rgba(156,39,176,0.15)">
                            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085"
                                class="w-full h-full object-cover" alt="icon">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2 mb-0.5">
                                <h4 class="text-sm font-semibold dark:text-white truncate">Data
                                    Science Bootcamp</h4>
                                <span class="text-xs font-bold flex-shrink-0"
                                    style="color:#9c27b0">50%</span>
                            </div>
                            <p class="text-[11px] text-gray-400 mb-2">Instruktur: Budi Santoso</p>
                            <div class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-1.5 mb-2">
                                <div class="h-1.5 rounded-full" style="width:50%;background:#9c27b0">
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-gray-400">
                                <span>6/12 Modul selesai</span>
                                <span class="text-gray-400">Berjalan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course 3 -->
            <div onclick="window.location.href='/instructor/course'" class="card cursor-pointer hover:shadow-md transition p-0 overflow-hidden flex flex-row">
                <div class="flex-1 p-4">
                    <div class="flex items-stretch gap-3">
                        <div class="w-30 flex-shrink-0 rounded-xl overflow-hidden"
                            style="background:rgba(255,152,0,0.15)">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f"
                                class="w-full h-full object-cover" alt="icon">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2 mb-0.5">
                                <h4 class="text-sm font-semibold dark:text-white truncate">
                                    Full-stack Laravel</h4>
                                <span class="text-xs font-bold flex-shrink-0"
                                    style="color:#ff9800">15%</span>
                            </div>
                            <p class="text-[11px] text-gray-400 mb-2">Instruktur: Andi Hermawan</p>
                            <div class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-1.5 mb-2">
                                <div class="h-1.5 rounded-full" style="width:15%;background:#ff9800">
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-gray-400">
                                <span>1/8 Modul selesai</span>
                                <span class="text-gray-400">Baru mulai</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course 4 -->
            <div onclick="window.location.href='/instructor/course'"
                class="card cursor-pointer p-0 overflow-hidden flex flex-row border rounded-xl hover:shadow-md transition">
                <div class="flex-1 p-4">
                    <div class="flex items-stretch gap-3">
                        <div class="w-30 flex-shrink-0 rounded-xl overflow-hidden"
                            style="background:rgba(244,67,54,0.15)">
                            <img src="https://plus.unsplash.com/premium_photo-1661877737564-3dfd7282efcb?q=80&w=2100&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="w-full h-full object-cover" alt="icon">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2 mb-0.5">
                                <h4 class="text-sm font-semibold dark:text-white truncate">Cyber
                                    Security Basic</h4>
                                <span class="text-xs font-bold flex-shrink-0"
                                    style="color:#f44336">100%</span>
                            </div>
                            <p class="text-[11px] text-gray-400 mb-2">Instruktur: Rina Amelia</p>
                            <div class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-1.5 mb-2">
                                <div class="h-1.5 rounded-full" style="width:100%;background:#f44336">
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-gray-400">
                                <span>5/5 Modul selesai</span>
                                <span class="text-gray-400">Selesai</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
