<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PertanyaanKuis extends Model
{
    protected $table = "pertanyaan_kuis";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_kuis",
        "teks_pertanyaan",
        "tipe_pertanyaan",
    ];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'id_kuis');
    }

    public function pilihanJawaban()
    {
        return $this->hasMany(PilihanJawaban::class, 'id_pertanyaan');
    }

    public function kunciJawabanEsai()
    {
        return $this->hasMany(KunciJawabanEsai::class, 'id_pertanyaan');
    }

    public function jawabanKuis()
    {
        return $this->hasMany(JawabanKuis::class, 'id_pertanyaan');
    }
}
