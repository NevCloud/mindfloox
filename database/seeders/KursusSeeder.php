<?php

namespace Database\Seeders;

use App\Models\Instruktur;
use App\Models\JenisMicrocredential;
use App\Models\Kursus;
use App\Models\KursusInstruktur;
use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\ProgramMicrocredential;
use App\Models\Semester;
use Illuminate\Database\Seeder;

class KursusSeeder extends Seeder
{
    public function run(): void
    {
        $jenis = JenisMicrocredential::firstOrCreate(
            ['nama' => 'Teknologi Informasi'],
            ['deskripsi' => 'Program microcredential bidang teknologi informasi']
        );

        $semester = Semester::firstOrCreate(
            ['tahun' => 2024, 'jenis' => 'ganjil'],
            ['tanggal_mulai' => '2024-09-01', 'tanggal_selesai' => '2025-01-31']
        );

        $program = ProgramMicrocredential::firstOrCreate(
            ['nama' => 'Pengembangan Aplikasi Web'],
            [
                'id_jenis_microcredential' => $jenis->id,
                'id_semester'              => $semester->id,
                'deskripsi'                => 'Program pelatihan pengembangan aplikasi web modern',
                'foto_program'             => 'default.jpg',
                'status_pendaftaran'       => 'buka',
            ]
        );

        $kursus = [
            [
                'nama'                   => 'Dasar Pemrograman Web',
                'deskripsi'              => 'Mempelajari HTML, CSS, dan JavaScript sebagai fondasi pengembangan web.',
                'foto_kursus'            => 'default.jpg',
            ],
            [
                'nama'                   => 'Framework Laravel',
                'deskripsi'              => 'Membangun aplikasi web menggunakan framework Laravel.',
                'foto_kursus'            => 'default.jpg',
            ],
        ];

        $instruktur = Instruktur::first();

        foreach ($kursus as $data) {
            $k = Kursus::firstOrCreate(
                ['nama' => $data['nama'], 'id_program_microcredential' => $program->id],
                array_merge($data, ['id_program_microcredential' => $program->id])
            );

            if ($instruktur) {
                KursusInstruktur::firstOrCreate([
                    'id_kursus'     => $k->id,
                    'id_instruktur' => $instruktur->id,
                ]);
            }
        }

        // Enroll seed peserta into the program
        $pesertaPengguna = \App\Models\Pengguna::where('role', 'peserta')->first();
        if ($pesertaPengguna) {
            $peserta = Peserta::firstOrCreate(
                ['id_pengguna' => $pesertaPengguna->id],
                ['akses_aktif' => true]
            );
            Pendaftaran::firstOrCreate(
                ['id_peserta' => $peserta->id, 'id_program_microcredential' => $program->id],
                [
                    'status'           => 'diterima',
                    'tanggal_daftar'   => now(),
                    'tanggal_verifikasi' => now(),
                ]
            );
        }
    }
}
