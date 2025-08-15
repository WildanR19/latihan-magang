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
        $post = Post::with(['creator', 'comments.user'])->findOrFail($id);
        return view('post', compact('post'));
    }

    public function storeComment(Request $request, $postid)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $post = Post::findOrFail($postid);
        $post->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
