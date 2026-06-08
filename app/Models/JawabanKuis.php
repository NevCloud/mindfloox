<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanKuis extends Model
{
    protected $table = "jawaban_kuis";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_sesi_kuis",
        "id_pertanyaan",
        "id_pilihan_jawaban",
        "teks_jawaban",
    ];

}
