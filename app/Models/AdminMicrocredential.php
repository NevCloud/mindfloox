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
}
