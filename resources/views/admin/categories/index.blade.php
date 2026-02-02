@extends('layouts.admin')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Danh mục</p>
            <h2 class="text-3xl font-semibold">Quản lý danh mục</h2>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="rounded-full bg-[rgb(var(--ink))] px-5 py-2 text-sm font-semibold text-[rgb(var(--paper))]">
            + Thêm danh mục
        </a>
    </div>

    <div class="mt-6 overflow-hidden rounded-3xl border border-line bg-white/80">
        <table class="w-full text-sm">
            <thead class="bg-[rgba(17,20,24,0.04)] text-xs uppercase tracking-[0.2em] text-smoke">
                <tr>
                    <th class="px-4 py-3 text-left">Tên</th>
                    <th class="px-4 py-3 text-left">Loại</th>
                    <th class="px-4 py-3 text-right">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-t border-line">
                        <td class="px-4 py-3 font-medium">{{ $category->name }}</td>
                        <td class="px-4 py-3 text-smoke">{{ $category->type }}</td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-[rgb(var(--teal))]">Sửa</a>
                            <form method="post" action="{{ route('admin.categories.destroy', $category) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-3 text-red-500" onclick="return confirm('Xóa danh mục này?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-smoke">Chưa có danh mục.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
@endsection
