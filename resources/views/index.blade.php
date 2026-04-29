<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Mindfloox</title>
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

<body class="">

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
        <section class="px-4 py-16 text-left max-w-7xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 dark:text-white ">
                Featured <span class="text-primary">Course</span>
            </h2>

            <div class="w-20 h-1 bg-gradient-to-r from-primary to-accent mb-10"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                @foreach ($courses as $course)
                    <div class="card">

                        <div class="relative">
                            <img src="{{ $course['image'] }}" class="w-full h-48 object-cover">

                            <span class="badge left-3 bg-primary">
                                {{ $course['category'] }}
                            </span>

                            <span class="badge right-3 bg-secondary">
                                ${{ $course['price'] }}
                            </span>
                        </div>

                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="font-semibold text-lg mb-2">
                                {{ $course['title'] }}
                            </h3>

                            <p class="text-gray-500 text-sm mb-4 line-clamp-2">
                                Lorem ipsum dolor sit amet...
                            </p>

                            <div class="flex items-center gap-4 my-6">
                                <img src="img/momo.png" class="w-12 h-12 rounded-full object-cover">
                                <div>
                                    <p class="font-medium">{{ $course['author'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $course['role'] }}</p>
                                </div>
                            </div>

                            <div class="flex justify-between items-center mb-4">
                                <span class="text-yellow-400 font-bold">
                                    ⭐ {{ $course['rating'] }}
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
                                    </svg> {{ $course['students'] }}
                                </span>
                            </div>

                            <a href="enroll" class="text-center mt-auto w-full bg-primary text-white py-2 rounded-lg">
                                Enroll Now
                            </a>
                        </div>

                    </div>
                @endforeach

            </div>

            <div class="mt-10 text-center">
                <button
                    class="border border-primary text-primary px-6 py-3 rounded-full hover:bg-primary hover:text-white hover:shadow-lg hover:-translate-y-1 transition duration-300 font-semibold">
                    View All Course
                </button>
            </div>
        </section>

        {{-- kategori --}}
        <section class="my-10">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-2xl md:text-3xl font-bold mb-4 dark:text-white">
                        Explore Top <span class="text-primary">Course</span>
                    </h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">

                    @foreach ($categories as $category)
                        <a href="#"
                            class="group p-8 rounded-2xl border border-gray-600/0 hover:border-primary hover:shadow-lg hover:-translate-y-2 transition-transform transition-shadow duration-300 text-center relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity">
                            </div>

                            <div
                                class="w-16 h-16 border {{ $category['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:scale-110 group-hover:bg-primary group-hover:text-white group-hover:border-primary/0 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $category['icon'] }}" />
                                </svg>
                            </div>

                            <h3 class="font-medium text-lg mb-1">{{ $category['name'] }}</h3>
                            <p class="text-sm text-gray-400">{{ $category['count'] }} Courses</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- instructors --}}
        <section class="px-4 py-16 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 dark:text-white">
                Featured <span class="text-primary">Instructor</span>
            </h2>

            <div class="w-20 h-1 mx-auto bg-gradient-to-r from-blue-500 to-purple-500 mb-10"></div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach ($instructors as $inst)
                    <div class="card group">

                        <div class="relative overflow-hidden">
                            <img src="{{ $inst['image'] }}"
                                class="w-full h-56 object-cover group-hover:scale-110 transition duration-200">

                            <div class="badge left-3 bg-white text-black opacity-0 group-hover:opacity-100">
                                ⭐ {{ $inst['rating'] }}
                            </div>

                            <div class="badge right-3 bg-white text-black opacity-0 group-hover:opacity-100">
                                {{ $inst['totalCourses'] }} Course
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="font-bold text-xl mb-1">{{ $inst['name'] }}</h3>

                            <p class="text-primary text-xs uppercase mb-3">
                                {{ $inst['field'] }}
                            </p>

                            <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-4 flex justify-between mb-5">
                                <div>
                                    <p class="font-bold">{{ $inst['students'] }}</p>
                                    <p class="text-xs text-gray-500">Students</p>
                                </div>
                                <div>
                                    <p class="font-bold">{{ $inst['rating'] }}</p>
                                    <p class="text-xs text-gray-500">Rating</p>
                                </div>
                            </div>
                            {{-- Sosial Media --}}
                            <div class="flex gap-4 items-center justify-center mt-auto">

                                {{-- Twitter/X --}}
                                <a href="#"
                                    class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:border-primary hover:text-primary transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                    </svg>
                                </a>

                                {{-- Facebook --}}
                                <a href="#"
                                    class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:border-primary hover:text-primary transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                </a>

                                {{-- Instagram --}}
                                <a href="#"
                                    class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:border-primary hover:text-primary transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                    </svg>
                                </a>

                                {{-- LinkedIn --}}
                                <a href="#"
                                    class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:border-primary hover:text-primary transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                    </svg>
                                </a>

                            </div>

                        </div>

                    </div>
                @endforeach

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
