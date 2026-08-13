<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Meta SEO chuẩn hệ thống -->
    <title>Quản lý Danh mục Tour | Hệ thống quản trị</title>
    <meta naame="description" content="Danh sách toàn bộ nhóm danh mục tour du lịch, thêm sửa xóa danh mục">
    <meta name="robots" content="noindex, nofollow">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://ireade.github.io/Toast.js/css/Toast.min.css">
    <script src="https://ireade.github.io/Toast.js/js/Toast.min.js"></script>

    <!-- ✅ CẤU HÌNH MÀU NHẤT QUAN TOÀN BỘ HỆ THỐNG -->
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
            .content-auto { content-visibility: auto; }
            .hover-row { transition: all 180ms ease-out; }
            .table-shadow { box-shadow: 0 4px 20px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.06); }
        }
    </style>
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    <div class="flex min-h-screen">
        <!-- Sidebar giữ nguyên 100% code gốc của bạn -->
        <?php include __DIR__ . '/sitebar.php'; ?>


        <!-- Nội dung chính -->
        <main class="ml-0 md:ml-64 flex-1 p-4 md:p-8 w-full">

            <header class="mb-7">
                <nav class="text-sm text-gray-500 mb-2">
                    <span>Trang chủ</span> / <span class="text-gray-700">Bang loai hang</span>
                </nav>

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <h1 class="text-[clamp(1.5rem,3vw,2.2rem)] font-bold text-gray-900">
                            Danh loai hang
                        </h1>
                        <p class="text-gray-500 mt-1">Quản lý nhóm phân loại tour đang bán trên hệ thống</p>
                    </div>

                    <a href="index.php?controller=loai_hang&action=create"
                        class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-xl transition-all duration-200 text-center shadow-lg shadow-primary/15 hover:shadow-primary/25 hover:-translate-y-0.5 font-medium">
                        ➕ Thêm loai hang
                    </a>
                </div>
            </header>


            <!-- Bảng danh sách -->
            <div class="bg-white rounded-2xl table-shadow overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tên danh mục</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if (empty($loai_hang)): ?>
                                <!-- Trạng thái không có dữ liệu -->
                                <tr>
                                    <td colspan="3" class="py-16 text-center text-gray-400">
                                        <div class="text-4xl mb-3">📂</div>
                                        Chưa có danh mục nào được tạo
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php foreach ($loai_hang as $row) { ?>
                                <tr class="hover-row border-b border-gray-50 hover:bg-blue-50/50 hover:shadow-inner">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#<?php echo $row['id']; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($row['ten_loai']); ?></td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center gap-2 flex justify-center">
                                        <a href="index.php?controller=loai_hang&action=update&id=<?php echo $row['id']; ?>"
                                            class="text-primary hover:text-primary/80 px-3 py-1 rounded-lg hover:bg-primary/10 transition">
                                            ✏️ Sửa
                                        </a>
                                        <button onclick="confirmDelete(<?php echo $row['id']; ?>)"
                                            class="text-danger hover:text-danger/80 px-3 py-1 rounded-lg hover:bg-danger/10 transition">
                                            🗑️ Xóa
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <script>
        // Xác nhận xóa thay thế alert mặc định
        function confirmDelete(categoryId) {
            if (confirm('⚠️ Bạn chắc chắn xóa danh mục này? Tất cả tour thuộc danh mục cũng sẽ bị ảnh hưởng!')) {
                window.location.href = `index.php?controller=loai_hang&action=delete&id=${categoryId}`;
            }
        }

        // ✅ GIỮ NGUYÊN 100% code Toast thông báo của bạn
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