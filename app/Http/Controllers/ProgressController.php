<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use App\Models\Tugas;
use App\Models\Minggu;
use App\Models\SesiKuis;
use App\Models\Pendaftaran;
use App\Models\MateriDilihat;
use App\Models\JawabanTugas;
use App\Models\MateriPembelajaran;

class ProgressController extends Controller
{
    public function hitungProgress($idPeserta, $idKursus)
    {
        $pendaftaran = Pendaftaran::where('id_peserta', $idPeserta)
            ->whereHas('programMicrocredential.kursus', function ($q) use ($idKursus) {
                $q->where('id', $idKursus);
            })
            ->first();

        if (!$pendaftaran) {
            return 0;
        }

        $weeks = Minggu::where('id_kursus', $idKursus)->get();

        $totalWeeks = $weeks->count();

        if ($totalWeeks == 0) {
            return 0;
        }

        $materiDilihat = MateriDilihat::where('id_pendaftaran', $pendaftaran->id)
            ->pluck('id_materi_pembelajaran')
            ->toArray();

        $tugasSelesai = JawabanTugas::where('id_pendaftaran', $pendaftaran->id)
            ->where('status', 'final')
            ->pluck('id_tugas')
            ->toArray();

        $kuisSelesai = SesiKuis::where('id_pendaftaran', $pendaftaran->id)
            ->where('status', 'selesai')
            ->pluck('id_kuis')
            ->toArray();

        $completedWeeks = 0;

        foreach ($weeks as $week) {

            $materi = MateriPembelajaran::where('id_kursus', $idKursus)
                ->where('id_minggu', $week->id)
                ->pluck('id')
                ->toArray();

            $tugas = Tugas::where('id_kursus', $idKursus)
                ->where('id_minggu', $week->id)
                ->pluck('id')
                ->toArray();

            $kuis = Kuis::where('id_kursus', $idKursus)
                ->where('id_minggu', $week->id)
                ->pluck('id')
                ->toArray();

            $materiSelesai = empty($materi) || empty(array_diff($materi, $materiDilihat));

            $tugasSelesaiSemua = empty($tugas) || empty(array_diff($tugas, $tugasSelesai));

            $kuisSelesaiSemua = empty($kuis) || empty(array_diff($kuis, $kuisSelesai));

            if ($materiSelesai && $tugasSelesaiSemua && $kuisSelesaiSemua) {
                $completedWeeks++;
            }
        }

        return round(($completedWeeks / $totalWeeks) * 100);
    }
}
