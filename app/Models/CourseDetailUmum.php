<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDetailUmum extends Model
{
    protected $table = 'detail_kursus_umum';
    protected $guarded = [];


    public function umum()
    {
        return $this->belongsTo(Umum::class, 'umum_id', 'id_umum');
    }
    
    public function kursus()
    {
        return $this->belongsTo(Course::class, 'kursus_id', 'id_kursus');
    }

}
