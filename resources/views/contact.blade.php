@extends('layouts.app')

@section('content')
    <section class="container-shell py-12">
        <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="space-y-6">
                <span class="chip">Liên hệ</span>
                <h1 class="text-4xl font-semibold">Gửi nhu cầu, nhận tư vấn nhanh</h1>
                <p class="text-sm text-smoke">
                    Cho chúng tôi biết ngân sách, mục đích sử dụng, và ưu tiên của bạn. VNT sẽ phản hồi trong 24h.
                </p>

                <div class="grid gap-4 rounded-3xl border border-line bg-white/70 p-6 text-sm">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-smoke">Hotline</p>
                        <p class="text-lg font-semibold">0909 123 456</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-smoke">Email</p>
                        <p class="text-lg font-semibold">support@vntlaptop.vn</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-smoke">Cửa hàng</p>
                        <p class="text-lg font-semibold">88 Nguyễn Trãi, Q.1, TP.HCM</p>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-3xl p-6">
                <h2 class="text-2xl font-semibold">Thông tin liên hệ</h2>

                @if (session('success'))
                    <div class="mt-4 rounded-2xl border border-line bg-[rgba(34,128,118,0.1)] px-4 py-3 text-sm text-[rgb(var(--teal))]">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="post" class="mt-6 space-y-4">
                    @csrf
                    <div>
                        <input type="text" name="name" class="soft-input" placeholder="Họ tên" value="{{ old('name') }}" required />
                        @error('name')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="email" name="email" class="soft-input" placeholder="Email" value="{{ old('email') }}" required />
                        @error('email')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="text" name="phone" class="soft-input" placeholder="Số điện thoại" value="{{ old('phone') }}" />
                        @error('phone')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <textarea name="message" rows="5" class="soft-input" placeholder="Mô tả nhu cầu của bạn">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full rounded-full bg-[rgb(var(--ink))] px-6 py-3 text-sm font-semibold text-[rgb(var(--paper))]">
                        Gửi yêu cầu
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
