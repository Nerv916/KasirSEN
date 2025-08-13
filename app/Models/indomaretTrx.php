<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class indomaretTrx extends Model
{
    protected $fillable = ['user_id', 'nama_barang', 'qty', 'harga', 'total'];
}
