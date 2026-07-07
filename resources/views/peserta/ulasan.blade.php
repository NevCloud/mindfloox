<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Rating Kursus</title>
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
        <x-leftPanel />

        <div class="flex flex-1 overflow-hidden">
            <main class="flex-1 flex flex-col overflow-hidden">
                <x-topNav />

                <div class="flex-1 overflow-y-auto">
                    <div class="p-6 mx-auto">

                        <a href="{{ route('peserta.profil') }}"
                            class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700 mb-5">
                            ← Kembali ke Profil
                        </a>

                        <div class="card-fix p-6">

                            <h1 class="text-2xl font-bold dark:text-white">
                                Beri Rating Kursus
                            </h1>

                            <p class="text-gray-500 dark:text-gray-400 mt-2">
                                Program:
                                <span class="font-semibold">
                                    {{ $program->nama }}
                                </span>
                            </p>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-8">
                                Berikan penilaian untuk setiap kursus yang telah Anda ikuti.
                            </p>

                            @if (session('success'))
                                <div
                                    class="mb-6 rounded-lg bg-green-100 text-green-700 px-4 py-3 dark:bg-green-500/20 dark:text-green-300">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div
                                    class="mb-6 rounded-lg bg-red-100 text-red-700 px-4 py-3 dark:bg-red-500/20 dark:text-red-300">
                                    <ul class="list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('peserta.ulasan.store') }}">

                                @csrf

                                <input type="hidden" name="id_pendaftaran" value="{{ $pendaftaran->id }}">

                                @foreach ($kursus as $item)
                                    <div class="card-fix p-5 mb-6">

                                        <h3 class="text-lg font-semibold dark:text-white">
                                            {{ $item->judul }}
                                        </h3>

                                        <input type="hidden" name="ulasan[{{ $loop->index }}][id_kursus]"
                                            value="{{ $item->id }}">

                                        <div class="mt-2">

                                            <label class="block font-medium mb-4 dark:text-white">
                                                {{ $item->nama }}
                                            </label>

                                            <label class="block font-medium mb-2 dark:text-white">
                                                Rating
                                            </label>

                                            <div x-data="{
                                                open: false,
                                                current: '{{ old("ulasan.$loop->index.rating_kursus", '') }}',
                                                get label() {
                                                    return this.current ? this.current + ' Bintang' : '-- Pilih Rating --';
                                                },
                                                select(v) {
                                                    this.current = v;
                                                    this.$refs.rating.value = v;
                                                    this.open = false;
                                                }
                                            }" class="relative">

                                                <input type="hidden" x-ref="rating"
                                                    name="ulasan[{{ $loop->index }}][rating_kursus]"
                                                    :value="current">

                                                <!-- Button -->
                                                <div @click="open=!open" @click.outside="open=false"
                                                    :class="open ? 'border-primary ring-2 ring-primary/20' :
                                                        'border-gray-200 dark:border-gray-800'"
                                                    class="px-4 py-2 rounded-lg border bg-white dark:bg-[#1A1A2E] text-sm text-gray-800 dark:text-white cursor-pointer flex justify-between items-center gap-3 transition">

                                                    <span x-text="label"></span>

                                                    <svg class="w-4 h-4 text-gray-400 transition"
                                                        :class="open && 'rotate-180'" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </div>

                                                <!-- Dropdown -->
                                                <div x-cloak x-show="open" x-transition
                                                    class="absolute left-0 right-0 mt-2 bg-white dark:bg-[#1A1A2E] border border-gray-200 dark:border-gray-800 rounded-lg shadow-lg z-50 overflow-hidden">

                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <div @click="select('{{ $i }}')"
                                                            class="px-4 py-2.5 text-sm cursor-pointer hover:bg-primary/10 transition"
                                                            :class="current == '{{ $i }}' ?
                                                                'text-primary font-medium bg-primary/5' :
                                                                'text-gray-700 dark:text-gray-300'">

                                                            {{ $i }} Bintang
                                                        </div>
                                                    @endfor

                                                </div>
                                            </div>

                                            @error("ulasan.$loop->index.rating_kursus")
                                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                            @enderror

                                            @error("ulasan.$loop->index.rating_kursus")
                                                <p class="text-red-500 text-sm mt-2">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                        <div class="mt-5">

                                            <label class="block font-medium mb-2 dark:text-white">
                                                Komentar
                                            </label>

                                            <textarea rows="4" class="textarea" placeholder="Bagaimana pendapat Anda mengenai kursus ini?"
                                                name="ulasan[{{ $loop->index }}][komentar_kursus]">{{ old("ulasan.$loop->index.komentar_kursus") }}</textarea>

                                            @error("ulasan.$loop->index.komentar_kursus")
                                                <p class="text-red-500 text-sm mt-2">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>
                                @endforeach

                                <div class="flex justify-end mt-8">

                                    <button type="submit"
                                        class="px-6 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white transition">
                                        Simpan Rating
                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </main>

            <x-rightPanel />

        </div>

    </div>

</body>

</html>
