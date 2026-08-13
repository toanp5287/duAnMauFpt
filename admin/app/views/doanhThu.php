<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Báo cáo thống kê doanh thu | Hệ thống quản trị</title>
    <meta name="description" content="Trang tổng hợp báo cáo doanh thu, số lượng sản phẩm, tổng khách hàng, tổng đơn hàng và sản phẩm bán chạy nhất">
    <meta name="robots" content="noindex, nofollow">
    <link class="canonical" href="https://domaincuaban.com/index.php?controller=thong_ke">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://ireade.github.io/Toast.js/css/Toast.min.css">
    <script src="https://ireade.github.io/Toast.js/js/Toast.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#165DFF',
                        success: '#00B42A',
                        danger: '#F53F3F',
                        warning: '#FF7D00'
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style type="text/tailwindcss">
        @layer utilities {
            .content-auto {
                content-visibility: auto;
            }
            .hover-row {
                transition: all 180ms ease-out;
            }
            .table-shadow {
                box-shadow: 0 4px 20px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.06);
            }
        }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen font-sans text-gray-800">

    <?php include __DIR__ . '/sitebar.php'; ?>

    <main class="flex-1 p-4 md:p-8 w-full overflow-x-hidden">

        <header class="mb-7">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                <div>
                    <nav class="text-sm text-gray-500 mb-2">
                        <span>Trang chủ</span> / <span class="text-gray-700">Thống kê dữ liệu</span>
                    </nav>
                    <h1 class="text-[clamp(1.5rem,3vw,2.2rem)] font-bold text-gray-900">
                        Báo cáo doanh thu
                    </h1>
                    <p class="text-gray-500 mt-1">Tổng hợp và phân tích dữ liệu bán hàng tự động năm 2026</p>
                </div>
            </div>
        </header>

        <div class="bg-white rounded-2xl table-shadow overflow-hidden border border-gray-100">

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Số SP hiện có</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Số khách hàng</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Số đơn hàng</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">Tổng số tiền (VNĐ)</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">Sản phẩm bán chạy nhất</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        <tr class="hover-row border-b border-gray-50 hover:bg-blue-50/50">

                            <td class="px-6 py-4 whitespace-nowrap text-center font-bold text-gray-900 font-mono">
                                <?= $data['soSP'] ?>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center font-semibold text-gray-600 font-mono">
                                <?= $data['SOKH'] ?>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center text-gray-600 font-mono">
                                <?= $data['sodonhang'] ?>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right font-bold text-success font-mono text-base">
                                <?= number_format($data['doanhThu'], 0, ',', '.') ?> đ
                            </td>

                            <td class="px-6 py-4 text-right font-medium text-gray-900 max-w-xs truncate">
                                <span class="bg-warning/10 text-warning text-xs font-semibold px-2 py-0.5 rounded-md mr-1.5">Hot</span>
                                <?= htmlspecialchars($hotNhat['ten_san_pham']) ?>
                                (<span class="font-mono text-primary font-semibold"><?= $hotNhat['tong_da_ban'] ?></span> sp)
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </main>

</body>

</html>