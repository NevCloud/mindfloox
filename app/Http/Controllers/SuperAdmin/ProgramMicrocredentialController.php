<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\ProgramMicrocredential;
use App\Models\JenisMicrocredential;
use App\Models\Semester;
use App\Models\AdminMicrocredential;
use Illuminate\Http\Request;

class ProgramMicrocredentialController extends Controller
{
    /**
     * Menampilkan daftar program microcredential.
     */
    public function index(Request $request)
    {
        $query = ProgramMicrocredential::with(['jenisMicrocredential', 'semester', 'adminMicrocredential.pengguna']);

        if ($search = $request->input('search')) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('status_pendaftaran', 'like', "%{$search}%");
        }

        if ($jenis = $request->input('jenis')) {
            $query->where('id_jenis_microcredential', $jenis);
        }

        $programs = $query->orderBy('dibuat_pada', 'desc')->paginate(10);

        $jenisList = JenisMicrocredential::orderBy('nama', 'asc')->get();
        $semesterList = Semester::orderBy('dibuat_pada', 'desc')->get();
        $adminList = AdminMicrocredential::with(['pengguna', 'jenisMicrocredential', 'programs'])->get()
            ->map(fn($a) => [
                'id' => $a->id,
                'nama' => $a->pengguna->nama ?? '-',
                'foto_profil' => $a->pengguna->foto_profil ?? null,
                'id_jenis_microcredential' => $a->id_jenis_microcredential,
                'assigned_program_ids' => $a->programs->pluck('id')->toArray(),
            ])->values();

        return view('superAdmin.programMicrocredential', compact('programs', 'jenisList', 'semesterList', 'adminList'));
    }

    /**
     * Menyimpan data program microcredential baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'                  => 'required|string|max:255',
            'deskripsi'             => 'required|string|max:1000',
            'id_jenis_microcredential' => 'required|exists:jenis_microcredential,id',
            'id_semester'           => 'required|exists:semester,id',
            'status_pendaftaran'    => 'required|in:buka,tutup',
            'id_admin_microcredential' => 'required|exists:admin_microcredential,id',
            'foto_program'          => 'required|image|max:2048',
        ], [
            'nama.required'                     => 'Nama program wajib diisi.',
            'deskripsi.required'                => 'Deskripsi program wajib diisi.',
            'id_jenis_microcredential.required' => 'Jenis microcredential wajib dipilih.',
            'id_jenis_microcredential.exists'   => 'Jenis microcredential tidak valid.',
            'id_semester.required'              => 'Semester wajib dipilih.',
            'id_semester.exists'                => 'Semester tidak valid.',
            'status_pendaftaran.required'       => 'Status pendaftaran wajib dipilih.',
            'status_pendaftaran.in'             => 'Status harus buka atau tutup.',
            'foto_program.required'             => 'Foto program wajib diunggah.',
            'foto_program.image'                => 'Foto harus berupa file gambar.',
            'foto_program.max'                  => 'Ukuran foto maksimal 2 MB.',
            'id_admin_microcredential.required' => 'Admin microcredential wajib dipilih.',
            'id_admin_microcredential.exists'   => 'Admin microcredential tidak valid.',
        ]);

        $data = $request->only('nama', 'deskripsi', 'id_jenis_microcredential', 'id_semester', 'id_admin_microcredential', 'status_pendaftaran');

        if ($request->hasFile('foto_program')) {
            $data['foto_program'] = $request->file('foto_program')->store('program', 'public');
        }

        ProgramMicrocredential::create($data);

        return redirect()
            ->route('superAdmin.programMicrocredential')
            ->with('success', 'Program microcredential berhasil ditambahkan.');
    }

    /**
     * Memperbarui data program microcredential.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'                  => 'required|string|max:255',
            'deskripsi'             => 'required|string|max:1000',
            'id_jenis_microcredential' => 'required|exists:jenis_microcredential,id',
            'id_semester'           => 'required|exists:semester,id',
            'status_pendaftaran'    => 'required|in:buka,tutup',
            'id_admin_microcredential' => 'required|exists:admin_microcredential,id',
            'foto_program'          => 'nullable|image|max:2048',
        ], [
            'nama.required'                     => 'Nama program wajib diisi.',
            'deskripsi.required'                => 'Deskripsi program wajib diisi.',
            'id_jenis_microcredential.required' => 'Jenis microcredential wajib dipilih.',
            'id_jenis_microcredential.exists'   => 'Jenis microcredential tidak valid.',
            'id_semester.required'              => 'Semester wajib dipilih.',
            'id_semester.exists'                => 'Semester tidak valid.',
            'status_pendaftaran.required'       => 'Status pendaftaran wajib dipilih.',
            'status_pendaftaran.in'             => 'Status harus buka atau tutup.',
            'foto_program.image'                => 'Foto harus berupa file gambar.',
            'foto_program.max'                  => 'Ukuran foto maksimal 2 MB.',
            'id_admin_microcredential.required'  => 'Admin microcredential wajib dipilih.',
            'id_admin_microcredential.exists'    => 'Admin microcredential tidak valid.',
        ]);

        $program = ProgramMicrocredential::findOrFail($id);
        $data = $request->only('nama', 'deskripsi', 'id_jenis_microcredential', 'id_semester', 'id_admin_microcredential', 'status_pendaftaran');

        if ($request->hasFile('foto_program')) {
            $data['foto_program'] = $request->file('foto_program')->store('program', 'public');
        }

        $program->update($data);

        return redirect()
            ->route('superAdmin.programMicrocredential')
            ->with('success', 'Program microcredential berhasil diperbarui.');
    }

    /**
     * Menghapus data program microcredential.
     */
    public function destroy($id)
    {
        $program = ProgramMicrocredential::findOrFail($id);
        
        try {
            $program->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()
                    ->route('superAdmin.programMicrocredential')
                    ->with('error', "Gagal menghapus! Program Microcredential ini tidak bisa dihapus karena sudah memiliki data Kursus atau peserta yang terdaftar.");
            }
            throw $e;
        }

        return redirect()
            ->route('superAdmin.programMicrocredential')
            ->with('success', 'Program microcredential berhasil dihapus.');
    }
}
