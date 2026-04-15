<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll - Mindfloox</title>
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

<body class="overflow-x-hidden bg-gray-50 text-gray-800 dark:bg-[#0F0F1A] dark:text-white transition">

    {{-- Navbar --}}
    <x-navbar />

    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid md:grid-cols-3 gap-8 items-start">

            {{-- KOLOM KIRI: Form --}}
            <div class="md:col-span-2 bg-white dark:bg-[#1A1A2E] border border-gray-200 dark:border-none rounded-2xl shadow-lg p-8 mt-13"
                x-data="{
                    firstName: '',
                    lastName: '',
                    email: '',
                    password: '',
                    showPassword: false,
                    motivation: '',
                    errors: {},
                    validate() {
                        this.errors = {};
                        if (!this.firstName.trim()) this.errors.firstName = 'First name wajib diisi.';
                        if (!this.lastName.trim()) this.errors.lastName = 'Last name wajib diisi.';
                        if (!this.email.trim()) this.errors.email = 'Email wajib diisi.';
                        if (!this.password.trim()) this.errors.password = 'Password wajib diisi.';
                        else if (this.password.length < 6) this.errors.password = 'Password minimal 6 karakter.';
                        return Object.keys(this.errors).length === 0;
                    }
                }">

                {{-- Judul --}}
                <div class="text-center mb-8">
                    <h1 class="text-2xl md:text-3xl font-bold text-primary mb-3">Enroll in Your Dream Course</h1>
                    <p class="text-gray-500 dark:text-gray-400 text-sm max-w-lg mx-auto">
                        Take the next step in your educational journey. Complete the form below to secure your spot
                        in
                        our comprehensive online learning program.
                    </p>
                </div>

                {{-- Form --}}
                <form class="space-y-6">

                    {{-- DATA DIRI --}}
                    <div class="section">
                        <div>
                            <label class="label">Nama Lengkap (Sesuai Ijazah)</label>
                            <input type="text" x-model="namaLengkap"
                                :class="errors.namaLengkap ? 'input input-error' : 'input'">
                            <p x-show="errors.namaLengkap" x-text="errors.namaLengkap" class="error-text"></p>
                        </div>

                        <div>
                            <label class="label">Tempat Lahir</label>
                            <input type="text" x-model="tempatLahir"
                                :class="errors.tempatLahir ? 'input input-error' : 'input'">
                        </div>

                        <div>
                            <label class="label">Tanggal Lahir</label>
                            <input type="date" x-model="tanggalLahir" class="input">
                        </div>

                        <div>
                            <label class="label">NIK</label>
                            <input type="text" x-model="nik" class="input">
                        </div>

                        <div x-data="{ open: false, selected: '', options: ['Laki laki', 'Perempuan'] }" class="dropdown relative">

                            <label class="label">Jenis Kelamin</label>

                            {{-- Button --}}
                            <div @click="open = !open" class="dropdown-btn">
                                <span x-text="selected || 'Pilih'"></span>

                                <svg class="w-4 h-4 transition" :class="open ? 'rotate-180' : ''" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            {{-- Menu --}}
                            <div x-show="open" @click.outside="open=false" x-transition class="dropdown-menu">

                                <template x-for="item in options" :key="item">
                                    <div @click="selected = item; open=false" class="dropdown-item"
                                        :class="selected === item ? 'bg-primary/10 text-primary' : ''" x-text="item">
                                    </div>
                                </template>

                            </div>
                        </div>
                    </div>

                    {{-- ALAMAT --}}
                    <div class="section">
                        <div class="sm:col-span-2">
                            <label class="label">Alamat Tempat Tinggal</label>
                            <textarea x-model="alamat" class="textarea"></textarea>
                        </div>

                        <div>
                            <label class="label">Provinsi</label>
                            <input type="text" x-model="provinsi" class="input">
                        </div>

                        <div>
                            <label class="label">Kota</label>
                            <input type="text" x-model="kota" class="input">
                        </div>
                    </div>

                    {{-- SEKOLAH --}}
                    <div class="section">
                        <div>
                            <label class="label">Nama SMA/SMK/MA</label>
                            <input type="text" x-model="sekolah" class="input">
                        </div>

                        <div>
                            <label class="label">Tahun Lulus</label>
                            <input type="number" x-model="tahunLulus" class="input">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="label">Alamat Sekolah</label>
                            <textarea x-model="alamatSekolah" class="textarea"></textarea>
                        </div>
                    </div>

                    {{-- ORANG TUA --}}
                    <div class="section">
                        <div>
                            <label class="label">Nama Orang Tua / Wali</label>
                            <input type="text" x-model="ortu" class="input">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="label">Alamat Orang Tua / Wali</label>
                            <textarea x-model="alamatOrtu" class="textarea"></textarea>
                        </div>

                        <div>
                            <label class="label">Provinsi</label>
                            <input type="text" x-model="provinsiOrtu" class="input">
                        </div>

                        <div>
                            <label class="label">Kota</label>
                            <input type="text" x-model="kotaOrtu" class="input">
                        </div>
                    </div>

                    {{-- PROGRAM --}}
                    <div x-data="{ open: false, selected: '', options: ['Teknik Informatika', 'Sistem Informasi', 'Manajemen'] }" class="dropdown relative">

                        <label class="label">Program Pendidikan Pilihan</label>

                        {{-- Button --}}
                        <div @click="open = !open" class="dropdown-btn">
                            <span x-text="selected || 'Pilih Program'"></span>

                            <svg class="w-4 h-4 transition" :class="open ? 'rotate-180' : ''" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>

                        {{-- Menu --}}
                        <div x-show="open" @click.outside="open=false" x-transition class="dropdown-menu">

                            <template x-for="item in options" :key="item">
                                <div @click="selected = item; open=false" class="dropdown-item"
                                    :class="selected === item ? 'bg-primary/10 text-primary' : ''" x-text="item">
                                </div>
                            </template>

                        </div>
                    </div>

                    {{-- KONTAK --}}
                    <div class="section">
                        <div>
                            <label class="label">Email</label>
                            <input type="email" x-model="email" class="input">
                        </div>

                        <div>
                            <label class="label">No Handphone (WA)</label>
                            <input type="text" x-model="phone" class="input">
                        </div>
                    </div>

                    {{-- PERTANYAAN --}}
                    <div x-data="{ open: false, selected: '', options: ['Ya', 'Tidak'] }" class="dropdown relative">

                        <label class="label">Sudah Pernah Daftar Jalur Poltek?</label>

                        {{-- Button --}}
                        <div @click="open = !open" class="dropdown-btn">
                            <span x-text="selected || 'Pilih'"></span>

                            <svg class="w-4 h-4 transition" :class="open ? 'rotate-180' : ''" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>

                        {{-- Menu --}}
                        <div x-show="open" @click.outside="open=false" x-transition class="dropdown-menu">

                            <template x-for="item in options" :key="item">
                                <div @click="selected = item; open=false" class="dropdown-item"
                                    :class="selected === item ? 'bg-primary/10 text-primary' : ''" x-text="item">
                                </div>
                            </template>

                        </div>
                    </div>

                    {{-- UPLOAD --}}
                    <div class="section">
                        <div>
                            <label class="label">Upload Ijazah / SKL / Rapor</label>
                            <input type="file" class="input">
                        </div>

                        <div>
                            <label class="label">Upload KTP</label>
                            <input type="file" class="input">
                        </div>
                    </div>

                    {{-- SYARAT --}}
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            Dengan ini saya menyatakan bahwa data yang saya isi adalah benar dan saya telah membaca
                            serta menyetujui seluruh syarat dan ketentuan pendaftaran.
                        </p>

                        <label class="flex items-center gap-2 mt-3">
                            <input type="checkbox" x-model="agree">
                            <span class="text-sm">Saya menyetujui syarat & ketentuan</span>
                        </label>
                    </div>

                    {{-- SUBMIT --}}
                    <button type="submit" class="btn-primary">
                        Daftar
                    </button>

                </form>
            </div>

            {{-- KOLOM KANAN: Why Choose --}}
            <div class="space-y-4">

                <h2 class="text-xl font-bold mb-6">Why Choose Our Courses?</h2>

                {{-- Card: Expert Instructors --}}
                <div class="bg-white dark:bg-[#1A1A2E] rounded-xl shadow p-4 flex items-start gap-4">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm mb-1">Expert Instructors</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-xs leading-relaxed">Learn from industry
                            professionals with years of real-world experience</p>
                    </div>
                </div>

                {{-- Card: Flexible Learning --}}
                <div class="bg-white dark:bg-[#1A1A2E] rounded-xl shadow p-4 flex items-start gap-4">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm mb-1">Flexible Learning</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-xs leading-relaxed">Study at your own pace
                            with
                            24/7 access to course materials</p>
                    </div>
                </div>

                {{-- Card: Certification --}}
                <div class="bg-white dark:bg-[#1A1A2E] rounded-xl shadow p-4 flex items-start gap-4">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm mb-1">Certification</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-xs leading-relaxed">Earn
                            industry-recognized
                            certificates upon course completion</p>
                    </div>
                </div>

                {{-- Card: Community Support --}}
                <div class="bg-white dark:bg-[#1A1A2E] rounded-xl shadow p-4 flex items-start gap-4">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm mb-1">Community Support</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-xs leading-relaxed">Connect with fellow
                            students and get help when you need it</p>
                    </div>
                </div>

                {{-- Stats Card --}}
                <div class="bg-primary rounded-xl p-6 text-white text-center space-y-4">
                    <div>
                        <h3 class="text-3xl font-bold">15,000+</h3>
                        <p class="text-white/80 text-sm">Students Enrolled</p>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold">98%</h3>
                        <p class="text-white/80 text-sm">Completion Rate</p>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold">4.9/5</h3>
                        <p class="text-white/80 text-sm">Average Rating</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Footer --}}
    <x-footer />

</body>

</html>
