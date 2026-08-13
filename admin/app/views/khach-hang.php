<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ✅ META SEO CHUẨN -->
    <title>Quản lý Đơn hàng & Khách hàng | Hệ thống quản trị</title>
    <meta name="description" content="Trang quản lý danh sách tất cả khách hàng và đơn hàng, tổng tiền, trạng thái">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="https://domaincuaban.com/index.php?controller=khach_hang">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://ireade.github.io/Toast.js/css/Toast.min.css">
    <script src="https://ireade.github.io/Toast.js/js/Toast.min.js"></script>

    <!-- Cấu hình màu chủ đề -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#165DFF',
                        success: '#00B42A',
                        danger: '#F53F3F',
                        warning: '#FF7D00'
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style type="text/tailwindcss">
        @layer utilities {
            .content-auto {
                content-visibility: auto;
            }
            .hover-row {
                transition: all 180ms ease-out;
            }
            .table-shadow {
                box-shadow: 0 4px 20px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.06);
            }
        }
    </style>
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    <div class="flex min-h-screen">
        <!-- Sidebar giữ nguyên logic của bạn -->
        <?php include 'sitebar.php'; ?>

        <!-- Nội dung chính -->
        <main class="ml-0 md:ml-64 flex-1 p-4 md:p-8 w-full">

            <!-- Tiêu đề trang -->
            <header class="mb-7">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <nav class="text-sm text-gray-500 mb-2">
                            <span>Trang chủ</span> / <span class="text-gray-700">Quản lý Khách hàng</span>
                        </nav>
                        <h1 class="text-[clamp(1.5rem,3vw,2.2rem)] font-bold text-gray-900">
                            Danh sách đơn hàng khách hàng
                        </h1>
                        <p class="text-gray-500 mt-1">Quản lý tất cả thông tin đặt hàng</p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                        <!-- Đổi controller sang khach_hang -->
                        <!-- <a href="index.php?controller=khach_hang&action=create"
                            class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-xl transition-all duration-200 text-center shadow-lg shadow-primary/15 hover:shadow-primary/25 hover:-translate-y-0.5 font-medium">
                            ➕ Thêm khách hàng mới
                        </a> -->

                        <!-- Form tìm kiếm chuẩn theo controller khach_hang -->
                        <form action="index.php" method="GET" class="flex gap-2">
                            <input type="hidden" name="controller" value="khach_hang">
                            <input type="hidden" name="action" value="search">

                            <input type="search" name="keyword" placeholder="Tìm tên, số điện thoại..."
                                class="border border-gray-200 px-4 py-2.5 rounded-xl w-full focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">

                            <button type="submit"
                                class="bg-success hover:bg-success/90 text-white px-5 py-2.5 rounded-xl transition-all shadow shadow-success/10 font-medium whitespace-nowrap">
                                🔍 Tìm kiem khach hang
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Bảng danh sách -->
            <div class="bg-white rounded-2xl table-shadow overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Chi tiết</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Ma đơn</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tên khách hàng</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Số điện thoại</th>


                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tai khoan</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Địa chỉ</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Cách thanh toán</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Ghi chú</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tổng tiền</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Thời gian đặt</th>

                        </thead>
                        <tbody>
                            <?php if (empty($khach_hang)): ?>
                                <tr>
                                    <!-- Sửa từ colspan=8 thành colspan=10 cho đủ số cột -->
                                    <td colspan="10" class="py-16 text-center text-gray-400">
                                        <div class="text-4xl mb-3">📭</div>
                                        Chưa có dữ liệu nào được tạo
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($khach_hang as $row) { ?>

                                    <tr class="hover-row border-b border-gray-50 hover:bg-blue-50/50 hover:shadow-inner">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <a href="index.php?controller=order_detail&action=index&id=<?= $row['donHangId'] ?? '' ?>">
                                                <i class="fa fa-eye hover:text-blue-500 transition"></i>
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                                            #<?= $row['maDon'] ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <?php echo htmlspecialchars($row['ten_khach_hang']); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            <!-- Bỏ chữ 'đ' sai logic ở đây -->
                                            <?php echo htmlspecialchars($row['so_dien_thoai']); ?>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <?php echo htmlspecialchars($row['name']); ?>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                                            <?php echo htmlspecialchars($row['dia_chi']); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <?php echo htmlspecialchars($row['cach_thanh_toan']); ?>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                                            <?php echo htmlspecialchars($row['ghi_chu'] ?? ''); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-success">
                                            <?php echo number_format($row['tong_tien']); ?> đ
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php echo $row['created_at']; ?>
                                        </td>

                                    </tr>

                                <?php } ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Xác nhận trước khi xóa dữ liệu khách hàng
        function confirmDelete(id) {
            if (confirm('⚠️ Bạn chắc chắn muốn xóa khách hàng này? Hành động không thể hoàn tác!')) {
                // Sửa thành controller=khach_hang thống nhất với backend của bạn
                window.location.href = `index.php?controller=khach_hang&action=delete&id=${id}`;
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
</body>

</html>