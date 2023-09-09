<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{

}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blogs = Category::all();
        return view('admin.posts.create', ['blogs' => $blogs]);
     
    }
  
    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Validate the request data, including the image upload
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'category' => 'required',
        'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
        $fileName = time() . '.' . $request->img->extension();
        $request->img->storeAs('public/images', $fileName);

    // Automatically generate the slug based on the title
    $title = $request->input("title");
    $slug = str_replace(' ', '-', strtolower($title));

    // Create a new Blog entry with the uploaded image path and auto-generated slug
    $blog = Blog::create([
        'title' => $title,
        'content' => $request->input("content"),
        'category' => $request->input("category"),
        'slug' => $slug,
        'user_id' => Auth::user()->id,
        'img' => $fileName,
    ]);

    // Redirect or return a success message
    return redirect()->route('admin.dashboard')->with('success', 'Blog post created successfully!');
}
    /**
     * Display the specified resource.
     */
 public function show($slug)
{
    // Retrieve the blog post based on the provided slug
    $blog = Blog::where('slug', $slug)->firstOrFail();
    // Category on the left sidebar
    $categories = Category::all();
    // Comments on a particular post
    $comments=Comment::with('user')->orderBy('created_at', 'desc')->where('post_id', $blog->id)->get();
    // Recent Posts on the right sidebar
     $blogs = Blog::orderBy('created_at', 'desc')->paginate(6);
    //Related Posts
$relatedBlogs = Blog::where('category', $blog->category)
    ->where('slug', '!=', $blog->slug)
    ->orderBy('created_at', 'desc')
    ->paginate(4);
    // Pass the blog post to the view
    return view('show', [
        // for the post (Pls observe the singular word, BLOG)
        'blog' => $blog,
        //        for Recent Posts on the right sidebar. (Pls observe the plural word BLOGS)
        'blogs' => $blogs,
        //        For categories on the left side bar
        'categories' => $categories,
        //      For   Related posts
        'relatedBlogs'=>$relatedBlogs,
        //       For comments on this specific post
        "comments"=>$comments
    ]);
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
