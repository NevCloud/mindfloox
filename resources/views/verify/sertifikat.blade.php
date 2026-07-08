<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark')
            document.documentElement.classList.remove('light')
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">

    <x-navbar />

    <section class="px-4 py-16 flex-1 max-w-5xl mx-auto w-full">

        @if (!$valid)
            <div class="card-fix p-10 text-center">

                <div class="mx-auto w-20 h-20 rounded-full bg-red-100 flex items-center justify-center mb-6">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-red-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </div>

                <h1 class="text-3xl font-bold mb-2 dark:text-white">
                    Sertifikat Tidak Valid
                </h1>

                <p class="text-gray-500 dark:text-gray-400">
                    Nomor sertifikat tidak ditemukan pada sistem Mindfloox.
                </p>

            </div>
        @else
            <div class="card-fix overflow-hidden">

                {{-- Header --}}
                <div class="bg-primary text-white text-center py-10 relative">

                    <div class="mx-auto w-20 h-20 rounded-full bg-white/20 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />

                            <circle cx="12" cy="12" r="9" />

                        </svg>

                    </div>

                    <h1 class="text-3xl font-bold mt-5">
                        Sertifikat Terverifikasi
                    </h1>

                    <p class="mt-2 text-white/80">
                        Sertifikat ini berhasil diverifikasi dari database Mindfloox.
                    </p>

                </div>

                {{-- Body --}}
                <div class="p-8">

                    <div class="grid md:grid-cols-2 gap-6">

                        <div class="card-fix p-5">

                            <p class="text-sm text-gray-500">
                                Nomor Sertifikat
                            </p>

                            <h3 class="font-bold text-lg mt-1">
                                {{ $sertifikat->nomor_sertifikat }}
                            </h3>

                        </div>

                        <div class="card-fix p-5">

                            <p class="text-sm text-gray-500">
                                Tanggal Terbit
                            </p>

                            <h3 class="font-bold text-lg mt-1">
                                {{ \Carbon\Carbon::parse($sertifikat->tanggal_terbit)->translatedFormat('d F Y') }}
                            </h3>

                        </div>

                        <div class="card-fix p-5">

                            <p class="text-sm text-gray-500">
                                Nama Peserta
                            </p>

                            <h3 class="font-bold text-lg mt-1">
                                {{ $pendaftaran->peserta->pengguna->nama }}
                            </h3>

                        </div>

                        <div class="card-fix p-5">

                            <p class="text-sm text-gray-500">
                                Program
                            </p>

                            <h3 class="font-bold text-lg mt-1">
                                {{ $program->nama }}
                            </h3>

                        </div>

                    </div>

                    <div class="card translate-0 p-5 mt-5">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left whitespace-nowrap">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-800">
                                        <th class="text-sm text-gray-500 p-2.5">Nama Kursus
                                        </th>
                                        <th class="text-sm text-gray-500 p-2.5">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-800 dark:text-gray-300">

                                    @forelse($nilai as $item)
                                        <tr
                                            class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">

                                            <td class="py-3 px-4 font-medium">
                                                {{ $item->kursus->nama }}
                                            </td>

                                            <td class="py-3 px-4 text-center font-semibold">
                                                {{ number_format($item->nilai_akhir, 2) }}
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="2" class="py-8 text-center text-gray-400 text-sm">
                                                Belum ada data nilai kursus.
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        @endif

    </section>

    <x-footer />

</body>

</html>
