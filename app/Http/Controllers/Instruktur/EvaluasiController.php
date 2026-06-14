<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\JawabanTugas;
use App\Models\Kursus;
use App\Models\KursusInstruktur;
use App\Models\NilaiKuis;
use App\Models\NilaiTugas;
use App\Models\SesiKuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluasiController extends Controller
{
    private function instruktur()
    {
        return Auth::user()->instruktur;
    }

    private function kursusInstrukturIds(): array
    {
        return KursusInstruktur::where('id_instruktur', $this->instruktur()->id)
            ->pluck('id')
            ->toArray();
    }

    // ─── Tugas ────────────────────────────────────────────────────────────────

    public function tugasList()
    {
        $kiIds = $this->kursusInstrukturIds();

        $jawaban = JawabanTugas::whereHas('tugas', fn($q) => $q->whereIn('id_kursus_instruktur', $kiIds))
            ->with([
                'tugas.kursus',
                'pendaftaran.peserta.pengguna',
                'pendaftaran.nilaiTugas' => fn($q) => $q->whereIn('id_tugas',
                    JawabanTugas::whereHas('tugas', fn($q2) => $q2->whereIn('id_kursus_instruktur', $kiIds))
                        ->pluck('id_tugas')
                ),
            ])
            ->latest('disubmit_pada')
            ->paginate(20);

        return view('instruktur.tugas', compact('jawaban'));
    }

    public function tugasDetail(JawabanTugas $jawabanTugas)
    {
        $kiIds = $this->kursusInstrukturIds();
        abort_unless(
            in_array($jawabanTugas->tugas->id_kursus_instruktur, $kiIds),
            403
        );

        $jawabanTugas->load([
            'tugas.kursus',
            'pendaftaran.peserta.pengguna',
        ]);

        $nilaiTugas = NilaiTugas::where('id_pendaftaran', $jawabanTugas->id_pendaftaran)
            ->where('id_tugas', $jawabanTugas->id_tugas)
            ->first();

        return view('instruktur.tugas-detail', compact('jawabanTugas', 'nilaiTugas'));
    }

    public function storeNilaiTugas(Request $request, JawabanTugas $jawabanTugas)
    {
        $request->validate(['nilai' => 'required|numeric|min:0|max:100']);

        $kiIds = $this->kursusInstrukturIds();
        abort_unless(
            in_array($jawabanTugas->tugas->id_kursus_instruktur, $kiIds),
            403
        );

        NilaiTugas::updateOrCreate(
            [
                'id_pendaftaran' => $jawabanTugas->id_pendaftaran,
                'id_tugas'       => $jawabanTugas->id_tugas,
            ],
            [
                'nilai_mentah'  => $request->nilai,
                'dinilai_oleh'  => $this->instruktur()->id,
                'dinilai_pada'  => now(),
            ]
        );

        return redirect()->route('instruktur.evaluasi.tugas.detail', $jawabanTugas->id)
            ->with('success', 'Nilai berhasil disimpan.');
    }

    // ─── Kuis ─────────────────────────────────────────────────────────────────

    public function kuisList()
    {
        $kiIds = $this->kursusInstrukturIds();

        $sesiList = SesiKuis::whereHas('kuis', fn($q) => $q->whereIn('id_kursus_instruktur', $kiIds))
            ->where('status', 'selesai')
            ->with([
                'kuis.kursus',
                'pendaftaran.peserta.pengguna',
                'nilaiKuis',
            ])
            ->latest('diselesaikan_pada')
            ->paginate(20);

        return view('instruktur.kuis-list', compact('sesiList'));
    }

    public function kuisDetail(SesiKuis $sesiKuis)
    {
        $kiIds = $this->kursusInstrukturIds();
        abort_unless(
            in_array($sesiKuis->kuis->id_kursus_instruktur, $kiIds),
            403
        );

        $sesiKuis->load([
            'kuis.pertanyaanKuis.pilihanJawaban',
            'pendaftaran.peserta.pengguna',
            'jawabanKuis.pertanyaanKuis',
            'jawabanKuis.pilihanJawaban',
            'nilaiKuis',
        ]);

        return view('instruktur.kuis-detail', compact('sesiKuis'));
    }

    public function storeNilaiKuis(Request $request, SesiKuis $sesiKuis)
    {
        $request->validate(['nilai' => 'required|numeric|min:0|max:100']);

        $kiIds = $this->kursusInstrukturIds();
        abort_unless(
            in_array($sesiKuis->kuis->id_kursus_instruktur, $kiIds),
            403
        );

        NilaiKuis::updateOrCreate(
            ['id_sesi_kuis' => $sesiKuis->id],
            ['nilai_mentah' => $request->nilai, 'dihitung_pada' => now()]
        );

        return redirect()->route('instruktur.evaluasi.kuis.detail', $sesiKuis->id)
            ->with('success', 'Nilai berhasil disimpan.');
    }
}
