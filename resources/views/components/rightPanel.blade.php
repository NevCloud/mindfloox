<aside id="rightPanel"
    x-data="{ open: false }"
    @toggle-right-panel.window="open = !open"
    @click.outside="open = false"
    :class="open ? 'translate-x-0' : 'translate-x-full'"
    class="fixed z-40 inset-y-0 right-0 w-72 flex flex-col gap-5 p-5
                       bg-gray-100 dark:bg-[#1A1A2E] border-l border-black/5 dark:border-white/5
                       transform transition-all duration-300 overflow-y-auto
                       lg:static lg:translate-x-0 lg:flex-shrink-0">

    <!-- Profile setiap role -->
    @php
    $nama = '';
    $linkProfil = '';

    if (request()->is('super-admin/*')) {
        $nama = 'Super Admin';
        $linkProfil = route('superAdmin.profil');
    } elseif (request()->is('admin/*')) {
        $nama = 'Admin Microcredential';
        $linkProfil = route('admin.profil');
    } elseif (request()->is('instructor/*') || request()->is('instruktur/*')) {
        $nama = 'Instruktur';
        $linkProfil = route('instruktur.profil');
    } elseif (request()->is('peserta/*')) {
        $nama = 'Sara Abraham';
        $linkProfil = route('peserta.profil');
    }
    @endphp

    @if($nama && $linkProfil)
    <div class="flex items-center justify-end gap-3 pt-1">
        <div class="text-right">
            <p class="text-sm font-semibold dark:text-white">{{ $nama }}</p>
            <a href="{{ $linkProfil }}" class="text-xs text-primary cursor-pointer hover:underline">Lihat profil</a>
        </div>
        <img src="https://i.pravatar.cc/150?img=47" alt="Sara"
            class="w-10 h-10 rounded-full object-cover flex-shrink-0" style="box-shadow:0 0 0 2px rgba(108,99,255,0.3)">
    </div>
    @endif


    <!-- Kalender -->
    <div x-data="calendarWidget()" x-init="init()">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Kalender</h3>
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <button @click="prevMonth()" class="hover:text-gray-800 dark:hover:text-white">&lt;</button>
                <span x-text="monthYear"></span>
                <button @click="nextMonth()" class="hover:text-gray-800 dark:hover:text-white">&gt;</button>
            </div>
        </div>

        <div class="grid grid-cols-7 gap-1 text-center text-xs mb-2">
            <div class="text-gray-500 font-medium py-1">Sen</div>
            <div class="text-gray-500 font-medium py-1">Sel</div>
            <div class="text-gray-500 font-medium py-1">Rab</div>
            <div class="text-gray-500 font-medium py-1">Kam</div>
            <div class="text-gray-500 font-medium py-1">Jum</div>
            <div class="text-gray-500 font-medium py-1">Sab</div>
            <div class="text-gray-500 font-medium py-1">Min</div>
        </div>

        <div class="grid grid-cols-7 gap-1 text-center text-xs">
            <template x-for="(day, idx) in calendarDays" :key="idx">
                <div class="aspect-square relative flex flex-col items-center justify-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer transition"
                    :class="{
                                'bg-[#6C63FF] text-white font-semibold shadow-md shadow-indigo-500/20': day === today && !isOtherMonth(idx),
                                'text-gray-400': isOtherMonth(idx),
                                'text-gray-800 dark:text-gray-300': !isOtherMonth(idx) && day !== today
                                }">
                    <span x-text="day"></span>

                    <!-- Indikator Acara/Tugas -->
                    <template x-if="!isOtherMonth(idx) && events[day]">
                        <div class="absolute bottom-1 flex gap-0.5">
                            <template x-for="type in events[day]" :key="type">
                                <div class="w-1 h-1 rounded-full"
                                     :class="{
                                        'bg-red-500': type === 'terlambat',
                                        'bg-yellow-500': type === 'segera',
                                        'bg-white': type === 'onTrack' && day === today,
                                        'bg-[#6C63FF]': type === 'onTrack' && day !== today,
                                        'bg-green-500': type === 'tugasBaru',
                                     }"></div>
                            </template>
                        </div>
                    </template>
                </div>
            </template>
        </div>


    <!-- Daftar Tugas -->
    @if(!request()->is('super-admin/*') && !request()->is('admin/*'))
    <div>
        <div class="flex items-center justify-between mb-3">
            <h4 class="text-sm font-semibold dark:text-white">Semua Tugas</h4>
            <button class="text-xs text-primary hover:underline">Filter</button>
        </div>

    <!-- Tugas tiap role -->
        @php
            $status = [
                'terlambat' => [
                    'badge_text' => 'Terlambat',
                    'container_class' => 'bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20',
                    'title_class' => 'text-red-700 dark:text-red-400',
                    'badge_class' => 'bg-red-500 text-white',
                    'subtext_class' => 'text-red-500/80 dark:text-red-400/70',
                ],
                'segera' => [
                    'badge_text' => 'Segera',
                    'container_class' => 'bg-yellow-50 dark:bg-yellow-500/10 border border-yellow-200 dark:border-yellow-500/20',
                    'title_class' => 'text-yellow-700 dark:text-yellow-400',
                    'badge_class' => 'bg-yellow-400 text-white',
                    'subtext_class' => 'text-yellow-600/70 dark:text-yellow-400/70',
                ],
                'onTrack' => [
                    'badge_text' => 'On Track',
                    'container_class' => 'border',
                    'container_style' => 'background:rgba(108,99,255,0.05);border-color:rgba(108,99,255,0.20)',
                    'title_class' => 'text-primary',
                    'badge_class' => 'text-white',
                    'badge_style' => 'background:#6C63FF',
                    'subtext_class' => 'text-primary/70',
                ],
                'tugasBaru' => [
                    'badge_text' => 'Baru',
                    'container_class' => 'bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20',
                    'title_class' => 'text-green-700 dark:text-green-400',
                    'badge_class' => 'bg-green-500 text-white',
                    'subtext_class' => 'text-green-600/70 dark:text-green-400/70',
                ],
                'selesai' => [
                    'badge_text' => 'Selesai',
                    'container_class' => 'bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10',
                    'title_class' => 'text-gray-400 line-through',
                    'badge_class' => 'bg-gray-300 dark:bg-white/20 text-gray-600 dark:text-white/60',
                    'subtext_class' => 'text-gray-400',
                ],
            ];

            // Daftar tugas berdasarkan role
            $tasks = [];
            if (request()->is('instruktur/*')) {
               $tasks = [
                   ['title' => 'UI/UX Case Study',       'subtext' => 'UI/UX Design · 19 Apr',       ...$status['terlambat']],
                   ['title' => 'Analisis Sorting',        'subtext' => 'DSA · 22 Apr',                ...$status['segera']],
                   ['title' => 'Business Model Canvas',   'subtext' => 'Entrepreneurship · 25 Apr',   ...$status['onTrack']],
                   ['title' => 'SEO Content Strategy',    'subtext' => 'Digital Marketing · 28 Apr',  ...$status['tugasBaru']],
                   ['title' => 'Wireframe Prototype',     'subtext' => 'UI/UX Design · 15 Apr',      ...$status['selesai']],
                   ['title' => 'Array & Linked List Quiz', 'subtext' => 'DSA · 10 Apr',              ...$status['selesai']]
               ];
            }
            elseif (request()->is('peserta/*')) {
               $tasks = [
                   ['title' => 'UI/UX Case Study',       'subtext' => 'UI/UX Design · 19 Apr',       ...$status['terlambat']],
                   ['title' => 'Analisis Sorting',        'subtext' => 'DSA · 22 Apr',                ...$status['segera']],
                   ['title' => 'Business Model Canvas',   'subtext' => 'Entrepreneurship · 25 Apr',   ...$status['onTrack']],
                   ['title' => 'SEO Content Strategy',    'subtext' => 'Digital Marketing · 28 Apr',  ...$status['tugasBaru']],
                   ['title' => 'Wireframe Prototype',     'subtext' => 'UI/UX Design · 15 Apr',      ...$status['selesai']],
                   ['title' => 'Array & Linked List Quiz', 'subtext' => 'DSA · 10 Apr',              ...$status['selesai']]
               ];
            }
        @endphp

    @if(!empty($tasks))
    <div class="space-y-2">
        @foreach($tasks as $task)
            <div class="rounded-xl p-3 {{ $task['container_class'] ?? '' }}" style="{{ $task['container_style'] ?? '' }}">
                <div class="flex items-start justify-between gap-2 mb-1">
                    <p class="text-xs font-semibold leading-tight {{ $task['title_class'] ?? '' }}">
                        {{ $task['title'] }}
                    </p>
                    <span class="text-[9px] font-bold px-1.5 py-0.5 rounded-full flex-shrink-0 {{ $task['badge_class'] ?? '' }}" style="{{ $task['badge_style'] ?? '' }}">
                        {{ $task['badge_text'] }}
                    </span>
                </div>
                <p class="text-[10px] {{ $task['subtext_class'] ?? '' }}">{{ $task['subtext'] }}</p>
            </div>
        @endforeach
    </div>
    @endif
    </div>
    @endif
