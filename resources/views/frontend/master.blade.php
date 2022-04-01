<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="robots" content="index, follow" />
    <title>@yield('title',$site_settings->meta_title)</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="description" content="@yield('meta_description',$site_settings->meta_description)" />
    <meta name="keyword" content="@yield('meta_keyword',$site_settings->meta_keyword)">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    {{-- og tag  start--}}

        <meta property="og:title" content="@yield('title',$site_settings->meta_title)" />
        <meta property="og:description" content="@yield('meta_description',$site_settings->meta_description)" />
        <meta property="og:url" content="{{url()->current()}}" />
        <meta property="og:site_name" content="@yield('title',$site_settings->meta_title)" />
        <meta property="og:type" content="website" />

        <meta property="og:image" content=" @yield('og_image',asset('logo/'.$site_settings->site_logo))" />
        <meta property="og:image:url" content="@yield('og_image',asset('logo/'.$site_settings->site_logo))" />
        <meta property="og:image:secure_url" content="@yield('og_image',asset('logo/'.$site_settings->site_logo))" />
        <meta property="og:image:height" content="640" />
        <meta property="og:image:height" content="640" />
        <meta property="og:image:alt" content="@yield('title',$site_settings->meta_title)" />

    {{-- og tag  end--}}
    <!-- Add site Favicon -->
    <link rel="canonical" href="{{url()->current()}}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('logo/'.$site_settings->site_logo) }}">


    <!-- vendor css (Icon Font) -->
    <!-- <link rel="stylesheet" href="assets/css/vendor/bootstrap.bundle.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="assets/css/vendor/font.awesome.css" /> -->

    <!-- plugins css (All Plugins Files) -->
    <!-- <link rel="stylesheet" href="assets/css/plugins/animate.css" />
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css" />
    <link rel="stylesheet" href="assets/css/plugins/venobox.css" /> -->

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <link rel="stylesheet" href="{{asset("front/assets/css/vendor/vendor.min.css")}}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("front/assets/css/plugins/plugins.min.css")}}" />
    <link rel="stylesheet" href="{{asset('front/assets/css/style.min.css')}}">

    <!-- Main Style -->
    <!-- <link rel="stylesheet" href="assets/css/style.css" /> -->

</head>

<body>
 <!-- Top Bar -->
