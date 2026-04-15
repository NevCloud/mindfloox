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
</head>
<body class="min-h-screen bg-violet-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 relative overflow-x-hidden flex flex-col justify-between transition-colors duration-300">

    {{-- Navbar --}}
    <x-navbar />

    {{-- Section login --}}
    <section class="relative z-10 flex items-center justify-center px-4 py-16">

        {{-- Card login --}}
        <div class="w-full max-w-md p-8 rounded-3xl bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl border border-white dark:border-gray-700 shadow-2xl shadow-violet-200 dark:shadow-none"
            x-data="{
                username: '',
                password: '',
                role: '',
                showPassword: false,
                errors: {},
                validate() {
                    this.errors = {};
                    if (!this.username.trim()) this.errors.username = 'Username wajib diisi.';
                   if (!this.password.trim()) {this.errors.password = 'Password wajib diisi.'; }
                   else if (this.password.length < 6) {this.errors.password = 'Password minimal 6 karakter.';}
                    if (!this.role) {this.errors.role = 'Role wajib dipilih.';}
                }
            }">

            {{-- Icon user --}}
            <div class="flex justify-center mb-5">
                <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-primary/10 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>

            {{-- Judul --}}
            <h2 class="text-center text-2xl text-primary font-bold ">Selamat Datang</h2>
            <p class="text-center text-sm text-gray-400 dark:text-gray-300 mb-6">Masuk ke akun Mindfloox Anda</p>

            {{-- Banner error global --}}
            <div x-show="Object.keys(errors).length > 0"
                x-transition
                class="bg-red-50 border border-red-300 text-red-500 text-sm p-3 rounded-xl mb-4">
                Mohon periksa kembali form Anda.
            </div>

            {{-- Form --}}
            <form class="space-y-4" @submit.prevent="validate()">

                {{-- Username --}}
                <div>
                    <label class="text-sm font-medium mb-1 block">Username</label>
                    <div class="relative">
                        <input type="text"
                            placeholder="Masukkan Username"
                            x-model="username"
                            :class="errors.username ? 'input input-error' : 'input'" class="pl-10">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2"
                            :class="errors.username ? 'text-red-400' : 'text-primary'">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-5" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    <p x-show="errors.username" x-text="errors.username" x-transition class="text-red-400 text-xs mt-1"></p>
                </div>

                {{-- Password --}}
                <div>
                    <label class="text-sm font-medium mb-1 block ">Password</label>
                    <div class="relative">
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            placeholder="Masukkan password Anda"
                            x-model="password"
                            :class="errors.password ? 'input input-error' : 'input'" class="pl-10">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2"
                            :class="errors.password ? 'text-red-400' : 'text-primary'">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                            </svg>
                        </span>

                        {{-- Toggle show/hide password --}}
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-400 hover:text-primary dark:hover:text-primaryd transition">
                            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    <p x-show="errors.password" x-text="errors.password" x-transition class="error-text"></p>
                </div>

                 {{-- Role --}}
                <div>
                    <label for="role" class="text-sm font-medium mb-1 block">Login sebagai</label>
                    <div x-data="{ open: false, selected: 'Pilih Role' }" class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 " :class="errors.role ? 'text-red-400' : 'text-primary'">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <button @click="open = !open" :class="errors.role ? 'dropdown-btn dropdown-error pl-10': 'dropdown-btn pl-10'" type="button">
                            <span x-text="selected"></span>
                            <span>
                                 <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    :class="open ? 'rotate-180' : ''"
                                    class="size-4 transition-transform duration-200">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </span>
                        </button>
                        <div x-show="open" @click.outside="open = false" class="dropdown-menu">
                            <div @click="selected = 'Peserta'; role = 'Peserta'; open = false" class="dropdown-item">Peserta</div>
                            <div @click="selected = 'Instruktur'; role = 'Instruktur'; open = false" class="dropdown-item">Instruktur</div>
                            <div @click="selected = 'Admin'; role = 'Admin'; open = false" class="dropdown-item ">Admin</div>
                            <div @click="selected = 'SuperAdmin'; role = 'Super Admin'; open = false" class="dropdown-item">Super Admin</div>
                        </div>
                    </div>
                    <p x-show="errors.role" x-text="errors.role" class="text-red-400 text-xs mt-1"></p>
                </div>

                {{-- Tombol submit --}}
                <button type="submit"
                    class="w-full py-3 mt-2 rounded-xl bg-primary text-white font-semibold hover:opacity-90 hover:-translate-y-0.5 transition duration-300 ">
                    Masuk
                </button>

                {{-- Link daftar --}}
                <p class="text-center text-sm text-gray-400 mt-4">
                    Belum punya akun?
                    <a href="/enroll" class="text-primary font-medium hover:underline">Daftar sekarang</a>
                </p>

            </form>
        </div>

    </section>

    {{-- Footer --}}
    <x-footer/>


</body>
</html>
