<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\JenisMicrocredential;
use Illuminate\Http\Request;

class JenisMicrocredentialController extends Controller
{
    /**
     * Menampilkan daftar jenis microcredential.
     */
    public function index(Request $request)
    {
        $query = JenisMicrocredential::query();

        if ($search = $request->input('search')) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        $jenisMicrocredentials = $query->orderBy('dibuat_pada', 'desc')->paginate(10);

        return view('superAdmin.jenisMicrocredential', compact('jenisMicrocredentials'));
    }

    /**
     * Menyimpan data jenis microcredential baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
        ], [
            'nama.required' => 'Nama jenis microcredential wajib diisi.',
            'nama.max'      => 'Nama maksimal 255 karakter.',
        ]);

        JenisMicrocredential::create([
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('superAdmin.jenisMicrocredential')
            ->with('success', 'Jenis microcredential berhasil ditambahkan.');
    }

    /**
     * Memperbarui data jenis microcredential.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
        ], [
            'nama.required' => 'Nama jenis microcredential wajib diisi.',
            'nama.max'      => 'Nama maksimal 255 karakter.',
        ]);

        $jenis = JenisMicrocredential::findOrFail($id);
        $jenis->update([
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('superAdmin.jenisMicrocredential')
            ->with('success', 'Jenis microcredential berhasil diperbarui.');
    }

    /**
     * Menghapus data jenis microcredential.
     */
    public function destroy($id)
    {
        $jenis = JenisMicrocredential::findOrFail($id);
        $jenis->delete();

        return redirect()
            ->route('superAdmin.jenisMicrocredential')
            ->with('success', 'Jenis microcredential berhasil dihapus.');
    }
}
