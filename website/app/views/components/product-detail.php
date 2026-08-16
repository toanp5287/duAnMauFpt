<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-14">

    <!-- LEFT: Gallery -->
    <div class="space-y-4">
        <div class="relative aspect-square bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm group">
            <button id="prv" type="button"
                class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 flex items-center justify-center rounded-xl bg-white/95 border border-slate-200 text-slate-500 hover:text-blue-600 hover:border-blue-600 shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-100"
                aria-label="Ảnh trước">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>

            <img id="imgs"
                src="/web-ban-hang/public/uploads/<?php echo $list_san_pham['hinh_anh']; ?>"
                alt="<?php echo htmlspecialchars($list_san_pham['ten_san_pham']); ?>"
                class="w-full h-full object-contain p-6 sm:p-10 transition-transform duration-300 group-hover:scale-105" />

            <button id="next" type="button"
                class="absolute right-3 sm:right-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 flex items-center justify-center rounded-xl bg-white/95 border border-slate-200 text-slate-500 hover:text-blue-600 hover:border-blue-600 shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-100"
                aria-label="Ảnh sau">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>

        <p class="flex items-center justify-center gap-2 text-xs text-slate-500">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14" />
            </svg>
            Hình ảnh sản phẩm chính hãng
        </p>
    </div>

    <!-- RIGHT: Product Info -->
    <div class="flex flex-col">
        <span class="inline-flex w-fit items-center px-3 py-1 text-xs font-medium uppercase tracking-wide text-blue-600 bg-blue-50 border border-blue-100 rounded-lg mb-4">
            <?php echo htmlspecialchars($list_san_pham['ten_loai'] ?? 'Danh mục'); ?>
        </span>

        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 leading-tight">
            <?php echo htmlspecialchars($list_san_pham['ten_san_pham']); ?>
        </h1>

        <div class="flex items-center gap-3 mt-4 mb-6">
            <div class="flex text-amber-500 text-sm" aria-hidden="true">★★★★★</div>
            <span class="text-sm text-slate-500">5.0 · Đánh giá sản phẩm</span>
        </div>

        <div class="pb-6 border-b border-slate-200">
            <p class="text-sm text-slate-500 mb-1">Giá sản phẩm</p>
            <span class="text-3xl sm:text-4xl font-semibold text-blue-600">
                <?= number_format($list_san_pham['gia'] ?? 0, 0, ',', '.') ?> ₫
            </span>
        </div>
        <?php if ($list_san_pham['so_luong'] != 0): ?>

            <!-- Còn hàng -->
            <div class="flex items-center gap-3 py-5">
                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg 
                     bg-green-50 text-green-600 border border-green-200 
                     text-xs font-semibold">

                    <svg class="w-3.5 h-3.5 shrink-0"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2.5"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 13l4 4L19 7" />
                    </svg>

                    Còn hàng
                </span>

                <span class="text-xs text-slate-500">
                    Sản phẩm chính hãng
                </span>
            </div>

        <?php else: ?>

            <!-- Hết hàng -->
            <div class="flex items-center gap-3 py-5">
                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg 
                     bg-red-50 text-red-600 border border-red-200 
                     text-xs font-semibold">

                    <svg class="w-3.5 h-3.5 shrink-0"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2.5"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>

                    Hết hàng
                </span>

                <span class="text-xs text-slate-500">
                    Sản phẩm chính hãng
                </span>
            </div>

        <?php endif; ?>
        <?php if (!empty($list_san_pham['mo_ta'])) { ?>
            <div class="mb-6">
                <p class="text-sm text-slate-600 leading-relaxed line-clamp-3">
                    <?php echo strip_tags(mb_substr($list_san_pham['mo_ta'], 0, 200)); ?>...
                </p>
            </div>
        <?php } ?>

        <?php if ($list_san_pham['so_luong'] != 0): ?>

            <!-- CÒN HÀNG -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-8">

                <a href="index.php?controller=chi_tiet&action=them_gio_hang&id=<?php echo $list_san_pham['id']; ?>"
                    class="ds-btn-primary h-12 gap-2 text-sm">

                    <svg class="w-5 h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>

                    Thêm vào giỏ
                </a>

                <a href="index.php?controller=buy&action=index&id=<?php echo $list_san_pham['id']; ?>"
                    class="ds-btn-success h-12 gap-2 text-sm">

                    <svg class="w-5 h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>

                    Mua ngay
                </a>

            </div>

        <?php else: ?>

            <!-- HẾT HÀNG -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-8">

                <!-- Thêm vào giỏ - bị vô hiệu hóa -->
                <button
                    type="button"
                    disabled
                    class="h-12 gap-2 text-sm inline-flex items-center justify-center
                   rounded-lg bg-slate-100 text-slate-400
                   border border-slate-200
                   cursor-not-allowed opacity-70">

                    <svg class="w-5 h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>

                    Hết hàng
                </button>

                <!-- Mua ngay - bị vô hiệu hóa -->
                <button
                    type="button"
                    disabled
                    class="h-12 gap-2 text-sm inline-flex items-center justify-center
                   rounded-lg bg-slate-100 text-slate-400
                   border border-slate-200
                   cursor-not-allowed opacity-70">

                    <svg class="w-5 h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>

                    Hết hàng
                </button>

            </div>

        <?php endif; ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div class="flex gap-3 p-4 rounded-xl bg-slate-50 border border-slate-200">
                <div class="w-10 h-10 shrink-0 flex items-center justify-center rounded-lg bg-green-50 border border-green-100 text-green-600" aria-hidden="true">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-900">Bảo hành chính hãng</p>
                    <p class="text-xs text-slate-500 mt-1">12 tháng toàn quốc</p>
                </div>
            </div>
            <div class="flex gap-3 p-4 rounded-xl bg-slate-50 border border-slate-200">
                <div class="w-10 h-10 shrink-0 flex items-center justify-center rounded-lg bg-blue-50 border border-blue-100 text-blue-600" aria-hidden="true">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-900">Đổi trả 30 ngày</p>
                    <p class="text-xs text-slate-500 mt-1">Hỗ trợ nếu sản phẩm lỗi</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Spec Card -->
