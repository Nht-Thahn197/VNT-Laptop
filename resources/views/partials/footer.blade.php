<footer class="border-t border-line bg-[rgba(245,242,236,0.9)]">
    <div class="container-shell py-12">
        <div class="grid gap-10 md:grid-cols-[1.2fr_1fr_1fr]">
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[rgb(var(--ink))] text-sm font-semibold tracking-[0.2em] text-[rgb(var(--paper))]">
                        VNT
                    </span>
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-smoke">Laptop Lab</p>
                        <p class="text-lg font-semibold">VNT Laptop</p>
                    </div>
                </div>
                <p class="text-sm text-smoke">
                    Blog công nghệ kết hợp gian hàng laptop. Tư vấn, review và gợi ý cấu hình rõ ràng theo từng nhu cầu.
                </p>
                <div class="flex flex-wrap gap-2 text-xs text-smoke">
                    <span class="rounded-full border border-line px-3 py-1">Tư vấn mua máy</span>
                    <span class="rounded-full border border-line px-3 py-1">Deal theo nhu cầu</span>
                    <span class="rounded-full border border-line px-3 py-1">Hỗ trợ kỹ thuật</span>
                </div>
            </div>

            <div class="space-y-3 text-sm">
                <p class="text-xs uppercase tracking-[0.3em] text-smoke">Danh mục</p>
                <a href="{{ route('laptops.index') }}" class="block font-medium">Laptop bán chạy</a>
                <a href="{{ route('blog.index') }}" class="block font-medium">Bài viết mới</a>
                <a href="{{ route('contact.show') }}" class="block font-medium">Gửi yêu cầu</a>
            </div>

            <div class="space-y-3 text-sm">
                <p class="text-xs uppercase tracking-[0.3em] text-smoke">Liên hệ</p>
                <p class="font-medium">Cửa hàng: 141 Trương Định, P. Tương Mai, TP. Hà Nội</p>
                <p class="font-medium">Email: vntlaptop@gmail.com</p>
                <p class="font-medium">Hotline: 0909 123 456</p>
            </div>
        </div>

        <div class="mt-10 flex flex-wrap items-center justify-between gap-3 border-t border-line pt-6 text-xs text-smoke">
            <p>&copy; {{ date('Y') }} VNT Laptop. All rights reserved.</p>
            <p>Thiết kế tối ưu cho blog &amp; cửa hàng laptop.</p>
        </div>
    </div>
</footer>
