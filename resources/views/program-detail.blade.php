<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $program->nama }} - Mindfloox</title>
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

<body class="bg-gray-50 dark:bg-[#0F0F1A] min-h-screen flex flex-col">

    <x-navbar />

    <div class="max-w-7xl mx-auto px-4 py-8 flex-1">
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="md:col-span-2">
                <img src="{{ $program->foto_program ? asset('storage/' . $program->foto_program) : asset('img/momo.png') }}" class="w-full h-80 object-cover rounded-xl mb-6 shadow-md">

                <div class="flex items-center gap-2 mb-4">
                    <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-medium">
                        {{ $program->jenisMicrocredential->nama ?? 'Umum' }}
                    </span>
                </div>

                <h1 class="text-3xl font-bold mb-4 dark:text-white">{{ $program->nama }}</h1>

                <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 mb-8">
                    {!! $program->deskripsi !!}
                </div>

                <h2 class="text-2xl font-bold mb-4 dark:text-white">Kursus dalam Program Ini</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($program->kursus as $krs)
                        <div class="border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#1A1A2E] rounded-xl p-4 flex items-center gap-4">
                            <img src="{{ $krs->foto_kursus ? asset('storage/' . $krs->foto_kursus) : asset('img/momo.png') }}" class="w-16 h-16 rounded object-cover">
                            <div>
                                <h3 class="font-bold dark:text-white">{{ $krs->nama }}</h3>
                            </div>
                        </div>
                    @endforeach
                    @if($program->kursus->isEmpty())
                        <p class="text-gray-500 italic">Belum ada kursus di program ini.</p>
                    @endif
                </div>
            </div>

            <!-- Registration Sidebar -->
            <div>
                <div class="bg-white dark:bg-[#1A1A2E] rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 sticky top-24">
                    <h2 class="text-xl font-bold mb-4 dark:text-white">Pendaftaran Program</h2>
                    <p class="text-gray-500 text-sm mb-6">Silakan lengkapi formulir di bawah ini untuk mendaftar ke program ini.</p>

                    <form action="{{ route('program.public.daftar', $program->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1 dark:text-gray-300">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" required value="{{ old('nama_lengkap') }}" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-[#14142B] dark:text-gray-200 p-2.5 focus:ring-primary focus:border-primary">
                            @error('nama_lengkap') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1 dark:text-gray-300">Email</label>
                            <input type="email" name="email" required value="{{ old('email') }}" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-[#14142B] dark:text-gray-200 p-2.5 focus:ring-primary focus:border-primary">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>



                        <button type="submit" class="w-full bg-primary hover:opacity-90 hover:-translate-y-0.5 text-white font-semibold py-3 px-4 rounded-xl transition duration-300">
                            Kirim Pendaftaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
    <x-toast />

</body>
</html>
