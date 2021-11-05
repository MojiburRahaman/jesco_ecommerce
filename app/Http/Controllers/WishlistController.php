<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    function WishlistView()
    {
        $wish_lists = Wishlist::with(['Product.Attribute', 'Color:id,color_name', 'Size:id,size_name'])
            ->where('user_id', auth()->id())->get();
        return view('frontend.pages.wishlist-view', [
            'wish_lists' => $wish_lists,
        ]);
    }
    function WishlistPost(Request $request)
    {
        // return $request;
        $request->validate([
            'color_id' => ['required',],
            'size_id' => ['required',]
        ], [
            'color_id.required' => 'Please Choose a Color',
            'size_id.required' => 'Please Choose a Size'
        ]);
        $product_already_add = Wishlist::Where('user_id', auth()->id())->Where('color_id', $request->color_id)->Where('product_id', $request->product_id)->Where('size_id', $request->size_id);
        if ($product_already_add->exists()) {
            Wishlist::Where('user_id', auth()->id())
                ->Where('color_id', $request->color_id)
                ->Where('product_id', $request->product_id)
                ->Where('size_id', $request->size_id)
                ->increment('quantity', $request->cart_quantity);
            return back();
        }
        $wish_list = new Wishlist;
        $wish_list->user_id = auth()->id();
        $wish_list->product_id = $request->product_id;
        $wish_list->color_id = $request->color_id;
        $wish_list->size_id = $request->size_id;
        $wish_list->quantity = $request->cart_quantity;
        $wish_list->save();
        return back();
    }
    function WishlistRemove($id)
    {
        Wishlist::findorfail($id)->delete();
        return back();
    }
}
