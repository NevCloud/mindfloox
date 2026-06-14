@extends('layouts.instruktur')
@section('title', 'Kursus Saya')
@section('content')

<x-banner />

<section>
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-base font-semibold dark:text-white">Kursus Saya</h3>
        <span class="text-sm text-gray-400">{{ $kursus->count() }} kursus</span>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-xl bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-sm text-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if($kursus->isEmpty())
        <div class="text-center py-16 text-gray-400 dark:text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
            </svg>
            <p class="font-medium">Belum ada kursus yang ditugaskan</p>
            <p class="text-xs mt-1">Hubungi Admin untuk mendapatkan penugasan kursus.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($kursus as $k)
                @php
                    $colors = ['#2196f3','#9c27b0','#ff9800','#f44336','#4caf50','#00bcd4'];
                    $color  = $colors[$loop->index % count($colors)];
                    $btnMap = ['#2196f3'=>'bg-blue-500 hover:bg-blue-600','#9c27b0'=>'bg-purple-500 hover:bg-purple-600','#ff9800'=>'bg-orange-500 hover:bg-orange-600','#f44336'=>'bg-red-500 hover:bg-red-600','#4caf50'=>'bg-green-500 hover:bg-green-600','#00bcd4'=>'bg-cyan-500 hover:bg-cyan-600'];
                    $btnClass = $btnMap[$color] ?? 'bg-blue-500 hover:bg-blue-600';
                    $bgRgba   = 'rgba(' . implode(',', sscanf(substr($color,1), '%02x%02x%02x')) . ',0.15)';
                    $imgSrc   = $k->foto_kursus
                        ? (str_starts_with($k->foto_kursus, 'http') ? $k->foto_kursus : asset('storage/' . $k->foto_kursus))
                        : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=400';
                @endphp
                <x-course-card
                    :href="route('instruktur.kursus.show', $k->id)"
                    :bg="$bgRgba"
                    :img="$imgSrc"
                    :title="$k->nama"
                    :color="$color"
                    percent="0%"
                    width="0%"
                    instructor=""
                    modul=""
                    status=""
                    :btnClass="$btnClass"
                />
            @endforeach
        </div>
    @endif
</section>

@endsection
