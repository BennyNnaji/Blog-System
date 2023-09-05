<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $blogs = Blog::with('author')->get(); // Use 'get' to retrieve all blog posts with the 'author' relationship
    return view('index',['blogs' => $blogs]);
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

//  if ($request->hasFile('img')) {
//         // Get the uploaded image file
//         $image = $request->file('img');

//         // Generate a unique filename for the image (e.g., timestamp)
//         $fileName = time() . '.' . $image->getClientOriginalExtension();

//         // Store the image in the 'public/uploads/images' directory
//         $imagePath = $image->storeAs('public/uploads/images', $fileName);

//         // Save the image path to your database
//         $imagePathInDb = str_replace('public/', 'storage/', $imagePath);
//     } else {
//         // Handle the case where no image was uploaded
//         // You might want to provide a default image or return an error message
//         $imagePathInDb = 'storage/default_image.jpg'; // Update with your default image path
//     }


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


//     public function store(Request $request)
//     {
//         $request -> validate([
//             'title' => 'required',
//             'content' => 'required',
//             'category' => 'required',
//             'slug' => 'required',
//             'img' => 'required'
//         ]);
// $blog = Blog::create([
//     'title'=>$request->input("title"),
//     'content'=>$request->input("content"),
//     'category' => $request->input("category"),
//      'slug'=>str_replace(' ', '-', strtolower($request->get('title'))), 
//     'user_id'=> Auth::user()->id,
// ]);
//     }

    /**
     * Display the specified resource.
     */
 public function show($slug)
{
    // Retrieve the blog post based on the provided slug
    $blogs = Blog::where('slug', $slug)->firstOrFail();

    // Pass the blog post to the view
    return view('show.show', compact('blogs'));
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
