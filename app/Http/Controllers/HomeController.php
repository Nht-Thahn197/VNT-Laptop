<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Laptop;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $featuredLaptops = Laptop::with('category')
            ->where('status', 1)
            ->latest()
            ->take(6)
            ->get();

        $latestPosts = Post::with(['category', 'user'])
            ->where('status', 1)
            ->latest()
            ->take(3)
            ->get();

        $laptopCategories = Category::where('type', 'laptop')
            ->orderBy('name')
            ->get();

        $blogCategories = Category::where('type', 'blog')
            ->orderBy('name')
            ->get();

        $brands = Laptop::where('status', 1)
            ->whereNotNull('brand')
            ->distinct()
            ->orderBy('brand')
            ->take(8)
            ->pluck('brand');

        $stats = [
            'laptops' => Laptop::where('status', 1)->count(),
            'posts' => Post::where('status', 1)->count(),
            'brands' => Laptop::where('status', 1)->whereNotNull('brand')->distinct()->count('brand'),
        ];

        return view('home', compact(
            'featuredLaptops',
            'latestPosts',
            'laptopCategories',
            'blogCategories',
            'brands',
            'stats'
        ));
    }
}
