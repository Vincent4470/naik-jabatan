<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaPenilaian extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model.
     *
     * @var string
     */
    protected $table = 'kriteria_penilaians';

    /**
     * Primary key untuk model.
     *
     * @var string
     */
    protected $primaryKey = 'id_kriteria';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_kriteria',
        'deskripsi',
        'bobot',
    ];
}
