@extends('frontend.master')
@section('title')
Home
@endsection
@section('meta_description')

@endsection
@section('content')


<!-- Hero/Intro Slider Start -->
<div class="section ">
    <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1">
        <!-- Hero slider Active -->
        <div class="swiper-wrapper">
            <!-- Single slider item -->
            <div class="hero-slide-item-2 slider-height swiper-slide d-flex bg-color1">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5 align-self-center sm-center-view">
                            <div class="hero-slide-content hero-slide-content-2 slider-animated-1">
                                <span class="category">Sale 45% Off</span>
                                <h2 class="title-1">Exclusive New<br> Offer 2021</h2>
                                <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark"> Shop
                                    Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div
                            class="col-xl-6 col-lg-7 col-md-7 col-sm-7 d-flex justify-content-center position-relative">
                            <div class="show-case">
                                <div class="hero-slide-image">
                                    <img src="{{asset('front/assets/images/slider-image/slider-2-1.png')}}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single slider item -->
            <div class="hero-slide-item-2 slider-height swiper-slide d-flex bg-color2">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5 align-self-center sm-center-view">
                            <div class="hero-slide-content hero-slide-content-2 slider-animated-1">
                                <span class="category">Sale 45% Off</span>
                                <h2 class="title-1">Exclusive New<br> Offer 2021</h2>
                                <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark"> Shop
                                    Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div
                            class="col-xl-6 col-lg-7 col-md-7 col-sm-7 d-flex justify-content-center position-relative">
                            <div class="show-case">
                                <div class="hero-slide-image">
                                    <img src="{{asset('front/assets/images/slider-image/slider-2-2.png')}}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
<div class="feature-area  mt-n-65px">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <!-- single item -->
                <div class="single-feature">
                    <div class="feature-icon">
                        <img src="{{asset('front/sassets/images/icons/1.png')}}" alt="">
                    </div>
                    <div class="feature-content">
                        <h4 class="title">Free Shipping</h4>
                        <span class="sub-title">Capped at $39 per order</span>
                    </div>
                </div>
            </div>
            <!-- single item -->
            <div class="col-lg-4 col-md-6 mb-md-30px mb-lm-30px mt-lm-30px">
                <div class="single-feature">
                    <div class="feature-icon">
                        <img src="{{asset('front/assets/images/icons/2.png')}}" alt="">
                    </div>
                    <div class="feature-content">
                        <h4 class="title">Card Payments</h4>
                        <span class="sub-title">12 Months Installments</span>
                    </div>
                </div>
            </div>
            <!-- single item -->
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <div class="feature-icon">
                        <img src="{{asset('front/assets/images/icons/3.png')}}" alt="">
                    </div>
                    <div class="feature-content">
                        <h4 class="title">Easy Returns</h4>
                        <span class="sub-title">Shop With Confidence</span>
                    </div>
                </div>
                <!-- single item -->
            </div>
        </div>
    </div>
</div>
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

                            {{-- <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                    href="#tab-product--new">New</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                    href="#tab-product-men">Men</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                    href="#tab-product-women">Women</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                    href="#tab-product-kids">Kids</a></li> --}}
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
                            <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-4" data-aos="fade-up"
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
                    </div>
                    <!-- 1st tab end -->
                    <!-- 2nd tab start -->
                    @foreach ($catagories->take(5) as $catagory)
                    <div class="tab-pane fade" id="tab-product--{{$catagory->slug}}">
                        <div class="row">

                            @foreach ($catagory->Product as $latest_product)
                            <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-4" data-aos="fade-up"
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
                                            <span class="new">New</span>
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
                <a href="{{route('Frontendshop')}}" class="btn btn-lg btn-primary btn-hover-dark m-auto"> Load More <i
                        class="fa fa-arrow-right ml-15px" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End -->

