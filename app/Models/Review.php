<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rating',
        'comment',
        'admin_reply',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}