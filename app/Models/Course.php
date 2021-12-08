<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'kursus';
    protected $primaryKey = 'id_kursus';
    protected $guarded = [];


    // public function jadwal()
    // {
    //     return $this->hasMany(Schedules::class, 'kursus_id', 'id_kursus');
    // }

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'detail_kursus', 'kursus_id', 'mahasiswa_id')
            ->withPivot('path_foto_kuitansi', 'path_foto_mahasiswa', 'path_foto_sertifikat', 'status_verifikasi','no_kartu_mahasiswa', 'komentar', 'created_at', 'updated_at');
    }


    public function umum()
    {
        return $this->belongsToMany(Umum::class, 'detail_kursus_umum', 'kursus_id', 'umum_id')
            ->withPivot('path_foto_kuitansi', 'path_foto_umum', 'path_foto_sertifikat', 'status_verifikasi','no_kartu_umum', 'komentar', 'created_at', 'updated_at');
    }
    // public function jdwl()
    // {
    //     return $this->belongsToMany(Schedules::class, 'detail_kursus', 'kursus_id', 'jadwal_id')
    //         ->withPivot('jadwal_id', 'path_foto_kuitansi', 'path_foto_mahasiswa', 'status_verifikasi', 'komentar', 'created_at', 'updated_at');
    // }
}
