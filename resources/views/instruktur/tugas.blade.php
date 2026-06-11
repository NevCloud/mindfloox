{{-- ============================================================
    Instruktur — Tugas Perlu Dinilai
    Layout: layouts.instructor
============================================================ --}}
<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Tugas - Instruktur</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .modal-backdrop {
            backdrop-filter: blur(4px);
        }
    </style>
</head>

<body x-data="dashboardApp()" x-init="initApp()" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <x-leftPanel />

        <!-- MAIN CONTENT -->
        <main class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Nav -->
            <x-topNav />

            <!-- SCROLLABLE CONTENT -->
            <div class="flex-1 overflow-y-auto">
                <div class="p-5 space-y-5">

    <x-banner />

    <div class="flex items-center justify-between mb-4">
        <h3 class="text-base font-semibold dark:text-white">Tugas Perlu Dinilai</h3>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

        @foreach ($tugas as $task)
            <div onclick="window.location='/instruktur/tugas-kumpul'"
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

                    <a href="{{ route('instruktur.tugas-kumpul') }}"
                        class="flex items-center gap-1.5 text-xs px-3 py-1 rounded-lg transition {{ $task['ui']['button'] }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        Lihat
                    </a>

                </div>
            </div>
        @endforeach

    </div>

                </div>
            </div>

        </main>

        <!--right panel-->
        <x-rightPanel />

    </div>

    <script>
        function dashboardApp() {
            return {
                dark: localStorage.getItem('theme') === 'dark',
                toggleDark() {
                    this.dark = !this.dark;
                    localStorage.setItem('theme', this.dark ? 'dark' : 'light');
                    document.documentElement.classList.toggle('dark', this.dark);
                },
                initApp() {
                    document.documentElement.classList.toggle('dark', this.dark);
                }
            }
        }
    </script>

</body>

</html>
