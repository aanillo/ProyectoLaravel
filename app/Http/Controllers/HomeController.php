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
        $posts = Post::latest()->get(); 
        $user = Auth::user(); 
        return view('principal', compact('posts', 'user'));
    }

}
