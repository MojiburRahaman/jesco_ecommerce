<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
   use HasFactory;
   function Product()
   {
      return $this->belongsTo(Product::class, 'product_id');
   }
   function Color()
   {
      return   $this->belongsTo(Color::class, 'color_id');
   }
   function Size()
   {
      return $this->belongsTo(Size::class, 'size_id');
   }
   function Attribute($color, $size, $product)
   {
      return Attribute::where('color_id', $color)
         ->where('size_id', $size)
         ->where('product_id', $product)
         ->select('regular_price', 'sell_price')->first();
   }
}
