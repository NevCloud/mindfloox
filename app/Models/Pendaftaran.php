<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = "pendaftaran";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_peserta",
        "id_program_microcredential",
        "status",
        "catatan_admin",
        "tanggal_daftar",
        "tanggal_verifikasi",
        "diverifikasi_oleh",
    ];

    protected $casts = [
        "tanggal_daftar" => "datetime",
        "tanggal_verifikasi" => "datetime",
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta');
    }

    public function programMicrocredential()
    {
        return $this->belongsTo(ProgramMicrocredential::class, 'id_program_microcredential');
    }

    public function diverifikasiOleh()
    {
        return $this->belongsTo(AdminMicrocredential::class, 'diverifikasi_oleh');
    }

    public function sertifikatKursus()
    {
        return $this->hasOne(SertifikatKursus::class, 'id_pendaftaran');
    }

    public function sesiKuis()
    {
        return $this->hasMany(SesiKuis::class, 'id_pendaftaran');
    }

    public function jawabanTugas()
    {
        return $this->hasMany(JawabanTugas::class, 'id_pendaftaran');
    }

    public function nilaiTugas()
    {
        return $this->hasMany(NilaiTugas::class, 'id_pendaftaran');
    }

    public function nilaiKursus()
    {
        return $this->hasMany(NilaiKursus::class, 'id_pendaftaran');
    }

    public function ulasanKursus()
    {
        return $this->hasMany(UlasanKursus::class, 'id_pendaftaran');
    }
}
