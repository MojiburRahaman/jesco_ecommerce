@extends('frontend.master')
@section('content')


<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Shop</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<style>
    .rotate {
        -moz-transition: all 1s linear;
        -webkit-transition: all 1s linear;
        transition: all 1s linear;
    }

    .rotate.down {
        -ms-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }

</style>


<!-- breadcrumb-area end -->

<!-- Cart Area Start -->
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            @if (session('warning'))
            <div class="alert alert-warning  fade show" role="alert">
                <strong>
                    {{session('warning')}}
                </strong>
            </div>
            @endif

            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form method="post" action="{{route('CartClear')}}">
                    @csrf
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Until Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                            $total_cart_amount = 0;
                            @endphp
                            <tbody class="load">
                                @forelse ($Carts as $cart)
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="{{route('SingleProductView',$cart->Product->slug)}}">
                                            <img class="img-responsive ml-15px"
                                                src="{{asset('thumbnail_img/'.$cart->Product->thumbnail_img)}}"
                                                alt="{{$cart->Product->title}}" />
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a href="{{route('SingleProductView',$cart->Product->slug)}}">
                                            {{$cart->Product->title}}
                                        </a>
                                    </td>
                                    <td>{{$cart->Color->color_name}}</td>
                                    <td>{{$cart->Size->size_name}}</td>
                                    <td class="product-price-cart"><span class="amount">৳
                                            @php
                                            $Attribute =$cart->Product->Attribute
                                            ->where('color_id',$cart->color_id)
                                            ->where('size_id',$cart->size_id);
                                            foreach ($Attribute as $key => $value) {
                                            $regular_price =$value->regular_price;
                                            $sell_price = $value->sell_price;
                                            }
                                            @endphp
                                            {{($sell_price == '')? $regular_price : $sell_price}}
                                        </span></td>
                                    <td class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box cart_quantity" type="text"
                                                name="qtybutton" value="{{$cart->quantity}}" />
                                        </div>
                                    </td>
                                    <td class="product-subtotal">৳
                                        <span class="sub_product_total">
                                            @php
                                            if($sell_price == '')
                                            {
                                            $total_cart_amount +=$regular_price*$cart->quantity ;
                                            echo $regular_price*$cart->quantity;
                                            }
                                            else{
                                            $total_cart_amount += $sell_price*$cart->quantity;
                                            echo $sell_price*$cart->quantity;
                                            }
                                            @endphp
                                        </span>
                                    </td>
                                    <td class="product-remove">
                                        <a class="pointer" title="Update Item"><i data-id="{{$cart->id}}"
                                                class="rotate fa fa-refresh"></i></a>
                                        <a href="{{route('CartDelete',$cart->id)}}" title="Delete Item"><i
                                                class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <td colspan="10">No Item In Your Cart</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="#">Continue Shopping</a>
                                </div>
                                <div class="cart-clear">

                                    <button style="background-color: #fb5d5d;color:white">Clear Shopping Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    
                    <div class="col-lg-6 col-md-6 mb-lm-30px" id="coupon_section">
                        <div class="discount-code-wrapper">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                            </div>
                            <div class="discount-code">
                                <p>Enter your coupon code if you have one.</p>
                                <input id="coupon_name" type="text" required="" name="name" value="{{$coupon_name}}" />
                                <button style="background-color: #fb5d5d;
                                color:white;
                                    font-size: 14px;
                                    font-weight: 600;
                                    line-height: 1;
                                    padding: 18px 63px 17px;
                                    text-transform: uppercase;" id="coupon_submit_btn" type="submit">Apply
                                    Coupon</button>
                            </div>
                            @if (session('coupon_invalid'))
                            <span class="text-danger">{{session('coupon_invalid')}}</span>
                            @endif
                        </div>

                    </div>
                    <div class="col-lg-6 pl-4 col-md-12 mt-md-30px">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                            </div>
                            <h5>Total products <span>৳
                                    <span class="subtotal">{{$total_cart_amount}}</span>
                                </span></h5>
                            <h5>Discount ({{$discount}}%)<span>৳
                                    <span class="discount">{{round(($total_cart_amount*$discount)/100)}}</span>
                                </span></h5>
                           
                            <h4 class="grand-totall-title">Sub Total <span>৳<span
                                        class="total">{{round($total_cart_amount - ($total_cart_amount*$discount)/100)}}</span></span>
                            </h4>

                            @php
                            session()->put('cart_total',$total_cart_amount);
                            session()->put('coupon_name',$coupon_name);
                            session()->put('cart_discount',round(($total_cart_amount * $discount)/100));
                            session()->put('cart_subtotal',round($total_cart_amount - ($total_cart_amount *
                            $discount)/100));
                            @endphp


                            <a href="{{route('CheckoutView')}}">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cart Area End -->

@endsection
@section('script_js')
<script>
    $(".rotate").click(function(){
    $(this).toggleClass("down"); 
        var ele = $(this);
        var sub_total = $('.subtotal').html();
        var cart_id = $(this).attr('data-id');
              $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                     }),
            $.ajax({
                type: "POST",
            url:"/cart/quantity-update",
           data:{
               cart_id:cart_id, 
               cart_quantity:ele.parents("tr").find(".cart_quantity").val()
               },
           success: function(res) {
                    if (res) {
                     ele.parents("tr").find('.sub_product_total').html(res);
                   var quantity =  ele.parents("tr").find('.singlesub_price').attr('data-quantity');
                   ele.parents("tr").find(".cart_quantity").val(quantity);
                $(".subtotal").load(location.href + " .subtotal");
                $(".discount").load(location.href + " .discount");
                $(".total").load(location.href + " .total");

                    }
                }
            })
    });


    $(document).ready(function(){
        $('#coupon_submit_btn').click(function(){
            var coupon_name_test = $('#coupon_name').val();
            var coupon_redirect_url = " {{route('CartView')}}/" + coupon_name_test;
    window.location.href = coupon_redirect_url;
    });
    
    });

</script>

@endsection