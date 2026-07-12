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
                            class="text-xs text-gray-400 hover:text-primary flex items-center gap-1 mb-5 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                            Kembali ke Profil
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



                            @if ($errors->any())
                                <div
                                    class="mb-6 rounded-lg bg-red-100 text-red-700 px-4 py-3 dark:bg-red-500/20 dark:text-red-300">
                                    @foreach ($errors->unique() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
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

                                            <label class="block font-medium mb-2 dark:text-white">
                                                Rating {{ $item->nama }}
                                            </label>

                                            <div x-data="{
                                                current: '{{ old("ulasan.$loop->index.rating_kursus", '') }}',
                                                hover: 0,
                                                select(v) {
                                                    this.current = v;
                                                    this.$refs.rating.value = v;
                                                }
                                            }" class="flex items-center gap-1.5">

                                                <input type="hidden" x-ref="rating"
                                                    name="ulasan[{{ $loop->index }}][rating_kursus]"
                                                    :value="current">

                                                <template x-for="i in 5" :key="i">
                                                    <button type="button" @click="select(i)" @mouseenter="hover = i"
                                                        @mouseleave="hover = 0"
                                                        class="w-8 h-8 transition-all duration-150 transform hover:scale-110 focus:outline-none">

                                                        <svg class="w-full h-full stroke-2 transition-colors duration-150"
                                                            :class="(hover || current) >= i ? 'text-amber-400 fill-amber-400' :
                                                                'text-gray-300 dark:text-gray-600 fill-transparent'"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M11.48 3.499c.151-.326.623-.326.774 0l2.399 4.865 5.362.779c.36.052.504.494.243.747l-3.88 3.78 1.15 5.342c.078.363-.304.64-.627.469L12 16.732l-4.794 2.522c-.323.17-.705-.106-.627-.469l1.15-5.342-3.88-3.78c-.261-.253-.117-.7.243-.747l5.362-.779 2.399-4.865z" />
                                                        </svg>
                                                    </button>
                                                </template>
                                            </div>

                                            @error("ulasan.$loop->index.rating_kursus")
                                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                            @enderror

                                        </div>

                                    </div>
                                @endforeach

                        </div>


                        <div class="flex justify-end mt-8">

                            <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-[#6C63FF] hover:bg-[#5a52d5] text-white font-medium transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                                </svg>
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
