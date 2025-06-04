<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanStatusLog extends Model
{
    protected $primaryKey = 'id_log';
    protected $fillable = [
        'id_pengajuan',
        'id_status',
        'id_user',
        'catatan',
        'waktu_status'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanKenaikan::class, 'id_pengajuan');
    }

    public function status()
    {
        return $this->belongsTo(StatusPengajuan::class, 'id_status');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
