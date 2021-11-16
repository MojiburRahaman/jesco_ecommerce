@extends('frontend.master')
@section('title')
{{$blog->title}}
@endsection
@section('meta_description')
{{$blog->meta_description}}
@endsection
@section('content')

<style>
    .replybutton {
        /* cursor: pointer; */
        font-size: 12px;
        color: #fff;
        text-transform: uppercase;
        font-weight: 700;
        width: 100px;
        height: 35px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        z-index: 1;
        position: relative;
        overflow: hidden;
        box-shadow: none;
        background: linear-gradient(155deg, #343434 100%, #343434 100%, #343434 100%);
        border-radius: 30px;
        line-height: 1;
        margin-top: 20px;
    }

    .replybutton:hover {
        color: #fff;
        box-shadow: 0 5px 15px 0 rgba(153, 63, 107, .5);
        transform: translateY(-1px);
        background: #fb5d5d;
    }

</style>
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">Blog Details</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{route('Frontendhome')}}">Home</a></li>
                    <li class="breadcrumb-item active">Blog Details</li>
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
            <div class="col-lg-8 col-md-12 offset-lg-2">
                <div class="blog-posts">
                    <div class="single-blog-post blog-grid-post">
                        <div class="blog-image single-blog" data-aos="fade-up" data-aos-delay="200">
                            <img class="img-fluid h-auto" src="{{asset('blog/blog_image/'.$blog->blog_image)}}"
                                alt="{{$blog->title}}" />
                        </div>
                        <div class="blog-post-content-inner mt-30px" data-aos="fade-up" data-aos-delay="400">
                            <div class="blog-athor-date">
                                <a class="blog-date height-shape" href="#"><i class="fa fa-calendar"
                                        aria-hidden="true"></i> {{$blog->created_at->format('d M,y')}}</a>
                                <a class="blog-mosion" href="#"><i class="fa fa-commenting" aria-hidden="true"></i>
                                    @if ($comments->count() > 999)
                                    {{number_format($comments->count(),2)}}k
                                    @else
                                    {{$comments->count() }}
                                    @endif
                                </a>
                            </div>
                            <h4 class="blog-title">{{$blog->title}}</h4>
                            <p data-aos="fade-up">
                                {!! $blog->blog_description !!}
                            </p>
                        </div>
                        {{-- <div class="single-post-content">
                            <p class="quate-speech" data-aos="fade-up" data-aos-delay="200">
                                Lorem ipsum dolor sit amet, consectetur adipisicin elit, sed do eiusmod tempor
                                incidi labore et dolore magna aliqua. Ut enim ad minim
                            </p>
                            <h4 class="title">It is a long established fact that.</h4>
                            <p data-aos="fade-up" data-aos-delay="200">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolor magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea comm consequat. Duis aute irure
                                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                deserunt mollit anim id est laborum. Sed ut perspicia unde omnis iste natus error
                                sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae
                                ab illo inventore veritatis
                            </p>
                            <p data-aos="fade-up" data-aos-delay="200">
                                There are many variations of passages of Lorem Ipsum available, but the majority
                                have suffered alteration in some form, by injected humour, or randomised words which
                                don't look even slightly believable. If you are goi to use a passage of Lorem Ipsum,
                                you need to be sure there isn't anything embarrassing hidden in the middl of text.
                                All the Lorem Ipsum generators on the Internet
                            </p>
                            <div class="image-porsion">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="image-left">
                                            <img class="img-fluid w-100" src="assets/images/blog-image/1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="image-left">
                                            <img class="img-fluid  w-100" src="assets/images/blog-image/3.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-30px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                eiusmod tempor incididunt ut labore et dolor magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea comm consequat. Duis
                                aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                officia deserunt mollit anim id est laborum. Sed ut perspicia unde omnis iste natus
                                error sit voluptat</p>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form, by injected humour, or randomised words which
                                don't look even slightly believable. If you are goi to use a passage of Lorem Ipsum,
                                you need to be sure there </p>
                        </div> --}}
                    </div>
                    <!-- single blog post -->
                </div>
                <div class="blog-single-tags-share d-sm-flex justify-content-between">
                    <div class="blog-single-share mb-xs-15px d-flex" data-aos="fade-up" data-aos-delay="200">
                        <ul class="social">
                            <li class="m-0">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-google"></i></a>
                            </li>
                        </ul>
                        <span class="title"><a class="ml-10px" href="#"> 2 <i class="fa fa-comments m-0"></i></a></span>
                    </div>
                </div>
                <div class="blog-nav">
                    <div class="row">
                        <div class="col-6">
                            @if ($prev != '')
                            <a class="nav-left" href="{{route('FrontenblogView',$prev->slug)}}"><i
                                    class="fa fa-angle-left"></i></a>
                            @endif
                        </div>

                        <div class="col-6 d-flex justify-content-end">
                            @if ($next != '')
                            <a class="nav-right" href="{{route('FrontenblogView',$next->slug)}}"><i
                                    class="fa fa-angle-right"></i></a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="comment-area">
                    <h2 class="comment-heading" data-aos="fade-up" data-aos-delay="200">Comments
                        ({{$comments->count()}})</h2>
                    <div class="review-wrapper">
                        @forelse ($comments as $comment)

                        <div class="single-review" data-aos="fade-up" data-aos-delay="200">
                            {{-- <div class="review-img">
                                <img src="assets/images/comment-image/1.png" alt="" />
                            </div> --}}
                            <div class="review-content">
                                <div class="review-top-wrap">
                                    <div class="review-left">
                                        <div class="review-name">
                                            <h4 class="title">{{Str::ucfirst($comment->user_name)}} </h4>
                                            <span class="date">{{$comment->created_at->format('d M Y')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-bottom">
                                    <p>
                                        {{$comment->comment}}
                                    </p>
                                    @forelse ($comment->BlogReply as $Reply)

                                    <div style="margin-left: 100px;margin-top:30px">
                                        <div class="review-name">
                                            <h4 class="title">Admin </h4>
                                            <span class="date">{{$Reply->created_at->format('d M Y')}}</span>
                                        </div>
                                        <p>
                                            {{$Reply->reply}}
                                        </p>
                                    </div>
                                    @empty

                                    @endforelse

                                    @auth

                                    @if (auth()->user()->roles->first()->name != 'Customer')
                                    <span>
                                        <div class="review-left">
                                            <button class="replybutton" data-commentbox="panel1">Reply</button>
                                            <br>
                                        </div>
                                        <div class="replybox" id="panel1" style="display:none">
                                            <form action="{{route('BlogReply')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="blogcomment_id" value="{{$comment->id}}">
                                                <input type="hidden" name="blog_id" value="{{$blog->id}}">
                                                <textarea name="reply" placeholder="Reply"
                                                    class="form-control"></textarea><br />
                                                <button type="submit">Submit</button>
                                                <a href="#" class="cancelbutton">Cancel</a href="#"><br /><br />
                                            </form>
                                        </div>
                                    </span>
                                    @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                        @empty
                        No Comment
                        @endforelse
                    </div>
                </div>
                <div class="blog-comment-form">
                    <form action="{{route('BlogComment')}}" method="POST">
                        @csrf
                        <h2 class="comment-heading" data-aos="fade-up" data-aos-delay="200">Leave a Comment</h2>
                        <div class="row">
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="single-form mb-lm-15px">
                                    <input class="form-control @error('user_name') is-invalid  
                                    @enderror" name="user_name" type="text" placeholder="Name *" />
                                    @error('user_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="blog_id" value="{{$blog->id}}">
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                                <div class="single-form mb-lm-15px">
                                    <input name="email" class="form-control @error('email')
                                      is-invalid  
                                    @enderror" type="email" placeholder="Email *" />
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12" data-aos="fade-up" data-aos-delay="500">
                                <div class="single-form mb-lm-15px">
                                    <input type="text" class="form-control @error('subject') is-invalid
                                    @enderror" name="subject" placeholder="Subject " />
                                    @error('subject')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
                                <div class="single-form">
                                    <textarea required name="comment" class="form-control @error('comment') is-invalid
                                    @enderror" placeholder="Message"></textarea>
                                    @error('comment')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
                                <button class="btn btn-primary btn-hover-dark border-0 mt-30px" type="submit">Post
                                    Comment
                                    <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blag Area End -->
@endsection
@section('script_js')
<script>
    $(function() {

$('.replybutton').on('click', function() {
$('.replybox').hide();
var commentboxId =$(this).parent().next().attr("class");
$('.'+commentboxId).toggle();
});

$('.cancelbutton').on('click', function() {
$('.replybox').hide();
});

});
</script>
@endsection