<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jabatan';
    protected $fillable = ['nama_jabatan', 'level'];

    /**
     * Relasi ke Pegawai.
     * Nama fungsi harus jamak (pegawais) untuk relasi hasMany.
     */
    public function pegawais()
    {
        return $this->hasMany(Pegawai::class, 'id_jabatan', 'id_jabatan');
    }

    /**
     * Relasi ke PengajuanKenaikan.
     */
    public function pengajuanJabatanBaru()
    {
        return $this->hasMany(PengajuanKenaikan::class, 'id_jabatan_baru', 'id_jabatan');
    }
}
