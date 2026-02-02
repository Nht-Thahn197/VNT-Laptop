<nav class="sticky top-0 z-40 border-b border-line bg-[rgba(245,242,236,0.75)] backdrop-blur">
    <div class="container-shell">
        <div class="flex items-center justify-between py-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[rgb(var(--ink))] text-sm font-semibold tracking-[0.2em] text-[rgb(var(--paper))]">
                    VNT
                </span>
                <div>
                    <p class="text-sm uppercase tracking-[0.4em] text-smoke">Laptop Lab</p>
                    <p class="text-lg font-semibold">VNT Laptop</p>
                </div>
            </a>

            <div class="hidden items-center gap-8 md:flex">
                <a href="{{ route('laptops.index') }}" class="text-sm font-medium {{ request()->routeIs('laptops.*') ? 'text-[rgb(var(--teal))]' : 'text-ink' }}">
                    Laptop
                </a>
                <a href="{{ route('blog.index') }}" class="text-sm font-medium {{ request()->routeIs('blog.*') ? 'text-[rgb(var(--teal))]' : 'text-ink' }}">
                    Blog
                </a>
                <a href="{{ route('contact.show') }}" class="text-sm font-medium {{ request()->routeIs('contact.*') ? 'text-[rgb(var(--teal))]' : 'text-ink' }}">
                    Liên hệ
                </a>
                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-[rgb(var(--sun))]">
                            Admin
                        </a>
                    @endif
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-smoke">Xin chào, {{ auth()->user()->name }}</span>
                        <form method="post" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit" class="rounded-full border border-line px-3 py-1 text-xs font-medium">
                                Đăng xuất
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('auth.login') }}" class="text-sm font-medium">Đăng nhập</a>
                    <a href="{{ route('auth.register') }}" class="rounded-full border border-line px-4 py-2 text-sm font-medium">
                        Đăng ký
                    </a>
                @endauth
                <div class="hidden items-center gap-3 lg:flex">
                    <span class="rounded-full border border-line px-3 py-1 text-xs text-smoke">Hotline: 0909 123 456</span>
                    <a href="{{ route('contact.show') }}" class="rounded-full bg-[rgb(var(--ink))] px-4 py-2 text-sm font-medium text-[rgb(var(--paper))]">
                        Gửi yêu cầu
                    </a>
                </div>
            </div>

            <button
                class="flex h-11 w-11 items-center justify-center rounded-full border border-line md:hidden"
                aria-label="Toggle navigation"
                aria-expanded="false"
                data-nav-toggle
            >
                <span class="h-0.5 w-5 bg-[rgb(var(--ink))]"></span>
            </button>
        </div>

        <div class="hidden pb-4 md:hidden" data-nav-menu>
            <div class="grid gap-3 rounded-3xl border border-line bg-white/70 p-4 text-sm">
                <a href="{{ route('laptops.index') }}" class="font-medium">Laptop</a>
                <a href="{{ route('blog.index') }}" class="font-medium">Blog</a>
                <a href="{{ route('contact.show') }}" class="font-medium">Liên hệ</a>
                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="font-medium text-[rgb(var(--sun))]">Admin</a>
                    @endif
                    <form method="post" action="{{ route('auth.logout') }}">
                        @csrf
                        <button type="submit" class="w-full rounded-2xl border border-line px-4 py-2 text-sm font-medium">
                            Đăng xuất
                        </button>
                    </form>
                @else
                    <a href="{{ route('auth.login') }}" class="font-medium">Đăng nhập</a>
                    <a href="{{ route('auth.register') }}" class="font-medium">Đăng ký</a>
                @endauth
                <div class="rounded-2xl bg-[rgb(var(--ink))] px-4 py-2 text-center text-[rgb(var(--paper))]">
                    Hotline: 0909 123 456
                </div>
            </div>
        </div>
    </div>
</nav>
