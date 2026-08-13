    <!doctype html>
    <html lang="vi">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Tech Store - Giỏ hàng của bạn." />
        <title>Tech Store - Giỏ hàng</title>
        <?php include __DIR__ . '/components/head-resources.php'; ?>
    </head>

    <body class="font-sans bg-surface text-ink-800 antialiased">
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

            <div class="bg-primary-600 text-white py-10 border-b border-primary-700">
                <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                    <nav class="flex items-center gap-2 text-sm text-ink-300 mb-3 font-medium">
                        <a href="index.php" class="hover:text-white transition-colors">Trang chủ</a><span>/</span><span class="text-white font-bold">Giỏ hàng</span>
                    </nav>
                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Giỏ hàng của bạn</h1>
                    <p class="text-ink-300 mt-2 text-sm font-medium">
                        <?php if (!empty($gio_hang)) { ?>
                            Bạn có <?php echo $total_quantity; ?> sản phẩm trong giỏ
                        <?php } else { ?>
                            Thêm sản phẩm để bắt đầu mua sắm
                        <?php } ?>
                    </p>
                </div>
            </div>

            <main class="flex-1 py-10 lg:py-12">
                <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-end mb-6">
                        <a href="index.php" class="inline-flex h-11 items-center px-5 text-sm font-bold text-ink-700 bg-white border border-ink-200 rounded-xl hover:bg-ink-50 transition-colors shadow-sm">← Tiếp tục mua sắm</a>
                    </div>
                    <form action="index.php?controller=buy&action=index" method="POST" id="formDatHang">
                        <div class="grid grid-cols-1 lg:grid-cols-[1fr_400px] gap-8">

                            <div class="space-y-4">
                                <?php if (empty($gio_hang)) { ?>
                                    <div class="flex flex-col items-center justify-center py-24 text-center bg-white rounded-2xl border border-ink-100 shadow-sm">
                                        <div class="text-6xl mb-5">🛒</div>
                                        <h3 class="text-xl font-extrabold text-ink-900 mb-2">Giỏ hàng đang trống</h3>
                                        <p class="text-ink-500 mb-8 font-medium">Thêm sản phẩm vào giỏ để tiếp tục mua sắm.</p>
                                        <a href="index.php" class="inline-flex h-12 items-center px-8 text-sm font-bold text-white bg-cta-500 rounded-xl hover:bg-cta-600 transition-colors shadow-md">Mua ngay</a>
                                    </div>
                                <?php } else { ?>
                                    <?php foreach ($gio_hang as $item) { ?>
                                        <?php include __DIR__ . '/components/cart-item.php'; ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>

                            <aside class="lg:sticky lg:top-24 h-fit bg-white rounded-2xl border border-ink-100 shadow-sm p-6 sm:p-8<?php echo empty($gio_hang) ? ' opacity-50 pointer-events-none' : ''; ?>">
                                <h3 class="text-lg font-extrabold text-ink-900 mb-6">Tóm tắt đơn hàng</h3>

                                <div class="space-y-4 text-sm font-medium text-ink-600">
                                    <div class="flex justify-between">
                                        <span>Số lượng sản phẩm đã chọn</span>
                                        <strong id="cartCount" class="text-ink-900">0</strong>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Tạm tính</span>
                                        <span id="cartSubtotal" class="font-bold text-ink-900">0 ₫</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Phí giao hàng</span>
                                        <span class="font-bold text-emerald-600">Miễn phí</span>
                                    </div>
                                    <div class="flex justify-between items-center pt-5 mt-2 border-t border-ink-100">
                                        <span class="text-base font-extrabold text-ink-900">Tổng tiền</span>
                                        <span id="cartTotal" class="text-2xl font-extrabold text-sale">0 ₫</span>
                                    </div>
                                </div>

                                <?php if (!empty($gio_hang)) { ?>
                                    <button
                                        type="submit"
                                        class="mt-8 flex w-full h-14 items-center justify-center text-sm font-bold text-white bg-cta-500 rounded-xl hover:bg-cta-600 shadow-md active:scale-[0.98] transition-all">
                                        Đặt hàng ngay
                                    </button>
                                <?php } else { ?>
                                    <span class="mt-8 flex w-full h-14 items-center justify-center text-sm font-bold text-white bg-ink-300 rounded-xl cursor-not-allowed">Đặt hàng ngay</span>
                                <?php } ?>

                                <p class="mt-5 text-xs text-ink-400 text-center leading-relaxed font-medium">
                                    Bằng cách đặt hàng, bạn đồng ý với chính sách và điều khoản của chúng tôi.
                                </p>
                            </aside>

                        </div>
                    </form>

                    <?php if (!empty($lich_su_don)) { ?>
                        <div class="mt-16">
                            <h2 class="text-xl font-extrabold text-ink-900 mb-6">Đơn hàng gần đây</h2>
                            <div class="overflow-x-auto rounded-2xl border border-ink-100 bg-white shadow-sm">
                                <table class="w-full text-sm text-left min-w-[640px]">
                                    <thead class="bg-ink-50 text-ink-500 text-xs uppercase tracking-wider font-bold">
                                        <tr>
                                            <th class="px-5 py-4">Mã ĐH</th>
                                            <th class="px-5 py-4">Sản phẩm</th>
                                            <th class="px-5 py-4">Số lượng</th>
                                            <th class="px-5 py-4">Thành tiền</th>
                                            <th class="px-5 py-4">Ngày đặt</th>
                                            <th class="px-5 py-4">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-ink-100 font-medium">
                                        <?php foreach ($lich_su_don as $don) { ?>
                                            <?php
                                            $thanh_tien = (float)($don['gia'] ?? 0) * (int)($don['so_luong'] ?? 0);
                                            $trang_thai = $don['trang_thai'] ?? 'pending';
                                            $badge_class = $trang_thai === 'completed' || $trang_thai === 'done'
                                                ? 'bg-emerald-50 text-emerald-600 border-emerald-100'
                                                : 'bg-amber-50 text-amber-600 border-amber-100';
                                            ?>
                                            <tr class="hover:bg-ink-50/50 transition-colors">
                                                <td class="px-5 py-4 font-mono font-bold text-accent-600">#<?php echo (int)($don['order_id'] ?? 0); ?></td>
                                                <td class="px-5 py-4 font-semibold text-ink-900"><?php echo htmlspecialchars($don['ten_san_pham'] ?? ''); ?></td>
                                                <td class="px-5 py-4"><?php echo (int)($don['so_luong'] ?? 0); ?></td>
                                                <td class="px-5 py-4 font-bold text-ink-900"><?php echo number_format($thanh_tien, 0, ',', '.'); ?> ₫</td>
                                                <td class="px-5 py-4 text-ink-500 whitespace-nowrap">
                                                    <?php echo !empty($don['created_at']) ? date('d/m/Y H:i', strtotime($don['created_at'])) : '—'; ?>
                                                </td>
                                                <td class="px-5 py-4">
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold border <?php echo $badge_class; ?>">
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
        // Hàm tự động tính toán lại số tiền hiển thị dựa trên các item được tích chọn
        // Khai báo global để syncQuantity có thể gọi được từ ngoài DOMContentLoaded
        function capNhatDonHang() {
            const checkboxes = document.querySelectorAll('.check-sp');
            const cartTotal = document.getElementById('cartTotal');
            const cartSubtotal = document.getElementById('cartSubtotal');
            const cartCount = document.getElementById('cartCount');

            let tongTien = 0;
            let tongSoLuong = 0;

            checkboxes.forEach(cb => {
                if (cb.checked) {
                    // Thay thế .dataset bằng getAttribute để tăng tính ổn định trên tất cả trình duyệt
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

        // Hàm đồng bộ data-quantity trên checkbox khi người dùng thay đổi số lượng input (realtime)
        function syncQuantity(cartItemId, newQty) {
            const qty = parseInt(newQty) || 1;
            if (qty < 1) return;

            // Tìm checkbox tương ứng theo data-id và cập nhật data-quantity
            const cb = document.querySelector('.check-sp[data-id="' + cartItemId + '"]');
            if (cb) {
                cb.setAttribute('data-quantity', qty);
            }

            // Tính lại tổng tiền ngay lập tức
            capNhatDonHang();
        }

        // Hàm xử lý thay đổi số lượng ô input: Gửi AJAX lưu DB mà không reload trang
        const _qtyDebounceTimers = {};
        function updateQuantity(cartItemId, newQty) {
            const qty = parseInt(newQty) || 1;
            if (qty < 1) return;

            // Debounce 600ms — đợi người dùng ngừng gõ rồi mới gửi request
            clearTimeout(_qtyDebounceTimers[cartItemId]);
            _qtyDebounceTimers[cartItemId] = setTimeout(function() {
                const body = new URLSearchParams();
                body.append('id', cartItemId);
                body.append('so_luong', qty);

                fetch('index.php?controller=shopping_cart&action=updateSoLuong', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: body.toString()
                }).catch(function() {
                    alert('Không thể cập nhật số lượng, vui lòng thử lại!');
                });
            }, 600);
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Chỉ lấy phần tử HTML khi toàn bộ form và các component file con đã load xong hoàn toàn
            const checkboxes = document.querySelectorAll('.check-sp');
            const formDatHang = document.getElementById('formDatHang');

            // Gán sự kiện đổi trạng thái cho toàn bộ các ô checkbox
            checkboxes.forEach(cb => {
                cb.addEventListener('change', capNhatDonHang);
            });

            // Chặn người dùng gửi đơn hàng đi nếu chưa tích chọn bất kỳ sản phẩm nào
            if (formDatHang) {
                formDatHang.addEventListener('submit', function(e) {
                    const coTichChon = Array.from(checkboxes).some(cb => cb.checked);
                    if (!coTichChon) {
                        e.preventDefault();
                        alert('Vui lòng tích chọn ít nhất một sản phẩm để tiến hành đặt hàng!');
                    }
                });
            }

            // Chạy kích hoạt tính toán lần đầu ngay khi mở trang
            capNhatDonHang();
        });
    </script>

    </html>