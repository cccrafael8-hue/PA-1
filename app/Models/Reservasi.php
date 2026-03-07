<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'tanggal',
        'waktu',
        'jumlah_orang',
        'total_bayar',
        'status'
    ];
}