<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Quản lý đánh giá | Tech Store Admin</title>

    <meta
        name="robots"
        content="noindex, nofollow">

    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>


<body>

    <div class="flex min-h-screen">

        <?php include __DIR__ . '/sitebar.php'; ?>


        <!-- =========================
             MAIN
        ========================== -->

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


            <!-- =========================
                 HEADER
            ========================== -->

            <header class="mb-6 sm:mb-8">

                <nav class="text-sm text-slate-500 mb-2">

                    <span>Trang chủ</span>

                    <span class="mx-1">/</span>

                    <span class="text-slate-700">
                        Quản lý đánh giá
                    </span>

                </nav>


                <h1
                    class="
                        text-xl
                        sm:text-2xl
                        font-bold
                        text-slate-900
                    ">

                    Quản lý đánh giá

                </h1>


                <p class="text-slate-500 mt-1 text-sm">

                    Quản lý và kiểm duyệt đánh giá của khách hàng

                </p>

            </header>


            <!-- =========================
                 THỐNG KÊ
            ========================== -->

            <?php

            $tongDanhGia = count($listDanhGia ?? []);

            $choDuyet = 0;
            $daDuyet = 0;

            foreach (($listDanhGia ?? []) as $item) {

                if ((int)($item['trang_thai_duyet'] ?? 0) === 0) {
                    $choDuyet++;
                } else {
                    $daDuyet++;
                }
            }

            ?>


            <div
                class="
                    grid
                    grid-cols-1
                    sm:grid-cols-3
                    gap-4
                    mb-6
                ">


                <!-- TỔNG -->

                <div class="adm-card p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Tổng đánh giá
                            </p>

                            <p
                                class="
                                    text-2xl
                                    font-bold
                                    text-slate-900
                                    mt-1
                                ">

                                <?= $tongDanhGia ?>

                            </p>

                        </div>


                        <div
                            class="
                                w-11
                                h-11
                                rounded-xl
                                bg-blue-50
                                text-blue-600
                                flex
                                items-center
                                justify-center
                                text-lg
                            ">

                            ★

                        </div>

                    </div>

                </div>


                <!-- CHỜ DUYỆT -->

                <div class="adm-card p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Chờ duyệt
                            </p>

                            <p
                                class="
                                    text-2xl
                                    font-bold
                                    text-orange-600
                                    mt-1
                                ">

                                <?= $choDuyet ?>

                            </p>

                        </div>


                        <div
                            class="
                                w-11
                                h-11
                                rounded-xl
                                bg-orange-50
                                text-orange-600
                                flex
                                items-center
                                justify-center
                                font-bold
                            ">

                            !

                        </div>

                    </div>

                </div>


                <!-- ĐÃ DUYỆT -->

                <div class="adm-card p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Đã duyệt
                            </p>

                            <p
                                class="
                                    text-2xl
                                    font-bold
                                    text-green-600
                                    mt-1
                                ">

                                <?= $daDuyet ?>

                            </p>

                        </div>


                        <div
                            class="
                                w-11
                                h-11
                                rounded-xl
                                bg-green-50
                                text-green-600
                                flex
                                items-center
                                justify-center
                                font-bold
                            ">

                            ✓

                        </div>

                    </div>

                </div>

            </div>


            <!-- =========================
                 BẢNG
            ========================== -->

            <div class="adm-card overflow-hidden">

                <div class="overflow-x-auto">

                    <table
                        class="
                            adm-table
                            w-full
                            min-w-[1100px]
                        ">

                        <thead>

                            <tr>

                                <th>
                                    Sản phẩm
                                </th>

                                <th>
                                    Người đánh giá
                                </th>

                                <th>
                                    Số sao
                                </th>

                                <th>
                                    Nội dung
                                </th>

                                <th>
                                    Ngày tạo
                                </th>

                                <th>
                                    Trạng thái
                                </th>

                                <th class="text-center">
                                    Hành động
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            <?php if (empty($listDanhGia)): ?>

                                <tr>

                                    <td
                                        colspan="7"
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
                                                    text-slate-400
                                                    text-xl
                                                ">

                                                ★

                                            </div>

                                            <p
                                                class="
                                                    text-sm
                                                    text-slate-400
                                                ">

                                                Chưa có đánh giá nào

                                            </p>

                                        </div>

                                    </td>

                                </tr>


                            <?php else: ?>


                                <?php foreach ($listDanhGia as $row): ?>

                                    <?php

                                    $id = (int)($row['id'] ?? 0);

                                    $trangThaiDuyet =
                                        (int)($row['trang_thai_duyet'] ?? 0);

                                    $soSao =
                                        (int)($row['so_sao'] ?? 0);

                                    ?>


                                    <tr>


                                        <!-- =========================
                                             SẢN PHẨM
                                        ========================== -->

                                        <td>

                                            <div
                                                class="
                                                    max-w-[220px]
                                                    font-medium
                                                    text-slate-900
                                                ">

                                                <?= htmlspecialchars(
                                                    $row['ten_san_pham'] ?? '—',
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>

                                            </div>

                                        </td>


                                        <!-- =========================
                                             NGƯỜI ĐÁNH GIÁ
                                        ========================== -->

                                        <td>

                                            <div
                                                class="
                                                    flex
                                                    items-center
                                                    gap-3
                                                ">

                                                <div
                                                    class="
                                                        w-9
                                                        h-9
                                                        rounded-full
                                                        bg-blue-50
                                                        text-blue-600
                                                        flex
                                                        items-center
                                                        justify-center
                                                        font-semibold
                                                        text-sm
                                                    ">

                                                    <?= mb_strtoupper(
                                                        mb_substr(
                                                            $row['ten_khach_hang'] ?? 'A',
                                                            0,
                                                            1,
                                                            'UTF-8'
                                                        ),
                                                        'UTF-8'
                                                    ) ?>

                                                </div>


                                                <div>

                                                    <p
                                                        class="
                                                            font-medium
                                                            text-slate-900
                                                        ">

                                                        <?= htmlspecialchars(
                                                            $row['ten_khach_hang']
                                                        ) ?>

                                                    </p>

                                                    <p
                                                        class="
                                                            text-xs
                                                            text-slate-400
                                                        ">

                                                        ID:
                                                        <?= $row['user_id'] ?? '—' ?>

                                                    </p>

                                                </div>

                                            </div>

                                        </td>


                                        <!-- =========================
                                             SỐ SAO
                                        ========================== -->

                                        <td>

                                            <div
                                                class="
                                                    flex
                                                    items-center
                                                    gap-1
                                                    whitespace-nowrap
                                                ">

                                                <?php for ($i = 1; $i <= 5; $i++): ?>

                                                    <span
                                                        class="
                                                            text-sm
                                                            <?= $i <= $soSao
                                                                ? 'text-yellow-400'
                                                                : 'text-slate-300'
                                                            ?>
                                                        ">

                                                        ★

                                                    </span>

                                                <?php endfor; ?>


                                                <span
                                                    class="
                                                        ml-1
                                                        text-xs
                                                        text-slate-500
                                                    ">

                                                    <?= $soSao ?>/5

                                                </span>

                                            </div>

                                        </td>


                                        <!-- =========================
                                             NỘI DUNG
                                        ========================== -->

                                        <td>

                                            <div
                                                class="
                                                    max-w-[300px]
                                                    text-sm
                                                    text-slate-600
                                                "
                                                title="<?= htmlspecialchars(
                                                            $row['noi_dung'] ?? '',
                                                            ENT_QUOTES,
                                                            'UTF-8'
                                                        ) ?>">

                                                <?= htmlspecialchars(
                                                    $row['noi_dung']
                                                        ?? 'Không có nội dung',
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>

                                            </div>

                                        </td>


                                        <!-- =========================
                                             NGÀY TẠO
                                        ========================== -->

                                        <td
                                            class="
                                                text-sm
                                                text-slate-500
                                                whitespace-nowrap
                                            ">

                                            <?= htmlspecialchars(
                                                $row['created_at'] ?? '—',
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>

                                        </td>


                                        <!-- =========================
                                             TRẠNG THÁI
                                        ========================== -->

                                        <td>

                                            <?php if ($trangThaiDuyet === 0): ?>

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        px-3
                                                        py-1
                                                        rounded-full
                                                        text-xs
                                                        font-semibold
                                                        bg-orange-100
                                                        text-orange-700
                                                    ">

                                                    Chờ duyệt

                                                </span>

                                            <?php else: ?>

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        px-3
                                                        py-1
                                                        rounded-full
                                                        text-xs
                                                        font-semibold
                                                        bg-green-100
                                                        text-green-700
                                                    ">

                                                    Đã duyệt

                                                </span>

                                            <?php endif; ?>

                                        </td>


                                        <!-- =========================
                                             HÀNH ĐỘNG
                                        ========================== -->

                                        <td class="text-center">

                                            <div
                                                class="
                                                    flex
                                                    items-center
                                                    justify-center
                                                    gap-2
                                                ">


                                                <?php if ($trangThaiDuyet === 0): ?>


                                                    <!-- 0 => DUYỆT -->

                                                    <a
                                                        href="index.php?controller=danh_gia&action=duyet&id=<?= $id ?>"
                                                        onclick="return confirm('Bạn có chắc chắn muốn duyệt đánh giá này không?')"
                                                        class="
                                                            inline-flex
                                                            items-center
                                                            justify-center
                                                            px-3
                                                            py-1.5
                                                            rounded-lg
                                                            bg-green-50
                                                            text-green-600
                                                            border
                                                            border-green-100
                                                            text-xs
                                                            font-medium
                                                            hover:bg-green-100
                                                            transition
                                                        ">

                                                        ✓ Duyệt

                                                    </a>


                                                <?php elseif ($trangThaiDuyet === 1): ?>


                                                    <!-- 1 => ẨN -->

                                                    <a
                                                        href="index.php?controller=danh_gia&action=an&id=<?= $id ?>"
                                                        onclick="return confirm('Bạn có chắc chắn muốn ẩn đánh giá này không?')"
                                                        class="
                                                            inline-flex
                                                            items-center
                                                            justify-center
                                                            px-3
                                                            py-1.5
                                                            rounded-lg
                                                            bg-slate-50
                                                            text-slate-600
                                                            border
                                                            border-slate-200
                                                            text-xs
                                                            font-medium
                                                            hover:bg-slate-100
                                                            transition
                                                        ">

                                                        Ẩn

                                                    </a>


                                                <?php endif; ?>


                                            </div>

                                        </td>


                                    </tr>


                                <?php endforeach; ?>


                            <?php endif; ?>


                        </tbody>

                    </table>

                </div>

            </div>


        </main>

    </div>


    <?php include __DIR__ . '/components/toast-init.php'; ?>

</body>

</html>