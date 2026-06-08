<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = "peserta";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_pengguna",
        "akses_aktif",
        "diaktifkan_oleh",
        "minat"
    ];

    protected $casts = [
        "akses_aktif" => "boolean",
        'diaktifkan_pada' => 'datetime',
    ];

}
