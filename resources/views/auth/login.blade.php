@extends('layouts.app')

@section('content')
    <section class="container-shell py-16">
        <div class="mx-auto max-w-lg glass-card rounded-3xl p-8">
            <span class="chip">Đăng nhập</span>
            <h1 class="mt-4 text-3xl font-semibold">Chào mừng bạn quay lại</h1>
            <p class="mt-2 text-sm text-smoke">Đăng nhập để quản lý và theo dõi yêu thích.</p>

            <form method="post" action="{{ route('auth.login.submit') }}" class="mt-6 space-y-4">
                @csrf
                <div>
                    <input type="email" name="email" class="soft-input" placeholder="Email" value="{{ old('email') }}" required />
                    @error('email')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <input type="password" name="password" class="soft-input" placeholder="Mật khẩu" required />
                    @error('password')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full rounded-full bg-[rgb(var(--ink))] px-6 py-3 text-sm font-semibold text-[rgb(var(--paper))]">
                    Đăng nhập
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-smoke">
                Chưa có tài khoản?
                <a href="{{ route('auth.register') }}" class="font-semibold text-[rgb(var(--teal))]">Đăng ký</a>
            </p>
        </div>
    </section>
@endsection
