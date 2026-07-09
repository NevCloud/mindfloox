<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Akun & Status Pendaftaran - Mindfloox</title>
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

    {{-- Navbar --}}
    <x-navbar />

    <section class="flex items-center justify-center px-4 py-16 flex-1">
        <div class="w-full max-w-md p-8 card">

            {{-- Icon user --}}
            <div class="flex justify-center mb-5">
                <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-primary/10 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12-3-3m0 0-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
            </div>

            <h2 class="text-center text-2xl text-primary font-bold">Cek Status Pendaftaran</h2>
            <p class="text-center text-sm text-gray-400 dark:text-gray-300 mb-6">Masukkan email yang digunakan saat pendaftaran untuk melihat status verifikasi Anda.</p>

            @if(session('error'))
                <div class="bg-red-50 border border-red-300 text-red-500 text-sm p-3 rounded-xl mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('info'))
                <div class="bg-blue-50 border border-blue-300 text-blue-500 text-sm p-3 rounded-xl mb-4">
                    {{ session('info') }}
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-50 border border-green-300 text-green-700 p-4 rounded-xl mb-6 text-sm">
                    <h3 class="font-bold mb-2 text-green-600">{{ session('success')['message'] }}</h3>
                    <p class="mb-1"><strong>Username:</strong> {{ session('success')['username'] }}</p>
                    <p class="mb-3"><strong>Password:</strong> {{ session('success')['password'] }}</p>

                    <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 p-2 text-xs mb-4">
                        ⚠️ <strong>PERINGATAN:</strong> Demi keamanan akun Anda, mohon segera mengganti password Anda setelah berhasil login!
                    </div>

                    <a href="{{ route('login') }}" class="block text-center bg-green-500 text-white py-2 rounded-lg font-semibold hover:bg-green-600 transition">
                        Menuju Halaman Login
                    </a>
                </div>
            @elseif(session('cekakun_locked_until') && session('cekakun_locked_until') > time())
                <div class="bg-red-50 border border-red-300 text-red-500 text-sm p-4 rounded-xl mb-4 text-center">
                    <p class="font-bold mb-2">Batas Percobaan Habis</p>
                    <p>Anda telah mencapai batas maksimal 3 kali percobaan. Silakan coba lagi besok jam 06:00.</p>
                </div>
            @else
                <form action="{{ route('cek-akun.process') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="text-sm font-medium mb-2 block">Alamat Email</label>
                        <div class="relative">
                            <input type="email" name="email" required value="{{ old('email') }}"
                                class="input pl-10"
                                placeholder="nama@email.com">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                        </div>
                        @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit"
                        class="w-full py-3 mt-2 rounded-xl bg-primary text-white font-semibold hover:opacity-90 hover:-translate-y-0.5 transition duration-300">
                        Cek Status
                    </button>
                </form>
            @endif

            <p class="text-center text-sm text-gray-400 mt-6">
                <a href="{{ route('login') }}" class="text-primary font-medium hover:underline">Kembali ke Halaman Login</a>
            </p>

        </div>
    </section>

    {{-- Footer --}}
    <x-footer />

    <x-toast />

</body>
</html>
