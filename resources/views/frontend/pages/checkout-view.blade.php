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
                    <li class="breadcrumb-item active">Checkout</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->
<style>
    .order_btn {
        background-color: #fb5d5d;
        color: #fff;
        display: block;
        font-weight: 700;
        letter-spacing: 1px;
        line-height: 1;
        padding: 18px 20px;
        text-align: center;
        text-transform: uppercase;
        border-radius: 0;
        z-index: 9;
        width: 100%;
    }

</style>

<!-- checkout area start -->
<div class="checkout-area pt-100px pb-100px">
    <div class="container">
        <form action="{{route('CheckoutPost')}}" method="POST">
            @csrf
        <div class="row">
                <div class="col-lg-7">
                    <div class="billing-info-wrap">
                        <h3>Billing Details</h3>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <h5>Something is wrong with this field!</h5>
                            @foreach ($errors->all() as $err_msg)
                            <li>{{$err_msg}}</li>
                            @endforeach
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Billing User Name</label>
                                    <input type="text" class="form-control @error('billing_user_name') is-invalid
                                @enderror" name="billing_user_name" value="{{old('billing_user_name')}}"
                                        autocomplete="none" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label>Email</label>
                                    <input type="email" class="form-control @error('user_email') is-invalid
                                @enderror" name="user_email" value="{{old('user_email')}}" autocomplete="none"
                                        placeholder="Email" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="billing-select mb-4">
                                    <label>Division</label>
                                    <select class="division form-control @error('division_name') is-invalid
                                @enderror" id="divisions_name" name="division_name">
                                        <option>Select One</option>
                                        @foreach ($divisions as $division)

                                        <option value="{{$division->id}}">{{$division->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="billing-select mb-4">
                                    <label>Division</label>
                                    <select class="district form-control @error('disctrict_name') is-invalid
                                @enderror" id="disctrict_name" name="district_name">

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="billing-select mb-4">
                                    <label>Division</label>
                                    <select class="upozila  form-control @error('upozila_name') is-invalid
                                @enderror" id="upozila_name" name="upozila_name">

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Phone</label>
                                    <input value="{{old('billing_number')}}" autocomplete="none" type="number"
                                        placeholder="Billing Number" name="billing_number" class="form-control @error('billing_number') is-invalid
                                @enderror" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label>Billing Address</label>
                                    <textarea name="billing_address" class="form-control @error('billing_address') is-invalid
                                @enderror"></textarea>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <label>Email Address</label>
                                <input type="text" />
                            </div>
                        </div> --}}
                        </div>

                        {{-- <div class="additional-info-wrap">
                            <h4>Additional information</h4>
                            <div class="additional-info">
                                <label>Order notes</label>
                                <textarea placeholder="Notes about your order, e.g. special notes for delivery. "
                                    name="message"></textarea>
                            </div>
                        </div> --}}

                    </div>
                </div>
                <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                    <div class="your-order-area">
                        <h3>Your order</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-product-info">
                                <div class="your-order-top">
                                    <ul>
                                        <li>Product</li>
                                        <li>Total</li>
                                    </ul>
                                </div>
                                <div class="your-order-middle">
                                    <ul>
                                        @foreach (cart_product_view() as $cart)

                                        <li><span class="order-middle-left">{{$cart->Product->title}} X
                                                {{$cart->quantity}}</span> <span class="order-price">৳
                                                @php
                                                $Attribute =$cart->Product->Attribute
                                                ->where('color_id',$cart->color_id)
                                                ->where('size_id',$cart->size_id);
                                                foreach ($Attribute as $key => $value) {
                                                $regular_price =$value->regular_price;
                                                $sell_price = $value->sell_price;
                                                }
                                                @endphp
                                                {{($sell_price == '')? $regular_price*$cart->quantity : $sell_price*$cart->quantity}}
                                            </span></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="your-order-bottom">
                                    <ul>
                                        <li class="your-order-shipping">Total</li>
                                        <li>৳ <span id="cart_total">{{session()->get('cart_total')}}</span></li>
                                    </ul>
                                </div>
                                <div class="your-order-bottom">
                                    <ul>
                                        <li class="your-order-shipping">Discount</li>
                                        <li>৳ <span id="discount">{{session()->get('cart_discount')}}</span></li>
                                    </ul>
                                </div>
                                <div class="your-order-bottom">
                                    <ul>
                                        <li class="your-order-shipping">Shipping</li>
                                        <li>৳ <span id="shipping_id">0</span></li>
                                    </ul>
                                </div>
                                <div class="your-order-total">
                                    <ul>
                                        <li class="order-total">Sub Total</li>
                                        <li>৳ <span id="sub_total">{{session()->get('cart_subtotal')}}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion element-mrg">
                                    <div id="faq" class="panel-group">
                                        {{-- <div class="panel panel-default single-my-account m-0">
                                        <div class="panel-heading my-account-title">
                                            <h4 class="panel-title"><a data-bs-toggle="collapse" href="#my-account-1"
                                                    class="collapsed" aria-expanded="true">Direct bank transfer</a>
                                            </h4>
                                        </div>
                                        <div id="my-account-1" class="panel-collapse collapse show"
                                            data-bs-parent="#faq">

                                            <div class="panel-body">
                                                <p>Please send a check to Store Name, Store Street, Store Town,
                                                    Store State / County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div> --}}
                                        <div class="">
                                            <input style="height: 0px;width:0px;margin-top:10px" type="checkbox"
                                                name="payment_option" id="cash_on_delivery" value="cash_on_delivery">
                                            <label style="padding-bottom: 15px" for="cash_on_delivery">Cash On
                                                Delivery</label>
                                            <br>
                                            <input style="height: 0px;width:0px;margin-top:10px" type="checkbox"
                                                name="payment_option" id="paid" value="paid">
                                            <label style="padding-bottom: 15px" for="paid">Pay Now</label>
                                            {{-- <div class="panel-heading my-account-title">
                                            <h4 class="panel-title"><a data-bs-toggle="collapse" href="#my-account-2"
                                                    aria-expanded="false" class="collapsed">Check payments</a></h4>
                                        </div>
                                        <div id="my-account-2" class="panel-collapse collapse" data-bs-parent="#faq">

                                            <div class="panel-body">
                                                <p>Please send a check to Store Name, Store Street, Store Town,
                                                    Store State / County, Store Postcode.</p>
                                            </div>
                                        </div> --}}
                                        </div>
                                        {{-- <div class="panel panel-default single-my-account m-0">
                                        <div class="panel-heading my-account-title">
                                            <h4 class="panel-title"><a data-bs-toggle="collapse"
                                                    href="#my-account-3">Cash on delivery</a></h4>
                                        </div>
                                        <div id="my-account-3" class="panel-collapse collapse" data-bs-parent="#faq">

                                            <div class="panel-body">
                                                <p>Please send a check to Store Name, Store Street, Store Town,
                                                    Store State / County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Place-order mt-25">
                            <button class="btn-hover order_btn" >Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- checkout area end -->
@endsection

@section('script_js')
<script>
    $(document).ready(function() {
    $('.division').select2();
    $('.district').select2();
    $('.upozila').select2();
});




$('#divisions_name').change(function(){
var division_id = $(this).val();

if (division_id) {
   
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        }),
            $.ajax({
                type: 'POST',
                url: '/checkout/billing/division_id' ,
                data :{division_id: division_id},

                success: function(res) {
                    if (res) {
                        $("#upozila_name").empty();
                        $("#disctrict_name").empty();
                        $("#disctrict_name").append('<option value=>Select One</option>');
                        $.each(res, function(key, value) {
                            $("#disctrict_name").append('<option value="' + value.id + '" >' +
                                value.name + '</option>');
                        });

                    } else {
                        $("disctrict_name").empty();
                    }
                }
            });
        }
        else{
            $("#disctrict_name").empty();
            $("#upozila_name").empty();
            $('#shipping_id').html(0);

        }
    });

