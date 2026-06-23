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
        'id_semester',
        'id_admin_microcredential',
        'nama',
        'deskripsi',
        'foto_program',
        'status_pendaftaran',
    ];

    public function jenisMicrocredential()
    {
        return $this->belongsTo(JenisMicrocredential::class, 'id_jenis_microcredential');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester');
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
