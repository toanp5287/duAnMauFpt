<?php
$payment = $payment ?? 'COD';
$order_id = $order_id ?? null;

$isVnpay = ($payment === 'VNPAY');
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= $isVnpay ? 'Thanh toán thành công' : 'Đặt hàng thành công' ?>
        | Tech Store
    </title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-50 flex items-center justify-center px-4">

    <div class="w-full max-w-lg">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl p-8 sm:p-10 text-center">

            <!-- ICON -->
            <div class="mx-auto mb-6 flex items-center justify-center w-20 h-20 rounded-full bg-green-50">

                <div class="flex items-center justify-center w-14 h-14 rounded-full bg-green-500">

                    <svg
                        class="w-8 h-8 text-white"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2.5">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 13l4 4L19 7" />

                    </svg>

                </div>

            </div>


            <!-- TIÊU ĐỀ -->

            <?php if ($isVnpay): ?>

                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">
                    Thanh toán thành công!
                </h1>

                <p class="mt-3 text-slate-500 leading-6">
                    Thanh toán qua
                    <span class="font-semibold text-blue-600">
                        VNPAY
                    </span>
                    đã được thực hiện thành công.
                </p>

            <?php else: ?>

                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">
                    Đặt hàng thành công!
                </h1>

                <p class="mt-3 text-slate-500 leading-6">
                    Cảm ơn bạn đã mua hàng tại
                    <span class="font-semibold text-blue-600">
                        Tech Store
                    </span>.
                </p>

            <?php endif; ?>


            <!-- MÃ ĐƠN HÀNG -->

            <?php if (!empty($order_id)): ?>

                <div class="mt-6 rounded-2xl bg-slate-50 border border-slate-200 p-4">

                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Mã đơn hàng
                    </p>

                    <p class="mt-1 text-lg font-bold text-slate-900">
                        #<?= htmlspecialchars($order_id) ?>
                    </p>

                </div>

            <?php endif; ?>


            <!-- THÔNG TIN THANH TOÁN -->

            <?php if ($isVnpay): ?>

                <div class="mt-6 flex items-start gap-3 text-left rounded-2xl bg-green-50 border border-green-100 p-4">

                    <svg
                        class="w-5 h-5 text-green-600 shrink-0 mt-0.5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 13l4 4L19 7" />

                    </svg>

                    <div>

                        <p class="text-sm font-semibold text-green-700">
                            Thanh toán VNPAY
                        </p>

                        <p class="text-sm text-green-600 mt-1">
                            Đơn hàng đã được thanh toán thành công.
                        </p>

                    </div>

                </div>

            <?php else: ?>

                <div class="mt-6 flex items-start gap-3 text-left rounded-2xl bg-blue-50 border border-blue-100 p-4">

                    <svg
                        class="w-5 h-5 text-blue-600 shrink-0 mt-0.5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />

                    </svg>

                    <div>

                        <p class="text-sm font-semibold text-blue-700">
                            Thanh toán khi nhận hàng (COD)
                        </p>

                        <p class="text-sm text-blue-600 mt-1">
                            Bạn sẽ thanh toán cho nhân viên giao hàng khi nhận được sản phẩm.
                        </p>

                    </div>

                </div>

            <?php endif; ?>


            <!-- BUTTON -->

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-8">

                <!-- VỀ TRANG CHỦ -->

                <a
                    href="index.php"
                    class="h-12 inline-flex items-center justify-center gap-2 rounded-xl bg-slate-100 text-slate-700 font-semibold text-sm hover:bg-slate-200 transition">

                    <svg
                        class="w-5 h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10" />

                    </svg>

                    Về trang chủ

                </a>


                <!-- XEM ĐƠN -->

                <a
                    href="index.php?controller=shopping_cart&action=chiTietDonHang&id=<?= $id_order ?>"
                    class="h-12 inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 text-white font-semibold text-sm hover:bg-blue-700 transition">

                    Xem đơn hàng

                    <svg
                        class="w-5 h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 5l7 7-7 7" />

                    </svg>

                </a>

            </div>


            <p class="mt-7 text-xs text-slate-400">
                Cảm ơn bạn đã tin tưởng và mua sắm tại Tech Store ❤️
            </p>

        </div>

    </div>

</body>

</html>