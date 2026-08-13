<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản lý chi tiết đơn hàng</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://ireade.github.io/Toast.js/css/Toast.min.css">
    <script src="https://ireade.github.io/Toast.js/js/Toast.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#165DFF',
                        success: '#00B42A',
                        danger: '#F53F3F',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <?php include 'sitebar.php'; ?>

        <main class="flex-1 md:ml-64 p-6">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                <div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        Danh sách chi tiết đơn hàng
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Quản lý thông tin khách hàng và sản phẩm
                    </p>
                </div>

                <form action="index.php" method="GET" class="flex gap-2 w-full md:w-auto">

                    <input type="hidden" name="controller" value="order_detail">

                    <input type="hidden" name="action" value="search">

                    <input
                        type="search"
                        name="keyword"
                        placeholder="Tìm khách hàng hoặc sản phẩm..."
                        value="<?php echo $_GET['keyword'] ?? ''; ?>"
                        class="border border-gray-300 px-4 py-2 rounded-xl w-full md:w-80 focus:outline-none focus:ring-2 focus:ring-primary">

                    <button
                        type="submit"
                        class="bg-success hover:bg-green-700 text-white px-5 py-2 rounded-xl font-medium">
                        🔍 Tìm
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50 border-b">

                            <tr>

                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                    ID
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                    Sản phẩm
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                    Số lượng
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                    Giá
                                </th>


                            </tr>

                        </thead>

                        <tbody>

                            <?php if (empty($don_hang)): ?>

                                <tr>
                                    <td colspan="7" class="text-center py-14 text-gray-400">

                                        <div class="text-5xl mb-3">
                                            📭
                                        </div>

                                        Không có dữ liệu

                                    </td>

                                </tr>

                            <?php else: ?>

                                <?php foreach ($don_hang as $row) { ?>

                                    <tr class="border-b hover:bg-blue-50 transition">

                                        <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                            #<?php echo $row['idCT']; ?>
                                        </td>



                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            <?php echo htmlspecialchars($row['ten_san_pham']); ?>
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            <?php echo $row['sl']; ?>
                                        </td>

                                        <td class="px-6 py-4 text-sm font-semibold text-success">
                                            <?php echo number_format($row['gia']); ?> đ
                                        </td>


                                        <td class="px-6 py-4">

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">

                                        </td>

                                    </tr>

                                <?php } ?>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>
            <div class="mt-8 bg-white rounded-2xl shadow-lg border border-gray-100 p-6">

                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">
                        📋 Thông tin đơn hàng
                    </h2>

                    <span class="px-3 py-1 text-xs rounded-full bg-blue-50 text-blue-600 font-medium">
                        #<?= $thongTin['maDon'] ?>
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- KHÁCH HÀNG -->
                    <div class="bg-gray-50 rounded-xl p-5 space-y-4">

                        <h3 class="font-semibold text-gray-700 mb-2">
                            👤 Thông tin khách hàng
                        </h3>

                        <div>
                            <p class="text-xs text-gray-500">Tên khách hàng</p>
                            <p class="font-semibold text-gray-800">
                                <?= htmlspecialchars($thongTin['ten_khach_hang']) ?>
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">Số điện thoại</p>
                            <p class="font-semibold text-gray-800">
                                <?= htmlspecialchars($thongTin['so_dien_thoai']) ?>
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">Địa chỉ nhận hàng</p>
                            <p class="font-semibold text-gray-800 leading-relaxed">
                                <?= htmlspecialchars($thongTin['dia_chi']) ?>
                            </p>
                        </div>
                        <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                Trạng thái thanh toán đơn hàng
                            </h3>

                            <?php if ($thongTin['payment_status'] == 0): ?>
                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-100 text-yellow-800 font-medium">
                                    ⏳ Chưa thanh toán
                                </span>

                            <?php elseif ($thongTin['payment_status'] == 1): ?>
                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 font-medium">
                                    ✅ Đã thanh toán
                                </span>

                            <?php elseif ($thongTin['payment_status'] == 2): ?>
                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-orange-100 text-orange-700 font-medium">
                                    🚫 Khách hàng hủy thanh toán
                                </span>

                            <?php elseif ($thongTin['payment_status'] == 3): ?>
                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-red-100 text-red-700 font-medium">
                                    ❌ Thanh toán thất bại
                                </span>

                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- ĐƠN HÀNG -->
                    <div class="bg-gray-50 rounded-xl p-5 space-y-4">

                        <h3 class="font-semibold text-gray-700 mb-2">
                            📦 Trạng thái đơn hàng
                        </h3>

                        <!-- trạng thái -->
                        <div class="flex items-center justify-between">

                            <div>
                                <p class="text-xs text-gray-500">Trạng thái hiện tại</p>

                                <span class="inline-block mt-1 px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-semibold">
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
                            class="bg-gray-50 border border-gray-200 rounded-xl p-4 mt-4 space-y-4">

                            <!-- Chọn trạng thái -->
                            <div class="flex items-end gap-4">

                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Trạng thái đơn hàng
                                    </label>

                                    <select
                                        name="trangThai"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">

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
                                    <button
                                        type="submit"
                                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                        Duyệt
                                    </button>
                                <?php endif; ?>

                            </div>

                            <!-- Tin nhắn -->
                            <?php if (in_array($currentStatus, [1, 2, 3])): ?>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Tin nhắn phản hồi
                                    </label>

                                    <textarea
                                        name="message"
                                        rows="3"
                                        placeholder="Nhập nội dung phản hồi..."
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3
                   focus:ring-2 focus:ring-blue-300
                   focus:border-blue-400
                   resize-none"></textarea>
                                </div>

                            <?php elseif ($currentStatus == 8): ?>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2 text-red-600">
                                        Lý do hủy đơn
                                    </label>

                                    <textarea
                                        rows="3"
                                        readonly
                                        class="w-full border border-red-300 rounded-lg px-4 py-3 bg-gray-100 cursor-not-allowed"><?= htmlspecialchars($message) ?></textarea>
                                </div>

                            <?php endif; ?>
                        </form>
                    </div>

                </div>

                <!-- FOOTER INFO -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

                    <div class="bg-gray-50 rounded-xl p-5">
                        <p class="text-xs text-gray-500">Ngày đặt</p>
                        <p class="font-semibold text-gray-800">
                            <?= date('d/m/Y H:i', strtotime($thongTin['created_at'])) ?>
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-5">
                        <p class="text-xs text-gray-500">Tổng tiền</p>
                        <p class="text-2xl font-bold text-green-600">
                            <?= number_format($thongTin['tong_tien']) ?> đ
                        </p>
                    </div>

                </div>

                <!-- GHI CHÚ -->
                <?php if (!empty($thongTin['ghi_chu'])): ?>
                    <div class="mt-6 bg-yellow-50 border border-yellow-100 rounded-xl p-5">
                        <p class="text-xs text-yellow-600 mb-1">📝 Ghi chú</p>
                        <p class="text-gray-700">
                            <?= htmlspecialchars($thongTin['ghi_chu']) ?>
                        </p>
                    </div>
                <?php endif; ?>

            </div>
        </main>

    </div>

</body>
<script>
    // Xác nhận trước khi xóa tour
    function confirmDelete(tourId) {
        if (confirm('⚠️ Bạn chắc chắn muốn xóa tour này? Hành động không thể hoàn tác!')) {
            window.location.href = `index.php?controller=san_pham&action=delete&id=${tourId}`;
        }
    }
    window.onload = function() {
        <?php if (isset($_SESSION['msg'])) { ?>
            new Toast({
                message: "<?php echo $_SESSION['msg']; ?>",
                type: "<?php echo $_SESSION['type']; ?>",
                timeout: 3000
            });
            <?php
            unset($_SESSION['msg']);
            unset($_SESSION['type']);
            ?>
        <?php }; ?>
    };
</script>

</html>