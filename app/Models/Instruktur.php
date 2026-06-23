<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instruktur extends Model
{
    protected $table = "instruktur";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_dibuat_oleh",
        "id_pengguna",
        "keahlian",
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    public function pembuat()
    {
        return $this->belongsTo(SuperAdmin::class, 'id_dibuat_oleh');
    }

    public function kursus()
    {
        return $this->belongsToMany(Kursus::class, 'kursus_instruktur', 'id_instruktur', 'id_kursus');
    }

    public function kursusInstruktur()
    {
        return $this->hasMany(KursusInstruktur::class, 'id_instruktur');
    }

    public function nilaiKursusYangDitentukan()
    {
        return $this->hasMany(NilaiKursus::class, 'ditentukan_oleh');
    }

    public function tugasYangDinilai()
    {
        return $this->hasMany(NilaiTugas::class, 'dinilai_oleh');
    }

    public function getTotalPesertaAttribute()
    {
        $kiIds = $this->kursusInstruktur()->pluck('id')->toArray();
        $programIds = \App\Models\Kursus::whereIn('id', function($q) use ($kiIds) {
            $q->select('id_kursus')->from('kursus_instruktur')->whereIn('id', $kiIds);
        })->pluck('id_program_microcredential')->unique();

        return \App\Models\Pendaftaran::whereIn('id_program_microcredential', $programIds)
            ->where('status', 'diterima')
            ->count();
    }
}
