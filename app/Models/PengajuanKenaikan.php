<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanKenaikan extends Model
{
    protected $primaryKey = 'id_pengajuan';
    protected $fillable = [
        'id_pegawai',
        'id_jabatan_baru',
        'tanggal_pengajuan',
        'id_status',
        'catatan'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function jabatanBaru()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan_baru');
    }

    public function status()
    {
        return $this->belongsTo(StatusPengajuan::class, 'id_status');
    }

    public function dokumen()
    {
        return $this->hasMany(DokumentPengajuan::class, 'id_pengajuan');
    }

    public function penilaian()
    {
        return $this->hasOne(Penilaian::class, 'id_pengajuan');
    }

    public function persetujuan()
    {
        return $this->hasOne(Persetujuan::class, 'id_pengajuan');
    }

    public function logStatus()
    {
        return $this->hasMany(PengajuanStatusLog::class, 'id_pengajuan');
    }
}
