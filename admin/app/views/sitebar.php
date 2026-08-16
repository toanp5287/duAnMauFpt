<?php
$admCtrl = $_GET['controller'] ?? '';
$admAction = $_GET['action'] ?? '';

if (!function_exists('admNavClass')) {
    function admNavClass(array $controllers, ?array $actions = null): string
    {
        global $admCtrl, $admAction;
        $match = in_array($admCtrl, $controllers, true);
        if ($actions !== null) {
            $match = $match && in_array($admAction, $actions, true);
        }
        return $match ? 'adm-nav-link-active' : 'adm-nav-link';
    }
}

$navItems = [
    ['href' => 'index.php?controller=san_pham&action=index', 'label' => 'Danh sách sản phẩm', 'icon' => 'product', 'controllers' => ['san_pham']],
    ['href' => 'index.php?controller=loai_hang&action=index', 'label' => 'Danh mục loại hàng', 'icon' => 'category', 'controllers' => ['loai_hang']],
    ['href' => 'index.php?controller=khach_hang&action=index', 'label' => 'Đơn hàng', 'icon' => 'order', 'controllers' => ['khach_hang']],
    ['href' => 'index.php?controller=user&action=index', 'label' => 'Users', 'icon' => 'detail', 'controllers' => ['order_detail'], 'actions' => ['index', 'search']],
    ['href' => 'index.php?controller=order_detail&action=thongKe', 'label' => 'Thống kê doanh thu', 'icon' => 'stats', 'controllers' => ['order_detail'], 'actions' => ['thongKe']],

];
?>

<!-- Mobile top bar -->
<div class="lg:hidden fixed top-0 left-0 right-0 z-50 h-14 bg-white border-b border-slate-200 flex items-center px-4 gap-3">
    <button type="button" id="adminDrawerBtn" class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 text-slate-500 hover:text-blue-600 hover:border-blue-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-100" aria-label="Mở menu" aria-expanded="false" aria-controls="adminDrawer">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
    <span class="text-base font-bold text-blue-600 truncate">Tech Store Admin</span>
</div>

<!-- Desktop sidebar -->
<aside class="hidden lg:flex flex-col fixed inset-y-0 left-0 w-64 bg-white border-r border-slate-200 z-40">
    <div class="px-5 py-5 border-b border-slate-200">
        <a href="index.php?controller=san_pham&action=index" class="flex items-center gap-2.5 group">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 group-hover:border-blue-600 transition-all duration-200">
                <svg class="w-5 h-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div class="leading-tight">
                <span class="block text-sm font-bold text-blue-600">Tech Store</span>
                <span class="block text-[10px] font-medium text-slate-500 uppercase tracking-wide">Admin Panel</span>
            </div>
        </a>
    </div>

    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5" aria-label="Menu quản trị">
        <?php foreach ($navItems as $item) {
            $class = admNavClass($item['controllers'], $item['actions'] ?? null);
        ?>
            <a href="<?php echo $item['href']; ?>" class="<?php echo $class; ?>">
                <?php if ($item['icon'] === 'product') : ?>
                    <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                <?php elseif ($item['icon'] === 'category') : ?>
                    <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                    </svg>
                <?php elseif ($item['icon'] === 'order') : ?>
                    <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                    </svg>
                <?php elseif ($item['icon'] === 'stats') : ?>
                    <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                <?php else : ?>
                    <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                <?php endif; ?>
                <?php echo $item['label']; ?>
            </a>
        <?php } ?>
    </nav>

    <!-- Thùng rác -->
    <!-- Thùng rác -->
    <div class="p-3 border-t border-slate-200">

        <button
            type="button"
            id="openTrashBtn"

            class="adm-nav-link w-full text-red-600 hover:text-red-700 hover:bg-red-50">

            <svg
                class="w-5 h-5 shrink-0"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 6h18M8 6V4a1 1 0 011-1h6a1 1 0 011 1v2m2 0v14a1 1 0 01-1 1H7a1 1 0 01-1-1V6h12z" />

            </svg>

            <span>Thùng rác</span>
            <span
                class="ml-auto min-w-6 h-6 px-2
           flex items-center justify-center
           rounded-full text-xs font-bold
           <?= !empty($listProductDelete)
                ? 'bg-red-100 text-red-600'
                : 'bg-slate-100 text-slate-400' ?>">

                <?= count($listProductDelete) ?>

            </span>
        </button>
    </div>

    <!-- Đăng xuất -->
    <div class="p-3 border-t border-slate-200">
        <a href="index.php?controller=auth&action=logout"
            onclick="return confirm('Bạn muốn đăng xuất?')"
            class="adm-nav-link text-red-600 hover:text-red-700 hover:bg-red-50">

            <svg class="w-5 h-5 shrink-0"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                aria-hidden="true">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>

            Đăng xuất
        </a>
    </div>


