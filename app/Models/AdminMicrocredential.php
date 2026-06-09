<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminMicrocredential extends Model
{
    protected $table = "admin_microcredential";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_jenis_microcredential",
        "id_dibuat_oleh",
        "id_pengguna",
    ];
    
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    public function pembuat()
    {
        return $this->belongsTo(SuperAdmin::class, 'id_dibuat_oleh');
    }

    public function jenisMicrocredential()
    {
        return $this->belongsTo(JenisMicrocredential::class, 'id_jenis_microcredential');
    }

    public function pendaftaranYangDiverifikasi()
    {
        return $this->hasMany(Pendaftaran::class, 'diverifikasi_oleh');
    }

    public function pesertaYangDiaktifkan()
    {
        return $this->hasMany(Peserta::class, 'diaktifkan_oleh');
    }
}
