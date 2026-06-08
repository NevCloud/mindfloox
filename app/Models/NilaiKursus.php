<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiKursus extends Model
{
    protected $table = "nilai_kursus";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_pendaftaran",
        "id_kursus",
        "nilai_akhir",
        "status_lulus",
        "ditentukan_oleh",
        "catatan_instruktur",
        "dihitung_pada",
    ];

    protected $casts = [
        "nilai_akhir" => "decimal:2",
        "status_lulus" => "boolean",
        "dihitung_pada" => "datetime",
    ];

}