<!-- Banner Area Start -->
<div class="banner-area pt-100px pb-100px plr-15px">
    <div class="row m-0">
        <div class="col-12 col-lg-4 mb-md-30px mb-lm-30px">
            <div class="single-banner-2">
                <img src="{{asset('front/assets/images/banner/4.jpg')}}" alt="">
                <div class="item-disc">
                    <h4 class="title">Best Collection <br>
                        For Women</h4>
                    <a href="shop-left-sidebar.html" class="shop-link btn btn-primary ">Shop Now <i
                            class="fa fa-shopping-basket ml-5px" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 center-col mb-md-30px mb-lm-30px">
            <div class="single-banner-2">
                <img src="{{asset('front/assets/images/banner/5.jpg')}}" alt="">
                <div class="item-disc">
                    <h4 class="title">Best Collection <br>
                        For Men</h4>
                    <a href="shop-left-sidebar.html" class="shop-link btn btn-primary">Shop Now <i
                            class="fa fa-shopping-basket ml-5px" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="single-banner-2">
                <img src="{{asset('front/assets/images/banner/6.jpg')}}" alt="">
                <div class="item-disc">
                    <h4 class="title">New Collection <br>
                        For Kids</h4>
                    <a href="shop-left-sidebar.html" class="shop-link btn btn-primary">Shop Now <i
                            class="fa fa-shopping-basket ml-5px" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Area End -->

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
            <div class="col">
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

<!-- Deal Area Start -->
<div class="deal-area deal-bg deal-bg-2" data-bg-image="assets/images/deal-img/deal-bg-2.jpg">
    <div class="container ">
        <div class="row">
            <div class="col-12">
                <div class="deal-inner position-relative pt-100px pb-100px">
                    <div class="deal-wrapper">
                        <span class="category">#FASHION SHOP</span>
                        <h3 class="title">Deal Of The Day</h3>
                        <div class="deal-timing">
                            <div data-countdown="2021/05/15"></div>
                        </div>
                        <a href="shop-left-sidebar.html" class="btn btn-lg btn-primary btn-hover-dark m-auto"> Shop
                            Now <i class="fa fa-shopping-basket ml-15px" aria-hidden="true"></i></a>
                    </div>
                    <div class="deal-image">
                        <img class="img-fluid" src="assets/images/deal-img/woman.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Deal Area End -->
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
            {{-- <!-- End single blog -->
            <div class="col-lg-4 mb-md-30px mb-lm-30px">
                <div class="single-blog ">
                    <div class="blog-image">
                        <a href="blog-single-left-sidebar.html"><img src="assets/images/blog-image/2.jpg"
                                class="img-responsive w-100" alt=""></a>
                    </div>
                    <div class="blog-text">
                        <div class="blog-athor-date">
                            <a class="blog-date height-shape" href="#"><i class="fa fa-calendar" aria-hidden="true"></i>
                                24 Aug, 2021</a>
                            <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 1.5
                                K</a>
                        </div>
                        <h5 class="blog-heading"><a class="blog-heading-link" href="blog-single-left-sidebar.html">It is
                                a long established factoi
                                ader will be distracted</a></h5>

                        <a href="blog-single-left-sidebar.html" class="btn btn-primary blog-btn"> Read More<i
                                class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <!-- End single blog -->
            <div class="col-lg-4">
                <div class="single-blog">
                    <div class="blog-image">
                        <a href="blog-single-left-sidebar.html"><img src="assets/images/blog-image/3.jpg"
                                class="img-responsive w-100" alt=""></a>
                    </div>
                    <div class="blog-text">
                        <div class="blog-athor-date">
                            <a class="blog-date height-shape" href="#"><i class="fa fa-calendar" aria-hidden="true"></i>
                                24 Aug, 2021</a>
                            <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i> 1.5
                                K</a>
                        </div>
                        <h5 class="blog-heading"><a class="blog-heading-link"
                                href="blog-single-left-sidebar.html">Contrary to popular belieflo
                                lorem Ipsum is not</a></h5>


                        <a href="blog-single-left-sidebar.html" class="btn btn-primary blog-btn"> Read More<i
                                class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div> --}}
            <!-- End single blog -->
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
     @if (session('orderPlace'))
   Swal.fire(
     'Thanks',
    'Your order is placed order #{{session("orderPlace")}}',
     'success'
   )
   @endif
</script>
@endsection