<div align="center">

<img src="https://capsule-render.vercel.app/api?type=waving&color=gradient&customColorList=6,11,20&height=220&section=header&text=MIND%20FLOOX&fontSize=60&fontColor=ffffff&animation=fadeIn&fontAlignY=38&desc=Platform%20Pembelajaran%20Daring%20untuk%20Sertifikasi%20Microcredential&descAlignY=55&descSize=18" width="100%"/>

<a href="https://github.com/">
  <img src="https://readme-typing-svg.demolab.com?font=Poppins&size=22&duration=3000&pause=800&color=6C63FF&center=true&vCenter=true&width=600&lines=Selamat+Datang+di+Repositori+Mind+Floox+%F0%9F%91%8B;Platform+Microcredential+Berbasis+Web;Dibangun+dengan+Laravel+%2B+Tailwind+%2B+Alpine.js;Kelompok+PBL-214+%7C+TRPL+Polibatam" alt="Typing SVG" />
</a>

<br/>

<img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
<img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" />
<img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=black" />
<img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" />

<br/>

![Repo Size](https://img.shields.io/github/repo-size/your-org/mindfloox?style=flat-square&color=6C63FF)
![Last Commit](https://img.shields.io/github/last-commit/your-org/mindfloox?style=flat-square&color=4CAF50)
![Contributors](https://img.shields.io/github/contributors/your-org/mindfloox?style=flat-square&color=FF6584)
![License](https://img.shields.io/badge/license-Academic-lightgrey?style=flat-square)

</div>

<img src="https://capsule-render.vercel.app/api?type=transparent&height=1&section=header" width="100%"/>

## 📖 Deskripsi Umum

**Mind Floox** adalah platform pembelajaran daring (LMS) berbasis web yang dirancang untuk memfasilitasi sertifikasi kompetensi jangka pendek (*microcredential*) bagi mahasiswa. Sistem ini mengintegrasikan empat aktor utama: **Super Admin**, **Admin Microcredential**, **Instruktur**, dan **Peserta**.

Proses bisnis yang dicakup meliputi:
- 📝 Pendaftaran dan verifikasi peserta program
- 📚 Pengelolaan kursus 14 minggu
- ✅ Evaluasi melalui tugas dan kuis
- 📊 Pelacakan progres belajar secara transparan
- 🎓 Penerbitan sertifikat digital otomatis

Dibangun menggunakan **Laravel** (pola arsitektur MVC), **Tailwind CSS**, dan **Alpine.js**, aplikasi ini menghasilkan sistem pembelajaran yang responsif, aman, dan efisien.

<br/>

## 🎯 Latar Belakang

> Mahasiswa membutuhkan perolehan kompetensi spesifik tambahan untuk kesiapan kerja, didukung oleh data riset yang menunjukkan tingginya urgensi *microcredential* bagi karier mahasiswa. Platform yang ada saat ini belum terintegrasi secara khusus dengan institusi pendidikan serta belum menyediakan sistem terpusat untuk pendaftaran, penilaian, dan pengakuan kompetensi secara resmi.

## 🚀 Tujuan

> Membangun platform pembelajaran daring guna memudahkan pengelolaan pendaftaran, materi, evaluasi, hingga penerbitan sertifikat kompetensi mahasiswa, serta menyediakan validasi kelulusan otomatis demi menjamin keabsahan sertifikat digital.

<br/>

## 👥 Aktor & Fitur Utama

<div align="center">

| Aktor | Fitur Utama |
|:---:|---|
| 🛡️ **Super Admin** | Mengelola jenis microcredential, akun Admin Microcredential, data profil Instruktur, periode pembelajaran, dan program microcredential |
| 🧑‍💼 **Admin Microcredential** | Mengelola kursus, menugaskan Instruktur ke kursus, verifikasi pendaftaran Peserta |
| 🧑‍🏫 **Instruktur** | Mengelola materi pembelajaran, tugas, dan kuis; menilai hasil evaluasi Peserta |
| 🎓 **Peserta** | Mendaftar program, mempelajari materi, mengerjakan tugas/kuis, memantau progres, mengunduh sertifikat, memberikan rating |

</div>

<br/>

## 🛠️ Tech Stack

<div align="center">

<img src="https://skillicons.dev/icons?i=laravel,tailwind,mysql,postgres,js,html,css,git,github,vscode" />

</div>

- **Backend:** Laravel (PHP) — pola arsitektur MVC
- **Frontend:** Tailwind CSS v4 + Alpine.js
- **Database:** MySQL / PostgreSQL
- **Metodologi Pengembangan:** SDLC Model Waterfall

<br/>

## 🔄 Metodologi Pengembangan

Pengembangan aplikasi ini menerapkan **SDLC Model Waterfall**, dipilih karena membutuhkan struktur yang sistematis, dokumentasi matang (SKPPL), serta definisi kebutuhan fitur yang jelas sejak awal untuk meminimalisir kesalahan rancangan sebelum tahap pengodean.

```mermaid
flowchart LR
    A["📋 Planning"] --> B["🔍 Analysis"]
    B --> C["🎨 Design"]
    C --> D["💻 Implementation"]
    D --> E["🧪 Testing & Integration"]
    E --> F["🔧 Maintenance"]

    style A fill:#B0392B,color:#fff
    style B fill:#1F3A63,color:#fff
    style C fill:#3B8FC4,color:#fff
    style D fill:#2E9E7F,color:#fff
    style E fill:#E2B33C,color:#000
    style F fill:#D9822B,color:#fff
```

<br/>

## ✅ Kesimpulan

Aplikasi Microcredential Mind Floox berhasil dirancang sesuai spesifikasi kebutuhan untuk menjadi platform pembelajaran daring yang efisien. Melalui integrasi manajemen multi-role, pelacakan progres belajar yang transparan, serta sistem otomatisasi penerbitan sertifikat digital, aplikasi ini mampu menjawab kebutuhan institusi pendidikan dalam menyelenggarakan program penguatan kompetensi mahasiswa secara terorganisasi dan akuntabel.

<br/>

## 👨‍💻 Tim Pengembang

<div align="center">

Proyek ini dikembangkan oleh mahasiswa Program Studi <b>Teknologi Rekayasa Perangkat Lunak (TRPL)</b>, Politeknik Negeri Batam — Kelompok <b>PBL-214</b>.

| NIM | Nama | Peran |
|:---:|---|:---:|
| 4342501015 | Shabir Khan | Anggota Kelompok |
| 4342501009 | Charoline Feby Riyani | Anggota Kelompok |
| 4342501008 | Arkam Arasid Meliala | Anggota Kelompok |
| 4342501024 | Nadya Nofitri | Anggota Kelompok |
| 4342501012 | Muhammad Fahad Arifin | Anggota Kelompok |
| NIK 1222382 | Cahya Miranto | 🧑‍💼 Manajer Proyek |

</div>

<br/>

<div align="center">
<img src="https://capsule-render.vercel.app/api?type=waving&color=gradient&customColorList=6,11,20&height=120&section=footer"/>

<i>Teknologi Rekayasa Perangkat Lunak — Politeknik Negeri Batam</i>
</div>
