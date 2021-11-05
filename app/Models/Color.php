<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    function Attribute()
    {
        return $this->hasMany(Attribute::class, 'color_id');
    }
    function Cart()
    {
        return $this->hasMany(Cart::class, 'color_id');
    }
    function Wishlist()
    {
        return $this->hasMany(Wishlist::class, 'color_id');
    }
}
