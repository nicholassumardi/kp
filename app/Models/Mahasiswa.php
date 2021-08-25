<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'user_id');
    }
}
