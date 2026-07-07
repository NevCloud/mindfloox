<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\homeController;
use App\Http\Controllers\programController;
use App\Http\Controllers\instrukturController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SuperAdmin\JenisMicrocredentialController;
use App\Http\Controllers\SuperAdmin\SemesterController;
use App\Http\Controllers\SuperAdmin\ProgramMicrocredentialController;
use App\Http\Controllers\SuperAdmin\AdminInstrukturController;

use App\Http\Controllers\Instruktur\KursusController as InstrukturKursusController;
use App\Http\Controllers\Instruktur\KontenController;
use App\Http\Controllers\Instruktur\MingguController;
use App\Http\Controllers\Instruktur\EvaluasiController;
use App\Http\Controllers\Peserta\SertifikatController;
use App\Http\Controllers\Peserta\KursusController as PesertaKursusController;
use App\Http\Controllers\Peserta\KuisController as PesertaKuisController;
use App\Http\Controllers\Peserta\TugasController as PesertaTugasController;
use App\Http\Controllers\Peserta\PendaftaranController as PesertaPendaftaranController;
use App\Http\Controllers\AdminMicrocredential\KursusController as AdminKursusController;
use App\Http\Controllers\AdminMicrocredential\ProgramController as AdminProgramController;
use App\Http\Controllers\AdminMicrocredential\VerifikasiController as AdminVerifikasiController;
use App\Http\Controllers\Peserta\RatingKursusController;
use App\Models\JenisMicrocredential;
use App\Models\Semester;
use App\Models\ProgramMicrocredential;
use App\Models\Pengguna;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    // 1. CEK GUEST (PENCEGAHAN DOUBLE LOGIN)
    // Jika ada user yang sudah terlanjur login mencoba mengakses halaman '/login' lagi,
    // kita cegah mereka melihat form login dan langsung kita 'lemparkan' kembali ke dasbornya.
    if (Auth::check()) {
        $role = Auth::user()->role;
        if ($role === 'peserta') return redirect('/peserta/dasbor');
        if ($role === 'instruktur') return redirect('/instruktur/dasbor');
        if ($role === 'admin_microcredential') return redirect('/admin/dasbor');
        if ($role === 'super_admin') return redirect('/super-admin/dasbor');
    }

    // 2. TAMPILKAN FORM
    // Jika belum login sama sekali, barulah kita tampilkan halaman form login.
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', function () {
    return view('register');
})->name('register.process');

Route::get('/cek-akun', [\App\Http\Controllers\CekAkunController::class, 'index'])->name('cek-akun');
Route::post('/cek-akun', [\App\Http\Controllers\CekAkunController::class, 'check'])->name('cek-akun.process');

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/', [homeController::class, 'index'])->name('index');
Route::get('/tentang', fn() => view('tentang'))->name('tentang');
Route::get('/instruktur', [instrukturController::class, 'instruktur'])->name('instruktur.public.index');

/*
|--------------------------------------------------------------------------
| PROGRAM
|--------------------------------------------------------------------------
*/
Route::get('/program/{id}', [\App\Http\Controllers\ProgramPublicController::class, 'show'])->name('program.public.show');
Route::post('/program/{id}/daftar', [\App\Http\Controllers\ProgramPublicController::class, 'daftar'])->name('program.public.daftar');

Route::prefix('program')->name('program.')->group(function () {
    Route::get('/', [programController::class, 'index'])->name('index');
    Route::get('/saya', fn() => view('programsaya'))->name('saya');
    // Deprecated old pendaftaran route
    // Route::get('/pendaftaran', fn() => view('pendaftaran'))->name('pendaftaran');
});

/*
|--------------------------------------------------------------------------
| INSTRUKTUR
|--------------------------------------------------------------------------
*/

