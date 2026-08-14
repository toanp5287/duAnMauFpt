<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm | Tech Store Admin</title>
    <meta name="robots" content="noindex, nofollow">
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body>

    <div class="flex min-h-screen">

        <?php include __DIR__ . '/sitebar.php'; ?>

        <main class="flex-1 lg:ml-64 pt-14 lg:pt-0 p-4 sm:p-6 lg:p-8 w-full min-w-0">

            <!-- HEADER -->
            <header class="mb-6 sm:mb-8">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                    <div>
                        <nav class="text-sm text-slate-500 mb-2">
                            <span>Trang chủ</span>
                            /
                            <span class="text-slate-700">Quản lý sản phẩm</span>
                        </nav>

                        <h1 class="text-xl sm:text-2xl font-bold text-slate-900">
                            Danh sách sản phẩm
                        </h1>

                        <p class="text-slate-500 mt-1 text-sm">
                            Quản lý tất cả sản phẩm
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">

                        <a
                            href="index.php?controller=san_pham&action=create"
                            class="adm-btn-primary px-5 py-2.5 text-center whitespace-nowrap">
                            Thêm sản phẩm mới
                        </a>

                        <form
                            action="index.php"
                            method="GET"
                            class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">

                            <input type="hidden" name="controller" value="tour">
                            <input type="hidden" name="action" value="search">

                            <input
                                type="search"
                                name="ten_loai"
                                placeholder="Tìm tên sản phẩm..."
                                class="adm-input h-10 px-4 text-sm w-full sm:min-w-[200px]">

                            <button
                                type="submit"
                                class="adm-btn-success h-10 px-5 whitespace-nowrap">
                                Tìm
                            </button>

                        </form>

                    </div>

                </div>

            </header>


            <!-- TABLE -->
            <div class="adm-card overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="adm-table w-full min-w-[800px]">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Mô tả</th>
                                <th>Loại hàng</th>
                                <th>Hình ảnh</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (empty($product)) { ?>

                                <tr>

                                    <td
                                        colspan="8"
                                        class="py-16 text-center text-slate-400">

                                        Chưa có sản phẩm nào được tạo

                                    </td>

                                </tr>

                            <?php } ?>


                            <?php foreach ($product as $row) { ?>

                                <tr>

                                    <td class="font-medium text-slate-900 whitespace-nowrap">
                                        #<?= $row['id']; ?>
                                    </td>


                                    <td class="font-medium text-slate-900">

                                        <?= htmlspecialchars($row['ten_san_pham']); ?>

                                    </td>


                                    <td class="font-semibold text-green-600 whitespace-nowrap">

                                        <?= number_format($row['gia'], 0, ',', '.'); ?> đ

                                    </td>


                                    <td>
                                        <?= $row['so_luong']; ?>
                                    </td>


                                    <td class="max-w-[160px] truncate">

                                        <?= mb_strlen($row['mo_ta']) > 20
                                            ? mb_substr($row['mo_ta'], 0, 20) . '...'
                                            : $row['mo_ta']; ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars($row['ten_loai']); ?>

                                    </td>


                                    <td>

                                        <img
                                            src="../public/uploads/<?= htmlspecialchars($row['hinh_anh']); ?>"
                                            width="80"
                                            alt="<?= htmlspecialchars($row['ten_san_pham']); ?>"
                                            class="rounded-lg border border-slate-200 object-cover max-w-[80px]">

                                    </td>


                                    <!-- THAO TÁC -->
                                    <td class="text-center whitespace-nowrap">

                                        <!-- NÚT XEM -->
                                        <button
                                            type="button"
                                            onclick='showProduct(<?= json_encode($row, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>)'
                                            class="adm-btn-secondary px-3 py-1.5 text-xs mr-1">

                                            Xem

                                        </button>


                                        <!-- SỬA -->
                                        <a
                                            href="index.php?controller=san_pham&action=update&id=<?= $row['id']; ?>"
                                            class="adm-btn-secondary px-3 py-1.5 text-xs mr-1">

                                            Sửa

                                        </a>


                                        <!-- XÓA -->
                                        <button
                                            type="button"
                                            onclick="confirmDelete(<?= $row['id']; ?>)"
                                            class="adm-btn-danger px-3 py-1.5 text-xs">

                                            Xóa

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


    <!-- ============================= -->
    <!-- OVERLAY -->
    <!-- ============================= -->

    <div
        id="productOverlay"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40 hidden"
        onclick="closeProduct()">
    </div>


    <!-- ============================= -->
    <!-- PANEL CHI TIẾT -->
    <!-- ============================= -->

    <div
        id="productPanel"
        class="fixed top-0 right-0 h-full w-full sm:w-[480px] bg-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 overflow-y-auto">

        <!-- HEADER PANEL -->

        <div class="sticky top-0 bg-white border-b border-slate-200 px-5 py-4 flex items-center justify-between">

            <div>

                <h2 class="text-lg font-bold text-slate-900">
                    Chi tiết sản phẩm
                </h2>

                <p class="text-xs text-slate-500 mt-1">
                    Thông tin sản phẩm
                </p>

            </div>


            <button
                type="button"
                onclick="closeProduct()"
                class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-slate-100 hover:text-slate-900 transition">

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />

                </svg>

            </button>

        </div>


        <!-- CONTENT -->

        <div class="p-5">


            <!-- ẢNH -->

            <div class="bg-slate-50 rounded-2xl border border-slate-200 p-6 flex justify-center">

                <img
                    id="detailImage"
                    src=""
                    alt=""
                    class="w-full h-64 object-contain rounded-xl">

            </div>


            <!-- TÊN -->

            <div class="mt-5">

                <p class="text-xs text-slate-500 mb-1">
                    Tên sản phẩm
                </p>

                <h3
                    id="detailName"
                    class="text-xl font-bold text-slate-900">
                </h3>

            </div>


            <!-- THÔNG TIN -->

            <div class="mt-5 grid grid-cols-2 gap-3">


                <!-- ID -->

                <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">

                    <p class="text-xs text-slate-500">
                        Mã sản phẩm
                    </p>

                    <p
                        id="detailId"
                        class="font-semibold text-slate-900 mt-1">
                    </p>

                </div>


                <!-- GIÁ -->

                <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">

                    <p class="text-xs text-slate-500">
                        Giá bán
                    </p>

                    <p
                        id="detailPrice"
                        class="font-bold text-green-600 mt-1">
                    </p>

                </div>


                <!-- SỐ LƯỢNG -->

                <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">

                    <p class="text-xs text-slate-500">
                        Số lượng
                    </p>

                    <p
                        id="detailQuantity"
                        class="font-semibold text-slate-900 mt-1">
                    </p>

                </div>


                <!-- LOẠI -->

                <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">

                    <p class="text-xs text-slate-500">
                        Loại hàng
                    </p>

                    <p
                        id="detailCategory"
                        class="font-semibold text-slate-900 mt-1">
                    </p>

                </div>

            </div>


            <!-- MÔ TẢ -->

            <div class="mt-5">

                <p class="text-xs text-slate-500 mb-2">
                    Mô tả sản phẩm
                </p>

                <div
                    id="detailDescription"
                    class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm text-slate-700 leading-6 whitespace-pre-line">
                </div>

            </div>


        </div>

    </div>


    <!-- ============================= -->
    <!-- JAVASCRIPT -->
    <!-- ============================= -->

    <script>
        function showProduct(product) {

            // ID
            document.getElementById('detailId').textContent =
                '#' + (product.id ?? '');

            // TÊN
            document.getElementById('detailName').textContent =
                product.ten_san_pham ?? 'Không có tên';

            // GIÁ
            const price = Number(product.gia ?? 0);

            document.getElementById('detailPrice').textContent =
                price.toLocaleString('vi-VN') + ' đ';

            // SỐ LƯỢNG
            document.getElementById('detailQuantity').textContent =
                product.so_luong ?? 0;

            // LOẠI
            document.getElementById('detailCategory').textContent =
                product.ten_loai ?? 'Chưa phân loại';

            // MÔ TẢ
            document.getElementById('detailDescription').innerHTML =
                product.mo_ta ?? 'Chưa có mô tả';
            // ẢNH
            const image = document.getElementById('detailImage');

            image.src =
                '../public/uploads/' + (product.hinh_anh ?? '');

            image.alt =
                product.ten_san_pham ?? 'Sản phẩm';


            // HIỆN OVERLAY
            document
                .getElementById('productOverlay')
                .classList
                .remove('hidden');


            // HIỆN PANEL
            setTimeout(() => {

                document
                    .getElementById('productPanel')
                    .classList
                    .remove('translate-x-full');

            }, 10);

        }


        function closeProduct() {

            // ĐẨY PANEL RA NGOÀI

            document
                .getElementById('productPanel')
                .classList
                .add('translate-x-full');


            // ẨN OVERLAY

            setTimeout(() => {

                document
                    .getElementById('productOverlay')
                    .classList
                    .add('hidden');

            }, 300);

        }


        // NHẤN ESC ĐỂ ĐÓNG

        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {

                closeProduct();

            }

        });


        // XÓA SẢN PHẨM

        function confirmDelete(productId) {

            if (
                confirm(
                    'Bạn chắc chắn muốn xóa sản phẩm này? Hành động không thể hoàn tác!'
                )
            ) {

                window.location.href =
                    `index.php?controller=san_pham&action=delete&id=${productId}`;

            }

        }
    </script>


    <?php include __DIR__ . '/components/toast-init.php'; ?>

</body>

</html>