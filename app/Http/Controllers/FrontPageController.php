<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $blogs = Blog::with('author')->orderBy('created_at', 'desc')->paginate(8);
    $categories = Category::all();

    // Create an empty array to store comments for each blog post
    $comments = [];

    foreach ($blogs as $blog) {
        // Retrieve comments for each blog post
        $blogComments = Comment::where('post_id', $blog->id)->get();
        
        // Store the comments in the $comments array
        $comments[$blog->id] = $blogComments;
    }

    return view('index', [
        'blogs' => $blogs,
        'categories' => $categories,
        'comments' => $comments, // Pass the comments array to the view
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
