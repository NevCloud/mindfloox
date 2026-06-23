<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Menampilkan daftar semester.
     */
    public function index(Request $request)
    {
        $query = Semester::query();

        if ($search = $request->input('search')) {
            $query->where('tahun', 'like', "%{$search}%")
                ->orWhere('jenis', 'like', "%{$search}%");
        }

        $semesters = $query->orderBy('dibuat_pada', 'desc')->paginate(10);

        return view('superAdmin.semester', compact('semesters'));
    }

    /**
     * Menyimpan data semester baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun'             => 'required|string|max:20',
            'jenis'             => 'required|in:ganjil,genap',
            'tanggal_mulai'     => 'required|date',
            'tanggal_selesai'   => 'required|date|after:tanggal_mulai',
        ], [
            'tahun.required'            => 'Tahun ajaran wajib diisi.',
            'jenis.required'            => 'Jenis periode wajib dipilih.',
            'jenis.in'                  => 'Jenis periode harus ganjil atau genap.',
            'tanggal_mulai.required'    => 'Tanggal mulai wajib diisi.',
            'tanggal_selesai.required'  => 'Tanggal selesai wajib diisi.',
            'tanggal_selesai.after'     => 'Tanggal selesai harus setelah tanggal mulai.',
        ]);

        Semester::create($request->only('tahun', 'jenis', 'tanggal_mulai', 'tanggal_selesai'));

        return redirect()
            ->route('superAdmin.semester')
            ->with('success', 'Periode pembelajaran berhasil ditambahkan.');
    }

    /**
     * Memperbarui data semester.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun'             => 'required|string|max:20',
            'jenis'             => 'required|in:ganjil,genap',
            'tanggal_mulai'     => 'required|date',
            'tanggal_selesai'   => 'required|date|after:tanggal_mulai',
        ], [
            'tahun.required'            => 'Tahun ajaran wajib diisi.',
            'jenis.required'            => 'Jenis periode wajib dipilih.',
            'jenis.in'                  => 'Jenis periode harus ganjil atau genap.',
            'tanggal_mulai.required'    => 'Tanggal mulai wajib diisi.',
            'tanggal_selesai.required'  => 'Tanggal selesai wajib diisi.',
            'tanggal_selesai.after'     => 'Tanggal selesai harus setelah tanggal mulai.',
        ]);

        $semester = Semester::findOrFail($id);
        $semester->update($request->only('tahun', 'jenis', 'tanggal_mulai', 'tanggal_selesai'));

        return redirect()
            ->route('superAdmin.semester')
            ->with('success', 'Periode pembelajaran berhasil diperbarui.');
    }

    /**
     * Menghapus data semester.
     */
    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);
        
        try {
            $semester->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()
                    ->route('superAdmin.semester')
                    ->with('error', "Gagal menghapus! Periode pembelajaran ini tidak bisa dihapus karena sudah ada Program Microcredential yang menggunakan periode ini.");
            }
            throw $e;
        }

        return redirect()
            ->route('superAdmin.semester')
            ->with('success', 'Periode pembelajaran berhasil dihapus.');
    }
}
