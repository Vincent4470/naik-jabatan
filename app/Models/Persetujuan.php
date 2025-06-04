<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persetujuan extends Model
{
    protected $primaryKey = 'id_persetujuan';
    protected $fillable = [
        'id_pengajuan',
        'id_user_atasan',
        'keputusan',
        'catatan',
        'tanggal_persetujuan'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanKenaikan::class, 'id_pengajuan');
    }

    public function atasan()
    {
        return $this->belongsTo(User::class, 'id_user_atasan');
    }
}
