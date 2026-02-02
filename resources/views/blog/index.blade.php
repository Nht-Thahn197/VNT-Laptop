@extends('layouts.app')

@section('content')
    <section class="container-shell py-12">
        <div class="flex flex-wrap items-center justify-between gap-6">
            <div class="space-y-3">
                <span class="chip">Blog</span>
                <h1 class="text-4xl font-semibold">Bài viết &amp; review</h1>
                <p class="text-sm text-smoke">Cập nhật kiến thức, so sánh cấu hình và mẹo chọn laptop.</p>
            </div>
            <form method="get" class="w-full max-w-md">
                <div class="relative">
                    <input
                        type="search"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Tìm bài viết..."
                        class="soft-input pr-12"
                    />
                    <button type="submit" class="absolute right-3 top-3 text-sm text-smoke">🔍</button>
                </div>
            </form>
        </div>
    </section>

    <section class="container-shell pb-16">
        <div class="grid gap-10 lg:grid-cols-[1fr_300px]">
            <div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('blog.index') }}" class="rounded-full border border-line px-4 py-2 text-sm font-medium">
                        Tất cả
                    </a>
                    @foreach ($categories as $category)
                        <a
                            href="{{ route('blog.index', ['category' => $category->id]) }}"
                            class="rounded-full border border-line px-4 py-2 text-sm font-medium {{ (string) $category->id === request('category') ? 'bg-[rgb(var(--ink))] text-[rgb(var(--paper))]' : '' }}"
                        >
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>

                <div class="mt-8 grid gap-6 md:grid-cols-2">
                    @forelse ($posts as $post)
                        <x-post-card :post="$post" />
                    @empty
                        <p class="text-sm text-smoke">Không có bài viết nào.</p>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            </div>

            <aside class="space-y-6">
                <div class="glass-card rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.3em] text-smoke">Chủ đề</p>
                    <div class="mt-4 space-y-3 text-sm">
                        @foreach ($categories as $category)
                            <a href="{{ route('blog.index', ['category' => $category->id]) }}" class="flex items-center justify-between">
                                <span>{{ $category->name }}</span>
                                <span class="text-xs text-smoke">→</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="glass-card rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.3em] text-smoke">Bài viết nổi bật</p>
                    <div class="mt-4 space-y-4">
                        @forelse ($popular as $post)
                            <a href="{{ route('blog.show', $post) }}" class="block">
                                <p class="text-sm font-semibold">{{ $post->title }}</p>
                                <p class="text-xs text-smoke">{{ $post->views }} lượt xem</p>
                            </a>
                        @empty
                            <p class="text-sm text-smoke">Chưa có bài viết nổi bật.</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection
