@extends('frontend.master')
@section('title')
{{$product->title}}
@endsection
@section('meta_description')

@endsection
@section('content')

<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">{{$product->title}}</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{route('Frontendhome')}}">Home</a></li>
                    <li class="breadcrumb-item active">{{$product->title}}</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<!-- Product Details Area Start -->
<div class="product-details-area pt-100px pb-100px">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                <!-- Swiper -->
                <div class="swiper-container zoom-top">
                    <div class="swiper-wrapper">
                        @foreach ($product->Gallery as $galleries)

                        <div class="swiper-slide zoom-image-hover">
                            <img class="img-responsive m-auto" src="{{asset('product_image/'.$galleries->product_img)}}"
                                alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-container zoom-thumbs mt-3 mb-3">
                    <div class="swiper-wrapper">
                        @foreach ($product->Gallery as $galleries)

                        <div class="swiper-slide">
                            <img class="img-responsive m-auto" src="{{asset('product_image/'.$galleries->product_img)}}"
                                alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                <div class="product-details-content quickview-content">
                    <h2>{{$product->title}}</h2>
                    <div class="pricing-meta">
                        <ul>
                            @php
                            $regular_price =collect($product->Attribute)->min('regular_price');
                            $sell_price = collect($product->Attribute)->min('sell_price');
                            @endphp


                            @if ($sell_price != '')
                            <span class="new   ">৳
                                <span class="sell_Price">

                                    {{$sell_price}}
                                </span>
                            </span>
                            @endif
                            <span class="regular_Price_if_selling_null">
                            </span>
                            @if ($regular_price != '')
                            &nbsp; <span class="new regular_Price" {{($sell_price !=''
                                )? 'style=text-decoration:line-through' : '' }}>
                                ৳{{$regular_price}}
                            </span>
                            @endif
                            (<span class="available">{{ $product->Attribute->sum('quantity') }}</span>
                            &nbsp;Product
                            Available)
                        </ul>
                    </div>
                    <div class="pro-details-rating-wrap">
                        <div class="rating-product">

                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <span class="read-review"><a class="reviews" href="#">( 5 Customer Review )</a></span>
                    </div>
                    <form id="Form_submit" action="" method="POST">
                        @csrf
                        @if ($color != '')
                        <div class="pro-details-color-info d-flex align-items-center">
                            @php
                            $attribute = collect($product->Attribute);
                            $group = $attribute->unique('color_id')
                            @endphp

                            <span>Color:</span>
                            <div class="pro-details-color">
                                <ul>
                                    @foreach ($group as $color)

                                    @if ($color->color_id != 1)
                                    <input class=" {{($size == '')? 'no_size_color' : 'color_name'}}" type="radio"
                                        name="color_id" id="color_id{{$color->Color->id}}" value="{{$color->Color->id}}"
                                        data-product="{{$product->id}}">
                                    <label style="padding-top:12px;padding-left:5px"
                                        for="color_id{{$color->Color->id}}">{{$color->Color->color_name}}</label>&nbsp;
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @if ($size != '')
                        <div class="pro-details-color-info d-flex align-items-center">
                            <span>Size:</span>
                            <div class="pro-details-color">
                                <ul class="size_add">
                                </ul>
                            </div>
                        </div>
                        @else
                        <input type="hidden" name="size_id" value="1">
                        @endif

                        @else

                        @if ($size != '')
                        <div class="pro-details-color-info d-flex align-items-center">
                            <span>Size:</span>
                            <div class="pro-details-color">
                                <ul>
                                    @foreach ($product->Attribute as $Attribute)
                                    <input class="form-group SizebyPrice" type="radio" name="size_id"
                                        data-product="{{$product->id}}" id="size_id{{$Attribute->Size->id}}"
                                        value="{{$Attribute->Size->id}}">
                                    <label class="form-group" style="padding-top:12px;padding-left:5px"
                                        for="size_id{{$Attribute->Size->id}}">{{$Attribute->Size->size_name}}</label>
                                    &nbsp;
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <input type="hidden" name="color_id" value="1">
                        @endif

                        @endif
                        @if ($color == '')

                        <input type="hidden" name="color_id" value="1">
                        @endif
                        @if ($size == '')

                        <input type="hidden" name="size_id" value="1">
                        @endif
                        <p class="m-0">{{$product->product_summary}}</p>
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" name="cart_quantity" value="1" />
                            </div>
                            <div class="pro-details-cart">
                                <button class="add-cart" id="Cart_add" href="#"> Add To
                                    Cart</button>
                            </div>
                    </form>
                    <style>
                        .test {
                            padding: 0;
                            border: none;
                            color: #fff;
                            font-size: 18px;
                            margin-left: 10px;
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            align-items: center;
                            border-radius: 5px;
                            background-color: #3d3d3d;
                            width: 50px;
                            height: 50px;
                        }

                    </style>
                    <div class="pro-details-compare-wishlist pro-details-wishlist ">
                        <button class="test" id="Wish_btn"><i class="pe-7s-like"></i></button>
                    </div>
                    <div class="pro-details-compare-wishlist pro-details-compare">
                        <a href="compare.html"><i class="pe-7s-refresh-2"></i></a>
                    </div>
                </div>

                <div class="pro-details-categories-info pro-details-same-style d-flex">
                    <span>Categories: </span>
                    <ul class="d-flex">
                        <li>
                            <a href="{{route('CategorySearch',$product->Catagory->catagory_name)}}">{{$product->Catagory->catagory_name}}</a>
                        </li>
                    </ul>
                </div>
                <div class="pro-details-social-info pro-details-same-style d-flex">
                    <span>Share: </span>
                    <ul class="d-flex">
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-google"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
</div>


