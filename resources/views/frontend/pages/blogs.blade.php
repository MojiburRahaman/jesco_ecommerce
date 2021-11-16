@extends('frontend.master')

@section('content')

<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Blog Grid</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{route('Frontendhome')}}">Home</a></li>
                    <li class="breadcrumb-item active">Blog Grid</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- Blog Area Start -->
<div class="blog-grid pb-100px pt-100px main-blog-page single-blog-page">
    <div class="container">
        <div class="row">
            @forelse ($blogs as $blog)

            <div class="col-lg-6 col-md-6 col-xl-4 mb-50px">
                <div class="single-blog">
                    <div class="blog-image">
                        <a href="blog-single-left-sidebar.html"><img
                                src="{{asset('blog/thumbnail/'.$blog->blog_thumbnail)}}" class="img-responsive w-100"
                                alt="{{$blog->title}}">
                        </a>
                    </div>
                    <div class="blog-text">
                        <div class="blog-athor-date">
                            <a class="blog-date height-shape" href="#"><i class="fa fa-calendar" aria-hidden="true"></i>
                                {{$blog->created_at->format('d M,y')}}</a>
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
                                href="{{route('FrontenblogView',$blog->slug)}}">{{$blog->title}}</a></h5>
                        {!!\Illuminate\Support\Str::limit($blog->blog_description, 100 )!!}
                        <br>
                        <br>
                        {{-- <a href="{{route('FrontenblogView',$blog->slug)}}" class="btn btn-primary blog-btn"> Read
                        More<i class="fa fa-arrow-right ml-5px" aria-hidden="true"></i></a> --}}
                    </div>
                </div>
            </div>
            @empty

            @endforelse
            {{$blogs->links('frontend.paginator')}}
        </div>

        <!--  Pagination Area Start -->
        {{-- <div class="pro-pagination-style text-center" data-aos="fade-up" data-aos-delay="200">
            <div class="pages">
                <ul>
                    <li class="li"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                    <li class="li"><a class="page-link active" href="#">1</a></li>
                    <li class="li"><a class="page-link" href="#">2</a></li>
                    <li class="li"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a>
                    </li>
                </ul>
            </div>
        </div> --}}
        <!--  Pagination Area End -->
    </div>
</div>
<!-- Blag Area End -->
@endsection