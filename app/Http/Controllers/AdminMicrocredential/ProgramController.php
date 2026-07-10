<?php

namespace App\Http\Controllers\AdminMicrocredential;

use App\Http\Controllers\Controller;
use App\Models\ProgramMicrocredential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    /**
     * Redirect admin langsung ke halaman kursus program yang di-assign kepadanya.
     * Admin hanya mengelola 1 program sesuai jenis microcredential-nya.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $admin = $user->adminMicrocredential;

        $query = ProgramMicrocredential::query();

        // Filter: admin melihat program yang di-assign langsung
        if ($admin) {
            $query->where('id_admin_microcredential', $admin->id);
        }

        $program = $query->first();

        // Langsung redirect ke halaman kursus program tersebut
        if ($program) {
            return redirect()->route('admin.program.kursus.index', $program->id);
        }

        // Fallback jika belum ada program yang di-assign
        return redirect()->route('admin.dasbor')->with('error', 'Akses ditolak: Belum ada program yang ditugaskan kepada Anda.');
    }
}
