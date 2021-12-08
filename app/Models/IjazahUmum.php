<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IjazahUmum extends Model
{
    use HasFactory;
    protected $table = 'ijazah_umum';
    protected $primaryKey = 'id_ijazah_umum';
    protected $guarded = [];

    public function umum()
    {
        return $this->belongsTo(Umum::class, 'umum_id', 'id_umum');
    }
}
