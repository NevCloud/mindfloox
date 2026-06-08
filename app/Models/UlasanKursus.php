<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UlasanKursus extends Model
{
    protected $table = "ulasan_kursus";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_pendaftaran",
        "id_kursus",
        "id_kursus_instruktur",
        "komentar_kursus",
        "rating_kursus",
        "komentar_instruktur",
        "rating_instruktur",
    ];

}
