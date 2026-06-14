<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\KursusInstruktur;
use App\Models\MateriPembelajaran;
use App\Models\Minggu;
use App\Models\Tugas;
use App\Models\Kuis;
use App\Models\JawabanKuis;
use App\Models\PertanyaanKuis;
use App\Models\PilihanJawaban;
use App\Models\KunciJawabanEsai;
use App\Models\SesiKuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KontenController extends Controller
{
    private function instruktur()
    {
        return Auth::user()->instruktur;
    }

    private function getKursusInstruktur(Kursus $kursus): KursusInstruktur
    {
        return KursusInstruktur::where([
            'id_kursus'     => $kursus->id,
            'id_instruktur' => $this->instruktur()->id,
        ])->firstOrFail();
    }

    private function getOrCreateMinggu(int $nomorMinggu): Minggu
    {
        return Minggu::firstOrCreate(
            ['nomor_minggu' => $nomorMinggu],
            ['status' => 'aktif']
        );
    }

    public function create(Kursus $kursus)
    {
        $kursusInstruktur = $this->getKursusInstruktur($kursus);

        return view('instruktur.upload-materi', [
            'kursus'           => $kursus,
            'kursusInstruktur' => $kursusInstruktur,
            'item'             => null,
            'tipe'             => request('tipe'),
            'mingguList'       => range(1, 16),
        ]);
    }

    public function store(Request $request, Kursus $kursus)
    {
        $kursusInstruktur = $this->getKursusInstruktur($kursus);

        $request->validate([
            'tipe_materi' => 'required|in:dokumen,video,tautan,tugas,kuis',
        ]);

        return match ($request->tipe_materi) {
            'tugas' => $this->storeTugas($request, $kursus, $kursusInstruktur),
            'kuis'  => $this->storeKuis($request, $kursus, $kursusInstruktur),
            default => $this->storeMateri($request, $kursus, $kursusInstruktur, $request->tipe_materi),
        };
    }

    private function storeMateri(Request $request, Kursus $kursus, KursusInstruktur $ki, string $tipe)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'minggu_ke' => 'required|integer|min:1|max:52',
            'url_file'  => 'nullable|url|max:500',
            'file'      => 'nullable|file|max:51200',
        ], [
            'judul.required'     => 'Judul materi wajib diisi.',
            'minggu_ke.required' => 'Minggu wajib dipilih.',
        ]);

        $minggu  = $this->getOrCreateMinggu((int) $request->minggu_ke);
        $urlFile = null;

        if ($request->hasFile('file')) {
            $urlFile = $request->file('file')->store('materi', 'public');
        } elseif ($request->filled('url_file')) {
            $urlFile = $request->url_file;
        }

        $nomor = (MateriPembelajaran::where('id_kursus', $kursus->id)
            ->where('id_minggu', $minggu->id)
            ->max('nomor_urut') ?? 0) + 1;

        MateriPembelajaran::create([
            'id_kursus'            => $kursus->id,
            'id_kursus_instruktur' => $ki->id,
            'id_minggu'            => $minggu->id,
            'judul'                => $request->judul,
            'nomor_urut'           => $nomor,
            'tipe'                 => $tipe,
            'url_file'             => $urlFile,
        ]);

        return redirect()->route('instruktur.kursus.show', $kursus)
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    private function storeTugas(Request $request, Kursus $kursus, KursusInstruktur $ki)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'nilai'       => 'required|numeric|min:0|max:100',
            'batas_waktu' => 'nullable|date',
        ], [
            'judul.required' => 'Judul tugas wajib diisi.',
            'nilai.required' => 'Bobot nilai wajib diisi.',
        ]);

        Tugas::create([
            'id_kursus'            => $kursus->id,
            'id_kursus_instruktur' => $ki->id,
            'judul'                => $request->judul,
            'deskripsi'            => $request->deskripsi,
            'nilai'                => $request->nilai,
            'batas_waktu'          => $request->batas_waktu,
        ]);

        return redirect()->route('instruktur.kursus.show', $kursus)
            ->with('success', 'Tugas berhasil ditambahkan.');
    }

    private function storeKuis(Request $request, Kursus $kursus, KursusInstruktur $ki)
    {
        $request->validate([
            'judul'             => 'required|string|max:255',
            'nilai'             => 'required|numeric|min:0|max:100',
            'minggu_ke'         => 'required|integer|min:1|max:52',
            'batas_waktu_menit' => 'nullable|integer|min:1|max:300',
            'questions_json'    => 'required|string',
        ], [
            'judul.required'          => 'Judul kuis wajib diisi.',
            'nilai.required'          => 'Bobot nilai wajib diisi.',
            'minggu_ke.required'      => 'Minggu wajib dipilih.',
            'questions_json.required' => 'Kuis harus memiliki minimal 1 pertanyaan.',
        ]);

        $questions = json_decode($request->questions_json, true);
        if (empty($questions)) {
            return back()->withErrors(['questions_json' => 'Format pertanyaan tidak valid.'])->withInput();
        }

        DB::transaction(function () use ($request, $kursus, $ki, $questions) {
            $minggu = $this->getOrCreateMinggu((int) $request->minggu_ke);

            $kuis = Kuis::create([
                'id_kursus'            => $kursus->id,
                'id_kursus_instruktur' => $ki->id,
                'id_minggu'            => $minggu->id,
                'judul'                => $request->judul,
                'deskripsi'            => $request->deskripsi,
                'nilai'                => $request->nilai,
                'batas_waktu_menit'    => $request->batas_waktu_menit,
            ]);

            $this->syncPertanyaan($kuis, $questions);
        });

        return redirect()->route('instruktur.kursus.show', $kursus)
            ->with('success', 'Kuis berhasil ditambahkan.');
    }

    private function syncPertanyaan(Kuis $kuis, array $questions): void
    {
        foreach ($questions as $q) {
            $tipe = $q['tipe_pertanyaan'] === 'essay' ? 'esai' : ($q['tipe_pertanyaan'] ?? 'pilihan_ganda');

            $pertanyaan = PertanyaanKuis::create([
                'id_kuis'         => $kuis->id,
                'teks_pertanyaan' => $q['question'] ?? $q['teks_pertanyaan'] ?? '',
                'tipe_pertanyaan' => $tipe,
            ]);

            if ($tipe === 'pilihan_ganda') {
                $options = $q['options'] ?? [];
                $benar   = $q['answer'] ?? null;

                foreach ($options as $key => $teks) {
                    if (empty($teks)) continue;
                    PilihanJawaban::create([
                        'id_pertanyaan' => $pertanyaan->id,
                        'teks_pilihan'  => $teks,
                        'adalah_benar'  => ($benar === $key),
                    ]);
                }
            } elseif ($tipe === 'esai' && !empty($q['answer'])) {
                KunciJawabanEsai::create([
                    'id_pertanyaan' => $pertanyaan->id,
                    'teks_kunci'    => $q['answer'],
                    'case_sensitive'=> false,
                ]);
            }
        }
    }

    public function edit(Kursus $kursus, string $tipe, int $id)
    {
        $kursusInstruktur = $this->getKursusInstruktur($kursus);
        $item = null;

        switch ($tipe) {
            case 'materi':
                $item = MateriPembelajaran::where('id_kursus', $kursus->id)->findOrFail($id);
                break;
            case 'tugas':
                $item = Tugas::where('id_kursus', $kursus->id)->findOrFail($id);
                break;
            case 'kuis':
                $item = Kuis::where('id_kursus', $kursus->id)
                    ->with(['pertanyaanKuis.pilihanJawaban', 'pertanyaanKuis.kunciJawabanEsai'])
                    ->findOrFail($id);
                break;
            default:
                abort(404);
        }

        return view('instruktur.upload-materi', [
            'kursus'           => $kursus,
            'kursusInstruktur' => $kursusInstruktur,
            'item'             => $item,
            'tipe'             => $tipe,
            'mingguList'       => range(1, 16),
        ]);
    }

    public function update(Request $request, Kursus $kursus, string $tipe, int $id)
    {
        $this->getKursusInstruktur($kursus);

        switch ($tipe) {
            case 'materi':
                $request->validate([
                    'judul'     => 'required|string|max:255',
                    'minggu_ke' => 'required|integer|min:1|max:52',
                    'url_file'  => 'nullable|url|max:500',
                    'file'      => 'nullable|file|max:51200',
                ]);

                $materi = MateriPembelajaran::where('id_kursus', $kursus->id)->findOrFail($id);
                $minggu = $this->getOrCreateMinggu((int) $request->minggu_ke);

                $data = ['id_minggu' => $minggu->id, 'judul' => $request->judul];

                if ($request->hasFile('file')) {
                    if ($materi->url_file && !str_starts_with($materi->url_file, 'http')) {
                        Storage::disk('public')->delete($materi->url_file);
                    }
                    $data['url_file'] = $request->file('file')->store('materi', 'public');
                } elseif ($request->filled('url_file')) {
                    $data['url_file'] = $request->url_file;
                }

                $materi->update($data);
                break;

            case 'tugas':
                $request->validate([
                    'judul'       => 'required|string|max:255',
                    'deskripsi'   => 'nullable|string',
                    'nilai'       => 'required|numeric|min:0|max:100',
                    'batas_waktu' => 'nullable|date',
                ]);

                Tugas::where('id_kursus', $kursus->id)->findOrFail($id)->update([
                    'judul'       => $request->judul,
                    'deskripsi'   => $request->deskripsi,
                    'nilai'       => $request->nilai,
                    'batas_waktu' => $request->batas_waktu,
                ]);
                break;

            case 'kuis':
                $request->validate([
                    'judul'             => 'required|string|max:255',
                    'nilai'             => 'required|numeric|min:0|max:100',
                    'minggu_ke'         => 'required|integer|min:1|max:52',
                    'batas_waktu_menit' => 'nullable|integer|min:1|max:300',
                    'questions_json'    => 'required|string',
                ]);

                $questions = json_decode($request->questions_json, true);
                if (empty($questions)) {
                    return back()->withErrors(['questions_json' => 'Format pertanyaan tidak valid.'])->withInput();
                }

                DB::transaction(function () use ($request, $kursus, $id, $questions) {
                    $kuis   = Kuis::where('id_kursus', $kursus->id)->with('pertanyaanKuis.pilihanJawaban', 'pertanyaanKuis.kunciJawabanEsai')->findOrFail($id);
                    $minggu = $this->getOrCreateMinggu((int) $request->minggu_ke);

                    $kuis->update([
                        'id_minggu'         => $minggu->id,
                        'judul'             => $request->judul,
                        'deskripsi'         => $request->deskripsi,
                        'nilai'             => $request->nilai,
                        'batas_waktu_menit' => $request->batas_waktu_menit,
                    ]);

                    foreach ($kuis->pertanyaanKuis as $p) {
                        JawabanKuis::where('id_pertanyaan', $p->id)->delete();
                        $p->pilihanJawaban()->delete();
                        $p->kunciJawabanEsai()->delete();
                        $p->delete();
                    }

                    $this->syncPertanyaan($kuis, $questions);
                });
                break;

            default:
                abort(404);
        }

        return redirect()->route('instruktur.kursus.show', $kursus)
            ->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy(Kursus $kursus, string $tipe, int $id)
    {
        $this->getKursusInstruktur($kursus);

        switch ($tipe) {
            case 'materi':
                $item = MateriPembelajaran::where('id_kursus', $kursus->id)->findOrFail($id);
                if ($item->url_file && !str_starts_with($item->url_file, 'http')) {
                    Storage::disk('public')->delete($item->url_file);
                }
                $item->delete();
                break;

            case 'tugas':
                Tugas::where('id_kursus', $kursus->id)->findOrFail($id)->delete();
                break;

            case 'kuis':
                $kuis = Kuis::where('id_kursus', $kursus->id)
                    ->with('pertanyaanKuis.pilihanJawaban', 'pertanyaanKuis.kunciJawabanEsai')
                    ->findOrFail($id);
                foreach ($kuis->pertanyaanKuis as $p) {
                    JawabanKuis::where('id_pertanyaan', $p->id)->delete();
                    $p->pilihanJawaban()->delete();
                    $p->kunciJawabanEsai()->delete();
                    $p->delete();
                }
                SesiKuis::where('id_kuis', $kuis->id)->delete();
                $kuis->delete();
                break;

            default:
                abort(404);
        }

        return back()->with('success', 'Konten berhasil dihapus.');
    }

    public function toggleMinggu(Kursus $kursus, Minggu $minggu)
    {
        $this->getKursusInstruktur($kursus);

        $minggu->update([
            'status' => $minggu->status === 'aktif' ? 'nonaktif' : 'aktif',
        ]);

        return back()->with('success', 'Status minggu diperbarui.');
    }
}
