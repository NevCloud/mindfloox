<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\JawabanTugas;
use App\Models\Kursus;
use App\Models\MateriDilihat;
use App\Models\MateriPembelajaran;
use App\Models\Minggu;
use App\Models\Kuis;
use App\Models\SesiKuis;
use App\Models\Tugas;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

        // Kuis selesai
        $selesaiKuisIds = SesiKuis::where('id_pendaftaran', $pendaftaran->id)
            ->where('status', 'selesai')
            ->pluck('id_kuis')
            ->flip()->toArray();

        // Tugas yang sudah dikumpulkan (final)
        $submittedTugasIds = JawabanTugas::where('id_pendaftaran', $pendaftaran->id)
            ->where('status', 'final')
            ->pluck('id_tugas')
            ->flip()->toArray();

        // Materi yang sudah dilihat
        $dilihatMateriIds = MateriDilihat::where('id_pendaftaran', $pendaftaran->id)
            ->pluck('id_materi_pembelajaran')
            ->flip()->toArray();

        // Load ALL active weeks for this course
        $minggu = Minggu::where('id_kursus', $kursus->id)
            ->where('status', 'aktif')
            ->orderBy('nomor_minggu')
            ->with([
                'materiPembelajaran' => fn($q) => $q->where('id_kursus', $kursus->id)->orderBy('nomor_urut'),
                'kuis'               => fn($q) => $q->where('id_kursus', $kursus->id),
                'tugas'              => fn($q) => $q->where('id_kursus', $kursus->id),
            ])
            ->get();

        $weeksJs = $minggu->map(function (Minggu $m) use ($selesaiKuisIds, $submittedTugasIds, $dilihatMateriIds) {
            $items = [];

            // Materi
            foreach ($m->materiPembelajaran as $materi) {
                $items[] = [
                    'id'         => 'materi-' . $materi->id,
                    'dbId'       => $materi->id,
                    'tipe'       => $materi->tipe ?? 'dokumen',
                    'tipe_materi' => $materi->tipe ?? 'dokumen',
                    'judul'      => $materi->judul,
                    'deskripsi'  => $materi->deskripsi,
                    'url_file'   => $materi->url_file
                        ? (str_starts_with($materi->url_file, 'http')
                            ? $materi->url_file
                            : asset('storage/' . $materi->url_file))
                        : null,
                    'nomor_urut' => $materi->nomor_urut,
                    'dilihat'    => isset($dilihatMateriIds[$materi->id]),
                ];
            }

            // Tugas
            foreach ($m->tugas as $t) {
                $items[] = [
                    'id'          => 'tugas-' . $t->id,
                    'dbId'        => $t->id,
                    'tipe'        => 'tugas',
                    'tipe_materi' => 'tugas',
                    'judul'       => $t->judul,
                    'deskripsi'   => $t->deskripsi,
                    'url_file'    => null,
                    'nomor_urut'  => $t->nomor_urut ?? 999,
                    'meta1'       => $t->batas_waktu ? 'Tenggat: ' . $t->batas_waktu->format('d M Y, H:i') : null,
                    'is_overdue'  => $t->batas_waktu ? $t->batas_waktu->isPast() : false,
                    'dikumpulkan' => isset($submittedTugasIds[$t->id]),
                    'tugas_url'   => route('peserta.tugas.show', $t->id),
                ];
            }

            // Kuis
            foreach ($m->kuis as $k) {
                $items[] = [
                    'id'         => 'kuis-' . $k->id,
                    'dbId'       => $k->id,
                    'tipe'       => 'kuis',
                    'tipe_materi' => 'kuis',
                    'judul'      => $k->judul,
                    'deskripsi'  => $k->deskripsi,
                    'url_file'   => null,
                    'durasi'     => $k->batas_waktu_menit,
                    'nomor_urut' => $k->nomor_urut ?? 9999,
                    'meta1'       => $k->batas_waktu ? 'Tenggat: ' . $k->batas_waktu->format('d M Y, H:i') : null,
                    'is_overdue'  => $k->batas_waktu ? $k->batas_waktu->isPast() : false,
                    'selesai'    => isset($selesaiKuisIds[$k->id]),
                ];
            }

            usort($items, fn($a, $b) => $a['nomor_urut'] <=> $b['nomor_urut']);

            return [
                'id'        => $m->id,
                'nomor'     => $m->nomor_minggu,
                'judul'     => $m->judul,
                'deskripsi' => $m->deskripsi,
                'open'      => $m->nomor_minggu === 1,
                'items'     => array_values($items),
            ];
        })->values();

        return view('peserta.detail-kursus', compact('kursus', 'weeksJs'));
    }

    /**
     * Mark a materi as viewed by the current peserta.
     */
    public function markMateriViewed(Request $request, Kursus $kursus, MateriPembelajaran $materi): JsonResponse
    {
        $peserta = $this->peserta();

        $pendaftaran = $peserta->pendaftaran()
            ->where('id_program_microcredential', $kursus->id_program_microcredential)
            ->where('status', 'diterima')
            ->firstOrFail();

        // Ensure materi belongs to this kursus
        abort_unless($materi->id_kursus === $kursus->id, 403);

        MateriDilihat::updateOrCreate(
            [
                'id_pendaftaran'         => $pendaftaran->id,
                'id_materi_pembelajaran' => $materi->id,
            ],
            [
                'dilihat_pada' => now(),
            ]
        );

        return response()->json(['status' => 'ok']);
    }
}
