@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl">
        <h2 class="text-3xl font-semibold">Chỉnh sửa laptop</h2>

        @php
            $imagePreview = null;
            if ($laptop->image) {
                $imagePreview = preg_match('/^https?:\\/\\//', $laptop->image) ? $laptop->image : asset('storage/' . $laptop->image);
            }
        @endphp

        <form method="post" action="{{ route('admin.laptops.update', $laptop) }}" enctype="multipart/form-data" class="mt-6 space-y-6 rounded-3xl border border-line bg-white/80 p-6">
            @csrf
            @method('PUT')
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">Tên laptop</label>
                    <input type="text" name="name" class="soft-input mt-2" value="{{ old('name', $laptop->name) }}" required />
                    @error('name')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">Giá</label>
                    <input type="number" step="0.01" name="price" class="soft-input mt-2" value="{{ old('price', $laptop->price) }}" required />
                    @error('price')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">Thương hiệu</label>
                    <input type="text" name="brand" class="soft-input mt-2" value="{{ old('brand', $laptop->brand) }}" />
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">Danh mục</label>
                    <select name="category_id" class="soft-input mt-2">
                        <option value="">Không chọn</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) $category->id === old('category_id', (string) $laptop->category_id))>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">CPU</label>
                    <input type="text" name="cpu" class="soft-input mt-2" value="{{ old('cpu', $laptop->cpu) }}" />
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">RAM</label>
                    <input type="text" name="ram" class="soft-input mt-2" value="{{ old('ram', $laptop->ram) }}" />
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">Ổ cứng</label>
                    <input type="text" name="storage" class="soft-input mt-2" value="{{ old('storage', $laptop->storage) }}" />
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">GPU</label>
                    <input type="text" name="gpu" class="soft-input mt-2" value="{{ old('gpu', $laptop->gpu) }}" />
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">Ảnh (URL hoặc path)</label>
                    <input type="text" name="image" class="soft-input mt-2" value="{{ old('image', $laptop->image) }}" />
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">Upload ảnh</label>
                    <input type="file" name="image_file" class="soft-input mt-2" />
                </div>
                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-smoke">Trạng thái</label>
                    <select name="status" class="soft-input mt-2">
                        <option value="1" @selected(old('status', (string) $laptop->status) === '1')>Hiển thị</option>
                        <option value="0" @selected(old('status', (string) $laptop->status) === '0')>Ẩn</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="text-xs uppercase tracking-[0.3em] text-smoke">Mô tả</label>
                <textarea name="description" rows="5" class="soft-input mt-2">{{ old('description', $laptop->description) }}</textarea>
            </div>

            @if ($imagePreview)
                <div class="rounded-3xl border border-line bg-white/80 p-4">
                    <p class="text-xs uppercase tracking-[0.3em] text-smoke">Ảnh hiện tại</p>
                    <img src="{{ $imagePreview }}" alt="{{ $laptop->name }}" class="mt-3 h-40 w-full rounded-2xl object-cover" />
                    <label class="mt-3 inline-flex items-center gap-2 text-sm">
                        <input type="checkbox" name="remove_image" value="1" />
                        Xóa ảnh hiện tại
                    </label>
                </div>
            @endif

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="rounded-full bg-[rgb(var(--ink))] px-5 py-2 text-sm font-semibold text-[rgb(var(--paper))]">
                    Cập nhật
                </button>
                <a href="{{ route('admin.laptops.index') }}" class="rounded-full border border-line px-5 py-2 text-sm font-medium">
                    Hủy
                </a>
            </div>
        </form>
    </div>
@endsection
