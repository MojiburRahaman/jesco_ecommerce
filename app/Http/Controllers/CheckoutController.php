<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Attribute;
use App\Models\Order_Details;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use App\Models\billing_details;
use App\Models\Order_Summaries;
use Illuminate\Support\Carbon;
use App\Models\Coupon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    function CheckoutView()
    {
        
        if (!session()->get('cart_total')) {
            return back();
        }
        return view('frontend.pages.checkout-view', [
            'divisions' => Division::select('id', 'name')->get(),
        ]);
    }
    function CheckoutajaxDivid(Request $request)
    {
        $request->validate([
            'division_id'=>['required','numeric'],
        ]);
        $district = District::where('division_id', $request->division_id)
            ->select('id', 'name')->get();
        return response()->json($district);
    }
    function CheckoutajaxDistrictid(Request $request)
    {
        $request->validate([
            'district_id'=>['required','numeric'],
        ]);
        $district = Upazila::where('district_id', $request->district_id)
            ->select('id', 'name')->get();
        return response()->json($district);
    }
    function CheckoutPost(Request $request)
    {
        if (!session()->get('cart_total')) {
            return redirect('/');
        }
        $request->validate([
            'billing_user_name' => ['required', 'string', 'max:255'],
            'division_name' => ['required','numeric'],
            'district_name' => ['required','numeric'],
            'upozila_name' => ['required','numeric'],
            'billing_address' => ['required'],
            'billing_number' => ['required'],
            'payment_option' => ['required'],
            ]);
            if ($request->district_name == 47) {
                session()->flash('shipping', 60);
            } else {
                session()->flash('shipping', 120);
            }

            $order_number = now()->format('dm') . Auth::id() . mt_rand(1, 1000);

        $billing_details = billing_details::insertGetId($request->except('_token') + [
            'created_at' => now(),
            'user_id' => Auth::id(),
            'user_email' =>  auth()->user()->email,
        ]);
        $Order_Summaries_id = Order_Summaries::insertGetId([
            'billing_details_id' => $billing_details,
            'user_id' => Auth::id(),
            'order_number' => $order_number,
            'coupon_name' => session()->get('coupon_name'),
            'total' => session()->get('cart_total'),
            'subtotal' => session()->get('cart_subtotal') + session()->get('shipping'),
            'discount' => session()->get('cart_discount'),
            'shipping' => session()->get('shipping'),
            'created_at' => now(),
        ]);
        $carts = Cart::Where('cookie_id', Cookie::get('cookie_id'))->get();
        foreach ($carts as  $cart) {
            Order_Details::insert([
                'Order_Summaries_id' => $Order_Summaries_id,
                'product_id' => $cart->product_id,
                'color_id' => $cart->color_id,
                'size_id' => $cart->size_id,
                'quantity' => $cart->quantity,
                'created_at' =>now(),
            ]);
            attribute::where([
                'product_id' => $cart->product_id,
                'color_id' => $cart->color_id,
                'size_id' => $cart->size_id,
            ])->decrement('quantity', $cart->quantity);
            $cart->delete();
        }
        if (session()->get('coupon_name')) {
            Coupon::where('coupon_name', session()->get('coupon_name'))->decrement('coupon_limit', 1);
        }
        session()->forget('cart_total');
        session()->forget('coupon_name');
        session()->forget('cart_discount');
        session()->forget('cart_subtotal');
        session()->forget('shipping');
        return redirect('/')->with('orderPlace', $order_number);
    }
    function PayNow(Request $request){
        if (!session()->get('cart_total')) {
            return redirect('/');
        }
    // return    $order_number = now()->format('dm') . Auth::id() . mt_rand(1, 1000);
        $request->validate([
            'billing_user_name' => ['required', 'string', 'max:255'],
            'division_name' => ['required','numeric'],
            'district_name' => ['required','numeric'],
            'upozila_name' => ['required','numeric'],
            'billing_address' => ['required'],
            'billing_number' => ['required'],
            'payment_option' => ['required'],
            ]);
            // return $request;
            if ($request->district_name == 47) {
            session()->put('shipping', 60);
        } else {
            session()->put('shipping', 120);
        }

        session()->put('billing_info', $request->except('_token'));
        session()->put('cookie_id', Cookie::get('cookie_id'));
        return redirect()->route('pay');
    }
}
