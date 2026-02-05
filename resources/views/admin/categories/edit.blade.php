@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl">
        <h2 class="text-3xl font-semibold">Chỉnh sửa danh mục</h2>

        <form method="post" action="{{ route('admin.categories.update', $category) }}" class="mt-6 space-y-4 rounded-3xl border border-line bg-white/80 p-6">
            @csrf
            @method('PUT')
            <div>
                <label class="text-xs uppercase tracking-[0.3em] text-smoke">Tên danh mục</label>
                <input type="text" name="name" class="soft-input mt-2" value="{{ old('name', $category->name) }}" required />
                @error('name')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="text-xs uppercase tracking-[0.3em] text-smoke">Loại</label>
                <select name="type" class="soft-input mt-2" required>
                    <option value="blog" @selected(old('type', $category->type) === 'blog')>Blog</option>
                    <option value="laptop" @selected(old('type', $category->type) === 'laptop')>Laptop</option>
                </select>
                @error('type')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-wrap gap-3">
                <button type="submit" class="rounded-full bg-[rgb(var(--ink))] px-5 py-2 text-sm font-semibold text-[rgb(var(--paper))]">
                    Cập nhật
                </button>
                <a href="{{ route('admin.categories.index') }}" class="rounded-full border border-line px-5 py-2 text-sm font-medium">
                    Hủy
                </a>
            </div>
        </form>
    </div>
@endsection
