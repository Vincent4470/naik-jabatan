<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPengajuan extends Model
{
    protected $primaryKey = 'id_status';
    protected $fillable = ['nama_status'];

    public function pengajuans()
    {
        return $this->hasMany(PengajuanKenaikan::class, 'id_status');
    }

    public function logs()
    {
        return $this->hasMany(PengajuanStatusLog::class, 'id_status');
    }
}
