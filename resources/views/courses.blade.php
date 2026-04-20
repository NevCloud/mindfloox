<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - Mindfloox</title>
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

        {{-- course --}}
        <section class="px-4 py-16 text-left max-w-7xl mx-auto">
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

    </div>

    <x-footer />

</body>

</html>
