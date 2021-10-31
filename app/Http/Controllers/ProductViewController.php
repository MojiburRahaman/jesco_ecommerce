<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Http\Request;

class ProductViewController extends Controller
{
    function SingleProductView($slug)
    {
        $Product = Product::with(['Attribute','Catagory.Product:id,title,slug,thumbnail_img,catagory_id', 'Catagory:id,catagory_name,slug', 'Gallery:product_id,product_img', 'Attribute.Color:color_name,id', 'Attribute.Size:id,size_name',])
            ->where('slug', $slug)
            ->where('status', 1)
            ->select('id', 'title', 'product_summary', 'product_description', 'slug', 'catagory_id')
            ->first();
        $color = $Product->Attribute->where('color_id', '!=', 1)->count();
        $size = $Product->Attribute->where('size_id', '!=', 1)->count();
        return view('frontend.pages.product-view', [
            'product' => $Product,
            'color' => $color,
            'size' => $size,
        ]);
    }
    function GetSizeByColor(Request $request)
    {
        $Attr = '';
        $Attribute = Attribute::with('Size')
            ->where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)
            ->select('id', 'size_id', 'quantity', 'sell_price', 'regular_price')->get();
        foreach ($Attribute as  $value) {
            $sell_price  =  $value->sell_price;
            if ($value->size_id != 1) {

                
                $Attr = $Attr . ' <input style="width:5%" class="size_name" type="radio" data-regular_price="' . $value->regular_price . '" data-sell_price="' . $sell_price . '" 
                name="size_id" id="size_id ' . $value->size_id . '" data-quantity="' . $value->quantity . '"
                value="' . $value->size_id . '" data-product="' . $value->product_id . '">
                <label style="padding-top:12px;padding-left:5px" for="size_id ' . $value->size_id . '">' . $value->Size->size_name . '</label> &nbsp; &nbsp;';
            }
            if ($value->size_id == 1) {
                // if size attribute not available in this color
                $Attr = $Attr . '<span class="quantityadd" data-sellprice="' . $sell_price . '" data-regularprice="' . $value->regular_price . '" >' . $value->quantity . '</span>';
            }
        }
        return response()->json($Attr);
    }
    function GetPriceBySize(Request $request)
    {
        $Attr = '';
        $Attribute = Attribute::where('product_id', $request->product_id)
            ->where('size_id', $request->size_id)
            ->where('color_id', 1)
            ->select('id', 'quantity', 'sell_price', 'regular_price')
            ->get();
        foreach ($Attribute as  $value) {
            $sell_price  =  $value->sell_price;
            $Attr = $Attr . '<span class="quantityadd" data-sellprice="' . $sell_price . '" data-regularprice="' . $value->regular_price . '" >' . $value->quantity . '</span>';
        }
        return response()->json($Attr);
    }
}
