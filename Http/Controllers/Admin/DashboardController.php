<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $categories_count = \App\Models\Category::count();
        $posts_count = \App\Models\Post::count();
        $comments_count = \App\Models\Comment::count();
        $recent_comments = \App\Models\Comment::with('post')->latest()->take(5)->get();

        return view('admin.dashboard', compact('categories_count', 'posts_count', 'comments_count', 'recent_comments'));
    }
}
