<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanKuis extends Model
{
    protected $table = "jawaban_kuis";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_sesi_kuis",
        "id_pertanyaan",
        "id_pilihan_jawaban",
        "teks_jawaban",
    ];

    public function sesiKuis()
    {
        return $this->belongsTo(SesiKuis::class, 'id_sesi_kuis');
    }

    public function pertanyaanKuis()
    {
        return $this->belongsTo(PertanyaanKuis::class, 'id_pertanyaan');
    }

    public function pilihanJawaban()
    {
        return $this->belongsTo(PilihanJawaban::class, 'id_pilihan_jawaban');
    }
}
