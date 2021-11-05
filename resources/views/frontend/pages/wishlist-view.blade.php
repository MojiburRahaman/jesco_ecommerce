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
                    <li class="breadcrumb-item active">Wishlist</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<style>
    .add_cart_btn {
        background-color: #fb5d5d;
        border-radius: 0;
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        line-height: 1;
        padding: 10px 12px;
        text-transform: uppercase;
    }

</style>
<!-- Wishlist Area Start -->
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        @if (session('cart_added'))
            <div class="alert alert-success  fade show" role="alert">
                <strong>
                    {{session('cart_added')}}
                </strong>
            </div>
            @endif
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
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
                                <th>Add To Cart</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($wish_lists as $wish_list)
                            <tr>
                                <form action="{{route('CartPost')}}" method="POST">
                                    @csrf
                                    <td class="product-thumbnail">
                                        <a href="{{route('SingleProductView',$wish_list->Product->slug)}}">
                                            <img class="img-responsive ml-15px"
                                                src="{{asset('thumbnail_img/'.$wish_list->Product->thumbnail_img)}}"
                                                alt="{{$wish_list->Product->title}}" />
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a href="{{route('SingleProductView',$wish_list->Product->slug)}}">
                                            {{$wish_list->Product->title}}
                                        </a>
                                    </td>
                                    <td>{{$wish_list->Color->color_name}}</td>
                                    <td>{{$wish_list->Size->size_name}}</td>
                                    <td class="product-price-cart">
                                        <span class="amount">৳
                                            @php
                                            $Attribute =$wish_list->Product->Attribute
                                            ->where('color_id',$wish_list->color_id)
                                            ->where('size_id',$wish_list->size_id);
                                            foreach ($Attribute as $key => $value) {
                                            $regular_price =$value->regular_price;
                                            $sell_price = $value->sell_price;
                                            }
                                            @endphp
                                            {{($sell_price == '')? $regular_price : $sell_price}}
                                        </span>
                                    </td>
                                    <input type="hidden" name="product_id" value="{{$wish_list->product_id}}">
                                    <input type="hidden" name="color_id" value="{{$wish_list->color_id}}">
                                    <input type="hidden" name="size_id" value="{{$wish_list->size_id}}">
                                    <input type="hidden" name="wish_list_id" value="{{$wish_list->id}}">
                                    <td class="product-quantity">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="cart_quantity"
                                                value="{{$wish_list->quantity}}" />
                                        </div>
                                    </td>
                                    <td class="product-subtotal">৳
                                        @php
                                        if($sell_price == '')
                                        {
                                        echo $regular_price*$wish_list->quantity;
                                        }
                                        else{
                                        echo $sell_price*$wish_list->quantity;
                                        }
                                        @endphp
                                    </td>
                                    <td class="product-wishlist-cart">
                                        <button class="add_cart_btn">add to cart</button>
                                    </td>
                                    <td class="product-remove">
                                        <a href="{{route('WishlistRemove',$wish_list->id)}}" title="Delete Item">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </form>
                            </tr>
                            @empty
                            <td colspan="10">No item in your wishlist</td>
                            @endforelse
                                 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Wishlist Area End -->
@endsection