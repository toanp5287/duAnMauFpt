<?php
$item_total = ((float)($item['gia'] ?? 0) * (int)($item['so_luong'] ?? 1));
?>
<article class="flex flex-col sm:flex-row gap-5 p-5 sm:p-6 bg-white rounded-2xl border border-ink-200 shadow-soft hover:shadow-lift transition-all duration-300">

    <input type="checkbox" name="cart_selected[]" class="check-sp"
        value="<?= (int)($item['san_pham_id'] ?? 0) ?>"
        data-price="<?php echo (float)($item['gia'] ?? 0); ?>"
        data-quantity="<?php echo (int)($item['so_luong'] ?? 1); ?>"
        data-id="<?php echo (int)($item['id'] ?? 0); ?>"
        checked>

    <img
        src="/web-ban-hang/admin/public/uploads/<?php echo htmlspecialchars($item['hinh_anh'] ?? ''); ?>"
        alt="<?php echo htmlspecialchars($item['ten_san_pham'] ?? 'Sản phẩm'); ?>"
        class="w-full sm:w-32 h-32 object-contain rounded-xl bg-surface shrink-0 border border-ink-200 p-2" />

    <div class="flex-1 min-w-0 flex flex-col">
        <div class="flex flex-col sm:flex-row sm:justify-between gap-3 mb-5">
            <div>
                <h3 class="text-base font-bold text-ink-900"><?php echo htmlspecialchars($item['ten_san_pham'] ?? 'Sản phẩm'); ?></h3>
                <div class="text-sale font-extrabold mt-1">
                    <?php echo number_format($item['gia'] ?? 0, 0, ',', '.'); ?> ₫
                </div>
            </div>
            <div class="sm:text-right">
                <span class="text-[10px] font-bold uppercase tracking-widest text-ink-400">Thành tiền</span>
                <div class="text-xl font-extrabold text-ink-900 mt-1">
                    <?php echo number_format($item_total, 0, ',', '.'); ?> ₫
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-4 mt-auto pt-4 border-t border-ink-50">
            <div class="flex items-center gap-3">
                <label class="text-sm font-semibold text-ink-500" for="qty-<?php echo (int)($item['san_pham_id'] ?? 0); ?>">SL</label>
                <div class="relative">
                    <input
                        id="qty-<?php echo (int)($item['san_pham_id'] ?? 0); ?>"
                        type="number"
                        name="qty[<?php echo (int)($item['san_pham_id'] ?? 0); ?>]"
                        class="w-20 h-10 text-center text-sm font-bold border border-ink-200 rounded-xl bg-surface focus:outline-none focus:border-primary-500 focus:bg-white transition-colors"
                        value="<?php echo (int)($item['so_luong'] ?? 1); ?>"
                        min="1"
                        oninput="syncQuantity(<?= (int)($item['id'] ?? 0); ?>, this.value); updateQuantity(<?= (int)($item['id'] ?? 0); ?>, this.value)">
                </div>
            </div>

            <a
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-bold text-red-500 bg-red-50 rounded-lg hover:bg-red-100 hover:text-red-600 transition-colors"
                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?');"
                href="index.php?controller=shopping_cart&action=delete_gio_hang&id=<?php echo (int)($item['id'] ?? 0); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Xóa
            </a>
        </div>
    </div>
</article>