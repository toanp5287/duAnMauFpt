<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo cáo doanh thu | Tech Store Admin</title>
    <meta name="robots" content="noindex, nofollow">
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body>
    <div class="flex min-h-screen">
        <?php include __DIR__ . '/sitebar.php'; ?>

        <main class="flex-1 lg:ml-64 pt-14 lg:pt-0 p-4 sm:p-6 lg:p-8 w-full min-w-0">
            <header class="mb-6 sm:mb-8">
                <nav class="text-sm text-slate-500 mb-2">
                    <span>Trang chủ</span> / <span class="text-slate-700">Thống kê dữ liệu</span>
                </nav>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Báo cáo doanh thu</h1>
                <p class="text-slate-500 mt-1 text-sm">Tổng hợp và phân tích dữ liệu bán hàng</p>
            </header>

            <!-- Dashboard cards — mobile 1-2 cols -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
                <div class="adm-card p-5">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide mb-1">Số SP hiện có</p>
                    <p class="text-2xl font-bold text-slate-900"><?= $data['soSP'] ?></p>
                </div>
                <div class="adm-card p-5">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide mb-1">Số khách hàng</p>
                    <p class="text-2xl font-bold text-slate-900"><?= $data['SOKH'] ?></p>
                </div>
                <div class="adm-card p-5">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide mb-1">Số đơn hàng</p>
                    <p class="text-2xl font-bold text-slate-900"><?= $data['sodonhang'] ?></p>
                </div>
                <div class="adm-card p-5">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide mb-1">Tổng doanh thu</p>
                    <p class="text-xl sm:text-2xl font-bold text-green-600"><?= number_format($data['doanhThu'], 0, ',', '.') ?> đ</p>
                </div>
            </div>

            <div class="adm-card p-5 sm:p-6">
                <h2 class="text-sm font-semibold text-slate-900 mb-3">Sản phẩm bán chạy nhất</h2>
                <p class="text-slate-700">
                    <span class="adm-badge-amber mr-2">Hot</span>
                    <?= htmlspecialchars($hotNhat['ten_san_pham']) ?>
                    (<span class="font-semibold text-blue-600"><?= $hotNhat['tong_da_ban'] ?></span> sp)
                </p>
            </div>
        </main>
    </div>
</body>

</html>
