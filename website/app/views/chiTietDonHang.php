<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-6xl mx-auto mt-8">

    <!-- Thông tin đơn hàng -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">

        <?php
        $order = $donHang[0];
        ?>

        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                📋 Chi tiết đơn hàng
            </h2>

            <span class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full font-semibold">
                #<?= $order['maDon'] ?>
            </span>
        </div>

        <div class="grid md:grid-cols-2 gap-8">

            <!-- Khách hàng -->
            <div class="bg-gray-50 rounded-xl p-6">

                <h3 class="text-lg font-bold text-gray-700 mb-5">
                    👤 Thông tin khách hàng
                </h3>

                <div class="space-y-4">

                    <div class="flex justify-between">
                        <span class="text-gray-500">Tên khách hàng</span>
                        <span class="font-semibold">
                            <?= $order['ten_khach_hang'] ?>
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Số điện thoại</span>
                        <span class="font-semibold">
                            <?= $order['so_dien_thoai'] ?>
                        </span>
                    </div>

                    <div class="flex justify-between items-start">
                        <span class="text-gray-500">Địa chỉ</span>

                        <span class="font-semibold text-right">
                            <?= $order['dia_chi'] ?>
                        </span>
                    </div>

                </div>

            </div>

            <!-- Đơn hàng -->
            <div class="bg-gray-50 rounded-xl p-6">

                <h3 class="text-lg font-bold text-gray-700 mb-5">
                    📦 Thông tin đơn hàng
                </h3>

                <div class="space-y-4">

                    <div class="flex justify-between">
                        <span class="text-gray-500">Mã đơn</span>
                        <span class="font-semibold">
                            #<?= $order['maDon'] ?>
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Ngày đặt</span>
                        <span class="font-semibold">
                            <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?>
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Thanh toán</span>
                        <span class="font-semibold">
                            <?= $order['cach_thanh_toan'] ?>
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Trạng thái</span>

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            <?= $order['ten_trang_thai'] ?>
                        </span>
                    </div>

                    <div class="flex justify-between text-xl border-t pt-4">
                        <span class="font-bold">Tổng tiền</span>

                        <span class="font-bold text-red-600">
                            <?= number_format($order['tong_tien'], 0, ",", ".") ?> đ
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Danh sách sản phẩm -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mt-8 overflow-hidden">

        <div class="bg-gray-50 px-6 py-4 border-b">
            <h3 class="text-xl font-bold">
                🛒 Danh sách sản phẩm
            </h3>
        </div>

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>
                    <th class="px-6 py-4 text-left">Tên sản phẩm</th>
                    <th class="px-6 py-4 text-center">Đơn giá</th>
                    <th class="px-6 py-4 text-center">Số lượng</th>
                    <th class="px-6 py-4 text-right">Thành tiền</th>
                </tr>

            </thead>

            <tbody>

                <?php
                $tamTinh = 0;

                foreach ($donHang as $row):

                    $thanhTien = $row['gia'] * $row['so_luong'];
                    $tamTinh += $thanhTien;
                ?>

                    <tr class="border-b hover:bg-gray-50">



                        <td class="px-6 py-4">

                            <div class="font-semibold text-gray-800">
                                <?= $row['ten_san_pham'] ?>
                            </div>

                        </td>

                        <td class="px-6 py-4 text-center">
                            <?= number_format($row['gia'], 0, ",", ".") ?> đ
                        </td>

                        <td class="px-6 py-4 text-center">
                            <?= $row['so_luong'] ?>
                        </td>

                        <td class="px-6 py-4 text-right font-bold text-red-600">
                            <?= number_format($thanhTien, 0, ",", ".") ?> đ
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

        <!-- Tổng tiền -->
        <div class="bg-gray-50 p-6">

            <div class="flex justify-end">

                <div class="w-80 space-y-3">

                    <div class="flex justify-between">
                        <span>Tạm tính</span>

                        <span class="font-semibold">
                            <?= number_format($tamTinh, 0, ",", ".") ?> đ
                        </span>
                    </div>



                    <hr>

                    <div class="flex justify-between text-2xl font-bold">

                        <span>Tổng thanh toán</span>

                        <span class="text-red-600">
                            <?= number_format($order['tong_tien'], 0, ",", ".") ?> đ
                        </span>

                    </div>

                </div>

            </div>
            <div class="flex justify-between items-center mt-8 border-t pt-6">

                <a href="index.php?controller=login&action=lichSu"
                    class="inline-flex items-center gap-2 bg-sky-500 hover:bg-sky-600
               text-white px-6 py-3 rounded-xl font-semibold
               transition duration-300 hover:scale-105 shadow-lg">

                    <i class="fa-solid fa-arrow-left"></i>

                    Quay lại lịch sử đơn hàng

                </a>

                <div class="text-sm text-gray-500">
                    Cảm ơn bạn đã mua hàng ❤️
                </div>

            </div>
        </div>

    </div>

</div>