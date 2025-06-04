<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $primaryKey = 'id_penilaian';
    protected $fillable = ['id_pengajuan', 'id_user_admin', 'hasil_penilaian', 'tanggal_penilaian'];

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanKenaikan::class, 'id_pengajuan');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_user_admin');
    }
}