Route::prefix('instruktur')->name('instruktur.')->middleware('check.session:instruktur')->group(function () {

    Route::get('/dasbor', [App\Http\Controllers\Instruktur\DasborController::class, 'index'])->name('dasbor');
    Route::get('/profil', [ProfilController::class, 'show'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::post('/profil/check-username', [ProfilController::class, 'checkUsername'])->name('profil.checkUsername');

    // Kursus
    Route::get('/kursus', [InstrukturKursusController::class, 'index'])->name('kursus.index');
    Route::get('/kursus/{kursus}', [InstrukturKursusController::class, 'show'])->name('kursus.show');

    // Konten CRUD (materi, tugas, kuis)
    Route::get('/kursus/{kursus}/konten/create', [KontenController::class, 'create'])->name('kursus.konten.create');
    Route::post('/kursus/{kursus}/konten', [KontenController::class, 'store'])->name('kursus.konten.store');
    Route::get('/kursus/{kursus}/konten/{tipe}/{id}/edit', [KontenController::class, 'edit'])->name('kursus.konten.edit');
    Route::put('/kursus/{kursus}/konten/{tipe}/{id}', [KontenController::class, 'update'])->name('kursus.konten.update');
    Route::delete('/kursus/{kursus}/konten/{tipe}/{id}', [KontenController::class, 'destroy'])->name('kursus.konten.destroy');

    // Minggu management (AJAX)
    Route::put('/kursus/{kursus}/minggu/{minggu}', [MingguController::class, 'update'])->name('kursus.minggu.update');
    Route::post('/kursus/{kursus}/minggu/{minggu}/reorder', [MingguController::class, 'reorderMateri'])->name('kursus.minggu.reorder');

    // Toggle visibility minggu
    Route::patch('/kursus/{kursus}/minggu/{minggu}/toggle', [KontenController::class, 'toggleMinggu'])->name('kursus.minggu.toggle');

    // Evaluasi (F014)
    Route::get('/tugas', [EvaluasiController::class, 'tugasList'])->name('tugas');
    Route::get('/evaluasi/tugas/{jawabanTugas}', [EvaluasiController::class, 'tugasDetail'])->name('evaluasi.tugas.detail');
    Route::post('/evaluasi/tugas/{jawabanTugas}/nilai', [EvaluasiController::class, 'storeNilaiTugas'])->name('evaluasi.tugas.nilai');
    Route::get('/evaluasi/tugas/workspace/{tugas}', [EvaluasiController::class, 'tugasWorkspace'])->name('evaluasi.tugas.workspace');
    Route::post('/evaluasi/tugas/workspace/{tugas}/nilai/{pendaftaran}', [EvaluasiController::class, 'storeNilaiWorkspaceTugas'])->name('evaluasi.tugas.workspace.nilai');

    Route::get('/evaluasi/kuis', [EvaluasiController::class, 'kuisList'])->name('evaluasi.kuis');
    Route::get('/evaluasi/kuis/{sesiKuis}', [EvaluasiController::class, 'kuisDetail'])->name('evaluasi.kuis.detail');
    Route::post('/evaluasi/kuis/{sesiKuis}/nilai', [EvaluasiController::class, 'storeNilaiKuis'])->name('evaluasi.kuis.nilai');
    Route::get('/evaluasi/kuis/workspace/{kuis}', [EvaluasiController::class, 'kuisWorkspace'])->name('evaluasi.kuis.workspace');
    Route::post('/evaluasi/kuis/workspace/{kuis}/nilai/{pendaftaran}', [EvaluasiController::class, 'storeNilaiWorkspaceKuis'])->name('evaluasi.kuis.workspace.nilai');
});

/*

|--------------------------------------------------------------------------

| PESERTA

|--------------------------------------------------------------------------

*/

Route::prefix('peserta')->name('peserta.')->middleware('check.session:peserta')->group(function () {



    Route::get('/dasbor', fn() => view('peserta.dasbor'))->name('dasbor');



    Route::get('/kursus', [PesertaKursusController::class, 'index'])->name('kursus');

    Route::get('/kursus/{kursus}', [PesertaKursusController::class, 'show'])->name('kursus.show');

    Route::post('/kursus/{kursus}/materi/{materi}/viewed', [PesertaKursusController::class, 'markMateriViewed'])->name('kursus.materi.viewed');



    // Kuis (F017)

    Route::get('/kuis/{kuis}', [PesertaKuisController::class, 'show'])->name('kuis.show');

    Route::post('/kuis/{kuis}/submit', [PesertaKuisController::class, 'submit'])->name('kuis.submit');



    // Tugas (F017)

    Route::get('/tugas/{tugas}', [PesertaTugasController::class, 'show'])->name('tugas.show');

    Route::post('/tugas/{tugas}/submit', [PesertaTugasController::class, 'submit'])->name('tugas.submit');

    Route::get('/profil', [ProfilController::class, 'show'])->name('profil');

    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

    Route::post('/profil/check-username', [ProfilController::class, 'checkUsername'])->name('profil.checkUsername');



    /*

    |--------------------------------------------------------------------------

    | Rating Kursus

    |--------------------------------------------------------------------------

    */



    Route::get('/ulasan/{id}', [RatingKursusController::class, 'create'])

        ->name('ulasan.create');



    Route::post('/ulasan', [RatingKursusController::class, 'store'])

        ->name('ulasan.store');



    Route::get('/tugas', [PesertaTugasController::class, 'index'])->name('tugas');

    Route::get(
        '/sertifikat/{id}',
        [SertifikatController::class, 'show']
    )->name('sertifikat.show');



    // Pendaftaran Program (F009 - Peserta mendaftar ke Program Microcredential)

    Route::get('/pendaftaran', [PesertaPendaftaranController::class, 'index'])->name('pendaftaran.index');

    Route::post('/pendaftaran/{programId}', [PesertaPendaftaranController::class, 'store'])->name('pendaftaran.store');

    Route::get('/riwayat-pendaftaran', [PesertaPendaftaranController::class, 'riwayat'])->name('pendaftaran.riwayat');
});

/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('super-admin')->name('superAdmin.')->middleware('check.session:super_admin')->group(function () {
    Route::get('/dasbor', function () {
        $jenisMicrocredentials = JenisMicrocredential::orderBy('dibuat_pada', 'desc')->take(4)->get();
        $semesters = Semester::orderBy('dibuat_pada', 'desc')->take(3)->get();
        $programs = ProgramMicrocredential::with(['jenisMicrocredential', 'semester'])->orderBy('dibuat_pada', 'desc')->get();
        $adminInstrukturs = Pengguna::whereIn('role', ['admin_microcredential', 'instruktur'])->orderBy('dibuat_pada', 'desc')->get();
        return view('superAdmin.dasbor', compact('jenisMicrocredentials', 'semesters', 'programs', 'adminInstrukturs'));
    })->name('dasbor');
    Route::get('/profil', [ProfilController::class, 'show'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::post('/profil/check-username', [ProfilController::class, 'checkUsername'])->name('profil.checkUsername');

    // Admin Microcredential & Instruktur CRUD (F004 + F005)
    Route::get('/admin-instruktur', [AdminInstrukturController::class, 'index'])->name('adminInstruktur');
    Route::post('/admin-instruktur', [AdminInstrukturController::class, 'store'])->name('adminInstruktur.store');
    Route::put('/admin-instruktur/{id}', [AdminInstrukturController::class, 'update'])->name('adminInstruktur.update');
    Route::delete('/admin-instruktur/{id}', [AdminInstrukturController::class, 'destroy'])->name('adminInstruktur.destroy');

    // Jenis Microcredential CRUD
    Route::get('/jenis-microcredential', [JenisMicrocredentialController::class, 'index'])->name('jenisMicrocredential');
    Route::post('/jenis-microcredential', [JenisMicrocredentialController::class, 'store'])->name('jenisMicrocredential.store');
    Route::put('/jenis-microcredential/{id}', [JenisMicrocredentialController::class, 'update'])->name('jenisMicrocredential.update');
    Route::delete('/jenis-microcredential/{id}', [JenisMicrocredentialController::class, 'destroy'])->name('jenisMicrocredential.destroy');

    // Program Microcredential CRUD
    Route::get('/program-microcredential', [ProgramMicrocredentialController::class, 'index'])->name('programMicrocredential');
    Route::post('/program-microcredential', [ProgramMicrocredentialController::class, 'store'])->name('programMicrocredential.store');
    Route::put('/program-microcredential/{id}', [ProgramMicrocredentialController::class, 'update'])->name('programMicrocredential.update');
    Route::delete('/program-microcredential/{id}', [ProgramMicrocredentialController::class, 'destroy'])->name('programMicrocredential.destroy');

    // Semester CRUD
    Route::get('/semester', [SemesterController::class, 'index'])->name('semester');
    Route::post('/semester', [SemesterController::class, 'store'])->name('semester.store');
    Route::put('/semester/{id}', [SemesterController::class, 'update'])->name('semester.update');
    Route::delete('/semester/{id}', [SemesterController::class, 'destroy'])->name('semester.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN MICRO
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('check.session:admin_microcredential')->group(function () {
    Route::get('/dasbor', function () {
        $admin = Auth::user()->adminMicrocredential;

        // Find programs assigned to this admin (via id_admin_microcredential, fallback to id_jenis_microcredential)
        $programs = collect();
        if ($admin) {
            $query = \App\Models\ProgramMicrocredential::with('jenisMicrocredential');
            $query->where('id_admin_microcredential', $admin->id);
            $programs = $query->get();
        }
        $programIds = $programs->pluck('id')->toArray();

        $totalKursus = \App\Models\Kursus::whereIn('id_program_microcredential', $programIds)->count();
        $pendingVerifikasi = \App\Models\Pendaftaran::whereIn('id_program_microcredential', $programIds)
            ->where('status', 'menunggu')->count();

        $kursusList = \App\Models\Kursus::with(['programMicrocredential', 'instruktur.pengguna'])
            ->whereIn('id_program_microcredential', $programIds)
            ->latest('dibuat_pada')->take(4)->get()
            ->map(fn($k) => [
                'name' => $k->nama,
                'instruktur' => $k->instruktur->map(fn($i) => $i->pengguna->nama ?? '-')->implode(', ') ?: '-',
            ])->values();

        $pendaftaranList = \App\Models\Pendaftaran::with(['peserta.pengguna', 'programMicrocredential'])
            ->whereIn('id_program_microcredential', $programIds)
            ->where('status', 'menunggu')
            ->latest('dibuat_pada')->take(3)->get()
            ->map(fn($p) => [
                'name' => $p->peserta->pengguna->nama ?? '-',
                'course' => $p->programMicrocredential->nama ?? '-',
                'initial' => mb_strtoupper(mb_substr($p->peserta->pengguna->nama ?? '?', 0, 1)),
            ])->values();

        return view('admin.dasbor', compact('totalKursus', 'pendingVerifikasi', 'kursusList', 'pendaftaranList', 'programs'));
    })->name('dasbor');
    Route::get('/profil', [ProfilController::class, 'show'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::post('/profil/check-username', [ProfilController::class, 'checkUsername'])->name('profil.checkUsername');

    // Program Akademik
    Route::get('/program', [AdminProgramController::class, 'index'])->name('program.index');

    // Kursus CRUD dalam Program (F007 - Admin menambah banyak kursus ke 1 program)
    Route::get('/program/{id}/kursus', [AdminKursusController::class, 'index'])->name('program.kursus.index');
    Route::post('/program/{id}/kursus', [AdminKursusController::class, 'store'])->name('program.kursus.store');
    Route::put('/program/{id}/kursus/{kursus}', [AdminKursusController::class, 'update'])->name('program.kursus.update');
    Route::delete('/program/{id}/kursus/{kursus}', [AdminKursusController::class, 'destroy'])->name('program.kursus.destroy');

    // Verifikasi Pendaftaran (F008 - Admin meninjau/menyetujui/menolak pendaftaran peserta)
    Route::get('/verifikasi', [AdminVerifikasiController::class, 'index'])->name('verifikasi.index');
    Route::post('/verifikasi/{id}', [AdminVerifikasiController::class, 'verify'])->name('verifikasi.verify');
});
