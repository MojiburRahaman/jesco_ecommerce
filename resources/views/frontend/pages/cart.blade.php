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
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
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
                                    {{-- <td class="product-price-cart"><span class="amount">{{$cart->Attribute($cart->color_id,$cart->size_id,$cart->product_id)}}</span>
                                    </td> --}}
                                    <td class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box cart_quantity" type="text"
                                                name="qtybutton" value="{{$cart->quantity}}" />
                                        </div>
                                    </td>
                                    <td class="product-subtotal">৳
                                        {{-- {{$cart->cart_quantity}} --}}
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
                                        <a class="pointer"><i data-id="{{$cart->id}}"
                                                class="rotate fa fa-refresh"></i></a>
                                        <a href="{{route('CartDelete',$cart->id)}}"><i class="fa fa-times"></i></a>
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
                                    {{-- <button>Update Shopping Cart</button> --}}
                                    <a href="#">Clear Shopping Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-lm-30px">
                        <div class="cart-tax">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                            </div>
                            <div class="tax-wrapper">
                                <p>Enter your destination to get a shipping estimate.</p>
                                <div class="tax-select-wrapper">
                                    <div class="tax-select">
                                        <label>
                                            * Country
                                        </label>
                                        <select class="email s-email s-wid">
                                            <option>Bangladesh</option>
                                            <option>Albania</option>
                                            <option>Åland Islands</option>
                                            <option>Afghanistan</option>
                                            <option>Belgium</option>
                                        </select>
                                    </div>
                                    <div class="tax-select">
                                        <label>
                                            * Region / State
                                        </label>
                                        <select class="email s-email s-wid">
                                            <option>Bangladesh</option>
                                            <option>Albania</option>
                                            <option>Åland Islands</option>
                                            <option>Afghanistan</option>
                                            <option>Belgium</option>
                                        </select>
                                    </div>
                                    <div class="tax-select mb-25px">
                                        <label>
                                            * Zip/Postal Code
                                        </label>
                                        <input type="text" />
                                    </div>
                                    <button class="cart-btn-2" type="submit">Get A Quote</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-lm-30px">
                        <div class="discount-code-wrapper">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                            </div>
                            <div class="discount-code">
                                <p>Enter your coupon code if you have one.</p>
                                <form>
                                    <input type="text" required="" name="name" />
                                    <button class="cart-btn-2" type="submit">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mt-md-30px">
                        <div class="grand-totall">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                            </div>
                            <h5>Total products <span>৳
                                    <span class="subtotal">{{$total_cart_amount}}</span>
                                </span></h5>
                            <div class="total-shipping">
                                <h5>Total shipping</h5>
                                <ul>
                                    <li><input type="checkbox" /> Standard <span>$20.00</span></li>
                                    <li><input type="checkbox" /> Express <span>$30.00</span></li>
                                </ul>
                            </div>
                            <h4 class="grand-totall-title">Grand Total <span>$260.00</span></h4>
                            <a href="checkout.html">Proceed to Checkout</a>
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

                    }
                }
            })

    });

</script>

@endsection