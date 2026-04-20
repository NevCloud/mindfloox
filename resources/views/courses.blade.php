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
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold dark:text-white">
                        Featured <span class="text-primary">Course</span>
                    </h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-primary to-accent mt-2"></div>
                </div>

                <div class="relative w-full sm:max-w-xs">
                    <label class="sr-only" for="search"> Search </label>

                    <input
                        class="h-10 w-full p-5 rounded-full border border-gray-300 transition-all focus:border-primary focus:ring-2 focus:ring-blue-600/20 outline-none dark:bg-gray-800 dark:border-gray-700" type="text" placeholder="Search..." />
                    <button type="button"
                        class="absolute inset-y-1 end-1 flex items-center justify-center rounded-full bg-gray-200 px-3 text-gray-600 transition hover:bg-white hover:text-primary dark:bg-gray-800 dark:text-gray-300">
                        <span class="sr-only">Search</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            </div>

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
                            </div>

                            <button class="mt-auto w-full bg-primary text-white py-2 rounded-lg">
                                Enroll Now
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
