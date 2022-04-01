@extends('frontend.master')

@section('content')

<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Faq</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Faq</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<!--Faq Policy area start-->
<div class="login-register-area pb-100px pt-100px faq-area">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div class="inner-descripe" data-aos="fade-up" data-aos-delay="200">
                        <h4 class="title">Below are frequently asked questions, you may find the answer for yourself
                        </h4>
                    </div>
                    <div id="faq" class="panel-group">
                        @forelse ($faqs as $faq)
                        <div class="panel panel-default single-my-account" data-aos="fade-up" data-aos-delay="200">
                            <div class="panel-heading my-account-title">
                                <h3 class="panel-title"><span>{{$loop->index+1}} .</span> <a data-bs-toggle="collapse"
                                        href="#my-account-{{$faq->id}}" class="collapsed" aria-expanded="true">
                                        {{$faq->question}}
                                    </a></h3>
                            </div>
                            <div id="my-account-{{$faq->id}}"
                                class="panel-collapse collapse {{($loop->index+1 == 1) ? 'show' : ''}}"
                                data-bs-parent="#faq">
                                <div class="panel-body">
                                    {{$faq->answer}}
                                </div>
                            </div>
                        </div>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Faq Policy area end-->
@endsection