<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SertifikatKursus;
use App\Models\Pendaftaran;
use App\Models\NilaiKursus;

class SertifikatController extends Controller
{
    public function show($id)
    {
        $user = Auth::user();

        $pendaftaran = Pendaftaran::with([
            'programMicrocredential.semester',
            'peserta.pengguna'
        ])->findOrFail($id);

        abort_if(
            $pendaftaran->id_peserta != $user->peserta->id,
            403
        );

        $sertifikat = SertifikatKursus::firstOrCreate(
            [
                'id_pendaftaran' => $pendaftaran->id,
            ],
            [
                'nomor_sertifikat' => 'MC-' . date('Y') . '-' . str_pad($pendaftaran->id, 5, '0', STR_PAD_LEFT),
                'tanggal_terbit' => now(),
            ]
        );

        $program = $pendaftaran->programMicrocredential;

        $nilai = NilaiKursus::with('kursus')
            ->where('id_pendaftaran', $pendaftaran->id)
            ->get();

        $rataRata = round($nilai->avg('nilai_akhir'), 2);

        return view(
            'peserta.sertifikat',
            compact(
                'pendaftaran',
                'program',
                'nilai',
                'rataRata',
                'sertifikat'
            )
        );
    }
}
