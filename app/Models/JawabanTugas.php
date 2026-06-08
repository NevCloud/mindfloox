<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanTugas extends Model
{
    protected $table = "jawaban_tugas";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_pendaftaran",
        "id_tugas",
        "url_file",
        "status",
        "disubmit_pada",
    ];

    protected $casts = [
        "disubmit_pada" => "datetime",
    ];

}
