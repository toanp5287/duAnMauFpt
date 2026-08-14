<?php
$order = $donHang[0];

$tenKhachHang = $order['ten_khach_hang'] ?? '';
$soDienThoai = $order['so_dien_thoai'] ?? '';
$diaChi = $order['dia_chi'] ?? '';
$maDon = $order['maDon'] ?? '';
?>
<?php include __DIR__ . '/components/head-resources.php'; ?>

<div class="max-w-3xl mx-auto">

    <!-- TIÊU ĐỀ -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-900">
            Cập nhật thông tin giao hàng
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Đơn hàng #<?= htmlspecialchars($maDon, ENT_QUOTES, 'UTF-8') ?>
        </p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-6">

        <!-- THÔNG TIN NGƯỜI NHẬN -->
        <div class="mb-6">
            <h3 class="text-base font-semibold text-slate-900 mb-4">
                Thông tin người nhận
            </h3>

            <div class="space-y-4">

                <!-- TÊN -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Tên người nhận
                    </label>

                    <input
                        type="text"
                        value="<?= htmlspecialchars($tenKhachHang, ENT_QUOTES, 'UTF-8') ?>"
                        disabled
                        class="w-full h-11 px-4 rounded-xl border border-slate-200 bg-slate-100 text-sm text-slate-500 cursor-not-allowed">
                </div>
                <form action="index.php?controller=shopping_cart&action=editDeliveryInformation" method="post">
                    <!-- SỐ ĐIỆN THOẠI -->
                    <input type="hidden" name="order_id" value="<?= $order['order_id']; ?>">
                    <div>
                        <label
                            for="phone"
                            class="block text-sm font-medium text-slate-700 mb-2">
                            Số điện thoại
                        </label>

                        <input
                            id="phone"
                            type="text"
                            name="phone"
                            value="<?= htmlspecialchars($soDienThoai, ENT_QUOTES, 'UTF-8') ?>"
                            placeholder="Nhập số điện thoại"
                            class="w-full h-11 px-4 rounded-xl border border-slate-200 bg-white text-sm text-slate-900 placeholder:text-slate-400 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-50 transition">
                    </div>

                    <!-- ĐỊA CHỈ -->
                    <div>
                        <label
                            for="address"
                            class="block text-sm font-medium text-slate-700 mb-2">
                            Địa chỉ giao hàng
                        </label>

                        <input
                            id="address"
                            type="text"
                            name="address"
                            value="<?= htmlspecialchars($diaChi, ENT_QUOTES, 'UTF-8') ?>"
                            placeholder="Nhập địa chỉ giao hàng"
                            class="w-full h-11 px-4 rounded-xl border border-slate-200 bg-white text-sm text-slate-900 placeholder:text-slate-400 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-50 transition">
                    </div>

            </div>
        </div>

        <!-- BẢN ĐỒ -->
        <div class="border-t border-slate-100 pt-6">

            <div class="flex items-center justify-between mb-3">
                <div>
                    <h3 class="text-base font-semibold text-slate-900">
                        Vị trí giao hàng
                    </h3>

                    <p class="text-xs text-slate-500 mt-1">
                        Bản đồ được hiển thị theo địa chỉ giao hàng
                    </p>
                </div>
            </div>

            <div class="overflow-hidden rounded-xl border border-slate-200 shadow-sm">

                <iframe
                    id="map"
                    src="https://www.google.com/maps?q=<?= urlencode($diaChi) ?>&output=embed"
                    width="100%"
                    height="320"
                    style="border:0;"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>

            </div>

        </div>

        <!-- NÚT -->
        <div class="flex flex-col sm:flex-row gap-3 mt-6 pt-6 border-t border-slate-100">

            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 h-11 px-6 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100 transition">

                <svg
                    class="w-4 h-4"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7" />

                </svg>

                Lưu thông tin
            </button>
            </form>
            <a
                href="index.php?controller=login&action=lichSu"
                class="inline-flex items-center justify-center h-11 px-6 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-medium hover:bg-slate-50 transition">

                Hủy
            </a>

        </div>

    </div>

</div>

<script>
    const addressInput = document.getElementById('address');
    const map = document.getElementById('map');

    addressInput.addEventListener('input', function() {

        const address = this.value.trim();

        if (address === '') {
            return;
        }

        map.src =
            'https://www.google.com/maps?q=' +
            encodeURIComponent(address) +
            '&output=embed';
    });
</script>