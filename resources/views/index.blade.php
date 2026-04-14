<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mindfloox Learner</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="overflow-x-hidden bg-white text-gray-800 dark:bg-[#0F0F1A] dark:text-white transition">

    {{-- navbar --}}
    <x-navbar />

    <div class="max-w-7xl mx-auto">

        {{-- hero --}}
        <section class="py-8 md:py-16 px-4 grid md:grid-cols-2 gap-10 items-center">

            <div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-6">
                    Transform Your Future with
                    <span class="text-primary">Expert-Led</span> Courses
                </h1>

                <p class="text-gray-500 dark:text-gray-400 mb-6 text-sm sm:text-base md:text-lg">
                    Learn from professionals and upgrade your skills anytime.
                </p>

                <div class="flex gap-6 md:gap-10 mb-8">
                    <div>
                        <h2 class="text-primary font-bold text-xl md:text-2xl">50000</h2>
                        <p class="text-gray-500 text-sm">Students</p>
                    </div>
                    <div>
                        <h2 class="text-primary font-bold text-xl md:text-2xl">1200</h2>
                        <p class="text-gray-500 text-sm">Courses</p>
                    </div>
                    <div>
                        <h2 class="text-primary font-bold text-xl md:text-2xl">98%</h2>
                        <p class="text-gray-500 text-sm">Success</p>
                    </div>
                </div>

                <div class="flex gap-4 flex-wrap">
                    <button
                        class="bg-primary text-white px-6 py-3 rounded-full hover:shadow-lg hover:-translate-y-1 transition duration-300">
                        Browse Courses
                    </button>

                    <button
                        class="border border-primary text-primary px-6 py-3 rounded-full hover:bg-primary hover:text-white hover:shadow-lg hover:-translate-y-1 transition duration-300">
                        Learn More
                    </button>
                </div>
            </div>

            <div class="relative">
                <img src="img/momo.png" class="rounded-xl shadow-lg w-full">

                <div
                    class="hidden md:flex absolute top-8 -left-10 bg-white dark:bg-[#1A1A2E] p-3 rounded-lg border border-gray-200 dark:border-gray-700 text-sm shadow-xl items-center gap-4 hover:-translate-y-2 duration-300">
                    <div class="bg-blue-600/20 rounded p-2">
                        <img src="img/code-xml.svg" class="w-8 h-8">
                    </div>
                    <div>
                        <p class="text-primary font-medium">Web Development</p>
                        <p class="text-gray-500 text-xs">2,450 Students</p>
                    </div>
                </div>

                <div
                    class="hidden md:flex absolute bottom-8 -left-5 bg-white dark:bg-[#1A1A2E] p-3 rounded-lg border border-gray-200 dark:border-gray-700 text-sm shadow-xl items-center gap-4 hover:-translate-y-2 duration-300">
                    <div class="bg-blue-600/20 rounded p-2">
                        <img src="img/code-xml.svg" class="w-8 h-8">
                    </div>
                    <div>
                        <p class="text-primary font-medium">UI Design</p>
                        <p class="text-gray-500 text-xs">1,200 Students</p>
                    </div>
                </div>

                <div
                    class="hidden md:flex absolute top-16 md:-right-8 bg-white dark:bg-[#1A1A2E] p-3 rounded-lg border border-gray-200 dark:border-gray-700 text-sm shadow-xl items-center gap-4 hover:-translate-y-2 duration-300">
                    <div class="bg-blue-600/20 rounded p-2">
                        <img src="img/code-xml.svg" class="w-8 h-8">
                    </div>
                    <div>
                        <p class="text-primary font-medium">Marketing</p>
                        <p class="text-gray-500 text-xs">980 Students</p>
                    </div>
                </div>

            </div>

        </section>

        {{-- course --}}
        <section class="px-4 py-16 text-center max-w-7xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 dark:text-white">
                Featured <span class="text-primary">Course</span>
            </h2>

            <div class="w-20 h-1 mx-auto bg-gradient-to-r from-primary to-accent mb-10"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                <div
                    class="h-full flex flex-col bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="relative">
                        <img src="img/momo.png" class="w-full h-48 object-cover">
                        <span
                            class="absolute top-3 left-3 bg-primary text-white text-sm px-3 font-medium py-1 rounded-full">DESIGN</span>
                        <span
                            class="absolute top-3 right-3 bg-secondary text-white text-sm px-3 font-medium py-1 rounded-full">$49</span>
                    </div>
                    <div class="p-5 flex flex-col flex-grow text-left">
                        <h3 class="font-semibold text-lg mb-2 dark:text-white text-left">Desain Grafis</h3>
                        <p class="line-clamp-4 text-gray-500 text-sm mb-4">
                            Pelajari dasar hingga mahir desain grafis menggunakan tools modern seperti Adobe Photoshop,
                            Illustrator, dan Figma. Kurikulum mencakup teori warna, tipografi, pembuatan logo
                            profesional, hingga teknik layouting untuk media cetak dan digital yang sangat relevan
                            dengan kebutuhan industri saat ini.
                        </p>
                        <div class="flex items-center gap-4 my-6">
                            <img src="img/momo.png"
                                class="w-12 h-12 rounded-full object-cover border border-gray-100" />
                            <div class="flex flex-col"><span
                                    class="text-base text-gray-800 dark:text-gray-200 font-medium">Fahad
                                    Arifin</span><span class="text-xs text-gray-500">Graphic Designer</span></div>
                        </div>
                        <hr class="border-t border-gray-100 dark:border-gray-800 my-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-1 text-yellow-400 text-sm">⭐ ⭐ ⭐ ⭐ ⭐ <span
                                    class="text-gray-500 text-xs ml-1">(4.9)</span></div>
                            <span class="text-primary font-bold">$49</span>
                        </div>
                        <button
                            class="mt-auto w-full bg-primary text-white py-2 rounded-lg hover:bg-blue-700 transition">Enroll
                            Now</button>
                    </div>
                </div>

                <div
                    class="h-full flex flex-col bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=600"
                            class="w-full h-48 object-cover">
                        <span
                            class="absolute top-3 left-3 bg-primary text-white text-sm px-3 font-medium py-1 rounded-full">CODE</span>
                        <span
                            class="absolute top-3 right-3 bg-secondary text-white text-sm px-3 font-medium py-1 rounded-full">$89</span>
                    </div>
                    <div class="p-5 flex flex-col flex-grow text-left">
                        <h3 class="font-semibold text-lg mb-2 dark:text-white">Fullstack Web Dev</h3>
                        <p class="line-clamp-4 text-gray-500 text-sm mb-4">
                            Bangun aplikasi web modern menggunakan Laravel, Tailwind CSS, dan Vue.js. Anda akan belajar
                            mulai dari manajemen database MySQL, Entity Relationship Diagram (ERD), proses normalisasi
                            data, hingga deployment ke server produksi menggunakan Git dan GitHub secara profesional
                            untuk portofolio Anda.
                        </p>
                        <div class="flex items-center gap-4 my-6">
                            <img src="https://i.pravatar.cc/150?u=dev"
                                class="w-12 h-12 rounded-full object-cover border border-gray-100" />
                            <div class="flex flex-col"><span
                                    class="text-base text-gray-800 dark:text-gray-200 font-medium">Budi
                                    Santoso</span><span class="text-xs text-gray-500">Fullstack Engineer</span></div>
                        </div>
                        <hr class="border-t border-gray-100 dark:border-gray-800 my-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-1 text-yellow-400 text-sm">⭐ ⭐ ⭐ ⭐ ⭐ <span
                                    class="text-gray-500 text-xs ml-1">(5.0)</span></div>
                            <span class="text-primary font-bold">$89</span>
                        </div>
                        <button
                            class="mt-auto w-full bg-primary text-white py-2 rounded-lg hover:bg-blue-700 transition">Enroll
                            Now</button>
                    </div>
                </div>

                <div
                    class="h-full flex flex-col bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=600"
                            class="w-full h-48 object-cover">
                        <span
                            class="absolute top-3 left-3 bg-primary text-white text-sm px-3 font-medium py-1 rounded-full">DATA</span>
                        <span
                            class="absolute top-3 right-3 bg-secondary text-white text-sm px-3 font-medium py-1 rounded-full">$75</span>
                    </div>
                    <div class="p-5 flex flex-col flex-grow text-left">
                        <h3 class="font-semibold text-lg mb-2 dark:text-white">Data Science with Python</h3>
                        <p class="line-clamp-4 text-gray-500 text-sm mb-4">
                            Pelajari cara mengolah data mentah menjadi wawasan bisnis yang berharga. Kursus ini mencakup
                            penggunaan library populer seperti Pandas, Numpy, dan Matplotlib. Anda juga akan diajarkan
                            konsep dasar Machine Learning, pembersihan data (data cleaning), serta teknik visualisasi
                            data yang memukau.
                        </p>
                        <div class="flex items-center gap-4 my-6">
                            <img src="https://i.pravatar.cc/150?u=data"
                                class="w-12 h-12 rounded-full object-cover border border-gray-100" />
                            <div class="flex flex-col"><span
                                    class="text-base text-gray-800 dark:text-gray-200 font-medium">Siti
                                    Aminah</span><span class="text-xs text-gray-500">Data Scientist</span></div>
                        </div>
                        <hr class="border-t border-gray-100 dark:border-gray-800 my-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-1 text-yellow-400 text-sm">⭐ ⭐ ⭐ ⭐ ⭐ <span
                                    class="text-gray-500 text-xs ml-1">(4.8)</span></div>
                            <span class="text-primary font-bold">$75</span>
                        </div>
                        <button
                            class="mt-auto w-full bg-primary text-white py-2 rounded-lg hover:bg-blue-700 transition">Enroll
                            Now</button>
                    </div>
                </div>

                <div
                    class="h-full flex flex-col bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=600"
                            class="w-full h-48 object-cover">
                        <span
                            class="absolute top-3 left-3 bg-primary text-white text-sm px-3 font-medium py-1 rounded-full">SECURE</span>
                        <span
                            class="absolute top-3 right-3 bg-secondary text-white text-sm px-3 font-medium py-1 rounded-full">$99</span>
                    </div>
                    <div class="p-5 flex flex-col flex-grow text-left">
                        <h3 class="font-semibold text-lg mb-2 dark:text-white">Cyber Security Expert</h3>
                        <p class="line-clamp-4 text-gray-500 text-sm mb-4">
                            Lindungi data digital dari serangan hacker dengan mempelajari teknik penetration testing dan
                            pertahanan jaringan. Materi meliputi pengenalan Linux, pengujian celah keamanan aplikasi
                            web, kriptografi, hingga etika hacking yang diperlukan untuk menjadi seorang ahli keamanan
                            siber bersertifikat.
                        </p>
                        <div class="flex items-center gap-4 my-6">
                            <img src="https://i.pravatar.cc/150?u=sec"
                                class="w-12 h-12 rounded-full object-cover border border-gray-100" />
                            <div class="flex flex-col"><span
                                    class="text-base text-gray-800 dark:text-gray-200 font-medium">Andi
                                    Wijaya</span><span class="text-xs text-gray-500">Security Analyst</span></div>
                        </div>
                        <hr class="border-t border-gray-100 dark:border-gray-800 my-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-1 text-yellow-400 text-sm">⭐ ⭐ ⭐ ⭐ ⭐ <span
                                    class="text-gray-500 text-xs ml-1">(4.7)</span></div>
                            <span class="text-primary font-bold">$99</span>
                        </div>
                        <button
                            class="mt-auto w-full bg-primary text-white py-2 rounded-lg hover:bg-blue-700 transition">Enroll
                            Now</button>
                    </div>
                </div>

                <div
                    class="h-full flex flex-col bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=600"
                            class="w-full h-48 object-cover">
                        <span
                            class="absolute top-3 left-3 bg-primary text-white text-sm px-3 font-medium py-1 rounded-full">MOBILE</span>
                        <span
                            class="absolute top-3 right-3 bg-secondary text-white text-sm px-3 font-medium py-1 rounded-full">$69</span>
                    </div>
                    <div class="p-5 flex flex-col flex-grow text-left">
                        <h3 class="font-semibold text-lg mb-2 dark:text-white">Mobile Development (Flutter)</h3>
                        <p class="line-clamp-4 text-gray-500 text-sm mb-4">
                            Kembangkan satu basis kode untuk aplikasi Android dan iOS sekaligus menggunakan Flutter dan
                            Dart. Pelajari teknik manajemen state, integrasi API eksternal, pembuatan antarmuka pengguna
                            (UI) yang interaktif, hingga proses publikasi aplikasi Anda ke Google Play Store dan Apple
                            App Store secara mandiri.
                        </p>
                        <div class="flex items-center gap-4 my-6">
                            <img src="https://i.pravatar.cc/150?u=mob"
                                class="w-12 h-12 rounded-full object-cover border border-gray-100" />
                            <div class="flex flex-col"><span
                                    class="text-base text-gray-800 dark:text-gray-200 font-medium">Raka
                                    Pratama</span><span class="text-xs text-gray-500">Mobile Developer</span></div>
                        </div>
                        <hr class="border-t border-gray-100 dark:border-gray-800 my-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-1 text-yellow-400 text-sm">⭐ ⭐ ⭐ ⭐ ⭐ <span
                                    class="text-gray-500 text-xs ml-1">(4.9)</span></div>
                            <span class="text-primary font-bold">$69</span>
                        </div>
                        <button
                            class="mt-auto w-full bg-primary text-white py-2 rounded-lg hover:bg-blue-700 transition">Enroll
                            Now</button>
                    </div>
                </div>

                <div
                    class="h-full flex flex-col bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600"
                            class="w-full h-48 object-cover">
                        <span
                            class="absolute top-3 left-3 bg-primary text-white text-sm px-3 font-medium py-1 rounded-full">MARKETING</span>
                        <span
                            class="absolute top-3 right-3 bg-secondary text-white text-sm px-3 font-medium py-1 rounded-full">$39</span>
                    </div>
                    <div class="p-5 flex flex-col flex-grow text-left">
                        <h3 class="font-semibold text-lg mb-2 dark:text-white">Digital Marketing Strategy</h3>
                        <p class="line-clamp-4 text-gray-500 text-sm mb-4">
                            Tingkatkan penjualan bisnis Anda melalui strategi pemasaran digital yang efektif. Fokus pada
                            Search Engine Optimization (SEO), manajemen media sosial, Google Ads, hingga Copywriting.
                            Anda akan belajar cara menganalisis data pasar dan perilaku konsumen untuk membuat kampanye
                            yang berdampak tinggi.
                        </p>
                        <div class="flex items-center gap-4 my-6">
                            <img src="https://i.pravatar.cc/150?u=mkt"
                                class="w-12 h-12 rounded-full object-cover border border-gray-100" />
                            <div class="flex flex-col"><span
                                    class="text-base text-gray-800 dark:text-gray-200 font-medium">Larasati</span><span
                                    class="text-xs text-gray-500">Marketing Lead</span></div>
                        </div>
                        <hr class="border-t border-gray-100 dark:border-gray-800 my-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-1 text-yellow-400 text-sm">⭐ ⭐ ⭐ ⭐ ⭐ <span
                                    class="text-gray-500 text-xs ml-1">(4.6)</span></div>
                            <span class="text-primary font-bold">$39</span>
                        </div>
                        <button
                            class="mt-auto w-full bg-primary text-white py-2 rounded-lg hover:bg-blue-700 transition">Enroll
                            Now</button>
                    </div>
                </div>

            </div>

            <div class="mt-10 text-center">
                <button
                    class="border border-primary text-primary px-6 py-3 rounded-full hover:bg-primary hover:text-white hover:shadow-lg hover:-translate-y-1 transition duration-300 font-semibold">
                    View All Course
                </button>
            </div>
        </section>

        {{-- instructors --}}
        <section class="px-4 py-16 text-center dark:bg-[#0F0F1E]">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 dark:text-white">
                Featured <span class="text-blue-600">Instructor</span>
            </h2>

            <div class="w-20 h-1 mx-auto bg-gradient-to-r from-blue-600 to-cyan-400 mb-10"></div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 container mx-auto">

                <div
                    class="h-full flex flex-col bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group">
                    <div class="relative overflow-hidden">
                        <img src="img/momo.png" alt="instructor"
                            class="w-full h-56 object-cover transition-transform duration-500 ease-in-out group-hover:scale-110">
                        <div
                            class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-black text-sm px-3 font-semibold py-1 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center gap-1">
                            ⭐ <span class="ml-1">4.8</span>
                        </div>
                        <div
                            class="absolute top-3 right-3 bg-blue-600 text-white text-xs px-3 font-medium py-1 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center gap-1">
                            <span>18 Courses</span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow text-left">
                        <h3 class="font-bold text-xl mb-1 dark:text-white text-gray-800">Sarah Johnson</h3>
                        <p
                            class="text-blue-600 dark:text-blue-400 font-semibold text-xs uppercase tracking-wider mb-3">
                            Web Development</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-5">Spesialis di bidang
                            Frontend dengan pengalaman 5 tahun di industri kreatif.</p>
                        <div
                            class="mt-auto bg-gray-100 dark:bg-gray-800/50 rounded-xl p-4 flex justify-between text-center mb-5">
                            <div>
                                <p class="text-lg font-bold dark:text-white">2.1k</p>
                                <p class="text-[10px] text-gray-500 uppercase font-semibold">Students</p>
                            </div>
                            <div class="px-6  dark:border-gray-700">
                                <p class="text-lg font-bold dark:text-white">4.8</p>
                                <p class="text-[10px] text-gray-500 uppercase font-semibold">Rating</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <a href="#"
                                class="flex-grow text-center bg-blue-600 text-white px-4 py-2 rounded-full font-medium hover:bg-blue-700 transition">View
                                Profile</a>
                        </div>
                    </div>
                </div>

                <div
                    class="h-full flex flex-col bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=600"
                            class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                        <div
                            class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-black text-sm px-3 font-semibold py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1">
                            ⭐ <span class="ml-1">4.9</span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow text-left">
                        <h3 class="font-bold text-xl mb-1 dark:text-white text-gray-800">Alex Rivera</h3>
                        <p
                            class="text-blue-600 dark:text-blue-400 font-semibold text-xs uppercase tracking-wider mb-3">
                            UI/UX Design</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-5">Pakar desain antarmuka
                            yang fokus pada user-centric experience.</p>
                        <div
                            class="mt-auto bg-gray-100 dark:bg-gray-800/50 rounded-xl p-4 flex justify-between text-center mb-5">
                            <div>
                                <p class="text-lg font-bold dark:text-white">1.5k</p>
                                <p class="text-[10px] text-gray-500 uppercase font-semibold">Students</p>
                            </div>
                            <div class="px-6  dark:border-gray-700">
                                <p class="text-lg font-bold dark:text-white">4.9</p>
                                <p class="text-[10px] text-gray-500 uppercase font-semibold">Rating</p>
                            </div>
                        </div>
                        <a href="#"
                            class="text-center bg-blue-600 text-white px-4 py-2 rounded-full font-medium hover:bg-blue-700 transition">View
                            Profile</a>
                    </div>
                </div>

                <div
                    class="h-full flex flex-col bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=600"
                            class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                        <div
                            class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-black text-sm px-3 font-semibold py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1">
                            ⭐ <span class="ml-1">4.7</span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow text-left">
                        <h3 class="font-bold text-xl mb-1 dark:text-white text-gray-800">Michael Chen</h3>
                        <p
                            class="text-blue-600 dark:text-blue-400 font-semibold text-xs uppercase tracking-wider mb-3">
                            Backend Engineer</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-5">Membangun arsitektur
                            server yang scalable dan aman bagi startup global.</p>
                        <div
                            class="mt-auto bg-gray-100 dark:bg-gray-800/50 rounded-xl p-4 flex justify-between text-center mb-5">
                            <div>
                                <p class="text-lg font-bold dark:text-white">3.2k</p>
                                <p class="text-[10px] text-gray-500 uppercase font-semibold">Students</p>
                            </div>
                            <div class="px-6  dark:border-gray-700">
                                <p class="text-lg font-bold dark:text-white">4.7</p>
                                <p class="text-[10px] text-gray-500 uppercase font-semibold">Rating</p>
                            </div>
                        </div>
                        <a href="#"
                            class="text-center bg-blue-600 text-white px-4 py-2 rounded-full font-medium hover:bg-blue-700 transition">View
                            Profile</a>
                    </div>
                </div>

                <div
                    class="h-full flex flex-col bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=600"
                            class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                        <div
                            class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-black text-sm px-3 font-semibold py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1">
                            ⭐ <span class="ml-1">5.0</span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow text-left">
                        <h3 class="font-bold text-xl mb-1 dark:text-white text-gray-800">Sophia Miller</h3>
                        <p
                            class="text-blue-600 dark:text-blue-400 font-semibold text-xs uppercase tracking-wider mb-3">
                            Digital Marketing</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-5">Ahli SEO dan strategi
                            konten yang telah membantu ratusan brand.</p>
                        <div
                            class="mt-auto bg-gray-100 dark:bg-gray-800/50 rounded-xl p-4 flex justify-between text-center mb-5">
                            <div>
                                <p class="text-lg font-bold dark:text-white">4.5k</p>
                                <p class="text-[10px] text-gray-500 uppercase font-semibold">Students</p>
                            </div>
                            <div class="px-6  dark:border-gray-700">
                                <p class="text-lg font-bold dark:text-white">5.0</p>
                                <p class="text-[10px] text-gray-500 uppercase font-semibold">Rating</p>
                            </div>
                        </div>
                        <a href="#"
                            class="text-center bg-blue-600 text-white px-4 py-2 rounded-full font-medium hover:bg-blue-700 transition">View
                            Profile</a>
                    </div>
                </div>

            </div>

            <div class="mt-10 text-center">
                <button
                    class="border border-primary text-primary px-6 py-3 rounded-full hover:bg-primary hover:text-white hover:shadow-lg hover:-translate-y-1 transition duration-300 font-semibold">
                    View All Insctructors
                </button>
            </div>

        </section>

    </div>

    <x-footer />

</body>

</html>
