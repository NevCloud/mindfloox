<?php

namespace App\Http\Controllers\AdminMicrocredential;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\KursusInstruktur;
use App\Models\ProgramMicrocredential;
use App\Models\Instruktur;
use Illuminate\Http\Request;

class KursusController extends Controller
{
    /**
     * Menampilkan daftar kursus dalam suatu program akademik.
     */
    public function index($programId)
    {
        $program = ProgramMicrocredential::findOrFail($programId);

        $courses = Kursus::with(['instruktur.pengguna'])
            ->where('id_program_microcredential', $programId)
            ->orderBy('dibuat_pada', 'desc')
            ->get();

        return view('admin.kursusIndex', compact('program', 'courses'));
    }

    /**
     * Menampilkan form tambah kursus ke program.
     */
    public function create($programId)
    {
        $program = ProgramMicrocredential::findOrFail($programId);

        $instructors = Instruktur::with('pengguna')->get();

        return view('admin.kursusCreate', compact('program', 'instructors'));
    }

    /**
     * Menyimpan kursus baru ke dalam program akademik.
     * Mendukung penambahan banyak kursus sekaligus.
     */
    public function store(Request $request, $programId)
    {
        $program = ProgramMicrocredential::findOrFail($programId);

        $request->validate([
            'nama'            => 'required|string|max:255',
            'deskripsi'       => 'nullable|string|max:2000',
            'id_instruktur'   => 'nullable|array',
            'id_instruktur.*' => 'exists:instruktur,id',
            'foto_kursus'     => 'nullable|image|max:2048',
            'nilai_kelulusan_kursus' => 'nullable|numeric|min:0|max:100',
        ], [
            'nama.required'          => 'Nama kursus wajib diisi.',
            'nama.max'               => 'Nama kursus maksimal 255 karakter.',
            'id_instruktur.array'    => 'Data instruktur tidak valid.',
            'id_instruktur.*.exists' => 'Salah satu instruktur tidak valid.',
            'foto_kursus.image'      => 'Foto harus berupa file gambar.',
            'foto_kursus.max'        => 'Ukuran foto maksimal 2 MB.',
            'nilai_kelulusan_kursus.numeric' => 'Nilai kelulusan harus berupa angka.',
            'nilai_kelulusan_kursus.min'     => 'Nilai kelulusan minimal 0.',
            'nilai_kelulusan_kursus.max'     => 'Nilai kelulusan maksimal 100.',
        ]);

        $data = [
            'id_program_microcredential' => $program->id,
            'nama'                       => $request->nama,
            'deskripsi'                  => $request->deskripsi,
            'nilai_kelulusan_kursus'     => $request->nilai_kelulusan_kursus ?? 75.00,
        ];

        if ($request->hasFile('foto_kursus')) {
            $data['foto_kursus'] = $request->file('foto_kursus')->store('kursus', 'public');
        } else {
            $data['foto_kursus'] = 'kursus/default.png';
        }

        $kursus = Kursus::create($data);

        // Assign multiple instruktur (many-to-many)
        if ($request->id_instruktur) {
            foreach ($request->id_instruktur as $instrukturId) {
                KursusInstruktur::create([
                    'id_kursus'     => $kursus->id,
                    'id_instruktur' => $instrukturId,
                ]);
            }
        }

        return redirect()
            ->route('admin.program.kursus.index', $program->id)
            ->with('success', 'Kursus "' . $kursus->nama . '" berhasil ditambahkan ke program.');
    }

    /**
     * Menampilkan form edit kursus.
     */
    public function edit($programId, $kursusId)
    {
        $program = ProgramMicrocredential::findOrFail($programId);
        $course  = Kursus::with('instruktur')->findOrFail($kursusId);

        $instructors = Instruktur::with('pengguna')->get();

        // Ambil semua id instruktur yang di-assign ke kursus ini
        $selectedInstrukturIds = $course->instruktur->pluck('id')->toArray();

        return view('admin.kursusEdit', compact('program', 'course', 'instructors', 'selectedInstrukturIds'));
    }

    /**
     * Memperbarui data kursus.
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
            'foto_kursus'     => 'nullable|image|max:2048',
            'nilai_kelulusan_kursus' => 'nullable|numeric|min:0|max:100',
        ], [
            'nama.required'          => 'Nama kursus wajib diisi.',
            'nama.max'               => 'Nama kursus maksimal 255 karakter.',
            'id_instruktur.array'    => 'Data instruktur tidak valid.',
            'id_instruktur.*.exists' => 'Salah satu instruktur tidak valid.',
            'foto_kursus.image'      => 'Foto harus berupa file gambar.',
            'foto_kursus.max'        => 'Ukuran foto maksimal 2 MB.',
            'nilai_kelulusan_kursus.numeric' => 'Nilai kelulusan harus berupa angka.',
            'nilai_kelulusan_kursus.min'     => 'Nilai kelulusan minimal 0.',
            'nilai_kelulusan_kursus.max'     => 'Nilai kelulusan maksimal 100.',
        ]);

        $data = [
            'nama'                       => $request->nama,
            'deskripsi'                  => $request->deskripsi,
            'nilai_kelulusan_kursus'     => $request->nilai_kelulusan_kursus ?? $kursus->nilai_kelulusan_kursus,
        ];

        if ($request->hasFile('foto_kursus')) {
            $data['foto_kursus'] = $request->file('foto_kursus')->store('kursus', 'public');
        }

        $kursus->update($data);

        // Sync instruktur (many-to-many): hapus semua lama, insert baru
        KursusInstruktur::where('id_kursus', $kursus->id)->delete();

        if ($request->id_instruktur) {
            foreach ($request->id_instruktur as $instrukturId) {
                KursusInstruktur::create([
                    'id_kursus'     => $kursus->id,
                    'id_instruktur' => $instrukturId,
                ]);
            }
        }

        return redirect()
            ->route('admin.program.kursus.index', $program->id)
            ->with('success', 'Kursus "' . $kursus->nama . '" berhasil diperbarui.');
    }

    /**
     * Menghapus kursus dari program akademik.
     */
    public function destroy($programId, $kursusId)
    {
        $program = ProgramMicrocredential::findOrFail($programId);
        $kursus  = Kursus::findOrFail($kursusId);

        $namaKursus = $kursus->nama;

        // Hapus relasi instruktur terlebih dahulu
        KursusInstruktur::where('id_kursus', $kursus->id)->delete();

        // Hapus kursus
        $kursus->delete();

        return redirect()
            ->route('admin.program.kursus.index', $program->id)
            ->with('success', 'Kursus "' . $namaKursus . '" berhasil dihapus dari program.');
    }
}
