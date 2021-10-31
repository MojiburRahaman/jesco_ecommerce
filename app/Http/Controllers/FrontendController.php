<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function Frontendhome()
    {
        $product = Product::with('Catagory', 'Attribute','Gallery:product_img,product_id')->where('status', 1)->latest()
            ->select('id', 'slug', 'catagory_id', 'thumbnail_img', 'product_summary','title')
            ->get();
        return view('frontend.main', [
            'latest_products' => $product,
        ]);
    }
    function Frontendshop()
    {
        $catagories = Catagory::with('Product.Attribute', 'Product.Catagory')->select('slug', 'id', 'catagory_name',)->latest('id')->get();
        $product = Product::with('Catagory', 'Attribute')->where('status', 1)
            ->select('id', 'slug', 'title', 'thumbnail_img', 'product_summary', 'catagory_id')
            ->latest('id')->simplePaginate(30);
        return view('frontend.pages.shop', [
            'catagories' => $catagories,
            'latest_product' => $product,
        ]);
    }
}