</aside>

<!-- Mobile drawer -->
<div id="adminDrawer" class="fixed inset-0 z-[60] hidden lg:hidden" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Menu quản trị">
    <div id="adminDrawerOverlay" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
    <div id="adminDrawerPanel" class="absolute left-0 top-0 h-full w-[min(100%,320px)] max-w-full bg-white border-r border-slate-200 shadow-md transform -translate-x-full transition-transform duration-300 flex flex-col overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 shrink-0">
            <span class="text-base font-bold text-blue-600">Tech Store Admin</span>
            <button type="button" id="adminDrawerClose" class="w-9 h-9 flex items-center justify-center rounded-lg text-slate-500 hover:text-blue-600 hover:bg-slate-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-100" aria-label="Đóng menu">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">
            <?php foreach ($navItems as $item) {
                $class = admNavClass($item['controllers'], $item['actions'] ?? null);
            ?>
                <a href="<?php echo $item['href']; ?>" class="<?php echo $class; ?>"><?php echo $item['label']; ?></a>
            <?php } ?>
            <div class="border-t border-slate-100 my-3"></div>
            <a href="index.php?controller=auth&action=logout" onclick="return confirm('Bạn muốn đăng xuất?')" class="adm-nav-link text-red-600 hover:bg-red-50">Đăng xuất</a>
        </nav>
    </div>
</div>

<!-- =========================================================
     THÙNG RÁC - DRAWER
========================================================= -->

