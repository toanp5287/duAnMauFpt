<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Analytics | Tech Store Admin</title>

    <meta name="robots" content="noindex, nofollow">

    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>


<body class="bg-slate-50">

    <div class="flex min-h-screen">

        <?php include __DIR__ . '/sitebar.php'; ?>


        <!-- ========================================= -->
        <!-- MAIN -->
        <!-- ========================================= -->

        <main class="flex-1 lg:ml-64 pt-14 lg:pt-0 p-4 sm:p-6 lg:p-8 w-full min-w-0">


            <!-- ========================================= -->
            <!-- HEADER -->
            <!-- ========================================= -->

            <header class="mb-7">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>

                        <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">

                            <span>Trang chủ</span>

                            <span>/</span>

                            <span class="text-slate-700">
                                Thống kê
                            </span>

                        </div>


                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">
                            Tổng quan
                        </h1>

                        <p class="text-sm text-slate-500 mt-1">
                            Theo dõi hiệu suất kinh doanh của Tech Store
                        </p>

                    </div>


                    <!-- DATE FILTER -->

                    <div class="flex items-center gap-2">

                        <button
                            class="flex items-center gap-2 bg-white border border-slate-200
                            rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700
                            shadow-sm hover:bg-slate-50 transition-all duration-200">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 text-slate-500"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 4h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />

                            </svg>

                            Hôm nay

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7" />

                            </svg>

                        </button>

                    </div>

                </div>

            </header>



            <!-- ========================================= -->
            <!-- OVERVIEW CARDS -->
            <!-- ========================================= -->

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">


                <!-- DOANH THU -->

                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Doanh thu
                            </p>

                            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-2">

                                <?= number_format(
                                    $data['doanhThu'] ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) ?>

                                <span class="text-base font-medium">
                                    đ
                                </span>

                            </h2>

                        </div>


                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-blue-600"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 10v2m8-6a8 8 0 11-16 0 8 8 0 0116 0z" />

                            </svg>

                        </div>

                    </div>


                    <div class="mt-4 flex items-center gap-2">

                        <span class="text-xs font-semibold text-green-600">
                            Tổng doanh thu
                        </span>

                        <span class="text-xs text-slate-400">
                            toàn hệ thống
                        </span>

                    </div>

                </div>



                <!-- ĐƠN HÀNG -->

                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Đơn hàng
                            </p>

                            <h2 class="text-3xl font-bold text-slate-900 mt-2">

                                <?= number_format(
                                    $data['sodonhang'] ?? 0
                                ) ?>

                            </h2>

                        </div>


                        <div class="w-10 h-10 rounded-xl bg-violet-50 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-violet-600"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586A1.5 1.5 0 0119 4.5V19a2 2 0 01-2 2z" />

                            </svg>

                        </div>

                    </div>


                    <div class="mt-4">

                        <span class="text-xs text-slate-400">
                            Tổng số đơn hàng
                        </span>

                    </div>

                </div>



                <!-- KHÁCH HÀNG -->

                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Khách hàng
                            </p>

                            <h2 class="text-3xl font-bold text-slate-900 mt-2">

                                <?= number_format(
                                    $data['SOKH'] ?? 0
                                ) ?>

                            </h2>

                        </div>


                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-emerald-600"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-10a4 4 0 100-8 4 4 0 000 8zm10 10v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />

                            </svg>

                        </div>

                    </div>


                    <div class="mt-4">

                        <span class="text-xs text-slate-400">
                            Khách hàng đã mua hàng
                        </span>

                    </div>

                </div>



                <!-- SẢN PHẨM -->

                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Sản phẩm đã bán
                            </p>

                            <h2 class="text-3xl font-bold text-slate-900 mt-2">

                                <?= number_format(
                                    $data['soSP'] ?? 0
                                ) ?>

                            </h2>

                        </div>


                        <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-orange-600"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7m16 0l-8 4m-8-4l8 4m0 0v10" />

                            </svg>

                        </div>

                    </div>


                    <div class="mt-4">

                        <span class="text-xs text-slate-400">
                            Tổng số lượng đã bán
                        </span>

                    </div>

                </div>

            </div>



            <!-- ========================================= -->
            <!-- MAIN ANALYTICS -->
            <!-- ========================================= -->

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">


                <!-- ===================================== -->
                <!-- DOANH THU -->
                <!-- ===================================== -->

                <div class="xl:col-span-2 bg-white border border-slate-200 rounded-2xl shadow-sm">


                    <div class="p-5 border-b border-slate-100">

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                            <div>

                                <h2 class="font-semibold text-slate-900">
                                    Tổng quan doanh thu
                                </h2>

                                <p class="text-xs text-slate-500 mt-1">
                                    Hiệu suất bán hàng
                                </p>

                            </div>


                            <div class="flex items-center gap-4 text-xs">

                                <div class="flex items-center gap-2">

                                    <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>

                                    <span class="text-slate-500">
                                        Doanh thu
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- FAKE ANALYTICS CHART -->

                    <div class="p-5">

                        <div class="h-[280px] relative">


                            <!-- Y AXIS -->

                            <div class="absolute inset-0 flex flex-col justify-between">

                                <div class="border-t border-slate-100"></div>

                                <div class="border-t border-slate-100"></div>

                                <div class="border-t border-slate-100"></div>

                                <div class="border-t border-slate-100"></div>

                                <div class="border-t border-slate-100"></div>

                            </div>


                            <!-- CHART -->

                            <div class="absolute inset-0 flex items-end justify-between gap-2 px-2 pb-7">


                                <?php

                                $chartData = [
                                    35,
                                    48,
                                    42,
                                    68,
                                    55,
                                    78,
                                    92
                                ];

                                $days = [
                                    'T2',
                                    'T3',
                                    'T4',
                                    'T5',
                                    'T6',
                                    'T7',
                                    'CN'
                                ];

                                foreach ($chartData as $index => $value) {

                                ?>

                                    <div class="flex-1 flex flex-col items-center justify-end h-full">


                                        <div
                                            class="w-full max-w-[55px] bg-blue-600 rounded-t-lg hover:bg-blue-700 transition-all duration-200"
                                            style="height: <?= $value ?>%;">

                                        </div>


                                        <span class="text-[11px] text-slate-400 mt-3">

                                            <?= $days[$index] ?>

                                        </span>


                                    </div>

                                <?php } ?>


                            </div>

                        </div>

                    </div>

                </div>



                <!-- ===================================== -->
                <!-- ORDER STATUS -->
                <!-- ===================================== -->

                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">


                    <div class="p-5 border-b border-slate-100">

                        <h2 class="font-semibold text-slate-900">
                            Trạng thái đơn hàng
                        </h2>

                        <p class="text-xs text-slate-500 mt-1">
                            Phân bổ đơn hàng
                        </p>

                    </div>


                    <div class="p-5">


                        <!-- HOÀN THÀNH -->

                        <div class="mb-5">

                            <div class="flex justify-between items-center mb-2">

                                <div class="flex items-center gap-2">

                                    <span class="w-2.5 h-2.5 rounded-full bg-green-500"></span>

                                    <span class="text-sm text-slate-600">
                                        Hoàn thành
                                    </span>

                                </div>

                                <span class="font-semibold text-slate-900">

                                    <?= number_format(
                                        $data['donHoanThanh'] ?? 0
                                    ) ?>

                                </span>

                            </div>


                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">

                                <div class="h-full bg-green-500 rounded-full"
                                    style="width: <?= min(
                                                        100,
                                                        (($data['donHoanThanh'] ?? 0) /
                                                            max(($data['sodonhang'] ?? 1), 1)) * 100
                                                    ) ?>%">
                                </div>

                            </div>

                        </div>



                        <!-- HỦY -->

                        <div class="mb-5">

                            <div class="flex justify-between items-center mb-2">

                                <div class="flex items-center gap-2">

                                    <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>

                                    <span class="text-sm text-slate-600">
                                        Đã hủy
                                    </span>

                                </div>

                                <span class="font-semibold text-slate-900">

                                    <?= number_format(
                                        $data['donHuy'] ?? 0
                                    ) ?>

                                </span>

                            </div>


                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">

                                <div class="h-full bg-red-500 rounded-full"
                                    style="width: <?= min(
                                                        100,
                                                        (($data['donHuy'] ?? 0) /
                                                            max(($data['sodonhang'] ?? 1), 1)) * 100
                                                    ) ?>%">
                                </div>

                            </div>

                        </div>



                        <!-- TỶ LỆ HOÀN THÀNH -->

                        <div class="mt-7 pt-5 border-t border-slate-100">

                            <p class="text-xs text-slate-500">
                                Tỷ lệ hoàn thành
                            </p>


                            <div class="flex items-end gap-2 mt-1">

                                <span class="text-2xl font-bold text-slate-900">

                                    <?php

                                    $tongDon =
                                        $data['sodonhang'] ?? 0;

                                    $hoanThanh =
                                        $data['donHoanThanh'] ?? 0;

                                    $tyLe =
                                        $tongDon > 0
                                        ? ($hoanThanh / $tongDon) * 100
                                        : 0;

                                    echo number_format($tyLe, 1);

                                    ?>%

                                </span>

                                <span class="text-xs text-green-600 mb-1">
                                    thành công
                                </span>

                            </div>

                        </div>


                    </div>

                </div>

            </div>



            <!-- ========================================= -->
            <!-- BOTTOM -->
            <!-- ========================================= -->

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


                <!-- ===================================== -->
                <!-- BEST SELLER -->
                <!-- ===================================== -->

                <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">


                    <div class="p-5 border-b border-slate-100">

                        <div class="flex items-center justify-between">

                            <div>

                                <h2 class="font-semibold text-slate-900">
                                    Sản phẩm bán chạy
                                </h2>

                                <p class="text-xs text-slate-500 mt-1">
                                    Sản phẩm có số lượng bán cao nhất
                                </p>

                            </div>


                            <span class="px-3 py-1.5 rounded-lg bg-orange-50 text-orange-600 text-xs font-bold">
                                TOP
                            </span>

                        </div>

                    </div>


                    <?php if (!empty($hotNhat)) { ?>

                        <div class="p-5">


                            <div class="flex items-center gap-4">


                                <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-7 h-7 text-blue-600"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7m16 0l-8 4m-8-4l8 4m0 0v10" />

                                    </svg>

                                </div>


                                <div class="flex-1 min-w-0">

                                    <p class="text-xs text-slate-400 uppercase font-medium">
                                        #1 bán chạy nhất
                                    </p>

                                    <h3 class="font-semibold text-slate-900 mt-1 truncate">

                                        <?= htmlspecialchars(
                                            $hotNhat['ten_san_pham'] ?? ''
                                        ) ?>

                                    </h3>

                                </div>


                                <div class="text-right">

                                    <p class="text-2xl font-bold text-blue-600">

                                        <?= number_format(
                                            $hotNhat['tong_da_ban'] ?? 0
                                        ) ?>

                                    </p>

                                    <p class="text-xs text-slate-400">
                                        đã bán
                                    </p>

                                </div>

                            </div>


                            <!-- PROGRESS -->

                            <div class="mt-6">

                                <div class="flex justify-between text-xs mb-2">

                                    <span class="text-slate-500">
                                        Hiệu suất bán
                                    </span>

                                    <span class="font-medium text-slate-700">
                                        Cao
                                    </span>

                                </div>


                                <div class="h-2 bg-slate-100 rounded-full overflow-hidden">

                                    <div class="h-full bg-blue-600 rounded-full"
                                        style="width: 85%;">
                                    </div>

                                </div>

                            </div>


                        </div>

                    <?php } else { ?>

                        <div class="p-10 text-center">

                            <p class="text-sm text-slate-400">
                                Chưa có dữ liệu sản phẩm.
                            </p>

                        </div>

                    <?php } ?>

                </div>



                <!-- ===================================== -->
                <!-- QUICK SUMMARY -->
                <!-- ===================================== -->

                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">


                    <div class="p-5 border-b border-slate-100">

                        <h2 class="font-semibold text-slate-900">
                            Tóm tắt
                        </h2>

                        <p class="text-xs text-slate-500 mt-1">
                            Tổng quan nhanh
                        </p>

                    </div>


                    <div class="p-5 space-y-5">


                        <!-- 1 -->

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-xs text-slate-400">
                                    Đơn thành công
                                </p>

                                <p class="font-semibold text-slate-900 mt-1">

                                    <?= number_format(
                                        $data['donHoanThanh'] ?? 0
                                    ) ?>

                                </p>

                            </div>


                            <span class="w-9 h-9 rounded-lg bg-green-50 flex items-center justify-center text-green-600">

                                ✓

                            </span>

                        </div>



                        <!-- 2 -->

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-xs text-slate-400">
                                    Đơn bị hủy
                                </p>

                                <p class="font-semibold text-slate-900 mt-1">

                                    <?= number_format(
                                        $data['donHuy'] ?? 0
                                    ) ?>

                                </p>

                            </div>


                            <span class="w-9 h-9 rounded-lg bg-red-50 flex items-center justify-center text-red-600">

                                ×

                            </span>

                        </div>



                        <!-- 3 -->

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-xs text-slate-400">
                                    Sản phẩm bán
                                </p>

                                <p class="font-semibold text-slate-900 mt-1">

                                    <?= number_format(
                                        $data['soSP'] ?? 0
                                    ) ?>

                                </p>

                            </div>


                            <span class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">

                                ↑

                            </span>

                        </div>



                        <!-- 4 -->

                        <div class="pt-4 border-t border-slate-100">

                            <p class="text-xs text-slate-400">
                                Doanh thu trung bình / đơn
                            </p>


                            <p class="text-xl font-bold text-slate-900 mt-1">

                                <?php

                                $doanhThu =
                                    $data['doanhThu'] ?? 0;

                                $soDon =
                                    $data['sodonhang'] ?? 0;

                                $trungBinh =
                                    $soDon > 0
                                    ? $doanhThu / $soDon
                                    : 0;

                                echo number_format(
                                    $trungBinh,
                                    0,
                                    ',',
                                    '.'
                                );

                                ?>

                                đ

                            </p>

                        </div>


                    </div>

                </div>

            </div>


        </main>

    </div>

</body>

</html>