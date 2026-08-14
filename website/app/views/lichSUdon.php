<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lịch sử đơn hàng | Tech Store</title>
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body class="font-sans bg-slate-50 text-slate-700 antialiased">
    <div class="flex flex-col min-h-screen">
        <?php include __DIR__ . '/components/header.php'; ?>

        <main class="flex-1 py-8 lg:py-10">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">
                    <?php $accountActive = 'orders';
                    include __DIR__ . '/components/account-sidebar.php'; ?>

                    <div class="flex-1 min-w-0">
                        <div class="ds-card p-5 sm:p-8">
                            <h2 class="text-xl sm:text-2xl font-bold text-slate-900 mb-6">Lịch sử đơn hàng</h2>

                            <div class="overflow-x-auto rounded-xl border border-slate-200">
                                <table class="min-w-[720px] w-full text-sm">
                                    <thead class="bg-slate-50 border-b border-slate-200">
                                        <tr>
                                            <th class="px-4 sm:px-6 py-3 text-left font-semibold text-slate-900">Mã đơn</th>
                                            <th class="px-4 sm:px-6 py-3 text-left font-semibold text-slate-900">Người nhận</th>
                                            <th class="px-4 sm:px-6 py-3 text-center font-semibold text-slate-900">SĐT</th>
                                            <th class="px-4 sm:px-6 py-3 text-center font-semibold text-slate-900">Phương thức</th>
                                            <th class="px-4 sm:px-6 py-3 text-center font-semibold text-slate-900">Trạng thái</th>

                                            <th class="px-4 sm:px-6 py-3 text-center font-semibold text-slate-900">Hành động</th>
                                            <th class="px-4 sm:px-6 py-3 text-center font-semibold text-slate-900">Chi tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 bg-white">
                                        <?php foreach ($lich_su_don as $row): ?>
                                            <tr class="hover:bg-slate-50 transition duration-200">
                                                <td class="px-4 sm:px-6 py-4 font-semibold text-blue-600">#<?= $row['maDon'] ?></td>
                                                <td class="px-4 sm:px-6 py-4"><?= $row['ten_khach_hang'] ?></td>
                                                <td class="px-4 sm:px-6 py-4 text-center"><?= $row['so_dien_thoai'] ?></td>
                                                <td class="px-4 sm:px-6 py-4 text-center">
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                                        <?= $row['cach_thanh_toan'] ?>
                                                    </span>
                                                </td>
                                                <td class="px-4 sm:px-6 py-4 text-center">
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                                        <?= $row['ten_trang_thai'] ?>
                                                    </span>
                                                </td>
                                                <td class="px-4 sm:px-6 py-4 text-center min-w-[140px]">
                                                    <?php if (in_array($row['trang_thai_id'], [1, 2, 3])): ?>
                                                        <form action="index.php?controller=shopping_cart&action=huyDon" method="POST" class="space-y-2">
                                                            <input type="hidden" name="trangThai" value="6">
                                                            <input type="hidden" name="idDon" value="<?= $row['id'] ?>">
                                                            <textarea name="message" rows="3" placeholder="Nhập lý do hủy đơn..." class="ds-input w-full px-3 py-2 text-sm hidden reason-box min-h-[72px]" required></textarea>
                                                            <button type="button" class="show-reason ds-btn-danger px-3 py-1.5 text-xs w-full sm:w-auto">Hủy đơn</button>
                                                            <button type="submit" class="submit-btn ds-btn-primary px-3 py-1.5 text-xs hidden w-full sm:w-auto bg-red-600 hover:bg-red-700">Xác nhận hủy</button>
                                                        </form>
                                                    <?php elseif ($row['trang_thai_id'] == 5): ?>
                                                        <form action="index.php?controller=shopping_cart&action=sacNhan" method="POST">
                                                            <input type="hidden" name="trangThai" value="5">
                                                            <input type="hidden" name="idDon" value="<?= $row['id'] ?>">
                                                            <button class="ds-btn-success px-3 py-1.5 text-xs w-full sm:w-auto">Đã nhận</button>
                                                        </form>
                                                    <?php elseif ($row['trang_thai_id'] == 6): ?>
                                                        <form action="index.php?controller=shopping_cart&action=hoanHang" method="POST">
                                                            <input type="hidden" name="trangThai" value="9">
                                                            <input type="hidden" name="idDon" value="<?= $row['id'] ?>">
                                                            <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn gửi yêu cầu hoàn hàng?')" class="ds-btn-secondary px-3 py-1.5 text-xs w-full sm:w-auto text-amber-700 border-amber-200 hover:bg-amber-50">Hoàn hàng</button>
                                                        </form>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="px-4 sm:px-6 py-4 text-center">
                                                    <a href="index.php?controller=shopping_cart&action=chiTietDonHang&id=<?= $row['id']; ?>" class="text-blue-600 hover:text-blue-700 text-sm font-medium" aria-label="Xem chi tiết đơn hàng">Xem</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include __DIR__ . '/components/footer.php'; ?>
    </div>

    <script>
        document.querySelectorAll(".show-reason").forEach(button => {
            button.addEventListener("click", function() {
                const form = this.closest("form");
                form.querySelector(".reason-box").classList.remove("hidden");
                form.querySelector(".submit-btn").classList.remove("hidden");
                this.classList.add("hidden");
            });
        });
    </script>
</body>

</html>