<div
    id="trashDrawer"
    class="fixed inset-0 z-[100] hidden">

    <!-- OVERLAY -->
    <div
        id="trashOverlay"
        class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm">
    </div>


    <!-- PANEL -->
    <div
        id="trashPanel"
        class="absolute right-0 top-0 h-full
               w-[70%]
               max-lg:w-[85%]
               max-md:w-full
               bg-white shadow-2xl
               translate-x-full
               transition-transform duration-300
               flex flex-col">


        <!-- =====================================================
             HEADER
        ====================================================== -->

        <div
            class="px-6 py-5
                   border-b border-slate-200
                   flex items-center justify-between
                   shrink-0">

            <div class="flex items-center gap-3">

                <div
                    class="w-11 h-11 rounded-xl
                           bg-red-50 text-red-600
                           flex items-center justify-center">

                    <svg
                        class="w-6 h-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 6h18M8 6V4a1 1 0 011-1h6a1 1 0 011 1v2m2 0v14a1 1 0 01-1 1H7a1 1 0 01-1-1V6h12z" />

                    </svg>

                </div>


                <div>

                    <h2 class="text-xl font-bold text-slate-800">
                        Thùng rác
                    </h2>

                    <p class="text-sm text-slate-500">
                        Quản lý dữ liệu đã bị xóa
                    </p>

                </div>

            </div>


            <!-- CLOSE -->

            <button
                type="button"
                id="closeTrashBtn"
                class="w-10 h-10 rounded-xl
                       flex items-center justify-center
                       text-slate-500
                       hover:text-slate-800
                       hover:bg-slate-100
                       transition">

                <svg
                    class="w-6 h-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12" />

                </svg>

            </button>

        </div>


        <!-- =====================================================
             TABS
        ====================================================== -->

        <div
            class="px-6 pt-4
                   border-b border-slate-200
                   bg-white">

            <div class="flex gap-2 overflow-x-auto">


                <!-- TAB SẢN PHẨM -->

                <button
                    type="button"
                    onclick="switchTrashTab('products')"
                    id="trashTabProducts"
                    class="trash-tab active">

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3.75 7.5h16.5M6 3.75h12A1.5 1.5 0 0119.5 5.25v13.5A1.5 1.5 0 0118 20.25H6a1.5 1.5 0 01-1.5-1.5V5.25A1.5 1.5 0 016 3.75z" />

                    </svg>

                    Sản phẩm

                    <span
                        class="ml-1 px-2 py-0.5
                               rounded-full
                               bg-red-50 text-red-600
                               text-[11px] font-bold">

                        <?= count($listProductDelete) ?>

                    </span>

                </button>


                <!-- TAB TÀI KHOẢN -->

                <!-- TAB TÀI KHOẢN -->
                <button
                    type="button"
                    onclick="switchTrashTab('users')"
                    id="trashTabUsers"
                    class="trash-tab">

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />

                    </svg>

                    Tài khoản

                    <span
                        class="ml-1 px-2 py-0.5
               rounded-full
               bg-red-50 text-red-600
               text-[11px] font-bold">

                        <?= count($userXoaMen ?? []) ?>

                    </span>

                </button>


                <!-- TAB LOẠI HÀNG -->

                <!-- <button
                    type="button"
                    onclick="switchTrashTab('categories')"
                    id="trashTabCategories"
                    class="trash-tab">

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />

                    </svg>

                    Loại hàng

                    <span
                        class="ml-1 px-2 py-0.5
                               rounded-full
                               bg-slate-100 text-slate-500
                               text-[11px] font-bold">

                        0

                    </span>

                </button> -->

            </div>

        </div>


        <!-- =====================================================
             TOOLBAR
        ====================================================== -->

        <!-- =====================================================
     TOOLBAR
