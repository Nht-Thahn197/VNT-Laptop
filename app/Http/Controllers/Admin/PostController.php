<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Laptop;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['category', 'user'])->orderByDesc('created_at');

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->input('q') . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', (int) $request->input('status'));
        }

        $posts = $query->paginate(12)->withQueryString();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::where('type', 'blog')->orderBy('name')->get();
        $laptops = Laptop::orderBy('name')->get();

        return view('admin.posts.create', compact('categories', 'laptops'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $validated['slug'] = $this->generateSlug($validated['slug'] ?: $validated['title']);
        $validated['user_id'] = Auth::id();
        $validated['views'] = 0;
        $validated['thumbnail'] = $this->handleImage($request, null);
        unset($validated['thumbnail_file'], $validated['laptops']);

        $post = Post::create($validated);
        $post->laptops()->sync($request->input('laptops', []));

        return redirect()->route('admin.posts.index')->with('success', 'Đã thêm bài viết.');
    }

    public function edit(Post $post)
    {
        $categories = Category::where('type', 'blog')->orderBy('name')->get();
        $laptops = Laptop::orderBy('name')->get();
        $post->load('laptops');

        return view('admin.posts.edit', compact('post', 'categories', 'laptops'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $this->validateData($request);

        $slugSource = $validated['slug'] ?: $validated['title'];
        $validated['slug'] = $this->generateSlug($slugSource, $post->id);
        $validated['thumbnail'] = $this->handleImage($request, $post->thumbnail);
        unset($validated['thumbnail_file'], $validated['laptops']);

        $post->update($validated);
        $post->laptops()->sync($request->input('laptops', []));

        return redirect()->route('admin.posts.index')->with('success', 'Đã cập nhật bài viết.');
    }

    public function destroy(Post $post)
    {
        $this->deleteImageIfNeeded($post->thumbnail);
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Đã xóa bài viết.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'thumbnail' => ['nullable', 'string', 'max:255'],
            'thumbnail_file' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'boolean'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'laptops' => ['nullable', 'array'],
            'laptops.*' => ['exists:laptops,id'],
        ]);
    }

    private function generateSlug(string $value, ?int $ignoreId = null): string
    {
        $slug = Str::slug($value);
        $slug = $slug !== '' ? $slug : 'post';

        $base = $slug;
        $counter = 1;

        while (Post::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function handleImage(Request $request, ?string $current): ?string
    {
        $image = $current;

        if ($request->boolean('remove_thumbnail')) {
            $this->deleteImageIfNeeded($image);
            $image = null;
        }

        if ($request->hasFile('thumbnail_file')) {
            $this->deleteImageIfNeeded($image);
            $image = $request->file('thumbnail_file')->store('posts', 'public');
        } elseif ($request->filled('thumbnail')) {
            $image = trim($request->input('thumbnail'));
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
