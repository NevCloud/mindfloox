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

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
    }

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'id_kuis');
    }

    public function jawabanKuis()
    {
        return $this->hasMany(JawabanKuis::class, 'id_sesi_kuis');
    }

    public function nilaiKuis()
    {
        return $this->hasOne(NilaiKuis::class, 'id_sesi_kuis');
    }
}
