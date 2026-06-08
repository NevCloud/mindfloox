<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SertifikatKursus extends Model
{
    protected $table = "sertifikat_kursus";

    const UPDATED_AT = null;

    protected $fillable = [
        "id_pendaftaran",
        "nomor_sertifikat",
        "tanggal_terbit",
        "url_file",
    ];

    protected $casts = [
        "tanggal_terbit" => "date",
    ];

}
