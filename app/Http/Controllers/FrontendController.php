<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\BlogReply;
use App\Models\Cart;
use App\Models\Catagory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class FrontendController extends Controller
{
    function Frontendhome()
    {
        // return Cart::Where('cookie_id', session()->get('cookie_id'))->get();
        // dd(Cookie::get('cookie_id'));
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
            'blogs' => $blogs,
        ]);
    }
    function FrontendSearch(Request $request)
    {
        $search = strip_tags($request->q);
        $catagories =  Catagory::latest('catagory_name')
            ->select('catagory_name', 'id', 'slug')
            ->withcount('Product')
            ->get();
        $products = Product::where('title', 'LIKE', "%$search%")
            ->with('Catagory:id,catagory_name,slug', 'Attribute', 'Gallery:product_img,product_id')
            ->where('status', 1)->get();

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
}
