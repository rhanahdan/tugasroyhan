<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = \App\Models\Comment::with('post')->latest()->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    public function destroy(\App\Models\Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully.');
    }

    public function approve(\App\Models\Comment $comment)
    {
        $comment->update(['status' => 'approved']);
        return back()->with('success', 'Comment approved successfully.');
    }
}
