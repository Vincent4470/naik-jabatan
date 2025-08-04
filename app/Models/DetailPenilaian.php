<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenilaian extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model.
     *
     * @var string
     */
    protected $table = 'detail_penilaians';

    /**
     * Primary key untuk model.
     *
     * @var string
     */
    protected $primaryKey = 'id_detail_penilaian';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_penilaian',
        'id_kriteria',
        'nilai',
        'catatan',
    ];

    /**
     * Mendapatkan data penilaian induk dari detail ini.
     */
    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class, 'id_penilaian', 'id_penilaian');
    }

    /**
     * Mendapatkan data kriteria dari detail ini.
     */
    public function kriteria()
    {
        return $this->belongsTo(KriteriaPenilaian::class, 'id_kriteria', 'id_kriteria');
    }
}
