<div class="space-y-8">
    <div>
        <div class="flex items-center gap-3">
            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[rgb(var(--ink))] text-sm font-semibold tracking-[0.2em] text-[rgb(var(--paper))]">
                VNT
            </span>
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-smoke">Admin</p>
                <p class="text-lg font-semibold">Dashboard</p>
            </div>
        </div>
    </div>

    <nav class="space-y-2 text-sm">
        <a href="{{ route('admin.dashboard') }}" class="block rounded-2xl px-4 py-2 {{ request()->routeIs('admin.dashboard') ? 'bg-[rgb(var(--ink))] text-[rgb(var(--paper))]' : 'border border-line' }}">
            Tổng quan
        </a>
        <a href="{{ route('admin.laptops.index') }}" class="block rounded-2xl px-4 py-2 {{ request()->routeIs('admin.laptops.*') ? 'bg-[rgb(var(--ink))] text-[rgb(var(--paper))]' : 'border border-line' }}">
            Laptop
        </a>
        <a href="{{ route('admin.posts.index') }}" class="block rounded-2xl px-4 py-2 {{ request()->routeIs('admin.posts.*') ? 'bg-[rgb(var(--ink))] text-[rgb(var(--paper))]' : 'border border-line' }}">
            Bài viết
        </a>
        <a href="{{ route('admin.categories.index') }}" class="block rounded-2xl px-4 py-2 {{ request()->routeIs('admin.categories.*') ? 'bg-[rgb(var(--ink))] text-[rgb(var(--paper))]' : 'border border-line' }}">
            Danh mục
        </a>
        <a href="{{ route('admin.contacts.index') }}" class="block rounded-2xl px-4 py-2 {{ request()->routeIs('admin.contacts.*') ? 'bg-[rgb(var(--ink))] text-[rgb(var(--paper))]' : 'border border-line' }}">
            Liên hệ
        </a>
    </nav>

    <div class="rounded-3xl border border-line bg-white/70 p-4 text-sm">
        <p class="text-xs uppercase tracking-[0.3em] text-smoke">Tài khoản</p>
        <p class="mt-2 font-semibold">{{ auth()->user()->name }}</p>
        <p class="text-xs text-smoke">{{ auth()->user()->email }}</p>
    </div>
</div>
