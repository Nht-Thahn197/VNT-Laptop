@extends('layouts.admin')

@section('content')
    <div class="grid gap-6 lg:grid-cols-4">
        <div class="rounded-3xl border border-line bg-white/80 p-5">
            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Laptop</p>
            <p class="text-3xl font-semibold">{{ $stats['laptops'] }}</p>
        </div>
        <div class="rounded-3xl border border-line bg-white/80 p-5">
            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Bài viết</p>
            <p class="text-3xl font-semibold">{{ $stats['posts'] }}</p>
        </div>
        <div class="rounded-3xl border border-line bg-white/80 p-5">
            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Người dùng</p>
            <p class="text-3xl font-semibold">{{ $stats['users'] }}</p>
        </div>
        <div class="rounded-3xl border border-line bg-white/80 p-5">
            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Liên hệ</p>
            <p class="text-3xl font-semibold">{{ $stats['contacts'] }}</p>
        </div>
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-3">
        <div class="rounded-3xl border border-line bg-white/80 p-6">
            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Laptop mới</p>
            <div class="mt-4 space-y-3 text-sm">
                @forelse ($recentLaptops as $laptop)
                    <div class="flex items-center justify-between">
                        <span>{{ $laptop->name }}</span>
                        <span class="text-xs text-smoke">{{ $laptop->created_at?->format('d/m/Y') }}</span>
                    </div>
                @empty
                    <p class="text-sm text-smoke">Chưa có laptop.</p>
                @endforelse
            </div>
        </div>

        <div class="rounded-3xl border border-line bg-white/80 p-6">
            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Bài viết mới</p>
            <div class="mt-4 space-y-3 text-sm">
                @forelse ($recentPosts as $post)
                    <div class="flex items-center justify-between">
                        <span>{{ $post->title }}</span>
                        <span class="text-xs text-smoke">{{ $post->created_at?->format('d/m/Y') }}</span>
                    </div>
                @empty
                    <p class="text-sm text-smoke">Chưa có bài viết.</p>
                @endforelse
            </div>
        </div>

        <div class="rounded-3xl border border-line bg-white/80 p-6">
            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Liên hệ mới</p>
            <div class="mt-4 space-y-3 text-sm">
                @forelse ($recentContacts as $contact)
                    <div class="flex items-center justify-between">
                        <span>{{ $contact->name ?? 'Khách' }}</span>
                        <span class="text-xs text-smoke">{{ \Illuminate\Support\Str::limit($contact->message, 30) }}</span>
                    </div>
                @empty
                    <p class="text-sm text-smoke">Chưa có liên hệ.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
