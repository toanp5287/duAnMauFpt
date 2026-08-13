<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tech Store - Xác nhận đặt hàng</title>
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body class="font-sans bg-surface text-ink-800 antialiased">
    <div class="flex flex-col min-h-screen">
        <?php include __DIR__ . '/components/header.php'; ?>

        <div class="bg-primary-600 text-white py-10 border-b border-primary-700">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex items-center flex-wrap gap-2 text-sm text-ink-300 mb-3 font-medium">
                    <a href="index.php" class="hover:text-white transition-colors">Trang chủ</a><span>/</span>
                    <a href="index.php?controller=shopping_cart" class="hover:text-white transition-colors">Giỏ hàng</a><span>/</span>
                    <span class="text-white font-bold">Thanh toán</span>
                </nav>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Thanh toán</h1>
                <p class="text-ink-300 mt-2 text-sm font-medium">Nhập thông tin giao hàng và kiểm tra đơn hàng</p>
            </div>
        </div>

        <main class="flex-1 py-10 lg:py-12">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-[1fr_420px] gap-8 lg:gap-10">

                    <form id="checkoutForm" action="index.php?controller=buy&action=by" method="POST" class="bg-white rounded-2xl border border-ink-100 shadow-sm p-6 sm:p-8 lg:p-10">
                        <h3 class="text-lg font-extrabold text-ink-900 mb-8 pb-4 border-b border-ink-50">Thông tin giao hàng</h3>



                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-bold text-ink-900 mb-2">Họ và tên</label>
                                <input name="fullName" type="text" placeholder="Nguyễn Văn A" class="w-full h-12 px-4 text-sm border border-ink-200 rounded-xl bg-ink-50 focus:outline-none focus:border-accent-500 focus:bg-white transition-colors font-medium text-ink-700" required />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-ink-900 mb-2">Số điện thoại</label>
                                <input name="phone" type="tel" placeholder="0901234567" class="w-full h-12 px-4 text-sm border border-ink-200 rounded-xl bg-ink-50 focus:outline-none focus:border-accent-500 focus:bg-white transition-colors font-medium text-ink-700" required />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-ink-900 mb-2">Địa chỉ giao hàng</label>
                                <textarea name="address" rows="3" placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành..." class="w-full px-4 py-3 text-sm border border-ink-200 rounded-xl bg-ink-50 focus:outline-none focus:border-accent-500 focus:bg-white transition-colors font-medium text-ink-700 resize-none" required></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-ink-900 mb-2">Phương thức thanh toán</label>
                                <select
                                    name="payment"
                                    class="w-full h-12 px-4 text-sm border border-ink-200 rounded-xl bg-ink-50 focus:outline-none focus:border-accent-500 focus:bg-white transition-colors font-medium text-ink-700 cursor-pointer">

                                    <option value="COD">Thanh toán khi nhận hàng (COD)</option>

                                    <option value="VNPAY">Thanh toán qua VNPAY</option>

                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-ink-900 mb-2">Ghi chú đơn hàng (Tùy chọn)</label>
                                <textarea name="note" rows="2" placeholder="Giao hàng trong giờ hành chính..." class="w-full px-4 py-3 text-sm border border-ink-200 rounded-xl bg-ink-50 focus:outline-none focus:border-accent-500 focus:bg-white transition-colors font-medium text-ink-700 resize-none"></textarea>
                            </div>
                        </div>

                        <div class="mt-6 border-t border-ink-50 pt-6">
                            <label class="block text-sm font-bold text-ink-900 mb-2">Nhập mã giảm giá</label>
                            <div class="flex items-center gap-2">
                                <input
                                    type="text"
                                    id="couponInput"
                                    name="sale"
                                    autocomplete="off"
                                    onkeydown="if(event.key==='Enter'){event.preventDefault();}"
                                    placeholder="Ví dụ: GIAM20K, BEACH50..."
                                    class="w-full h-12 px-4 text-sm border border-ink-200 rounded-xl bg-ink-50 focus:outline-none focus:border-accent-500 focus:bg-white transition-colors font-medium text-ink-700" />
                            </div>
                            <p id="couponMessage" class="text-xs mt-1.5 font-bold hidden"></p>
                        </div>

                        <input type="hidden" name="discount" id="discountInput" value="0">
                        <input type="hidden" name="mua_le_id" value="<?php echo $_GET['id'] ?? ''; ?>">
                        <input type="hidden" name="tongTien" value="<?php echo $_GET['gia'] ?? ''; ?>">
                        <?php foreach ($list_buy as $item): ?>
                            <input
                                type="hidden"
                                name="cart_selected[]"
                                value="<?= $item['id'] ?>">
                        <?php endforeach; ?>
                        <button type="submit" class="w-full mt-8 h-14 text-sm font-bold text-white bg-cta-500 rounded-xl hover:bg-cta-600 active:scale-[0.98] transition-all shadow-md shadow-cta-500/30">
                            Xác nhận đặt hàng
                        </button>
                    </form>

                    <aside class="lg:sticky lg:top-24 h-fit bg-white rounded-2xl border border-ink-100 shadow-sm p-6 sm:p-8">
                        <h3 class="text-lg font-extrabold text-ink-900 mb-6">Sản phẩm thanh toán</h3>

                        <div id="checkoutItems" class="space-y-4 mb-6 max-h-[320px] overflow-y-auto pr-1">
                            <?php
                            $tongToanBo = 0;
                            if (!empty($list_buy)):

                                foreach ($list_buy as $item):
                                    $thanhTien = $item['gia'] * $item['so_luong'];
                                    $tongToanBo += $thanhTien;
                            ?>
                                    <div class="flex gap-4 items-center pb-4 border-b border-ink-50 last:border-0 last:pb-0">
                                        <div class="w-16 h-16 shrink-0 rounded-xl bg-ink-50 border border-ink-100 overflow-hidden flex items-center justify-center p-1">
                                            <img src="/web-ban-hang/admin/public/uploads/<?php echo $item['hinh_anh']; ?>" alt="" class="w-full h-full object-contain" />
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="font-bold text-sm text-ink-900 truncate"><?php echo $item['ten_san_pham']; ?></div>
                                            <div class="text-xs text-ink-500 mt-1 font-medium"><?php echo number_format($item['gia'], 0, ',', '.'); ?> ₫ × <?php echo $item['so_luong']; ?></div>
                                        </div>
                                        <div class="font-extrabold text-sm text-ink-900 whitespace-nowrap"><?php echo number_format($thanhTien, 0, ',', '.'); ?> ₫</div>
                                    </div>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </div>

                        <div class="space-y-3 text-sm pb-5 mb-5 border-b border-ink-50 text-ink-600 font-medium">
                            <div class="flex justify-between">
                                <span>Tạm tính</span>
                                <span id="subTotal" class="font-bold text-ink-900"><?php echo number_format($tongToanBo, 0, ',', '.'); ?> ₫</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Giảm giá</span>
                                <span id="discount" class="font-bold text-rose-600">0 ₫</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Phí vận chuyển</span>
                                <span class="font-bold text-emerald-600">Miễn phí</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="font-extrabold text-ink-900">Tổng cộng</span>
                            <span id="finalTotal" class="text-2xl font-extrabold text-sale"><?php echo number_format($tongToanBo, 0, ',', '.'); ?> ₫</span>
                        </div>

                        <div class="mt-6 flex gap-3 p-4 rounded-xl bg-emerald-50 text-emerald-700 text-xs font-medium leading-relaxed border border-emerald-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="shrink-0 mt-0.5">
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

    // Gõ từng ký tự: debounce 300ms
    input.addEventListener("input", function() {
        const currentCode = this.value.trim();

        if (!currentCode) {
            lastCheckedCode = "";
            updateUI(0, "");
            return;
        }

        if (currentCode.toUpperCase() === lastCheckedCode.toUpperCase()) return;

        clearTimeout(this._timer);
        this._timer = setTimeout(() => {
            applyCoupon(currentCode);
        }, 300);
    });

    // Dán mã (Ctrl+V / chuột phải): trigger ngay lập tức
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
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "sale=" + encodeURIComponent(code) + "&tongToanBo=" + originalTotal
            })
            .then(function(res) {
                return res.json();
            })
            .then(function(data) {
                if (data.status === "error") {
                    lastCheckedCode = "";
                    updateUI(0, data.message || "Mã không hợp lệ.", false);
                    return;
                }
                lastCheckedCode = code;
                const discountAmount = parseFloat(data.discount) || 0;
                updateUI(discountAmount, data.message || "Áp dụng mã thành công!", true);
            })
            .catch(function() {
                updateUI(0, "Không thể kiểm tra mã lúc này.", false);
            });
    }

    function updateUI(discount, message, isSuccess) {
        if (isSuccess === undefined) isSuccess = false;
        const safeDiscount = (discount > originalTotal) ? originalTotal : discount;
        const final = originalTotal - safeDiscount;

        if (safeDiscount > 0) {
            discountEl.innerText = "-" + new Intl.NumberFormat('vi-VN').format(safeDiscount) + " ₫";
            discountEl.className = "font-bold text-rose-600";
        } else {
            discountEl.innerText = "0 ₫";
            discountEl.className = "font-bold text-rose-600";
        }

        totalEl.innerText = new Intl.NumberFormat('vi-VN').format(final) + " ₫";
        discountInput.value = safeDiscount;

        if (message) {
            messageEl.innerText = message;
            messageEl.className = "text-xs mt-1.5 font-bold " + (isSuccess ? "text-emerald-600" : "text-rose-500");
        } else {
            messageEl.className = "text-xs mt-1.5 font-bold hidden";
        }
    }
</script>

</html>