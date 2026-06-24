<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Mindfloox</title>
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

    <div class="max-w-7xl mx-auto flex-1">

        {{-- hero --}}
        <section class="py-8 md:py-16 px-4 grid md:grid-cols-2 gap-10 items-center">

            <div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-6">
                    Transformasi Masa Depanmu dengan
                    <span class="text-primary">Program</span> dari Ahli
                </h1>

                <p class="text-gray-500 dark:text-gray-400 mb-6 text-sm sm:text-base md:text-lg">
                    Belajar dari profesional dan tingkatkan keterampilanmu kapan saja.
                </p>

                <div class="flex gap-6 md:gap-10 mb-8" x-data="{
                    count1: 0,
                    count2: 0,
                    count3: 0,
                    animate() {
                        let duration = 2000;
                        let start = null;
                        let step = (timestamp) => {
                            if (!start) start = timestamp;
                            let progress = Math.min((timestamp - start) / duration, 1);
                            this.count1 = Math.floor(progress * 50000);
                            this.count2 = Math.floor(progress * 350);
                            this.count3 = Math.floor(progress * 98);
                            if (progress < 1) window.requestAnimationFrame(step);
                        };
                        window.requestAnimationFrame(step);
                    }
                }" x-init="animate()">
                    <div>
                        <h2 class="text-primary font-bold text-xl md:text-2xl" x-text="count1 + '+'">50000+</h2>
                        <p class="text-gray-500 text-sm">Peserta</p>
                    </div>
                    <div>
                        <h2 class="text-primary font-bold text-xl md:text-2xl" x-text="count2 + '+'">350+</h2>
                        <p class="text-gray-500 text-sm">Program</p>
                    </div>
                    <div>
                        <h2 class="text-primary font-bold text-xl md:text-2xl" x-text="count3 + '%'">98%</h2>
                        <p class="text-gray-500 text-sm">Sukses</p>
                    </div>
                </div>

                <div class="flex gap-4 flex-wrap">
                    <a href="{{ route('program.index') }}"
                        class="inline-block bg-primary text-white px-6 py-3 rounded-full hover:shadow-lg hover:-translate-y-1 transition duration-300">
                        Jelajahi Program
                    </a>

                    <a href="{{ route('tentang') }}"
                        class="inline-block border border-primary text-primary px-6 py-3 rounded-full hover:bg-primary hover:text-white hover:shadow-lg hover:-translate-y-1 transition duration-300">
                        Pelajari Lebih
                    </a>
                </div>
            </div>

            <div class="relative">
                <!-- Gambar mode terang (Light Mode) -->
                <img src="{{ asset('img/58.png') }}" alt="Mind Floox Light"
                    class="rounded-xl shadow-lg w-full dark:hidden">
                <!-- Gambar mode gelap (Dark Mode) -->
                <img src="{{ asset('img/59.png') }}" alt="Mind Floox Dark"
                    class="rounded-xl shadow-lg w-full hidden dark:block">

                <div
                    class="hidden md:flex absolute top-8 -left-10 bg-white dark:bg-[#1A1A2E] p-3 rounded-lg border border-gray-200 dark:border-gray-700 text-sm shadow-xl items-center gap-4 hover:-translate-y-2 duration-300">
                    <div class="bg-blue-100 dark:bg-blue-600/20 rounded p-2 text-blue-600 dark:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-primary font-bold">Sertifikasi Resmi</p>
                        <p class="text-gray-500 text-xs">Tingkatkan Karirmu</p>
                    </div>
                </div>

                <div
                    class="hidden md:flex absolute bottom-8 -left-5 bg-white dark:bg-[#1A1A2E] p-3 rounded-lg border border-gray-200 dark:border-gray-700 text-sm shadow-xl items-center gap-4 hover:-translate-y-2 duration-300">
                    <div class="bg-purple-100 dark:bg-purple-600/20 rounded p-2 text-purple-600 dark:text-purple-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-primary font-bold">Belajar Fleksibel</p>
                        <p class="text-gray-500 text-xs">Akses Materi 24/7</p>
                    </div>
                </div>

                <div
                    class="hidden md:flex absolute top-16 md:-right-8 bg-white dark:bg-[#1A1A2E] p-3 rounded-lg border border-gray-200 dark:border-gray-700 text-sm shadow-xl items-center gap-4 hover:-translate-y-2 duration-300">
                    <div class="bg-teal-100 dark:bg-teal-600/20 rounded p-2 text-teal-600 dark:text-teal-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-primary font-bold">Mentor Ahli</p>
                        <p class="text-gray-500 text-xs">Praktisi Berpengalaman</p>
                    </div>
                </div>

            </div>

        </section>

        {{-- program --}}
        <section class="px-4 py-16 max-w-7xl mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold mb-4 dark:text-white">
                    Daftar <span class="text-primary">Program</span>
                </h2>
                <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                @forelse ($program as $prog)
                    <div class="card">

                        <div class="relative">
                            <img src="{{ $prog->foto_program ? asset('storage/' . $prog->foto_program) : asset('img/momo.png') }}"
                                class="w-full h-48 object-cover">

                            <span class="badge left-3 bg-primary">
                                {{ $prog->jenisMicrocredential->nama ?? 'Umum' }}
                            </span>
                        </div>

                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="font-semibold text-lg mb-2">
                                {{ $prog->nama }}
                            </h3>

                            <p class="text-gray-500 text-sm mb-4 line-clamp-2">
                                {{ Str::limit(strip_tags($prog->deskripsi), 100) }}
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

                            <a href="{{ route('program.public.show', $prog->id) }}"
                                class="text-center mt-auto w-full bg-primary text-white py-2 rounded-lg">
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

            <div class="mt-10 text-center">
                <a href="{{ route('program.index') }}"
                    class="border border-primary text-primary px-6 py-3 rounded-full hover:bg-primary hover:text-white hover:shadow-lg hover:-translate-y-1 transition duration-300 font-semibold">
                    Lihat Semua Program
                </a>
            </div>
        </section>

        {{-- kategori --}}
        <section class="my-10">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-2xl md:text-3xl font-bold mb-4 dark:text-white">
                        Jelajahi <span class="text-primary">Jenis</span>
                    </h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">

                    @forelse ($kategori as $category)
                        <a href="{{ route('program.index', ['jenis' => $category->id]) }}"
                            class="group p-8 rounded-2xl border border-gray-600/0 hover:border-primary hover:shadow-lg hover:-translate-y-2 transition-transform transition-shadow duration-300 text-center relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>

                            <div
                                class="w-16 h-16 border border-gray-200 dark:border-gray-700 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:scale-110 group-hover:bg-primary group-hover:text-white group-hover:border-primary/0 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-primary group-hover:text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>

                            <h3 class="font-medium text-lg mb-1">{{ $category->nama }}</h3>
                            <p class="text-sm text-gray-400">{{ $category->program_microcredential_count ?? 0 }}
                                Program
                            </p>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-10 text-gray-500 dark:text-gray-400">
                            Belum ada jenis program yang tersedia.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- instruktur --}}
        <section class="px-4 py-16 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 dark:text-white">
                Daftar <span class="text-primary">Instruktur</span>
            </h2>

            <div class="w-20 h-1 mx-auto bg-gradient-to-r from-blue-500 to-purple-500 mb-10"></div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @forelse ($instruktur as $inst)
                    <div class="card group">

                        <div class="relative overflow-hidden">
                            <img src="{{ $inst->pengguna->foto_profil ? asset('storage/' . $inst->pengguna->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($inst->pengguna->nama) . '&background=6C63FF&color=fff&size=256' }}"
                                class="w-full h-56 object-cover group-hover:scale-110 transition duration-200">
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="font-bold text-xl mb-1">{{ $inst->pengguna->nama }}</h3>

                            <p class="text-primary text-xs uppercase mb-3 line-clamp-1">
                                {{ $inst->pengguna->role }}
                            </p>

                            <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-4 flex justify-between mb-5">
                                <div>
                                    <p class="font-bold">{{ $inst->total_peserta }}</p>
                                    <p class="text-xs text-gray-500">Students</p>
                                </div>
                                <div>
                                    <p class="font-bold">5.0</p>
                                    <p class="text-xs text-gray-500">Rating</p>
                                </div>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full text-center py-10 text-gray-500 dark:text-gray-400">
                        Belum ada instruktur yang tersedia.
                    </div>
                @endforelse

            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('instruktur.public.index') }}"
                    class="inline-block border border-primary text-primary px-6 py-3 rounded-full hover:bg-primary hover:text-white hover:shadow-lg hover:-translate-y-1 transition duration-300 font-semibold">
                    Lihat Semua Instruktur
                </a>
            </div>

        </section>

    </div>

    <x-footer />

    <x-toast />

</body>

</html>
