<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\JawabanKuis;
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

                if ($pertanyaan->tipe_pertanyaan === 'pilihan_ganda') {
                    $totalMc++;
                    $pilihanId = $request->input($fieldName);
                    $pilihan   = $pertanyaan->pilihanJawaban->find($pilihanId);

                    JawabanKuis::create([
                        'id_sesi_kuis'       => $sesi->id,
                        'id_pertanyaan'      => $pertanyaan->id,
                        'id_pilihan_jawaban' => $pilihanId,
                        'teks_jawaban'       => null,
                    ]);

                    if ($pilihan && $pilihan->adalah_benar) {
                        $benarMc++;
                    }
                } else {
                    $adaEsai = true;
                    JawabanKuis::create([
                        'id_sesi_kuis'       => $sesi->id,
                        'id_pertanyaan'      => $pertanyaan->id,
                        'id_pilihan_jawaban' => null,
                        'teks_jawaban'       => $request->input($fieldName),
                    ]);
                }
            }

            // Auto-grade if no esai questions
            if (!$adaEsai && $totalMc > 0) {
                $nilaiMentah = round(($benarMc / $totalMc) * ($kuis->nilai ?? 100), 2);
                NilaiKuis::create([
                    'id_sesi_kuis'  => $sesi->id,
                    'nilai_mentah'  => $nilaiMentah,
                    'dihitung_pada' => now(),
                ]);
            }
        });

        return redirect()->route('peserta.kuis.show', $kuis->id)
            ->with('success', 'Kuis berhasil dikumpulkan!');
    }
}
