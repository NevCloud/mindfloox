<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Kelulusan - Mindfloox</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">

    <!-- Tailwind for rapid styling in this standalone template -->
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
        @media print {
            body {
                background-color: white !important;
                padding: 0 !important;
            }

            .certificate-container {
                box-shadow: none !important;
                width: 100% !important;
                height: 100% !important;
            }

            @page {
                size: landscape;
                margin: 0;
            }
        }

        body {
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .certificate-container {
            width: 1056px;
            /* 11 inches at 96 DPI */
            height: 816px;
            /* 8.5 inches at 96 DPI */
            background-color: white;
            position: relative;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        /* Modern Corner Decorations */
        .corner-tl {
            position: absolute;
            top: 0;
            left: 0;
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, rgba(108, 99, 255, 0.08) 0%, rgba(108, 99, 255, 0) 70%);
            border-bottom-right-radius: 100%;
        }

        .corner-br {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 500px;
            height: 500px;
            background: linear-gradient(315deg, rgba(76, 175, 80, 0.08) 0%, rgba(76, 175, 80, 0) 70%);
            border-top-left-radius: 100%;
        }

        /* Abstract shapes */
        .shape-1 {
            position: absolute;
            top: -50px;
            right: 150px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 101, 132, 0.05) 0%, rgba(255, 101, 132, 0) 70%);
        }

        .border-inner {
            position: absolute;
            top: 30px;
            bottom: 30px;
            left: 30px;
            right: 30px;
            border: 1px solid rgba(108, 99, 255, 0.3);
            outline: 4px solid rgba(108, 99, 255, 0.05);
            outline-offset: 4px;
            z-index: 10;
        }

        .content-wrapper {
            position: relative;
            z-index: 20;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px;
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #9ca3af;
            width: 220px;
            margin: 0 auto;
            margin-top: 70px;
            padding-top: 12px;
        }

        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(#6c63ff 0.7px, transparent 0.7px);
            background-size: 40px 40px;
            opacity: 0.03;
            z-index: 5;
        }

        .seal {
            position: absolute;
            bottom: 70px;
            left: 90px;
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6c63ff, #5046e5);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            box-shadow: 0 10px 20px -5px rgba(108, 99, 255, 0.5);
            border: 4px solid white;
            outline: 2px dashed rgba(108, 99, 255, 0.8);
            outline-offset: 4px;
            transform: rotate(-10deg);
        }

        .seal::before {
            content: '';
            position: absolute;
            inset: 6px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 150px;
            font-weight: 900;
            color: rgba(108, 99, 255, 0.02);
            white-space: nowrap;
            z-index: 15;
            pointer-events: none;
            user-select: none;
        }
    </style>
</head>

<body>

    <div class="certificate-container">
        <!-- Background Elements -->
        <div class="bg-pattern"></div>
        <div class="corner-tl"></div>
        <div class="corner-br"></div>
        <div class="shape-1"></div>
        <div class="border-inner"></div>
        <div class="watermark">MINDFLOOX</div>

        <div class="content-wrapper">
            <!-- Header -->
            <div class="mb-4 flex justify-center items-center">
                <img src="{{ asset('img/logo-mindflux.png') }}" alt="Mindfloox Logo" style="height: 60px; width: auto;">
            </div>

            <!-- Title -->
            <h1 class="font-serif text-6xl text-gray-800 mb-2 font-black tracking-widest uppercase text-center">Sertifikat</h1>
            <p class="text-gray-500 mb-4 tracking-widest text-lg font-bold text-center">NO.30/UN21.11/DL.17/2026</p>

            <p class="text-gray-700 text-lg mb-6 text-center">Dengan bangga dipersembahkan kepada:</p>

            <!-- Recipient Name -->
            <div class="relative inline-block mb-4 w-full max-w-3xl mx-auto text-center">
                <h2 class="font-serif text-5xl text-primary font-bold italic pb-3 z-10 relative">
                    Nama Peserta
                </h2>
                <!-- decorative line under name with circles -->
                <div class="absolute bottom-0 left-0 right-0 flex items-center justify-center w-full">
                    <div class="w-2.5 h-2.5 rounded-full border-2 border-primary bg-white"></div>
                    <div class="flex-1 h-0.5 bg-primary"></div>
                    <div class="w-2.5 h-2.5 rounded-full border-2 border-primary bg-white"></div>
                </div>
            </div>

            <p class="text-gray-600 text-lg mb-3 mt-1 text-center">sebagai</p>

            <h3 class="font-sans text-4xl text-gray-800 font-bold uppercase mb-6 tracking-wide text-center">
                PESERTA
            </h3>

            <!-- Description -->
            <p class="text-gray-700 text-lg max-w-4xl mx-auto mb-6 leading-relaxed font-light text-center">
                Telah berhasil menyelesaikan seluruh rangkaian pembelajaran pada program<br/>
                <span class="font-semibold text-gray-800 block mt-1">Judul Program</span>
            </p>

            <!-- Footer: Date and Signature (Right Aligned) -->
            <div class="flex justify-end w-full px-16 mt-2">
                <div class="text-center w-64">
                    <p class="font-semibold text-gray-800 text-md">19 November 2026</p>
                    <div class="h-20"></div>
                    <div class="w-full border-t border-gray-800 pt-2">
                        <p class="font-bold text-gray-800 text-sm uppercase">Mindfloox</p>
                    </div>
                </div>
            </div>


        </div>
    </div>

</body>

</html>