<!-- product details description area start -->
<div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav">
                <a data-bs-toggle="tab" href="#des-details2">Information</a>
                <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                <a data-bs-toggle="tab" href="#des-details3">Reviews (02)</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details2" class="tab-pane">
                    <div class="product-anotherinfo-wrapper text-start">
                        <ul>
                            <li><span>Weight</span> 400 g</li>
                            <li><span>Dimensions</span>10 x 10 x 15 cm</li>
                            <li><span>Materials</span> 60% cotton, 40% polyester</li>
                            <li><span>Other Info</span> American heirloom jean shorts pug seitan letterpress</li>
                        </ul>
                    </div>
                </div>
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p>
                            {!! nl2br($product->product_description) !!}

                        </p>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="review-wrapper">
                                <div class="single-review">
                                    <div class="review-img">
                                        <img src="assets/images/review-image/1.png" alt="" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>White Lewis</h4>
                                                </div>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="review-left">
                                                <a href="#">Reply</a>
                                            </div>
                                        </div>
                                        <div class="review-bottom">
                                            <p>
                                                Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                cubilia Curae Suspendisse viverra ed viverra. Mauris ullarper
                                                euismod vehicula. Phasellus quam nisi, congue id nulla.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-review child-review">
                                    <div class="review-img">
                                        <img src="assets/images/review-image/2.png" alt="" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>White Lewis</h4>
                                                </div>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="review-left">
                                                <a href="#">Reply</a>
                                            </div>
                                        </div>
                                        <div class="review-bottom">
                                            <p>Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                cubilia Curae Sus pen disse viverra ed viverra. Mauris ullarper
                                                euismod vehicula.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="ratting-form-wrapper pl-50">
                                <h3>Add a Review</h3>
                                <div class="ratting-form">
                                    <form action="#">
                                        <div class="star-box">
                                            <span>Your rating:</span>
                                            <div class="rating-product">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="rating-form-style">
                                                    <input placeholder="Name" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="rating-form-style">
                                                    <input placeholder="Email" type="email" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style form-submit">
                                                    <textarea name="Your Review" placeholder="Message"></textarea>
                                                    <button class="btn btn-primary btn-hover-color-primary "
                                                        type="submit" value="Submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product details description area end -->

<!-- Related product Area Start -->
@if (count($product->Catagory->Product) > 1 )
<div class="related-product-area pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30px0px line-height-1">
                    <h2 class="title m-0">Related Products</h2>
                </div>
            </div>
        </div>
        <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
            <div class="new-product-wrapper swiper-wrapper">
                @foreach ($product->Catagory->Product as $latest_product)
                @if ($product->id != $latest_product->id)
                <div class="new-product-item  {{(count($product->Catagory->Product) > 3)? 'swiper-slide' : ''}}"
                    {{(count($product->Catagory->Product) > 3)? '' : 'style=margin-left:30px'}}>
                    <!-- Single Prodect -->
                    <div class="product">
                        <div class="thumb">
                            <a href="{{route('SingleProductView',$latest_product->slug)}}" class="image">
                                <img src="{{asset('thumbnail_img/'.$latest_product->thumbnail_img)}}"
                                    alt="{{$latest_product->title}}" />
                            </a>
                            <span class="badges">
                                @if ($latest_product->Attribute->min('sell_price') != '')

                                <span class="sale">-{{$latest_product->Attribute->min('discount')}}%</span>
                                @endif
                            </span>
                            <button title="Add To Cart" class=" add-to-cart">Add
                                To Cart</button>
                        </div>
                        <div class="content">
                            <span class="ratings">
                                <span class="rating-wrap">
                                    <span class="star" style="width: 100%"></span>
                                </span>
                                <span class="rating-num">( 5 Review )</span>
                            </span>
                            <h5 class="title"><a
                                    href="{{route('SingleProductView',$latest_product->slug)}}">{{$latest_product->title}}
                                </a>
                            </h5>
                            <span class="price">
                                @php
                                $regular_price =
                                collect($latest_product->Attribute)->min('regular_price');
                                $sell_price = collect($latest_product->Attribute)->min('sell_price');
                                @endphp
                                @if ($sell_price != '')

                                <span class="new">৳
                                    {{$sell_price}}
                                </span>
                                @else
                                ৳{{$regular_price}}

                                @endif
                                @if ($sell_price != '')
                                &nbsp; <span class="new">
                                    <del>
                                        ৳{{$regular_price}}
                                    </del>
                                </span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <!-- Add Arrows -->
            @if (count($product->Catagory->Product) > 4 )
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            @endif
        </div>
    </div>
