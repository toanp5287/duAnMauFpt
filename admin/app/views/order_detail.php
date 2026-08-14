<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý chi tiết đơn hàng | Tech Store Admin</title>
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body>
    <div class="flex min-h-screen">
        <?php include 'sitebar.php'; ?>

        <main class="flex-1 lg:ml-64 pt-14 lg:pt-0 p-4 sm:p-6 lg:p-8 w-full min-w-0">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900">
                        Danh sách chi tiết đơn hàng
                    </h1>

                    <p class="text-slate-500 mt-1 text-sm">
                        Quản lý thông tin khách hàng và sản phẩm
                    </p>
                </div>

                <form action="index.php" method="GET" class="flex flex-col sm:flex-row gap-2 w-full lg:w-auto">
                    <input type="hidden" name="controller" value="order_detail">
                    <input type="hidden" name="action" value="search">
                    <input type="search" name="keyword" placeholder="Tìm khách hàng hoặc sản phẩm..."
                        value="<?php echo $_GET['keyword'] ?? ''; ?>"
                        class="adm-input h-10 px-4 text-sm w-full sm:min-w-[240px]">
                    <button type="submit" class="adm-btn-success h-10 px-5 whitespace-nowrap">Tìm</button>
                </form>
            </div>

            <div class="adm-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="adm-table w-full min-w-[640px]">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($don_hang)) { ?>
                                <tr>
                                    <td colspan="4" class="text-center py-14 text-slate-400">Không có dữ liệu</td>
                                </tr>
                            <?php } else { ?>
                                <?php foreach ($don_hang as $row) { ?>
                                    <tr>
                                        <td class="font-medium text-slate-900">#<?php echo $row['idCT']; ?></td>
                                        <td><?php echo htmlspecialchars($row['ten_san_pham']); ?></td>
                                        <td><?php echo $row['sl']; ?></td>
                                        <td class="font-semibold text-green-600 whitespace-nowrap"><?php echo number_format($row['gia']); ?> đ</td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 sm:mt-8 adm-card p-5 sm:p-6">

                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-slate-900">
                        Thông tin đơn hàng
                    </h2>

                    <span class="adm-badge-blue">
                        #<?= $thongTin['maDon'] ?>
                    </span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">

                    <!-- KHÁCH HÀNG -->
                    <div class="bg-slate-50 rounded-xl p-5 space-y-4 border border-slate-200">

                        <h3 class="font-semibold text-slate-700 mb-2">
                            Thông tin khách hàng
                        </h3>

                        <div>
                            <p class="text-xs text-slate-500">Tên khách hàng</p>
                            <p class="font-semibold text-slate-900">
                                <?= htmlspecialchars($thongTin['ten_khach_hang']) ?>
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-500">Số điện thoại</p>
                            <p class="font-semibold text-slate-900">
                                <?= htmlspecialchars($thongTin['so_dien_thoai']) ?>
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-slate-500">Địa chỉ nhận hàng</p>
                            <p class="font-semibold text-slate-900 leading-relaxed">
                                <?= htmlspecialchars($thongTin['dia_chi']) ?>
                            </p>
                        </div>
                        <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
                            <h3 class="text-lg font-semibold text-slate-900 mb-4">
                                Trạng thái thanh toán đơn hàng
                            </h3>

                            <?php if ($thongTin['payment_status'] == 0): ?>
                                <span class="adm-badge-amber">Chưa thanh toán</span>
                            <?php elseif ($thongTin['payment_status'] == 1): ?>
                                <span class="adm-badge-green">Đã thanh toán</span>
                            <?php elseif ($thongTin['payment_status'] == 2): ?>
                                <span class="adm-badge-amber">Khách hàng hủy thanh toán</span>
                            <?php elseif ($thongTin['payment_status'] == 3): ?>
                                <span class="adm-badge-red">Thanh toán thất bại</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- ĐƠN HÀNG -->
                    <div class="bg-slate-50 rounded-xl p-5 space-y-4 border border-slate-200">

                        <h3 class="font-semibold text-slate-700 mb-2">
                            Trạng thái đơn hàng
                        </h3>

                        <!-- trạng thái -->
                        <div class="flex items-center justify-between">

                            <div>
                                <p class="text-xs text-slate-500">Trạng thái hiện tại</p>

                                <span class="adm-badge-green mt-1">
                                    <?= $row['nameTrangThai'] ?? 'Chưa xác định' ?>
                                </span>
                            </div>

                        </div>

                        <!-- form update trạng thái -->
                        <?php

                        // Luồng xử lý của Admin
                        $adminFlow = [
                            1 => [2, 7],    // Chờ xác nhận -> Đã xác nhận | Shop hủy
                            2 => [3, 7],    // Đã xác nhận -> Chuẩn bị hàng | Shop hủy
                            3 => [4, 7],    // Chuẩn bị hàng -> Đang giao | Shop hủy
                            4 => [5],       // Đang giao -> Giao hàng thành công
                            9 => [10],      // Yêu cầu hoàn hàng -> Shop xác nhận yêu cầu hoàn hàng
                            10 => [11],     // Shop xác nhận yêu cầu hoàn hàng -> Hoàn hàng thành công
                        ];

                        $currentStatus = (int)$row['trang_thai_id'];

                        $allowedTransitions = $adminFlow[$currentStatus] ?? [];

                        // Mảng tên trạng thái
                        $statusNames = array_column($trangThai, 'trang_thai', 'id');

                        ?>
                        <form
                            action="index.php?controller=order_detail&action=approve_orders&iddon=<?= $row['order_id'] ?>"
                            method="POST"
                            class="bg-slate-50 border border-slate-200 rounded-xl p-4 mt-4 space-y-4">

                            <!-- Chọn trạng thái -->
                            <div class="flex flex-col sm:flex-row sm:items-end gap-4">
                                <div class="flex-1">
                                    <label for="trangThaiSelect" class="adm-label">Trạng thái đơn hàng</label>
                                    <select id="trangThaiSelect" name="trangThai" class="adm-input h-10 px-3 text-sm w-full">

                                        <option value="<?= $currentStatus ?>" selected>
                                            <?= htmlspecialchars($statusNames[$currentStatus] ?? '') ?>
                                        </option>

                                        <?php foreach ($trangThai as $value): ?>
                                            <?php if (in_array((int)$value['id'], $allowedTransitions, true)): ?>
                                                <option value="<?= $value['id'] ?>">
                                                    <?= htmlspecialchars($value['trang_thai']) ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                    </select>
                                </div>

                                <?php if (!empty($allowedTransitions)): ?>
                                    <button type="submit" class="adm-btn-primary px-6 py-2 h-10 whitespace-nowrap">Duyệt</button>
                                <?php endif; ?>

                            </div>

                            <!-- Tin nhắn -->
                            <?php if (in_array($currentStatus, [1, 2, 3])): ?>

                                <div>
                                    <label for="orderMessage" class="adm-label">Tin nhắn phản hồi</label>
                                    <textarea id="orderMessage" name="message" rows="3" placeholder="Nhập nội dung phản hồi..." class="adm-input px-4 py-3 text-sm min-h-[96px] resize-none w-full"></textarea>
                                </div>

                            <?php elseif ($currentStatus == 8): ?>

                                <div>
                                    <label for="cancelReason" class="adm-label text-red-600">Lý do hủy đơn</label>
                                    <textarea id="cancelReason" rows="3" readonly class="adm-input px-4 py-3 text-sm bg-slate-100 cursor-not-allowed w-full resize-none"><?= htmlspecialchars($message) ?></textarea>
                                </div>

                            <?php endif; ?>
                        </form>
                    </div>

                </div>

                <!-- FOOTER INFO -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

                    <div class="bg-slate-50 rounded-xl p-5 border border-slate-200">
                        <p class="text-xs text-slate-500">Ngày đặt</p>
                        <p class="font-semibold text-slate-900">
                            <?= date('d/m/Y H:i', strtotime($thongTin['created_at'])) ?>
                        </p>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-5 border border-slate-200">
                        <p class="text-xs text-slate-500">Tổng tiền</p>
                        <p class="text-2xl font-bold text-green-600">
                            <?= number_format($thongTin['tong_tien']) ?> đ
                        </p>
                    </div>

                </div>

                <!-- GHI CHÚ -->
                <?php if (!empty($thongTin['ghi_chu'])): ?>
                    <div class="mt-6 bg-amber-50 border border-amber-100 rounded-xl p-5">
                        <p class="text-xs text-amber-600 mb-1 font-medium">Ghi chú</p>
                        <p class="text-slate-700">
                            <?= htmlspecialchars($thongTin['ghi_chu']) ?>
                        </p>
                    </div>
                <?php endif; ?>

            </div>
        </main>

    </div>

    <?php include __DIR__ . '/components/toast-init.php'; ?>
</body>

</html>