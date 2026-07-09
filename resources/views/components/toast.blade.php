@if (session('success') || session('error') || $errors->any())
    @php
        $isSuccess = session('success') ? true : false;
    @endphp
    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:translate-x-10"
        x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed bottom-5 right-5 z-50 max-w-sm w-full bg-white dark:bg-[#1A1A2E] shadow-2xl rounded-xl border-l-4 {{ $isSuccess ? 'border-green-500' : 'border-red-500' }} overflow-hidden flex items-start p-4 gap-4"
        x-init="setTimeout(() => show = false, 5000)">

        {{-- Icon --}}
        <div class="flex-shrink-0 mt-0.5">
            @if ($isSuccess)
                <div class="w-8 h-8 bg-green-100 dark:bg-green-500/20 text-green-600 dark:text-green-400 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
            @else
                <div class="w-8 h-8 bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
            @endif
        </div>

        {{-- Content --}}
        <div class="flex-1">
            <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-1">
                {{ $isSuccess ? 'Berhasil!' : 'Oops, Terjadi Kesalahan!' }}
            </h3>
            <div class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                @if(is_array(session('success')))
                    {{ session('success')['message'] ?? 'Berhasil!' }}
                @elseif(is_array(session('error')))
                    {{ session('error')['message'] ?? 'Terjadi Kesalahan!' }}
                @elseif(session('success') || session('error'))
                    {{ session('success') ?? session('error') }}
                @endif

                @if($errors->any())
                    <div class="space-y-1 mt-1">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- Close Button --}}
        <button @click="show = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif
