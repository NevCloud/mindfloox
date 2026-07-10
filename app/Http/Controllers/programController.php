<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramMicrocredential;
use App\Models\JenisMicrocredential;

class programController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jenis_id = $request->input('jenis');

        $query = ProgramMicrocredential::with(['adminMicrocredential.pengguna', 'jenisMicrocredential'])
            ->withCount(['pendaftaran' => function ($query) {
                $query->where('status', 'diterima');
            }]);

        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        }

        if ($jenis_id) {
            $query->where('id_jenis_microcredential', $jenis_id);
        }

        $program = $query->latest('dibuat_pada')->get();
        $kategori = JenisMicrocredential::has('programMicrocredential')->get();

        return view('program', compact('program', 'kategori'));
    }
}
