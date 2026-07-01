<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
public function store(Request $request){
    $request->validate(
       [ 'post_id' => 'required|exists:posts,id',
        'user_id' => 'required|exists:users,id',
        ]);
        $like = new Like();
        $like->user_id = $request->user()->id;
        $like->post_id = $request->post_id;
        $like->save();
                return redirect()->route('feed.index')->with('success', 'Like ajouté avec succès');
}


}
