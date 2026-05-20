<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'menu_id', 'qty', 'tipe'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
