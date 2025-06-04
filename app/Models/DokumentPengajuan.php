<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumentPengajuan extends Model
{
    protected $primaryKey = 'id_dokumen';
    protected $fillable = ['id_pengajuan', 'nama_dokumen', 'file_path'];

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanKenaikan::class, 'id_pengajuan');
    }
}
