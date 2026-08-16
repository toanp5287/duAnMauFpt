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


        <!-- =====================================================
         MAIN
    ====================================================== -->

        <main
            class="
            flex-1
            lg:ml-64
            pt-14
            lg:pt-0
            p-4
            sm:p-6
            lg:p-8
            w-full
            min-w-0
        ">


            <!-- =================================================
             HEADER
        ================================================== -->

            <header class="mb-6 sm:mb-8">

                <nav class="text-sm text-slate-500 mb-2">
                    <span>Trang chủ</span>

                    <span class="mx-1">/</span>

                    <span class="text-slate-700">
                        Quản lý đơn hàng
                    </span>
                </nav>


                <h1
                    class="
                    text-xl
                    sm:text-2xl
                    font-bold
                    text-slate-900
                ">
                    Danh sách đơn hàng khách hàng
                </h1>


                <p class="text-slate-500 mt-1 text-sm">
                    Quản lý tất cả thông tin đặt hàng
                </p>

            </header>



            <!-- =====================================================
             TRẠNG THÁI HIỆN TẠI
        ====================================================== -->

            <?php

            $trangThaiHienTai = $_GET['trang_thai_id'] ?? '';

            ?>


            <!-- =====================================================
             LỌC TRẠNG THÁI
        ====================================================== -->

            <div class="mb-5 overflow-x-auto">

                <div class="flex items-center gap-2 min-w-max">


                    <!-- TẤT CẢ -->

                    <a
                        href="index.php?controller=khach_hang&action=index"
                        class="
                        px-4
                        py-2
                        rounded-xl
                        text-sm
                        font-medium
                        transition-all
                        duration-200

                        <?= $trangThaiHienTai === ''
                            ? 'bg-blue-600 text-white shadow-md'
                            : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'
                        ?>
                    ">
                        Tất cả
                    </a>


                    <!-- 1 -->

                    <a
                        href="index.php?controller=khach_hang&action=index&trang_thai_id=1"
                        class="
                        px-4
                        py-2
                        rounded-xl
                        text-sm
                        font-medium
                        transition-all
                        duration-200

                        <?= $trangThaiHienTai == '1'
                            ? 'bg-yellow-500 text-white shadow-md'
                            : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'
                        ?>
                    ">
                        Chờ xác nhận
                    </a>


                    <!-- 2 -->

                    <a
                        href="index.php?controller=khach_hang&action=index&trang_thai_id=2"
                        class="
                        px-4
                        py-2
                        rounded-xl
                        text-sm
                        font-medium
                        transition-all
                        duration-200

                        <?= $trangThaiHienTai == '2'
                            ? 'bg-blue-600 text-white shadow-md'
                            : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'
                        ?>
                    ">
                        Đã xác nhận
                    </a>


                    <!-- 3 -->

                    <a
                        href="index.php?controller=khach_hang&action=index&trang_thai_id=3"
                        class="
                        px-4
                        py-2
                        rounded-xl
                        text-sm
                        font-medium
                        transition-all
                        duration-200

                        <?= $trangThaiHienTai == '3'
                            ? 'bg-indigo-600 text-white shadow-md'
                            : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'
                        ?>
                    ">
                        Đang chuẩn bị
                    </a>


                    <!-- 4 -->

                    <a
                        href="index.php?controller=khach_hang&action=index&trang_thai_id=4"
                        class="
                        px-4
                        py-2
                        rounded-xl
                        text-sm
                        font-medium
                        transition-all
                        duration-200

                        <?= $trangThaiHienTai == '4'
                            ? 'bg-purple-600 text-white shadow-md'
                            : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'
                        ?>
                    ">
                        Đang giao
                    </a>


                    <!-- 5 -->

                    <a
                        href="index.php?controller=khach_hang&action=index&trang_thai_id=5"
                        class="
                        px-4
                        py-2
                        rounded-xl
                        text-sm
                        font-medium
                        transition-all
                        duration-200

                        <?= $trangThaiHienTai == '5'
                            ? 'bg-green-600 text-white shadow-md'
                            : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'
                        ?>
                    ">
                        Giao thành công
                    </a>


                    <!-- 6 -->

                    <a
                        href="index.php?controller=khach_hang&action=index&trang_thai_id=6"
                        class="
                        px-4
                        py-2
                        rounded-xl
                        text-sm
                        font-medium
                        transition-all
                        duration-200

                        <?= $trangThaiHienTai == '6'
                            ? 'bg-slate-600 text-white shadow-md'
                            : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'
                        ?>
                    ">
                        Đã nhận hàng
                    </a>


                    <!-- 7 -->

                    <a
                        href="index.php?controller=khach_hang&action=index&trang_thai_id=7"
                        class="
                        px-4
                        py-2
                        rounded-xl
                        text-sm
                        font-medium
                        transition-all
                        duration-200

                        <?= $trangThaiHienTai == '7'
                            ? 'bg-red-600 text-white shadow-md'
                            : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'
                        ?>
                    ">
                        Đã hủy
                    </a>


                    <!-- 9 -->

                    <a
                        href="index.php?controller=khach_hang&action=index&trang_thai_id=9"
                        class="
                        px-4
                        py-2
                        rounded-xl
                        text-sm
                        font-medium
                        transition-all
                        duration-200

                        <?= $trangThaiHienTai == '9'
                            ? 'bg-orange-500 text-white shadow-md'
                            : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'
                        ?>
                    ">
                        Yêu cầu hoàn hàng
                    </a>


                    <!-- 10 -->

                    <a
                        href="index.php?controller=khach_hang&action=index&trang_thai_id=10"
                        class="
                        px-4
                        py-2
                        rounded-xl
                        text-sm
                        font-medium
                        transition-all
                        duration-200

                        <?= $trangThaiHienTai == '10'
                            ? 'bg-orange-600 text-white shadow-md'
                            : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'
                        ?>
                    ">
                        Shop xác nhận hoàn
                    </a>


                    <!-- 11 -->

                    <a
                        href="index.php?controller=khach_hang&action=index&trang_thai_id=11"
                        class="
                        px-4
                        py-2
                        rounded-xl
                        text-sm
                        font-medium
                        transition-all
                        duration-200

                        <?= $trangThaiHienTai == '11'
                            ? 'bg-slate-600 text-white shadow-md'
                            : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'
                        ?>
                    ">
                        Đã hoàn hàng
                    </a>

                </div>

            </div>



            <!-- =====================================================
             LỌC ĐƠN HÀNG THEO TRẠNG THÁI
        ====================================================== -->

            <?php

            $donHangHienThi = [];

            if (!empty($khach_hang)) {

                foreach ($khach_hang as $row) {

                    /*
                 * Nếu chọn Tất cả
                 */
                    if ($trangThaiHienTai === '') {

                        $donHangHienThi[] = $row;
                    }

                    /*
                 * Nếu chọn trạng thái cụ thể
                 */ elseif (
                        (int)($row['trang_thai_id'] ?? 0)
                        ===
                        (int)$trangThaiHienTai
                    ) {

                        $donHangHienThi[] = $row;
                    }
                }
            }

            ?>



            <!-- =====================================================
             BẢNG ĐƠN HÀNG
        ====================================================== -->

            <div class="adm-card overflow-hidden">

                <div class="overflow-x-auto">

                    <table
                        class="
                        adm-table
                        w-full
                        min-w-[1200px]
                    ">

                        <thead>

                            <tr>

                                <th>Chi tiết</th>

                                <th>Mã đơn</th>

                                <th>Tên khách hàng</th>

                                <th>Số điện thoại</th>

                                <th>Tài khoản</th>

                                <th>Địa chỉ</th>

                                <th>Thanh toán</th>

                                <th>Trạng thái</th>

                                <th>Ghi chú</th>

                                <th>Tổng tiền</th>

                                <th>Thời gian đặt</th>

                                <th class="text-center">
                                    Thao tác
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            <?php if (empty($donHangHienThi)): ?>

                                <!-- =================================================
                             KHÔNG CÓ ĐƠN
                        ================================================== -->

                                <tr>

                                    <td
                                        colspan="12"
                                        class="py-16 text-center">

                                        <div
                                            class="
                                        flex
                                        flex-col
                                        items-center
                                        justify-center
                                    ">

                                            <div
                                                class="
                                            w-12
                                            h-12
                                            rounded-full
                                            bg-slate-100
                                            flex
                                            items-center
                                            justify-center
                                            mb-3
                                        ">

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="w-6 h-6 text-slate-400"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor">

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414A1 1 0 0119 8.414V19a2 2 0 01-2 2z" />

                                                </svg>

                                            </div>


                                            <p class="text-slate-400 text-sm">
                                                Không có đơn hàng nào trong trạng thái này
                                            </p>

                                        </div>

                                    </td>

                                </tr>


                            <?php else: ?>


                                <?php foreach ($donHangHienThi as $row): ?>


                                    <?php

                                    /*
                             * ======================================
                             * TRẠNG THÁI ĐƠN HÀNG
                             * ======================================
                             */

                                    $trangThaiId = (int)($row['trang_thai_id'] ?? 0);


                                    switch ($trangThaiId) {

                                        case 1:
                                            $trangThaiText = 'Chờ xác nhận';
                                            $trangThaiClass = 'bg-yellow-100 text-yellow-700';
                                            break;

                                        case 2:
                                            $trangThaiText = 'Đã xác nhận';
                                            $trangThaiClass = 'bg-blue-100 text-blue-700';
                                            break;

                                        case 3:
                                            $trangThaiText = 'Đang chuẩn bị hàng';
                                            $trangThaiClass = 'bg-indigo-100 text-indigo-700';
                                            break;

                                        case 4:
                                            $trangThaiText = 'Đang giao hàng';
                                            $trangThaiClass = 'bg-purple-100 text-purple-700';
                                            break;

                                        case 5:
                                            $trangThaiText = 'Giao hàng thành công';
                                            $trangThaiClass = 'bg-green-100 text-green-700';
                                            break;

                                        case 6:
                                            $trangThaiText = 'Đã nhận hàng';
                                            $trangThaiClass = 'bg-slate-100 text-slate-700';
                                            break;

                                        case 7:
                                            $trangThaiText = 'Đã hủy';
                                            $trangThaiClass = 'bg-red-100 text-red-700';
                                            break;

                                        case 9:
                                            $trangThaiText = 'Yêu cầu hoàn hàng';
                                            $trangThaiClass = 'bg-orange-100 text-orange-700';
                                            break;

                                        case 10:
                                            $trangThaiText = 'Shop xác nhận hoàn hàng';
                                            $trangThaiClass = 'bg-orange-100 text-orange-700';
                                            break;

                                        case 11:
                                            $trangThaiText = 'Đã hoàn hàng';
                                            $trangThaiClass = 'bg-slate-100 text-slate-700';
                                            break;

                                        default:
                                            $trangThaiText = 'Không xác định';
                                            $trangThaiClass = 'bg-slate-100 text-slate-500';
                                            break;
                                    }


                                    /*
                             * ======================================
                             * QUYỀN XÓA
                             *
                             * Chỉ cho xóa:
                             *
                             * 7  = Đã hủy
                             * 11 = Đã hoàn hàng
                             * ======================================
                             */

                                    $duocPhepXoa = in_array(
                                        $trangThaiId,
                                        [7, 11],
                                        true
                                    );

                                    ?>


                                    <tr>


                                        <!-- ==============================
                                     CHI TIẾT
                                =============================== -->

                                        <td>

                                            <a
                                                href="index.php?controller=order_detail&action=index&id=<?= urlencode($row['donHangId'] ?? '') ?>"
                                                class="
                                            text-blue-600
                                            hover:text-blue-700
                                            text-sm
                                            font-medium
                                        ">
                                                Xem
                                            </a>

                                        </td>


                                        <!-- ==============================
                                     MÃ ĐƠN
                                =============================== -->

                                        <td
                                            class="
                                        font-medium
                                        text-slate-900
                                        whitespace-nowrap
                                    ">

                                            #<?= htmlspecialchars(
                                                    $row['maDon'] ?? ''
                                                ) ?>

                                        </td>


                                        <!-- ==============================
                                     TÊN KHÁCH HÀNG
                                =============================== -->

                                        <td
                                            class="
                                        font-medium
                                        text-slate-900
                                    ">

                                            <?= htmlspecialchars(
                                                $row['ten_khach_hang'] ?? ''
                                            ) ?>

                                        </td>


                                        <!-- ==============================
                                     SỐ ĐIỆN THOẠI
                                =============================== -->

                                        <td>

                                            <?= htmlspecialchars(
                                                $row['so_dien_thoai'] ?? ''
                                            ) ?>

                                        </td>


                                        <!-- ==============================
                                     TÀI KHOẢN
                                =============================== -->

                                        <td>

                                            <?= htmlspecialchars(
                                                $row['name'] ?? ''
                                            ) ?>

                                        </td>


                                        <!-- ==============================
                                     ĐỊA CHỈ
                                =============================== -->

                                        <td
                                            class="
                                        max-w-[140px]
                                        truncate
                                    ">

                                            <?= htmlspecialchars(
                                                $row['dia_chi'] ?? ''
                                            ) ?>

                                        </td>


                                        <!-- ==============================
                                     THANH TOÁN
                                =============================== -->

                                        <td>

                                            <?= htmlspecialchars(
                                                $row['cach_thanh_toan'] ?? ''
                                            ) ?>

                                        </td>


                                        <!-- ==============================
                                     TRẠNG THÁI
                                =============================== -->

                                        <td>

                                            <span
                                                class="
                                            inline-flex
                                            items-center
                                            px-3
                                            py-1
                                            rounded-full
                                            text-xs
                                            font-semibold
                                            whitespace-nowrap
                                            <?= $trangThaiClass ?>
                                        ">

                                                <?= $trangThaiText ?>

                                            </span>

                                        </td>


                                        <!-- ==============================
                                     GHI CHÚ
                                =============================== -->

                                        <td
                                            class="
                                        max-w-[120px]
                                        truncate
                                    ">

                                            <?= htmlspecialchars(
                                                $row['ghi_chu'] ?? ''
                                            ) ?>

                                        </td>


                                        <!-- ==============================
                                     TỔNG TIỀN
                                =============================== -->

                                        <td
                                            class="
                                        font-semibold
                                        text-green-600
                                        whitespace-nowrap
                                    ">

                                            <?= number_format(
                                                (float)($row['tong_tien'] ?? 0)
                                            ) ?> đ

                                        </td>


                                        <!-- ==============================
                                     THỜI GIAN
                                =============================== -->

                                        <td
                                            class="
                                        text-slate-500
                                        whitespace-nowrap
                                    ">

                                            <?= htmlspecialchars(
                                                $row['created_at'] ?? ''
                                            ) ?>

                                        </td>


                                        <!-- ==============================
                                     THAO TÁC
                                =============================== -->

                                        <td
                                            class="
                                        text-center
                                        whitespace-nowrap
                                    ">

                                            <?php if ($duocPhepXoa): ?>

                                                <a
                                                    href="index.php?controller=khach_hang&action=xoa&id=<?= urlencode($row['donHangId'] ?? '') ?>"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng #<?= htmlspecialchars($row['maDon'] ?? '') ?> không?')"
                                                    class="
                                                inline-flex
                                                items-center
                                                justify-center
                                                px-3
                                                py-1.5
                                                rounded-lg
                                                bg-red-50
                                                text-red-600
                                                text-xs
                                                font-medium
                                                border
                                                border-red-100
                                                hover:bg-red-100
                                                hover:text-red-700
                                                transition-all
                                                duration-200
                                            ">
                                                    Xóa
                                                </a>

                                            <?php else: ?>

                                                <span class="text-xs text-slate-400">
                                                    —
                                                </span>

                                            <?php endif; ?>

                                        </td>


                                    </tr>


                                <?php endforeach; ?>


                            <?php endif; ?>


                        </tbody>

                    </table>



                    <!-- =====================================================
                     PHÂN TRANG
                ====================================================== -->

                    <?php if (($totalPages ?? 1) > 1): ?>


                        <?php

                        /*
                     * Chỉ giữ lại controller,
                     * action và trạng thái.
                     *
                     * KHÔNG CÓ SEARCH.
                     */

                        $queryParams = [
                            'controller' => 'khach_hang',
                            'action'     => 'index'
                        ];


                        if ($trangThaiHienTai !== '') {

                            $queryParams['trang_thai_id'] =
                                $trangThaiHienTai;
                        }

                        ?>


                        <div
                            class="
                            flex
                            items-center
                            justify-between
                            px-4
                            py-4
                            border-t
                            border-slate-200
                        ">


                            <!-- THÔNG TIN TRANG -->

                            <div class="text-sm text-slate-500">

                                Trang

                                <span class="font-semibold text-slate-900">
                                    <?= $page ?>
                                </span>

                                /

                                <span class="font-semibold text-slate-900">
                                    <?= $totalPages ?>
                                </span>

                            </div>



                            <!-- NÚT PHÂN TRANG -->

                            <div class="flex items-center gap-2">


                                <!-- TRANG TRƯỚC -->

                                <?php if ($page > 1): ?>

                                    <?php
                                    $queryParams['page'] = $page - 1;
                                    ?>

                                    <a
                                        href="index.php?<?= http_build_query($queryParams) ?>"
                                        class="
                                        w-9
                                        h-9
                                        flex
                                        items-center
                                        justify-center
                                        rounded-lg
                                        border
                                        border-slate-200
                                        bg-white
                                        text-slate-600
                                        hover:bg-slate-50
                                        transition
                                    ">
                                        ←
                                    </a>

                                <?php endif; ?>



                                <!-- SỐ TRANG -->

                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>

                                    <?php
                                    $queryParams['page'] = $i;
                                    ?>

                                    <a
                                        href="index.php?<?= http_build_query($queryParams) ?>"
                                        class="
                                        w-9
                                        h-9
                                        flex
                                        items-center
                                        justify-center
                                        rounded-lg
                                        text-sm
                                        font-medium
                                        transition

                                        <?= $i == $page
                                            ? 'bg-blue-600 text-white'
                                            : 'border border-slate-200 bg-white text-slate-600 hover:bg-slate-50'
                                        ?>
                                    ">
                                        <?= $i ?>
                                    </a>

                                <?php endfor; ?>



                                <!-- TRANG SAU -->

                                <?php if ($page < $totalPages): ?>

                                    <?php
                                    $queryParams['page'] = $page + 1;
                                    ?>

                                    <a
                                        href="index.php?<?= http_build_query($queryParams) ?>"
                                        class="
                                        w-9
                                        h-9
                                        flex
                                        items-center
                                        justify-center
                                        rounded-lg
                                        border
                                        border-slate-200
                                        bg-white
                                        text-slate-600
                                        hover:bg-slate-50
                                        transition
                                    ">
                                        →
                                    </a>

                                <?php endif; ?>


                            </div>

                        </div>


                    <?php endif; ?>


                </div>

            </div>


        </main>

    </div>



    <!-- =====================================================
     TOAST
====================================================== -->

    <?php include __DIR__ . '/components/toast-init.php'; ?>


</body>

</html>