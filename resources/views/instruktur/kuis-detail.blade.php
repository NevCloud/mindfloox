<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Rating Kursus</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
    </style>
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

        <x-leftPanel />

        <div class="flex flex-1 min-w-0 overflow-hidden">

            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">

                <x-topNav />

                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    <section>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-semibold dark:text-white">Beri Rating Kursus</h3>
                            <a href="{{ route('peserta.profil') }}"
                                class="flex items-center gap-2 px-3 py-1.5 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 hover:text-primary dark:hover:bg-gray-800 dark:hover:text-primary transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali ke Profil
                            </a>
                        </div>



                        <div class="card translate-none rounded-lg p-6 space-y-6">

                            <div class="border-b border-gray-200 dark:border-gray-700 pb-3">
                                <p
                                    class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-1">
                                    Program
                                </p>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                    {{ $program->nama }}
                                </h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Berikan penilaian untuk setiap kursus yang telah Anda ikuti.
                                </p>
                            </div>

                            <form method="POST" action="{{ route('peserta.ulasan.store', $pendaftaran->id) }}"
                                class="space-y-6">
                                @csrf

                                @foreach ($kursus as $item)
                                    <div
                                        class="p-4 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#1A1A2E]/40 space-y-4">

                                        <div class="flex items-center gap-2">
                                            <span class="text-sm font-bold text-primary">{{ $loop->iteration }}.</span>
                                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ $item->judul }}
                                            </h4>
                                        </div>

                                        <input type="hidden" name="ulasan[{{ $loop->index }}][id_kursus]"
                                            value="{{ $item->id }}">

                                        <div class="space-y-1.5">
                                            <label
                                                class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide block">
                                                Rating
                                            </label>
                                            <select name="ulasan[{{ $loop->index }}][rating_kursus]" class="input"
                                                required>
                                                <option value="">-- Pilih Rating --</option>
                                                @for ($i = 5; $i >= 1; $i--)
                                                    <option value="{{ $i }}"
                                                        {{ old("ulasan.$loop->index.rating_kursus") == $i ? 'selected' : '' }}>
                                                        {{ $i }} Bintang
                                                    </option>
                                                @endfor
                                            </select>
                                            @error("ulasan.$loop->index.rating_kursus")
                                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="space-y-1.5">
                                            <label
                                                class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide block">
                                                Komentar
                                            </label>
                                            <textarea rows="4" class="input" placeholder="Bagaimana pendapat Anda mengenai kursus ini?"
                                                name="ulasan[{{ $loop->index }}][komentar_kursus]">{{ old("ulasan.$loop->index.komentar_kursus") }}</textarea>
                                            @error("ulasan.$loop->index.komentar_kursus")
                                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                @endforeach

                                <div class="pt-2 border-t border-gray-200 dark:border-gray-700 flex justify-end">
                                    <button type="submit"
                                        class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white font-semibold py-2.5 px-5 rounded-lg transition duration-200 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7">
                                            </path>
                                        </svg>
                                        Simpan Rating
                                    </button>
                                </div>

                            </form>

                        </div>
                    </section>

                </div>
            </main>

            <x-rightPanel />

        </div>
    </div>
</body>

</html>
