<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'user_id');
    }

    public function berita()
    {
        return $this->hasMany(News::class, 'admin_id', 'id_admin');
    }
}
