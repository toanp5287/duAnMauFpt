<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tech Store - Xác nhận đặt hàng</title>
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body class="font-sans bg-slate-50 text-slate-700 antialiased">
    <div class="flex flex-col min-h-screen">
        <?php include __DIR__ . '/components/header.php'; ?>

        <div class="bg-white border-b border-slate-200 py-8 sm:py-10">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex items-center flex-wrap gap-2 text-sm text-slate-500 mb-3">
                    <a href="index.php" class="hover:text-blue-600 transition-colors duration-200">Trang chủ</a>
                    <span class="text-slate-300">/</span>
                    <a href="index.php?controller=shopping_cart" class="hover:text-blue-600 transition-colors duration-200">Giỏ hàng</a>
                    <span class="text-slate-300">/</span>
                    <span class="font-medium text-slate-900">Thanh toán</span>
                </nav>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Thanh toán</h1>
                <p class="text-slate-500 mt-2 text-sm">Nhập thông tin giao hàng và kiểm tra đơn hàng</p>
            </div>
        </div>

        <main class="flex-1 py-8 lg:py-10">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-[1fr_400px] gap-6 lg:gap-8">

                    <?php $errors = form_get_errors(); ?>
                    <form id="checkoutForm" action="index.php?controller=buy&action=by" method="POST" class="ds-card p-5 sm:p-8 order-2 lg:order-1" novalidate>
                        <h3 class="text-lg font-semibold text-slate-900 mb-6 pb-4 border-b border-slate-100">Thông tin giao hàng</h3>

                        <?php
                        $checkoutSummaryErrors = array_filter($errors ?? [], function ($key) {
                            return in_array($key, ['cart', 'form'], true);
                        }, ARRAY_FILTER_USE_KEY);
                        ?>
                        <?php if (!empty($checkoutSummaryErrors)): ?>
                            <div id="checkout-error-summary" class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4" role="alert">
                                <p class="text-sm font-medium text-red-700 mb-2">Vui lòng kiểm tra lại thông tin:</p>
                                <ul class="list-disc pl-5 space-y-1">
                                    <?php foreach ($checkoutSummaryErrors as $summaryError): ?>
                                        <li class="text-sm text-red-600"><?= htmlspecialchars($summaryError, ENT_QUOTES, 'UTF-8') ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="space-y-4 sm:space-y-5">
                            <div>
                                <label for="fullName" class="ds-label">Họ và tên</label>
                                <input id="fullName" name="fullName" type="text" value="<?= form_old_value('fullName') ?>" placeholder="Nguyễn Văn A" class="<?= form_input_class($errors, 'fullName', 'ds-input h-11 sm:h-12 px-4 text-sm w-full') ?>"<?= form_field_attrs($errors, 'fullName', 'fullName') ?> />
                                <?php $field = 'fullName'; $inputId = 'fullName'; include __DIR__ . '/components/form-error.php'; ?>
                            </div>
                            <div>
                                <label for="phone" class="ds-label">Số điện thoại</label>
                                <input id="phone" name="phone" type="tel" value="<?= form_old_value('phone') ?>" placeholder="0901234567" class="<?= form_input_class($errors, 'phone', 'ds-input h-11 sm:h-12 px-4 text-sm w-full') ?>"<?= form_field_attrs($errors, 'phone', 'phone') ?> />
                                <?php $field = 'phone'; $inputId = 'phone'; include __DIR__ . '/components/form-error.php'; ?>
                            </div>
                            <div>
                                <label for="address" class="ds-label">Địa chỉ giao hàng</label>
                                <textarea id="address" name="address" rows="3" placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành..." class="<?= form_input_class($errors, 'address', 'ds-input px-4 py-3 text-sm w-full resize-none min-h-[96px]') ?>"<?= form_field_attrs($errors, 'address', 'address') ?>><?= form_old_value('address') ?></textarea>
                                <?php $field = 'address'; $inputId = 'address'; include __DIR__ . '/components/form-error.php'; ?>
                            </div>
                            <div>
                                <label for="payment" class="ds-label">Phương thức thanh toán</label>
                                <?php $paymentOld = form_old_raw('payment', 'COD'); ?>
                                <select id="payment" name="payment" class="<?= form_input_class($errors, 'payment', 'ds-input h-11 sm:h-12 px-4 text-sm w-full cursor-pointer') ?>"<?= form_field_attrs($errors, 'payment', 'payment') ?>>
                                    <option value="COD" <?= $paymentOld === 'COD' ? 'selected' : '' ?>>Thanh toán khi nhận hàng (COD)</option>
                                    <option value="VNPAY" <?= $paymentOld === 'VNPAY' ? 'selected' : '' ?>>Thanh toán qua VNPAY</option>
                                </select>
                                <?php $field = 'payment'; $inputId = 'payment'; include __DIR__ . '/components/form-error.php'; ?>
                            </div>
                            <div>
                                <label for="note" class="ds-label">Ghi chú đơn hàng (Tùy chọn)</label>
                                <textarea id="note" name="note" rows="2" placeholder="Giao hàng trong giờ hành chính..." class="ds-input px-4 py-3 text-sm w-full resize-none border-slate-200 focus:border-blue-600 focus:ring-blue-100"><?= form_old_value('note') ?></textarea>
                            </div>
                        </div>

                        <div class="mt-6 border-t border-slate-100 pt-6">
                            <label for="couponInput" class="ds-label">Nhập mã giảm giá</label>
                            <input type="text" id="couponInput" name="sale" value="<?= form_old_value('sale') ?>" autocomplete="off" onkeydown="if(event.key==='Enter'){event.preventDefault();}" placeholder="Ví dụ: GIAM20K, BEACH50..." class="<?= form_input_class($errors, 'sale', 'ds-input h-11 sm:h-12 px-4 text-sm w-full') ?>"<?= form_field_attrs($errors, 'sale', 'couponInput') ?> />
                            <?php $field = 'sale'; $inputId = 'couponInput'; include __DIR__ . '/components/form-error.php'; ?>
                            <p id="couponMessage" class="text-xs mt-1.5 font-medium hidden"></p>
                        </div>

                        <input type="hidden" name="discount" id="discountInput" value="0">
                        <input type="hidden" name="mua_le_id" value="<?php echo $_GET['id'] ?? ''; ?>">
                        <?php foreach ($list_buy as $item): ?>
                            <input type="hidden" name="cart_selected[]" value="<?= $item['id'] ?>">
                        <?php endforeach; ?>

                        <button type="submit" class="ds-btn-success w-full h-12 sm:h-14 text-sm mt-8">Xác nhận đặt hàng</button>
                    </form>

                    <aside class="lg:sticky lg:top-28 h-fit ds-card p-5 sm:p-8 order-1 lg:order-2">
                        <h3 class="text-lg font-semibold text-slate-900 mb-6">Sản phẩm thanh toán</h3>

                        <div id="checkoutItems" class="space-y-4 mb-6 max-h-[280px] sm:max-h-[320px] overflow-y-auto pr-1">
                            <?php
                            $tongToanBo = 0;
                            if (!empty($list_buy)):
                                foreach ($list_buy as $item):
                                    $thanhTien = $item['gia'] * $item['so_luong'];
                                    $tongToanBo += $thanhTien;
                            ?>
                                    <div class="flex gap-3 sm:gap-4 items-center pb-4 border-b border-slate-100 last:border-0 last:pb-0">
                                        <div class="w-14 h-14 sm:w-16 sm:h-16 shrink-0 rounded-xl bg-slate-50 border border-slate-200 overflow-hidden flex items-center justify-center p-1">
                                            <img src="/web-ban-hang/admin/public/uploads/<?php echo $item['hinh_anh']; ?>" alt="<?php echo htmlspecialchars($item['ten_san_pham']); ?>" class="w-full h-full object-contain" />
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="font-medium text-sm text-slate-900 truncate"><?php echo $item['ten_san_pham']; ?></div>
                                            <div class="text-xs text-slate-500 mt-1"><?php echo number_format($item['gia'], 0, ',', '.'); ?> ₫ × <?php echo $item['so_luong']; ?></div>
                                        </div>
                                        <div class="font-semibold text-sm text-slate-900 whitespace-nowrap"><?php echo number_format($thanhTien, 0, ',', '.'); ?> ₫</div>
                                    </div>
                            <?php endforeach; endif; ?>
                        </div>

                        <div class="space-y-3 text-sm pb-5 mb-5 border-b border-slate-100 text-slate-600">
                            <div class="flex justify-between"><span>Tạm tính</span><span id="subTotal" class="font-medium text-slate-900"><?php echo number_format($tongToanBo, 0, ',', '.'); ?> ₫</span></div>
                            <div class="flex justify-between"><span>Giảm giá</span><span id="discount" class="font-medium text-red-600">0 ₫</span></div>
                            <div class="flex justify-between"><span>Phí vận chuyển</span><span class="font-medium text-green-600">Miễn phí</span></div>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-slate-900">Tổng cộng</span>
                            <span id="finalTotal" class="text-xl sm:text-2xl font-semibold text-blue-600"><?php echo number_format($tongToanBo, 0, ',', '.'); ?> ₫</span>
                        </div>

                        <div class="mt-6 flex gap-3 p-4 rounded-xl bg-green-50 text-green-700 text-xs leading-relaxed border border-green-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="shrink-0 mt-0.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.95 11.95 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span>Đơn hàng của bạn được bảo mật an toàn qua hệ thống mã hóa của chúng tôi.</span>
                        </div>
                    </aside>
                </div>
            </div>
        </main>

        <?php include __DIR__ . '/components/footer.php'; ?>
    </div>
