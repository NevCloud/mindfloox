<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{
    protected $table = "kursus";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_program_microcredential",
        "nama",
        "deskripsi",
        "nilai_kelulusan_kursus",
    ];

    protected $casts = [
        "nilai_kelulusan_kursus" => "decimal:2",
    ];

}
