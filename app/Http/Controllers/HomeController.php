<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with(['creator'])->paginate(10);
        return view('home', compact('posts'));
    }

    public function show(string $id)
    {
        $post = Post::with(['creator'])->findOrFail($id);
        return view('post', compact('post'));
    }
}
