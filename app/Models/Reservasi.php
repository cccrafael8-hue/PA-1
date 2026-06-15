<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservasi extends Model
{
    use SoftDeletes;

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