<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'date',
        'time',
        'guest_count',
        'items',
        'total_price',
        'status',
        'payment_proof',
    ];
}