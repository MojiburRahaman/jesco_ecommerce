<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function CategorySearch($slug)
    {
        // return $slug;
        $search = $slug;
        $category = Catagory::where('slug', $search)->select('id', 'catagory_name')->first();
        $Products = Product::with('Catagory:id,catagory_name,slug', 'Attribute', 'Gallery:product_img,product_id')
            ->where('catagory_id', $category->id)
            ->latest()->    paginate(20);
        $categories = Catagory::select('slug', 'id', 'catagory_name')->withcount('Product')->latest()->get();
        return view('frontend.pages.category-wise-product', [
            'products' => $Products,
            'catagories' => $categories,
            'category' => $category,
            'search' => $search,
        ]);
    }
}
