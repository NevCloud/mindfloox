<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PertanyaanKuis extends Model
{
    protected $table = "pertanyaan_kuis";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_kuis",
        "teks_pertanyaan",
        "tipe_pertanyaan",
    ];

}
