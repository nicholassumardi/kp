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


    public function jadwal()
    {
        return $this->hasMany(Schedules::class, 'kursus_id', 'id_kursus');
    }
}
