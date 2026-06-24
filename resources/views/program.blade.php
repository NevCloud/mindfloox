<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program - Mindfloox</title>
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

<body class="min-h-screen flex flex-col">

    {{-- navbar --}}
    <x-navbar />

    <div class="max-w-7xl mx-auto flex-1 w-full">

        {{-- Program --}}
        <section class="px-4 py-16 text-left w-full max-w-7xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 dark:text-white">
                Daftar <span class="text-primary">Program</span>
            </h2>

            <div class="w-20 h-1 bg-gradient-to-r from-primary to-accent mb-10"></div>

            <form method="GET" action="{{ route('program.index') }}" 
                x-data="{ 
                    openJenis: false, 
                    currentJenis: '{{ request('jenis', '') }}', 
                    jenisOptions: [
                        {id:'', nama:'Semua Jenis'},
                        @foreach($kategori as $cat)
                        {id:'{{ $cat->id }}', nama:'{{ addslashes($cat->nama) }}'},
                        @endforeach
                    ],
                    get selectedJenisLabel() { 
                        const f = this.jenisOptions.find(o => o.id == this.currentJenis); 
                        return f ? f.nama : 'Semua Jenis'; 
                    },
                    selectJenis(id) { 
                        this.currentJenis = id;
                        $refs.jenisInput.value = id;
                        this.$el.submit();
                    }
                }"
                class="flex flex-col sm:flex-row items-center gap-3 mb-8 w-full z-10 relative">
                <div class="flex-1 flex items-center gap-2 bg-white dark:bg-[#1A1A2E] border border-gray-200 dark:border-gray-800 rounded-lg px-3 py-2 transition-all duration-300 focus-within:ring-2 focus-within:ring-primary focus-within:border-transparent w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama program..."
                        class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 w-full py-0.5">
                </div>

                <div class="relative w-full sm:w-auto">
                    <input type="hidden" name="jenis" x-ref="jenisInput" :value="currentJenis">
                    <div @click="openJenis = !openJenis" @click.outside="openJenis = false"
                        :class="openJenis ? 'border-primary ring-2 ring-primary/20' : 'border-gray-200 dark:border-gray-800'"
                        class="px-4 py-2 min-w-[160px] rounded-lg border bg-white dark:bg-[#1A1A2E] text-sm text-gray-800 dark:text-white cursor-pointer flex justify-between items-center gap-3 transition">
                        <span x-text="selectedJenisLabel"></span>
                        <svg class="w-4 h-4 text-gray-400 transition" :class="openJenis && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                    <div x-cloak x-show="openJenis" x-transition class="absolute left-0 right-0 mt-2 w-full sm:min-w-[160px] bg-white dark:bg-[#1A1A2E] border border-gray-200 dark:border-gray-800 rounded-lg shadow-lg z-50 overflow-hidden">
                        <template x-for="opt in jenisOptions" :key="opt.id">
                            <div @click="selectJenis(opt.id)"
                                class="px-4 py-2.5 text-sm cursor-pointer hover:bg-primary/10 transition"
                                :class="currentJenis == opt.id ? 'text-primary font-medium bg-primary/5' : 'text-gray-700 dark:text-gray-300'"
                                x-text="opt.nama"></div>
                        </template>
                    </div>
                </div>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                @forelse ($program as $prog)
                    <div class="card flex flex-col h-full">

                        <div class="relative">
                            <img src="{{ $prog->foto_program ? asset('storage/' . $prog->foto_program) : asset('img/momo.png') }}" class="w-full h-48 object-cover">

                            <span class="badge left-3 bg-primary">
                                {{ $prog->jenisMicrocredential->nama ?? 'Umum' }}
                            </span>
                        </div>

                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="font-semibold text-lg mb-2">
                                {{ $prog->nama }}
                            </h3>

                            <p class="text-gray-500 text-sm mb-4 line-clamp-2">
                                {{ $prog->deskripsi ? Str::limit(strip_tags($prog->deskripsi), 100) : 'Tidak ada deskripsi.' }}
                            </p>

                            <div class="flex justify-between items-center mb-4 mt-auto">
                                <span class="text-yellow-400 font-bold">
                                    ⭐ 5.0
                                </span>
                                <span class="flex gap-1 text-primary font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-users-icon lucide-users">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <path d="M16 3.128a4 4 0 0 1 0 7.744" />
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                        <circle cx="9" cy="7" r="4" />
                                    </svg> {{ $prog->pendaftaran_count ?? 0 }}
                                </span>
                            </div>

                            <a href="{{ route('program.public.show', $prog->id) }}" class="text-center mt-auto w-full bg-primary text-white py-2 rounded-lg">
                                Daftar Sekarang
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full text-center py-10 text-gray-500 dark:text-gray-400">
                        Belum ada program yang tersedia.
                    </div>
                @endforelse

            </div>
        </section>

    </div>

    <x-footer />

</body>

</html>
