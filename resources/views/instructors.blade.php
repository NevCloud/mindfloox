<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructors - Mindfloox</title>
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

        {{-- instructors --}}
        <section class="px-4 py-16 text-center">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold dark:text-white">
                        Featured <span class="text-primary">Instructors</span>
                    </h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-primary to-accent mt-2"></div>
                </div>

                <div class="relative w-full sm:max-w-xs">
                    <label class="sr-only" for="search"> Search </label>

                    <input
                        class="h-10 w-full p-5 rounded-full border border-gray-300 transition-all focus:border-blue-600/50 focus:ring-2 focus:ring-blue-600/20 outline-none dark:bg-gray-800 dark:border-gray-700 "
                        type="text" placeholder="Search..." />
                    <button type="button"
                        class="absolute inset-y-1 end-1 flex items-center justify-center rounded-full bg-gray-200 px-3 text-gray-600 transition hover:bg-gray-50 hover:text-primary dark:bg-gray-900 dark:text-gray-300">
                        <span class="sr-only">Search</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            </div>

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

        </section>

    </div>

    <x-footer />

</body>

</html>
