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
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function kursus()
    {
        return $this->belongsToMany(Course::class, 'detail_kursus', 'mahasiswa_id', 'kursus_id')
            ->withPivot('path_foto_kuitansi', 'path_foto_mahasiswa', 'status_verifikasi', 'komentar', 'created_at', 'updated_at');
    }

    public function abstrak()
    {
        return $this->hasMany(Abstrak::class, 'mahasiswa_id', 'id_mahasiswa');
    }

    public function transkripnilai()
    {
        return $this->hasMany(TranskripNilai::class, 'mahasiswa_id', 'id_mahasiswa');
    }
    
    public function ijazah()
    {
        return $this->hasMany(ijazah::class, 'mahasiswa_id', 'id_mahasiswa');
    }
}
