<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
{
    $posts = Post::with('comments')-> latest()->get();
    // dd($posts);

    return view('feed', compact('posts'));
}
public function create(){
    return view('create');
}
public function store(Request $request){
    // dd($request->all());

$request->validate([
     'content' => 'required',

]);
$post = new Post();
$post->content = $request->content;
$post->user_id = $request->user()->id;
$post->save();
return redirect()->route('feed.index')->with('success', 'Post ajouté avec succès');
}
public  function edit(string $id){
    $post = Post::findOrFail($id);
    return view('edit',compact('post'));
}
public function update(Request $request, string $id){
    $request->validate([
        'content'=>'required',
    ]);
    $post = Post::findOrFail($id);
    $post->content = $request->content;
$post->save();
return redirect()->route('feed.index')->with('success', 'Post mis a jour avec succès');

}

public function destroy(string $id){
    $post = Post::findOrFail($id);
    $post->delete();
    return redirect()->route('feed.index')->with('success', 'Post supprime avec succès');

}
}
