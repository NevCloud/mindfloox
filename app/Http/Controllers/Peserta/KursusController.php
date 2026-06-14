<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\JawabanTugas;
use App\Models\Kursus;
use App\Models\MateriPembelajaran;
use App\Models\Minggu;
use App\Models\Kuis;
use App\Models\SesiKuis;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;

class KursusController extends Controller
{
    private function peserta()
    {
        return Auth::user()->peserta;
    }

    private function enrolledProgramIds(): array
    {
        return $this->peserta()
            ->pendaftaran()
            ->where('status', 'diterima')
            ->pluck('id_program_microcredential')
            ->toArray();
    }

    public function index()
    {
        $peserta = $this->peserta();

        $pendaftaran = $peserta->pendaftaran()
            ->where('status', 'diterima')
            ->with(['programMicrocredential.kursus'])
            ->get();

        $kursus = $pendaftaran->flatMap(
            fn($p) => $p->programMicrocredential->kursus
        )->unique('id')->values();

        return view('peserta.kursus', compact('kursus', 'peserta'));
    }

    public function show(Kursus $kursus)
    {
        $peserta = $this->peserta();
        $programIds = $this->enrolledProgramIds();
        abort_unless(in_array($kursus->id_program_microcredential, $programIds), 403);

        $pendaftaran = $peserta->pendaftaran()
            ->where('id_program_microcredential', $kursus->id_program_microcredential)
            ->where('status', 'diterima')
            ->firstOrFail();

        $selesaiKuisIds = SesiKuis::where('id_pendaftaran', $pendaftaran->id)
            ->where('status', 'selesai')
            ->pluck('id_kuis')
            ->flip()->toArray();

        $submittedTugasIds = JawabanTugas::where('id_pendaftaran', $pendaftaran->id)
            ->where('status', 'final')
            ->pluck('id_tugas')
            ->flip()->toArray();

        $mingguIds = MateriPembelajaran::where('id_kursus', $kursus->id)->pluck('id_minggu')
            ->merge(Kuis::where('id_kursus', $kursus->id)->pluck('id_minggu'))
            ->unique()->filter()->values();

        $minggu = Minggu::whereIn('id', $mingguIds)
            ->where('status', 'aktif')
            ->orderBy('nomor_minggu')
            ->with([
                'materiPembelajaran' => fn($q) => $q->where('id_kursus', $kursus->id)->orderBy('nomor_urut'),
                'kuis'               => fn($q) => $q->where('id_kursus', $kursus->id),
            ])
            ->get();

        $tugas = Tugas::where('id_kursus', $kursus->id)->orderBy('dibuat_pada')->get();

        $weeksJs = $minggu->map(function (Minggu $m) use ($selesaiKuisIds) {
            $items = [];

            foreach ($m->materiPembelajaran as $materi) {
                $items[] = [
                    'id'       => 'materi-' . $materi->id,
                    'dbId'     => $materi->id,
                    'tipe'     => $materi->tipe ?? 'dokumen',
                    'judul'    => $materi->judul,
                    'deskripsi'=> $materi->deskripsi,
                    'url_file' => $materi->url_file
                        ? (str_starts_with($materi->url_file, 'http')
                            ? $materi->url_file
                            : asset('storage/' . $materi->url_file))
                        : null,
                    'nomor_urut' => $materi->nomor_urut,
                ];
            }

            foreach ($m->kuis as $k) {
                $items[] = [
                    'id'        => 'kuis-' . $k->id,
                    'dbId'      => $k->id,
                    'tipe'      => 'kuis',
                    'judul'     => $k->judul,
                    'deskripsi' => $k->deskripsi,
                    'url_file'  => null,
                    'durasi'    => $k->batas_waktu_menit,
                    'nomor_urut'=> 9999,
                    'selesai'   => isset($selesaiKuisIds[$k->id]),
                ];
            }

            usort($items, fn($a, $b) => $a['nomor_urut'] <=> $b['nomor_urut']);

            return [
                'id'    => $m->id,
                'nomor' => $m->nomor_minggu,
                'open'  => $m->nomor_minggu === 1,
                'items' => array_values($items),
            ];
        })->values();

        $tugasJs = $tugas->map(fn(Tugas $t) => [
            'id'          => $t->id,
            'judul'       => $t->judul,
            'deskripsi'   => $t->deskripsi,
            'nilai'       => $t->nilai,
            'batas_waktu' => $t->batas_waktu?->format('d M Y H:i'),
            'dikumpulkan' => isset($submittedTugasIds[$t->id]),
        ])->values();

        return view('peserta.detail-kursus', compact('kursus', 'weeksJs', 'tugasJs'));
    }
}
