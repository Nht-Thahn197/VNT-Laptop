@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl">
        <h2 class="text-3xl font-semibold">Chỉnh sửa bài viết</h2>

        @php
            $thumbPreview = null;
            if ($post->thumbnail) {
                $thumbPreview = preg_match('/^https?:\\/\\//', $post->thumbnail) ? $post->thumbnail : asset('storage/' . $post->thumbnail);
            }
            $selectedLaptops = collect(old('laptops', $post->laptops->pluck('id')->all()))
                ->map(fn ($id) => (int) $id)
                ->all();
        @endphp

        <form method="post" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" class="mt-6 space-y-6 rounded-3xl border border-line bg-white/80 p-6">
            @csrf
            @method('PUT')
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">Tiêu đề</label>
                    <input type="text" name="title" class="soft-input mt-2" value="{{ old('title', $post->title) }}" required />
                    @error('title')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">Slug (tùy chọn)</label>
                    <input type="text" name="slug" class="soft-input mt-2" value="{{ old('slug', $post->slug) }}" />
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">Danh mục</label>
                    <select name="category_id" class="soft-input mt-2">
                        <option value="">Không chọn</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) $category->id === old('category_id', (string) $post->category_id))>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">Trạng thái</label>
                    <select name="status" class="soft-input mt-2">
                        <option value="1" @selected(old('status', (string) $post->status) === '1')>Hiển thị</option>
                        <option value="0" @selected(old('status', (string) $post->status) === '0')>Ẩn</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">Ảnh thumbnail (URL hoặc path)</label>
                    <input type="text" name="thumbnail" class="soft-input mt-2" value="{{ old('thumbnail', $post->thumbnail) }}" />
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">Upload thumbnail</label>
                    <input type="file" name="thumbnail_file" class="soft-input mt-2" />
                </div>
            </div>

            <div>
                <label class="text-xs uppercase tracking-[0.3em] text-smoke">Nội dung</label>
                <textarea name="content" rows="8" class="soft-input mt-2" required>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-xs uppercase tracking-[0.3em] text-smoke">Laptop liên quan</label>
                <select name="laptops[]" multiple class="soft-input mt-2 h-40">
                    @foreach ($laptops as $laptop)
                        <option value="{{ $laptop->id }}" @selected(in_array($laptop->id, $selectedLaptops, true))>
                            {{ $laptop->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if ($thumbPreview)
                <div class="rounded-3xl border border-line bg-white/80 p-4">
                    <p class="text-xs uppercase tracking-[0.3em] text-smoke">Thumbnail hiện tại</p>
                    <img src="{{ $thumbPreview }}" alt="{{ $post->title }}" class="mt-3 h-40 w-full rounded-2xl object-cover" />
                    <label class="mt-3 inline-flex items-center gap-2 text-sm">
                        <input type="checkbox" name="remove_thumbnail" value="1" />
                        Xóa thumbnail hiện tại
                    </label>
                </div>
            @endif

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="rounded-full bg-[rgb(var(--ink))] px-5 py-2 text-sm font-semibold text-[rgb(var(--paper))]">
                    Cập nhật
                </button>
                <a href="{{ route('admin.posts.index') }}" class="rounded-full border border-line px-5 py-2 text-sm font-medium">
                    Hủy
                </a>
            </div>
        </form>
    </div>
@endsection
