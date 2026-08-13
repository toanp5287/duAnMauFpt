    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <div class="max-w-7xl mx-auto px-5">
        <div class="flex gap-8">
            <aside class="w-72 bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-sky-500 mb-8">Tài khoản</h2>

                <ul class="space-y-3">

                    <li class="px-5 py-3 rounded-xl transition-all duration-300 hover:bg-sky-100 hover:text-sky-600 hover:translate-x-2 hover:shadow-md">
                        <a href="index.php?controller=login&action=controllerGETuser" class="block">
                            Thông tin cá nhân
                        </a>
                    </li>


                    <li class="bg-sky-500 text-white px-5 py-3 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-lg">
                        <a href="index.php?controller=login&action=lichSu" class="block">
                            Lịch sử đơn hàng
                        </a>
                    </li>

                    <li class="px-5 py-3 rounded-xl transition-all duration-300 hover:bg-sky-100 hover:text-sky-600 hover:translate-x-2 hover:shadow-md">
                        <a href="index.php?controller=login&action=viuUpdatemkUser" class="block">
                            Đổi mật khẩu
                        </a>
                    </li>

                    <li class="px-5 py-3 rounded-xl transition-all duration-300 hover:bg-sky-100 hover:text-sky-600 hover:translate-x-2 hover:shadow-md">
                        <a href="index.php?controller=san_pham&action=index" class="block">
                            Quay lại trang
                        </a>
                    </li>

                </ul>
            </aside>
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-slate-700 mb-6">
                    Lịch sử đơn hàng
                </h2>

                <div class="overflow-x-auto rounded-xl border border-slate-200">
                    <table class="min-w-full border-collapse">
                        <thead class="bg-sky-600 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Mã đơn</th>
                                <th class="px-6 py-4 text-left font-semibold">Người nhận</th>
                                <th class="px-6 py-4 text-center font-semibold">SĐT</th>

                                <th class="px-6 py-4 text-center font-semibold">Trạng thái</th>
                                <th class="px-6 py-4 text-center font-semibold">Hành động</th>
                                <th class="px-6 py-4 text-center font-semibold">Chi tiết đơn</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200 bg-white">
                            <?php foreach ($lich_su_don as $row): ?>

                                <tr class="hover:bg-sky-50 transition duration-200">

                                    <td class="px-6 py-4 font-bold text-sky-600">
                                        #<?= $row['maDon'] ?>
                                    </td>

                                    <td class="px-6 py-4">
                                        <?= $row['ten_khach_hang'] ?>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <?= $row['so_dien_thoai'] ?>
                                    </td>



                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            <?= $row['ten_trang_thai'] ?>
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">

                                        <?php if (in_array($row['trang_thai_id'], [1, 2, 3])): ?>

                                            <form action="index.php?controller=shopping_cart&action=huyDon" method="POST" class="space-y-2">
                                                <input type="hidden" name="trangThai" value="6">
                                                <input type="hidden" name="idDon" value="<?= $row['id'] ?>">

                                                <textarea
                                                    name="message"
                                                    rows="3"
                                                    placeholder="Nhập lý do hủy đơn..."
                                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 hidden reason-box"
                                                    required></textarea>

                                                <button
                                                    type="button"
                                                    class="show-reason bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                                    Hủy đơn
                                                </button>

                                                <button
                                                    type="submit"
                                                    class="submit-btn bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg text-sm font-semibold transition hidden">
                                                    Xác nhận hủy
                                                </button>
                                            </form>

                                        <?php elseif ($row['trang_thai_id'] == 5): ?>

                                            <form action="index.php?controller=shopping_cart&action=sacNhan" method="POST">
                                                <input type="hidden" name="trangThai" value="5">
                                                <input type="hidden" name="idDon" value="<?= $row['id'] ?>">

                                                <button
                                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                                    Đã nhận
                                                </button>
                                            </form>

                                        <?php elseif ($row['trang_thai_id'] == 6): ?>

                                            <div class="bg-red-50 border border-red-200 rounded-lg p-3">

                                                <form action="index.php?controller=shopping_cart&action=hoanHang" method="POST" class="mt-4">
                                                    <input type="hidden" name="trangThai" value="9">
                                                    <input type="hidden" name="idDon" value="<?= $row['id'] ?>">

                                                    <button
                                                        type="submit"
                                                        onclick="return confirm('Bạn có chắc chắn muốn gửi yêu cầu hoàn hàng?')"
                                                        class="inline-flex items-center gap-2
               bg-orange-500 hover:bg-orange-600 active:bg-orange-700
               text-white font-semibold
               px-5 py-2.5
               rounded-lg
               shadow-md hover:shadow-lg
               transition-all duration-200">
                                                        🔄 Hoàn hàng
                                                    </button>
                                                </form>
                                            </div>

                                        <?php endif; ?>

                                    </td>
                                    <td class="px-6 py-4 font-bold">
                                        <a href="index.php?controller=shopping_cart&action=chiTietDonHang&id=<?= $row['id']; ?>">
                                            <i class="fa-solid fa-eye inline-block text-green-600 hover:text-green-800 text-xl"></i>
                                        </a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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