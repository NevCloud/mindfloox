<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\Kuis;
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

        $tugasList = Tugas::whereIn('id_kursus_instruktur', $kiIds)
            ->with('kursus')
            ->withCount([
                'jawabanTugas',
                'nilaiTugas as dinilai_count',
            ])
            ->latest('dibuat_pada')
            ->paginate(20);

        return view('instruktur.tugas', compact('tugasList'));
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

    public function tugasWorkspace(Tugas $tugas, Request $request)
    {
        $kiIds = $this->kursusInstrukturIds();
        abort_unless(in_array($tugas->id_kursus_instruktur, $kiIds), 403);

        $tugas->load('kursus.programMicrocredential');
        $programId = $tugas->kursus->id_program_microcredential;

        // Ambil semua pendaftaran di program ini
        $pendaftaranList = \App\Models\Pendaftaran::where('id_program_microcredential', $programId)
            ->where('status', 'diterima')
            ->with([
                'peserta.pengguna',
                'jawabanTugas' => fn($q) => $q->where('id_tugas', $tugas->id),
                'nilaiTugas' => fn($q) => $q->where('id_tugas', $tugas->id)
            ])
            ->paginate(10);

        $selectedPendaftaran = null;
        $jawabanTugas = null;
        $nilaiTugas = null;

        if ($request->filled('pendaftaran_id')) {
            $selectedPendaftaran = \App\Models\Pendaftaran::with([
                'peserta.pengguna',
                'jawabanTugas' => fn($q) => $q->where('id_tugas', $tugas->id),
                'nilaiTugas' => fn($q) => $q->where('id_tugas', $tugas->id)
            ])->find($request->pendaftaran_id);

            if ($selectedPendaftaran) {
                $jawabanTugas = $selectedPendaftaran->jawabanTugas->first();
                $nilaiTugas = $selectedPendaftaran->nilaiTugas->first();
            }
        }

        return view('instruktur.workspace-tugas', compact('tugas', 'pendaftaranList', 'selectedPendaftaran', 'jawabanTugas', 'nilaiTugas'));
    }

    public function storeNilaiWorkspaceTugas(Request $request, Tugas $tugas, \App\Models\Pendaftaran $pendaftaran)
    {
        $request->validate(['nilai' => 'required|numeric|min:0|max:100']);

        $kiIds = $this->kursusInstrukturIds();
        abort_unless(in_array($tugas->id_kursus_instruktur, $kiIds), 403);

        NilaiTugas::updateOrCreate(
            [
                'id_pendaftaran' => $pendaftaran->id,
                'id_tugas'       => $tugas->id,
            ],
            [
                'nilai_mentah'  => $request->nilai,
                'dinilai_oleh'  => $this->instruktur()->id,
                'dinilai_pada'  => now(),
            ]
        );

        // Langsung redirect kembali ke workspace dengan peserta tersebut terpilih, membawa session success
        return redirect()->route('instruktur.evaluasi.tugas.workspace', ['tugas' => $tugas->id, 'pendaftaran_id' => $pendaftaran->id])
            ->with('success', 'Nilai berhasil disimpan!');
    }

    // ─── Kuis ─────────────────────────────────────────────────────────────────

    public function kuisList()
    {
        $kiIds = $this->kursusInstrukturIds();

        $kuisList = Kuis::whereIn('id_kursus_instruktur', $kiIds)
            ->with('kursus')
            ->withCount([
                'sesiKuis',
                'sesiKuis as dinilai_count' => fn($q) => $q->whereHas('nilaiKuis'),
            ])
            ->latest('dibuat_pada')
            ->paginate(20);

        return view('instruktur.kuis-list', compact('kuisList'));
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

    public function kuisWorkspace(Kuis $kuis, Request $request)
    {
        $kiIds = $this->kursusInstrukturIds();
        abort_unless(in_array($kuis->id_kursus_instruktur, $kiIds), 403);

        $kuis->load('kursus.programMicrocredential', 'pertanyaanKuis.pilihanJawaban', 'pertanyaanKuis.kunciJawabanEsai');
        $programId = $kuis->kursus->id_program_microcredential;

        $pendaftaranList = \App\Models\Pendaftaran::where('id_program_microcredential', $programId)
            ->where('status', 'diterima')
            ->with([
                'peserta.pengguna',
                'sesiKuis' => fn($q) => $q->where('id_kuis', $kuis->id)->with('nilaiKuis')
            ])
            ->paginate(10);

        $selectedPendaftaran = null;
        $sesiKuis = null;

        if ($request->filled('pendaftaran_id')) {
            $selectedPendaftaran = \App\Models\Pendaftaran::with([
                'peserta.pengguna',
                'sesiKuis' => fn($q) => $q->where('id_kuis', $kuis->id)->with([
                    'jawabanKuis.pertanyaanKuis',
                    'jawabanKuis.pilihanJawaban',
                    'nilaiKuis'
                ])
            ])->find($request->pendaftaran_id);

            if ($selectedPendaftaran) {
                $sesiKuis = $selectedPendaftaran->sesiKuis->first();
            }
        }

        return view('instruktur.workspace-kuis', compact('kuis', 'pendaftaranList', 'selectedPendaftaran', 'sesiKuis'));
    }

    public function storeNilaiWorkspaceKuis(Request $request, Kuis $kuis, \App\Models\Pendaftaran $pendaftaran)
    {
        $request->validate(['nilai' => 'required|numeric|min:0|max:100']);

        $kiIds = $this->kursusInstrukturIds();
        abort_unless(in_array($kuis->id_kursus_instruktur, $kiIds), 403);

        $sesiKuis = SesiKuis::where('id_kuis', $kuis->id)->where('id_pendaftaran', $pendaftaran->id)->firstOrFail();

        NilaiKuis::updateOrCreate(
            ['id_sesi_kuis' => $sesiKuis->id],
            ['nilai_mentah' => $request->nilai, 'dihitung_pada' => now()]
        );

        return redirect()->route('instruktur.evaluasi.kuis.workspace', ['kuis' => $kuis->id, 'pendaftaran_id' => $pendaftaran->id])
            ->with('success', 'Nilai berhasil disimpan!');
    }
}
