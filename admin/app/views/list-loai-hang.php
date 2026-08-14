<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý loại hàng | Tech Store Admin</title>
    <meta name="robots" content="noindex, nofollow">
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body>
    <div class="flex min-h-screen">
        <?php include __DIR__ . '/sitebar.php'; ?>

        <main class="flex-1 lg:ml-64 pt-14 lg:pt-0 p-4 sm:p-6 lg:p-8 w-full min-w-0">
            <header class="mb-6 sm:mb-8">
                <nav class="text-sm text-slate-500 mb-2">
                    <span>Trang chủ</span> / <span class="text-slate-700">Loại hàng</span>
                </nav>
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Danh sách loại hàng</h1>
                        <p class="text-slate-500 mt-1 text-sm">Quản lý nhóm phân loại sản phẩm</p>
                    </div>
                    <a href="index.php?controller=loai_hang&action=create" class="adm-btn-primary px-5 py-2.5 text-center w-full sm:w-auto">Thêm loại hàng</a>
                </div>
            </header>

            <div class="adm-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="adm-table w-full">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($loai_hang)) { ?>
                                <tr>
                                    <td colspan="3" class="py-16 text-center text-slate-400">Chưa có danh mục nào được tạo</td>
                                </tr>
                            <?php } ?>

                            <?php foreach ($loai_hang as $row) { ?>
                                <tr>
                                    <td class="font-medium text-slate-900">#<?php echo $row['id']; ?></td>
                                    <td class="font-medium text-slate-900"><?php echo htmlspecialchars($row['ten_loai']); ?></td>
                                    <td class="text-center whitespace-nowrap">
                                        <a href="index.php?controller=loai_hang&action=update&id=<?php echo $row['id']; ?>" class="adm-btn-secondary px-3 py-1.5 text-xs mr-1">Sửa</a>
                                        <button type="button" onclick="confirmDelete(<?php echo $row['id']; ?>)" class="adm-btn-danger px-3 py-1.5 text-xs">Xóa</button>
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
        function confirmDelete(categoryId) {
            if (confirm('Bạn chắc chắn xóa danh mục này?')) {
                window.location.href = `index.php?controller=loai_hang&action=delete&id=${categoryId}`;
            }
        }
    </script>
    <?php include __DIR__ . '/components/toast-init.php'; ?>
</body>

</html>
