@extends('frontend.master')
@section('meta_description')

@endsection
@section('content')


<!-- Hero/Intro Slider Start -->
<div class="section ">
    <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1">
        <!-- Hero slider Active -->
        <div class="swiper-wrapper">
            <!-- Single slider item -->
            @forelse ($banners as $banner)
                
            <div class="hero-slide-item-2 slider-height swiper-slide d-flex bg-color1">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5 align-self-center sm-center-view">
                            <div class="hero-slide-content hero-slide-content-2 slider-animated-1">
                                @if ($banner->offer != '')
                                    
                                <span class="category">Sale {{$banner->offer}}% Off</span>
                                @endif
                                <h2 class="title-1">{{$banner->heading}}</h2>
                                <a href="{{route('Frontendshop')}}" class="btn btn-lg btn-primary btn-hover-dark"> Shop
                                    Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div
                            class="col-xl-6 col-lg-7 col-md-7 col-sm-7 d-flex justify-content-center position-relative">
                            <div class="show-case">
                                <div class="hero-slide-image">
                                    <img src="{{asset('banner_image/'.$banner->banner_image)}}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                
            @endforelse
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-white"></div>
        <!-- Add Arrows -->
        <div class="swiper-buttons">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>

<!-- Hero/Intro Slider End -->

<!-- Feature Area Srart -->
<!-- Feature Area End -->

<!-- Product Area Start -->
<div class="product-area pt-100px pb-100px">
    <div class="container">
        <!-- Section Title & Tab Start -->
        <div class="row">
            <!-- Section Title Start -->
            <div class="col-12">
                <div class="section-title text-center mb-0">
                    <h2 class="title">#products</h2>
                    <!-- Tab Start -->
                    <div class="nav-center">
                        <ul class="product-tab-nav nav align-items-center justify-content-center">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                    href="#tab-product--all">All</a></li>
                            @foreach ($catagories->take(5) as $catagory)
                            @if ($catagory->product_count != '')
                            <li class="nav-item"><a class="nav-link " data-bs-toggle="tab"
                                    href="#tab-product--{{$catagory->slug}}">{{$catagory->catagory_name}}</a></li>
                            @endif
                            @endforeach

                        </ul>
                    </div>
                    <!-- Tab End -->
                </div>
            </div>
            <!-- Section Title End -->
        </div>
        <!-- Section Title & Tab End -->

        <div class="row">
            <div class="col">
                <div class="tab-content mb-30px0px">
                    <!-- 1st tab start -->
                    <div class="tab-pane fade show active" id="tab-product--all">
                        <div class="row">
                            @foreach ($latest_products as $latest_product)
                            <div class="col-lg-4 col-xl-3 col-md-6 col-6 col-sm-6  mb-4" data-aos="fade-up"
                                data-aos-delay="800">
                                <!-- Single Prodect -->
                                <div class="product">
                                    <div class="thumb">
                                        <a href="{{route('SingleProductView',$latest_product->slug)}}" class="image">
                                            <img src="{{asset('thumbnail_img/'.$latest_product->thumbnail_img)}}"
                                                alt="{{$latest_product->title}}" />
                                        </a>
                                        <span class="badges">
                                            @if ($latest_product->Attribute->min('sell_price') != '')

                                            <span class="sale">-{{$latest_product->Attribute->max('discount')}}%</span>
                                            @endif
                                            @if ($loop->index+1 <= 8)
                                                
                                            <span class="new">New</span>
                                            @endif
                                        </span>
                                        <div class="actions">
                                            <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                    class="pe-7s-like"></i></a>
                                            <a href="#" class="action quickview" data-link-action="quickview"
                                                title="Quick view" data-bs-toggle="modal"
                                                data-bs-target="#latest_product{{$latest_product->id}}"><i
                                                    class="pe-7s-search"></i></a>
                                            <a href="compare.html" class="action compare" title="Compare"><i
                                                    class="pe-7s-refresh-2"></i></a>
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
                                            $sell_price = collect($latest_product->Attribute)->min('sell_price');
                                            @endphp
                                            @if ($sell_price != '')

                                            <span class="new">৳
                                                {{$sell_price}}
                                            </span>
                                            @else
                                            <span class="new">
                                                ৳{{$regular_price}}
                                            </span>

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
                    <!-- 1st tab end -->
                    <!-- 2nd tab start -->
                    @foreach ($catagories->take(5) as $catagory)
                    <div class="tab-pane fade" id="tab-product--{{$catagory->slug}}">
                        <div class="row">

                            @foreach ($catagory->Product as $latest_product)
                            <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-6 mb-4" data-aos="fade-up"
                                data-aos-delay="800">
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

                                            @if ($loop->index+1 <= 8)
                                            <span class="new">New</span>
                                            @endif
                                        </span>
                                        <div class="actions">
                                            <a href="{{route('SingleProductView',$latest_product->slug)}}"
                                                class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
                                            <a href="#" class="action quickview" data-link-action="quickview"
                                                title="Quick view" data-bs-toggle="modal"
                                                data-bs-target="#latest_product{{$latest_product->id}}"><i
                                                    class="pe-7s-search"></i></a>
                                            <a href="compare.html" class="action compare" title="Compare"><i
                                                    class="pe-7s-refresh-2"></i></a>
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

                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{route('Frontendshop')}}" class="btn btn-lg btn-primary btn-hover-dark m-auto"> View More <i
                        class="fa fa-arrow-right ml-15px" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End -->



