<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['category', 'user'])
            ->where('status', 1);

        $category = $request->input('category');
        if ($category !== null && is_numeric($category)) {
            $query->where('category_id', (int) $category);
        }

        if ($request->filled('q')) {
            $keyword = $request->input('q');
            $query->where('title', 'like', '%' . $keyword . '%');
        }

        $posts = $query
            ->orderByDesc('created_at')
            ->paginate(6)
            ->withQueryString();

        $categories = Category::where('type', 'blog')
            ->orderBy('name')
            ->get();

        $popular = Post::where('status', 1)
            ->orderByDesc('views')
            ->take(4)
            ->get();

        return view('blog.index', compact('posts', 'categories', 'popular'));
    }

    public function show(Post $post)
    {
        $post->load(['category', 'user', 'laptops']);
        $post->increment('views');

        $recent = Post::where('status', 1)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'recent'));
    }
}
