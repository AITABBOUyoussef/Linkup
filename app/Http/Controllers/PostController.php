<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Republier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function index()
{
    // $posts = Post::with('comments' , 'likes')-> latest()->get();

// $posts = DB::table('posts')
// ->leftJoin('users as creator', 'posts.user_id', '=', 'creator.id')
// ->leftJoin('republiers' , 'republiers.post_id' , '='  ,'posts.id')
// ->leftJoin( 'users as reposted' ,  'republiers.reposted_by' , '=' , 'reposted.id')
// ->leftJoin( 'comments' ,  'comments.post_id' , '=' , 'posts.id')
// ->leftJoin( 'likes' ,  'likes.post_id' , '=' , 'posts.id')
// ->get();

// $posts = DB::select('SELECT * FROM users
// right JOIN republiers on republiers.reposted_by = users.id
// right JOIN posts on republiers.post_id = posts.id
// right join likes on likes.post_id = posts.id
// right join comments on comments.post_id = posts.id
// ');


// $posts = Post::with(['republiers.user', 'comments', 'likes'])->get();

$normalPosts = Post::with(['user' , 'comments.user' , 'likes'])->get()->map(function ($post) {
    $post->feed_type = 'post';
    $post->feed_date = $post->created_at;
    return $post;
});

$reposts = Republier::with(['user','post.user','post.comments.user','post.likes'])->get()->map(function ($repost) {
    $repost->feed_type='repost';
    $repost->feed_date=$repost->created_at;
    return $repost;
});

$feed = $normalPosts->concat($reposts)->sortByDesc('feed_date');


    //   dd($feed);

    return view('feed', compact('feed'));
}
public function create(){
    return view('create');
}
public function store(Request $request){
    // dd($request->all());

$request->validate([
     'content' => 'required',
     'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
]);
//  dd($request);
$post = new Post();
$post->content = $request->content;
$post->user_id = $request->user()->id;
 if ($request->hasFile('photo')) {
            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('photos'), $fileName);
            $post->photo = $fileName;
        }else{
            $post->photo = "null";
        }


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
     if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($post->photo && file_exists(public_path('photos/' . $post->photo))) {
                unlink(public_path('photos/' . $post->photo));
            }
            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('photos'), $fileName);
            $post->photo = $fileName;
        }
$post->save();
return redirect()->route('feed.index')->with('success', 'Post mis a jour avec succès');

}

public function destroy(string $id){
    $post = Post::findOrFail($id);
    if ($post->photo && file_exists(public_path('photos/' . $post->photo))) {
            unlink(public_path('photos/' . $post->photo));
        }
    $post->delete();
    return redirect()->route('feed.index')->with('success', 'Post supprime avec succès');

}

public function savedPosts()
{
     $savedPostIds = DB::table('saves')
                      ->where('user_id', auth()->id())
                      ->pluck('post_id');

   $feed = Post::whereIn('id', $savedPostIds)
                 ->latest()
                 ->get();

    return view('feed', compact('feed'));
}
public function rep_post()
{
     $savedPostIds = DB::table('republiers')
                      ->pluck('post_id');

   $rep_post = Post::whereIn('id', $savedPostIds)
                 ->latest()
                 ->get();

    return view('feed', compact('rep_post'));
}

}
