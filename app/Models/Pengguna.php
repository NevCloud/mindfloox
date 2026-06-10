<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    protected $table = "pengguna";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    protected $fillable = [
        'nama',
        'username',
        'email',
        'kata_sandi',
        'role',
        'aktif',
        'foto_profil',
        'nomor_telepon',
        'alamat',
        'tanggal_lahir',
        'x',
        'facebook',
        'linkedin',
        'instagram',
    ];

    protected $casts = [
        "tanggal_lahir" => "date"
    ];

    public function superAdmin()
    {
        return $this->hasOne(SuperAdmin::class, 'id_pengguna');
    }

    public function adminMicrocredential()
    {
        return $this->hasOne(AdminMicrocredential::class, 'id_pengguna');
    }

    public function instruktur()
    {
        return $this->hasOne(Instruktur::class, 'id_pengguna');
    }

    public function peserta()
    {
        return $this->hasOne(Peserta::class, 'id_pengguna');
    }
}
