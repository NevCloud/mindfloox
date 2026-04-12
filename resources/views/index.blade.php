<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mindfloox Learner</title>
    @vite('resources/css/app.css')

</head>

<body class="overflow-x-hidden bg-white text-gray-800 dark:bg-[#0F0F1A] dark:text-white transition">

    <nav class="bg-white dark:bg-[#1A1A2E] border-b dark:border-gray-700 relative">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

            <h1 class="font-bold text-lg text-primary">Mindfloox</h1>

            <ul id="menu"
                class="hidden md:flex flex-col md:flex-row gap-6 md:gap-8 text-sm md:items-center absolute md:static top-16 left-0 w-full md:w-auto bg-white/90 dark:bg-[#1A1A2E]/90 backdrop-blur-md border-b md:border-none border-gray-200 dark:border-gray-700 px-6 py-6 md:p-0">

                <li><a class="relative group py-1 block">Home
                        <span
                            class="absolute left-0 -bottom-1 w-0 h-[2px] bg-primary duration-300 group-hover:w-full"></span>
                    </a></li>

                <li><a class="relative group py-1 block">About
                        <span
                            class="absolute left-0 -bottom-1 w-0 h-[2px] bg-primary duration-300 group-hover:w-full"></span>
                    </a></li>

                <li><a class="relative group py-1 block">Course
                        <span
                            class="absolute left-0 -bottom-1 w-0 h-[2px] bg-primary duration-300 group-hover:w-full"></span>
                    </a></li>

                <li><a class="relative group py-1 block">Instructors
                        <span
                            class="absolute left-0 -bottom-1 w-0 h-[2px] bg-primary duration-300 group-hover:w-full"></span>
                    </a></li>

                <li><a class="relative group py-1 block">Contact
                        <span
                            class="absolute left-0 -bottom-1 w-0 h-[2px] bg-primary duration-300 group-hover:w-full"></span>
                    </a></li>
            </ul>

            <div class="flex items-center gap-2 md:gap-4">
                <button onclick="toggleDark()"
                    class="w-14 h-8 flex items-center bg-gray-300 dark:bg-gray-700 rounded-full p-1 transition-all duration-300">

                    <div id="toggleCircle"
                        class="w-6 h-6 bg-white dark:bg-[#1A1A2E] rounded-full shadow-md transform transition-all duration-300 flex items-center justify-center">

                        <span id="icon" class="text-xs">
                            <img src="img/moon.svg" alt="">
                        </span>

                    </div>
                </button>

                <button class="bg-primary text-white px-3 md:px-5 py-1.5 md:py-2 text-sm md:text-base rounded-full">
                    Enroll
                </button>

                <button onclick="toggleMenu()"
                    class="md:hidden relative w-8 h-8 flex flex-col justify-center items-center gap-1">
                    <span id="line1" class="w-6 h-0.5 bg-black dark:bg-white transition-all"></span>
                    <span id="line2" class="w-6 h-0.5 bg-black dark:bg-white transition-all"></span>
                    <span id="line3" class="w-6 h-0.5 bg-black dark:bg-white transition-all"></span>
                </button>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto">

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
                    <button class="bg-primary text-white px-6 py-3 rounded-full hover:shadow-lg hover:-translate-y-1 transition duration-300">
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
                    class="hidden md:flex absolute top-8 -left-10 bg-white dark:bg-[#1A1A2E] p-3 rounded-lg border dark:border-gray-700 text-sm shadow-xl items-center gap-4 hover:-translate-y-2 duration-300">
                    <div class="bg-blue-600/20 rounded p-2">
                        <img src="img/code-xml.svg" class="w-8 h-8">
                    </div>
                    <div>
                        <p class="text-primary font-medium">Web Development</p>
                        <p class="text-gray-500 text-xs">2,450 Students</p>
                    </div>
                </div>

                <div
                    class="hidden md:flex absolute bottom-8 -left-5 bg-white dark:bg-[#1A1A2E] p-3 rounded-lg border dark:border-gray-700 text-sm shadow-xl items-center gap-4 hover:-translate-y-2 duration-300">
                    <div class="bg-blue-600/20 rounded p-2">
                        <img src="img/code-xml.svg" class="w-8 h-8">
                    </div>
                    <div>
                        <p class="text-primary font-medium">UI Design</p>
                        <p class="text-gray-500 text-xs">1,200 Students</p>
                    </div>
                </div>

                <div
                    class="hidden md:flex absolute top-16 md:-right-8 bg-white dark:bg-[#1A1A2E] p-3 rounded-lg border dark:border-gray-700 text-sm shadow-xl items-center gap-4 hover:-translate-y-2 duration-300">
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

        <section class="px-4 py-16 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">
                Featured <span class="text-primary">Courses</span>
            </h2>

            <div class="w-20 h-1 mx-auto bg-gradient-to-r from-primary to-accent mb-10"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                <div
                    class="bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg border dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="relative">
                        <img src="img/momo.png" class="w-full h-48 object-cover">
                        <span class="absolute top-3 left-3 bg-primary text-white text-xs px-3 py-1 rounded-full">
                            Design
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-semibold text-lg mb-2">
                            Desain Grafis
                        </h3>
                        <p class="text-gray-500 text-sm mb-4">
                            Pelajari dasar hingga mahir desain grafis menggunakan tools modern.
                        </p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-1 text-yellow-400 text-sm">
                                ⭐ ⭐ ⭐ ⭐ ⭐
                                <span class="text-gray-500 text-xs ml-1">(4.9)</span>
                            </div>
                            <span class="text-primary font-bold">
                                $49
                            </span>
                        </div>
                        <button class="w-full bg-primary text-white py-2 rounded-lg hover:bg-secondary transition">
                            Enroll Now
                        </button>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg border dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="relative">
                        <img src="img/momo.png" class="w-full h-48 object-cover">
                        <span class="absolute top-3 left-3 bg-primary text-white text-xs px-3 py-1 rounded-full">
                            Development
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-semibold text-lg mb-2">
                            Web Development
                        </h3>
                        <p class="text-gray-500 text-sm mb-4">
                            Kuasai HTML, CSS, JavaScript hingga framework modern.
                        </p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-1 text-yellow-400 text-sm">
                                ⭐ ⭐ ⭐ ⭐ ⭐
                                <span class="text-gray-500 text-xs ml-1">(4.8)</span>
                            </div>
                            <span class="text-primary font-bold">
                                $59
                            </span>
                        </div>
                        <button class="w-full bg-primary text-white py-2 rounded-lg hover:bg-secondary transition">
                            Enroll Now
                        </button>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg border dark:border-gray-700 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="relative">
                        <img src="img/momo.png" class="w-full h-48 object-cover">
                        <span class="absolute top-3 left-3 bg-primary text-white text-xs px-3 py-1 rounded-full">
                            Marketing
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-semibold text-lg mb-2">
                            Digital Marketing
                        </h3>
                        <p class="text-gray-500 text-sm mb-4">
                            Pelajari strategi marketing, SEO, dan iklan digital efektif.
                        </p>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-1 text-yellow-400 text-sm">
                                ⭐ ⭐ ⭐ ⭐ ⭐
                                <span class="text-gray-500 text-xs ml-1">(4.7)</span>
                            </div>
                            <span class="text-primary font-bold">
                                $39
                            </span>
                        </div>
                        <button class="w-full bg-primary text-white py-2 rounded-lg hover:bg-secondary transition">
                            Enroll Now
                        </button>
                    </div>
                </div>

            </div>

        </section>

    </div>

    <!-- SCRIPT -->
    <script>
        function toggleMenu() {
            const menu = document.getElementById("menu");
            const l1 = document.getElementById("line1");
            const l2 = document.getElementById("line2");
            const l3 = document.getElementById("line3");

            menu.classList.toggle("hidden");

            l1.classList.toggle("rotate-45");
            l1.classList.toggle("translate-y-1.5");

            l2.classList.toggle("opacity-0");

            l3.classList.toggle("-rotate-45");
            l3.classList.toggle("-translate-y-1.5");
        }

        const html = document.documentElement
        const circle = document.getElementById("toggleCircle")
        const icon = document.getElementById("icon")

        // INIT
        if (localStorage.getItem('theme') === 'dark') {
            html.classList.add('dark')
            circle.classList.add('translate-x-6')
            icon.innerHTML = '<img src="img/sun.svg" class="w-4 h-4 invert brightness-0">'
        } else {
            icon.innerHTML = '<img src="img/moon.svg" class="w-4 h-4">'
        }

        function toggleDark() {
            html.classList.toggle('dark')

            if (html.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark')
                circle.classList.add('translate-x-6')
                icon.innerHTML = '<img src="img/sun.svg" class="w-4 h-4 invert brightness-0">'
            } else {
                localStorage.setItem('theme', 'light')
                circle.classList.remove('translate-x-6')
                icon.innerHTML = '<img src="img/moon.svg" class="w-4 h-4">'
            }
        }
    </script>

</body>

</html>
