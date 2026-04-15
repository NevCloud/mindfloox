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
        <section class="px-4 py-16 text-center max-w-7xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 dark:text-white">
                Featured <span class="text-primary">Course</span>
            </h2>

            <div class="w-20 h-1 mx-auto bg-gradient-to-r from-primary to-accent mb-10"></div>

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

                            <p class="text-gray-500 text-sm mb-4">
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
                                <span class="text-yellow-400 text-sm">
                                    ⭐ {{ $course['rating'] }}
                                </span>
                                <span class="text-primary font-bold">
                                    ${{ $course['price'] }}
                                </span>
                            </div>

                            <a href="enroll" class="mt-auto w-full bg-primary text-white py-2 rounded-lg">
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
                            class="group p-8 rounded-2xl border border-gray-600/0 hover:border-blue-500/50 hover:shadow-lg hover:-translate-y-2 transition-transform transition-shadow duration-300 text-center relative overflow-hidden">
                                <div
                                    class="absolute inset-0 bg-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity">
                                </div>

                                <div
                                    class="w-16 h-16 border {{ $category['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:scale-110 group-hover:bg-blue-500 group-hover:text-white group-hover:border-blue-800/0 transition-all duration-300">
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
                Featured <span class="text-blue-600">Instructor</span>
            </h2>

            <div class="w-20 h-1 mx-auto bg-gradient-to-r from-blue-600 to-cyan-400 mb-10"></div>

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

                            <p class="text-blue-600 text-xs uppercase mb-3">
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

                            <button class="bg-blue-600 text-white py-2 rounded-full">
                                View Profile
                            </button>
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
