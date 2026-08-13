<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa danh mục tour</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

    <div class="flex">
        <?php include __DIR__ . '/../views/sitebar.php'; ?>
        <div class="ml-64 flex-1 p-6">
            <h2 class="text-2xl font-bold text-center mb-6">Sửa loai hang</h2>
            <form method="POST" class="space-y-4">
                <input type="hidden" name="id" value="<?php echo $list_loai['id']; ?>">
                <div>
                    <label>Tên danh muc</label>
                    <input type="text" name="ten_loai" value="<?php echo $list_loai['ten_loai']; ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p id="ten_loai_err" class="text-red-500 text-sm mt-1"></p>
                </div>
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition-colors">Cập nhật</button>

            </form>

            <a href="index.php?controller=loai_hang&action=index" class="block text-center mt-6 text-gray-700 hover:text-gray-900 underline">← Quay lại danh sách</a>

        </div>
    </div>

</body>

</html>