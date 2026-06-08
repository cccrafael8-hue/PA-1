<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'menu',
        'total',
        'status',
        'note',
        'is_hidden'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}