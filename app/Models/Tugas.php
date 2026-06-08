<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = "tugas";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_kursus",
        "id_kursus_instruktur",
        "judul",
        "deskripsi",
        "nilai",
        "batas_waktu",
    ];

    protected $casts = [
        "nilai" => "decimal:2",
        "batas_waktu" => "datetime",
    ];

}
