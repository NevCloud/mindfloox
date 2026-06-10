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
                        Take the next step in your educational journey. Complete the form below to secure your spot in our comprehensive online learning program.
                    </p>
                </div>

                {{-- Form --}}
                <form class="space-y-5" @submit.prevent="validate()">

                    {{-- First Name & Last Name --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- First Name --}}
                        <div>
                            <label class="text-sm font-medium mb-1 block">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                x-model="firstName"
                                :class="errors.firstName ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 dark:border-gray-600 focus:ring-primary'"
                                class="input">
                            <p x-show="errors.firstName" x-text="errors.firstName" x-transition class="text-red-500 text-xs mt-1"></p>
                        </div>

                        {{-- Last Name --}}
                        <div>
                            <label class="text-sm font-medium mb-1 block">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                x-model="lastName"
                                :class="errors.lastName ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 dark:border-gray-600 focus:ring-primary'"
                                class="input">
                            <p x-show="errors.lastName" x-text="errors.lastName" x-transition class="text-red-500 text-xs mt-1"></p>
                        </div>

                    </div>

                    {{-- Email & Password --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- Email --}}
                        <div>
                            <label class="text-sm font-medium mb-1 block">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email"
                                x-model="email"
                                :class="errors.email ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 dark:border-gray-600 focus:ring-primary'"
                                class="input">
                            <p x-show="errors.email" x-text="errors.email" x-transition class="text-red-500 text-xs mt-1"></p>
                        </div>

                        {{-- Password --}}
                        <div>
                            <label class="text-sm font-medium mb-1 block">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                {{-- Input type berubah sesuai showPassword --}}
                                <input
                                    :type="showPassword ? 'text' : 'password'"
                                    x-model="password"
                                    :class="errors.password ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 dark:border-gray-600 focus:ring-primary'"
                                    class="input">

                                {{-- Toggle show/hide password --}}
                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary transition">

                                    {{-- Icon mata (password tersembunyi) --}}
                                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>

                                    {{-- Icon mata dicoret (password terlihat) --}}
                                    <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>

                                </button>
                            </div>
                            <p x-show="errors.password" x-text="errors.password" x-transition class="text-red-500 text-xs mt-1"></p>
                        </div>

                    </div>

                    {{-- Motivation --}}
                    <div>
                        <label class="text-sm font-medium mb-1 block">What motivates you to take this course?</label>
                        <textarea x-model="motivation" rows="5"
                            placeholder="Share your goals and what you hope to achieve..."
                            class="textarea"></textarea>
                    </div>

                    {{-- Submit Button --}}
                    <div class="text-center pt-2">
                        <button type="submit"
                            class="bg-primary text-white px-10 py-3 rounded-full font-semibold hover:shadow-lg hover:-translate-y-1 transition duration-300 inline-flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            ENROLL NOW
                        </button>
                        <p class="text-gray-400 text-xs mt-3 flex items-center justify-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                            Your information is secure and will never be shared with third parties
                        </p>
                    </div>

                </form>
            </div>

            {{-- KOLOM KANAN: Why Choose --}}
            <div class="space-y-4">

                <h2 class="text-xl font-bold mb-6">Why Choose Our Courses?</h2>

                {{-- Card: Expert Instructors --}}
                <div class="bg-white dark:bg-[#1A1A2E] rounded-xl shadow p-4 flex items-start gap-4">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm mb-1">Expert Instructors</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-xs leading-relaxed">Learn from industry professionals with years of real-world experience</p>
                    </div>
                </div>

                {{-- Card: Flexible Learning --}}
                <div class="bg-white dark:bg-[#1A1A2E] rounded-xl shadow p-4 flex items-start gap-4">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm mb-1">Flexible Learning</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-xs leading-relaxed">Study at your own pace with 24/7 access to course materials</p>
                    </div>
                </div>

                {{-- Card: Certification --}}
                <div class="bg-white dark:bg-[#1A1A2E] rounded-xl shadow p-4 flex items-start gap-4">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm mb-1">Certification</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-xs leading-relaxed">Earn industry-recognized certificates upon course completion</p>
                    </div>
                </div>

                {{-- Card: Community Support --}}
                <div class="bg-white dark:bg-[#1A1A2E] rounded-xl shadow p-4 flex items-start gap-4">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm mb-1">Community Support</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-xs leading-relaxed">Connect with fellow students and get help when you need it</p>
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
