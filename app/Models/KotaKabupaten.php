<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KotaKabupaten extends Model
{
    protected $primaryKey = 'id_kota_kabupaten';
    protected $fillable = ['nama_kota_kab'];

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class, 'id_kota_kabupaten');
    }
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }
    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class, 'id_kota_kabupaten');
    }
}
