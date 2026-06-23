<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
{
    $posts = Post::latest()->get();

    return view('feed', compact('posts'));
}
}
