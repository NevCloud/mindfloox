<?php

namespace App\Http\Controllers\AdminMicrocredential;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VerifikasiController extends Controller
{
    /**
     * Menampilkan daftar pendaftaran peserta.
     * Admin hanya melihat pendaftaran untuk program yang sesuai dengan jenis microcredential-nya.
     */
    public function index(Request $request)
    {
        $user  = Auth::user();
        $admin = $user->adminMicrocredential;

        $query = Pendaftaran::with([
            'peserta.pengguna',
            'programMicrocredential.jenisMicrocredential',
            'diverifikasiOleh.pengguna',
        ]);

        // Filter: admin hanya melihat pendaftaran program sesuai jenis microcredential-nya
        if ($admin && $admin->id_jenis_microcredential) {
            $query->whereHas('programMicrocredential', function ($q) use ($admin) {
                $q->where('id_jenis_microcredential', $admin->id_jenis_microcredential);
            });
        }

        // Search filter
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('peserta.pengguna', function ($q2) use ($search) {
                    $q2->where('nama', 'like', "%{$search}%");
                })->orWhereHas('programMicrocredential', function ($q2) use ($search) {
                    $q2->where('nama', 'like', "%{$search}%");
                });
            });
        }

        // Status filter
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $registrations = $query->orderBy('tanggal_daftar', 'desc')->get();

        return view('admin.verifikasiIndex', compact('registrations'));
    }

    /**
     * Memproses verifikasi pendaftaran: menerima atau menolak.
     * Mendukung request biasa maupun AJAX (JSON).
     */
    public function verify(Request $request, $id)
    {
        $request->validate([
            'status'        => 'required|in:diterima,ditolak',
            'catatan_admin' => 'nullable|string|max:1000',
        ], [
            'status.required'      => 'Status verifikasi wajib dipilih.',
            'status.in'            => 'Status harus diterima atau ditolak.',
            'catatan_admin.max'    => 'Catatan maksimal 1000 karakter.',
        ]);

        $pendaftaran = Pendaftaran::with('peserta')->findOrFail($id);

        // Tolak jika sudah diverifikasi sebelumnya
        if ($pendaftaran->status !== 'menunggu') {
            $message = 'Pendaftaran ini sudah diverifikasi sebelumnya.';
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }
            return redirect()->route('admin.verifikasi.index')->with('error', $message);
        }

        $user  = Auth::user();
        $admin = $user->adminMicrocredential;

        // Update pendaftaran
        $pendaftaran->update([
            'status'             => $request->status,
            'catatan_admin'      => $request->catatan_admin,
            'tanggal_verifikasi' => Carbon::now(),
            'diverifikasi_oleh'  => $admin?->id,
        ]);

        // Jika diterima: aktifkan akses peserta
        if ($request->status === 'diterima' && $pendaftaran->peserta) {
            $pendaftaran->peserta->update([
                'akses_aktif'      => true,
                'diaktifkan_oleh'  => $admin?->id,
                'diaktifkan_pada'  => Carbon::now(),
            ]);
        }

        $statusLabel = $request->status === 'diterima' ? 'diterima' : 'ditolak';
        $pesertaName = $pendaftaran->peserta?->pengguna?->nama ?? 'Peserta';
        $message     = "Pendaftaran {$pesertaName} berhasil {$statusLabel}.";

        if ($request->expectsJson()) {
            return response()->json([
                'success'          => true,
                'message'          => $message,
                'status'           => $pendaftaran->status,
                'tanggal_verifikasi' => $pendaftaran->tanggal_verifikasi ? Carbon::parse($pendaftaran->tanggal_verifikasi)->format('d M Y H:i') : null,
                'diverifikasi_oleh'  => $admin?->pengguna?->nama ?? '-',
            ]);
        }

        return redirect()
            ->route('admin.verifikasi.index')
            ->with('success', $message);
    }
}
