<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Cart;
use App\Models\Attribute;
use Illuminate\Support\Str;

class CartController extends Controller
{
    function CartView()
    {
        $carts = Cart::with(['Product', 'Product.Attribute', 'Color', 'Size'])->Where('cookie_id', Cookie::get('cookie_id'))->get();
        return view('frontend.pages.cart', [
            'Carts' => $carts,
        ]);
    }

    function CartPost(Request $request)
    {
        // return $request;
        session()->forget('cart_total');
        $request->validate([
            'color_id' => ['required',],
            'size_id' => ['required',]
        ], [
            'color_id.required' => 'Please Choose a Color',
            'size_id.required' => 'Please Choose a Size'
        ]);
        if ($request->hasCookie('cookie_id')) {
            // if user has cookie
            $cookie_id_generate = $request->cookie('cookie_id');
        } else {
            // if user dont have cookie
            $cookie_id_generate = time() . Str::random(10);
            Cookie::queue('cookie_id', $cookie_id_generate, 43200);
        }
        $product_already_add = Cart::Where('cookie_id', Cookie::get('cookie_id'))->Where('color_id', $request->color_id)->Where('product_id', $request->product_id)->Where('size_id', $request->size_id);
        if ($product_already_add->exists()) {
            // checking the product already added if added then update the quantitiy
            Cart::Where('cookie_id', Cookie::get('cookie_id'))
                ->Where('color_id', $request->color_id)
                ->Where('product_id', $request->product_id)
                ->Where('size_id', $request->size_id)
                ->increment('quantity', $request->cart_quantity);
            return back();
        }
        // new data add
        $cart = new Cart;
        $cart->cookie_id = $cookie_id_generate;
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->cart_quantity;
        $cart->color_id = $request->color_id;
        $cart->size_id = $request->size_id;
        $cart->save();
        return back();
    }
    function CartUpdate(Request $request)
    {
        $cart = Cart::findorfail($request->cart_id);
        $cart->quantity = $request->cart_quantity;
        $cart->save();

        $Attr = Attribute::where('product_id', $cart->product_id)
            ->where('color_id', $cart->color_id)
            ->where('size_id', $cart->size_id)
            ->select('regular_price', 'sell_price')->first();
        if ($Attr->sell_price != '') {
            $price = $Attr->sell_price;
        } else {
            $price = $Attr->regular_price;
        }
        // return $price*$request->cart_quantity;
        // return $price*$cart->quantity;
        $html = '<span class="singlesub_price" data-quantity="' . $request->cart_quantity . '">' . $price * $request->cart_quantity . '</span>';
        return response()->json($html);
    }
    function CartDelete($id){
        Cart::findorfail($id)->delete();
        return back();
    }
}