====================================================== -->

        <div
            class="px-6 py-4
           bg-slate-50
           border-b border-slate-200
           flex items-center justify-between
           gap-4">

            <div>

                <span
                    id="trashCount"
                    class="font-bold text-slate-800">

                    <?= count($listProductDelete) ?>

                </span>

                <span
                    id="trashCountText"
                    class="text-sm text-slate-500">

                    sản phẩm trong thùng rác

                </span>

            </div>


            <!-- ================================================
         NÚT XÓA TẤT CẢ - SẢN PHẨM
    ================================================= -->

            <button
                type="button"
                id="deleteAllProductTrashBtn"
                class="px-4 py-2.5
               rounded-xl
               bg-red-50
               text-red-600
               hover:bg-red-100
               text-sm font-semibold
               transition">

                Xóa tất cả sản phẩm

            </button>


            <!-- ================================================
         NÚT XÓA TẤT CẢ - TÀI KHOẢN
    ================================================= -->

            <button
                type="button"
                id="deleteAllUserTrashBtn"
                class="hidden
               px-4 py-2.5
               rounded-xl
               bg-red-50
               text-red-600
               hover:bg-red-100
               text-sm font-semibold
               transition">

                Xóa tất cả tài khoản

            </button>

        </div>


        <!-- =====================================================
             CONTENT
        ====================================================== -->

        <div
            class="flex-1 overflow-y-auto p-6">


            <!-- =================================================
                 TAB 1: SẢN PHẨM
            ================================================== -->

            <div
                id="trashProducts"
                class="trash-content">

                <div class="space-y-4">


                    <?php if (empty($listProductDelete)): ?>

                        <div
                            class="py-20
                                   flex flex-col
                                   items-center
                                   justify-center
                                   text-center">

                            <div
                                class="w-16 h-16
                                       rounded-2xl
                                       bg-slate-100
                                       flex items-center
                                       justify-center
                                       mb-4">

                                <svg
                                    class="w-8 h-8 text-slate-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M3 6h18M8 6V4a1 1 0 011-1h6a1 1 0 011 1v2m2 0v14a1 1 0 01-1 1H7a1 1 0 01-1-1V6h12z" />

                                </svg>

                            </div>

                            <h3
                                class="font-semibold text-slate-700">

                                Thùng rác trống

                            </h3>

                            <p
                                class="text-sm text-slate-400 mt-1">

                                Không có sản phẩm nào bị xóa.

                            </p>

                        </div>

                    <?php else: ?>


                        <?php foreach ($listProductDelete as $item): ?>

                            <div
                                class="border border-slate-200
                                       rounded-2xl
                                       p-4
                                       hover:shadow-sm
                                       transition">

                                <div class="flex gap-5">


                                    <!-- IMAGE -->

                                    <div
                                        class="w-28 h-28
                                               shrink-0
                                               rounded-xl
                                               bg-slate-100
                                               overflow-hidden">

                                        <img
                                            src="/web-ban-hang/public/uploads/<?= htmlspecialchars($item['hinh_anh'] ?? '') ?>"
                                            class="w-full h-full object-cover"
                                            alt="<?= htmlspecialchars($item['ten_san_pham'] ?? '') ?>">

                                    </div>


                                    <!-- INFO -->

                                    <div
                                        class="flex-1 min-w-0">

                                        <div
                                            class="flex items-start
                                                   justify-between
                                                   gap-4">

                                            <div>

                                                <h3
                                                    class="font-bold
                                                           text-slate-800">

                                                    <?= htmlspecialchars($item['ten_san_pham'] ?? '') ?>

                                                </h3>

                                                <p
                                                    class="text-sm
                                                           text-slate-500
                                                           mt-1">

                                                    Sản phẩm

                                                </p>

                                            </div>


                                            <span
                                                class="px-2.5 py-1
                                                       rounded-full
                                                       bg-red-50
                                                       text-red-600
                                                       text-xs
                                                       font-semibold">

                                                Đã xóa

                                            </span>

                                        </div>


                                        <!-- DETAILS -->

                                        <div
                                            class="grid
                                                   grid-cols-3
                                                   gap-5
                                                   mt-5">

                                            <div>

                                                <p
                                                    class="text-xs
                                                           text-slate-400">

                                                    Giá

                                                </p>

                                                <p
                                                    class="font-bold
                                                           text-slate-800">

                                                    <?= number_format(
                                                        (float)($item['gia'] ?? 0),
                                                        0,
                                                        ',',
                                                        '.'
                                                    ) ?> ₫

                                                </p>

                                            </div>


                                            <div>

                                                <p
                                                    class="text-xs
                                                           text-slate-400">

                                                    Số lượng

                                                </p>

                                                <p
                                                    class="font-semibold
                                                           text-slate-700">

                                                    <?= (int)($item['so_luong'] ?? 0) ?>

                                                </p>

                                            </div>


                                            <div>

                                                <p
                                                    class="text-xs
                                                           text-slate-400">

                                                    Mã sản phẩm

                                                </p>

                                                <p
                                                    class="font-semibold
                                                           text-slate-700">

                                                    #<?= (int)$item['id'] ?>

                                                </p>

                                            </div>

                                        </div>

                                    </div>


                                    <!-- ACTION -->

                                    <div
                                        class="flex flex-col
                                               justify-center
                                               gap-2
                                               min-w-[145px]">

                                        <button
                                            type="button"
                                            onclick="restoreProduct(<?= (int)$item['id'] ?>)"
                                            class="px-4 py-2.5
                                                   rounded-xl
                                                   bg-blue-50
                                                   text-blue-600
                                                   hover:bg-blue-100
                                                   text-sm
                                                   font-semibold">

                                            ↩ Khôi phục

                                        </button>


                                        <button
                                            type="button"
                                            onclick="deleteProduct(<?= (int)$item['id'] ?>)"
                                            class="px-4 py-2.5
                                                   rounded-xl
                                                   bg-red-50
                                                   text-red-600
                                                   hover:bg-red-100
                                                   text-sm
                                                   font-semibold">

                                            Xóa vĩnh viễn

                                        </button>

                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>

            </div>


            <!-- =================================================
                 TAB 2: TÀI KHOẢN
            ================================================== -->

            <!-- =================================================
     TAB 2: TÀI KHOẢN
