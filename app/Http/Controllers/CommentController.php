<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
{
    $comments = comment::latest()->get();

    return view('feed', compact('comments'));
}
public function create(){
    return view('create');
}
public function store(Request $request ){
    // dd($request->all());
$post_id = $request->input('post_id');
$request->validate([
     'content' => 'required',

]);
$comment = new comment();
$comment->content = $request->content;
$comment->user_id = $request->user()->id;
$comment->post_id = $post_id;
$comment->save();
return redirect()->route('feed.index')->with('success', 'commant ajouté avec succès');
}
public  function edit(string $id){
    $comment = comment::findOrFail($id);
    return view('edit',compact('post'));
}
public function update(Request $request, string $id){
    $request->validate([
        'content'=>'required',
    ]);
    $post = comment::findOrFail($id);
    $post->content = $request->content;
$post->save();
return redirect()->route('feed.index')->with('success', 'Post mis a jour avec succès');

}

public function destroy(string $id){
    $comment = comment::findOrFail($id);
    $comment->delete();
    return redirect()->route('feed.index')->with('success', 'Post supprime avec succès');

}
}
