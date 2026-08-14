<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Tech Store - Giỏ hàng của bạn." />
    <title>Tech Store - Giỏ hàng</title>
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body class="font-sans bg-slate-50 text-slate-700 antialiased">
    <div class="flex flex-col min-h-screen">
        <?php include __DIR__ . '/components/header.php'; ?>

        <?php
        $total_quantity = 0;
        $total_price = 0;
        if (!empty($gio_hang)) {
            foreach ($gio_hang as $item) {
                $total_quantity += (int)($item['so_luong'] ?? 0);
                $total_price += ((float)($item['gia'] ?? 0) * (int)($item['so_luong'] ?? 0));
            }
        }
        ?>

        <div class="bg-white border-b border-slate-200 py-8 sm:py-10">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex items-center gap-2 text-sm text-slate-500 mb-3">
                    <a href="index.php" class="hover:text-blue-600 transition-colors duration-200">Trang chủ</a>
                    <span class="text-slate-300">/</span>
                    <span class="font-medium text-slate-900">Giỏ hàng</span>
                </nav>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Giỏ hàng của bạn</h1>
                <p class="text-slate-500 mt-2 text-sm">
                    <?php if (!empty($gio_hang)) { ?>
                        Bạn có <?php echo $total_quantity; ?> sản phẩm trong giỏ
                    <?php } else { ?>
                        Thêm sản phẩm để bắt đầu mua sắm
                    <?php } ?>
                </p>
            </div>
        </div>

        <main class="flex-1 py-8 lg:py-10">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                <?php $errors = form_get_errors(); ?>
                <?php if (!empty($errors['cart'])): ?>
                    <p id="cartPageError" class="text-sm text-red-600 mb-4" role="alert"><?= htmlspecialchars($errors['cart'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php else: ?>
                    <p id="cartPageError" class="text-sm text-red-600 mb-4 hidden" role="alert"></p>
                <?php endif; ?>
                <div class="flex flex-col sm:flex-row sm:justify-end mb-6">
                    <a href="index.php" class="ds-btn-secondary h-10 px-5 text-sm w-full sm:w-auto text-center">← Tiếp tục mua sắm</a>
                </div>

                <form action="index.php?controller=buy&action=index" method="POST" id="formDatHang">
                    <div class="grid grid-cols-1 lg:grid-cols-[1fr_380px] gap-6 lg:gap-8">

                        <div class="space-y-4">
                            <?php if (empty($gio_hang)) { ?>
                                <?php $emptyType = 'cart'; include __DIR__ . '/components/empty-state.php'; ?>
                            <?php } else { ?>
                                <?php foreach ($gio_hang as $item) {
                                    include __DIR__ . '/components/cart-item.php';
                                } ?>
                            <?php } ?>
                        </div>

                        <aside class="lg:sticky lg:top-28 h-fit ds-card p-6 sm:p-8<?php echo empty($gio_hang) ? ' opacity-50 pointer-events-none' : ''; ?>">
                            <h3 class="text-lg font-semibold text-slate-900 mb-6">Tóm tắt đơn hàng</h3>

                            <div class="space-y-4 text-sm text-slate-600">
                                <div class="flex justify-between">
                                    <span>Số lượng sản phẩm đã chọn</span>
                                    <strong id="cartCount" class="text-slate-900">0</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span>Tạm tính</span>
                                    <span id="cartSubtotal" class="font-medium text-slate-900">0 ₫</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Phí giao hàng</span>
                                    <span class="font-medium text-green-600">Miễn phí</span>
                                </div>
                                <div class="flex justify-between items-center pt-5 mt-2 border-t border-slate-200">
                                    <span class="text-base font-semibold text-slate-900">Tổng tiền</span>
                                    <span id="cartTotal" class="text-2xl font-semibold text-blue-600">0 ₫</span>
                                </div>
                            </div>

                            <?php if (!empty($gio_hang)) { ?>
                                <button type="submit" class="ds-btn-success w-full h-12 text-sm mt-8">
                                    Đặt hàng ngay
                                </button>
                            <?php } else { ?>
                                <span class="flex w-full h-12 items-center justify-center text-sm font-medium text-slate-400 bg-slate-100 rounded-xl mt-8 cursor-not-allowed">Đặt hàng ngay</span>
                            <?php } ?>

                            <p class="mt-4 text-xs text-slate-500 text-center leading-relaxed">
                                Bằng cách đặt hàng, bạn đồng ý với chính sách và điều khoản của chúng tôi.
                            </p>
                        </aside>
                    </div>
                </form>

                <?php if (!empty($lich_su_don)) { ?>
                    <div class="mt-16">
                        <h2 class="text-xl font-semibold text-slate-900 mb-6">Đơn hàng gần đây</h2>
                        <div class="overflow-x-auto ds-card">
                            <table class="w-full text-sm text-left min-w-[640px]">
                                <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider font-medium border-b border-slate-200">
                                    <tr>
                                        <th class="px-5 py-4">Mã ĐH</th>
                                        <th class="px-5 py-4">Sản phẩm</th>
                                        <th class="px-5 py-4">Số lượng</th>
                                        <th class="px-5 py-4">Thành tiền</th>
                                        <th class="px-5 py-4">Ngày đặt</th>
                                        <th class="px-5 py-4">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <?php foreach ($lich_su_don as $don) {
                                        $thanh_tien = (float)($don['gia'] ?? 0) * (int)($don['so_luong'] ?? 0);
                                        $trang_thai = $don['trang_thai'] ?? 'pending';
                                        $badge_class = $trang_thai === 'completed' || $trang_thai === 'done'
                                            ? 'bg-green-50 text-green-600 border-green-100'
                                            : 'bg-amber-50 text-amber-600 border-amber-100';
                                    ?>
                                        <tr class="hover:bg-slate-50 transition-colors duration-200">
                                            <td class="px-5 py-4 font-mono font-medium text-blue-600">#<?php echo (int)($don['order_id'] ?? 0); ?></td>
                                            <td class="px-5 py-4 font-medium text-slate-900"><?php echo htmlspecialchars($don['ten_san_pham'] ?? ''); ?></td>
                                            <td class="px-5 py-4"><?php echo (int)($don['so_luong'] ?? 0); ?></td>
                                            <td class="px-5 py-4 font-medium text-slate-900"><?php echo number_format($thanh_tien, 0, ',', '.'); ?> ₫</td>
                                            <td class="px-5 py-4 text-slate-500 whitespace-nowrap">
                                                <?php echo !empty($don['created_at']) ? date('d/m/Y H:i', strtotime($don['created_at'])) : '—'; ?>
                                            </td>
                                            <td class="px-5 py-4">
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium border <?php echo $badge_class; ?>">
                                                    <?php echo htmlspecialchars($trang_thai); ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </main>

        <?php include __DIR__ . '/components/footer.php'; ?>
    </div>
</body>

<script>
    function capNhatDonHang() {
        const checkboxes = document.querySelectorAll('.check-sp');
        const cartTotal = document.getElementById('cartTotal');
        const cartSubtotal = document.getElementById('cartSubtotal');
        const cartCount = document.getElementById('cartCount');
        let tongTien = 0;
        let tongSoLuong = 0;
        checkboxes.forEach(cb => {
            if (cb.checked) {
                const gia = Number(cb.getAttribute('data-price')) || 0;
                const soLuong = Number(cb.getAttribute('data-quantity')) || 0;
                tongTien += gia * soLuong;
                tongSoLuong += soLuong;
            }
        });
        const formattedPrice = tongTien.toLocaleString('vi-VN') + ' ₫';
        if (cartTotal) cartTotal.textContent = formattedPrice;
        if (cartSubtotal) cartSubtotal.textContent = formattedPrice;
        if (cartCount) cartCount.textContent = tongSoLuong;
    }

    function syncQuantity(cartItemId, newQty) {
        const qty = parseInt(newQty) || 1;
        if (qty < 1) return;
        const cb = document.querySelector('.check-sp[data-id="' + cartItemId + '"]');
        if (cb) cb.setAttribute('data-quantity', qty);
        capNhatDonHang();
    }

    const _qtyDebounceTimers = {};
    function updateQuantity(cartItemId, newQty) {
        const qty = parseInt(newQty) || 1;
        if (qty < 1) return;
        clearTimeout(_qtyDebounceTimers[cartItemId]);
        _qtyDebounceTimers[cartItemId] = setTimeout(function() {
            const body = new URLSearchParams();
            body.append('id', cartItemId);
            body.append('so_luong', qty);
            fetch('index.php?controller=shopping_cart&action=updateSoLuong', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: body.toString()
            })
            .then(function(res) { return res.json(); })
            .then(function(data) {
                document.querySelectorAll('[id^="qty-"][id$="-error"]').forEach(function(el) {
                    if (el.id !== 'cartPageError') {
                        el.classList.add('hidden');
                        el.textContent = '';
                    }
                });
                document.querySelectorAll('input[data-cart-item-id]').forEach(function(input) {
                    input.classList.remove('border-red-600', 'focus:border-red-600', 'focus:ring-red-100');
                    input.removeAttribute('aria-invalid');
                    input.removeAttribute('aria-describedby');
                });

                if (data.status === 'error') {
                    var message = data.message || 'Không thể cập nhật số lượng.';
                    var field = data.field || '';
                    if (field.indexOf('qty_item_') === 0) {
                        var cartItemId = field.replace('qty_item_', '');
                        var itemError = document.getElementById('qty-' + cartItemId + '-error');
                        var qtyInput = document.querySelector('input[data-cart-item-id="' + cartItemId + '"]');
                        if (itemError) {
                            itemError.textContent = message;
                            itemError.classList.remove('hidden');
                        }
                        if (qtyInput) {
                            qtyInput.classList.add('border-red-600', 'focus:border-red-600', 'focus:ring-red-100');
                            qtyInput.setAttribute('aria-invalid', 'true');
                            qtyInput.setAttribute('aria-describedby', 'qty-' + cartItemId + '-error');
                        }
                    }
                    var el = document.getElementById('cartPageError');
                    if (el) {
                        el.textContent = message;
                        el.classList.remove('hidden');
                    }
                }
            })
            .catch(function() {
                var el = document.getElementById('cartPageError');
                if (el) {
                    el.textContent = 'Không thể cập nhật số lượng, vui lòng thử lại!';
                    el.classList.remove('hidden');
                }
            });
        }, 600);
    }

    document.addEventListener("DOMContentLoaded", function() {
        const checkboxes = document.querySelectorAll('.check-sp');
        const formDatHang = document.getElementById('formDatHang');
        checkboxes.forEach(cb => cb.addEventListener('change', capNhatDonHang));
        if (formDatHang) {
            formDatHang.addEventListener('submit', function(e) {
                const coTichChon = Array.from(checkboxes).some(cb => cb.checked);
                if (!coTichChon) {
                    e.preventDefault();
                    var el = document.getElementById('cartPageError');
                    if (el) {
                        el.textContent = 'Vui lòng tích chọn ít nhất một sản phẩm để tiến hành đặt hàng!';
                        el.classList.remove('hidden');
                    }
                }
            });
        }
        capNhatDonHang();
    });
</script>

</html>
