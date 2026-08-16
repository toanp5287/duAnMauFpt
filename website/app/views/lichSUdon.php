<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Lịch sử đơn hàng | Tech Store</title>

    <?php include __DIR__ . '/components/head-resources.php'; ?>

    <style>
        /* ================================
           THANH TAB TRẠNG THÁI
        ================================= */

        .order-tabs {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        .order-tabs::-webkit-scrollbar {
            height: 5px;
        }

        .order-tabs::-webkit-scrollbar-track {
            background: transparent;
        }

        .order-tabs::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }


        /* ================================
           TAB
        ================================= */

        .order-tab {
            flex-shrink: 0;
            white-space: nowrap;
            transition: all .2s ease;
        }

        .order-tab.active {
            color: #2563eb;
            border-color: #2563eb;
            background: #eff6ff;
        }


        /* ================================
           ẨN ĐƠN
        ================================= */

        .order-row.hidden-order {
            display: none;
        }


        /* ================================
           EMPTY
        ================================= */

        .empty-order {
            display: none;
        }

        .empty-order.show {
            display: block;
        }
    </style>

</head>


<body class="font-sans bg-slate-50 text-slate-700 antialiased">

    <div class="flex flex-col min-h-screen">

        <?php include __DIR__ . '/components/header.php'; ?>


        <main class="flex-1 py-8 lg:py-10">

            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">


                    <!-- =========================================
                         SIDEBAR TÀI KHOẢN
                    ========================================== -->

                    <?php
                    $accountActive = 'orders';
                    include __DIR__ . '/components/account-sidebar.php';
                    ?>


                    <!-- =========================================
                         CONTENT
                    ========================================== -->

                    <div class="flex-1 min-w-0">


                        <div class="ds-card p-5 sm:p-8">


                            <!-- =================================
                                 HEADER
                            ================================== -->

                            <div class="mb-6">

                                <h2 class="text-xl sm:text-2xl font-bold text-slate-900">
                                    Lịch sử đơn hàng
                                </h2>

                                <p class="text-sm text-slate-500 mt-1">
                                    Theo dõi và quản lý các đơn hàng của bạn
                                </p>

                            </div>


                            <!-- =================================
                                 THANH TRẠNG THÁI
                            ================================== -->

                            <div
                                class="
                                    order-tabs
                                    flex
                                    gap-2
                                    overflow-x-auto
                                    border-b
                                    border-slate-200
                                    pb-3
                                    mb-6
                                ">


                                <!-- TẤT CẢ -->

                                <button
                                    type="button"
                                    class="
                                        order-tab
                                        active
                                        px-4
                                        py-2.5
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-white
                                        text-sm
                                        font-semibold
                                        text-slate-600
                                        hover:bg-slate-50
                                    "
                                    data-status="all">

                                    Tất cả

                                </button>


                                <!-- CHỜ XÁC NHẬN -->

                                <button
                                    type="button"
                                    class="
                                        order-tab
                                        px-4
                                        py-2.5
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-white
                                        text-sm
                                        font-semibold
                                        text-slate-600
                                        hover:bg-slate-50
                                    "
                                    data-status="1">

                                    Chờ xác nhận

                                </button>


                                <!-- ĐÃ XÁC NHẬN -->

                                <button
                                    type="button"
                                    class="
                                        order-tab
                                        px-4
                                        py-2.5
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-white
                                        text-sm
                                        font-semibold
                                        text-slate-600
                                        hover:bg-slate-50
                                    "
                                    data-status="2">

                                    Đã xác nhận

                                </button>


                                <!-- ĐANG CHUẨN BỊ -->

                                <button
                                    type="button"
                                    class="
                                        order-tab
                                        px-4
                                        py-2.5
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-white
                                        text-sm
                                        font-semibold
                                        text-slate-600
                                        hover:bg-slate-50
                                    "
                                    data-status="3">

                                    Đang chuẩn bị

                                </button>


                                <!-- ĐANG GIAO -->

                                <button
                                    type="button"
                                    class="
                                        order-tab
                                        px-4
                                        py-2.5
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-white
                                        text-sm
                                        font-semibold
                                        text-slate-600
                                        hover:bg-slate-50
                                    "
                                    data-status="4">

                                    Đang giao

                                </button>


                                <!-- GIAO THÀNH CÔNG -->

                                <button
                                    type="button"
                                    class="
                                        order-tab
                                        px-4
                                        py-2.5
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-white
                                        text-sm
                                        font-semibold
                                        text-slate-600
                                        hover:bg-slate-50
                                    "
                                    data-status="5">

                                    Giao thành công

                                </button>


                                <!-- ĐÃ HỦY -->

                                <button
                                    type="button"
                                    class="
                                        order-tab
                                        px-4
                                        py-2.5
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-white
                                        text-sm
                                        font-semibold
                                        text-slate-600
                                        hover:bg-slate-50
                                    "
                                    data-status="6">

                                    Đã hủy

                                </button>


                                <!-- YÊU CẦU HOÀN -->

                                <button
                                    type="button"
                                    class="
                                        order-tab
                                        px-4
                                        py-2.5
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-white
                                        text-sm
                                        font-semibold
                                        text-slate-600
                                        hover:bg-slate-50
                                    "
                                    data-status="9">

                                    Yêu cầu hoàn hàng

                                </button>


                                <!-- ĐÃ HOÀN -->

                                <button
                                    type="button"
                                    class="
                                        order-tab
                                        px-4
                                        py-2.5
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-white
                                        text-sm
                                        font-semibold
                                        text-slate-600
                                        hover:bg-slate-50
                                    "
                                    data-status="8">

                                    Đã hoàn hàng

                                </button>


                            </div>


                            <!-- =================================
                                 BẢNG ĐƠN HÀNG
                            ================================== -->

                            <div class="overflow-x-auto rounded-xl border border-slate-200">

                                <table class="min-w-[900px] w-full text-sm">


                                    <!-- HEADER -->

                                    <thead class="bg-slate-50 border-b border-slate-200">

                                        <tr>

                                            <th class="px-4 sm:px-6 py-3 text-left font-semibold text-slate-900">
                                                Mã đơn
                                            </th>

                                            <th class="px-4 sm:px-6 py-3 text-left font-semibold text-slate-900">
                                                Người nhận
                                            </th>

                                            <th class="px-4 sm:px-6 py-3 text-center font-semibold text-slate-900">
                                                SĐT
                                            </th>

                                            <th class="px-4 sm:px-6 py-3 text-center font-semibold text-slate-900">
                                                Thanh toán
                                            </th>

                                            <th class="px-4 sm:px-6 py-3 text-center font-semibold text-slate-900">
                                                Trạng thái
                                            </th>

                                            <th class="px-4 sm:px-6 py-3 text-center font-semibold text-slate-900">
                                                Hành động
                                            </th>

                                            <th class="px-4 sm:px-6 py-3 text-center font-semibold text-slate-900">
                                                Chi tiết
                                            </th>

                                        </tr>

                                    </thead>


                                    <!-- BODY -->

                                    <tbody
                                        id="orderTableBody"
                                        class="divide-y divide-slate-100 bg-white">


                                        <?php foreach ($lich_su_don as $row): ?>

                                            <tr
                                                class="
                                                    order-row
                                                    hover:bg-slate-50
                                                    transition
                                                    duration-200
                                                "
                                                data-status="<?= (int)$row['trang_thai_id']; ?>">


                                                <!-- MÃ ĐƠN -->

                                                <td class="px-4 sm:px-6 py-4">

                                                    <span class="font-semibold text-blue-600">

                                                        #<?= htmlspecialchars($row['maDon']) ?>

                                                    </span>

                                                </td>


                                                <!-- NGƯỜI NHẬN -->

                                                <td class="px-4 sm:px-6 py-4">

                                                    <span class="font-medium text-slate-800">

                                                        <?= htmlspecialchars($row['ten_khach_hang']) ?>

                                                    </span>

                                                </td>


                                                <!-- SĐT -->

                                                <td class="px-4 sm:px-6 py-4 text-center">

                                                    <?= htmlspecialchars($row['so_dien_thoai']) ?>

                                                </td>


                                                <!-- THANH TOÁN -->

                                                <td class="px-4 sm:px-6 py-4 text-center">

                                                    <span
                                                        class="
                                                            inline-flex
                                                            items-center
                                                            px-2.5
                                                            py-1
                                                            rounded-lg
                                                            text-xs
                                                            font-medium
                                                            bg-green-50
                                                            text-green-700
                                                            border
                                                            border-green-100
                                                        ">

                                                        <?= htmlspecialchars($row['cach_thanh_toan']) ?>

                                                    </span>

                                                </td>


                                                <!-- TRẠNG THÁI -->

                                                <td class="px-4 sm:px-6 py-4 text-center">

                                                    <?php
                                                    $statusId = (int)$row['trang_thai_id'];

                                                    $statusClass = 'bg-slate-50 text-slate-600 border-slate-200';

                                                    if ($statusId === 1) {
                                                        $statusClass = 'bg-amber-50 text-amber-700 border-amber-100';
                                                    } elseif ($statusId === 2) {
                                                        $statusClass = 'bg-blue-50 text-blue-700 border-blue-100';
                                                    } elseif ($statusId === 3) {
                                                        $statusClass = 'bg-indigo-50 text-indigo-700 border-indigo-100';
                                                    } elseif ($statusId === 4) {
                                                        $statusClass = 'bg-purple-50 text-purple-700 border-purple-100';
                                                    } elseif ($statusId === 5) {
                                                        $statusClass = 'bg-green-50 text-green-700 border-green-100';
                                                    } elseif ($statusId === 6) {
                                                        $statusClass = 'bg-red-50 text-red-700 border-red-100';
                                                    } elseif ($statusId === 9) {
                                                        $statusClass = 'bg-orange-50 text-orange-700 border-orange-100';
                                                    } elseif ($statusId === 8) {
                                                        $statusClass = 'bg-emerald-50 text-emerald-700 border-emerald-100';
                                                    }
                                                    ?>

                                                    <span
                                                        class="
                                                            inline-flex
                                                            items-center
                                                            px-2.5
                                                            py-1
                                                            rounded-lg
                                                            text-xs
                                                            font-medium
                                                            border
                                                            <?= $statusClass ?>
                                                        ">

                                                        <?= htmlspecialchars($row['ten_trang_thai']) ?>

                                                    </span>

                                                </td>


                                                <!-- HÀNH ĐỘNG -->

                                                <td
                                                    class="
                                                        px-4
                                                        sm:px-6
                                                        py-4
                                                        text-center
                                                        min-w-[150px]
                                                    ">


                                                    <!-- HỦY ĐƠN -->

                                                    <?php if (in_array($statusId, [1, 2, 3])): ?>

                                                        <form
                                                            action="index.php?controller=shopping_cart&action=huyDon"
                                                            method="POST"
                                                            class="space-y-2">

                                                            <input
                                                                type="hidden"
                                                                name="trangThai"
                                                                value="6">

                                                            <input
                                                                type="hidden"
                                                                name="idDon"
                                                                value="<?= $row['id'] ?>">

                                                            <textarea
                                                                name="message"
                                                                rows="3"
                                                                placeholder="Nhập lý do hủy đơn..."
                                                                class="
                                                                    ds-input
                                                                    w-full
                                                                    px-3
                                                                    py-2
                                                                    text-sm
                                                                    hidden
                                                                    reason-box
                                                                    min-h-[72px]
                                                                "></textarea>


                                                            <button
                                                                type="button"
                                                                class="
                                                                    show-reason
                                                                    ds-btn-danger
                                                                    px-3
                                                                    py-1.5
                                                                    text-xs
                                                                    w-full
                                                                ">

                                                                Hủy đơn

                                                            </button>


                                                            <button
                                                                type="submit"
                                                                class="
                                                                    submit-btn
                                                                    px-3
                                                                    py-1.5
                                                                    text-xs
                                                                    hidden
                                                                    w-full
                                                                    rounded-lg
                                                                    bg-red-600
                                                                    text-white
                                                                    hover:bg-red-700
                                                                ">

                                                                Xác nhận hủy

                                                            </button>

                                                        </form>


                                                        <!-- ĐÃ GIAO -->

                                                    <?php elseif ($statusId === 5): ?>

                                                        <form
                                                            action="index.php?controller=shopping_cart&action=sacNhan"
                                                            method="POST">

                                                            <input
                                                                type="hidden"
                                                                name="trangThai"
                                                                value="5">

                                                            <input
                                                                type="hidden"
                                                                name="idDon"
                                                                value="<?= $row['id'] ?>">

                                                            <button
                                                                class="
                                                                    ds-btn-success
                                                                    px-3
                                                                    py-1.5
                                                                    text-xs
                                                                    w-full
                                                                ">

                                                                Đã nhận

                                                            </button>

                                                        </form>


                                                        <!-- ĐÃ HỦY -->

                                                    <?php elseif ($statusId === 6): ?>

                                                        <form
                                                            action="index.php?controller=shopping_cart&action=hoanHang"
                                                            method="POST">

                                                            <input
                                                                type="hidden"
                                                                name="trangThai"
                                                                value="9">

                                                            <input
                                                                type="hidden"
                                                                name="idDon"
                                                                value="<?= $row['id'] ?>">

                                                            <button
                                                                type="submit"
                                                                onclick="return confirm('Bạn có chắc chắn muốn gửi yêu cầu hoàn hàng?')"
                                                                class="
                                                                    ds-btn-secondary
                                                                    px-3
                                                                    py-1.5
                                                                    text-xs
                                                                    w-full
                                                                    text-amber-700
                                                                    border-amber-200
                                                                    hover:bg-amber-50
                                                                ">

                                                                Hoàn hàng

                                                            </button>

                                                        </form>

                                                    <?php endif; ?>


                                                </td>


                                                <!-- CHI TIẾT -->

                                                <td
                                                    class="
                                                        px-4
                                                        sm:px-6
                                                        py-4
                                                        text-center
                                                    ">

                                                    <a
                                                        href="index.php?controller=shopping_cart&action=chiTietDonHang&id=<?= $row['id']; ?>"
                                                        class="
                                                            inline-flex
                                                            items-center
                                                            justify-center
                                                            px-3
                                                            py-1.5
                                                            rounded-lg
                                                            text-blue-600
                                                            bg-blue-50
                                                            hover:bg-blue-100
                                                            text-sm
                                                            font-medium
                                                        ">

                                                        Xem

                                                    </a>

                                                </td>

                                            </tr>

                                        <?php endforeach; ?>


                                    </tbody>

                                </table>


                                <!-- =================================
                                     KHÔNG CÓ ĐƠN
                                ================================== -->

                                <div
                                    id="emptyOrder"
                                    class="
                                        empty-order
                                        py-16
                                        text-center
                                        bg-white
                                    ">

                                    <div
                                        class="
                                            w-14
                                            h-14
                                            mx-auto
                                            rounded-full
                                            bg-slate-100
                                            flex
                                            items-center
                                            justify-center
                                            mb-4
                                        ">

                                        <svg
                                            class="w-7 h-7 text-slate-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M20 13V7a2 2 0 00-2-2h-3l-1-2H10L9 5H6a2 2 0 00-2 2v6m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4" />

                                        </svg>

                                    </div>


                                    <h3 class="font-semibold text-slate-800">
                                        Không có đơn hàng
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        Chưa có đơn hàng nào thuộc trạng thái này.
                                    </p>

                                </div>

                            </div>


                        </div>

                    </div>

                </div>

            </div>

        </main>


        <?php include __DIR__ . '/components/footer.php'; ?>

    </div>


    <!-- =========================================
         JAVASCRIPT
    ========================================== -->

    <script>
        /* =========================================
           LỌC ĐƠN THEO TRẠNG THÁI
        ========================================== */

        const orderTabs =
            document.querySelectorAll('.order-tab');

        const orderRows =
            document.querySelectorAll('.order-row');

        const emptyOrder =
            document.getElementById('emptyOrder');


        orderTabs.forEach(function(tab) {

            tab.addEventListener('click', function() {

                /* -----------------------------
                   XÓA ACTIVE TAB CŨ
                ----------------------------- */

                orderTabs.forEach(function(item) {

                    item.classList.remove('active');

                });


                /* -----------------------------
                   ACTIVE TAB HIỆN TẠI
                ----------------------------- */

                this.classList.add('active');


                const selectedStatus =
                    this.dataset.status;


                let visibleCount = 0;


                /* -----------------------------
                   LỌC ĐƠN
                ----------------------------- */

                orderRows.forEach(function(row) {

                    const rowStatus =
                        row.dataset.status;


                    if (
                        selectedStatus === 'all' ||
                        rowStatus === selectedStatus
                    ) {

                        row.classList.remove(
                            'hidden-order'
                        );

                        visibleCount++;

                    } else {

                        row.classList.add(
                            'hidden-order'
                        );

                    }

                });


                /* -----------------------------
                   HIỂN THỊ EMPTY
                ----------------------------- */

                if (visibleCount === 0) {

                    emptyOrder.classList.add('show');

                } else {

                    emptyOrder.classList.remove('show');

                }

            });

        });


        /* =========================================
           HỦY ĐƠN
        ========================================== */

        document
            .querySelectorAll('.show-reason')
            .forEach(function(button) {

                button.addEventListener(
                    'click',
                    function() {

                        const form =
                            this.closest('form');


                        const reasonBox =
                            form.querySelector(
                                '.reason-box'
                            );


                        const submitButton =
                            form.querySelector(
                                '.submit-btn'
                            );


                        reasonBox.classList.remove(
                            'hidden'
                        );


                        submitButton.classList.remove(
                            'hidden'
                        );


                        this.classList.add(
                            'hidden'
                        );

                    }
                );

            });


        /* =========================================
           TỰ ĐỘNG CUỘN TAB
        ========================================== */

        const activeTab =
            document.querySelector(
                '.order-tab.active'
            );


        if (activeTab) {

            activeTab.scrollIntoView({
                behavior: 'smooth',
                inline: 'center',
                block: 'nearest'
            });

        }
    </script>

</body>

</html>