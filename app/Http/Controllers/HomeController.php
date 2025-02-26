<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        // Obtener todos los posts, ordenados por fecha de publicación (más recientes primero)
        $posts = Post::latest()->get(); // Obtiene todos los posts
        $user = Auth::user(); // Obtiene el usuario autenticado
        return view('principal', compact('posts', 'user'));
    }

}
