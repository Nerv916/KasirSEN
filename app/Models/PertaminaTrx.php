<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PertaminaTrx extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_bbm',
        'liter',
        'harga_per_liter',
        'total'
    ];
}
