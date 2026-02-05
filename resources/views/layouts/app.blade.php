<!doctype html>
<html lang="vi">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="VNT Laptop - blog công nghệ và tư vấn chọn laptop đúng nhu cầu." />
        <title>{{ config('app.name', 'VNT Laptop') }}</title>
        <link rel="icon" href="{{ asset('favicon-admin.ico') }}" type="image/x-icon" />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Newsreader:opsz,wght@6..72,500;6..72,600;6..72,700&family=Space+Grotesk:wght@400;500;600;700&display=swap"
            rel="stylesheet"
        />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="text-ink">
        <div class="min-h-screen flex flex-col">
            @include('partials.nav')

            <main class="flex-1">
                @yield('content')
            </main>

            @include('partials.footer')
        </div>
    </body>
</html>
