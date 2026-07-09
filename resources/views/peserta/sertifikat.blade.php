@php
    $isPdf = request()->routeIs('peserta.sertifikat.download');

    $logo = $isPdf ? public_path('img/logo-mindflux.png') : asset('img/logo-mindflux.png');

    $qr = $isPdf
        ? public_path('qrcode/' . $sertifikat->nomor_sertifikat . '.png')
        : asset('qrcode/' . $sertifikat->nomor_sertifikat . '.png');
@endphp
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Sertifikat</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Times New Roman", serif;
            background: #ffffff;
            color: #222;
        }

        .page {
            width: 297mm;
            height: 210mm;
            position: relative;
            overflow: hidden;
        }

        .page-break {
            page-break-after: always;
        }

        /*=========================
    BORDER
==========================*/

        .outer-border {

            position: absolute;

            top: 10mm;
            left: 10mm;
            right: 10mm;
            bottom: 10mm;

            border: 4px solid #183153;

        }

        .inner-border {

            position: absolute;

            top: 15mm;
            left: 15mm;
            right: 15mm;
            bottom: 15mm;

            border: 1px solid #183153;

        }

        /*=========================
      ORNAMENT
==========================*/

        .corner-tl {

            position: absolute;
            width: 80px;
            height: 80px;

            border-top: 6px solid #183153;
            border-left: 6px solid #183153;

            top: 20mm;
            left: 20mm;

        }

        .corner-tr {

            position: absolute;

            width: 80px;
            height: 80px;

            border-top: 6px solid #183153;
            border-right: 6px solid #183153;

            top: 20mm;
            right: 20mm;

        }

        .corner-bl {

            position: absolute;

            width: 80px;
            height: 80px;

            border-bottom: 6px solid #183153;
            border-left: 6px solid #183153;

            bottom: 20mm;
            left: 20mm;

        }

        .corner-br {

            position: absolute;

            width: 80px;
            height: 80px;

            border-bottom: 6px solid #183153;
            border-right: 6px solid #183153;

            bottom: 20mm;
            right: 20mm;

        }

        /*=====================
     WATERMARK
======================*/

        .watermark {

            position: absolute;

            width: 100%;

            top: 50%;

            left: 0;

            text-align: center;

            font-size: 80px;

            color: #eeeeee;

            transform: translateY(-50%);

            letter-spacing: 15px;

            font-weight: bold;

        }

        /*=====================
      CONTENT
======================*/

        .content {

            position: absolute;

            top: 25mm;

            left: 30mm;

            right: 30mm;

            bottom: 25mm;

        }

        .logo {

            text-align: center;

            margin-bottom: 15px;

        }

        .logo img {

            height: 70px;

        }

        .title {

            text-align: center;

            font-size: 38px;

            font-weight: bold;

            letter-spacing: 4px;

            color: #183153;

        }

        .subtitle {

            text-align: center;

            font-size: 14px;

            margin-top: 5px;

        }

        .number {

            text-align: center;

            margin-top: 10px;

            font-size: 14px;

        }

        .presented {

            margin-top: 35px;

            text-align: center;

            font-size: 18px;

        }

        .name {

            margin-top: 15px;

            text-align: center;

            font-size: 42px;

            font-weight: bold;

            color: #183153;

            border-bottom: 1px solid #183153;

            display: block;

            padding-bottom: 10px;

        }

        .program {

            margin-top: 25px;

            text-align: center;

            font-size: 22px;

            font-weight: bold;

        }

        .desc {

            margin-top: 20px;

            text-align: center;

            line-height: 28px;

            font-size: 16px;

        }

        /*=====================
 FOOTER
======================*/

        .footer {

            position: absolute;

            left: 30mm;

            right: 30mm;

            bottom: 25mm;

        }

        .footer table {

            width: 100%;

            border-collapse: collapse;

        }

        .footer td {

            vertical-align: top;

        }

        .qr {

            width: 120px;

        }

        .qr img {

            width: 100px;

        }

        .signature {

            text-align: center;

        }

        .signature img {

            height: 70px;

        }

        .signature-name {

            margin-top: 10px;

            border-top: 1px solid #000;

            display: inline-block;

            padding-top: 5px;

            font-weight: bold;

        }

        .average {

            font-size: 18px;

            font-weight: bold;

            color: #183153;

        }
    </style>

</head>

<body>
    <!-- =========================
        HALAMAN DEPAN
