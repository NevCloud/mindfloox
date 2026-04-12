<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
    <style>
        body {
            background: radial-gradient(circle at center, #1e0b3a, #0b0120);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center text-white">

    <!-- Background Stars -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="w-full h-full bg-[radial-gradient(white_1px,transparent_1px)] [background-size:40px_40px] opacity-20"></div>
    </div>

    <!-- Card -->
    <div class="relative w-full max-w-md p-8 rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl shadow-[0_0_60px_rgba(140,85,247,0.4)] ">

        <!-- Icon -->
        <div class="flex justify-center mb-4">
            <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-purple-500/20 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
        </div>

        <!-- Title -->
        <h2 class="text-center text-2xl font-bold">Selamat Datang</h2>
        <p class="text-center text-sm text-gray-400 mb-6">Masuk ke akun Mindfloox Anda</p>

        <!-- Error -->
        <div class="bg-red-500/20 border border-red-500 text-red-300 text-sm p-3 rounded-lg mb-4">
            The username field is required.
        </div>

        <!-- Form -->
        <form class="space-y-4">

            <!-- Username -->
            <div>
                <label class="text-sm text-gray-300">Username</label>

                <div class="relative mt-1">
                    <input type="text"
                        placeholder="Masukkan Username"
                        class="w-full p-3 pl-10 pr-10 rounded-lg bg-white/5 border border-white/10 focus:outline-none focus:ring-2 focus:ring-purple-500">

                    <!-- Icon kiri -->
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-purple-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-5" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                        </svg>

                    </span>
                </div>
            </div>

           <!-- Password -->
            <div>
                <label class="text-sm text-gray-300">Password</label>

                <div class="relative mt-1">
                    <input type="password"
                        placeholder="Masukkan password Anda"
                        class="w-full p-3 pl-10 pr-10 rounded-lg bg-white/5 border border-white/10 focus:outline-none focus:ring-2 focus:ring-purple-500">

                    <!-- Icon kiri -->
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-purple-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
            </div>

             <!-- Button -->
            <button type="submit"
                class="w-full py-3 mt-4 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 hover:opacity-90 transition">
                Masuk
            </button>

        </form>
    </div>

</body>
</html>
