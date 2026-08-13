<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ✅ META SEO CHUẨN -->
    <title>Quản alý danh sách Tour du lịch | Hệ thống quản trị</title>
    <meta name="description" content="Trang quản lý danh sách tất cả tour du lịch, xem giá, thời gian khởi hành, chỉnh sửa và xóa tour">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="https://domaincuaban.com/index.php?controller=tour">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://ireade.github.io/Toast.js/css/Toast.min.css">
    <script src="https://ireade.github.io/Toast.js/js/Toast.min.js"></script>

    <!-- Cấu hình màu chủ đề ngành du lịch -->
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

            <!-- Tiêu đề trang - SEMANTIC HTML SEO -->
            <header class="mb-7">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <nav class="text-sm text-gray-500 mb-2">
                            <span>Trang chủ</span> / <span class="text-gray-700">Quản lý Tour</span>
                        </nav>
                        <h1 class="text-[clamp(1.5rem,3vw,2.2rem)] font-bold text-gray-900">
                            Danh sách san pham
                        </h1>
                        <p class="text-gray-500 mt-1">Quản lý tất cả san pham</p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                        <a href="index.php?controller=san_pham&action=create"
                            class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-xl transition-all duration-200 text-center shadow-lg shadow-primary/15 hover:shadow-primary/25 hover:-translate-y-0.5 font-medium">
                            ➕ Thêm san pham mới
                        </a>

                        <!-- Form tìm kiếm -->
                        <form action="index.php" method="GET" class="flex gap-2">
                            <input type="hidden" name="controller" value="tour">
                            <input type="hidden" name="action" value="search">

                            <input type="search" name="ten_loai" placeholder="Tìm tên tour, loại tour..."
                                class="border border-gray-200 px-4 py-2.5 rounded-xl w-full focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">

                            <button type="submit"
                                class="bg-success hover:bg-success/90 text-white px-5 py-2.5 rounded-xl transition-all shadow shadow-success/10 font-medium whitespace-nowrap">
                                🔍 Tìm
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Bảng danh sách -->
            <div class="bg-white rounded-2xl table-shadow overflow-hidden border border-gray-100">

                <!-- ✅ Responsive table: tự động cuộn ngang trên điện thoại -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tên san pham</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">gia</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">so luong</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">mo ta</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">loai hang</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">hinh anh</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($product)): ?>
                                <!-- Trạng thái không có dữ liệu -->
                                <tr>
                                    <td colspan="8" class="py-16 text-center text-gray-400">
                                        <div class="text-4xl mb-3">📭</div>
                                        Chưa có san pham nào được tạo
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php foreach ($product as $row) { ?>
                                <tr class="hover-row border-b border-gray-50 hover:bg-blue-50/50 hover:shadow-inner">

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #<?php echo $row['id']; ?>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?php echo htmlspecialchars($row['ten_san_pham']); ?>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-success">
                                        <?php echo number_format($row['gia'], 0, ',', '.'); ?> đ
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <?php echo $row['so_luong']; ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 max-w-xs">
                                        <?php
                                        echo mb_strlen($row['mo_ta']) > 20
                                            ? mb_substr($row['mo_ta'], 0, 20) . '...'
                                            : $row['mo_ta'];
                                        ?>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?php echo htmlspecialchars($row['ten_loai']); ?>
                                    </td>

                                    <td class="px-6 py-4">
                                        <img
                                            src="../public/uploads/<?= $row['hinh_anh']; ?>"
                                            width="80"
                                            class="rounded-lg">
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <a href="index.php?controller=san_pham&action=update&id=<?php echo $row['id']; ?>"
                                            class="text-primary hover:text-primary/80 px-3 py-1 rounded-lg hover:bg-primary/10 transition">
                                            ✏️ Sửa
                                        </a>
                                        <button onclick="confirmDelete(<?php echo $row['id']; ?>)"
                                            class="text-danger hover:text-danger/80 px-3 py-1 rounded-lg hover:bg-danger/10 transition">
                                            🗑️ Xóa
                                        </button>
                                    </td>
                                </tr>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </main>
    </div>

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

</body>

</html>