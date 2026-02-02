@props(['post'])

@php
    $image = null;
    if ($post->thumbnail) {
        $image = preg_match('/^https?:\\/\\//', $post->thumbnail) ? $post->thumbnail : asset('storage/' . $post->thumbnail);
    }
    $readingTime = $post->reading_time ?? 1;
@endphp

<article class="group glass-card overflow-hidden rounded-3xl transition duration-300 hover:-translate-y-1 hover:shadow-soft">
    <div class="relative aspect-[4/3] overflow-hidden bg-grid">
        @if ($image)
            <img src="{{ $image }}" alt="{{ $post->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
        @else
            <div class="flex h-full w-full items-center justify-center text-sm uppercase tracking-[0.4em] text-smoke">
                Blog
            </div>
        @endif
        <div class="absolute left-4 top-4 rounded-full bg-[rgba(255,255,255,0.8)] px-3 py-1 text-xs font-semibold text-[rgb(var(--sun))]">
            {{ $post->category?->name ?? 'Blog' }}
        </div>
    </div>
    <div class="space-y-4 p-5">
        <div>
            <h3 class="text-lg font-semibold leading-snug">{{ $post->title }}</h3>
            <p class="mt-2 text-sm text-smoke">
                {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 140) }}
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-3 text-xs text-smoke">
            <span>{{ $post->created_at?->format('d/m/Y') }}</span>
            <span>•</span>
            <span>{{ $readingTime }} phút đọc</span>
            <span>•</span>
            <span>{{ $post->views }} lượt xem</span>
        </div>
        <a href="{{ route('blog.show', $post) }}" class="inline-flex items-center gap-2 text-sm font-medium text-[rgb(var(--teal))]">
            Đọc bài
            <span class="text-lg">→</span>
        </a>
    </div>
</article>