@if ($site_settings->offer)
<div class="header-to-bar"> {{$site_settings->offer}} </div>
@endif

 <!-- Top Bar -->
 <!-- Header Area Start -->
 <header>
     <div class="header-main sticky-nav ">
         <div class="container position-relative">
             <div class="row">
                 <div class="col-auto align-self-center">
                     <div class="header-logo">
                         <a href="{{route('Frontendhome')}}"><img src="{{ asset('logo/'.$site_settings->site_logo) }}" alt="Site Logo" /></a>
                     </div>
                 </div>
                 <div class="col align-self-center d-none d-lg-block">
                     <div class="main-menu">
                         <ul>
                                     <li><a href="{{route('Frontendhome')}}">Home</a></li>
                                     <li><a href="{{route('Frontendshop')}}">Shop</a></li>
                                <li><a href="{{route('Frontendblog')}}">Blogs</a></li>
                                <li><a href="{{route('FrontendAbout')}}">About us</a></li>
                             <li><a href="{{route('FrontendContact')}}">Contact us</a></li>
                             <li><a href="{{route('CartView')}}">Cart</a></li>
                         </ul>
                     </div>
                 </div>
                 <!-- Header Action Start -->
                 <div class="col col-lg-auto align-self-center pl-0">
                     <div class="header-actions">
                         @auth
                         <a href="{{route('FrontendProfile')}}" class="header-action-btn login-btn">Profile</a>
                             @else
                             <a href="{{route('login')}}" class="header-action-btn login-btn" data-bs-toggle="modal"
                                 data-bs-target="#loginActive">Sign In</a>
                         @endauth
                         <!-- Single Wedge Start -->
                         <a href="#" class="header-action-btn" data-bs-toggle="modal" data-bs-target="#searchActive">
                             <i class="pe-7s-search"></i>
                         </a>
                         <!-- Single Wedge End -->
                         <!-- Single Wedge Start -->
                         @auth
                         <a href="#offcanvas-wishlist" class="header-action-btn offcanvas-toggle">
                             <i class="pe-7s-like"></i>
                             <span class="header-action-num">{{wish_list_count()}}</span>
                         </a>
                         @endauth
                         <!-- Single Wedge End -->
                         <a href="#offcanvas-cart"
                             class="header-action-btn header-action-btn-cart offcanvas-toggle pr-0">
                             <i class="pe-7s-shopbag"></i>
                             <span class="header-action-num">{{cart_total_product()}}</span>
                             <!-- <span class="cart-amount">€30.00</span> -->
                         </a>
                         <a href="#offcanvas-mobile-menu"
                             class="header-action-btn header-action-btn-menu offcanvas-toggle d-lg-none">
                             <i class="pe-7s-menu"></i>
                         </a>
                     </div>
                     <!-- Header Action End -->
                 </div>
             </div>
         </div>
 </header>
 <!-- Header Area End -->
  <div class="offcanvas-overlay"></div>

 <!-- OffCanvas Wishlist Start -->
 <div id="offcanvas-wishlist" class="offcanvas offcanvas-wishlist">
     <div class="inner">
         <div class="head">
             <span class="title">Wishlist</span>
             <button class="offcanvas-close">×</button>
         </div>
         <div class="body customScroll">
             <ul class="minicart-product-list">
                @forelse (wish_list_products() as $wish_product)
                @if ($wish_product->status != 2)
                    
                <li>
                   <a href="{{route('SingleProductView',$wish_product->Product->slug)}}">
                       <img class="img-responsive mr-15px" width="100px" height="130px"
                           src="{{asset('thumbnail_img/'.$wish_product->Product->thumbnail_img)}}"
                           alt="{{$wish_product->Product->title}}" />
                   </a>
                    <div class="content">
                        <a href="single-product.html" class="title">{{$wish_product->Product->title}}</a>
                        <span class="quantity-price">{{$wish_product->quantity}} x <span class="amount">৳
                           @php
                           $Attribute =$wish_product->Product->Attribute
                           ->where('color_id',$wish_product->color_id)
                           ->where('size_id',$wish_product->size_id);
                           foreach ($Attribute as $key => $value) {
                           $regular_price =$value->regular_price;
                           $sell_price = $value->sell_price;
                           }
                           @endphp
                           {{($sell_price == '')? $regular_price : $sell_price}}
                            
                       </span></span>
                        <a href="{{route('WishlistRemove',$wish_product->id)}}" title="Remove" class="remove">×</a>
                    </div>
                </li>
                @endif
                @empty
                <li>
                    No Item in your wishlist
                </li>
                
            @endforelse
               
             </ul>
         </div>
         <div class="foot">
             <div class="buttons">
                 <a href="{{route('WishlistView')}}" class="btn btn-dark btn-hover-primary mt-30px">view wishlist</a>
             </div>
         </div>
     </div>
 </div>
 <!-- OffCanvas Wishlist End -->
 <!-- OffCanvas Cart Start -->
 <div id="offcanvas-cart" class="offcanvas offcanvas-cart">
     <div class="inner">
         <div class="head">
             <span class="title">Cart</span>
             <button class="offcanvas-close">×</button>
         </div>
         <div class="body customScroll">
             <ul class="minicart-product-list">
                 @forelse (cart_product_view() as $cart_product)
                     @if ($cart_product->status != 2)
                         
                     <li>
                        <a href="{{route('SingleProductView',$cart_product->Product->slug)}}">
                            <img class="img-responsive mr-15px" width="100px" height="130px"
                                src="{{asset('thumbnail_img/'.$cart_product->Product->thumbnail_img)}}"
                                alt="{{$cart_product->Product->title}}" />
                        </a>
                         <div class="content">
                             <a href="single-product.html" class="title">{{$cart_product->Product->title}}</a>
                             <span class="quantity-price">{{$cart_product->quantity}} x <span class="amount">৳
                                @php
                                $Attribute =$cart_product->Product->Attribute
                                ->where('color_id',$cart_product->color_id)
                                ->where('size_id',$cart_product->size_id)->first();
                                $regular_price =$Attribute->regular_price;
                                $sell_price = $Attribute->selling_price;
                                @endphp
                                {{($sell_price == '')? $regular_price : $sell_price}}
                                 
                            </span></span>
                             <a href="{{route('CartDelete',$cart_product->id)}}" title="Remove" class="remove">×</a>
                         </div>
                     </li>
                     @endif
                     @empty
                     <li>
                         No Item in your cart
                     </li>
                     
                 @endforelse
             </ul>
         </div>
             
         <div class="foot">
             <div class="buttons mt-30px">
                 <a href="{{route('CartView')}}" class="btn btn-dark btn-hover-primary mb-30px">view cart</a>
             </div>
         </div>
     </div>
 </div>
 <!-- OffCanvas Cart End -->

 <!-- OffCanvas Menu Start -->
 <div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
     <button class="offcanvas-close"></button>

     <div class="inner customScroll">

         <div class="offcanvas-menu mb-4">
             <ul>
                <li><a href="{{route('Frontendhome')}}">Home</a></li>
                <li><a href="{{route('Frontendshop')}}">Shop</a></li>
           <li><a href="{{route('Frontendblog')}}">Blogs</a></li>
           <li><a href="{{route('FrontendAbout')}}">About us</a></li>
        <li><a href="contact.html">Contact us</a></li>
        <li><a href="{{route('CartView')}}">Cart</a></li>
               
             </ul>
         </div>
         <!-- OffCanvas Menu End -->
         <div class="offcanvas-social mt-auto">
             <ul>
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
 <!-- OffCanvas Menu End -->
