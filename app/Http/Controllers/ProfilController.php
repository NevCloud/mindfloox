<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\UlasanKursus;
use App\Models\Minggu;
use App\Models\MateriDilihat;
use App\Models\MateriPembelajaran;
use App\Models\JawabanTugas;
use App\Models\Tugas;
use App\Models\SesiKuis;
use App\Models\Kuis;
use App\Models\kursus;
use App\Models\Pengguna;
use App\Models\ProgramMicrocredential;

/**
 * ProfilController
 *
 * Mengelola halaman profil untuk SEMUA role (super_admin, admin_microcredential, instruktur, peserta).
 * Setiap user bisa melihat dan mengedit profil mereka sendiri (F021).
 */
class ProfilController extends Controller
{
    /**
     * Menampilkan halaman profil user yang sedang login.
     * Semua role pakai 1 view yang sama (component <x-profil-page>).
     */
    public function show()
    {
        $user = Auth::user();

        $programs = collect();

        if ($user->role === 'admin_microcredential' && $user->adminMicrocredential) {

            $programs = ProgramMicrocredential::with([
                'jenisMicrocredential',
                'semester'
            ])
                ->where('id_admin_microcredential', $user->adminMicrocredential->id)
                ->latest('dibuat_pada')
                ->get()
                ->map(function ($program) {

                    $program->status_tampil = $program->status_pendaftaran;

                    $program->program_selesai = $program->semester
                        ? now()->greaterThanOrEqualTo(
                            Carbon::parse($program->semester->tanggal_selesai)
                        )
                        : false;

                    return $program;
                });
        } elseif ($user->role === 'peserta' && $user->peserta) {

            $programs = $user->peserta
                ->pendaftaran()
                ->with([
                    'programMicrocredential.semester',
                    'programMicrocredential.jenisMicrocredential',
                    'programMicrocredential.kursus'
                ])
                ->where('status', 'diterima')
                ->latest('dibuat_pada')
                ->get()
                ->map(function ($pendaftaran) {

                    $program = $pendaftaran->programMicrocredential;

                    $programSelesai100 = true;

                    foreach ($program->kursus as $kursus) {

                        $progress = $this->hitungProgressKursus(
                            $pendaftaran->id,
                            $kursus->id
                        );

                        if ($progress < 100) {
                            $programSelesai100 = false;
                            break;
                        }
                    }

                    $program->progress_100 = $programSelesai100;

                    $program->id_pendaftaran = $pendaftaran->id;
                    $program->status_tampil = $pendaftaran->status;

                    $program->program_selesai = true; 

                    // $program->program_selesai = $program->semester
                    //     ? now()->greaterThanOrEqualTo(
                    //         Carbon::parse($program->semester->tanggal_selesai)
                    //     )
                    //     : false;

                    $program->sudah_rating = $pendaftaran->ulasanKursus()->exists();

                    $program->boleh_rating =
                        $program->program_selesai &&
                        $program->progress_100;

                    $program->boleh_download =
                        $program->program_selesai &&
                        $program->sudah_rating;

                    return $program;
                });
        }

        return view('profil', compact('user', 'programs'));
    }

