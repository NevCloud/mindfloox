{{-- Materi Item Partial (Dokumen / Video / Tugas) --}}
<div x-data="{ showItem: true }" x-show="showItem"
    class="p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-[#1A1A2E] hover:shadow-md transition">
    <div class="flex items-start gap-4">

        <!-- Icon -->
        <div class="w-12 h-12 rounded-xl {{ $iconBg }} flex items-center justify-center shrink-0">
            @if(isset($iconSvg))
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 {{ $iconColor }}" fill="currentColor" viewBox="0 0 24 24">{!! $iconSvg !!}</svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 {{ $iconColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $iconPath }}" />
                </svg>
            @endif
        </div>

        <div class="flex-1">
            <!-- Title -->
            <div class="flex items-center justify-between">
                <h5 class="font-semibold text-gray-900 dark:text-white">{{ $title }}</h5>
            </div>

            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $desc }}</p>

            <!-- Meta info -->
            @if(isset($meta1) || isset($deadline))
                <div class="flex flex-wrap gap-3 mt-3 text-xs text-gray-500 dark:text-gray-400">
                    @if(isset($meta1))
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $meta1Icon }}" />
                            </svg>
                            {{ $meta1 }}
                        </span>
                    @endif
                    @if(isset($meta2))
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $meta2Icon }}" />
                                @if(isset($meta2IconExtra))
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $meta2IconExtra }}" />
                                @endif
                            </svg>
                            {{ $meta2 }}
                        </span>
                    @endif
                    @if(isset($deadline))
                        <p class="text-xs text-red-500 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Deadline: {{ $deadline }}
                        </p>
                    @endif
                </div>
            @endif

            <!-- Actions -->
            <div class="flex justify-between gap-2 mt-4">
                <div>
                    <button class="px-4 py-2 rounded-lg bg-primary text-white text-sm hover:opacity-90 transition">Download</button>
                </div>
                <div class="flex gap-2">
                    <button onclick="window.location.href='/instructor/upload-materi'"
                        class="group w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M12 20h9" /><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                        </svg>
                    </button>
                    <button @click.prevent="if(confirm('Yakin ingin menghapus item ini?')) showItem = false"
                        class="group w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6" /><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" /><path d="M10 11v6" /><path d="M14 11v6" /><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
