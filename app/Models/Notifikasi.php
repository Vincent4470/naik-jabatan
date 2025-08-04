<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    /**
     * Menonaktifkan auto-incrementing untuk primary key.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Menentukan tipe data dari primary key sebagai string (untuk UUID).
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Menentukan nama primary key.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'id_user_penerima',
        'judul',
        'pesan',
        'link',
        'waktu_dibaca',
    ];

    /**
     * Mendapatkan data user penerima notifikasi.
     */
    public function userPenerima()
    {
        return $this->belongsTo(User::class, 'id_user_penerima', 'id_user');
    }
}
