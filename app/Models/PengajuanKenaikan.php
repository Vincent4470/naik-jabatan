<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PengajuanKenaikan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pengajuan';
    protected $fillable = [
        'id_pegawai',
        'id_jabatan_baru',
        'tanggal_pengajuan',
        'id_status',
        'id_periode',
        'catatan'
    ];

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function jabatanBaru(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan_baru', 'id_jabatan');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(StatusPengajuan::class, 'id_status', 'id_status');
    }

    public function dokumen(): HasMany
    {
        return $this->hasMany(DokumentPengajuan::class, 'id_pengajuan', 'id_pengajuan');
    }

    public function penilaian(): HasOne
    {
        return $this->hasOne(Penilaian::class, 'id_pengajuan', 'id_pengajuan');
    }

    public function persetujuan(): HasOne
    {
        return $this->hasOne(Persetujuan::class, 'id_pengajuan', 'id_pengajuan');
    }

    public function logStatus(): HasMany
    {
        return $this->hasMany(PengajuanStatusLog::class, 'id_pengajuan', 'id_pengajuan');
    }

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class, 'id_periode', 'id_periode');
    }
}
