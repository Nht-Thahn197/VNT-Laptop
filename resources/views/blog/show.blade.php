@extends('layouts.app')

@section('content')
    <section class="container-shell py-12">
        <div class="grid gap-10 lg:grid-cols-[1fr_300px]">
            <article class="space-y-6">
                <span class="chip">Blog Detail</span>
                <h1 class="text-4xl font-semibold">{{ $post->title }}</h1>
                <div class="flex flex-wrap items-center gap-3 text-sm text-smoke">
                    <span>{{ $post->created_at?->format('d/m/Y') }}</span>
                    <span>•</span>
                    <span>{{ $post->reading_time }} phút đọc</span>
                    <span>•</span>
                    <span>{{ $post->views }} lượt xem</span>
                </div>

                @php
                    $postImage = null;
                    if ($post->thumbnail) {
                        $postImage = preg_match('/^https?:\\/\\//', $post->thumbnail) ? $post->thumbnail : asset('storage/' . $post->thumbnail);
                    }
                @endphp
                <div class="glass-card overflow-hidden rounded-3xl">
                    <div class="aspect-[16/9] bg-grid">
                        @if ($postImage)
                            <img src="{{ $postImage }}" alt="{{ $post->title }}" class="h-full w-full object-cover" />
                        @else
                            <div class="flex h-full w-full items-center justify-center text-sm uppercase tracking-[0.4em] text-smoke">
                                Blog
                            </div>
                        @endif
                    </div>
                </div>

                <div class="article-body text-lg leading-relaxed text-ink">
                    {!! nl2br(e($post->content)) !!}
                </div>

                @if ($post->laptops->isNotEmpty())
                    <div class="mt-8 rounded-3xl border border-line bg-white/70 p-6">
                        <h2 class="text-2xl font-semibold">Laptop liên quan</h2>
                        <div class="mt-4 grid gap-4 md:grid-cols-2">
                            @foreach ($post->laptops as $laptop)
                                <div class="rounded-2xl border border-line p-4">
                                    <p class="text-sm text-smoke">{{ $laptop->brand ?? 'Laptop' }}</p>
                                    <p class="text-lg font-semibold">{{ $laptop->name }}</p>
                                    <p class="text-sm text-[rgb(var(--sun))]">{{ $laptop->price_label }}</p>
                                    <a href="{{ route('laptops.show', $laptop) }}" class="mt-2 inline-flex items-center gap-2 text-sm font-medium text-[rgb(var(--teal))]">
                                        Xem máy
                                        <span class="text-lg">→</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </article>

            <aside class="space-y-6">
                <div class="glass-card rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.3em] text-smoke">Tác giả</p>
                    <div class="mt-4">
                        <p class="text-lg font-semibold">{{ $post->user?->name ?? 'VNT Editor' }}</p>
                        <p class="text-sm text-smoke">{{ $post->user?->email ?? 'support@vntlaptop.vn' }}</p>
                    </div>
                </div>

                <div class="glass-card rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.3em] text-smoke">Bài viết mới</p>
                    <div class="mt-4 space-y-4">
                        @forelse ($recent as $item)
                            <a href="{{ route('blog.show', $item) }}" class="block">
                                <p class="text-sm font-semibold">{{ $item->title }}</p>
                                <p class="text-xs text-smoke">{{ $item->created_at?->format('d/m/Y') }}</p>
                            </a>
                        @empty
                            <p class="text-sm text-smoke">Chưa có bài viết khác.</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection
