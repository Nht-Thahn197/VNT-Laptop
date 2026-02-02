@extends('layouts.app')

@section('content')
    <section class="container-shell py-12">
        <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="space-y-6">
                <span class="chip">Laptop Detail</span>
                <h1 class="text-4xl font-semibold">{{ $laptop->name }}</h1>
                <p class="text-sm text-smoke">
                    {{ $laptop->category?->name ?? 'Laptop' }} · {{ $laptop->brand ?? 'Thương hiệu' }}
                </p>
                <p class="text-2xl font-semibold text-[rgb(var(--sun))]">{{ $laptop->price_label }}</p>

                <div class="grid gap-4 rounded-3xl border border-line bg-white/70 p-6 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-smoke">CPU</span>
                        <span class="font-medium">{{ $laptop->cpu ?? 'Đang cập nhật' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-smoke">RAM</span>
                        <span class="font-medium">{{ $laptop->ram ?? 'Đang cập nhật' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-smoke">Ổ cứng</span>
                        <span class="font-medium">{{ $laptop->storage ?? 'Đang cập nhật' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-smoke">GPU</span>
                        <span class="font-medium">{{ $laptop->gpu ?? 'Đang cập nhật' }}</span>
                    </div>
                </div>

                <a href="{{ route('contact.show') }}" class="inline-flex items-center gap-2 rounded-full bg-[rgb(var(--ink))] px-6 py-3 text-sm font-semibold text-[rgb(var(--paper))]">
                    Nhận tư vấn cấu hình
                </a>
            </div>

            @php
                $detailImage = null;
                if ($laptop->image) {
                    $detailImage = preg_match('/^https?:\\/\\//', $laptop->image) ? $laptop->image : asset('storage/' . $laptop->image);
                }
            @endphp
            <div class="glass-card rounded-3xl p-6">
                <div class="aspect-[4/3] overflow-hidden rounded-3xl bg-grid">
                    @if ($detailImage)
                        <img src="{{ $detailImage }}" alt="{{ $laptop->name }}" class="h-full w-full object-cover" />
                    @else
                        <div class="flex h-full w-full items-center justify-center text-sm uppercase tracking-[0.4em] text-smoke">
                            Laptop
                        </div>
                    @endif
                </div>
                <div class="mt-4 space-y-3 text-sm text-smoke">
                    <p>{{ $laptop->description ?? 'Mô tả đang cập nhật. Liên hệ để nhận tư vấn chi tiết.' }}</p>
                </div>
            </div>
        </div>
    </section>

    @if ($laptop->posts->isNotEmpty())
        <section class="container-shell pb-12">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl font-semibold">Bài viết liên quan</h2>
                <a href="{{ route('blog.index') }}" class="text-sm font-medium text-[rgb(var(--teal))]">Xem blog</a>
            </div>
            <div class="mt-6 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($laptop->posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        </section>
    @endif

    @if ($related->isNotEmpty())
        <section class="container-shell pb-16">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl font-semibold">Laptop tương tự</h2>
                <a href="{{ route('laptops.index') }}" class="text-sm font-medium text-[rgb(var(--teal))]">Xem thêm</a>
            </div>
            <div class="mt-6 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($related as $item)
                    <x-laptop-card :laptop="$item" />
                @endforeach
            </div>
        </section>
    @endif
@endsection
