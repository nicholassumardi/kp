<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    use HasFactory;
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';
    protected $guarded = [];
    
    
    public function kursus()
    {
        return $this->belongsTo(Course::class, 'kursus_id', 'id_kursus');
    }

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'detail_kursus', 'jadwal_id', 'mahasiswa_id')
            ->withPivot('kursus_id', 'path_foto_kuitansi', 'path_foto_mahasiswa', 'path_foto_sertifikat', 'status_verifikasi', 'komentar', 'created_at', 'updated_at');
    }
}