</aside>



<script>
    function calendarWidget() {
        return {
            currentDate: new Date(),
            today: new Date().getDate(),
            monthYear: '',
            calendarDays: [],

            // Data mockup events: { tanggal: ['tipe1', 'tipe2'] }
            events: {!! (!request()->is('super-admin/*') && !request()->is('admin/*')) ? json_encode([
                10 => ['selesai'],
                15 => ['selesai'],
                19 => ['terlambat'],
                22 => ['segera'],
                25 => ['onTrack'],
                28 => ['tugasBaru']
            ]) : '{}' !!},

            init() {
                this.updateCalendar();
            },

            updateCalendar() {
                const year = this.currentDate.getFullYear();
                const month = this.currentDate.getMonth();

                const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                  'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                this.monthYear = monthNames[month] + ' ' + year;

                let firstDay = new Date(year, month, 1).getDay();
                if(firstDay === 0) firstDay = 7; // Convert Sunday(0) to 7 so Monday is 1

                const daysInMonth = new Date(year, month + 1, 0).getDate();
                const daysInPrevMonth = new Date(year, month, 0).getDate();

                this.calendarDays = [];

                // Prev month days
                for (let i = firstDay - 2; i >= 0; i--) {
                    this.calendarDays.push(daysInPrevMonth - i);
                }

                // Current month days
                for (let i = 1; i <= daysInMonth; i++) {
                    this.calendarDays.push(i);
                }

                // Next month days
                let totalCells = 35;
                if (this.calendarDays.length > 35) {
                    totalCells = 42;
                }
                const remainingDays = totalCells - this.calendarDays.length;
                for (let i = 1; i <= remainingDays; i++) {
                    this.calendarDays.push(i);
                }

                const todayDate = new Date();
                if (todayDate.getFullYear() === year && todayDate.getMonth() === month) {
                    this.today = todayDate.getDate();
                } else {
                    this.today = -1;
                }
            },

            isOtherMonth(index) {
                const year = this.currentDate.getFullYear();
                const month = this.currentDate.getMonth();
                let firstDay = new Date(year, month, 1).getDay();
                if(firstDay === 0) firstDay = 7;

                const daysInMonth = new Date(year, month + 1, 0).getDate();
                return index < (firstDay - 1) || index >= (firstDay - 1) + daysInMonth;
            },

            prevMonth() {
                this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() - 1);
                this.updateCalendar();
            },

            nextMonth() {
                this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1);
                this.updateCalendar();
            }
        }
    }
</script>