// #### get district information by division end


// #### get upozila information by district start 

        $('#disctrict_name').change(function(){
        var disctrict_id = $(this).val();
        var total_amount = {{session()->get('cart_subtotal')}};
        if (!disctrict_id == '') {
           if (disctrict_id == 47) {
               $('#shipping_id').html(60);
               @php
                   session()->put('shipping',60);
               @endphp
               $('#sub_total').html(60 + parseInt(total_amount));
            }
            else{
                @php
                   session()->put('shipping',120);
               @endphp
                $('#shipping_id').html(120)
                $('#sub_total').html(120 + parseInt(total_amount));
                
           }
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                     }),
            $.ajax({
                type: "POST",
                url: 'checkout/billing/disctrict_id',
                data:{district_id: disctrict_id},

                success: function(res) {
                    if (res) {
                        $("#upozila_name").empty();
                        $("#upozila_name").append('<option>Select One</option>');
                        $.each(res, function(key, value) {
                            $("#upozila_name").append('<option value="' + value.id + '" >' +
                                value.name + '</option>');
                        });

                    } else {
                        $("upozila_name").empty();
                    }
                }
            });
        } else{
            $('#sub_total').html(parseInt(total_amount));
            $("#upozila_name").empty();
            $('#shipping_id').html(0);


        }
    });
// #### get upozila information by district end 



</script>

@endsection