</div>
@endif
<!-- Related product Area End -->

@endsection


@section('script_js')
<script>
    // if therese color available start
    $('.color_name').change(function() {
            var color_id = $(this).val();
            var product_id = $(this).attr('data-product');
              $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                     }),
            $.ajax({
                type: "POST",
            url:"/product/get-size",
           data:{product_id:product_id, color_id:color_id},
           success: function(res) {
                    if (res) {
                        // get size by color
                        $('.size_add').html(res);
                        $('.size_name').change(function() {
                            // get price on change size
                            var regular_price = $(this).attr('data-regular_price');
                            var selling_price = $(this).attr('data-sell_price');
                            var quantity = $(this).attr('data-quantity');
                            $('.sell_Price').html(selling_price);
                            $('.available').html(quantity);
                            if (selling_price == '') {
                                // if theres no selling price
                                $('.regular_Price').empty();
                                $('.regular_Price_if_selling_null').html(
                                    regular_price);
                            } else {
                                // if theres a selling price
                                $('.regular_Price_if_selling_null').empty();
                                $('.regular_Price').html(regular_price);
                            }
                        })

                    }
                }
            })
        });
    // if therese color available end

    // if therese color but no size available start

    $('.no_size_color').change(function() {
            var color_id = $(this).val();
            var product_id = $(this).attr('data-product');
              $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                     }),
            $.ajax({
                type: "POST",
            url:"/product/get-size",
           data:{product_id:product_id, color_id:color_id},
           success: function(res) {
            if (res) {
                // get price and quantity
                        $('.available').html(res);
                        var regular_price = $('.quantityadd').attr('data-regularprice');
                        var selling_price = $('.quantityadd').attr('data-sellprice');
                        $('.sell_Price').html(selling_price);
                        if (selling_price == '') {
                            // if theres no selling price
                            $('.regular_Price').empty();
                            $('.regular_Price_if_selling_null').html(
                                regular_price);
                        } else {
                            // if theres a selling price
                            $('.regular_Price_if_selling_null').empty();
                            $('.regular_Price').html(regular_price);
                        }
                    }
                }
            })
        });
    // if therese color but no size available end

    // if therese only size available start

    $('.SizebyPrice').change(function() {
            var size_id = $(this).val();
            var product_id = $(this).attr('data-product');
              $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                     }),
            $.ajax({
                type: "POST",
            url:"/product/get-pricebysize",
           data:{product_id:product_id, size_id:size_id},
           success: function(res) {
            if (res) {
                // get price and quantity
                        $('.available').html(res);
                        var regular_price = $('.quantityadd').attr('data-regularprice');
                        var selling_price = $('.quantityadd').attr('data-sellprice');
                        $('.sell_Price').html(selling_price);
                        if (selling_price == '') {
                            // if theres no selling price
                            $('.regular_Price').empty();
                            $('.regular_Price_if_selling_null').html(
                                regular_price);
                        } else {
                            // if theres a selling price
                            $('.regular_Price_if_selling_null').empty();
                            $('.regular_Price').html(regular_price);
                        }
                    }
                }
            })
        });
      // if therese only size available end

// add wishlist
$('#Wish_btn').click(function(){
        // alert('ok');
        var action =  '/wishlist-post';
        $('#Form_submit').attr('action', action);
        // $('#Form_submit').submit();
    });
// add cart
$('#Cart_add').click(function(){
        // alert('ok');
        var action =  '/cartpost';
        $('#Form_submit').attr('action', action);
        // $('#Form_submit').submit();
    });

</script>
@endsection