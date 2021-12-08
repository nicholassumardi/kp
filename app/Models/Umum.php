<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umum extends Model
{
    protected $table = 'umum';
    protected $primaryKey = 'id_umum';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
    public function kursus()
    {
        return $this->belongsToMany(Course::class, 'detail_kursus_umum', 'umum_id', 'kursus_id')
            ->withPivot('path_foto_kuitansi', 'path_foto_umum', 'status_verifikasi', 'komentar','no_kartu_umum', 'created_at', 'updated_at');
    }

    public function abstrak()
    {
        return $this->hasMany(AbstrakUmum::class, 'umum_id', 'id_umum');
    }

    public function transkripnilai()
    {
        return $this->hasMany(TranskripNilaiUmum::class, 'umum_id', 'id_umum');
    }
    
    public function ijazah()
    {
        return $this->hasMany(IjazahUmum::class, 'umum_id', 'id_umum');
    }
    public function jurnal()
    {
        return $this->hasMany(JurnalUmum::class, 'umum_id', 'id_umum');
    }

    // public function kursus()
    // {
    //     return $this->belongsToMany(Course::class, 'detail_kursus', 'mahasiswa_id', 'kursus_id')
    //         ->withPivot('path_foto_kuitansi', 'path_foto_mahasiswa', 'status_verifikasi', 'komentar','no_kartu_mahasiswa', 'created_at', 'updated_at');
    // }
}
