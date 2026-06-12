# Dokumentasi Controllers (Pengendali Logika)

Direktori `app/Http/Controllers/` berisi kelas-kelas yang mengatur alur logika utama antara *Route*, *Model*, dan *View*. Sebagian besar Controller saat ini bertugas menyajikan data dari file konfigurasi statis (`config/`) ke tampilan (*views*).

Berikut adalah analisa kelas Controller yang ada:

## 1. `AuthController.php`
Ini adalah *controller* paling vital yang mengatur alur keamanan autentikasi pengguna. Memiliki dua *method* utama:
- **`login(Request $request)`**:
  1. **Validasi**: Menggunakan `$request->validate()` untuk memastikan kolom `username` dan `password` dikirim berupa teks tidak kosong.
  2. **Kredensial**: Menyiapkan array kondisi pencarian ke tabel *users* (mengecek kecocokan `username`, `password`, dan memastikan `aktif` == 'aktif').
  3. **Autentikasi (Auth::attempt)**: Proses inti bawaan Laravel untuk memverifikasi kecocokan *hash* password.
  4. **Proteksi & Pengalihan**: Jika berhasil, `$request->session()->regenerate()` dipanggil untuk menghindari serangan *Session Fixation*. Lalu, membaca kolom `role` dari pengguna yang masuk, dan me-redirect mereka ke dasbor masing-masing (`/peserta/dasbor`, `/instruktur/dasbor`, dll).
  5. **Penanganan Gagal**: Jika gagal masuk, fungsi `back()->with('error', ...)` dipanggil untuk kembali ke form awal dengan pesan galat.
- **`logout(Request $request)`**:
  Menjalankan `Auth::logout()` untuk menghapus state login pengguna, `$request->session()->invalidate()` untuk mematikan sisa data *session*, dan `$request->session()->regenerateToken()` untuk memperbarui token keamanan CSRF sebelum kembali ke `/login`.

## 2. `HomeController.php`
- **`index()`**: Menangani rute `/` (halaman depan/Landing Page). Berfungsi menarik data dari fungsi bantuan `config('program')`, `config('instruktur')`, dan `config('kategori')`. Lalu menyisipkan variabel tersebut melalui `compact()` untuk dimuat di dalam `resources/views/index.blade.php`.

## 3. `instrukturController.php`
- **`instruktur()`**: Menangani rute `/instruktur` publik. Berfungsi memuat data profil instruktur dari `config('instruktur')` dan menampilkannya di halaman daftar instruktur (`resources/views/instruktur.blade.php`).

## 4. `programController.php`
- **`index()`**: Menangani rute eksplorasi program `/program`. Berfungsi menarik data dari `config('program')` dan merendernya ke tampilan eksplorasi program publik di `resources/views/program.blade.php`. (Saat ini *use* `LengthAwarePaginator` dan `Collection` sudah diimpor tetapi belum diimplementasikan untuk *pagination*).

## 5. `tugasController.php`
Menangani fitur evaluasi dan penugasan untuk peserta. (Sebelumnya logika ini mungkin disebar di route closure, kini dikelompokkan dalam satu kelas ini).
- **`tugas()`**: Memuat array penugasan dari `config('tugas')` dan mengarahkannya ke tampilan `peserta.tugas`.
- **`kuis()`**: Memuat struktur soal kuis dari `config('kuis')` dan mengarahkannya ke tampilan `peserta.kuis-mulai`.
- **`kuisDetail()`**: Memuat rekaman detail jawaban/soal dari `config('kuis')` ke tampilan `peserta.kuis-detail`.

## 6. `Controller.php`
Kelas fondasi bawaan Laravel (`BaseController`) yang diwarisi (*extends*) oleh seluruh controller di atas. Berisi trait dasar seperti `AuthorizesRequests` dan `ValidatesRequests`.
