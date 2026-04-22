<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Peserta</title>
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

<body x-data="{
    dark: localStorage.getItem('theme') === 'dark',
    toggleDark() {
        this.dark = !this.dark;
        localStorage.setItem('theme', this.dark ? 'dark' : 'light');
        document.documentElement.classList.toggle('dark', this.dark);
    }
}" x-init="document.documentElement.classList.toggle('dark', dark)" class="relative bg-gray-50 dark:bg-[#0F0F1A]">

    <!-- Alpine.js -->

    <div class="flex h-screen overflow-hidden">

        <!-- ===== LEFT PANEL ===== -->
        <x-leftPanel />

        <!-- ===== MAIN CONTENT ===== -->
        <div class="flex flex-1 min-w-0 overflow-hidden">

            <main class="flex-1 min-w-0 flex flex-col overflow-hidden">

                <!-- Topbar -->
                <div
                    class="flex items-center gap-3 px-4 py-3 bg-gray-100 dark:bg-[#1A1A2E] border-b border-black/5 dark:border-white/5 flex-shrink-0 transition-all duration-300">
                    <!-- Mobile left toggle -->
                    <button onclick="document.getElementById('leftPanel').classList.toggle('-translate-x-full')"
                        class="md:hidden w-9 h-9 flex items-center justify-center rounded-lg bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <line x1="3" y1="12" x2="21" y2="12" />
                            <line x1="3" y1="18" x2="21" y2="18" />
                        </svg>
                    </button>

                    <!-- Search -->
                    <div
                        class="flex-1 flex items-center gap-2 bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-2 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 flex-shrink-0"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                        <input type="text" placeholder="Cari course, tugas, materi..."
                            class="flex-1 bg-transparent border-0 outline-none text-sm text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500">
                    </div>

                    <!-- Notification -->
                    <button
                        class="relative w-9 h-9 flex items-center justify-center rounded-lg bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-primary transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- Dark mode toggle -->
                    <button @click="toggleDark()"
                        class="w-14 h-8 flex items-center rounded-full p-1 transition-all duration-300"
                        :class="dark ? 'bg-gray-700' : 'bg-gray-300'">

                        <div :class="dark ? 'translate-x-6' : 'translate-x-0'"
                            class="w-6 h-6 bg-white dark:bg-[#1A1A2E] rounded-full shadow-md transform transition-all duration-300 flex items-center justify-center">

                            {{-- Moon Icon --}}
                            <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4 text-gray-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                            </svg>

                            {{-- Sun Icon --}}
                            <svg x-show="dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4 text-yellow-300">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                            </svg>
                        </div>
                    </button>


                    <!-- Mobile right toggle -->
                    <button onclick="document.getElementById('rightPanel').classList.toggle('translate-x-full')"
                        class="lg:hidden w-9 h-9 flex items-center justify-center rounded-lg bg-white dark:bg-[#0F0F1A] border border-gray-200 dark:border-gray-700 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                    </button>
                </div>

                <!-- Scrollable content -->
                <div class="flex-1 overflow-y-auto p-5 space-y-5">

                    <!-- Welcome Banner -->
                    <x-banner />

                    <!-- Stat Cards -->
                    <x-stats />

                    <section>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-semibold dark:text-white">Kumpul Tugas</h3>
                        </div>
                        <div class="">
                            <div class="card translate-none rounded-lg p-6 space-y-4">

                                <!-- Task Header -->
                                <div class="border-b border-gray-200 dark:border-gray-700">
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Analisis Algoritma Sorting</h2>
                                    <div class="mb-3">
                                        <span class="inline-block px-3 py-1 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 text-xs font-semibold rounded-full">Deadline: 15 Jan 2024</span>
                                    </div>
                                </div>

                                <!-- Form Section -->
                                <form class="space-y-4" x-data="{ files: [], isDragOver: false }" @submit.prevent="submitForm">
                                    <!-- Drag & Drop Upload Area -->
                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <label
                                                class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">
                                                Upload File
                                            </label>
                                        </div>
                                        <div @dragover.prevent="isDragOver = true"
                                            @dragleave.prevent="isDragOver = false"
                                            @drop.prevent="isDragOver = false; handleDrop($event)"
                                            class="border-2 border-dashed rounded-lg p-6 text-center transition-colors duration-200 cursor-pointer"
                                            :class="isDragOver ? 'border-primary bg-primary/10 dark:bg-primary/20' :
                                                'border-gray-300 dark:border-gray-600'"
                                            @click="$refs.fileInput.click()">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-12 h-12 mx-auto mb-4 text-gray-400 dark:text-gray-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p class="text-gray-600 dark:text-gray-400 mb-2">Drag and drop files here
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-500">or <span
                                                    class="text-primary underline">browse</span> to choose files</p>
                                            <input x-ref="fileInput" type="file" class="hidden" multiple
                                                @change="handleFileSelect($event)">
                                        </div>
                                        <button @click="$refs.fileInput.click()" type="button"
                                            class="flex items-center gap-2 mt-3 bg-primary hover:bg-primary/90 text-white font-semibold py-1 px-3 rounded-lg transition duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                            Add More Files
                                        </button>

                                        <!-- File List with Preview -->
                                        <div x-show="files.length > 0" class="mt-4 space-y-3">
                                            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Selected
                                                Files:</p>
                                            <ul class="space-y-2">
                                                <li x-for="(file, index) in files"
                                                    class="flex items-center gap-3 bg-gray-100 dark:bg-gray-800 p-3 rounded">
                                                    <!-- File Preview Icon -->
                                                    <div
                                                        class="relative w-10 h-10 bg-gray-300 dark:bg-gray-700 rounded flex items-center justify-center shrink-0">
                                                        <svg x-show="!file.type.startsWith('image')"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="w-5 h-5 text-gray-600 dark:text-gray-400"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                        <img x-show="file.type.startsWith('image')"
                                                            :src="file.preview"
                                                            class="w-10 h-10 object-cover rounded">
                                                        <!-- Overlay Remove Button for Images -->
                                                        <button x-show="file.type.startsWith('image')" @click="files.splice(index, 1)" type="button"
                                                            class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs hover:bg-red-700">
                                                            ×
                                                        </button>
                                                    </div>

                                                    <!-- File Info -->
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-gray-700 dark:text-white truncate"
                                                            x-text="file.name"></p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400"
                                                            x-text="`${(file.size / 1024).toFixed(2)} KB`"></p>
                                                    </div>

                                                    <!-- Remove Button (for non-images or as fallback) -->
                                                    <button x-show="!file.type.startsWith('image')" @click="files.splice(index, 1)" type="button"
                                                        class="text-red-500 hover:text-red-700 shrink-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Notes Section -->
                                    <div>
                                        <label
                                            class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-2 block uppercase tracking-wide">
                                            Catatan
                                        </label>
                                        <textarea rows="4" class="textarea" placeholder="Tambahkan catatan..."></textarea>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="pt-2 flex gap-2">
                                        <button type="submit"
                                            class="bg-primary hover:bg-primary/90 text-white font-semibold py-2.5 px-4 rounded-lg transition duration-200">
                                            Kumpulkan
                                        </button>
                                        <button type="reset"
                                            class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-semibold py-2.5 px-4 rounded-lg transition duration-200">
                                            Reset
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>

                </div><!-- end scrollable -->
            </main>

            <!-- ===== RIGHT PANEL ===== -->
            <x-rightPanel />

        </div><!-- end inner flex -->

    </div><!-- end outer flex -->

</body>

</html>
