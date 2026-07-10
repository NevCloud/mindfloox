<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramMicrocredential extends Model
{
    protected $table = "program_microcredential";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        'id_jenis_microcredential',
        'id_periode_pembelajaran',
        'id_admin_microcredential',
        'nama',
        'deskripsi',
        'foto_program',
        'status_pendaftaran',
        'tanggal_mulai_pendaftaran',
        'tanggal_akhir_pendaftaran',
    ];

    protected $casts = [
        'tanggal_mulai_pendaftaran' => 'date',
        'tanggal_akhir_pendaftaran' => 'date',
    ];

    public function jenisMicrocredential()
    {
        return $this->belongsTo(JenisMicrocredential::class, 'id_jenis_microcredential');
    }

    public function periodePembelajaran()
    {
        return $this->belongsTo(PeriodePembelajaran::class, 'id_periode_pembelajaran');
    }

    public function adminMicrocredential()
    {
        return $this->belongsTo(AdminMicrocredential::class, 'id_admin_microcredential');
    }

    public function kursus()
    {
        return $this->hasMany(Kursus::class, 'id_program_microcredential');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_program_microcredential');
    }
}
