<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function CategorySearch($slug, Request $request)
    {
        $search = $slug;
        $category = Catagory::where('slug', $search)->select('id', 'catagory_name')->first();
        $Products = Product::query();
        if ($request->name == 'asc') {
            # code...
            $Products = Product::with('Catagory:id,catagory_name,slug', 'Attribute', 'Gallery:product_img,product_id')
                ->where('catagory_id', $category->id)
                ->orderBy('title', 'asc')->paginate(20);
        } elseif ($request->name == 'desc') {
            $Products = Product::with('Catagory:id,catagory_name,slug', 'Attribute', 'Gallery:product_img,product_id')
                ->where('catagory_id', $category->id)
                ->orderBy('title', 'desc')->paginate(20);
        }else {
            
            $Products = Product::with('Catagory:id,catagory_name,slug', 'Attribute', 'Gallery:product_img,product_id')
                ->where('catagory_id', $category->id)
                ->orderBy('title', 'asc')->paginate(20);
        }
        $categories = Catagory::select('slug', 'id', 'catagory_name')->withcount('Product')->latest()->get();
        return view('frontend.pages.category-wise-product', [
            'products' => $Products,
            'catagories' => $categories,
            'category' => $category,
            'search' => $search,
        ]);
    }
}
