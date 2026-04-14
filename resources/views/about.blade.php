<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Mindfloox</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="overflow-x-hidden bg-white text-gray-800 dark:bg-[#0F0F1A] dark:text-white transition">

    {{-- Navbar --}}
    <x-navbar />

    <div class="max-w-7xl mx-auto px-4">

        {{-- SECTION 1: About Us --}}
        <section class="py-16 grid md:grid-cols-2 gap-12 items-center">

            {{-- Gambar kiri --}}
            <div>
                <img src="{{ asset('img/online-study.jpg') }}" class="rounded-xl shadow-lg w-full object-cover">
            </div>

            {{-- Konten kanan --}}
            <div>
                <p class="text-primary text-sm font-semibold uppercase tracking-widest mb-3">About Us</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-4 leading-tight">
                    Empowering Future Leaders Through Quality Education
                </h2>
                <p class="text-gray-500 dark:text-gray-400 mb-8 leading-relaxed text-justify">
                    Mind Floox adalah platform digital pembelajaran daring yang memungkinkan mahasiswa mengikuti kursus sesuai bidang yang diminati dan mendapatkan sertifikat digital sebagai bukti pengakuan kompetensi resmi dari institusi.
                </p>

                {{-- Statistik --}}
                <div class="flex gap-10">
                    <div>
                        <h3 class="text-primary font-bold text-3xl">15</h3>
                        <p class="text-gray-500 text-sm mt-1">Years of Experience</p>
                    </div>
                    <div>
                        <h3 class="text-primary font-bold text-3xl">200+</h3>
                        <p class="text-gray-500 text-sm mt-1">Expert Instructors</p>
                    </div>
                    <div>
                        <h3 class="text-primary font-bold text-3xl">50k+</h3>
                        <p class="text-gray-500 text-sm mt-1">Students Worldwide</p>
                    </div>
                </div>
            </div>

        </section>

        {{-- SECTION 2: Mission, Vision, Values --}}
        <section class="py-16 grid grid-cols-1 sm:grid-cols-3 gap-6">

            <div class="group shadow-lg border border-gray-200 dark:border-gray-700 rounded-xl p-8 text-center hover:-translate-y-2 transition-all duration-300 hover:border-primary/50 hover:shadow-[0_0_15px] hover:shadow-primary/40 dark:hover:shadow-primary/30">
                <div class="w-14 h-14 bg-primary/10 group-hover:bg-primary rounded-full flex items-center justify-center mx-auto mb-5 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-primary group-hover:text-white transition duration-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-lg mb-3">Our Mission</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    Menyediakan sistem terpusat yang mengintegrasikan pendaftaran, materi pembelajaran, penilaian, hingga penerbitan sertifikat digital secara otomatis dan efisien.
                </p>
            </div>

            {{-- Our Vision --}}
            <div class="group shadow-lg border border-gray-200 dark:border-gray-700 rounded-xl p-8 text-center hover:-translate-y-2 transition-all duration-300 hover:border-primary/50 hover:shadow-[0_0_15px] hover:shadow-primary/40 dark:hover:shadow-primary/30">
                <div class="w-14 h-14 bg-primary/10 group-hover:bg-primary rounded-full flex items-center justify-center mx-auto mb-5 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-primary group-hover:text-white transition duration-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-lg mb-3">Our Vision</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                   Menjadi platform unggulan dalam memberikan pengakuan resmi atas pencapaian kompetensi mahasiswa melalui mekanisme sertifikasi digital yang terstruktur dan terdokumentasi.
                </p>
            </div>

            {{-- Our Values --}}
            <div class="group shadow-lg border border-gray-200 dark:border-gray-700 rounded-xl p-8 text-center hover:-translate-y-2 transition-all duration-300 hover:border-primary/50 hover:shadow-[0_0_15px] hover:shadow-primary/40 dark:hover:shadow-primary/30">
                <div class="w-14 h-14 bg-primary/10 group-hover:bg-primary rounded-full flex items-center justify-center mx-auto mb-5 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-primary group-hover:text-white transition duration-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-lg mb-3">Our Values</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                   Mengutamakan aksesibilitas pembelajaran daring, transparansi penilaian oleh instruktur, dan kemudahan bagi peserta dalam meraih kompetensi tambahan.
                </p>
            </div>

        </section>

        {{-- SECTION 3: Why Choose Us --}}
        <section class="py-16 grid md:grid-cols-2 gap-12 items-center">

            {{-- Gambar kiri: grid 2 kolom --}}
            <div class="grid grid-cols-2 gap-4">
                <img src="{{ asset('img/images.jpg') }}" class="rounded-xl w-full h-48 object-cover">
                <img src="{{ asset('img/group.jpg') }}" class="rounded-xl w-full h-48 object-cover">
                <img src="{{ asset('img/hero.jpg') }}" class="rounded-xl w-full h-64 object-cover col-span-2">
            </div>

            {{-- Konten kanan --}}
            <div>
                <p class="text-primary text-sm font-semibold uppercase tracking-widest mb-3">Why Choose Us</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-4 leading-tight">
                    Transforming Education for a Better Tomorrow
                </h2>
                <p class="text-gray-500 dark:text-gray-400 mb-6 leading-relaxed text-justify">
                    Platform pembelajaran digital yang dirancang khusus untuk meningkatkan kompetensi mahasiswa melalui kursus fleksibel, instruktur ahli, dan sertifikasi digital otomatis yang diakui secara resmi. Kami menjembatani kesenjangan antara perkuliahan formal dan kebutuhan industri masa depan.
                </p>

                {{-- Checklist --}}
                <ul class="space-y-3 mb-8">
                    @foreach([
                        'Flexible learning options and schedules',
                        'Industry-experienced instructors',
                        'Interactive and engaging course content',
                        'Career guidance and placement support',
                        'State-of-the-art online learning platform',
                    ] as $item)
                    <li class="flex items-center gap-3 text-gray-600 dark:text-gray-300 text-sm">
                        <span class="w-5 h-5 bg-primary rounded-full flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        {{ $item }}
                    </li>
                    @endforeach
                </ul>

                {{-- CTA Button --}}
                <button class="bg-primary text-white px-6 py-3 rounded-full hover:shadow-lg hover:-translate-y-1 transition duration-300 flex items-center gap-2">
                    Discover More
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </button>
            </div>

        </section>

    </div>

    {{-- Footer --}}
    <x-footer />

</body>
</html>
