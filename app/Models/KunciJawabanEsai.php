<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KunciJawabanEsai extends Model
{
    protected $table = "kunci_jawaban_esai";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_pertanyaan",
        "teks_kunci",
        "case_sensitive",
    ];

    protected $casts = [
        "case_sensitive" => "boolean",
    ];

}
