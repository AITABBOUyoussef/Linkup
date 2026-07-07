<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaveController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Feed & Posts
    Route::get('/feed/saved-posts', [PostController::class, 'savedPosts'])->name('feed.savedPosts');
    Route::resource('/feed', PostController::class);
    Route::resource('/feed_comment', CommentController::class);
    Route::resource('/feed_like', LikeController::class);
    Route::resource('/feed_save', SaveController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profileuser/{id}', [ProfileController::class, 'user_profil'])->name('user_profil');

    // Network & Connections
    Route::get('/network', [NetworkController::class, 'index'])->name('network.index');
    Route::post('/connections', [ConnectionController::class, 'store'])->name('connections.store');
    Route::patch('/connections/{id}/accept', [ConnectionController::class, 'accept'])->name('connections.accept');
    Route::delete('/connections/{id}', [ConnectionController::class, 'destroy'])->name('connections.destroy');
});

require __DIR__.'/auth.php';
