<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $primaryKey = 'id_pegawai';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama',
        'nip',
        'tanggal_lahir',
        'email',
        'foto_profil',
        'alamat',
        'unit_kerja',
        'id_jabatan',
        'id_provinsi',
        'id_kota_kabupaten',
        'id_kecamatan',
        'tanggal_mulai'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }

    public function kota()
    {
        return $this->belongsTo(KotaKabupaten::class, 'id_kota_kabupaten');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_pegawai');
    }

    public function pengajuan()
    {
        return $this->hasMany(PengajuanKenaikan::class, 'id_pegawai');
    }
}
