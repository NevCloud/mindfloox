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
        "dihitung_pada",
    ];

    protected $casts = [
        "nilai_akhir" => "decimal:2",
        "dihitung_pada" => "datetime",
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
    }
    
    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'id_kursus');
    }

    public function ditentukanOleh()
    {
        return $this->belongsTo(Instruktur::class, 'ditentukan_oleh');
    }
}
