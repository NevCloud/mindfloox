{{-- ============================================================
    Instruktur — Tugas Perlu Dinilai
    Layout: layouts.instructor
============================================================ --}}

@extends('layouts.instructor')

@section('title', 'Tugas')

@section('content')

    <div class="flex items-center justify-between mb-4">
        <h3 class="text-base font-semibold dark:text-white">Tugas Perlu Dinilai</h3>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

        @foreach ($tugas as $task)
            <div onclick="window.location='/instructor/tugas-detail'"
                class="card p-4 {{ $task['ui']['border'] }}">

                <div class="flex items-start justify-between mb-2">

                    <span
                        class="inline-flex items-center gap-1 text-[10px] font-semibold px-2 py-0.5 rounded-full {{ $task['ui']['badge'] }}">
                        <span
                            class="w-1.5 h-1.5 rounded-full animate-pulse inline-block {{ $task['ui']['dot'] }}"></span>
                        {{ $task['label'] }}
                    </span>

                    <span class="text-[10px] text-gray-400">{{ $task['time'] }}</span>
                </div>

                <h4 class="text-sm font-semibold dark:text-white mb-1 leading-tight">
                    {{ $task['title'] }}
                </h4>

                <p class="text-[11px] text-gray-400 mb-3">
                    {{ $task['course'] }}
                </p>

                <div class="flex items-center justify-between">

                    <div
                        class="flex items-center gap-1.5 text-[11px] font-medium {{ $task['ui']['text'] }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                        {{ $task['deadline'] }}
                    </div>

                    <a href="{{ route('instructor.tugas-kumpul') }}"
                        class="text-xs px-3 py-1 rounded-lg transition {{ $task['ui']['button'] }}">
                        Lihat
                    </a>

                </div>
            </div>
        @endforeach

    </div>

@endsection
