<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - Super Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#0F0F1A]">

<div class="flex h-screen overflow-hidden">

    <!-- LEFT PANEL -->
    <x-leftPanel />

    <!--right panel-->
    <x-rightPanel />

    <!-- MAIN -->
    <div class="flex-1 overflow-y-auto">

        <!-- TOPBAR -->
        <div class="flex items-center justify-between p-5">

            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">
                    Courses Management
                </h1>

                <p class="text-gray-500 text-sm mt-1">
                    Kelola semua microcredential course
                </p>
            </div>

            <button
                class="bg-primary text-white px-5 py-3 rounded-xl shadow-lg hover:scale-105 transition">
                + Tambah Course
            </button>

        </div>

        <!-- CONTENT -->
        <div class="p-5 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

            <!-- CARD -->
            <div class="bg-white dark:bg-[#1A1A2E] rounded-3xl p-5 shadow-sm">

                <img
                    src="https://images.unsplash.com/photo-1498050108023-c5249f4df085"
                    class="w-full h-44 object-cover rounded-2xl">

                <div class="mt-4">

                    <div class="flex items-center justify-between">

                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                            Web Development
                        </h3>

                        <span
                            class="bg-green-100 text-green-600 text-xs px-3 py-1 rounded-full">
                            Aktif
                        </span>

                    </div>

                    <p class="text-gray-500 text-sm mt-3">
                        Belajar membangun aplikasi web modern menggunakan Laravel.
                    </p>

                    <!-- STATS -->
                    <div class="flex gap-3 mt-5">

                        <div class="flex-1 bg-gray-100 dark:bg-[#0F0F1A] p-3 rounded-xl">
                            <p class="text-xs text-gray-500">
                                Peserta
                            </p>

                            <h4 class="font-bold text-lg dark:text-white">
                                120
                            </h4>
                        </div>

                        <div class="flex-1 bg-gray-100 dark:bg-[#0F0F1A] p-3 rounded-xl">
                            <p class="text-xs text-gray-500">
                                Progress
                            </p>

                            <h4 class="font-bold text-lg dark:text-white">
                                78%
                            </h4>
                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex gap-2 mt-5">

                        <button
                            class="flex-1 bg-primary text-white py-3 rounded-xl">
                            Edit
                        </button>

                        <button
                            class="flex-1 bg-red-500 text-white py-3 rounded-xl">
                            Hapus
                        </button>

                    </div>

                </div>

            </div>

            <!-- CARD -->
            <div class="bg-white dark:bg-[#1A1A2E] rounded-3xl p-5 shadow-sm">

                <img
                    src="https://images.unsplash.com/photo-1559028012-481c04fa702d"
                    class="w-full h-44 object-cover rounded-2xl">

                <div class="mt-4">

                    <div class="flex items-center justify-between">

                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                            UI/UX Design
                        </h3>

                        <span
                            class="bg-yellow-100 text-yellow-600 text-xs px-3 py-1 rounded-full">
                            Pending
                        </span>

                    </div>

                    <p class="text-gray-500 text-sm mt-3">
                        Mendesain antarmuka modern dan user friendly.
                    </p>

                    <div class="flex gap-3 mt-5">

                        <div class="flex-1 bg-gray-100 dark:bg-[#0F0F1A] p-3 rounded-xl">
                            <p class="text-xs text-gray-500">
                                Peserta
                            </p>

                            <h4 class="font-bold text-lg dark:text-white">
                                80
                            </h4>
                        </div>

                        <div class="flex-1 bg-gray-100 dark:bg-[#0F0F1A] p-3 rounded-xl">
                            <p class="text-xs text-gray-500">
                                Progress
                            </p>

                            <h4 class="font-bold text-lg dark:text-white">
                                65%
                            </h4>
                        </div>

                    </div>

                    <div class="flex gap-2 mt-5">

                        <button
                            class="flex-1 bg-primary text-white py-3 rounded-xl">
                            Edit
                        </button>

                        <button
                            class="flex-1 bg-red-500 text-white py-3 rounded-xl">
                            Hapus
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>