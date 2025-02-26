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
        // Devuelve la vista 'formpost'
        return view('formpost');
    }
    
    public function store(Request $request) {
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
        $post->belongs_to = Auth::id();
        $post->save();

        return redirect()->route('home'); 
    }

    public function delete($id) {
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
    
    // En tu controlador PostController

public function like($id)
{
    $post = Post::findOrFail($id);
    $post->increment('n_likes'); // Incrementa el número de likes
    return response()->json([
        'n_likes' => $post->n_likes // Devuelve el nuevo número de likes
    ]);
}

// app/Http/Controllers/PostController.php

public function incrementLikes($id)
{
    $post = Post::findOrFail($id);
    $post->n_likes += 1; 
    $post->save(); 

    return response()->json([
        'n_likes' => $post->n_likes
    ]);
}

}