================================================== -->

            <div
                id="trashUsers"
                class="trash-content hidden">

                <?php if (empty($userXoaMen)): ?>

                    <!-- EMPTY -->

                    <div
                        class="
                py-20
                flex
                flex-col
                items-center
                justify-center
                text-center
            ">

                        <div
                            class="
                    w-16
                    h-16
                    rounded-2xl
                    bg-slate-100
                    flex
                    items-center
                    justify-center
                    mb-4
                ">

                            <svg
                                class="w-8 h-8 text-slate-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M15.75 6.75a3.75 3.75 0 11-7.5 0
                           3.75 3.75 0 01-7.5 0zM4.5 20.25
                           a7.5 7.5 0 0115 0" />

                            </svg>

                        </div>

                        <h3
                            class="
                    font-semibold
                    text-slate-700
                ">

                            Thùng rác tài khoản trống

                        </h3>

                        <p
                            class="
                    text-sm
                    text-slate-400
                    mt-1
                ">

                            Không có tài khoản nào bị xóa.

                        </p>

                    </div>

                <?php else: ?>

                    <!-- USER LIST -->

                    <div class="space-y-3">

                        <?php foreach ($userXoaMen as $item): ?>

                            <div
                                class="
                        border
                        border-slate-200
                        rounded-2xl
                        p-4
                        bg-white
                        hover:shadow-sm
                        transition
                    ">

                                <div
                                    class="
                            flex
                            items-center
                            justify-between
                            gap-4
                        ">

                                    <!-- USER INFO -->

                                    <div
                                        class="
                                flex
                                items-center
                                gap-4
                                min-w-0
                            ">

                                        <!-- AVATAR -->

                                        <div
                                            class="
                                    w-12
                                    h-12
                                    shrink-0
                                    rounded-full
                                    bg-slate-900
                                    text-white
                                    flex
                                    items-center
                                    justify-center
                                    font-bold
                                    text-lg
                                ">

                                            <?= strtoupper(
                                                mb_substr(
                                                    $item['name'] ?? '?',
                                                    0,
                                                    1
                                                )
                                            ) ?>

                                        </div>


                                        <!-- INFORMATION -->

                                        <div class="min-w-0">

                                            <div
                                                class="
                                        flex
                                        items-center
                                        gap-2
                                    ">

                                                <h3
                                                    class="
                                            font-bold
                                            text-slate-800
                                            truncate
                                        ">

                                                    <?= htmlspecialchars(
                                                        $item['name'] ?? 'Không có tên'
                                                    ) ?>

                                                </h3>

                                                <span
                                                    class="
                                            px-2
                                            py-1
                                            rounded-full
                                            bg-red-50
                                            text-red-600
                                            text-[11px]
                                            font-semibold
                                            whitespace-nowrap
                                        ">

                                                    Đã xóa

                                                </span>

                                            </div>


                                            <p
                                                class="
                                        text-sm
                                        text-slate-500
                                        truncate
                                        mt-1
                                    ">

                                                <?= htmlspecialchars(
                                                    $item['email'] ?? 'Không có email'
                                                ) ?>

                                            </p>


                                            <p
                                                class="
                                        text-xs
                                        text-slate-400
                                        mt-1
                                    ">

                                                ID:
                                                #<?= (int)$item['id'] ?>

                                            </p>

                                        </div>

                                    </div>


                                    <!-- ACTION -->

                                    <div
                                        class="
                                flex
                                flex-col
                                gap-2
                                shrink-0
                            ">

                                        <!-- KHÔI PHỤC -->

                                        <a
                                            href="
                                    index.php?controller=user
                                    &action=khoiPhucUser
                                    &id=<?= (int)$item['id'] ?>
                                "
                                            onclick="
                                    return confirm(
                                        'Bạn có chắc muốn khôi phục tài khoản này?'
                                    );
                                "
                                            class="
                                    inline-flex
                                    items-center
                                    justify-center
                                    px-4
                                    py-2
                                    rounded-xl
                                    bg-blue-50
                                    text-blue-600
                                    hover:bg-blue-100
                                    text-sm
                                    font-semibold
                                    transition
                                ">

                                            ↩ Khôi phục

                                        </a>


                                        <!-- XÓA VĨNH VIỄN -->

                                        <a
                                            href="
                                    index.php?controller=user
                                    &action=xoaCung
                                    &id=<?= (int)$item['id'] ?>
                                "
                                            onclick="
                                    return confirm(
                                        'Bạn có chắc chắn muốn XÓA VĨNH VIỄN tài khoản này?\\n\\nHành động này không thể hoàn tác!'
                                    );
                                "
                                            class="
                                    inline-flex
                                    items-center
                                    justify-center
                                    px-4
                                    py-2
                                    rounded-xl
                                    bg-red-50
                                    text-red-600
                                    hover:bg-red-100
                                    text-sm
                                    font-semibold
                                    transition
                                ">

                                            🗑 Xóa vĩnh viễn

                                        </a>

                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

            </div>


            <!-- =================================================
                 TAB 3: LOẠI HÀNG
            ================================================== -->

            <div
                id="trashCategories"
                class="trash-content hidden">

                <div
                    class="py-20
                           flex flex-col
                           items-center
                           justify-center
                           text-center">

                    <div
                        class="w-16 h-16
                               rounded-2xl
                               bg-slate-100
                               flex items-center
                               justify-center
                               mb-4">

                        <svg
                            class="w-8 h-8 text-slate-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />

                        </svg>

                    </div>

                    <h3
                        class="font-semibold text-slate-700">

                        Loại hàng bị xóa

                    </h3>

                    <p
                        class="text-sm text-slate-400 mt-1">

                        Chưa có loại hàng nào trong thùng rác.

                    </p>

                </div>

            </div>


        </div>


        <!-- =====================================================
             FOOTER
        ====================================================== -->

        <div
            class="px-6 py-4
                   border-t border-slate-200
                   flex items-center justify-between
                   shrink-0">

            <p
                class="text-sm text-slate-500">

                Dữ liệu đã xóa có thể được khôi phục.

            </p>


            <button
                type="button"
                id="closeTrashBottom"
                class="px-5 py-2.5
                       rounded-xl
                       border border-slate-200
                       text-slate-700
                       hover:bg-slate-50
                       text-sm
                       font-semibold">

                Đóng

            </button>

        </div>

    </div>

