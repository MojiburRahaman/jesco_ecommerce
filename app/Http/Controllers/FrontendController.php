<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailContact;
use App\Models\AboutSite;
use App\Models\Banner;
use App\Models\BestDeal;
use App\Models\BestDealProduct;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\BlogReply;
use App\Models\Catagory;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Order_Summaries;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    function Frontendhome()
    {
        $banners = Banner::where('status', 1)->get();
        $deals = BestDeal::first();
        $blogs = Blog::select('title', 'slug', 'blog_thumbnail', 'created_at')->withcount('BlogComment', 'BlogReply')
            ->get();
        $catagories = Catagory::with('Product.Attribute',)
            ->select('slug', 'id', 'catagory_name',)
            ->withcount('Product')->latest('id')->get();
        $product = Product::with('Catagory:id,catagory_name,slug', 'Attribute', 'Gallery:product_img,product_id')
            ->where('status', 1)->latest()
            ->select('id', 'slug', 'catagory_id', 'thumbnail_img', 'product_summary', 'title')
            ->get();
        return view('frontend.main', [
            'latest_products' => $product,
            'catagories' => $catagories,
            'banners' => $banners,
            'blogs' => $blogs,
            'deals' => $deals,
        ]);
    }
    function FrontendSearch(Request $request)
    {
        $search = strip_tags($request->search);

        $catagories =  Catagory::latest('catagory_name')
            ->select('catagory_name', 'id', 'slug')
            ->withcount('Product')
            ->get();
        $products = Product::query();
        if ($request->name == 'asc') {
            # code...
            $products = Product::where('title', 'LIKE', "%$search%")
                ->with('Catagory:id,catagory_name,slug', 'Attribute', 'Gallery:product_img,product_id')
                ->where('status', 1)
                ->orderBy('title', 'asc')
                ->simplepaginate(10);
        } elseif ($request->name == 'desc') {
            $products = Product::where('title', 'LIKE', "%$search%")
                ->with('Catagory:id,catagory_name,slug', 'Attribute', 'Gallery:product_img,product_id')
                ->where('status', 1)
                ->orderBy('title', 'desc')
                ->simplepaginate(10);
        } else {

            $products = Product::where('title', 'LIKE', "%$search%")
                ->with('Catagory:id,catagory_name,slug', 'Attribute', 'Gallery:product_img,product_id')
                ->where('status', 1)
                ->orderBy('title', 'asc')
                ->simplepaginate(10);
        }

        return view('frontend.pages.search', [
            'products' => $products,
            'search' => $search,
            'catagories' => $catagories,

        ]);
    }
    function Frontendshop()
    {
        $product = Product::with('Catagory', 'Attribute', 'Gallery')->where('status', 1)
            ->select('id', 'slug', 'title', 'thumbnail_img', 'product_summary', 'catagory_id',)
            ->latest('id')->Paginate(20);
        return view('frontend.pages.shop', [
            'products' => $product,
        ]);
    }

    function FrontenblogView($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        $comment = BlogComment::where('blog_id', $blog->id)
            ->with('BlogReply:reply,id,blogcomment_id,created_at')
            ->select('id', 'user_name', 'created_at', 'comment')->get();
        $next = Blog::Where('id', '>', $blog->id)->select('slug', 'id')->first();
        $prev = Blog::Where('id', '<', $blog->id)->select('slug', 'id')->first();

        return view('frontend.pages.blog-view', [
            'blog' =>  $blog,
            'next' =>  $next,
            'prev' =>  $prev,
            'comments' =>  $comment,
        ]);
    }
    function Frontendblog()
    {

        $blogs = Blog::select('title', 'slug', 'blog_thumbnail', 'blog_description', 'created_at', 'id')
            ->latest('id')->withcount('BlogComment', 'BlogReply')->paginate(20);
        return view('frontend.pages.blogs', [
            'blogs' => $blogs,
        ]);
    }
    function BlogComment(Request $request)
    {
        $request->validate([

            'user_name' => ['required',],
            'email' => ['required', 'email'],
            'subject' => ['nullable', 'string'],
            'comment' => ['required'],
            'blog_id' => ['required'],
        ]);

        $user_name =  strip_tags($request->user_name);
        $email =  strip_tags($request->email);
        $subject =  strip_tags($request->subject);
        $comment =  strip_tags($request->comment);
        $blog_id =  strip_tags($request->blog_id);

        $blog_comment = new BlogComment;
        $blog_comment->email = $email;
        $blog_comment->user_name = $user_name;
        $blog_comment->subject = $subject;
        $blog_comment->comment = $comment;
        $blog_comment->blog_id = $blog_id;
        $blog_comment->save();
        return back();
    }
    function BlogReply(Request $request)
    {
        $request->validate([
            'blogcomment_id' => ['required',],
            'reply' => ['required'],
            'blog_id' => ['required'],

        ]);

        $user_id =  auth()->id();
        $reply =  strip_tags($request->reply);
        $blogcomment_id =  strip_tags($request->blogcomment_id);
        $blog_id =  strip_tags($request->blog_id);


        $blog_comment = new BlogReply;
        $blog_comment->user_id = $user_id;
        $blog_comment->blogcomment_id = $blogcomment_id;
        $blog_comment->reply = $reply;
        $blog_comment->blog_id = $blog_id;
        $blog_comment->save();
        return back();
    }
    public function FrontendDeals()
    {
        $deals = BestDeal::first();
        abort_if($deals == '' || $deals->status == 2, 404);
        return view('frontend.pages.deals', [
            'DealsProducts' => BestDealProduct::inRandomOrder()->paginate('20'),
            'deals' => $deals,

        ]);
    }
    public function FrontendAbout()
    {
        return view('frontend.pages.about', [
            'about' => AboutSite::first(),
        ]);
    }
    public function FrontendContact()
    {
        return view('frontend.pages.contact');
    }
    public function FrontendContactPost(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'message' => ['required'],
        ]);
        if ($request->ajax()) {

            $contact = new Contact;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->message = $request->message;
            $contact->save();

            $send_to = SiteSetting::first();
            dispatch(new SendEmailContact($contact, $send_to->email));

            $cookie_id_generate = time() . Str::random(10);
            Cookie::queue('visitor_contact', $cookie_id_generate, 43200);
            return response()->json(['done' => 'Success']);
        }
        abort('404');
    }
    public function FrontendFaQ()
    {
        return view('frontend.pages.faq', [
            'faqs' => Faq::latest()->get(),
        ]);
    }
    public function FrontendOrdeTrack()
    {
        return view('frontend.pages.track-order');
    }
    public function FrontendOrdeTrackPost(Request $request)
    {
        abort_if(!$request->ajax(), '404');
        $validator = Validator::make($request->all(), [
            'order_number' => ['required', 'numeric'],
        ]);
        if ($validator->passes()) {

            $order =  Order_Summaries::where('order_number', $request->order_number)
                ->with('billing_details', 'order_details.Product',)
                ->first();
            if ($order == '') {
                return response()->json(['errors' => 'No Order Found ']);
            }
            $view = view('frontend.pages.track-order-ajax', [
                'order' => $order,
            ])->render();
            return response()->json(['html' => $view]);
        }
        return response()->json(['errors' => $validator->errors()->all()]);
    }
}
