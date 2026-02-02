@extends('layouts.app')

@section('content')
    <section class="relative overflow-hidden">
        <div class="container-shell py-16">
            <div class="grid items-center gap-10 lg:grid-cols-[1.1fr_0.9fr]">
                <div class="space-y-6">
                    <span class="chip animate-fade-up">Blog + Store</span>
                    <h1 class="animate-fade-up animate-delay-1 text-4xl font-semibold leading-tight sm:text-5xl">
                        Chọn laptop chuẩn nhu cầu, đọc blog chuẩn gu.
                    </h1>
                    <p class="animate-fade-up animate-delay-2 text-lg text-smoke">
                        VNT Laptop kết hợp gian hàng và blog công nghệ: review sâu, gợi ý cấu hình rõ ràng, giúp bạn ra quyết định nhanh.
                    </p>
                    <div class="animate-fade-up animate-delay-3 flex flex-wrap gap-4">
                        <a href="{{ route('laptops.index') }}" class="rounded-full bg-[rgb(var(--ink))] px-6 py-3 text-sm font-medium text-[rgb(var(--paper))]">
                            Xem laptop
                        </a>
                        <a href="{{ route('blog.index') }}" class="rounded-full border border-line px-6 py-3 text-sm font-medium">
                            Đọc blog
                        </a>
                    </div>
                    <div class="grid gap-4 rounded-3xl border border-line bg-white/70 p-5 text-sm shadow-soft sm:grid-cols-3">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Laptop</p>
                            <p class="text-2xl font-semibold">{{ $stats['laptops'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Bài viết</p>
                            <p class="text-2xl font-semibold">{{ $stats['posts'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Thương hiệu</p>
                            <p class="text-2xl font-semibold">{{ $stats['brands'] }}</p>
                        </div>
                    </div>
                </div>

                @php
                    $heroLaptop = $featuredLaptops->first();
                    $heroImage = null;
                    if ($heroLaptop && $heroLaptop->image) {
                        $heroImage = preg_match('/^https?:\\/\\//', $heroLaptop->image) ? $heroLaptop->image : asset('storage/' . $heroLaptop->image);
                    }
                @endphp
                <div class="glass-card rounded-3xl p-6">
                    <div class="flex items-center justify-between">
                        <p class="text-xs uppercase tracking-[0.4em] text-smoke">Gợi ý nhanh</p>
                        <span class="rounded-full bg-[rgba(221,131,25,0.15)] px-3 py-1 text-xs font-semibold text-[rgb(var(--sun))]">
                            Best pick
                        </span>
                    </div>
                    @if ($heroLaptop)
                        <div class="mt-6 space-y-4">
                            <div class="aspect-[4/3] overflow-hidden rounded-3xl bg-grid">
                                @if ($heroImage)
                                    <img src="{{ $heroImage }}" alt="{{ $heroLaptop->name }}" class="h-full w-full object-cover" />
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-xs uppercase tracking-[0.4em] text-smoke">
                                        Laptop
                                    </div>
                                @endif
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-2xl font-semibold">{{ $heroLaptop->name }}</h3>
                                <p class="text-sm text-smoke">
                                    {{ $heroLaptop->cpu }} · {{ $heroLaptop->ram }} · {{ $heroLaptop->storage }}
                                </p>
                                <p class="text-lg font-semibold text-[rgb(var(--sun))]">{{ $heroLaptop->price_label }}</p>
                            </div>
                            <a href="{{ route('laptops.show', $heroLaptop) }}" class="inline-flex items-center gap-2 text-sm font-medium text-[rgb(var(--teal))]">
                                Xem chi tiết
                                <span class="text-lg">→</span>
                            </a>
                        </div>
                    @else
                        <p class="mt-6 text-sm text-smoke">Chưa có laptop nổi bật. Hãy thêm dữ liệu để hiển thị.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="container-shell py-10">
        <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="rounded-3xl border border-line bg-white/70 p-6">
                <p class="text-xs uppercase tracking-[0.4em] text-smoke">Danh mục laptop</p>
                <div class="mt-4 flex flex-wrap gap-2">
                    @forelse ($laptopCategories as $category)
                        <a href="{{ route('laptops.index', ['category' => $category->id]) }}" class="rounded-full border border-line px-4 py-2 text-sm font-medium">
                            {{ $category->name }}
                        </a>
                    @empty
                        <span class="text-sm text-smoke">Chưa có danh mục laptop.</span>
                    @endforelse
                </div>
            </div>
            <div class="rounded-3xl border border-line bg-white/70 p-6">
                <p class="text-xs uppercase tracking-[0.4em] text-smoke">Chủ đề blog</p>
                <div class="mt-4 flex flex-wrap gap-2">
                    @forelse ($blogCategories as $category)
                        <a href="{{ route('blog.index', ['category' => $category->id]) }}" class="rounded-full border border-line px-4 py-2 text-sm font-medium">
                            {{ $category->name }}
                        </a>
                    @empty
                        <span class="text-sm text-smoke">Chưa có danh mục blog.</span>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section class="container-shell py-10">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-smoke">Laptop nổi bật</p>
                <h2 class="text-3xl font-semibold">Gian hàng chọn lọc</h2>
            </div>
            <a href="{{ route('laptops.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-[rgb(var(--teal))]">
                Xem tất cả
                <span class="text-lg">→</span>
            </a>
        </div>

        <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($featuredLaptops as $laptop)
                <x-laptop-card :laptop="$laptop" />
            @empty
                <p class="text-sm text-smoke">Chưa có laptop để hiển thị.</p>
            @endforelse
        </div>
    </section>

    <section class="container-shell py-10">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-smoke">Bài viết mới</p>
                <h2 class="text-3xl font-semibold">Góc đọc nhanh</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-[rgb(var(--teal))]">
                Xem blog
                <span class="text-lg">→</span>
            </a>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-3">
            @forelse ($latestPosts as $post)
                <x-post-card :post="$post" />
            @empty
                <p class="text-sm text-smoke">Chưa có bài viết mới.</p>
            @endforelse
        </div>
    </section>

    <section class="container-shell py-12">
        <div class="grid gap-6 rounded-3xl border border-line bg-white/70 p-8 lg:grid-cols-3">
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-smoke">Tại sao VNT?</p>
                <h2 class="text-3xl font-semibold">Chọn máy nhanh, hiểu máy sâu.</h2>
            </div>
            <div class="space-y-4 text-sm text-smoke">
                <p>Chúng tôi phân loại laptop theo nhu cầu: học tập, văn phòng, đồ họa, gaming.</p>
                <p>Bài viết phân tích chi tiết hiệu năng, so sánh cấu hình và trải nghiệm thực tế.</p>
            </div>
            <div class="space-y-4 text-sm text-smoke">
                <p>Gợi ý cấu hình theo ngân sách, giúp bạn tối ưu chi phí.</p>
                <p>Hỗ trợ tư vấn 1-1 để chọn đúng chiếc máy phù hợp nhất.</p>
            </div>
        </div>
    </section>

    <section class="container-shell pb-16">
        <div class="flex flex-wrap items-center justify-between gap-6 rounded-3xl bg-[rgb(var(--ink))] px-8 py-10 text-[rgb(var(--paper))]">
            <div class="space-y-2">
                <p class="text-xs uppercase tracking-[0.4em] text-[rgba(245,242,236,0.7)]">Bắt đầu</p>
                <h2 class="text-3xl font-semibold">Cần tư vấn laptop?</h2>
                <p class="text-sm text-[rgba(245,242,236,0.7)]">Gửi nhu cầu, đội ngũ VNT sẽ phản hồi trong 24h.</p>
            </div>
            <a href="{{ route('contact.show') }}" class="rounded-full bg-[rgb(var(--paper))] px-6 py-3 text-sm font-semibold text-[rgb(var(--ink))]">
                Gửi yêu cầu ngay
            </a>
        </div>
    </section>
@endsection
