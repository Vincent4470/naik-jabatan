<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $primaryKey = 'id_kecamatan';
    protected $fillable = ['nama_kecamatan'];

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class, 'id_kecamatan');
    }
}
