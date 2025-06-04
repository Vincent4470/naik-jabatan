<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_users';
    protected $primaryKey = 'id_role';
    public $timestamps = true;

    protected $fillable = ['nama_role'];

    public function users()
    {
        return $this->hasMany(User::class, 'id_role');
    }
}
