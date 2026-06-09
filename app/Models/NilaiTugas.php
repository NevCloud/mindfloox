<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiTugas extends Model
{
    protected $table = "nilai_tugas";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_pendaftaran",
        "id_tugas",
        "nilai_mentah",
        "dinilai_oleh",
        "dinilai_pada",
    ];

    protected $casts = [
        "nilai_mentah" => "decimal:2",
        "dinilai_pada" => "datetime",
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_tugas');
    }

    public function dinilaiOleh()
    {
        return $this->belongsTo(Instruktur::class, 'dinilai_oleh');
    }
}
