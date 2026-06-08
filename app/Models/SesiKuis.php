<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesiKuis extends Model
{
    protected $table = "sesi_kuis";

    public $timestamps = false;

    protected $fillable = [
        "id_pendaftaran",
        "id_kuis",
        "status",
        "dimulai_pada",
        "diselesaikan_pada",
    ];

    protected $casts = [
        "dimulai_pada" => "datetime",
        "diselesaikan_pada" => "datetime",
    ];

}
