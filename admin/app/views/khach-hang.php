<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng | Tech Store Admin</title>
    <meta name="robots" content="noindex, nofollow">
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body>
    <div class="flex min-h-screen">
        <?php include __DIR__ . '/sitebar.php'; ?>

        <main class="flex-1 lg:ml-64 pt-14 lg:pt-0 p-4 sm:p-6 lg:p-8 w-full min-w-0">
            <header class="mb-6 sm:mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div>
                        <nav class="text-sm text-slate-500 mb-2">
                            <span>Trang chủ</span> / <span class="text-slate-700">Quản lý đơn hàng</span>
                        </nav>
                        <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Danh sách đơn hàng khách hàng</h1>
                        <p class="text-slate-500 mt-1 text-sm">Quản lý tất cả thông tin đặt hàng</p>
                    </div>

                    <form action="index.php" method="GET" class="flex flex-col sm:flex-row gap-2 w-full lg:w-auto">
                        <input type="hidden" name="controller" value="khach_hang">
                        <input type="hidden" name="action" value="search">
                        <input type="search" name="keyword" placeholder="Tìm tên, số điện thoại..."
                            class="adm-input h-10 px-4 text-sm w-full sm:min-w-[220px]">
                        <button type="submit" class="adm-btn-success h-10 px-5 whitespace-nowrap">Tìm</button>
                    </form>
                </div>
            </header>

            <div class="adm-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="adm-table w-full min-w-[960px]">
                        <thead>
                            <tr>
                                <th>Chi tiết</th>
                                <th>Mã đơn</th>
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Tài khoản</th>
                                <th>Địa chỉ</th>
                                <th>Thanh toán</th>
                                <th>Ghi chú</th>
                                <th>Tổng tiền</th>
                                <th>Thời gian đặt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($khach_hang)) { ?>
                                <tr>
                                    <td colspan="10" class="py-16 text-center text-slate-400">Chưa có dữ liệu nào được tạo</td>
                                </tr>
                            <?php } else { ?>
                                <?php foreach ($khach_hang as $row) { ?>
                                    <tr>
                                        <td>
                                            <a href="index.php?controller=order_detail&action=index&id=<?= $row['donHangId'] ?? '' ?>" class="text-blue-600 hover:text-blue-700 text-sm font-medium" aria-label="Xem chi tiết đơn hàng">Xem</a>
                                        </td>
                                        <td class="font-medium text-slate-900 whitespace-nowrap">#<?= $row['maDon'] ?></td>
                                        <td class="font-medium text-slate-900"><?php echo htmlspecialchars($row['ten_khach_hang']); ?></td>
                                        <td><?php echo htmlspecialchars($row['so_dien_thoai']); ?></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td class="max-w-[140px] truncate"><?php echo htmlspecialchars($row['dia_chi']); ?></td>
                                        <td><?php echo htmlspecialchars($row['cach_thanh_toan']); ?></td>
                                        <td class="max-w-[120px] truncate"><?php echo htmlspecialchars($row['ghi_chu'] ?? ''); ?></td>
                                        <td class="font-semibold text-green-600 whitespace-nowrap"><?php echo number_format($row['tong_tien']); ?> đ</td>
                                        <td class="text-slate-500 whitespace-nowrap"><?php echo $row['created_at']; ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm('Bạn chắc chắn muốn xóa khách hàng này?')) {
                window.location.href = `index.php?controller=khach_hang&action=delete&id=${id}`;
            }
        }
    </script>
    <?php include __DIR__ . '/components/toast-init.php'; ?>
</body>

</html>