@yield('content')
     <!-- Footer Area Start -->
     <div class="footer-area">
        <div class="footer-container">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <!-- Start single blog -->
                        <div class="col-md-6 col-lg-4 col-5  ">
                            <div class="single-wedge">
                                <div class="footer-logo">
                                    <a href="index.html"><img src="assets/images/logo/logo-white.png" alt=""></a>
                                </div>
                                <p class="about-text">{{$site_settings->footer_text}}
                                </p>
                                <ul class="link-follow">
                                    @if ($site_settings->twitter_link)
                                        
                                    <li>
                                        <a class="m-0" title="Twitter" href="{{$site_settings->twitter_link}}"><i class="fa fa-twitter"
                                                aria-hidden="true"></i></a>
                                    </li>
                                    @endif
                                    @if ($site_settings->youtube_link)
                                        
                                    <li>
                                        <a title="Youtube" href="{{$site_settings->youtube_link}}"><i class="fa fa-youtube" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    @endif
                                    @if ($site_settings->facebook_link)
                                        
                                    <li>
                                        <a title="Facebook" href="{{$site_settings->facebook_link}}"><i class="fa fa-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    @endif
                                    @if ($site_settings->instagram_link)
                                        
                                    <li>
                                        <a title="Instagram" href="{{$site_settings->instagram_link}}"><i class="fa fa-instagram" aria-hidden="true"></i>
                                            </i>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-3  col-lg-4 col-3  ">
                            <div class="single-wedge">
                                <h4 class="footer-herading">Quick Links</h4>
                                <div class="footer-links">
                                    <div class="footer-row">
                                        <ul class="align-items-center">
                                            <li class="li"><a class="single-link" href="#">Support
                                                </a></li>
                                            <li class="li"><a class="single-link" href="#">Home</a></li>
                                            <li class="li"><a class="single-link" href="{{route('FrontendAbout')}}">About</a></li>
                                            <li class="li"><a class="single-link" href="#">Blog</a></li>
                                            <li class="li"><a class="single-link" href="{{route('FrontendContact')}}">Contact Us</a></li>
                                            <li class="li"><a class="single-link" href="{{route('FrontendFaQ')}}">Faq</a></li>
                                        </ul>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        {{-- <div class="col-md-3 col-lg-2 col-sm-6 mb-lm-30px pl-lg-50px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">Other Page</h4>
                                <div class="footer-links">
                                    <div class="footer-row">
                                        <ul class="align-items-center">
                                            <li class="li"><a class="single-link" href="about.html"> About </a>
                                            </li>
                                            <li class="li"><a class="single-link" href="blog-grid.html">Blog</a></li>
                                            <li class="li"><a class="single-link" href="#">Speakers</a></li>
                                            <li class="li"><a class="single-link" href="contact.html">Contact</a></li>
                                            <li class="li"><a class="single-link" href="#">Tricket</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        {{-- <div class="col-md-3 col-lg-2 col-sm-6 mb-lm-30px pl-lg-50px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">Company</h4>
                                <div class="footer-links">
                                    <div class="footer-row">
                                        <ul class="align-items-center">
                                            <li class="li"><a class="single-link" href="index.html">Jesco</a>
                                            </li>
                                            <li class="li"><a class="single-link" href="shop-left-sidebar.html">Shop</a></li>
                                            <li class="li"><a class="single-link" href="contact.html">Contact us</a></li>
                                            <li class="li"><a class="single-link" href="login.html">Log in</a></li>
                                            <li class="li"><a class="single-link" href="#">Help</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-3 col-lg-4 col-4 ">
                            <div class="single-wedge">
                                
                                <h4 class="footer-herading">Store Information.</h4>
                                <div class="footer-links">
                                    <!-- News letter area -->
                                    <p class="address">{{$site_settings->address}}</p>
                                    <p class="phone">Phone:<a href="tel:0123456789">{{$site_settings->number}}</a></p>
                                    <p class="mail">Email:<a href="mailto:{{$site_settings->email}}"> {{$site_settings->email}}</a></p>
                                    <img src="assets/images/icons/payment.png" alt="" class="payment-img img-fulid">

                                    <!-- News letter area  End -->
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <a target="_blank" href="https://www.sslcommerz.com/" title="SSLCommerz" alt="SSLCommerz"><img style="width:100%;height:50%;" src="https://securepay.sslcommerz.com/public/image/SSLCommerz-Pay-With-logo-All-Size-01.png" /></a> 
                         <div class="col-12 text-center">
                            <p class="copy-text"> © 2021 <strong>Jesco</strong> Made With <i class="fa fa-heart"
                                    aria-hidden="true"></i> By <a class="company-name" href="https://mojiburrahaman.com/">
                                    <strong> Mojibur Rahaman</strong></a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Area End -->

    <!-- Search Modal Start -->
    <div class="modal popup-search-style" id="searchActive">
        <button type="button" class="close-btn" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <div class="modal-overlay">
            <div class="modal-dialog p-0" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>Search Your Product</h2>
                        <form action="{{route('FrontendSearch')}}" method="GET" class="navbar-form position-relative" role="search">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Search here...">
                            </div>
                            <button type="submit" class="submit-btn"><i class="pe-7s-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Modal End -->

    <!-- Login Modal Start -->
    <div class="modal popup-login-style" id="loginActive">
        <button type="button" class="close-btn" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <div class="modal-overlay">
            <div class="modal-dialog p-0" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="login-content">
                            <h2>Log in</h2>
                            <h3>Log in your account</h3>
                            <form action="{{route('login')}}" method="POST">
                                @csrf
                                <input type="email" name="email" placeholder="Email">
                                <input type="password" name="password" name="password" placeholder="Password">
                                <div class="remember-forget-wrap">
                                    <div class="remember-wrap">
                                        <input type="checkbox">
                                        <p>Remember</p>
                                        <span class="checkmark"></span>
                                    </div>
                                    <div class="forget-wrap">
                                        <a href="#">Forgot your password?</a>
                                    </div>
                                </div>
                                <button type="submit">Log in</button>
                                <div class="member-register">
                                    <p> Not a member? <a href="{{route('login')}}"> Register now</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Modal End -->

     <!-- Modal -->
     <div class="modal modal-2 fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                            <!-- Swiper -->
                            <div class="swiper-container gallery-top">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="{{asset('front/assets/images/product-image/zoom-image/1.jpg')}}"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="{{asset('front/assets/images/product-image/zoom-image/2.jpg')}}"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/zoom-image/3.jpg"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/zoom-image/4.jpg"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-container gallery-thumbs mt-3 mb-3">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="{{asset('front/assets/images/product-image/small-image/1.jpg')}}"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="{{asset('front/assets/images/product-image/small-image/2.jpg')}}"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/small-image/3.jpg"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/small-image/4.jpg"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-details-content quickview-content">
                                <h2>Ardene Microfiber Tights</h2>
                                <div class="pricing-meta">
                                    <ul>
                                        <li class="old-price not-cut">$18.90</li>
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
                                <p class="mt-30px mb-0">Lorem ipsum dolor sit amet, consect adipisicing elit, sed do eiusmod tempor incidi ut labore
                                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercita ullamco laboris nisi
                                    ut aliquip ex ea commodo </p>
                                <div class="pro-details-quality">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                                    </div>
                                    <div class="pro-details-cart">
                                        <button class="add-cart" href="#"> Add To
                                            Cart</button>
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
                                            <a href="#">Fashion.</a>
                                        </li>
                                        <li>
                                            <a href="#">eCommerce</a>
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
        </div>
    </div>
    <!-- Modal end -->

    <!-- Global Vendor, plugins JS -->

    <!-- Vendor JS -->
    <!-- Vendor JS -->
    <!-- <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script> -->

    <!--Plugins JS-->
    <!-- <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/jquery-ui.min.js"></script>
    <script src="assets/js/plugins/jquery.nice-select.min.js"></script>
    <script src="assets/js/plugins/countdown.js"></script>
    <script src="assets/js/plugins/scrollup.js"></script>
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="assets/js/plugins/venobox.min.js"></script>
    <script src="assets/js/plugins/ajax-mail.js"></script> -->

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <script src="{{asset('front/assets/js/vendor/vendor.min.js')}}"></script>
    <script src="{{asset('front/assets/js/plugins/plugins.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main Js -->
    <script src="{{asset('front/assets/js/main.js')}}"></script>
    @yield('script_js')
</body>


</html>