    private function hitungProgressKursus($idPendaftaran, $idKursus)
    {
        $allWeeks = Minggu::where('id_kursus', $idKursus)->get();

        $totalVisibleWeeks = $allWeeks->count();
        $completedWeeks = 0;

        if ($totalVisibleWeeks == 0) {
            return 0;
        }

        $dilihatIds = MateriDilihat::where('id_pendaftaran', $idPendaftaran)
            ->pluck('id_materi_pembelajaran')
            ->flip()
            ->toArray();

        $submittedTugasIds = JawabanTugas::where('id_pendaftaran', $idPendaftaran)
            ->where('status', 'final')
            ->pluck('id_tugas')
            ->flip()
            ->toArray();

        $completedKuisIds = SesiKuis::where('id_pendaftaran', $idPendaftaran)
            ->where('status', 'selesai')
            ->pluck('id_kuis')
            ->flip()
            ->toArray();

        foreach ($allWeeks as $week) {

            $materiIds = MateriPembelajaran::where('id_kursus', $idKursus)
                ->where('id_minggu', $week->id)
                ->pluck('id')
                ->toArray();

            $tugasIds = Tugas::where('id_kursus', $idKursus)
                ->where('id_minggu', $week->id)
                ->pluck('id')
                ->toArray();

            $kuisIds = Kuis::where('id_kursus', $idKursus)
                ->where('id_minggu', $week->id)
                ->pluck('id')
                ->toArray();

            $totalItems = count($materiIds) + count($tugasIds) + count($kuisIds);

            if ($totalItems == 0) {
                continue;
            }

            $allMateriViewed = empty($materiIds) || empty(array_diff($materiIds, array_keys($dilihatIds)));
            $allTugasDone = empty($tugasIds) || empty(array_diff($tugasIds, array_keys($submittedTugasIds)));
            $allKuisDone = empty($kuisIds) || empty(array_diff($kuisIds, array_keys($completedKuisIds)));

            if ($allMateriViewed && $allTugasDone && $allKuisDone) {
                $completedWeeks++;
            }
        }

        return round(($completedWeeks / $totalVisibleWeeks) * 100);
    }
    /**
     * AJAX: cek apakah username sudah dipakai user lain.
     * Dipanggil via fetch() dari form edit profil.
     *
     * Response: { available: true/false, message: string }
     */
    public function checkUsername(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $exists = Pengguna::where('username', $request->username)
            ->where('id', '!=', $user->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'available' => false,
                'message'   => 'Username sudah digunakan.',
            ]);
        }

        return response()->json([
            'available' => true,
            'message'   => 'Username tersedia.',
        ]);
    }

    /**
     * Mengupdate data profil user yang sedang login.
     *
     * Field yang bisa diedit:
     * - nama, username, email, nomor_telepon, alamat, tanggal_lahir
     * - linkedin, instagram, facebook, x (social media)
     * - foto_profil (upload gambar)
     * - kata_sandi (opsional, default = username)
     *
     * Field yang TIDAK bisa diedit:
     * - role (dikontrol Super Admin)
     * - aktif (dikontrol sistem)
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama'     => 'required|string|min:2|max:255',
            // Username: unique kecuali milik sendiri, tanpa spasi
            'username' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9._]+$/',
                Rule::unique('pengguna', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('pengguna', 'email')->ignore($user->id),
            ],
            'nomor_telepon' => 'nullable|string|max:20',
            'alamat'        => 'nullable|string|max:500',
            'tanggal_lahir' => 'nullable|date|before:today',
            'linkedin'      => 'nullable|string|max:255',
            'instagram'     => 'nullable|string|max:255',
            'facebook'      => 'nullable|string|max:255',
            'x'             => 'nullable|string|max:255',
            'foto_profil'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kata_sandi'    => 'nullable|string|min:6|confirmed',
        ], [
            'nama.required'      => 'Nama lengkap wajib diisi.',
            'nama.min'           => 'Nama minimal 2 karakter.',
            'username.required'  => 'Username wajib diisi.',
            'username.regex'     => 'Username tidak boleh mengandung spasi.',
            'username.unique'    => 'Username sudah digunakan.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email ini sudah digunakan user lain.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'foto_profil.image'  => 'File harus berupa gambar.',
            'foto_profil.max'    => 'Ukuran foto maksimal 2MB.',
            'kata_sandi.min'     => 'Kata sandi minimal 6 karakter.',
            'kata_sandi.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        // Upload foto profil (jika ada)
        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $fotoPath = $request->file('foto_profil')->store('foto-profil', 'public');
            $user->foto_profil = $fotoPath;
        }

        // Update semua field yang boleh diedit
        $user->nama          = $request->nama;
        $user->username      = $request->username;
        $user->email         = $request->email;
        $user->nomor_telepon = $request->nomor_telepon;
        $user->alamat        = $request->alamat;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->linkedin      = $request->linkedin;
        $user->instagram     = $request->instagram;
        $user->facebook      = $request->facebook;
        $user->x             = $request->x;

        // Update kata sandi: jika diisi → pakai yang baru, jika kosong → default = username
        if ($request->filled('kata_sandi')) {
            $user->kata_sandi = Hash::make($request->kata_sandi);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
