# Dokumentasi Konfigurasi (Config)

Direktori `config/` dalam aplikasi Mindfloox digunakan untuk menyimpan berbagai data statis berupa array yang mensimulasikan database untuk keperluan tampilan (mock data) dan pengaturan tampilan spesifik aplikasi. Pendekatan ini digunakan agar antarmuka (UI) dapat dirender tanpa perlu melakukan *query* kompleks ke database selama fase pengembangan atau purwarupa.

Berikut adalah penjelasan fungsi dari masing-masing berkas konfigurasi khusus yang ada di `config/`:

## 1. `config/program.php`
Berkas ini mengembalikan array *associative* yang berisi daftar program/kursus unggulan. 
**Penggunaan Utama:** Digunakan oleh Controller (misalnya `HomeController`) untuk menampilkan daftar kursus/program di halaman depan (Landing Page).
**Struktur Data:**
- `title` (String): Nama program/kursus (Contoh: 'Desain Grafis', 'Fullstack Web Dev').
- `category` (String): Kategori program (Contoh: 'DESIGN', 'CODE').
- `price` (Integer): Harga kursus.
- `image` (String): URL/Path gambar representasi kursus.
- `author` (String): Nama pembuat/instruktur kursus.
- `role` (String): Jabatan atau peran instruktur.
- `rating` (Float): Nilai ulasan (Contoh: 4.9).
- `students` (Integer): Jumlah siswa yang terdaftar.

## 2. `config/tugas.php`
Berkas ini menyimpan kumpulan data tugas, proyek, dan kuis yang ditugaskan kepada peserta, beserta pengaturan *styling* antarmukanya (UI).
**Penggunaan Utama:** Menampilkan jadwal dan status penugasan di Dasbor Instruktur dan Peserta.
**Struktur Data:**
- `type` (String): Jenis aktivitas ('tugas', 'project', atau 'kuis').
- `title` (String): Nama penugasan.
- `course` (String): Mata kuliah/kursus terkait.
- `status` (String): Status pengerjaan ('soon', 'overdue', 'track').
- `label` (String): Label bahasa Indonesia untuk status.
- `time` (String): Keterangan sisa atau lewat waktu (Contoh: '1 hari lagi').
- `deadline` (String): Tanggal jatuh tempo.
- `ui` (Array): Kelas *styling* TailwindCSS spesifik berdasarkan status untuk dirender di Blade Template:
  - `border`, `badge`, `dot`, `text`, `button`

## 3. `config/instruktur.php`
Berkas ini mendefinisikan daftar profil instruktur yang mengajar di platform.
**Penggunaan Utama:** Menampilkan *carousel* atau daftar instruktur top di halaman publik (`instruktur.blade.php` atau sejenisnya).
**Struktur Data:**
- `name` (String): Nama lengkap instruktur.
- `field` (String): Bidang keahlian (Contoh: 'Web Development', 'Data Science').
- `students` (String): Jumlah murid yang pernah diajar (format teks seperti '2.1k').
- `rating` (Float): Nilai ulasan instruktur.
- `totalCourses` (Integer): Jumlah kursus yang dibuat oleh instruktur tersebut.
- `image` (String): URL/Path foto profil instruktur.

## 4. `config/kuis.php`
Berkas ini berisi data simulasi untuk struktur kuis dan daftar pertanyaannya (termasuk jenis pilihan ganda dan esai).
**Penggunaan Utama:** Digunakan di halaman pengerjaan atau ulasan kuis (`kuis-detail.blade.php`, `kuis-mulai.blade.php`) untuk menampilkan butir soal.
**Struktur Data:**
- `id` (Integer): ID kuis.
- `title` (String): Judul kuis.
- `deadline` (String): Batas waktu.
- `questions` (Array): Kumpulan pertanyaan kuis:
  - `id` (Integer): ID Pertanyaan.
  - `type` (String): Jenis pertanyaan ('multiple_choice' atau 'essay').
  - `question` (String): Teks soal.
  - `options` (Array of String, *Opsional*): Opsi A, B, C, D jika `type` adalah `multiple_choice`.
  - `answer` (String): Kunci jawaban yang benar.

## 5. `config/kategori.php`
Berkas ini memuat daftar kategori kursus beserta ikon SVG dan gaya warna untuk ditampilkan secara visual di halaman eksplorasi program.
**Penggunaan Utama:** Ditampilkan dalam bentuk kartu kategori di halaman landing (Index) maupun pencarian program.
**Struktur Data:**
- `name` (String): Nama kategori (Contoh: 'Development', 'Design').
- `count` (String): Estimasi jumlah kursus (Contoh: '1.2k+').
- `icon` (String): Path atribut `d` dari tag `<path>` SVG untuk ikon kategori.
- `color` (String): Kelas utilitas warna teks Tailwind (Contoh: 'text-blue-400', 'text-purple-400') untuk memberikan ciri khas warna pada masing-masing kategori.
