<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Kelulusan - Mindfloox</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6c63ff',
                        secondary: '#4caf50',
                        accent: '#ff6584',
                    },
                    fontFamily: {
                        sans: ['"Instrument Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* =========================
   PDF & PRINT
========================= */

        @page {
            size: A4 landscape;
            margin: 0;
        }

        @media print {

            html,
            body {
                margin: 0;
                padding: 0;
                background: white !important;
            }

            .certificate-container {
                box-shadow: none !important;
                margin: 0 !important;
                page-break-after: always;
            }

            .page-break {
                page-break-before: always;
            }
        }

        /* =========================
   GLOBAL
========================= */

        html,
        body {
            margin: 0;
            padding: 0;
            background: #f3f4f6;
            font-family: "Instrument Sans", sans-serif;
        }

        /* =========================
   PAGE BREAK
========================= */

        .page-break {
            page-break-before: always;
            break-before: page;
            height: 0;
        }

        /* =========================
   CERTIFICATE PAGE
========================= */

        .certificate-container {

            width: 1056px;
            height: 816px;

            background: white;

            position: relative;

            overflow: hidden;

            margin: 30px auto;

            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.12);
        }

        /* =========================
   DECORATION
========================= */

        .corner-tl {
            position: absolute;
            top: 0;
            left: 0;

            width: 400px;
            height: 400px;

            background:
                linear-gradient(135deg,
                    rgba(108, 99, 255, .08) 0%,
                    rgba(108, 99, 255, 0) 70%);

            border-bottom-right-radius: 100%;
        }

        .corner-br {
            position: absolute;
            bottom: 0;
            right: 0;

            width: 500px;
            height: 500px;

            background:
                linear-gradient(315deg,
                    rgba(76, 175, 80, .08) 0%,
                    rgba(76, 175, 80, 0) 70%);

            border-top-left-radius: 100%;
        }

        .shape-1 {
            position: absolute;

            top: -50px;
            right: 150px;

            width: 200px;
            height: 200px;

            border-radius: 50%;

            background:
                radial-gradient(circle,
                    rgba(255, 101, 132, .05) 0%,
                    rgba(255, 101, 132, 0) 70%);
        }

        /* =========================
   BORDER
========================= */

        .border-inner {

            position: absolute;

            top: 30px;
            left: 30px;
            right: 30px;
            bottom: 30px;

            border: 1px solid rgba(108, 99, 255, .30);

            outline: 4px solid rgba(108, 99, 255, .05);

            outline-offset: 4px;

            z-index: 10;
        }

        /* =========================
   WATERMARK
========================= */

        .watermark {

            position: absolute;

            top: 50%;
            left: 50%;

            transform:
                translate(-50%, -50%) rotate(-30deg);

            font-size: 150px;

            font-weight: 900;

            color: rgba(108, 99, 255, .02);

            white-space: nowrap;

            z-index: 15;

            pointer-events: none;
        }

        /* =========================
   PAGE 1 CONTENT
========================= */

        .content-wrapper {

            position: relative;

            z-index: 20;

            height: 100%;

            padding: 50px 60px;

            text-align: center;

            display: flex;

            flex-direction: column;
        }

        /* =========================
   PAGE 2 CONTENT
========================= */

        .content-wrapper-page2 {

            position: relative;

            z-index: 20;

            padding: 60px;

            height: calc(100% - 120px);
        }

        /* =========================
   BACKGROUND DOT
========================= */

        .bg-pattern {

            position: absolute;

            top: 0;
            left: 0;
            right: 0;
            bottom: 0;

            background-image:
                radial-gradient(#6c63ff 0.7px,
                    transparent 0.7px);

            background-size: 40px 40px;

            opacity: .03;

            z-index: 5;
        }

        /* =========================
   TABLE NILAI
========================= */

        .nilai-table {

            width: 100%;

            border-collapse: collapse;

            margin-top: 20px;
        }

        .nilai-table th {

            background: #f8fafc;

            border: 1px solid #d1d5db;

            padding: 12px;

            font-size: 14px;
        }

        .nilai-table td {

            border: 1px solid #d1d5db;

            padding: 10px;

            font-size: 14px;
        }

        .nilai-table tr:nth-child(even) {

            background: #fafafa;
        }

        /* =========================
   FOOTER
========================= */

        .footer-note {

            margin-top: 30px;

            text-align: center;

            font-size: 12px;

            color: #6b7280;
        }
    </style>
</head>

<body>

    <div class="certificate-container">
        <div class="bg-pattern"></div>
        <div class="corner-tl"></div>
        <div class="corner-br"></div>
        <div class="shape-1"></div>
        <div class="border-inner"></div>
        <div class="watermark">MINDFLOOX</div>


        <div class="content-wrapper">
            <div class="mb-3 flex justify-center items-center">
                <img src="{{ asset('img/logo-mindflux.png') }}" alt="Mindfloox Logo"
                    style="height: 100px; width: auto;">
            </div>

            <h1 class="font-serif text-5xl text-gray-800 mb-1 font-black tracking-widest uppercase text-center">
                Sertifikat Partisipasi</h1>
            <p class="text-gray-500 mb-3 tracking-widest text-sm font-bold text-center">
                {{ $sertifikat->nomor_sertifikat }}</p>

            <p class="text-gray-600 text-base mb-4 text-center">Dengan bangga dipersembahkan kepada:</p>

            <div class="relative inline-block mb-3 w-full max-w-2xl mx-auto text-center">
                <h2 class="font-serif text-4xl text-primary font-bold italic pb-2 z-10 relative">
                    {{ $pendaftaran->peserta->pengguna->nama ?? 'Nama Peserta' }}
                </h2>
                <div class="absolute bottom-0 left-0 right-0 flex items-center justify-center w-full">
                    <div class="w-2 h-2 rounded-full border-2 border-primary bg-white"></div>
                    <div class="flex-1 h-0.5 bg-primary opacity-70"></div>
                    <div class="w-2 h-2 rounded-full border-2 border-primary bg-white"></div>
                </div>
            </div>

            <p class="text-gray-600 text-base mb-4 mt-2 text-center">
                sebagai<br />
                <span class="font-bold text-gray-800 text-3xl uppercase block mt-1 tracking-wide">PESERTA</span>
            </p>

            <p class="text-gray-700 leading-8 text-lg p-5">
                Sertifikat ini diberikan sebagai bentuk apresiasi atas partisipasi dan
                penyelesaian seluruh rangkaian pembelajaran pada Program
                <strong>{{ $program->nama }}</strong>.
            </p>

            <div class="flex justify-between items-end w-full px-12 mt-auto">

                {{-- QR Code --}}
                <div class="text-center">
                    @php
                        // Mengambil data dinamis sesuai template sertifikat Anda
                        $namaPeserta = $pendaftaran->peserta->pengguna->nama ?? 'Nama Peserta';
                        $nomorTerformat = $sertifikat->nomor_sertifikat;
                        $namaProgram = 'Sertifikat Partisipasi - ' . $program->nama;

                        // Menyusun format teks biasa (Plain Text) untuk QR Code
                        $qrContent = "Nama: {$namaPeserta}\nNomor: {$nomorTerformat}\n {$namaProgram}";
                    @endphp

                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ urlencode($qrContent) }}"
                        width="100" height="100" class="mx-auto">

                    <p class="text-[10px] text-gray-500 mt-2">
                        Scan untuk verifikasi data
                    </p>
                </div>
                {{-- <div class="text-center">

                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ urlencode(route('verify.sertifikat', ['nomor' => $sertifikat->nomor_sertifikat])) }}"
                        width="100" height="100" class="mx-auto">

                    <p class="text-[10px] text-gray-500 mt-2">
                        Scan untuk verifikasi
                    </p>

                </div> --}}


            </div>

        </div>
    </div>

    <div class="certificate-container">

        <div class="bg-pattern"></div>
        <div class="border-inner"></div>

        <div class="content-wrapper items-start text-left">

            <h1 class="font-serif text-4xl font-bold">
                Lampiran Hasil Pembelajaran
            </h1>

            <p class="text-gray-500 mb-8">
                Sertifikat Microcredential Mindfloox
            </p>



            <table class="w-full border text-sm">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="border p-2 w-16">
                            No
                        </th>

                        <th class="border p-2 text-left">
                            Nama Kursus
                        </th>

                        <th class="border p-2 w-32">
                            Nilai
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($nilai as $index => $item)
                        <tr>

                            <td class="border p-2 text-center">

                                {{ $index + 1 }}

                            </td>

                            <td class="border p-2">

                                {{ $item->kursus->nama }}

                            </td>

                            <td class="border p-2 text-center font-semibold">

                                {{ number_format($item->nilai_akhir, 2) }}

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

            <div class="flex justify-end mt-8 w-full">

                <table>

                    <tr>

                        <td class="pr-8 font-semibold">

                            Jumlah Kursus

                        </td>

                        <td>

                            {{ $nilai->count() }}

                        </td>

                    </tr>

                    <tr>

                        <td class="pr-8 font-semibold">

                            Rata-rata Nilai

                        </td>

                        <td class="font-bold text-xl">

                            {{ number_format($rataRata, 2) }}

                        </td>

                    </tr>

                </table>

            </div>

            <div class="mt-auto pt-8 text-center text-xs text-gray-500 w-full">

                Dokumen ini merupakan lampiran resmi Sertifikat Microcredential
                Mindfloox yang memuat rincian capaian pembelajaran peserta.

            </div>

        </div>

    </div>

</body>

</html>
</body>

</html>
