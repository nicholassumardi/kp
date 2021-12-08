<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbstrakUmum extends Model
{
    use HasFactory;
    protected $table = 'abstrak_umum';
    protected $primaryKey = 'id_abstrak_umum';
    protected $guarded = [];

    public function umum()
    {
        return $this->belongsTo(Umum::class, 'umum_id', 'id_umum');
    }
}