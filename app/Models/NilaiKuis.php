<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiKuis extends Model
{
    protected $table = "nilai_kuis";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_sesi_kuis",
        "nilai_mentah",
        "dihitung_pada",
    ];

    protected $casts = [
        "nilai_mentah" => "decimal:2",
        "dihitung_pada" => "datetime",
    ];

}
