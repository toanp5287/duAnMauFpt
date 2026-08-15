<?php
$item_total = ((float)($item['gia'] ?? 0) * (int)($item['so_luong'] ?? 1));

$cartItemId = (int)($item['id'] ?? 0);

$qtyField = 'qty_item_' . $cartItemId;

$qtyError = form_error_message($errors ?? [], $qtyField);

$qtyInputClass = $qtyError !== ''
    ? 'ds-input w-20 h-9 text-center text-sm border-red-600 focus:border-red-600 focus:ring-red-100'
    : 'ds-input w-20 h-9 text-center text-sm';

$qtyErrorId = 'qty-' . $cartItemId . '-error';

/* Số lượng tồn kho */
$soLuongTon = (int)($item['sl'] ?? 0);

/* Hết hàng khi số lượng tồn <= 0 */
$hetHang = $soLuongTon <= 0;
?>

<article
    class="flex flex-col sm:flex-row gap-4 sm:gap-5 p-4 sm:p-5 bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all duration-200">

    <!-- PHẦN SẢN PHẨM -->
    <div class="flex flex-col sm:flex-row gap-4 sm:gap-5 flex-1 min-w-0 <?= $hetHang ? 'opacity-50' : '' ?>">

        <!-- CHECKBOX -->
        <input
            type="checkbox"
            name="cart_selected[]"
            class="check-sp mt-1 sm:mt-3 shrink-0 w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-100 <?= $hetHang ? 'cursor-not-allowed' : 'cursor-pointer' ?>"
            aria-label="Chọn <?php echo htmlspecialchars($item['ten_san_pham'] ?? 'sản phẩm'); ?>"
            value="<?= (int)($item['san_pham_id'] ?? 0) ?>"
            data-price="<?php echo (float)($item['gia'] ?? 0); ?>"
            data-quantity="<?php echo (int)($item['so_luong'] ?? 1); ?>"
            data-id="<?php echo (int)($item['id'] ?? 0); ?>"
            <?= $hetHang ? 'disabled' : 'checked' ?>>

        <!-- ẢNH -->
        <img
            src="/web-ban-hang/public/uploads/<?php echo htmlspecialchars($item['hinh_anh'] ?? ''); ?>"
            alt="<?php echo htmlspecialchars($item['ten_san_pham'] ?? 'Sản phẩm'); ?>"
            class="w-full sm:w-28 h-28 object-contain rounded-xl bg-slate-50 shrink-0 border border-slate-200 p-2 <?= $hetHang ? 'grayscale' : '' ?>" />

        <!-- THÔNG TIN -->
        <div class="flex-1 min-w-0 flex flex-col">

            <!-- TÊN + GIÁ + THÀNH TIỀN -->
            <div class="flex flex-col sm:flex-row sm:justify-between gap-2 mb-4">

                <div>

                    <h3
                        class="text-base font-medium <?= $hetHang ? 'text-slate-500' : 'text-slate-900' ?>">
                        <?php echo htmlspecialchars($item['ten_san_pham'] ?? 'Sản phẩm'); ?>
                    </h3>

                    <div
                        class="font-semibold mt-1 text-sm <?= $hetHang ? 'text-slate-400' : 'text-blue-600' ?>">
                        <?php echo number_format($item['gia'] ?? 0, 0, ',', '.'); ?> ₫
                    </div>

                </div>

                <!-- THÀNH TIỀN -->
                <div class="sm:text-right">

                    <span class="text-xs text-slate-500">
                        Thành tiền
                    </span>

                    <div
                        class="text-lg font-semibold mt-0.5 <?= $hetHang ? 'text-slate-400' : 'text-slate-900' ?>">
                        <?php echo number_format($item_total, 0, ',', '.'); ?> ₫
                    </div>

                </div>

            </div>

            <!-- SỐ LƯỢNG -->
            <div class="flex flex-wrap items-center justify-between gap-3 mt-auto pt-4 border-t border-slate-100">

                <div class="flex flex-col gap-1">

                    <div class="flex items-center gap-2">

                        <label
                            class="text-sm font-medium text-slate-500"
                            for="qty-<?php echo (int)($item['san_pham_id'] ?? 0); ?>">
                            SL
                        </label>

                        <input
                            id="qty-<?php echo (int)($item['san_pham_id'] ?? 0); ?>"
                            type="number"
                            name="qty[<?php echo (int)($item['san_pham_id'] ?? 0); ?>]"
                            class="<?= $qtyInputClass ?>"
                            value="<?php echo (int)($item['so_luong'] ?? 1); ?>"
                            min="1"
                            data-cart-item-id="<?= $cartItemId ?>"
                            <?= $hetHang ? 'disabled' : '' ?>

                            <?php if ($qtyError !== ''): ?>
                            aria-invalid="true"
                            aria-describedby="<?= htmlspecialchars($qtyErrorId, ENT_QUOTES, 'UTF-8') ?>"
                            <?php endif; ?>

                            oninput="syncQuantity(<?= $cartItemId; ?>, this.value); updateQuantity(<?= $cartItemId; ?>, this.value)">

                    </div>

                    <!-- THÔNG BÁO -->
                    <?php if ($hetHang): ?>

                        <p class="text-sm text-red-600 font-medium">
                            Hết hàng
                        </p>

                    <?php elseif ($qtyError !== ''): ?>

                        <p
                            id="<?= htmlspecialchars($qtyErrorId, ENT_QUOTES, 'UTF-8') ?>"
                            class="text-sm text-red-600"
                            role="alert">
                            <?= htmlspecialchars($qtyError, ENT_QUOTES, 'UTF-8') ?>
                        </p>

                    <?php else: ?>

                        <p
                            id="<?= htmlspecialchars($qtyErrorId, ENT_QUOTES, 'UTF-8') ?>"
                            class="text-sm text-red-600 hidden"
                            role="alert">
                        </p>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>


    <!-- NÚT XÓA -->
    <!-- NẰM NGOÀI opacity NÊN KHÔNG BỊ NHẠT -->

    <div class="shrink-0 flex items-start sm:items-center">

        <a
            class="ds-btn-danger inline-flex items-center gap-1.5 py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-100 rounded-lg hover:bg-red-50 transition-colors"
            aria-label="Xóa <?php echo htmlspecialchars($item['ten_san_pham'] ?? 'sản phẩm'); ?> khỏi giỏ hàng"
            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?');"
            href="index.php?controller=shopping_cart&action=delete_gio_hang&id=<?php echo (int)($item['id'] ?? 0); ?>">

            <svg
                class="w-4 h-4"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />

            </svg>

            Xóa

        </a>

    </div>

</article>