<?php

namespace App\Http\Controllers\AdminMicrocredential;

use App\Http\Controllers\Controller;
use App\Models\ProgramMicrocredential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    /**
     * Menampilkan daftar program akademik yang dapat dikelola oleh admin microcredential.
     * Admin hanya melihat program yang sesuai dengan jenis microcredential yang di-assign kepadanya.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $admin = $user->adminMicrocredential;

        $query = ProgramMicrocredential::with(['jenisMicrocredential', 'semester', 'kursus']);

        // Filter: admin hanya melihat program sesuai jenis microcredential-nya
        if ($admin && $admin->id_jenis_microcredential) {
            $query->where('id_jenis_microcredential', $admin->id_jenis_microcredential);
        }

        // Search filter
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('status_pendaftaran', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($status = $request->input('status')) {
            $query->where('status_pendaftaran', $status);
        }

        $programs = $query->orderBy('dibuat_pada', 'desc')->get();

        return view('admin.programIndex', compact('programs'));
    }
}
