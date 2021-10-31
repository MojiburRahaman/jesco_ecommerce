<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    // use BelongsToThrough;
    function Attribute(){
        return $this->belongsTo(Attribute::class, 'size_id');
    }
    function Cart(){
        return $this->hasMany(Cart::class, 'size_id');
    }
}
