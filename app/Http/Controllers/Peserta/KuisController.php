<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\JawabanKuis;
use App\Models\KunciJawabanEsai;
use App\Http\Controllers\NilaiKursusController;
use App\Models\Kuis;
use App\Models\NilaiKuis;
use App\Models\Pendaftaran;
use App\Models\SesiKuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KuisController extends Controller
{
    private function peserta()
    {
        return Auth::user()->peserta;
    }

    private function getPendaftaran(Kuis $kuis): Pendaftaran
    {
        return Pendaftaran::where('id_peserta', $this->peserta()->id)
            ->where('id_program_microcredential', $kuis->kursus->id_program_microcredential)
            ->where('status', 'diterima')
            ->firstOrFail();
    }

    private function hitungNilaiKuis(SesiKuis $sesi): float
    {
        $sesi->load([
            'kuis.pertanyaanKuis.pilihanJawaban',
            'kuis.pertanyaanKuis.kunciJawabanEsai',
            'jawabanKuis.pilihanJawaban',
            'jawabanKuis.pertanyaanKuis',
        ]);

        $jumlahPg = 0;
        $jumlahEsai = 0;

        $benarPg = 0;
        $benarEsai = 0;

        foreach ($sesi->kuis->pertanyaanKuis as $pertanyaan) {

            $jawaban = $sesi->jawabanKuis
                ->where('id_pertanyaan', $pertanyaan->id)
                ->first();

            if (!$jawaban) {
                continue;
            }

            /*
        |--------------------------------------------------------------------------
        | PILIHAN GANDA
        |--------------------------------------------------------------------------
        */

            if ($pertanyaan->tipe_pertanyaan == 'pilihan_ganda') {

                $jumlahPg++;

                if (
                    $jawaban->pilihanJawaban &&
                    $jawaban->pilihanJawaban->adalah_benar
                ) {
                    $benarPg++;
                }

                continue;
            }

            /*
        |--------------------------------------------------------------------------
        | ESAI
        |--------------------------------------------------------------------------
        */

            $jumlahEsai++;

            $jawabanPeserta = trim($jawaban->teks_jawaban ?? '');

            foreach ($pertanyaan->kunciJawabanEsai as $kunci) {

                $kunciJawaban = trim($kunci->teks_kunci);

                if ($kunci->case_sensitive) {

                    if ($jawabanPeserta === $kunciJawaban) {
                        $benarEsai++;
                        break;
                    }
                } else {

                    if (
                        strtolower($jawabanPeserta)
                        ==
                        strtolower($kunciJawaban)
                    ) {
                        $benarEsai++;
                        break;
                    }
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Hitung Nilai PG
        |--------------------------------------------------------------------------
        */

        $nilaiPg = 0;

        if ($jumlahPg > 0) {
            $nilaiPg = ($benarPg / $jumlahPg) * 100;
        }

        /*
        |--------------------------------------------------------------------------
        | Hitung Nilai Esai
        |--------------------------------------------------------------------------
        */

        $nilaiEsai = 0;

        if ($jumlahEsai > 0) {
            $nilaiEsai = ($benarEsai / $jumlahEsai) * 100;
        }

        /*
        |--------------------------------------------------------------------------
        | Bobot
        |--------------------------------------------------------------------------
        */

        if ($jumlahPg > 0 && $jumlahEsai > 0) {

            return round(
                ($nilaiPg * 0.4) +
                    ($nilaiEsai * 0.6),
                2
            );
        }

        if ($jumlahPg > 0) {
            return round($nilaiPg, 2);
        }

        if ($jumlahEsai > 0) {
            return round($nilaiEsai, 2);
        }

        return 0;
    }

    public function show(Kuis $kuis)
    {
        $kuis->load(['pertanyaanKuis.pilihanJawaban']);
        $pendaftaran = $this->getPendaftaran($kuis);

        $sesiSelesai = SesiKuis::where('id_pendaftaran', $pendaftaran->id)
            ->where('id_kuis', $kuis->id)
            ->where('status', 'selesai')
            ->with('nilaiKuis')
            ->latest('diselesaikan_pada')
            ->first();

        return view('peserta.kuis-mulai', compact('kuis', 'pendaftaran', 'sesiSelesai'));
    }

    public function submit(Request $request, Kuis $kuis)
    {
        $kuis->load(['pertanyaanKuis.pilihanJawaban']);
        $pendaftaran = $this->getPendaftaran($kuis);

        DB::transaction(function () use ($request, $kuis, $pendaftaran) {
            $sesi = SesiKuis::create([
                'id_pendaftaran'    => $pendaftaran->id,
                'id_kuis'           => $kuis->id,
                'status'            => 'selesai',
                'dimulai_pada'      => now(),
                'diselesaikan_pada' => now(),
            ]);

            $totalMc      = 0;
            $benarMc      = 0;
            $adaEsai      = false;

            foreach ($kuis->pertanyaanKuis as $pertanyaan) {

                $fieldName = 'pertanyaan_' . $pertanyaan->id;

                /*
                |--------------------------------------------------------------------------
                | Pilihan Ganda
                |--------------------------------------------------------------------------
                */

                if ($pertanyaan->tipe_pertanyaan == 'pilihan_ganda') {

                    JawabanKuis::create([
                        'id_sesi_kuis'       => $sesi->id,
                        'id_pertanyaan'      => $pertanyaan->id,
                        'id_pilihan_jawaban' => $request->input($fieldName),
                        'teks_jawaban'       => null,
                    ]);

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Esai
                |--------------------------------------------------------------------------
                */

                JawabanKuis::create([
                    'id_sesi_kuis'       => $sesi->id,
                    'id_pertanyaan'      => $pertanyaan->id,
                    'id_pilihan_jawaban' => null,
                    'teks_jawaban'       => trim($request->input($fieldName) ?? ''),
                ]);
            }

            $nilai = $this->hitungNilaiKuis($sesi);

            NilaiKuis::updateOrCreate(
                [
                    'id_sesi_kuis' => $sesi->id
                ],
                [
                    'nilai_mentah' => $nilai,
                    'dihitung_pada' => now(),
                ]
            );

            (new NilaiKursusController())->updateNilaiKursus(
                $pendaftaran->id,
                $kuis->id_kursus
            );
        });

        return redirect()->route('peserta.kuis.show', $kuis->id)
            ->with('success', 'Kuis berhasil dikumpulkan!');
    }
}