</body>

<script>
    const input = document.getElementById("couponInput");
    const discountEl = document.getElementById("discount");
    const totalEl = document.getElementById("finalTotal");
    const discountInput = document.getElementById("discountInput");
    const messageEl = document.getElementById("couponMessage");
    const originalTotal = <?php echo (int)$tongToanBo; ?>;
    let lastCheckedCode = "";

    input.addEventListener("input", function() {
        const currentCode = this.value.trim();
        if (!currentCode) { lastCheckedCode = ""; updateUI(0, ""); return; }
        if (currentCode.toUpperCase() === lastCheckedCode.toUpperCase()) return;
        clearTimeout(this._timer);
        this._timer = setTimeout(() => { applyCoupon(currentCode); }, 300);
    });

    input.addEventListener("paste", function() {
        clearTimeout(this._timer);
        this._timer = setTimeout(() => {
            const currentCode = this.value.trim();
            if (!currentCode) return;
            if (currentCode.toUpperCase() === lastCheckedCode.toUpperCase()) return;
            applyCoupon(currentCode);
        }, 0);
    });

    function applyCoupon(code) {
        fetch("index.php?controller=buy&action=sale", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "sale=" + encodeURIComponent(code) + "&tongToanBo=" + originalTotal
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === "error") {
                lastCheckedCode = "";
                updateUI(0, data.message || "Mã không hợp lệ.", false);
                return;
            }
            lastCheckedCode = code;
            updateUI(parseFloat(data.discount) || 0, data.message || "Áp dụng mã thành công!", true);
        })
        .catch(() => { updateUI(0, "Không thể kiểm tra mã lúc này.", false); });
    }

    function updateUI(discount, message, isSuccess) {
        if (isSuccess === undefined) isSuccess = false;
        const safeDiscount = (discount > originalTotal) ? originalTotal : discount;
        const final = originalTotal - safeDiscount;
        discountEl.innerText = safeDiscount > 0 ? "-" + new Intl.NumberFormat('vi-VN').format(safeDiscount) + " ₫" : "0 ₫";
        totalEl.innerText = new Intl.NumberFormat('vi-VN').format(final) + " ₫";
        discountInput.value = safeDiscount;
        if (message) {
            messageEl.innerText = message;
            messageEl.className = "text-xs mt-1.5 font-medium " + (isSuccess ? "text-green-600" : "text-red-500");
        } else {
            messageEl.className = "text-xs mt-1.5 font-medium hidden";
        }
    }
</script>

</html>
