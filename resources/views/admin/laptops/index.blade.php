@extends('layouts.admin')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Laptop</p>
            <h2 class="text-3xl font-semibold">Quản lý laptop</h2>
        </div>
        <a href="{{ route('admin.laptops.create') }}" class="rounded-full bg-[rgb(var(--ink))] px-5 py-2 text-sm font-semibold text-[rgb(var(--paper))]">
            + Thêm laptop
        </a>
    </div>

    <form method="get" class="mt-6 grid gap-3 rounded-3xl border border-line bg-white/80 p-5 md:grid-cols-[1fr_200px_auto]">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm theo tên..." class="soft-input" />
        <select name="brand" class="soft-input">
            <option value="">Tất cả thương hiệu</option>
            @foreach ($brands as $brand)
                <option value="{{ $brand }}" @selected($brand === request('brand'))>{{ $brand }}</option>
            @endforeach
        </select>
        <button type="submit" class="rounded-full bg-[rgb(var(--ink))] px-5 py-2 text-sm font-semibold text-[rgb(var(--paper))]">
            Lọc
        </button>
    </form>

    <div class="mt-6 overflow-hidden rounded-3xl border border-line bg-white/80">
        <table class="w-full text-sm">
            <thead class="bg-[rgba(17,20,24,0.04)] text-xs uppercase tracking-[0.2em] text-smoke">
                <tr>
                    <th class="px-4 py-3 text-left">Tên</th>
                    <th class="px-4 py-3 text-left">Giá</th>
                    <th class="px-4 py-3 text-left">Danh mục</th>
                    <th class="px-4 py-3 text-left">Trạng thái</th>
                    <th class="px-4 py-3 text-right">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laptops as $laptop)
                    <tr class="border-t border-line">
                        <td class="px-4 py-3 font-medium">{{ $laptop->name }}</td>
                        <td class="px-4 py-3 text-[rgb(var(--sun))]">{{ $laptop->price_label }}</td>
                        <td class="px-4 py-3 text-smoke">{{ $laptop->category?->name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded-full px-3 py-1 text-xs {{ $laptop->status ? 'bg-[rgba(34,128,118,0.12)] text-[rgb(var(--teal))]' : 'bg-[rgba(17,20,24,0.12)] text-smoke' }}">
                                {{ $laptop->status ? 'Hiển thị' : 'Ẩn' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.laptops.edit', $laptop) }}" class="text-[rgb(var(--teal))]">Sửa</a>
                            <form method="post" action="{{ route('admin.laptops.destroy', $laptop) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-3 text-red-500" onclick="return confirm('Xóa laptop này?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-smoke">Chưa có laptop.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $laptops->links() }}
    </div>
@endsection
