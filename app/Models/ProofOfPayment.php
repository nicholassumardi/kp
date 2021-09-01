<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProofOfPayment extends Model
{
    use HasFactory;
    protected $table = 'bukti_pembayaran';
    protected $primaryKey = 'id_bukti_pembayaran';
    protected $guarded = [];
}
