<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KursusInstruktur extends Model
{
    protected $table = "kursus_instruktur";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_kursus",
        "id_instruktur",
    ];

}
