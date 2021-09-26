<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abstrak extends Model
{
    use HasFactory;
    protected $table = 'abstrak';
    protected $primaryKey = 'id_abstrak';
    protected $guarded = [];
}
