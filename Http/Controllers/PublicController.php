<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $posts = \App\Models\Post::where('status', 'published')->with(['user', 'category'])->latest()->paginate(9);
        $categories = \App\Models\Category::all();
        return view('home', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = \App\Models\Post::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $categories = \App\Models\Category::all();
        $comments = $post->comments()->where('status', 'approved')->latest()->get();
        return view('posts.show', compact('post', 'categories', 'comments'));
    }

    public function category($slug)
    {
        $category = \App\Models\Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->where('status', 'published')->with(['user', 'category'])->latest()->paginate(9);
        $categories = \App\Models\Category::all();
        return view('home', compact('posts', 'categories', 'category'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $posts = \App\Models\Post::where('status', 'published')
            ->where('title', 'like', "%$query%")
            ->with(['user', 'category'])
            ->latest()->paginate(9);
        $categories = \App\Models\Category::all();
        return view('home', compact('posts', 'categories', 'query'));
    }

    public function storeComment(Request $request, $slug)
    {
        $post = \App\Models\Post::where('slug', $slug)->firstOrFail();
        
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required',
        ]);

        $post->comments()->create([
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Komentar berhasil dikirim! Akan muncul setelah disetujui admin.');
    }
}
