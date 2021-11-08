<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function Frontendhome(Request $request)
    {
        // return url()->previous();
        // return basename($_SERVER['HTTP_REFERER']);
        if ($request->search != '') {
            $search = strip_tags($request->search);
            $catagories =  Catagory::latest('catagory_name')
                ->select('catagory_name', 'id', 'slug')
                ->withcount('Product')
                ->get();
            $products = Product::where('title', 'LIKE', "%$search%")
                ->with('Catagory:id,catagory_name,slug', 'Attribute', 'Gallery:product_img,product_id')
                ->where('status', 1)->get();

            return view('frontend.pages.search', [
                'products' => $products,
                'search' => $search,
                'catagories' => $catagories,

            ]);
        }
        if ($request->search == '') {
            # code...
            $catagories = Catagory::with('Product.Attribute',)
                ->select('slug', 'id', 'catagory_name',)->latest('id')->get();
            $product = Product::with('Catagory:id,catagory_name,slug', 'Attribute', 'Gallery:product_img,product_id')
                ->where('status', 1)->latest()
                ->select('id', 'slug', 'catagory_id', 'thumbnail_img', 'product_summary', 'title')
                ->get();
            return view('frontend.main', [
                'latest_products' => $product,
                'catagories' => $catagories,
            ]);
        }
    }
    function Frontendshop()
    {
        // $catagories = Catagory::with('Product.Attribute', 'Product.Catagory')->select('slug', 'id', 'catagory_name',)->latest('id')->get();
        $product = Product::with('Catagory', 'Attribute', 'Gallery')->where('status', 1)
            ->select('id', 'slug', 'title', 'thumbnail_img', 'product_summary', 'catagory_id',)
            ->latest('id')->simplePaginate(20);
        return view('frontend.pages.shop', [
            // 'catagories' => $catagories,
            'products' => $product,
        ]);
    }
    function FrontendProfile()
    {
        return view('frontend.pages.profile');
    }
    // function SearchProduct(Request $request)
    // {
    //     $search = strip_tags($request->search);
    //     $products = Product::where('title', 'LIKE', "%$search%")
    //         ->where('status', 1)->get();

    //     return view('frontend.pages.search', [
    //         'products' => $products,
    //         'search' => $search,

    //     ]);
    // return $request->Search;

    // }
}
