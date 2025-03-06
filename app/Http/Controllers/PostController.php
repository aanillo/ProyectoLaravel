<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Post;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function create()
    {
        return view('formpost');
    }
    
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:20|min:3',
            'description' => 'required',
            'image' => 'nullable|url'
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede tener más de 20 caracteres.',
            'title.min' => 'El título debe tener al menos 3 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'image.url' => 'La imagen debe ser una URL válida.'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $request->image ?? null;
        $post->publish_date = now();
        $post->n_likes = 0;
        $post->belongs_to = Auth::id();
        $post->save();

        return redirect()->route('home'); 
    }


    public function delete($id){
        $post = Post::findOrFail($id);
        if ($post->belongs_to === Auth::id()) {
            $post->delete();
        }

        return redirect()->route('home');
    }


    public function show() {
        $posts = Post::orderByDesc('publish_date')->get(); 
        return view('formposts', compact('posts'));
    }


    public function likePost($id){
        $post = Post::findOrFail($id);
        $post->n_likes += 1;
        $post->save();

        return redirect()->route('home'); 
    }

}

