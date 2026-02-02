@extends('layouts.app')

@section('content')
    <section class="container-shell py-12">
        <div class="space-y-3">
            <span class="chip">Laptop Store</span>
            <h1 class="text-4xl font-semibold">Danh sách laptop</h1>
            <p class="text-sm text-smoke">
                Lọc theo thương hiệu, RAM, ngân sách để tìm máy phù hợp nhu cầu của bạn.
            </p>
        </div>
    </section>

    <section class="container-shell pb-16">
        <div class="grid gap-8 lg:grid-cols-[280px_1fr]">
            <aside class="space-y-6">
                <form method="get" class="glass-card rounded-3xl p-5">
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Danh mục</p>
                            <select name="category" class="soft-input mt-2">
                                <option value="">Tất cả</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected((string) $category->id === request('category'))>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Thương hiệu</p>
                            <select name="brand" class="soft-input mt-2">
                                <option value="">Tất cả</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand }}" @selected($brand === request('brand'))>{{ $brand }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-smoke">RAM</p>
                            <select name="ram" class="soft-input mt-2">
                                <option value="">Tất cả</option>
                                @foreach ($rams as $ram)
                                    <option value="{{ $ram }}" @selected($ram === request('ram'))>{{ $ram }}</option>
                                @endforeach
                            </select>
                        </div>

                        @php
                            $minPrice = (int) data_get($priceRange, 'min_price', 0);
                            $maxPrice = (int) data_get($priceRange, 'max_price', 0);
                        @endphp
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Ngân sách</p>
                            <div class="mt-2 grid gap-3">
                                <input type="number" name="min" class="soft-input" placeholder="Từ ({{ $minPrice }}đ)" value="{{ request('min') }}" />
                                <input type="number" name="max" class="soft-input" placeholder="Đến ({{ $maxPrice }}đ)" value="{{ request('max') }}" />
                            </div>
                        </div>

                        <button type="submit" class="w-full rounded-full bg-[rgb(var(--ink))] px-4 py-2 text-sm font-semibold text-[rgb(var(--paper))]">
                            Áp dụng lọc
                        </button>
                    </div>
                </form>

                @if (request()->hasAny(['category', 'brand', 'ram', 'min', 'max']))
                    <a href="{{ route('laptops.index') }}" class="block rounded-2xl border border-line px-4 py-3 text-center text-sm font-medium">
                        Xóa bộ lọc
                    </a>
                @endif
            </aside>

            <div>
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <p class="text-sm text-smoke">
                        Hiển thị {{ $laptops->count() }} / {{ $laptops->total() }} laptop
                    </p>
                </div>

                <div class="mt-6 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($laptops as $laptop)
                        <x-laptop-card :laptop="$laptop" />
                    @empty
                        <p class="text-sm text-smoke">Không tìm thấy laptop phù hợp.</p>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $laptops->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
