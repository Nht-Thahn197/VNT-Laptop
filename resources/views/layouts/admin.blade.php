<!doctype html>
<html lang="vi">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Admin - {{ config('app.name', 'VNT Laptop') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Newsreader:opsz,wght@6..72,500;6..72,600;6..72,700&family=Space+Grotesk:wght@400;500;600;700&display=swap"
            rel="stylesheet"
        />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-paper text-ink">
        <div class="min-h-screen lg:flex">
            <aside class="hidden w-72 border-r border-line bg-white/80 p-6 lg:block">
                @include('admin.partials.sidebar')
            </aside>

            <div class="flex-1">
                <header class="border-b border-line bg-white/80 px-6 py-4">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.4em] text-smoke">Admin panel</p>
                            <h1 class="text-2xl font-semibold">VNT Laptop</h1>
                        </div>
                        <div class="flex flex-wrap items-center gap-3 text-sm">
                            <a href="{{ route('home') }}" class="rounded-full border border-line px-4 py-2">Về website</a>
                            <form method="post" action="{{ route('auth.logout') }}">
                                @csrf
                                <button type="submit" class="rounded-full bg-[rgb(var(--ink))] px-4 py-2 text-[rgb(var(--paper))]">
                                    Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>
                </header>

                <main class="p-6">
                    @if (session('success'))
                        <div class="mb-6 rounded-2xl border border-line bg-[rgba(34,128,118,0.12)] px-4 py-3 text-sm text-[rgb(var(--teal))]">
                            {{ session('success') }}
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
