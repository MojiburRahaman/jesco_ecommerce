<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    function Catagory()
    {
        return $this->belongsTo(Catagory::class, 'catagory_id');
    }
    function Subcatagory()
    {
        return $this->belongsTo(Subcatagory::class, 'catagory_id');
    }
    function WithTrash_Attribute()
    {
        return $this->hasMany(Attribute::class, 'product_id')->withTrashed();
    }
    function Attribute()
    {
        return $this->hasMany(Attribute::class, 'product_id');
    }
    function Gallery()
    {
        return $this->hasMany(Gallery::class, 'product_id');
    }
    function Cart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }
    function Wishlist()
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }
   
}
