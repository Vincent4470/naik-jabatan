<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteriaPenilaian extends Model
{
    use HasFactory;

    protected $table = 'sub_kriteria_penilaians';
    protected $primaryKey = 'id_sub_kriteria';
    protected $fillable = ['id_kriteria', 'nama_pilihan', 'nilai'];

    public function kriteriaPenilaian()
    {
        return $this->belongsTo(KriteriaPenilaian::class, 'id_kriteria', 'id_kriteria');
    }
}
