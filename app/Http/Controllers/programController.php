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

        $query = ProgramMicrocredential::with(['adminMicrocredential.pengguna', 'jenisMicrocredential', 'kursus.ulasanKursus'])
            ->withCount(['pendaftaran' => function ($query) {
                $query->where('status', 'diterima');
            }]);

        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        }

        if ($jenis_id) {
            $query->where('id_jenis_microcredential', $jenis_id);
        }

        $program = $query->latest('dibuat_pada')->get()->map(function ($prog) {
            $ratings = $prog->kursus
                ->flatMap(function ($kursus) {
                    return $kursus->ulasanKursus;
                })
                ->pluck('rating_kursus');

            $prog->rating = $ratings->isNotEmpty()
                ? round($ratings->avg(), 1)
                : 0;

            $prog->jumlah_ulasan = $ratings->count();

            return $prog;
        });
        $kategori = JenisMicrocredential::has('programMicrocredential')->get();

        return view('program', compact('program', 'kategori'));
    }
}
