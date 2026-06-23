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
    @include('components.stats')

    <!-- Kursus Saya -->
    <section>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-semibold dark:text-white">Kursus Saya</h3>
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

            @forelse($kursusList as $k)
                @php
                    $colors = ['#2196f3','#9c27b0','#ff9800','#f44336','#4caf50','#00bcd4'];
                    $color  = $colors[$loop->index % count($colors)];
                    $btnMap = ['#2196f3'=>'bg-blue-500 hover:bg-blue-600','#9c27b0'=>'bg-purple-500 hover:bg-purple-600','#ff9800'=>'bg-orange-500 hover:bg-orange-600','#f44336'=>'bg-red-500 hover:bg-red-600','#4caf50'=>'bg-green-500 hover:bg-green-600','#00bcd4'=>'bg-cyan-500 hover:bg-cyan-600'];
                    $btnClass = $btnMap[$color] ?? 'bg-blue-500 hover:bg-blue-600';
                    $bgRgba   = 'rgba(' . implode(',', sscanf(substr($color,1), '%02x%02x%02x')) . ',0.15)';
                    $pesertaAktif = $k->programMicrocredential ? $k->programMicrocredential->pendaftaran()->where('status', 'diterima')->count() : 0;
                    $imgSrc = $k->foto_kursus 
                        ? (str_starts_with($k->foto_kursus, 'http') ? $k->foto_kursus : asset('storage/' . $k->foto_kursus))
                        : ($k->programMicrocredential && $k->programMicrocredential->foto_program 
                            ? (str_starts_with($k->programMicrocredential->foto_program, 'http') ? $k->programMicrocredential->foto_program : asset('storage/' . $k->programMicrocredential->foto_program)) 
                            : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=400');
                    $totalWeeks = \App\Models\Minggu::where('id_kursus', $k->id)->count();
                    $instrukturName = $k->instruktur && $k->instruktur->isNotEmpty() ? $k->instruktur->first()->pengguna->nama : (Auth::user()->nama ?? 'Instruktur');
                @endphp
                <x-course-card
                    :href="route('instruktur.kursus.show', $k->id)"
                    :bg="$bgRgba"
                    :img="$imgSrc"
                    :title="$k->nama"
                    :color="$color"
                    :description="$k->deskripsi"
                    :totalWeeks="$totalWeeks"
                    :btnClass="$btnClass"
                    :showBtn="false"
                />
            @empty
                <div class="col-span-full p-4 text-center text-gray-500 text-sm">
                    Anda belum ditugaskan untuk mengajar kursus apapun.
                </div>
            @endforelse

        </div>
    </section>

@endsection
