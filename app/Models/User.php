<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $guarded = [];

    public function admin()
    {
        return $this->hasMany(Admin::class, 'user_id', 'id_user');
    }
    
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'user_id', 'id_user');
    }
}
