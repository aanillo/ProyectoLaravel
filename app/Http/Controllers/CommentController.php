<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Enums\Status;
use App\Models\Post;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    //
    public function store(Request $request) {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id', 
        ]);
    
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->publish_date = now();
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->id(); // Asegúrate de que el usuario esté autenticado
        $comment->save();
    
        return redirect()->route('comments.show', ['id' => $request->post_id]);
    }
    

    // En tu CommentController
    public function show($id) {
        // Obtener el post correspondiente
        $post = Post::findOrFail($id);
        // Obtener los comentarios relacionados con este post
        $comments = Comment::where('post_id', $id)->orderByDesc('created_at')->get();
    
        // Pasar el post y los comentarios a la vista
        return view('commentform', compact('post', 'comments'));
    }
    

}
