<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MateriPembelajaran extends Model
{
    protected $table = "materi_pembelajaran";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_kursus",
        "id_kursus_instruktur",
        "judul",
        "tipe",
        "url_file",
    ];

}
