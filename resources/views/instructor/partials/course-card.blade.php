{{-- Course Card Partial --}}
<div onclick="window.location.href='{{ $href }}'" class="card p-0 overflow-hidden flex flex-row cursor-pointer hover:shadow-md transition">
    <div class="flex-1 p-4">
        <div class="flex items-stretch gap-3">
            <div class="w-30 flex-shrink-0 rounded-xl overflow-hidden" style="background:{{ $bg }}">
                <img src="{{ $img }}" class="w-full h-full object-cover" alt="icon">
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-2 mb-0.5">
                    <h4 class="text-sm font-semibold dark:text-white truncate">{{ $title }}</h4>
                    <span class="text-xs font-bold flex-shrink-0" style="color:{{ $color }}">{{ $percent }}</span>
                </div>
                <p class="text-[11px] text-gray-400 mb-2">Instruktur: {{ $instructor }}</p>
                <div class="w-full bg-gray-100 dark:bg-white/10 rounded-full h-1.5 mb-2">
                    <div class="h-1.5 rounded-full" style="width:{{ $width }};background:{{ $color }}"></div>
                </div>
                <div class="flex items-center justify-between text-[10px] text-gray-400 mb-3">
                    <span>{{ $modul }}</span>
                    <span>{{ $status }}</span>
                </div>
                <button class="inline-flex items-center gap-2 px-3 py-1.5 {{ $btnClass }} text-white text-xs font-semibold rounded-lg transition">
                    Lanjutkan
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
