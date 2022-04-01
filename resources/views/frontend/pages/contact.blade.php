@extends('frontend.master')

@section('content')

<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Contact Us</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{route('Frontendhome')}}">Home</a></li>
                    <li class="breadcrumb-item active">Contact Us</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<!-- Contact Area Start -->
<div class="contact-area pt-100px pb-100px">
    <div class="container">
        <div class="contact-wrapper">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-info">
                        <div class="single-contact">
                            <div class="icon-box">
                                <img src="{{asset('front/assets/images/icons/4.png')}}" alt="">
                            </div>
                            <div class="info-box">
                                <h5 class="title">Phone:</h5>
                                <p><a href="tel:{{$site_settings->number}}">{{$site_settings->number}}</a></p>
                            </div>
                        </div>
                        <div class="single-contact">
                            <div class="icon-box">
                                <img src="{{asset('front/assets/images/icons/5.png')}}" alt="">
                            </div>
                            <div class="info-box">
                                <h5 class="title">Email:</h5>
                                <p><a href="mailto:{{$site_settings->email}}">{{$site_settings->email}}</a></p>
                            </div>
                        </div>
                        <div class="single-contact">
                            <div class="icon-box">
                                <img src="{{asset('front/assets/images/icons/6.png')}}" alt="">
                            </div>
                            <div class="info-box">
                                <h5 class="title">Address:</h5>
                                <p>{{$site_settings->address}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    @if (Cookie::get('visitor_contact'))
                    <div class="contact-form" id="contact_message">
                        <img src="{{asset('logo/thank-you-9.gif')}}" alt="">
                    </div>

                    @else
                    <div class="contact-form" id="contact_part">
                        <div class="contact-title mb-30">
                            <h2 class="title" data-aos="fade-up" data-aos-delay="200">Leave a Message</h2>
                        </div>
                        <form class="contact-form-style" id="contact-form" action="{{route('FrontendContactPost')}}"
                            method="post">
                            <div class="row">
                                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                                    <input required name="name" id="name" placeholder="Name*" type="text" />
                                </div>
                                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                                    <input required name="email" id="email" placeholder="Email*" type="email" />
                                </div>
                                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
                                    <textarea required name="message" id="message"
                                        placeholder="Your Message*"></textarea>
                                    <button class="btn btn-primary mt-4" data-aos="fade-up" data-aos-delay="200"
                                        type="submit">Post Comment <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="contact-form" id="contact_message" style="display: none">
                        <img src="{{asset('logo/thank-you-9.gif')}}" alt="">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Area End -->

    <!-- map Area Start -->

    <div class="contact-map">
        <div id="mapid">
            <div class="mapouter">
                <div class="gmap_canvas">
                    <iframe id="gmap_canvas"
                        src="https://maps.google.com/maps?q=121%20King%20St%2C%20Melbourne%20VIC%203000%2C%20Australia&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    <a href="https://sites.google.com/view/maps-api-v2/mapv2"></a>
                </div>
            </div>
        </div>
    </div>
    <!-- map Area End -->
    @endsection
    @section('script_js')
    <script>
        $("#contact-form").submit(function(e) {
        e.preventDefault(); 
         var name = $('#name').val();
        var email = $('#email').val();
        var message = $('#message').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
                     }),
        $.ajax({
        url:'{{route('FrontendContactPost')}}',
        type:'POST',
        data:{name: name,email:email,message:message},
    })
    .done(function(data){
        if(data.done == "Success"){
            $('#contact_part').hide();
            $('#contact_message').show();
        }else{
            return;
        }
        cache: false
    })
     .fail(function (xhr, status, error) {
    Swal.fire('please fill the all input');
    $('#preloader').hide();
});
    
 });
    </script>
    @endsection