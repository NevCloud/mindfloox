# Dokumentasi Views (Antarmuka Pengguna / Blade)

Direktori `resources/views/` berisi semua templat antarmuka (UI) menggunakan *Blade Templating Engine* khas Laravel. Sistem antarmuka aplikasi ini dirancang secara modular dengan pendekatan berbasis peran.

Berikut adalah dekomposisi struktur Views:

## 1. Tata Letak Induk (Layouts)
Lokasi: `resources/views/layouts/`
Berfungsi sebagai kerangka utama halaman HTML (`<html>`, `<head>`, `<body>`), tempat memuat *stylesheet* (TailwindCSS) dan modul skrip (*script*).
- **`app.blade.php`**: Layout utama yang digunakan oleh Dasbor Admin, Super Admin, dan Peserta.
- **`instruktur.blade.php`**: Layout terpisah yang dikhususkan untuk pengalaman antarmuka pengguna (UX) Dasbor Instruktur.

## 2. Komponen Penggunaan Ulang (Components)
Lokasi: `resources/views/components/`
Potongan kode UI yang dipecah agar dapat dipanggil berkali-kali menggunakan sintaks `@include('components.nama_file')`.
- **`navbar.blade.php`**: Menu navigasi atas untuk halaman publik.
- **`footer.blade.php`**: Bagian kaki (*footer*) halaman publik.
- **`topNav.blade.php`**: Bilah navigasi atas (Header) khusus untuk dalam Dasbor (mengandung notifikasi dan profil dropdown).
- **`leftPanel.blade.php`**: Bilah menu navigasi samping kiri (Sidebar) di dalam dasbor. Merender menu secara dinamis tergantung *role* (`$role = Auth::user()->role;`).
- **`rightPanel.blade.php`**: Bilah informasi tambahan (Widget) di sisi kanan dasbor (seperti Kalender, Pengumuman, atau Tugas Mendatang).
- **`course-card.blade.php`**: Komponen visual kartu untuk menampilkan detail satu kursus/program.
- **`stats.blade.php` & `banner.blade.php`**: Bagian dekoratif untuk halaman landing publik.

## 3. Halaman Publik
Halaman-halaman statis & dinamis untuk pengunjung (*guest*).
- **`index.blade.php`**: Landing page utama (Beranda).
- **`login.blade.php`**: Form Autentikasi.
- **`register.blade.php`**: Form Pembuatan Akun.
- **`tentang.blade.php`**: Halaman informasi "Tentang Kami".
- **`program.blade.php` & `programsaya.blade.php`**: Katalog program akademik publik.
- **`instruktur.blade.php`**: Etalase profil instruktur unggulan.

## 4. Halaman Dasbor Instruktur (`instruktur/`)
Pengalaman ruang pengajar (LMS Backend).
- **`dasbor.blade.php`**: Ringkasan performa dan kelas yang diajar.
- **`kursus.blade.php` & `detail-kursus.blade.php`**: Katalog kursus dan tampilan modul pembelajaran.
- **`upload-materi.blade.php`**: Form untuk mendistribusikan berkas ajar.
- **`tugas.blade.php`**: Daftar penugasan yang diberikan.
- **`tugas-kumpul.blade.php` & `tugas-detail.blade.php`**: Antarmuka untuk melihat dan menilai (*grading*) hasil unggahan tugas dari peserta.
- **`kuis-mulai.blade.php` & `kuis-detail.blade.php`**: Antarmuka pratinjau soal kuis.

## 5. Halaman Dasbor Peserta (`peserta/`)
Pengalaman ruang belajar mahasiswa (LMS Frontend).
- **`dasbor.blade.php`**: Status progres (*progress*) kelulusan kursus dan jadwal.
- **`kursus.blade.php` & `detail-kursus.blade.php`**: Area interaksi materi belajar.
- **`tugas.blade.php` & `tugas-kumpul.blade.php`**: Antarmuka ulasan deskripsi tugas dan form unggah (*upload*) jawaban tugas.
- **`kuis-mulai.blade.php`**: Layar pengerjaan kuis interaktif yang merender data dari config/database.
- **`nilai-detail.blade.php`**: Laporan transkrip nilai/rapor akademik peserta.

## 6. Halaman Panel Super Admin (`superAdmin/`)
Antarmuka tata kelola konfigurasi tingkat tinggi (Platform Architecture).
- **`dasbor.blade.php`**: Statistik platform secara global.
- **`adminInstruktur.blade.php`**: Manajemen akun pengguna pengajar.
- **`program.blade.php` & `programEdit.blade.php`**: CRUD data master Program.
- **`jenisMicrocredential.blade.php` & `programMicrocredential.blade.php`**: Standarisasi jenis sertifikasi.
- **`periodeAkademik.blade.php` & `semester.blade.php`**: Penjadwalan gelombang/batch pembelajaran.

## 7. Halaman Panel Admin Verifikasi (`admin/`)
Antarmuka kegiatan operasional dan moderasi harian.
- **`dasbor.blade.php`**: Indikator antrean verifikasi dan pendaftaran harian.
- **`verifikasiIndex.blade.php`**: Tabel *approval* dokumen pendaftaran peserta baru.
- **`programIndex.blade.php` & `programCreate.blade.php` & `programEdit.blade.php`**: Manajemen pembuatan program studi baru.
- **`kursusIndex.blade.php` & `kursusCreate.blade.php` & `kursusEdit.blade.php`**: Penambahan modul kursus bersarang (Nested resource) di dalam program studi.
