<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $primaryKey = 'id_provinsi';
    protected $fillable = ['nama_provinsi'];

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class, 'id_provinsi');
    }
}
