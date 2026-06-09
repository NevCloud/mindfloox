<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisMicrocredential extends Model
{
    protected $table = "jenis_microcredential";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "nama",
        "deskripsi"
    ];

    public function adminMicrocredential()
    {
        return $this->hasMany(AdminMicrocredential::class, 'id_jenis_microcredential');
    }

    public function programMicrocredential()
    {
        return $this->hasMany(ProgramMicrocredential::class, 'id_jenis_microcredential');
    }
}
