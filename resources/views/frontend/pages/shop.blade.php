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
                    <li class="breadcrumb-item"><a href="{{route('Frontendhome')}}">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<!-- Shop Page Start  -->
<div class="shop-category-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Shop Bottom Area Start -->
                <div class="shop-bottom-area">

                    <!-- Tab Content Area Start -->
                    <div class="row">
                        <div class="col">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="shop-grid">
                                    <div class="row mb-n-30px">
                                     

                                        @foreach ($products as $latest_product)
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                                            data-aos-delay="200">
                                            <!-- Single Prodect -->
                                            <div class="product">
                                                <div class="thumb">
                                                    <a href="{{route('SingleProductView',$latest_product->slug)}}"
                                                        class="image">
                                                        <img src="{{asset('thumbnail_img/'.$latest_product->thumbnail_img)}}"
                                                            alt="{{$latest_product->title}}" />
                                                    </a>
                                                    <span class="badges">
                                                        @if ($latest_product->Attribute->min('sell_price') != '')

                                                        <span
                                                            class="sale">-{{$latest_product->Attribute->min('discount')}}%</span>
                                                        @endif
                                                        <span class="new">New</span>
                                                    </span>
                                                    <div class="actions">
                                                        <a href="{{route('SingleProductView',$latest_product->slug)}}"
                                                            class="action wishlist" title="Wishlist"><i
                                                                class="pe-7s-like"></i></a>
                                                        <a href="#" class="action quickview"
                                                            data-link-action="quickview" title="Quick view"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#latest_product{{$latest_product->id}}"><i
                                                                class="pe-7s-search"></i></a>
                                                    </div>
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
                                                        $sell_price =
                                                        collect($latest_product->Attribute)->min('sell_price');
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

                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="shop-list">
                                    @foreach ($products as $latest_product)
                                    <div class="shop-list-wrapper">
                                        <div class="row">
                                            <div class="col-md-5 col-lg-5 col-xl-4">
                                                <div class="product">
                                                    <div class="thumb">
                                                        <a href="{{route('SingleProductView',$latest_product->slug)}}"
                                                            class="image">
                                                            <img src="{{asset('thumbnail_img/'.$latest_product->thumbnail_img)}}"
                                                                alt="{{$latest_product->title}}" />
                                                        </a>
                                                        <span class="badges">
                                                            @if ($latest_product->Attribute->min('sell_price') != '')

                                                            <span
                                                                class="sale">-{{$latest_product->Attribute->min('discount')}}%</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-lg-7 col-xl-8">
                                                <div class="content-desc-wrap">
                                                    <div class="content">
                                                        <span class="ratings">
                                                            <span class="rating-wrap">
                                                                <span class="star" style="width: 100%"></span>
                                                            </span>
                                                            <span class="rating-num">( 5 Review )</span>
                                                        </span>
                                                        <h5 class="title"><a
                                                                href="{{route('SingleProductView',$latest_product->slug)}}">
                                                                {{$latest_product->title}}
                                                            </a></h5>
                                                        <p>
                                                            {{$latest_product->product_summary}}
                                                        </p>
                                                    </div>
                                                    <div class="box-inner">
                                                        <span class="price">
                                                            <span class="new">
                                                                @php
                                                                $regular_price =
                                                                collect($latest_product->Attribute)->min('regular_price');
                                                                $sell_price =
                                                                collect($latest_product->Attribute)->min('sell_price');
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
                                                        </span>
                                                        <div class="actions">
                                                            <a href="{{route('SingleProductView',$latest_product->slug)}}"
                                                                class="action wishlist" title="Wishlist"><i
                                                                    class="pe-7s-like"></i></a>
                                                            <a href="#" class="action quickview"
                                                                data-link-action="quickview" title="Quick view"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#latest_product{{$latest_product->id}}"><i
                                                                    class="pe-7s-search"></i></a>
                                                            <a href="compare.html" class="action compare"
                                                                title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                                        </div>
                                                        <button title="Add To Cart" class=" add-to-cart">Add
                                                            To Cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tab Content Area End -->

                    <!--  Pagination Area Start -->
                    {{$products->links('frontend.paginator')}}
                    <!--  Pagination Area End -->
                </div>
                <!-- Shop Bottom Area End -->
            </div>
        </div>
    </div>
</div>
<!-- Shop Page End  -->


{{-- quiick view modal --}}

@foreach ($products as $latest_product)
<div class="modal modal-2 fade" id="latest_product{{$latest_product->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                        <!-- Swiper -->
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
                                <img src="" alt="">
                                @foreach ($latest_product->Gallery as $galleries)
                                <div class="swiper-slide">
                                    <img class="img-responsive m-auto"
                                        src="{{asset('product_image/'.$galleries->product_img)}}" alt="">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-container gallery-thumbs mt-3 mb-3">
                            <div class="swiper-wrapper">
                                <img src="" alt="">
                                @foreach ($latest_product->Gallery as $galleries)
                                <div class="swiper-slide">
                                    <img class="img-responsive m-auto"
                                        src="{{asset('product_image/'.$galleries->product_img)}}" alt="">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                        <div class="product-details-content quickview-content">
                            <h2>{{$latest_product->title}}</h2>
                            <div class="pricing-meta">
                                <ul>
                                    <li class="old-price not-cut">
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
                                    </li>
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
                                <span class="read-review"><a class="reviews" href="#">(
                                        5 Customer Review )</a></span>
                            </div>
                            <p class="mt-30px mb-0">{{$latest_product->product_summary}}</p>
                            <div class="pro-details-quality">
                                <div class="cart-plus-minus">
                                    <div class="dec qtybutton">-</div>
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                                    <div class="inc qtybutton">+</div>
                                </div>
                                <div class="pro-details-cart">
                                    <a href="{{route('SingleProductView',$latest_product->slug)}}" class="add-cart"
                                        href="#"> Add To
                                        Cart</a>
                                </div>
                                <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                    <a href="{{route('SingleProductView',$latest_product->slug)}}"><i class="pe-7s-like"></i></a>
                                </div>
                            </div>
                            <div class="pro-details-sku-info pro-details-same-style  d-flex">
                                <span>SKU: </span>
                                <ul class="d-flex">
                                    <li>
                                        <a href="#">Ch-256xl</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="pro-details-categories-info pro-details-same-style d-flex">
                                <span>Categories: </span>
                                <ul class="d-flex">
                                    <li>
                                        <a href="#">{{$latest_product->Catagory->catagory_name}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="pro-details-social-info pro-details-same-style d-flex">
                                <span>Share: </span>
                                <ul class="d-flex">
                                    <li>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{route('SingleProductView',$latest_product->slug)}}&display=popup"><i class="fa fa-facebook"></i></a>
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
    </div>
</div>
@endforeach
@endsection