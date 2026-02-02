@extends('layouts.admin')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Bài viết</p>
            <h2 class="text-3xl font-semibold">Quản lý bài viết</h2>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="rounded-full bg-[rgb(var(--ink))] px-5 py-2 text-sm font-semibold text-[rgb(var(--paper))]">
            + Thêm bài viết
        </a>
    </div>

    <form method="get" class="mt-6 grid gap-3 rounded-3xl border border-line bg-white/80 p-5 md:grid-cols-[1fr_200px_auto]">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm theo tiêu đề..." class="soft-input" />
        <select name="status" class="soft-input">
            <option value="">Tất cả trạng thái</option>
            <option value="1" @selected(request('status') === '1')>Hiển thị</option>
            <option value="0" @selected(request('status') === '0')>Ẩn</option>
        </select>
        <button type="submit" class="rounded-full bg-[rgb(var(--ink))] px-5 py-2 text-sm font-semibold text-[rgb(var(--paper))]">
            Lọc
        </button>
    </form>

    <div class="mt-6 overflow-hidden rounded-3xl border border-line bg-white/80">
        <table class="w-full text-sm">
            <thead class="bg-[rgba(17,20,24,0.04)] text-xs uppercase tracking-[0.2em] text-smoke">
                <tr>
                    <th class="px-4 py-3 text-left">Tiêu đề</th>
                    <th class="px-4 py-3 text-left">Tác giả</th>
                    <th class="px-4 py-3 text-left">Danh mục</th>
                    <th class="px-4 py-3 text-left">Trạng thái</th>
                    <th class="px-4 py-3 text-right">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr class="border-t border-line">
                        <td class="px-4 py-3 font-medium">{{ $post->title }}</td>
                        <td class="px-4 py-3 text-smoke">{{ $post->user?->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-smoke">{{ $post->category?->name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded-full px-3 py-1 text-xs {{ $post->status ? 'bg-[rgba(34,128,118,0.12)] text-[rgb(var(--teal))]' : 'bg-[rgba(17,20,24,0.12)] text-smoke' }}">
                                {{ $post->status ? 'Hiển thị' : 'Ẩn' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-[rgb(var(--teal))]">Sửa</a>
                            <form method="post" action="{{ route('admin.posts.destroy', $post) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-3 text-red-500" onclick="return confirm('Xóa bài viết này?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-smoke">Chưa có bài viết.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
@endsection
