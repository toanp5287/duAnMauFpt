<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chi tiết đơn hàng | Tech Store</title>
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body class="font-sans bg-slate-50 text-slate-700 antialiased">
    <div class="flex flex-col min-h-screen">
        <?php include __DIR__ . '/components/header.php'; ?>

        <main class="flex-1 py-8 lg:py-10">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                <?php $order = $donHang[0]; ?>

                <div class="ds-card p-5 sm:p-8 mb-6 sm:mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-100 pb-4 mb-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-slate-900">Chi tiết đơn hàng</h2>
                        <span class="inline-flex w-fit items-center px-3 py-1 rounded-lg bg-blue-50 text-blue-600 text-sm font-semibold border border-blue-100">#<?= $order['maDon'] ?></span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                        <div class="bg-slate-50 rounded-xl p-5 sm:p-6 border border-slate-200">
                            <h3 class="text-base font-semibold text-slate-900 mb-4">Thông tin khách hàng</h3>
                            <div class="space-y-3 text-sm">
                                <div class="flex flex-col sm:flex-row sm:justify-between gap-1"><span class="text-slate-500">Tên khách hàng</span><span class="font-medium text-slate-900"><?= $order['ten_khach_hang'] ?></span></div>
                                <div class="flex flex-col sm:flex-row sm:justify-between gap-1"><span class="text-slate-500">Số điện thoại</span><span class="font-medium text-slate-900"><?= $order['so_dien_thoai'] ?></span></div>
                                <div class="flex flex-col sm:flex-row sm:justify-between gap-1"><span class="text-slate-500">Địa chỉ</span><span class="font-medium text-slate-900 sm:text-right"><?= $order['dia_chi'] ?></span></div>
                                <?php if ($order['trang_thai_id'] == 1 || $order['trang_thai_id'] == 2): ?>

                                    <div class="mt-4 pt-4 border-t border-slate-100">
                                        <a
                                            href="index.php?controller=shopping_cart&action=editDeliveryInformation&id=<?= $order['order_id'] ?>"
                                            class="inline-flex items-center gap-2 px-4 py-2.5
                   rounded-lg
                   bg-blue-50 text-blue-600
                   border border-blue-100
                   text-sm font-medium
                   hover:bg-blue-600 hover:text-white
                   transition-all duration-200">
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
                                                    d="M11 5H6a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2v-5m-1.5-8.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 7.5-7.5z" />
                                            </svg>

                                            Cập nhật thông tin giao hàng
                                        </a>
                                    </div>

                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-5 sm:p-6 border border-slate-200">
                            <h3 class="text-base font-semibold text-slate-900 mb-4">Thông tin đơn hàng</h3>
                            <div class="space-y-3 text-sm">
                                <div class="flex flex-col sm:flex-row sm:justify-between gap-1"><span class="text-slate-500">Mã đơn</span><span class="font-medium text-slate-900">#<?= $order['maDon'] ?></span></div>
                                <div class="flex flex-col sm:flex-row sm:justify-between gap-1"><span class="text-slate-500">Ngày đặt</span><span class="font-medium text-slate-900"><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></span></div>
                                <div class="flex flex-col sm:flex-row sm:justify-between gap-1"><span class="text-slate-500">Thanh toán</span><span class="font-medium text-slate-900"><?= $order['cach_thanh_toan'] ?></span></div>
                                <div class="flex flex-col sm:flex-row sm:justify-between gap-1 items-start sm:items-center"><span class="text-slate-500">Trạng thái</span><span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-green-50 text-green-700 border border-green-100"><?= $order['ten_trang_thai'] ?></span></div>
                                <div class="flex flex-col sm:flex-row sm:justify-between gap-1 pt-3 border-t border-slate-200"><span class="font-semibold text-slate-900">Tổng tiền</span><span class="font-semibold text-blue-600 text-lg"><?= number_format($order['tong_tien'], 0, ",", ".") ?> đ</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ds-card overflow-hidden">
                    <div class="px-5 sm:px-6 py-4 border-b border-slate-200 bg-slate-50">
                        <h3 class="text-lg font-semibold text-slate-900">Danh sách sản phẩm</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[560px] text-sm">
                            <thead class="bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th class="px-4 sm:px-6 py-3 text-left font-semibold text-slate-900">Tên sản phẩm</th>
                                    <th class="px-4 sm:px-6 py-3 text-center font-semibold text-slate-900">Đơn giá</th>
                                    <th class="px-4 sm:px-6 py-3 text-center font-semibold text-slate-900">Số lượng</th>
                                    <th class="px-4 sm:px-6 py-3 text-right font-semibold text-slate-900">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <?php
                                $tamTinh = 0;
                                foreach ($donHang as $row):
                                    $thanhTien = $row['gia'] * $row['so_luong'];
                                    $tamTinh += $thanhTien;
                                ?>
                                    <tr class="hover:bg-slate-50">
                                        <td class="px-4 sm:px-6 py-4 font-medium text-slate-900"><?= $row['ten_san_pham'] ?></td>
                                        <td class="px-4 sm:px-6 py-4 text-center"><?= number_format($row['gia'], 0, ",", ".") ?> đ</td>
                                        <td class="px-4 sm:px-6 py-4 text-center"><?= $row['so_luong'] ?></td>
                                        <td class="px-4 sm:px-6 py-4 text-right font-semibold text-blue-600"><?= number_format($thanhTien, 0, ",", ".") ?> đ</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-slate-50 p-5 sm:p-6 border-t border-slate-200">
                        <div class="flex flex-col sm:items-end gap-4">
                            <div class="w-full sm:w-80 space-y-2 text-sm">
                                <div class="flex justify-between"><span class="text-slate-500">Tạm tính</span><span class="font-medium text-slate-900"><?= number_format($tamTinh, 0, ",", ".") ?> đ</span></div>
                                <div class="flex justify-between pt-3 border-t border-slate-200 text-lg font-semibold"><span class="text-slate-900">Tổng thanh toán</span><span class="text-blue-600"><?= number_format($order['tong_tien'], 0, ",", ".") ?> đ</span></div>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 w-full pt-4 border-t border-slate-200">
                                <a href="index.php?controller=login&action=lichSu" class="ds-btn-primary h-11 px-6 w-full sm:w-auto text-center">Quay lại lịch sử đơn hàng</a>
                                <p class="text-sm text-slate-500 text-center sm:text-right">Cảm ơn bạn đã mua hàng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include __DIR__ . '/components/footer.php'; ?>
    </div>
</body>

</html>