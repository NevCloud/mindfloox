{{-- ============================================================
    Instruktur — Tugas Perlu Dinilai
    Layout: layouts.instructor
============================================================ --}}

@extends('layouts.instructor')

@section('title', 'Tugas')

@section('content')

    <x-banner />

    <div class="flex items-center justify-between mb-4">
        <h3 class="text-base font-semibold dark:text-white">Tugas Perlu Dinilai</h3>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

        @foreach ($tugas as $task)
            <div onclick="window.location='/instructor/tugas-kumpul'"
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
                        class="flex items-center gap-1.5 text-xs px-3 py-1 rounded-lg transition {{ $task['ui']['button'] }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        Lihat
                    </a>

                </div>
            </div>
        @endforeach

    </div>

@endsection
