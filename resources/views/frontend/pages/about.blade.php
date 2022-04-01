@extends('frontend.master')

@section('content')

    <!-- About Intro Area start-->
    <div class="about-intro-area mt-5 mb-5">
        <div class="container position-relative h-100 d-flex align-items-center">
            <div class="row">
                <div class="col-lg-12 text-center col-md-12">
                    <div class="about-intro-content">
                        <h2 class="title">{{$about->heading}}</h2>
                        <p>{!!$about->about!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Intro Area End--><!-- Feature Area Srart -->
    <div class="feature-area pb-100px pt-100px bg-gray mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- single item -->
                    <div class="single-feature border-0">
                        <div class="feature-icon">
                            <img src="{{asset('front/assets/images/icons/1.png')}}" alt="">
                        </div>
                        <div class="feature-content">
                            <h4 class="title">Free Shipping</h4>
                            <span class="sub-title">Capped at $39 per order</span>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-4 col-md-6 mb-md-30px mb-lm-30px mt-lm-30px">
                    <div class="single-feature border-0">
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
                <div class="col-lg-4 col-md-6 ">
                    <div class="single-feature border-0">
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
@endsection