</div>


<!-- =========================================================
     STYLE TAB
========================================================= -->

<style>
    .trash-tab {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        padding: 10px 14px;

        border-radius: 10px 10px 0 0;

        font-size: 14px;

        font-weight: 600;

        color: #64748b;

        white-space: nowrap;

        transition: all .2s ease;

    }

    .trash-tab:hover {

        color: #0f172a;

        background: #f8fafc;

    }

    .trash-tab.active {

        color: #dc2626;

        background: #fef2f2;

    }
</style>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>
    const trashDrawer =
        document.getElementById('trashDrawer');

    const trashPanel =
        document.getElementById('trashPanel');

    const trashOverlay =
        document.getElementById('trashOverlay');

    const openTrashBtn =
        document.getElementById('openTrashBtn');

    const closeTrashBtn =
        document.getElementById('closeTrashBtn');

    const closeTrashBottom =
        document.getElementById('closeTrashBottom');


    /* =========================================================
       OPEN
    ========================================================= */

    function openTrash() {

        if (!trashDrawer || !trashPanel) {
            return;
        }

        trashDrawer.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');

        requestAnimationFrame(function() {

            trashPanel.classList.remove(
                'translate-x-full'
            );

        });

    }


    /* =========================================================
       CLOSE
    ========================================================= */

    function closeTrash() {

        if (!trashDrawer || !trashPanel) {
            return;
        }

        trashPanel.classList.add(
            'translate-x-full'
        );

        setTimeout(function() {

            trashDrawer.classList.add('hidden');

            document.body.classList.remove(
                'overflow-hidden'
            );

        }, 300);

    }


    /* =========================================================
       OPEN BUTTON
    ========================================================= */

    if (openTrashBtn) {

        openTrashBtn.addEventListener(
            'click',
            openTrash
        );

    }


    /* =========================================================
       CLOSE BUTTON
    ========================================================= */

    if (closeTrashBtn) {

        closeTrashBtn.addEventListener(
            'click',
            closeTrash
        );

    }


    if (closeTrashBottom) {

        closeTrashBottom.addEventListener(
            'click',
            closeTrash
        );

    }


    /* =========================================================
       OVERLAY
    ========================================================= */

    if (trashOverlay) {

        trashOverlay.addEventListener(
            'click',
            closeTrash
        );

    }


    /* =========================================================
       ESC
    ========================================================= */

    document.addEventListener(
        'keydown',
        function(event) {

            if (
                event.key === 'Escape' &&
                trashDrawer &&
                !trashDrawer.classList.contains('hidden')
            ) {

                closeTrash();

            }

        }
    );


    /* =========================================================
       SWITCH TAB
    ========================================================= */

    function switchTrashTab(tab) {

        const contents = document.querySelectorAll('.trash-content');

        contents.forEach(function(content) {
            content.classList.add('hidden');
        });


        const tabs = document.querySelectorAll('.trash-tab');

        tabs.forEach(function(button) {
            button.classList.remove('active');
        });


        const deleteAllProductBtn =
            document.getElementById('deleteAllProductTrashBtn');

        const deleteAllUserBtn =
            document.getElementById('deleteAllUserTrashBtn');


        /* =====================================================
           TAB SẢN PHẨM
        ===================================================== */

        if (tab === 'products') {

            document
                .getElementById('trashProducts')
                .classList.remove('hidden');

            document
                .getElementById('trashTabProducts')
                .classList.add('active');


            document
                .getElementById('trashCount')
                .textContent =
                <?= count($listProductDelete) ?>;


            document
                .getElementById('trashCountText')
                .textContent =
                'sản phẩm trong thùng rác';


            // Hiện nút xóa tất cả sản phẩm
            if (deleteAllProductBtn) {
                deleteAllProductBtn.classList.remove('hidden');
            }


            // Ẩn nút xóa tất cả tài khoản
            if (deleteAllUserBtn) {
                deleteAllUserBtn.classList.add('hidden');
            }

        }


        /* =====================================================
           TAB TÀI KHOẢN
        ===================================================== */
        else if (tab === 'users') {

            document
                .getElementById('trashUsers')
                .classList.remove('hidden');

            document
                .getElementById('trashTabUsers')
                .classList.add('active');


            document
                .getElementById('trashCount')
                .textContent =
                <?= count($userXoaMen ?? []) ?>;


            document
                .getElementById('trashCountText')
                .textContent =
                'tài khoản trong thùng rác';


            // Ẩn nút xóa tất cả sản phẩm
            if (deleteAllProductBtn) {
                deleteAllProductBtn.classList.add('hidden');
            }


            // Hiện nút xóa tất cả tài khoản
            if (deleteAllUserBtn) {
                deleteAllUserBtn.classList.remove('hidden');
            }

        }


        /* =====================================================
           TAB LOẠI HÀNG
        ===================================================== */
        else if (tab === 'categories') {

            document
                .getElementById('trashCategories')
                .classList.remove('hidden');

            const categoryTab =
                document.getElementById('trashTabCategories');

            if (categoryTab) {
                categoryTab.classList.add('active');
            }


            document
                .getElementById('trashCount')
                .textContent = '0';


            document
                .getElementById('trashCountText')
                .textContent =
                'loại hàng trong thùng rác';


            // Ẩn cả hai nút
            if (deleteAllProductBtn) {
                deleteAllProductBtn.classList.add('hidden');
            }

            if (deleteAllUserBtn) {
                deleteAllUserBtn.classList.add('hidden');
            }

        }

    }

    /* =========================================================
       RESTORE PRODUCT
    ========================================================= */

    function restoreProduct(id) {

        if (
            !confirm(
                'Bạn có chắc muốn khôi phục sản phẩm này?'
            )
        ) {

            return;

        }


        window.location.href =
            'index.php?controller=san_pham&action=controllerRestoreProduct&id=' +
            id;

    }


    /* =========================================================
       DELETE PRODUCT FOREVER
    ========================================================= */

    function deleteProduct(id) {

        const result = confirm(

            'Bạn có chắc chắn muốn XÓA VĨNH VIỄN sản phẩm này?\n\n' +
            'Hành động này không thể hoàn tác!'

        );


        if (result) {

            window.location.href =
                'index.php?controller=san_pham&action=deleteForever&id=' +
                id;

        }

    }
    /* =========================================================
       XÓA TẤT CẢ SẢN PHẨM TRONG THÙNG RÁC
    ========================================================= */
    const deleteAllProductTrashBtn =
        document.getElementById('deleteAllProductTrashBtn');

    if (deleteAllProductTrashBtn) {
        deleteAllProductTrashBtn.addEventListener('click', function() {

            const count = <?= count($listProductDelete) ?>;

            if (count === 0) {
                alert('Thùng rác sản phẩm đang trống!');
                return;
            }

            const result = confirm(
                'Bạn có chắc chắn muốn XÓA VĨNH VIỄN tất cả sản phẩm trong thùng rác?\n\n' +
                'Có ' + count + ' sản phẩm sẽ bị xóa.\n\n' +
                '⚠ Hành động này không thể hoàn tác!'
            );

            if (!result) {
                return;
            }

            window.location.href =
                'index.php?controller=san_pham&action=deleteAllForever';
        });
    }


    /* =========================================================
       XÓA TẤT CẢ TÀI KHOẢN TRONG THÙNG RÁC
    ========================================================= */
    const deleteAllUserTrashBtn =
        document.getElementById('deleteAllUserTrashBtn');

    if (deleteAllUserTrashBtn) {
        deleteAllUserTrashBtn.addEventListener('click', function() {

            const count = <?= count($userXoaMen ?? []) ?>;

            if (count === 0) {
                alert('Thùng rác tài khoản đang trống!');
                return;
            }

            const result = confirm(
                'Bạn có chắc chắn muốn XÓA VĨNH VIỄN tất cả tài khoản trong thùng rác?\n\n' +
                'Có ' + count + ' tài khoản sẽ bị xóa.\n\n' +
                '⚠ Hành động này không thể hoàn tác!'
            );

            if (!result) {
                return;
            }

            window.location.href =
                'index.php?controller=user&action=xoaCungTatCa';
        });
    }
</script>