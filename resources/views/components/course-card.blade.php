{{-- Course Card Component --}}
@props(['href' => '#', 'bg' => '', 'img' => '', 'title' => '', 'color' => '', 'description' => '', 'totalWeeks' => '0', 'btnClass' => '', 'showBtn' => false])

<a href="{{ $href }}" class="card block p-0 overflow-hidden border rounded-xl cursor-pointer hover:shadow-md transition">
    <div class="flex-1 p-4">
        <div class="flex items-stretch gap-3">
            <div class="w-36 h-24 flex-shrink-0 rounded-xl overflow-hidden" style="background:{{ $bg }}">
                <img src="{{ $img }}" class="w-full h-full object-cover" alt="icon">
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-2 mb-1">
                    <h4 class="text-sm font-semibold dark:text-white truncate">{{ $title }}</h4>
                </div>
                <p class="text-[11px] text-gray-400 mb-1 line-clamp-2">{{ $description ?? '' }}</p>
                <p class="text-[11px] text-gray-500 font-medium">Total Modul: {{ $totalWeeks ?? '0' }} Minggu Pembelajaran</p>

                @if($showBtn ?? false)
                <div class="mt-3">
                    <button class="inline-flex items-center gap-2 px-3 py-1.5 {{ $btnClass }} text-white text-xs font-semibold rounded-lg transition">
                        Kelola Kursus
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
</a>
