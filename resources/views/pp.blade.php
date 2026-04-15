<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll - Mindfloox</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="overflow-x-hidden bg-gray-50 text-gray-800 dark:bg-[#0F0F1A] dark:text-white transition">

<x-navbar />

<div class="max-w-7xl mx-auto px-4 py-12">

    <div class="grid lg:grid-cols-3 gap-10 items-start">

        {{-- FORM --}}
        <div class="lg:col-span-2 bg-white dark:bg-[#1A1A2E] rounded-2xl shadow-xl p-8 border border-gray-100 dark:border-none"
            x-data="formData()">

            {{-- HEADER --}}
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-primary mb-2">Pendaftaran Mahasiswa Baru</h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm">
                    Isi data dengan lengkap dan benar untuk melanjutkan proses pendaftaran.
                </p>
            </div>

            <form class="space-y-8">

                {{-- DATA DIRI --}}
                <div>
                    <h2 class="font-semibold mb-4 text-lg">Data Diri</h2>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <input type="text" placeholder="Nama Lengkap" class="input">
                        <input type="text" placeholder="Tempat Lahir" class="input">
                        <input type="date" class="input">
                        <input type="text" placeholder="NIK" class="input">

                        {{-- DROPDOWN --}}
                        <div x-data="dropdown(['Laki-laki','Perempuan'])" class="w-full relative">
                            <div @click="toggle()" class="input flex justify-between cursor-pointer">
                                <span x-text="selected || 'Jenis Kelamin'"></span>
                                <span>▼</span>
                            </div>

                            <div x-show="open" @click.outside="open=false"
                                class="absolute left-0 mt-2 w-full bg-white dark:bg-gray-800 rounded-lg shadow z-10 border">

                                <template x-for="item in options">
                                    <div @click="choose(item)"
                                        class="px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                                        x-text="item"></div>
                                </template>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- ALAMAT --}}
                <div>
                    <h2 class="font-semibold mb-4 text-lg">Alamat</h2>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <textarea placeholder="Alamat Lengkap" class="input sm:col-span-2"></textarea>
                        <input type="text" placeholder="Provinsi" class="input">
                        <input type="text" placeholder="Kota" class="input">
                    </div>
                </div>

                {{-- SEKOLAH --}}
                <div>
                    <h2 class="font-semibold mb-4 text-lg">Data Sekolah</h2>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <input type="text" placeholder="Nama Sekolah" class="input">
                        <input type="number" placeholder="Tahun Lulus" class="input">
                        <textarea placeholder="Alamat Sekolah" class="input sm:col-span-2"></textarea>
                    </div>
                </div>

                {{-- ORANG TUA --}}
                <div>
                    <h2 class="font-semibold mb-4 text-lg">Orang Tua / Wali</h2>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <input type="text" placeholder="Nama Orang Tua" class="input">
                        <textarea placeholder="Alamat Orang Tua" class="input sm:col-span-2"></textarea>
                        <input type="text" placeholder="Provinsi" class="input">
                        <input type="text" placeholder="Kota" class="input">
                    </div>
                </div>

                {{-- PROGRAM --}}
                <div>
                    <h2 class="font-semibold mb-4 text-lg">Program</h2>

                    <div x-data="dropdown(['Teknik Informatika','Sistem Informasi','Manajemen'])"
                        class="w-full relative">

                        <div @click="toggle()" class="input flex justify-between cursor-pointer">
                            <span x-text="selected || 'Pilih Program'"></span>
                            <span>▼</span>
                        </div>

                        <div x-show="open" @click.outside="open=false"
                            class="absolute left-0 mt-2 w-full bg-white dark:bg-gray-800 rounded-lg shadow z-10 border">

                            <template x-for="item in options">
                                <div @click="choose(item)"
                                    class="px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                                    x-text="item"></div>
                            </template>

                        </div>
                    </div>
                </div>

                {{-- KONTAK --}}
                <div>
                    <h2 class="font-semibold mb-4 text-lg">Kontak</h2>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <input type="email" placeholder="Email" class="input">
                        <input type="text" placeholder="No WhatsApp" class="input">
                    </div>
                </div>

                {{-- PERTANYAAN --}}
                <div x-data="dropdown(['Ya','Tidak'])" class="w-full relative">
                    <h2 class="font-semibold mb-2 text-lg">Pertanyaan</h2>

                    <div @click="toggle()" class="input flex justify-between cursor-pointer">
                        <span x-text="selected || 'Pernah daftar sebelumnya?'"></span>
                        <span>▼</span>
                    </div>

                    <div x-show="open" @click.outside="open=false"
                        class="absolute left-0 mt-2 w-full bg-white dark:bg-gray-800 rounded-lg shadow z-10 border">

                        <template x-for="item in options">
                            <div @click="choose(item)"
                                class="px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                                x-text="item"></div>
                        </template>

                    </div>
                </div>

                {{-- UPLOAD --}}
                <div>
                    <h2 class="font-semibold mb-4 text-lg">Upload Berkas</h2>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <input type="file" class="input">
                        <input type="file" class="input">
                    </div>
                </div>

                {{-- AGREEMENT --}}
                <div class="space-y-3">
                    <p class="text-sm text-gray-500">
                        Dengan ini saya menyatakan data yang saya isi adalah benar.
                    </p>

                    <label class="flex items-center gap-2">
                        <input type="checkbox">
                        <span class="text-sm">Saya menyetujui syarat & ketentuan</span>
                    </label>
                </div>

                {{-- SUBMIT --}}
                <button class="w-full bg-primary text-white py-3 rounded-xl font-semibold hover:scale-[1.02] transition">
                    Daftar Sekarang
                </button>

            </form>
        </div>

        {{-- SIDEBAR --}}
        <div class="space-y-6 sticky top-20">

            <div class="bg-white dark:bg-[#1A1A2E] p-6 rounded-2xl shadow">
                <h2 class="font-bold mb-4">Kenapa Pilih Kami?</h2>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li>✔ Mentor profesional</li>
                    <li>✔ Belajar fleksibel</li>
                    <li>✔ Sertifikat resmi</li>
                    <li>✔ Support komunitas</li>
                </ul>
            </div>

            <div class="bg-primary text-white p-6 rounded-2xl text-center shadow-lg">
                <h3 class="text-3xl font-bold">15K+</h3>
                <p class="text-sm opacity-80">Mahasiswa</p>
            </div>

        </div>

    </div>
</div>

<x-footer />

<script>
function dropdown(options) {
    return {
        open: false,
        selected: '',
        options: options,
        toggle() { this.open = !this.open },
        choose(val) { this.selected = val; this.open = false }
    }
}

function formData() {
    return {}
}
</script>

</body>
</html>
