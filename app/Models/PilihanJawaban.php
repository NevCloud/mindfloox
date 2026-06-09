<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PilihanJawaban extends Model
{
    protected $table = "pilihan_jawaban";

    public $timestamps = false;

    protected $fillable = [
        "id_pertanyaan",
        "teks_pilihan",
        "adalah_benar",
    ];

    protected $casts = [
        "adalah_benar" => "boolean",
    ];

    public function pertanyaanKuis()
    {
        return $this->belongsTo(PertanyaanKuis::class, 'id_pertanyaan');
    }

    public function jawabanKuis()
    {
        return $this->hasMany(JawabanKuis::class, 'id_pilihan_jawaban');
    }
}
