<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaptopController extends Controller
{
    public function index(Request $request)
    {
        $query = Laptop::with('category')->orderByDesc('created_at');

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->input('q') . '%');
        }

        if ($request->filled('brand')) {
            $query->where('brand', $request->input('brand'));
        }

        $laptops = $query->paginate(12)->withQueryString();

        $brands = Laptop::whereNotNull('brand')->distinct()->orderBy('brand')->pluck('brand');

        return view('admin.laptops.index', compact('laptops', 'brands'));
    }

    public function create()
    {
        $categories = Category::where('type', 'laptop')->orderBy('name')->get();

        return view('admin.laptops.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $validated['image'] = $this->handleImage($request, null);
        unset($validated['image_file']);

        Laptop::create($validated);

        return redirect()->route('admin.laptops.index')->with('success', 'Đã thêm laptop.');
    }

    public function edit(Laptop $laptop)
    {
        $categories = Category::where('type', 'laptop')->orderBy('name')->get();

        return view('admin.laptops.edit', compact('laptop', 'categories'));
    }

    public function update(Request $request, Laptop $laptop)
    {
        $validated = $this->validateData($request);

        $validated['image'] = $this->handleImage($request, $laptop->image);
        unset($validated['image_file']);

        $laptop->update($validated);

        return redirect()->route('admin.laptops.index')->with('success', 'Đã cập nhật laptop.');
    }

    public function destroy(Laptop $laptop)
    {
        $this->deleteImageIfNeeded($laptop->image);
        $laptop->delete();

        return redirect()->route('admin.laptops.index')->with('success', 'Đã xóa laptop.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'price' => ['required', 'numeric', 'min:0'],
            'cpu' => ['nullable', 'string', 'max:100'],
            'ram' => ['nullable', 'string', 'max:50'],
            'storage' => ['nullable', 'string', 'max:50'],
            'gpu' => ['nullable', 'string', 'max:100'],
            'brand' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'boolean'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);
    }

    private function handleImage(Request $request, ?string $current): ?string
    {
        $image = $current;

        if ($request->boolean('remove_image')) {
            $this->deleteImageIfNeeded($image);
            $image = null;
        }

        if ($request->hasFile('image_file')) {
            $this->deleteImageIfNeeded($image);
            $image = $request->file('image_file')->store('laptops', 'public');
        } elseif ($request->filled('image')) {
            $image = trim($request->input('image'));
        }

        return $image;
    }

    private function deleteImageIfNeeded(?string $path): void
    {
        if (! $path) {
            return;
        }

        if (preg_match('/^https?:\\/\\//', $path)) {
            return;
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
