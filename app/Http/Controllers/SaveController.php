<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\save;
use Illuminate\Http\Request;

class SaveController extends Controller
{
public function store(Request $request)
{
$request->validate([
    'post_id'=> 'required|exists:posts,id',
]);

$user_id=$request->user()->id;

$save=save::where('user_id', $user_id)
   ->where('post_id', $request->post_id)
    ->first();
// dd($save)
if($save){
    $save->delete();
         return redirect()->route('feed.index')
                ->with('success', 'save removed successfully.');
}

$save = new save();
$save->user_id=$user_id;
$save->post_id=$request->post_id;
$save->save();
      return redirect()->route('feed.index')
            ->with('success', 'save added successfully.');
}
//  public function index(){
//  $posts = Post::with('comments' , 'likes', 'saves')-> latest()->get();
// // $posts=save::where('user_id', $user_id)->where('post_id', $request->post_id)->first();
//     return view('save_post' , compact('posts'));
//  }

}
