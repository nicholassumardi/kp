<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseDetail extends Model
{
    protected $table = 'detail_kursus';
    protected $guarded = [];



    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id_mahasiswa');
    }
    
    public function kursus()
    {
        return $this->belongsTo(Course::class, 'kursus_id', 'id_kursus');
    }

   
}
