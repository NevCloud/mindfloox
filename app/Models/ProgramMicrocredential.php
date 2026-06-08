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
        'nama',
        'deskripsi',
        'foto_program',
        'status_pendaftaran',
    ];

}
