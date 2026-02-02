<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Laptop;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    public function index(Request $request)
    {
        $query = Laptop::query()
            ->with('category')
            ->where('status', 1);

        $category = $request->input('category');
        if ($category !== null && is_numeric($category)) {
            $query->where('category_id', (int) $category);
        }

        if ($request->filled('brand')) {
            $query->where('brand', $request->input('brand'));
        }

        if ($request->filled('ram')) {
            $query->where('ram', $request->input('ram'));
        }

        if ($request->filled('min')) {
            $query->where('price', '>=', (float) $request->input('min'));
        }

        if ($request->filled('max')) {
            $query->where('price', '<=', (float) $request->input('max'));
        }

        $laptops = $query
            ->orderByDesc('created_at')
            ->paginate(9)
            ->withQueryString();

        $brands = Laptop::where('status', 1)
            ->whereNotNull('brand')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');

        $rams = Laptop::where('status', 1)
            ->whereNotNull('ram')
            ->distinct()
            ->orderBy('ram')
            ->pluck('ram');

        $categories = Category::where('type', 'laptop')
            ->orderBy('name')
            ->get();

        $priceRange = Laptop::where('status', 1)
            ->selectRaw('MIN(price) as min_price, MAX(price) as max_price')
            ->first();

        return view('laptops.index', compact(
            'laptops',
            'brands',
            'rams',
            'categories',
            'priceRange'
        ));
    }

    public function show(Laptop $laptop)
    {
        $laptop->load([
            'category',
            'posts' => function ($query) {
                $query->where('status', 1)
                    ->latest()
                    ->take(4);
            },
        ]);

        $relatedQuery = Laptop::with('category')
            ->where('status', 1)
            ->where('id', '!=', $laptop->id);

        if ($laptop->brand) {
            $relatedQuery->where('brand', $laptop->brand);
        }

        $related = $relatedQuery
            ->latest()
            ->take(3)
            ->get();

        return view('laptops.show', compact('laptop', 'related'));
    }
}
