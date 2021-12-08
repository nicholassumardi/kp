<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranskripNilaiUmum extends Model
{
    use HasFactory;
    protected $table = 'transkrip_nilai_umum';
    protected $primaryKey = 'id_transkrip_nilai_umum';
    protected $guarded = [];

    public function umum()
    {
        return $this->belongsTo(Umum::class, 'umum_id', 'id_umum');
    }
}
