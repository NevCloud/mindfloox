<?php

namespace App\Http\Controllers\SuperAdmin;

// Import base controller dan model yang dibutuhkan
use App\Http\Controllers\Controller;
use App\Models\Pengguna;                   // Model untuk tabel pengguna (user)
use App\Models\AdminMicrocredential;       // Model untuk tabel relasi admin microcredential
use App\Models\Instruktur;                 // Model untuk tabel relasi instruktur
use App\Models\JenisMicrocredential;       // Model untuk dropdown jenis microcredential
use Illuminate\Http\Request;               // Untuk menangani request dari form
use Illuminate\Support\Facades\Hash;       // Untuk encrypt password (Hash::make)
use Illuminate\Support\Facades\DB;        // Untuk database transaction (atomic operation)
use Illuminate\Validation\Rule;            // Untuk validasi unique dengan kondisi (ignore)

/**
 * Controller untuk mengelola akun Admin Microcredential dan Instruktur.
 * 
 * Controller ini menangani CRUD (Create, Read, Update, Delete) untuk:
 * - Admin Microcredential (role: admin_microcredential)
 * - Instruktur (role: instruktur)
 * 
 * Kedua role digabung dalam satu halaman karena UI menampilkan mereka bersama-sama.
 * Hanya Super Admin yang bisa mengakses controller ini (dibatasi via middleware di routes).
 */
class AdminInstrukturController extends Controller
{
    /**
     * INDEX - Menampilkan daftar akun Admin Microcredential & Instruktur.
     * 
     * Method ini mengambil semua user dengan role admin_microcredential atau instruktur,
     * mendukung fitur pencarian (search) dan filter berdasarkan role.
     * Data dikirim ke view beserta daftar jenis microcredential untuk dropdown.
     * 
     * @param Request $request - Berisi parameter search dan role dari URL query string
     * @return View superAdmin.adminInstruktur
     */
    public function index(Request $request)
    {
        // Query dasar: ambil semua pengguna dengan role admin atau instruktur
        // with() untuk eager loading relasi agar tidak terjadi N+1 query problem
        $query = Pengguna::whereIn('role', ['admin_microcredential', 'instruktur'])
            ->with(['adminMicrocredential.jenisMicrocredential']);

        // Filter pencarian: cari berdasarkan nama, email, atau username
        // Menggunakan closure where() agar kondisi OR hanya di dalam group yang sama
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }

        // Filter role: hanya tampilkan role tertentu jika dipilih di dropdown
        if ($role = $request->input('role')) {
            $query->where('role', $role);
        }

        // Urutkan dari yang terbaru, paginate 10 data per halaman
        // withQueryString() agar parameter search/role tetap ada di URL pagination
        $admins = $query->orderBy('dibuat_pada', 'desc')->paginate(10)->withQueryString();

        // Ambil semua jenis microcredential untuk ditampilkan di dropdown form
        $jenisList = JenisMicrocredential::orderBy('nama', 'asc')->get();

