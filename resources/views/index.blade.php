<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mindfloox Learner</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-x-hidden bg-white text-gray-800 dark:bg-[#0F0F1A] dark:text-white transition">

    {{-- NAVBAR --}}
    <x-navbar />

    <div class="max-w-7xl mx-auto">

        {{-- HERO SECTION --}}
        <section class="py-8 md:py-16 px-4 grid md:grid-cols-2 gap-10 items-center">

            <div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-6">
                    Transform Your Future with
                    <span class="text-primary">Expert-Led</span> Courses
                </h1>

                <p class="text-gray-500 dark:text-gray-400 mb-6 text-sm sm:text-base md:text-lg">
                    Learn from professionals and upgrade your skills anytime.
                </p>

                {{-- Statistik --}}
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

                {{-- CTA buttons --}}
                <div class="flex gap-4 flex-wrap">
                    <button class="bg-primary text-white px-6 py-3 rounded-full hover:shadow-lg hover:-translate-y-1 transition duration-300">
                        Browse Courses
                    </button>
                    <button class="border border-primary text-primary px-6 py-3 rounded-full hover:bg-primary hover:text-white hover:shadow-lg hover:-translate-y-1 transition duration-300">
                        Learn More
                    </button>
                </div>
            </div>

            {{-- Gambar hero + floating cards --}}
            <div class="relative">
                <img src="img/momo.png" class="rounded-xl shadow-lg w-full">

                {{-- Floating card: Web Development --}}
                <div class="hidden md:flex absolute top-8 -left-10 bg-white dark:bg-[#1A1A2E] p-3 rounded-lg border dark:border-gray-700 text-sm shadow-xl items-center gap-4 hover:-translate-y-2 duration-300">
                    <div class="bg-blue-600/20 rounded p-2">
                        <img src="img/code-xml.svg" class="w-8 h-8">
                    </div>
                    <div>
                        <p class="text-primary font-medium">Web Development</p>
                        <p class="text-gray-500 text-xs">2,450 Students</p>
                    </div>
                </div>

                {{-- Floating card: UI Design --}}
                <div class="hidden md:flex absolute bottom-8 -left-5 bg-white dark:bg-[#1A1A2E] p-3 rounded-lg border dark:border-gray-700 text-sm shadow-xl items-center gap-4 hover:-translate-y-2 duration-300">
                    <div class="bg-blue-600/20 rounded p-2">
                        <img src="img/code-xml.svg" class="w-8 h-8">
                    </div>
                    <div>
                        <p class="text-primary font-medium">UI Design</p>
                        <p class="text-gray-500 text-xs">1,200 Students</p>
                    </div>
                </div>

                {{-- Floating card: Marketing --}}
                <div class="hidden md:flex absolute top-16 md:-right-8 bg-white dark:bg-[#1A1A2E] p-3 rounded-lg border dark:border-gray-700 text-sm shadow-xl items-center gap-4 hover:-translate-y-2 duration-300">
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

        {{-- FEATURED COURSES SECTION --}}
        <section class="px-4 py-16 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">
                Featured <span class="text-primary">Courses</span>
            </h2>

            <div class="w-20 h-1 mx-auto bg-gradient-to-r from-primary to-accent mb-10"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                {{-- Card: Desain Grafis --}}
                <div class="bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg border dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="relative">
                        <img src="img/momo.png" class="w-full h-48 object-cover">
                        <span class="absolute top-3 left-3 bg-primary text-white text-xs px-3 py-1 rounded-full">Design</span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-semibold text-lg mb-2">Desain Grafis</h3>
                        <p class="text-gray-500 text-sm mb-4">Pelajari dasar hingga mahir desain grafis menggunakan tools modern.</p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-1 text-yellow-400 text-sm">
                                ⭐ ⭐ ⭐ ⭐ ⭐
                                <span class="text-gray-500 text-xs ml-1">(4.9)</span>
                            </div>
                            <span class="text-primary font-bold">$49</span>
                        </div>
                        <button class="w-full bg-primary text-white py-2 rounded-lg hover:bg-secondary transition">Enroll Now</button>
                    </div>
                </div>

                {{-- Card: Web Development --}}
                <div class="bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg border dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="relative">
                        <img src="img/momo.png" class="w-full h-48 object-cover">
                        <span class="absolute top-3 left-3 bg-primary text-white text-xs px-3 py-1 rounded-full">Development</span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-semibold text-lg mb-2">Web Development</h3>
                        <p class="text-gray-500 text-sm mb-4">Kuasai HTML, CSS, JavaScript hingga framework modern.</p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-1 text-yellow-400 text-sm">
                                ⭐ ⭐ ⭐ ⭐ ⭐
                                <span class="text-gray-500 text-xs ml-1">(4.8)</span>
                            </div>
                            <span class="text-primary font-bold">$59</span>
                        </div>
                        <button class="w-full bg-primary text-white py-2 rounded-lg hover:bg-secondary transition">Enroll Now</button>
                    </div>
                </div>

                {{-- Card: Digital Marketing --}}
                <div class="bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="relative">
                        <img src="img/momo.png" class="w-full h-48 object-cover">
                        <span class="absolute top-3 left-3 bg-primary text-white text-xs px-3 py-1 rounded-full">Marketing</span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-semibold text-lg mb-2">Digital Marketing</h3>
                        <p class="text-gray-500 text-sm mb-4">Pelajari strategi marketing, SEO, dan iklan digital efektif.</p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-1 text-yellow-400 text-sm">
                                ⭐ ⭐ ⭐ ⭐ ⭐
                                <span class="text-gray-500 text-xs ml-1">(4.7)</span>
                            </div>
                            <span class="text-primary font-bold">$39</span>
                        </div>
                        <button class="w-full bg-primary text-white py-2 rounded-lg hover:bg-secondary transition">Enroll Now</button>
                    </div>
                </div>

            </div>
        </section>
    </div>

    {{-- FOOTER --}}
    <x-footer />

</body>
</html>
