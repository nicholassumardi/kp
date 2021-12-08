<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalUmum extends Model
{
    use HasFactory;
    protected $table = 'jurnal_umum';
    protected $primaryKey = 'id_jurnal_umum';
    protected $guarded = [];

    public function umum()
    {
        return $this->belongsTo(Umum::class, 'umum_id', 'id_umum');
    }
}
