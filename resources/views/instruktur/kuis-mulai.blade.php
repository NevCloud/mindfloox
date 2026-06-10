<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Instruktur</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body x-data="{
    dark: localStorage.getItem('theme') === 'dark',
    toggleDark() {
        this.dark = !this.dark;
        localStorage.setItem('theme', this.dark ? 'dark' : 'light');
        document.documentElement.classList.toggle('dark', this.dark);
    }
}" x-init="document.documentElement.classList.toggle('dark', dark)" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">

        <!-- ===== LEFT PANEL ===== -->
        <x-leftPanel />

        <!-- ===== MAIN CONTENT ===== -->
        <div class="flex flex-1 min-w-0 overflow-hidden">

            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">

                <!-- Topbar -->
                <x-topNav />

                <!-- Scrollable content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    @foreach ($kuis ?? [] as $quiz)
                        <section>
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-base font-semibold dark:text-white">Pratinjau Kuis (Instruktur)</h3>
                                <button onclick="history.back()" type="button" class="flex items-center gap-2 px-3 py-1.5 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-[#1A1A2E] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    Kembali
                                </button>
                            </div>

                            <div class="card translate-none rounded-lg p-6 space-y-4">

                                <!-- Quiz Header -->
                                <div class="border-b border-gray-200 dark:border-gray-700">
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                                        {{ $quiz['title'] ?? 'Kuis' }}</h2>
                                    <div class="mb-3">
                                        <span class="inline-block px-3 py-1 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 text-xs font-semibold rounded-full">Deadline:
                                            {{ $quiz['deadline'] ?? '-' }}</span>
                                    </div>
                                </div>

                                <!-- Questions -->
                                <div class="space-y-6">
                                    @if(isset($quiz['questions']))
                                        @foreach ($quiz['questions'] as $index => $question)
                                            <div class="border-b border-gray-200 dark:border-gray-700 pb-4 last:border-b-0">
                                                <div class="mb-4">
                                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">
                                                        <span class="text-primary">{{ $index + 1 }}.</span>
                                                        {{ $question['question'] }}
                                                    </h4>
                                                </div>

                                                @if ($question['type'] === 'multiple_choice')
                                                    <div class="space-y-2 ml-4">
                                                        @foreach ($question['options'] as $key => $option)
                                                            <div class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 dark:border-gray-700">
                                                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                    <strong class="text-primary">{{ $key }}</strong>.
                                                                    {{ $option }}
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @elseif($question['type'] === 'essay')
                                                    <div class="ml-4">
                                                        <input type="text" placeholder="Format jawaban essay..." disabled class="input opacity-50 cursor-not-allowed">
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-gray-500">Belum ada pertanyaan yang dibuat.</p>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="pt-2 flex gap-2">
                                    <button type="button" class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white font-semibold py-2.5 px-4 rounded-lg transition duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        Edit Kuis
                                    </button>
                                </div>
                            </div>
                        </section>
                    @endforeach

                </div><!-- end scrollable -->
            </main>

            <!-- ===== RIGHT PANEL ===== -->
            <x-rightPanel />

        </div><!-- end inner flex -->

    </div><!-- end outer flex -->

</body>

</html>
