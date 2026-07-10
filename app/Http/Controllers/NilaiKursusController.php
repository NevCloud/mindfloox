<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\NilaiKuis;
use App\Models\NilaiKursus;
use App\Models\NilaiTugas;

class NilaiKursusController extends Controller
{
    public function updateNilaiKursus($idPendaftaran, $idKursus)
    {
        /*
        |--------------------------------------------------------------------------
        | Nilai Kuis
        |--------------------------------------------------------------------------
        */

        $queryKuis = NilaiKuis::whereHas('sesiKuis', function ($query) use ($idPendaftaran, $idKursus) {

            $query->where('id_pendaftaran', $idPendaftaran)
                ->whereHas('kuis', function ($q) use ($idKursus) {

                    $q->where('id_kursus', $idKursus);

                });

        });

        $jumlahKuis = (clone $queryKuis)->count();
        $rataKuis = (clone $queryKuis)->avg('nilai_mentah') ?? 0;

        /*
        |--------------------------------------------------------------------------
        | Nilai Tugas
        |--------------------------------------------------------------------------
        */

        $queryTugas = NilaiTugas::where('id_pendaftaran', $idPendaftaran)
            ->whereHas('tugas', function ($query) use ($idKursus) {

                $query->where('id_kursus', $idKursus);

            });

        $jumlahTugas = (clone $queryTugas)->count();
        $rataTugas = (clone $queryTugas)->avg('nilai_mentah') ?? 0;

        /*
        |--------------------------------------------------------------------------
        | Hitung Nilai Akhir
        |--------------------------------------------------------------------------
        */

        if ($jumlahKuis > 0 && $jumlahTugas > 0) {

            $nilaiAkhir =
                ($rataKuis * 0.40) +
                ($rataTugas * 0.60);

        } elseif ($jumlahKuis > 0) {

            $nilaiAkhir = $rataKuis;

        } elseif ($jumlahTugas > 0) {

            $nilaiAkhir = $rataTugas;

        } else {

            $nilaiAkhir = 0;

        }
        /*
        |--------------------------------------------------------------------------
        | Simpan
        |--------------------------------------------------------------------------
        */

        $nilaiKursus = NilaiKursus::firstOrNew([
            'id_pendaftaran' => $idPendaftaran,
            'id_kursus' => $idKursus,
        ]);

        $nilaiKursus->nilai_akhir = round($nilaiAkhir, 2);
        $nilaiKursus->dihitung_pada = now();


        $nilaiKursus->save();
    }
}
