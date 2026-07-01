<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/feed', function () {
//     return view('feed');
// })->middleware(['auth', 'verified']);

Route::resource('/feed', PostController::class)->middleware(['auth', 'verified']);
Route::resource('/feed_comment', CommentController::class)->middleware(['auth', 'verified']);
Route::resource('/feed_like', LikeController::class)->middleware(['auth', 'verified']);



Route::middleware('auth')->group(function () {
    // Route::resource('/feed', PostController::class)->name('feed');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
