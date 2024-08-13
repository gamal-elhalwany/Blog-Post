<?php

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\NewsletterController;

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


Route::get('/', [PostController::class, 'index'])->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Posts Routes.
    Route::resource('post', PostController::class);
    Route::post('status/{post}', [PostController::class, 'postStatus'])->name('post.status');
    Route::get('latest-posts', [PostController::class, 'allLatestPosts'])->name('posts.latest');
    Route::get('popular-posts', [PostController::class, 'popularPosts'])->name('posts.popular');
    Route::get('featured-posts', [PostController::class, 'featuredPosts'])->name('posts.featured');
    Route::get('search', [PostController::class, 'search_posts'])->name('posts.search');
    Route::get('inactivated', [PostController::class, 'inactivatedPosts'])->name('post.inactivated');

    // Category Routes.
    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('category/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Comments Routes.
    Route::get('comments', [CommentsController::class, 'index'])->name('comments.index');
    Route::post('comments/{post}/comment', [CommentsController::class, 'store'])->name('comments.store');
    Route::post('comments/{comment}/replies', [CommentsController::class, 'storeReply'])->name('comments.replies');
    Route::put('comments/{comment}/update', [CommentsController::class, 'update'])->name('comments.update');
    Route::delete('comments/{comment}/delete', [CommentsController::class, 'destroy'])->name('comments.destroy');

    // Newsletters Routes.
    Route::get('/newsletters', [NewsletterController::class, 'index'])->name('newsletters');
    Route::post('/newsletters', [NewsletterController::class, 'subscribe'])->name('newsletters.subscribe');
});

require __DIR__ . '/auth.php';
