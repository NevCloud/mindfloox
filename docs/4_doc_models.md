# Dokumentasi Models (Struktur Data Database)

Direktori `app/Models/` memuat kelas-kelas *Eloquent ORM* yang merepresentasikan tabel-tabel di dalam database MySQL. Sistem database Mindfloox dirancang sangat terstruktur dan berelasi (Relational Database) untuk mendukung skenario *Learning Management System* (LMS) berskala besar.

Secara garis besar, entitas data dapat dikelompokkan menjadi beberapa domain utama:

## 1. Domain Pengguna & Peran (Users & Roles)
Platform ini menerapkan pemisahan data profil berdasarkan peran untuk menjaga fleksibilitas atribut.
- **`User` / `Pengguna`**: Tabel utama untuk Autentikasi (`username`, `password`, `role`). Seluruh relasi peran merujuk ke tabel ini.
- **`SuperAdmin`**: Entitas pengelola sistem tertinggi.
- **`AdminMicrocredential`**: Entitas admin pengelola program studi/pendaftaran.
- **`Instruktur`**: Entitas pengajar. Berelasi dengan `Kursus`, `NilaiKursus`, `Tugas`.
- **`Peserta`**: Entitas mahasiswa/pelajar. Berelasi dengan `Pendaftaran`, `SesiKuis`, `JawabanTugas`.

## 2. Domain Program Akademik
Struktur hierarki program yang ditawarkan.
- **`JenisMicrocredential`**: Kategori program (Misal: Reguler, Kampus Merdeka).
- **`ProgramMicrocredential`**: Induk program studi.
- **`Semester`**: Periode akademik.
- **`Kursus`**: Mata kuliah spesifik di dalam program. Berelasi langsung dengan `Instruktur`, `MateriPembelajaran`, `Tugas`, dan `Kuis`.
- **`Minggu`**: Entitas untuk memecah kursus menjadi silabus per-minggu (Week 1, Week 2, dst).

## 3. Domain Operasional Belajar-Mengajar
Konten dan interaksi pembelajaran.
- **`MateriPembelajaran`**: Berisi file PDF, Video, atau teks.
- **`Tugas`**: Entitas penugasan.
- **`Kuis`**: Entitas evaluasi kuis/ujian.
- **`PertanyaanKuis`**: Butir soal dari kuis.
- **`PilihanJawaban`**: Opsi A, B, C, D dari soal pilihan ganda.
- **`KunciJawabanEsai`**: Rubrik kunci jawaban untuk soal tipe esai.

## 4. Domain Transaksi & Partisipasi
- **`Pendaftaran`**: Tabel *pivot* kompleks yang mencatat partisipasi `Peserta` ke sebuah `ProgramMicrocredential`.
- **`KursusInstruktur`**: Tabel *pivot* relasi Many-to-Many penugasan Instruktur terhadap Kursus.
- **`SesiKuis`**: Mencatat *attempt* (percobaan) peserta saat mulai mengerjakan kuis (berisi waktu mulai dan selesai).
- **`JawabanKuis`**: Menyimpan jawaban spesifik per soal dari sesi kuis peserta.
- **`JawabanTugas`**: Menyimpan file atau teks hasil pekerjaan tugas peserta.

## 5. Domain Penilaian & Sertifikasi
- **`NilaiTugas`**: Rekap nilai instruktur untuk spesifik tugas peserta.
- **`NilaiKuis`**: Rekap nilai akhir dari sebuah sesi kuis.
- **`NilaiKursus`**: Agregat nilai akhir peserta untuk satu mata kuliah penuh.
- **`SertifikatKursus`**: Entitas pencetakan kelulusan.
- **`UlasanKursus`**: *Rating* dan tanggapan peserta terhadap kualitas kursus.

### Relasi Kunci (Relationships)
Sebagian besar relasi dibangun menggunakan kaidah bawaan Laravel (BelongsTo, HasMany, BelongsToMany). Contoh:
- `Peserta` *hasMany* `Pendaftaran`.
- `Kursus` *hasMany* `MateriPembelajaran`, `Tugas`, `Kuis`.
- `Kuis` *hasMany* `PertanyaanKuis`.
