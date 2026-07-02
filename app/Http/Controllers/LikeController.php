<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        $user_id = $request->user()->id;

        $like = Like::where('post_id', $request->post_id)
            ->where('user_id', $user_id)
            ->first();

        if ($like) {
            // Unlike
            $like->delete();

            return redirect()->route('feed.index')
                ->with('success', 'Like removed successfully.');
        }

        // Like
        Like::create([
            'post_id' => $request->post_id,
            'user_id' => $user_id,
        ]);

        return redirect()->route('feed.index')
            ->with('success', 'Like added successfully.');
    }

}
