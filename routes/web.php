<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\PublicController::class, 'index'])->name('home');
Route::get('/berita/{slug}', [App\Http\Controllers\PublicController::class, 'show'])->name('posts.show');
Route::get('/kategori/{slug}', [App\Http\Controllers\PublicController::class, 'category'])->name('categories.show');
Route::get('/search', [App\Http\Controllers\PublicController::class, 'search'])->name('search');
Route::post('/berita/{slug}/comment', [App\Http\Controllers\PublicController::class, 'storeComment'])->name('comments.store');

Auth::routes();


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('posts', App\Http\Controllers\Admin\PostController::class);
    Route::get('comments', [App\Http\Controllers\Admin\CommentController::class, 'index'])->name('comments.index');
    Route::delete('comments/{comment}', [App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('comments.destroy');
    Route::patch('comments/{comment}/approve', [App\Http\Controllers\Admin\CommentController::class, 'approve'])->name('comments.approve');
});
