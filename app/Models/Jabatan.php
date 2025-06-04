<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $primaryKey = 'id_jabatan';
    protected $fillable = ['nama_jabatan', 'level'];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_jabatan');
    }

    public function pengajuanJabatanBaru()
    {
        return $this->hasMany(PengajuanKenaikan::class, 'id_jabatan_baru');
    }
}
