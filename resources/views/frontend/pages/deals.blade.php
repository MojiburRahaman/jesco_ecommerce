@extends('frontend.master')
@section('content')

<!-- breadcrumb-area start -->

<!-- breadcrumb-area end -->
<div class="mt-5 deal-area deal-bg deal-bg-2 " data-bg-image="{{asset('front/assets/images/deal-img/deal-bg-2.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="deal-inner position-relative pt-100px pb-100px">
                    <div class="deal-wrapper">
                        {{-- <span class="category">{{$deals->title}}</span> --}}
                        <h3 class="title">{{$deals->title}}</h3>
                        <div class="deal-timing">
                            <div data-countdown="{{$deals->expire_date}}"></div>
                        </div>
                    </div>
                    <div class="deal-image">
                        <img class="img-fluid" src="{{asset('front/assets/images/deal-img/woman.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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


                                        @foreach ($DealsProducts as $DealsProduct)
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                                            data-aos-delay="200">
                                            <!-- Single Prodect -->
                                            <div class="product">
                                                <div class="thumb">
                                                    <a href="{{route('SingleProductView',$DealsProduct->Product->slug)}}"
                                                        class="image">
                                                        <img src="{{asset('thumbnail_img/'.$DealsProduct->Product->thumbnail_img)}}"
                                                            alt="{{$DealsProduct->Product->title}}" />
                                                    </a>
                                                    <span class="badges">
                                                        @if ($DealsProduct->Product->Attribute->min('sell_price') != '')

                                                        <span
                                                            class="sale">-{{$DealsProduct->Product->Attribute->min('discount')}}%</span>
                                                        @endif
                                                        <span class="new">New</span>
                                                    </span>
                                                    <div class="actions">
                                                        <a href="{{route('SingleProductView',$DealsProduct->Product->slug)}}"
                                                            class="action wishlist" title="Wishlist"><i
                                                                class="pe-7s-like"></i></a>
                                                        <a href="#" class="action quickview"
                                                            data-link-action="quickview" title="Quick view"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#latest_product{{$DealsProduct->Product->id}}"><i
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
                                                            href="{{route('SingleProductView',$DealsProduct->Product->slug)}}">{{$DealsProduct->Product->title}}
                                                        </a>
                                                    </h5>
                                                    <span class="price">
                                                        @php
                                                        $regular_price =
                                                        collect($DealsProduct->Product->Attribute)->min('regular_price');
                                                        $sell_price =
                                                        collect($DealsProduct->Product->Attribute)->min('sell_price');
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
                                    @foreach ($DealsProducts as $latest_product)
                                    <div class="shop-list-wrapper">
                                        <div class="row">
                                            <div class="col-md-5 col-lg-5 col-xl-4">
                                                <div class="product">
                                                    <div class="thumb">
                                                        <a href="{{route('SingleProductView',$DealsProduct->Product->slug)}}"
                                                            class="image">
                                                            <img src="{{asset('thumbnail_img/'.$DealsProduct->Product->thumbnail_img)}}"
                                                                alt="{{$DealsProduct->Product->title}}" />
                                                        </a>
                                                        <span class="badges">
                                                            @if ($DealsProduct->Product->Attribute->min('sell_price') !=
                                                            '')

                                                            <span
                                                                class="sale">-{{$DealsProduct->Product->Attribute->min('discount')}}%</span>
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
                                                                href="{{route('SingleProductView',$DealsProduct->Product->slug)}}">
                                                                {{$DealsProduct->Product->title}}
                                                            </a></h5>
                                                        <p>
                                                            {{$DealsProduct->Product->product_summary}}
                                                        </p>
                                                    </div>
                                                    <div class="box-inner">
                                                        <span class="price">
                                                            <span class="new">
                                                                @php
                                                                $regular_price =
                                                                collect($DealsProduct->Product->Attribute)->min('regular_price');
                                                                $sell_price =
                                                                collect($DealsProduct->Product->Attribute)->min('sell_price');
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
                                                            <a href="{{route('SingleProductView',$DealsProduct->Product->slug)}}"
                                                                class="action wishlist" title="Wishlist"><i
                                                                    class="pe-7s-like"></i></a>
                                                            <a href="#" class="action quickview"
                                                                data-link-action="quickview" title="Quick view"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#latest_product{{$DealsProduct->Product->id}}"><i
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
                    {{$DealsProducts->links('frontend.paginator')}}
                    <!--  Pagination Area End -->
                </div>
                <!-- Shop Bottom Area End -->
            </div>
        </div>
    </div>
</div>
<!-- Shop Page End  -->


{{-- quiick view modal --}}

@foreach ($DealsProducts as $DealsProduct)
<div class="modal modal-2 fade" id="latest_product{{$DealsProduct->Product->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                        <!-- Swiper -->
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
                                <img src="" alt="">
                                @foreach ($DealsProduct->Product->Gallery as $galleries)
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
                                @foreach ($DealsProduct->Product->Gallery as $galleries)
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
                                        collect($DealsProduct->Product->Attribute)->min('regular_price');
                                        $sell_price = collect($DealsProduct->Product->Attribute)->min('sell_price');
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
                            <p class="mt-30px mb-0">{{$DealsProduct->Product->product_summary}}</p>
                            <div class="pro-details-quality">
                                <div class="cart-plus-minus">
                                    <div class="dec qtybutton">-</div>
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                                    <div class="inc qtybutton">+</div>
                                </div>
                                <div class="pro-details-cart">
                                    <a href="{{route('SingleProductView',$DealsProduct->Product->slug)}}"
                                        class="add-cart" href="#"> Add To
                                        Cart</a>
                                </div>
                                <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                    <a href="{{route('SingleProductView',$DealsProduct->Product->slug)}}"><i
                                            class="pe-7s-like"></i></a>
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
                                        <a href="#">{{$DealsProduct->Product->Catagory->catagory_name}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="pro-details-social-info pro-details-same-style d-flex">
                                <span>Share: </span>
                                <ul class="d-flex">
                                    <li>
                                        <a
                                            href="https://www.facebook.com/sharer/sharer.php?u={{route('SingleProductView',$DealsProduct->Product->slug)}}&display=popup"><i
                                                class="fa fa-facebook"></i></a>
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
@section('script_js')
<script>
    $("[data-countdown]").each(function () {
        var $this = $(this),
            finalDate = $(this).data("countdown");
        $this.countdown(finalDate, function (event) {
            $this.html(event.strftime('<span class="cdown day"><span class="cdown-1">%-D</span><p>Days</p></span> <span class="cdown hour"><span class="cdown-1">%-H</span><p>Hours</p></span> <span class="cdown minutes"><span class="cdown-1">%M</span> <p>Mins</p></span> <span class="cdown second"><span class="cdown-1"> %S</span> <p>Sec</p></span>'));
        });
    });
</script>
@endsection