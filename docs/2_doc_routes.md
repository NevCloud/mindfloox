# Dokumentasi Rute (Routing)

Berkas utama untuk mendefinisikan seluruh rute web pada aplikasi Mindfloox adalah `routes/web.php`. Pengelompokan rute (`Route::group`) dan prefix (`Route::prefix`) banyak digunakan untuk mengelola jalur akses (*endpoints*) berdasarkan fungsionalitas dan peran pengguna.

Berikut adalah analisa rincian rute:

## 1. Rute Autentikasi (Authentication)
Menangani proses masuk (login), keluar (logout), dan pendaftaran akun.
- `GET /login`: Menampilkan form login. Memiliki logika pengecekan (*Guest Check*) di mana jika pengguna sudah masuk (`Auth::check()`), ia akan langsung diarahkan (*redirect*) ke dasbor sesuai peran (`role`)-nya (Peserta, Instruktur, Admin, Super Admin).
- `POST /login`: Memproses validasi form login dengan `AuthController@login`.
- `POST /logout`: Menghapus sesi masuk menggunakan `AuthController@logout`.
- `GET /register`: Menampilkan form registrasi pengguna baru (masih berupa *view* statis).

## 2. Rute Publik (Akses Tanpa Login)
Halaman yang dapat diakses oleh siapa saja.
- `GET /`: Halaman Utama (Landing Page). Dikelola oleh `homeController@index`.
- `GET /tentang`: Halaman Tentang Kami (Statis menggunakan *arrow function/closure*).
- `GET /instruktur`: Halaman daftar Instruktur. Dikelola oleh `instrukturController@instruktur`.

## 3. Rute Program Akademik (Publik & Terdaftar)
Memiliki *prefix* `/program`.
- `GET /program/`: Halaman jelajah program.
- `GET /program/saya`: Halaman program milik saya.
- `GET /program/pendaftaran`: Halaman pendaftaran program baru.

## 4. Dasbor Instruktur (`/instruktur`)
Akses khusus bagi pengguna dengan peran (Role) Instruktur. Dilindungi oleh middleware `check.session:instruktur`. Sebagian besar rute me-return *view* secara langsung menggunakan fitur *closure* PHP 8 (`fn() => view(...)`).
- `/dasbor`: Halaman utama ringkasan performa instruktur.
- `/profil`: Pengaturan data diri instruktur.
- `/kursus` & `/detail-kursus`: Pengelolaan kursus yang diajar.
- `/tugas`, `/tugas-detail`, `/tugas-kumpul`: Manajemen pemberian dan penilaian tugas. Data tugas dimuat dari `config('tugas')`.
- `/kuis-mulai`, `/kuis-detail`: Manajemen penyelenggaraan kuis. Data kuis dimuat dari `config('kuis')`.
- `/upload-materi`: Halaman unggah bahan ajar.

## 5. Dasbor Peserta (`/peserta`)
Akses khusus bagi mahasiswa/peserta pembelajaran. Dilindungi oleh middleware `check.session:peserta`.
- `/dasbor`: Halaman utama perkembangan belajar.
- `/kursus`, `/detail-kursus`: Akses ruang belajar.
- `/profil`: Biodata mahasiswa.
- `/tugas`, `/tugas-detail`, `/tugas-kumpul`: Ruang pengerjaan dan pengumpulan tugas (Dikelola oleh `tugasController`).
- `/kuis-mulai`, `/kuis-detail`: Ruang pengerjaan evaluasi/kuis.
- `/nilai-detail`: Transkrip dan rekap nilai akhir.

## 6. Dasbor Super Admin (`/super-admin`)
Akses tertinggi untuk manajemen arsitektur sistem. Dilindungi oleh middleware `check.session:super_admin`.
- `/dasbor`: Statistik tingkat atas platform.
- `/profil`: Profil admin sistem.
- Manajemen Entitas Inti (Statis): 
  - `/program`, `/program/edit`, `/admin-instruktur`, `/jenis-microcredential`, `/periode-akademik`, `/program-microcredential`, `/semester`.

## 7. Dasbor Admin Verifikasi (`/admin`)
Akses tingkat menengah untuk verifikasi dan manajemen akademik harian. Dilindungi oleh middleware `check.session:admin_microcredential`.
- `/dasbor`, `/profil`: Ringkasan aktivitas dan profil.
- `/program`, `/program/create`, `/program/{id}/edit`: CRUD Program Studi/Microcredential.
- `/program/{id}/kursus`, `.../create`, `.../{course}/edit`: CRUD Sub-Kursus di dalam suatu program.
- `/verifikasi`: Antarmuka validasi kelayakan mahasiswa pendaftar baru (`admin.verifikasiIndex`).
