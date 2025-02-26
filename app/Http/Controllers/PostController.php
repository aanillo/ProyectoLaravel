<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    
    public function insert(Request $request) {
        $request->validate([
            'title' => 'required|max:20|min:3',
            'description' => 'required',
            'image' => 'nullable|url'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $request->image ?? null;
        $post->publish_date = now();
        $post->n_likes = 0;
        $post->status = Status::PENDING->value;
        $post->belongs_to = Auth::id();
        $post->save();

        return redirect()->route('posts.index'); // Redirigir a la lista de posts
    }

    public function delete($id) {
        $post = Post::findOrFail($id);

        if ($post->belongs_to === Auth::id()) {
            $post->delete();
        }

        return redirect()->route('posts.index'); // Redirigir después de eliminar
    }

    public function index() {
        $posts = Post::orderByDesc('publish_date')->get(); // Obtener los posts
        return view('principal', compact('posts')); // Pasar los posts a la vista
    }

    public function show($id) {
        $post = Post::findOrFail($id);
        return view('post.show', compact('post'));
    }
}

