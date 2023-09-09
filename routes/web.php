<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Admin Controllers Start
Route::middleware('auth', 'admin' )->group(function () {

    // Admin Dashboard
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

//category
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('/admin/categories/create', [CategoryController::class, 'store'])->name('admin.categories.create');
Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

//Posts
Route::get('/admin/posts', [BlogController::class, 'index'])->name('admin.posts');
Route::get('/admin/posts/create', [BlogController::class, 'create'])->name('admin.posts.create');
Route::post('/admin/posts/create', [BlogController::class, 'store'])->name('admin.posts.store');

});


require __DIR__.'/auth.php';
//Route::get('/{frontpage}', [BlogController::class, 'frontpage'])->name('frontpage');
Route::get('/', [FrontPageController::class, 'index'])->name('frontpage');
Route::get('/posts/{slug}', [BlogController::class, 'show'])->name('blog.details');
Route::post('/posts/{slug}', [CommentController::class, 'store'])->name('comment');