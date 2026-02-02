@props(['laptop'])

@php
    $image = null;
    if ($laptop->image) {
        $image = preg_match('/^https?:\\/\\//', $laptop->image) ? $laptop->image : asset('storage/' . $laptop->image);
    }
@endphp

<article class="group glass-card overflow-hidden rounded-3xl transition duration-300 hover:-translate-y-1 hover:shadow-soft">
    <div class="relative aspect-[4/3] overflow-hidden bg-grid">
        @if ($image)
            <img src="{{ $image }}" alt="{{ $laptop->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
        @else
            <div class="flex h-full w-full items-center justify-center text-sm uppercase tracking-[0.4em] text-smoke">
                No Image
            </div>
        @endif
        <div class="absolute left-4 top-4 rounded-full bg-[rgba(255,255,255,0.8)] px-3 py-1 text-xs font-semibold text-[rgb(var(--teal))]">
            {{ $laptop->category?->name ?? 'Laptop' }}
        </div>
    </div>
    <div class="space-y-4 p-5">
        <div class="flex items-start justify-between gap-3">
            <h3 class="text-lg font-semibold leading-snug">{{ $laptop->name }}</h3>
            <p class="text-sm font-semibold text-[rgb(var(--sun))]">{{ $laptop->price_label }}</p>
        </div>
        <div class="flex flex-wrap gap-2 text-xs text-smoke">
            @if ($laptop->cpu)
                <span class="rounded-full border border-line px-3 py-1">CPU {{ $laptop->cpu }}</span>
            @endif
            @if ($laptop->ram)
                <span class="rounded-full border border-line px-3 py-1">{{ $laptop->ram }}</span>
            @endif
            @if ($laptop->storage)
                <span class="rounded-full border border-line px-3 py-1">{{ $laptop->storage }}</span>
            @endif
        </div>
        <a href="{{ route('laptops.show', $laptop) }}" class="inline-flex items-center gap-2 text-sm font-medium text-[rgb(var(--teal))]">
            Xem chi tiết
            <span class="text-lg">→</span>
        </a>
    </div>
</article>
