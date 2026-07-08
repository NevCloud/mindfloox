<?php

namespace App\Http\Controllers;

use App\Models\SertifikatKursus;

class VerifySertifikatController extends Controller
{
    public function show($nomor)
    {
        $sertifikat = SertifikatKursus::with([
            'pendaftaran.peserta.pengguna',
            'pendaftaran.programMicrocredential',
            'pendaftaran.nilaiKursus.kursus'
        ])
        ->where('nomor_sertifikat', $nomor)
        ->first();

        if (!$sertifikat) {
            return view('verify.sertifikat', [
                'valid' => false
            ]);
        }

        $pendaftaran = $sertifikat->pendaftaran;

        $program = $pendaftaran->programMicrocredential;

        $nilai = $pendaftaran->nilaiKursus;

        $rataRata = round(
            $nilai->avg('nilai_akhir'),
            2
        );

        return view('verify.sertifikat', compact(
            'sertifikat',
            'pendaftaran',
            'program',
            'nilai',
            'rataRata'
        ))->with('valid', true);
    }
}