        // Kirim data $admins dan $jenisList ke view menggunakan compact()
        return view('superAdmin.adminInstruktur', compact('admins', 'jenisList'));
    }

    /**
     * STORE - Menyimpan akun Admin Microcredential atau Instruktur baru.
     * 
     * Alur:
     * 1. Validasi input dari form
     * 2. Buat record di tabel pengguna (password default = username)
     * 3. Buat record tambahan di tabel role-specific (admin_microcredential atau instruktur)
     * 4. Redirect kembali dengan pesan sukses
     * 
     * @param Request $request - Berisi data dari form create
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input: jika gagal, otomatis redirect kembali dengan error
        $request->validate([
            'nama'                      => 'required|string|max:255',
            // Username: hanya boleh huruf, angka, underscore, dan titik (tanpa spasi)
            // regex:/^[a-zA-Z0-9._]+$/ = pola yang diizinkan
            'username'                  => 'required|string|max:255|regex:/^[a-zA-Z0-9._]+$/|unique:pengguna,username',
            'email'                     => 'required|email|max:255|unique:pengguna,email',
            'role'                      => 'required|in:admin_microcredential,instruktur',
            // id_jenis_microcredential: wajib diisi HANYA jika role = admin_microcredential
            'id_jenis_microcredential'  => 'required_if:role,admin_microcredential|nullable|exists:jenis_microcredential,id',
        ], [
            // Custom pesan error dalam Bahasa Indonesia
            'nama.required'                         => 'Nama wajib diisi.',
            'username.required'                     => 'Username wajib diisi.',
            'username.regex'                        => 'Username tidak boleh ada spasi.',
            'username.unique'                       => 'Username sudah digunakan.',
            'email.required'                        => 'Email wajib diisi.',
            'email.email'                           => 'Format email tidak valid.',
            'email.unique'                          => 'Email sudah terdaftar.',
            'role.in'                               => 'Role tidak valid.',
            'id_jenis_microcredential.required_if'  => 'Jenis microcredential wajib dipilih untuk Admin.',
            'id_jenis_microcredential.exists'       => 'Jenis microcredential tidak valid.',
        ]);

        // LANGKAH 1 & 2: Buat record di tabel pengguna + role-specific dalam SATU transaction
        // Jika salah satu gagal, SEMUA rollback (tidak ada orphan record)
        DB::transaction(function () use ($request) {
            // Buat record di tabel pengguna
            // Password di-hash menggunakan bcrypt via Hash::make() untuk keamanan
            // Password default = username (user bisa ganti nanti di profil)
            $pengguna = Pengguna::create([
                'nama'          => $request->nama,
                'username'      => $request->username,
                'email'         => $request->email,
                'kata_sandi'    => Hash::make($request->username),  // Password = username
                'role'          => $request->role,
                'aktif'         => 'aktif',  // Akun baru default aktif
            ]);

            // Buat record tambahan di tabel role-specific
            // Setiap role punya tabel tambahan untuk menyimpan data spesifik role tersebut
            if ($request->role === 'admin_microcredential') {
                // Admin microcredential perlu id_jenis_microcredential (jenis yang dikelola)
                AdminMicrocredential::create([
                    'id_pengguna'               => $pengguna->id,           // FK ke tabel pengguna
                    'id_jenis_microcredential'  => $request->id_jenis_microcredential,  // FK ke jenis
                    'id_dibuat_oleh'            => auth()->user()->superAdmin->id ?? null,  // Siapa yang buat
                ]);
            } elseif ($request->role === 'instruktur') {
                // Instruktur tidak perlu id_jenis_microcredential
                Instruktur::create([
                    'id_pengguna'       => $pengguna->id,
                    'id_dibuat_oleh'    => auth()->user()->superAdmin->id ?? null,
                ]);
            }
        });

        // Buat label role untuk pesan sukses (lebih user-friendly)
        $roleLabel = $request->role === 'admin_microcredential' ? 'Admin Microcredential' : 'Instruktur';

        // Redirect ke halaman list dengan flash message sukses
        // Flash message hanya tampil sekali (setelah redirect)
        return redirect()
            ->route('superAdmin.adminInstruktur')
            ->with('success', "Akun {$roleLabel} berhasil ditambahkan.");
    }

    /**
     * UPDATE - Memperbarui akun Admin Microcredential atau Instruktur.
     * 
     * Alur:
     * 1. Cari pengguna berdasarkan ID (hanya yang role admin/instruktur)
     * 2. Validasi input (username & email unique, tapi ignore diri sendiri)
     * 3. Update data di tabel pengguna
     * 4. Update data tambahan di tabel role-specific (jika ada perubahan)
     * 5. Redirect dengan pesan sukses
     * 
     * @param Request $request - Berisi data dari form edit
     * @param int $id - ID pengguna yang akan diupdate
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Cari pengguna berdasarkan ID, tapi batasi hanya role admin/instruktur
        // whereIn + findOrFail: jika ID tidak ditemukan atau role tidak sesuai, return 404
        $pengguna = Pengguna::whereIn('role', ['admin_microcredential', 'instruktur'])->findOrFail($id);

        // Validasi input
        $request->validate([
            'nama'                      => 'required|string|max:255',
            // Rule::unique()->ignore($pengguna->id): unique tapi abaikan record user ini sendiri
            // regex: hanya huruf, angka, underscore, dan titik (tanpa spasi)
            'username'                  => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9._]+$/', Rule::unique('pengguna', 'username')->ignore($pengguna->id)],
            'email'                     => ['required', 'email', 'max:255', Rule::unique('pengguna', 'email')->ignore($pengguna->id)],
            'aktif'                     => 'required|in:aktif,nonaktif',
            'id_jenis_microcredential'  => 'nullable|exists:jenis_microcredential,id',
        ], [
            'nama.required'                         => 'Nama wajib diisi.',
            'username.required'                     => 'Username wajib diisi.',
            'username.regex'                        => 'Username tidak boleh ada spasi.',
            'username.unique'                       => 'Username sudah digunakan.',
            'email.required'                        => 'Email wajib diisi.',
            'email.email'                           => 'Format email tidak valid.',
            'email.unique'                          => 'Email sudah terdaftar.',
            'aktif.in'                              => 'Status harus aktif atau nonaktif.',
            'id_jenis_microcredential.exists'       => 'Jenis microcredential tidak valid.',
        ]);

        // LANGKAH 1: Update data di tabel pengguna
        $pengguna->update([
            'nama'      => $request->nama,
            'username'  => $request->username,
            'email'     => $request->email,
            'aktif'     => $request->aktif,   // Status aktif/nonaktif bisa diubah
        ]);

        // LANGKAH 2: Update record di tabel role-specific
        // Hanya untuk admin microcredential yang punya id_jenis_microcredential
        if ($pengguna->role === 'admin_microcredential' && $request->id_jenis_microcredential) {
            // Cari record admin berdasarkan id_pengguna
            $admin = AdminMicrocredential::where('id_pengguna', $pengguna->id)->first();
            if ($admin) {
                $admin->update([
                    'id_jenis_microcredential' => $request->id_jenis_microcredential,
                ]);
            }
        }

        // Label role untuk pesan sukses
        $roleLabel = $pengguna->role === 'admin_microcredential' ? 'Admin Microcredential' : 'Instruktur';

        return redirect()
            ->route('superAdmin.adminInstruktur')
            ->with('success', "Akun {$roleLabel} berhasil diperbarui.");
    }

    /**
     * DESTROY - Menghapus akun Admin Microcredential atau Instruktur.
     * 
     * Alur:
     * 1. Cari pengguna berdasarkan ID
     * 2. Hapus record di tabel role-specific TERLEBIH DAHULU (karena ada Foreign Key)
     * 3. Baru hapus record di tabel pengguna
     * 
     * Urutan penghapusan penting! Tabel role-specific punya FK ke tabel pengguna,
     * jadi harus dihapus duluan agar tidak error constraint violation.
     * 
     * @param int $id - ID pengguna yang akan dihapus
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        // Cari pengguna, batasi hanya role admin/instruktur
        $pengguna = Pengguna::whereIn('role', ['admin_microcredential', 'instruktur'])->findOrFail($id);

        // LANGKAH 1 & 2: Hapus dalam transaction agar atomic
        // Jika salah satu gagal, semua rollback
        try {
            DB::transaction(function () use ($pengguna) {
                // Hapus record relasi di tabel role-specific terlebih dahulu
                // Ini penting untuk menghindari error Foreign Key Constraint
                if ($pengguna->role === 'admin_microcredential') {
                    AdminMicrocredential::where('id_pengguna', $pengguna->id)->delete();
                } elseif ($pengguna->role === 'instruktur') {
                    Instruktur::where('id_pengguna', $pengguna->id)->delete();
                }

                // Baru hapus record di tabel pengguna
                $pengguna->delete();
            });
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                $roleLabel = $pengguna->role === 'admin_microcredential' ? 'Admin Microcredential' : 'Instruktur';
                return redirect()
                    ->route('superAdmin.adminInstruktur')
                    ->with('error', "Gagal menghapus! Akun {$roleLabel} ini tidak bisa dihapus karena masih terikat dengan data lain di sistem (misal: sudah ditugaskan ke kursus atau memiliki data aktivitas). Lepaskan akses tersebut terlebih dahulu.");
            }
            throw $e;
        }

        $roleLabel = $pengguna->role === 'admin_microcredential' ? 'Admin Microcredential' : 'Instruktur';

        return redirect()
            ->route('superAdmin.adminInstruktur')
            ->with('success', "Akun {$roleLabel} berhasil dihapus.");
    }
}
