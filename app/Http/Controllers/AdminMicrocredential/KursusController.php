<?php

namespace App\Http\Controllers\AdminMicrocredential;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\KursusInstruktur;
use App\Models\Minggu;
use App\Models\ProgramMicrocredential;
use App\Models\Instruktur;
use Illuminate\Http\Request;

class KursusController extends Controller
{
    /**
     * Menampilkan daftar kursus dalam suatu program akademik (dengan data instruktur untuk modal).
     */
    public function index($programId)
    {
        $program = ProgramMicrocredential::findOrFail($programId);

        $courses = Kursus::with(['instruktur.pengguna'])
            ->where('id_program_microcredential', $programId)
            ->orderBy('dibuat_pada', 'desc')
            ->get();

        $instructors = Instruktur::with('pengguna')->get();

        return view('admin.kursusIndex', compact('program', 'courses', 'instructors'));
    }

    /**
     * Menyimpan kursus baru (AJAX JSON response).
     */
    public function store(Request $request, $programId)
    {
        $program = ProgramMicrocredential::findOrFail($programId);

        $request->validate([
            'nama'            => 'required|string|max:255',
            'deskripsi'       => 'nullable|string|max:2000',
            'id_instruktur'   => 'nullable|array',
            'id_instruktur.*' => 'exists:instruktur,id',
            'nilai_kelulusan_kursus' => 'nullable|numeric|min:0|max:100',
            'foto_kursus'            => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nama.required'          => 'Nama kursus wajib diisi.',
            'nama.max'               => 'Nama kursus maksimal 255 karakter.',
            'id_instruktur.array'    => 'Data instruktur tidak valid.',
            'id_instruktur.*.exists' => 'Salah satu instruktur tidak valid.',
            'nilai_kelulusan_kursus.numeric' => 'Nilai kelulusan harus berupa angka.',
            'nilai_kelulusan_kursus.min'     => 'Nilai kelulusan minimal 0.',
            'nilai_kelulusan_kursus.max'     => 'Nilai kelulusan maksimal 100.',
            'foto_kursus.required'   => 'Foto kursus wajib diunggah.',
            'foto_kursus.image'      => 'File harus berupa gambar.',
            'foto_kursus.mimes'      => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'foto_kursus.max'        => 'Ukuran gambar maksimal 2MB.',
        ]);

        $fotoPath = 'kursus/default.png';
        if ($request->hasFile('foto_kursus')) {
            $fotoPath = $request->file('foto_kursus')->store('kursus', 'public');
        }

        $kursus = Kursus::create([
            'id_program_microcredential' => $program->id,
            'nama'                       => $request->nama,
            'deskripsi'                  => $request->deskripsi,
            'nilai_kelulusan_kursus'     => $request->nilai_kelulusan_kursus ?? 75.00,
            'foto_kursus'                => $fotoPath,
        ]);

        // Auto-create 14 minggu untuk kursus baru
        for ($i = 1; $i <= 14; $i++) {
            Minggu::create([
                'id_kursus'    => $kursus->id,
                'nomor_minggu' => $i,
                'nama'         => 'Minggu ' . $i,
                'judul'        => null,
                'deskripsi'    => 'Materi minggu ke-' . $i,
                'status'       => $i <= 3 ? 'aktif' : 'nonaktif',
            ]);
        }

        if ($request->id_instruktur) {
            foreach ($request->id_instruktur as $instrukturId) {
                KursusInstruktur::create([
                    'id_kursus'     => $kursus->id,
                    'id_instruktur' => $instrukturId,
                ]);
            }
        }

        session()->flash('success', 'Kursus "' . $kursus->nama . '" berhasil ditambahkan.');

        return response()->json([
            'success' => true,
            'message' => 'Kursus "' . $kursus->nama . '" berhasil ditambahkan.',
        ]);
    }

    /**
     * Memperbarui data kursus (AJAX JSON response).
     */
    public function update(Request $request, $programId, $kursusId)
    {
        $program = ProgramMicrocredential::findOrFail($programId);
        $kursus  = Kursus::findOrFail($kursusId);

        $request->validate([
            'nama'            => 'required|string|max:255',
            'deskripsi'       => 'nullable|string|max:2000',
            'id_instruktur'   => 'nullable|array',
            'id_instruktur.*' => 'exists:instruktur,id',
            'nilai_kelulusan_kursus' => 'nullable|numeric|min:0|max:100',
            'foto_kursus'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nama.required'          => 'Nama kursus wajib diisi.',
            'nama.max'               => 'Nama kursus maksimal 255 karakter.',
            'id_instruktur.array'    => 'Data instruktur tidak valid.',
            'id_instruktur.*.exists' => 'Salah satu instruktur tidak valid.',
            'nilai_kelulusan_kursus.numeric' => 'Nilai kelulusan harus berupa angka.',
            'nilai_kelulusan_kursus.min'     => 'Nilai kelulusan minimal 0.',
            'nilai_kelulusan_kursus.max'     => 'Nilai kelulusan maksimal 100.',
            'foto_kursus.image'      => 'File harus berupa gambar.',
            'foto_kursus.mimes'      => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'foto_kursus.max'        => 'Ukuran gambar maksimal 2MB.',
        ]);

        $updateData = [
            'nama'                       => $request->nama,
            'deskripsi'                  => $request->deskripsi,
            'nilai_kelulusan_kursus'     => $request->nilai_kelulusan_kursus ?? $kursus->nilai_kelulusan_kursus,
        ];

        if ($request->hasFile('foto_kursus')) {
            $updateData['foto_kursus'] = $request->file('foto_kursus')->store('kursus', 'public');
        }

        $kursus->update($updateData);

        try {
            // Sync instruktur: hanya hapus yang tidak ada di list baru
            if ($request->id_instruktur) {
                $kursus->instruktur()->sync($request->id_instruktur);
            } else {
                $kursus->instruktur()->sync([]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // Error 1451: Cannot delete or update a parent row (foreign key constraint fails)
            if ($e->getCode() == '23000') {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengupdate instruktur. Instruktur yang ingin dihapus dari kursus ini masih memiliki data kuis atau tugas yang terhubung. Hapus atau pindahkan data tersebut terlebih dahulu.',
                ], 400);
            }
            throw $e;
        }

        session()->flash('success', 'Kursus "' . $kursus->nama . '" berhasil diperbarui.');

        return response()->json([
            'success' => true,
            'message' => 'Kursus "' . $kursus->nama . '" berhasil diperbarui.',
        ]);
    }

    /**
     * Menghapus kursus dari program akademik (AJAX JSON response).
     */
    public function destroy($programId, $kursusId)
    {
        $kursus = Kursus::findOrFail($kursusId);
        $namaKursus = $kursus->nama;

        try {
            KursusInstruktur::where('id_kursus', $kursus->id)->delete();
            $kursus->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus kursus "' . $namaKursus . '". Kursus ini masih memiliki data kuis, tugas, atau peserta yang terhubung.',
                ], 400);
            }
            throw $e;
        }

        session()->flash('success', 'Kursus "' . $namaKursus . '" berhasil dihapus.');

        return response()->json([
            'success' => true,
            'message' => 'Kursus "' . $namaKursus . '" berhasil dihapus.',
        ]);
    }
}
