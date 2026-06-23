@extends('layouts.instruktur')
@section('title', 'Evaluasi Kuis')
@section('content')

    <x-banner />

    <div class="flex items-center justify-between mb-4">
        <div>
            <h3 class="text-base font-semibold dark:text-white">Evaluasi Kuis</h3>
            <p class="text-xs text-gray-400 mt-0.5">{{ $kuisList->total() }} kuis</p>
        </div>
    </div>

    @if($kuisList->isEmpty())
        <div class="text-center py-16 text-gray-400 dark:text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm">Belum ada kuis yang dibuat.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

            @foreach ($kuisList as $kuis)
                @php
                    $now = now();
                    $deadline = $kuis->batas_waktu;

                    if (!$deadline) {
                        $statusKey = 'baru';
                    } elseif ($deadline->isPast()) {
                        $statusKey = 'terlambat';
                    } elseif ($deadline->diffInDays($now) <= 3) {
                        $statusKey = 'segera';
                    } else {
                        $statusKey = 'baru';
                    }

                    $statusConfig = match($statusKey) {
                        'terlambat' => [
                            'label'    => 'Terlambat',
                            'border'   => 'border-red-500/30',
                            'bg'       => 'bg-red-500/5 dark:bg-red-500/10',
                            'badge'    => 'bg-red-500 text-white',
                            'dot'      => 'bg-red-500',
                            'text'     => 'text-red-500 dark:text-red-400',
                            'countdown'=> $deadline->diffForHumans(),
                        ],
                        'segera' => [
                            'label'    => 'Segera',
                            'border'   => 'border-yellow-500/30',
                            'bg'       => 'bg-yellow-500/5 dark:bg-yellow-500/10',
                            'badge'    => 'bg-yellow-400 text-white',
                            'dot'      => 'bg-yellow-400',
                            'text'     => 'text-yellow-600 dark:text-yellow-400',
                            'countdown'=> $deadline->diffForHumans(),
                        ],
                        default => [
                            'label'    => 'Baru',
                            'border'   => 'border-green-500/30',
                            'bg'       => 'bg-green-500/5 dark:bg-green-500/10',
                            'badge'    => 'bg-green-500 text-white',
                            'dot'      => 'bg-green-500',
                            'text'     => 'text-green-600 dark:text-green-400',
                            'countdown'=> $deadline ? $deadline->diffForHumans() : 'Tanpa deadline',
                        ],
                    };
                @endphp

                <div class="rounded-xl border {{ $statusConfig['border'] }} {{ $statusConfig['bg'] }} p-4 cursor-pointer transition-all duration-200 hover:scale-[1.01] hover:shadow-lg"
                    onclick="window.location='{{ route('instruktur.evaluasi.kuis.workspace', $kuis->id) }}'">

                    <div class="flex items-start justify-between mb-2">
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-bold px-2 py-0.5 rounded-full {{ $statusConfig['badge'] }}">
                            <span class="w-1.5 h-1.5 rounded-full animate-pulse inline-block bg-white/60"></span>
                            {{ $statusConfig['label'] }}
                        </span>
                        <span class="text-[10px] {{ $statusConfig['text'] }} font-medium">{{ $statusConfig['countdown'] }}</span>
                    </div>

                    <h4 class="text-sm font-bold dark:text-white mb-1 leading-tight">
                        {{ $kuis->judul }}
                    </h4>
                    <p class="text-[11px] text-gray-400 mb-3">{{ $kuis->kursus->nama }}</p>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5 text-[11px] font-medium {{ $statusConfig['text'] }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            {{ $deadline?->format('d M Y') ?? 'Tanpa deadline' }}
                        </div>

                        <span class="flex items-center gap-1.5 text-xs px-3 py-1 rounded-lg bg-primary hover:bg-primary/90 text-white font-medium transition cursor-pointer" onclick="window.location='{{ route('instruktur.evaluasi.kuis.workspace', $kuis->id) }}'">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            Buka Workspace
                        </span>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="mt-4">{{ $kuisList->links() }}</div>
    @endif

@endsection
