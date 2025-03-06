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
        ], [
            'comment.required' => 'El comentario es obligatorio.',
            'comment.string' => 'El comentario debe ser un texto válido.',
            'comment.max' => 'El comentario no puede tener más de 1000 caracteres.',
            'post_id.required' => 'El identificador de la publicación es obligatorio.',
            'post_id.exists' => 'La publicación seleccionada no existe.',
        ]);
        
    
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->publish_date = now();
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->id(); 
        $comment->save();
    
        return redirect()->route('comments.show', ['id' => $request->post_id]);
    }
    

    
    public function show($id) {
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', $id)->orderByDesc('created_at')->get();
    
        return view('commentform', compact('post', 'comments'));
    }
    

}
