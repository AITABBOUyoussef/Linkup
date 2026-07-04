<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $request->user()->id;
        $comment->post_id = $request->post_id;

        $comment->save();

        return redirect()->route('feed.index')->with('success', 'Commentaire ajouté avec succès');
    }

    public function edit(string $id)
    {
        $comment = Comment::findOrFail($id);
        return view('edit_comment', compact('comment'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('feed.index')->with('success', 'Commentaire mis à jour avec succès');
    }

    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();
        return redirect()->route('feed.index')->with('success', 'Commentaire supprimé avec succès');
    }
}
