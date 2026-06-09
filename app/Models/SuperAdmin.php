<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    protected $table = "super_admin";

    const CREATED_AT = "dibuat_pada";
    const UPDATED_AT = "diperbarui_pada";

    protected $fillable = [
        "id_pengguna"
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    public function adminYangDibuat()
    {
        return $this->hasMany(AdminMicrocredential::class, 'id_dibuat_oleh');
    }

    public function instrukturYangDibuat()
    {
        return $this->hasMany(Instruktur::class, 'id_dibuat_oleh');
    }
}