========================== -->

    <div class="page">

        <div class="outer-border"></div>
        <div class="inner-border"></div>

        <div class="corner-tl"></div>
        <div class="corner-tr"></div>
        <div class="corner-bl"></div>
        <div class="corner-br"></div>

        <div class="watermark">
            MINDFLOOX
        </div>

        <div class="content">

            <!-- Logo -->
            <div class="logo">
                <img src="{{ $logo }}" width="170">
            </div>

            <!-- Judul -->
            <div class="title">
                SERTIFIKAT PARSITIPASI
            </div>

            <!-- Nomor Sertifikat -->
            <div class="number">
                Nomor Sertifikat:
                <strong>{{ $sertifikat->nomor_sertifikat }}</strong>
            </div>

            <!-- Diberikan kepada -->
            <div class="presented">
                Sertifikat ini diberikan kepada
            </div>

            <!-- Nama -->
            <div class="name">
                {{ $pendaftaran->peserta->pengguna->nama }}
            </div>

            <!-- Deskripsi -->
            <div class="desc">
                Sertifikat ini diberikan sebagai pengakuan atas partisipasi dalam program pelatihan yang diselenggarakan
                oleh Mindfloox.
            </div>

            <!-- Nama Program -->
            <div class="program">
                {{ strtoupper($program->nama) }}
            </div>

            <br><br>

        </div>

        <!-- =====================
            FOOTER
    ====================== -->

        <div class="footer">

            <table>

                <tr>

                    <td width="25%">

                        <div class="text-center">

                            <img src="{{ $qr }}" width="100">

                        </div>

                        <div style="font-size:12px;">
                            Scan untuk verifikasi
                        </div>

                    </td>

                    <td width="50%">
                    </td>

                </tr>

            </table>

        </div>

    </div>

    <div class="page-break"></div>

    <!-- =========================================
            HALAMAN BELAKANG
========================================== -->

    <div class="page">

        <div class="outer-border"></div>
        <div class="inner-border"></div>

        <div class="corner-tl"></div>
        <div class="corner-tr"></div>
        <div class="corner-bl"></div>
        <div class="corner-br"></div>

        <div class="content">

            <div style="text-align:center;font-size:28px;font-weight:bold;color:#183153;">
                LEARNING TRANSCRIPT
            </div>

            <div style="margin-top:8px;text-align:center;font-size:15px;color:#666;">
                Detail hasil pembelajaran peserta
            </div>

            <br><br>

            <table width="100%" cellpadding="8" cellspacing="0">

                <tr>

                    <td width="25%"><strong>Nama Peserta</strong></td>
                    <td width="2%">:</td>
                    <td>{{ $pendaftaran->peserta->pengguna->nama }}</td>

                </tr>

                <tr>

                    <td><strong>Program</strong></td>
                    <td>:</td>
                    <td>{{ $program->nama }}</td>

                </tr>

                <tr>

                    <td><strong>Nomor Sertifikat</strong></td>
                    <td>:</td>
                    <td>{{ $sertifikat->nomor_sertifikat }}</td>

                </tr>

                <tr>

                    <td><strong>Tanggal Terbit</strong></td>
                    <td>:</td>
                    <td>

                        {{ \Carbon\Carbon::parse($sertifikat->tanggal_terbit)->translatedFormat('d F Y') }}

                    </td>

                </tr>

            </table>

            <br><br>

            <table width="100%" cellspacing="0" cellpadding="8" border="1" style="border-collapse:collapse;">

                <thead style="background:#183153;color:white;">

                    <tr>

                        <th width="8%">No</th>

                        <th align="left">

                            Nama Kursus

                        </th>

                        <th width="20%">

                            Nilai

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($nilai as $item)
                        <tr>

                            <td align="center">

                                {{ $loop->iteration }}

                            </td>

                            <td>

                                {{ $item->kursus->nama }}

                            </td>

                            <td align="center">

                                {{ number_format($item->nilai_akhir, 2) }}

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

            <br>

            <table width="100%">

                <tr>

                    <td width="70%"></td>

                    <td>

                        <table width="100%" border="1" cellspacing="0" cellpadding="8"
                            style="border-collapse:collapse;">

                            <tr>

                                <td>

                                    <strong>Rata-rata Nilai</strong>

                                </td>

                                <td align="center">

                                    <strong>

                                        {{ number_format($rataRata, 2) }}

                                    </strong>

                                </td>

                            </tr>

                        </table>

                    </td>

                </tr>

            </table>

            <br><br>

            <table width="100%">

                <tr>

                    <td width="20%">

                        <div class="text-center">

                            <img src="{{ $qr }}" width="100">

                        </div>
                        {{-- <div class="text-center">

                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ urlencode(route('peserta.sertifikat.show', $pendaftaran->id)) }}"
                                    width="100" height="100" class="mx-auto">

                                <p class="text-[10px] text-gray-500 mt-2">
                                    Scan untuk verifikasi
                                </p>

                            </div> --}}

                        <span style="font-size:12px;">

                            Scan untuk verifikasi

                        </span>

                    </td>

                    <td>

                    </td>

                </tr>

            </table>

        </div>

    </div>

</body>

</html>