<?php include __DIR__ . '/spec-card.php'; ?>

<!-- Mô tả sản phẩm -->
<div class="mt-10 pt-8 border-t border-slate-200">
    <h2 class="text-xl sm:text-2xl font-bold text-slate-900 mb-6">Mô tả & thông số</h2>
    <div class="product-description w-full text-sm sm:text-base leading-relaxed text-slate-600
        [&>p]:mb-5 [&>p:last-child]:mb-0
        [&>h2]:mt-8 [&>h2]:mb-4 [&>h2]:text-xl [&>h2]:font-bold [&>h2]:text-slate-900
        [&>h3]:mt-6 [&>h3]:mb-3 [&>h3]:text-lg [&>h3]:font-semibold [&>h3]:text-slate-900
        [&>h4]:mt-5 [&>h4]:mb-2 [&>h4]:font-semibold [&>h4]:text-slate-900
        [&_ul]:grid [&_ul]:grid-cols-1 sm:[&_ul]:grid-cols-2 lg:[&_ul]:grid-cols-3 [&_ul]:gap-3 [&_ul]:my-6 [&_ul]:p-0 [&_ul]:list-none
        [&_li]:px-4 [&_li]:py-3 [&_li]:rounded-xl [&_li]:border [&_li]:border-slate-200 [&_li]:bg-slate-50 [&_li]:text-sm [&_li]:text-slate-600
        [&_strong]:font-semibold [&_strong]:text-slate-900 [&_b]:font-semibold [&_b]:text-slate-900
        [&_img]:block [&_img]:max-w-full [&_img]:h-auto [&_img]:mx-auto [&_img]:my-6 [&_img]:rounded-xl
        [&_table]:w-full [&_table]:my-6 [&_table]:border [&_table]:border-slate-200 [&_table]:rounded-xl [&_table]:overflow-hidden [&_table]:text-sm
        [&_th]:bg-slate-50 [&_th]:px-4 [&_th]:py-3 [&_th]:text-left [&_th]:font-semibold [&_th]:text-slate-900 [&_th]:border-b [&_th]:border-slate-200
        [&_td]:px-4 [&_td]:py-3 [&_td]:border-b [&_td]:border-slate-200">
        <?php echo $list_san_pham['mo_ta'] ?? 'Sản phẩm này chưa có mô tả chi tiết.'; ?>
    </div>
</div>