<!-- Product Area Start -->
<div class="product-area pt-100px pb-100px">
    <div class="container">
        <!-- Section Title & Tab Start -->
        <div class="row">
            <!-- Section Title Start -->
            <div class="col-lg col-md col-12">
                <div class="section-title mb-0">
                    <h2 class="title">#newarrivals</h2>
                </div>
            </div>
            <!-- Section Title End -->

            <!-- Tab Start -->
            {{-- <div class="col-lg-auto col-md-auto col-12">
                <ul class="product-tab-nav nav">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                            href="#tab-product-all">All</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-product-new">New</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                            href="#tab-product-bestsellers">Bestsellers</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                            href="#tab-product-itemssale">Items
                            Sale</a></li>
                </ul>
            </div> --}}
            <!-- Tab End -->
        </div>
        <!-- Section Title & Tab End -->

        <div class="row">
            <div class="col-12">
                <div class="tab-content top-borber">
                    <!-- 1st tab start -->
                    <div class="tab-pane fade show active" id="tab-product-all">
                        <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                            <div class="new-product-wrapper swiper-wrapper">
                                @foreach ($latest_products as $latest_product)
                                <div class="new-product-item swiper-slide">
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
                                                <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                        class="pe-7s-like"></i></a>
                                                <a href="#" class="action quickview" data-link-action="quickview"
                                                    title="Quick view" data-bs-toggle="modal"
                                                    data-bs-target="#latest_product{{$latest_product->id}}"><i
                                                        class="pe-7s-search"></i></a>
                                                <a href="compare.html" class="action compare" title="Compare"><i
                                                        class="pe-7s-refresh-2"></i></a>
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

                                @endforeach
                            </div>
                            <!-- Add Arrows -->
                            <div class="swiper-buttons">
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    </div>
                    <!-- 1st tab end -->
                    <!-- 2nd tab start -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End -->

@if ($deals->status == 1)
<!-- Deal Area Start -->
    
<div class="deal-area deal-bg deal-bg-2 " data-bg-image="{{asset('front/assets/images/deal-img/deal-bg-2.jpg')}}">
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
                        <a href="{{route('FrontendDeals')}}" class="btn btn-lg btn-primary btn-hover-dark m-auto"> Shop
                            Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                    </div>
                    <div class="deal-image">
                        <img class="img-fluid" src="{{asset('front/assets/images/deal-img/woman.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Deal Area End -->
@endif
<!--  Blog area Start -->
<div class="main-blog-area pb-100px pt-100px">
    <div class="container">
        <!-- section title start -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center mb-30px0px">
                    <h2 class="title">#blog</h2>
                    {{-- <p class="sub-title">Lorem ipsum dolor sit amet consectetur adipisicing eiusmod. --}}
                    </p>
                </div>
            </div>
        </div>
        <!-- section title start -->
        <div class="row">
            @forelse ($blogs->take(3) as $blog )

            <div class="col-lg-4 mb-md-30px mb-lm-30px">
                <div class="single-blog">
                    <div class="blog-image">
                        <a href="{{route('FrontenblogView',$blog->slug)}}"><img
                                src="{{asset('blog/thumbnail/'.$blog->blog_thumbnail)}}" class="img-responsive w-100"
                                alt="{{$blog->title}}"></a>
                    </div>
                    <div class="blog-text">
                        <div class="blog-athor-date">
                            <a class="blog-date height-shape" href="#"><i class="fa fa-calendar" aria-hidden="true"></i>
                                {{$blog->created_at->format('d M,y')}}
                            </a>
                            <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i>
                                @php
                                $comment =$blog->blog_reply_count + $blog->blog_comment_count
                                @endphp
                                @if ($comment > 999)
                                {{number_format($comment,2)}}k
                                @else
                                {{$comment}}
                                @endif
                            </a>
                        </div>
                        <h5 class="blog-heading"><a class="blog-heading-link"
                                href="{{route('FrontenblogView',$blog->slug)}}">
                                {{$blog->title}}
                            </a></h5>

                        <a href="{{route('FrontenblogView',$blog->slug)}}" class="btn btn-primary blog-btn"> Read More<i
                                class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            @empty

            @endforelse
        </div>
    </div>
</div>
<!--  Blog area End -->

@foreach ($latest_products as $latest_product)
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
                                    <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                                </div>
                                <div class="pro-details-compare-wishlist pro-details-compare">
                                    <a href="compare.html"><i class="pe-7s-refresh-2"></i></a>
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

@section('script_js')
<script>

$("[data-countdown]").each(function () {
        var $this = $(this),
            finalDate = $(this).data("countdown");
        $this.countdown(finalDate, function (event) {
            $this.html(event.strftime('<span class="cdown day"><span class="cdown-1">%-D</span><p>Days</p></span> <span class="cdown hour"><span class="cdown-1">%-H</span><p>Hours</p></span> <span class="cdown minutes"><span class="cdown-1">%M</span> <p>Mins</p></span> <span class="cdown second"><span class="cdown-1"> %S</span> <p>Sec</p></span>'));
        });
    });


     @if (session('orderPlace'))
   Swal.fire(
     'Thanks',
    'Your order is placed order #{{session("orderPlace")}}',
     'success'
   )
   @endif
</script>
@endsection