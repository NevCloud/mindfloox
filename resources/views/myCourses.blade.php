<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - Mindfloox</title>
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

    <div class="flex-grow max-w-7xl mx-auto w-full px-4 py-8">

        <!-- Main Content -->
        <section class="px-4 py-16 text-center">

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold dark:text-white">
                        My <span class="text-primary">Courses</span>
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

            <!-- Course Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                <!-- Course Card 1 -->
                <div class="card group relative">

                    <div class="relative overflow-hidden">
                        <img src="img/momo.png" alt="Desain Grafis" class="w-full h-48 object-cover group-hover:scale-110 transition duration-500">

                        <span class="badge left-3 bg-primary text-xs">DESIGN</span>

                        <!-- Progress Bar Overlay (custom for this page) -->
                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/80 to-transparent p-4 pb-0 opacity-100">
                            <div class="flex justify-between text-xs text-white mb-2 font-medium">
                                <span>Progress</span>
                                <span class="text-green-400">65%</span>
                            </div>
                            <div class="w-full bg-gray-600/50 rounded-full h-1.5 mb-2">
                                <div class="bg-green-400 h-1.5 rounded-full" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="font-bold text-lg mb-1 truncate dark:text-white">Desain Grafis Profesional</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-6">Instruktur: Fahad Ardin</p>

                        <div class="flex justify-between items-center text-xs mt-auto">
                            <a href="#" class="text-primary hover:text-blue-500 font-medium flex items-center gap-1 transition">
                                Lanjutkan
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Course Card 2 -->
                <div class="card group relative">

                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=400&q=80" alt="Fullstack Web Development" class="w-full h-48 object-cover group-hover:scale-110 transition duration-500">

                        <span class="badge left-3 bg-purple-600 text-xs">CODE</span>

                        <!-- Progress Bar Overlay -->
                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/80 to-transparent p-4 pb-0 opacity-100">
                            <div class="flex justify-between text-xs text-white mb-2 font-medium">
                                <span>Progress</span>
                                <span class="text-green-400">28%</span>
                            </div>
                            <div class="w-full bg-gray-600/50 rounded-full h-1.5 mb-2">
                                <div class="bg-green-400 h-1.5 rounded-full" style="width: 28%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="font-bold text-lg mb-1 truncate dark:text-white">Fullstack Web Development</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-6">Instruktur: Budi Santoso</p>

                        <div class="flex justify-between items-center text-xs mt-auto">
                            <a href="#" class="text-primary hover:text-blue-500 font-medium flex items-center gap-1 transition">
                                Lanjutkan
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    {{-- footer --}}
    <x-footer />

</body>
</html>
