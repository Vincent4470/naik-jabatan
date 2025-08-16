<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pegawai extends Model
{
    use HasFactory;

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
        'tanggal_mulai',
        'id_atasan_langsung',
    ];

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    public function atasanLangsung(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'id_atasan_langsung', 'id_pegawai');
    }

    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi', 'id_provinsi');
    }

    public function kota(): BelongsTo
    {
        return $this->belongsTo(KotaKabupaten::class, 'id_kota_kabupaten', 'id_kota_kabupaten');
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id_kecamatan');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_pegawai', 'id_pegawai');
    }

    public function pengajuan(): HasMany
    {
        return $this->hasMany(PengajuanKenaikan::class, 'id_pegawai', 'id_pegawai');
    }
}
