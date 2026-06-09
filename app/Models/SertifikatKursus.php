<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SertifikatKursus extends Model
{
    protected $table = "sertifikat_kursus";

    const CREATED_AT = 'dibuat_pada';
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

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
    }
}
