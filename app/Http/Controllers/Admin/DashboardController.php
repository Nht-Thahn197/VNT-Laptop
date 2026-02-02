<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Laptop;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'laptops' => Laptop::count(),
            'posts' => Post::count(),
            'users' => User::count(),
            'contacts' => Contact::count(),
        ];

        $recentLaptops = Laptop::latest()->take(5)->get();
        $recentPosts = Post::latest()->take(5)->get();
        $recentContacts = Contact::latest('created_at')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentLaptops', 'recentPosts', 'recentContacts'));
    }
}
