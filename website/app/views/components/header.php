<?php
// Tính số lượng giỏ hàng (giữ nguyên logic PHP)
$soLuongGioHang = 0;
if (isset($_SESSION['user'])) {
    require_once __DIR__ . '/../../models/model-shopping-cart.php';
    $model = new Model_shopping();
    $soLuongGioHang = $model->countCart($_SESSION['user']['id']);
}
?>

<!-- ===== TOP BAR ===== -->
<div class="hidden sm:block bg-primary-700 text-blue-100 text-xs">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-1.5 flex items-center justify-between">
        <p>🚚 Miễn phí vận chuyển đơn từ 500.000₫ &nbsp;·&nbsp; Hotline: <strong class="text-white font-bold">1900 1234</strong></p>
        <div class="flex items-center gap-5">
            <a href="#" class="hover:text-white transition-colors">Theo dõi đơn hàng</a>
            <a href="#" class="hover:text-white transition-colors">Hệ thống cửa hàng</a>
        </div>
    </div>
</div>

<!-- ===== MAIN HEADER ===== -->
<header class="site-header sticky top-0 z-50 bg-white shadow-md border-b border-ink-200">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 lg:gap-6 py-3">

            <!-- LOGO -->
            <a href="index.php" class="flex items-center gap-2 shrink-0 group">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary-500 shadow-md shadow-primary-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div class="hidden sm:block leading-tight">
                    <span class="block text-xl font-black text-ink-800 tracking-tight">Tech Store</span>
                    <span class="block text-[10px] font-semibold text-primary-500 tracking-[0.12em] uppercase">Chính hãng · Uy tín</span>
                </div>
            </a>

            <!-- SEARCH BAR (center) -->
            <div class="flex-1 max-w-2xl mx-auto hidden md:block">
                <form action="index.php" method="GET">
                    <input type="hidden" name="controller" value="san_pham">
                    <input type="hidden" name="action" value="search">
                    <div class="flex h-11 rounded-xl overflow-hidden shadow-soft border border-ink-200">
                        <input
                            name="name"
                            type="search"
                            placeholder="Nhập tên sản phẩm, thương hiệu cần tìm..."
                            class="flex-1 px-4 text-sm text-ink-800 bg-surface placeholder:text-ink-400 focus:outline-none border-0" />
                        <button type="submit" class="px-5 bg-primary-500 hover:bg-primary-700 text-white text-sm font-bold transition-colors whitespace-nowrap">
                            🔍 Tìm kiếm
                        </button>
                    </div>
                    <!-- Gợi ý filter -->
                    <div class="flex items-center gap-3 mt-1.5 flex-wrap">
                        <a href="index.php?controller=category&action=index" class="text-[11px] text-ink-500 hover:text-primary-500 transition-colors">Điện thoại</a>
                        <span class="text-ink-300 text-[10px]">·</span>
                        <a href="index.php?controller=category&action=index" class="text-[11px] text-ink-500 hover:text-primary-500 transition-colors">Laptop</a>
                        <span class="text-ink-300 text-[10px]">·</span>
                        <a href="index.php?controller=category&action=index" class="text-[11px] text-ink-500 hover:text-primary-500 transition-colors">Máy tính bảng</a>
                        <span class="text-ink-300 text-[10px]">·</span>
                        <a href="index.php?controller=category&action=index" class="text-[11px] text-ink-500 hover:text-primary-500 transition-colors">Phụ kiện</a>
                        <span class="text-ink-300 text-[10px]">·</span>
                        <a href="index.php?controller=category&action=index" class="text-[11px] text-ink-500 hover:text-primary-500 transition-colors">Tai nghe</a>
                    </div>
                </form>
            </div>

            <!-- RIGHT ACTIONS -->
            <div class="flex items-center gap-1 sm:gap-3 ml-auto shrink-0">

                <!-- Giỏ hàng -->
                <a href="index.php?controller=shopping_cart&action=index" class="relative flex flex-col items-center justify-center px-3 py-2 text-ink-700 hover:bg-ink-100 hover:text-sale rounded-xl transition-colors ">
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="group-hover:scale-110 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                        </svg>
                        <span id="cartBadge" class="absolute -top-2 -right-2 min-w-[18px] h-[18px] flex items-center justify-center rounded-full bg-cta-500 text-white text-[10px] font-black shadow"><?php echo $soLuongGioHang; ?></span>
                    </div>
                    <span class="text-[10px] font-semibold mt-0.5 hidden sm:block ">Giỏ hàng</span>
                </a>

                <!-- Hotline -->
                <a href="tel:19001234" class="hidden lg:flex flex-col items-center justify-center px-3 py-2 text-ink-600 hover:bg-ink-100 hover:text-sale rounded-xl transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                    </svg>
                    <span class="text-[10px] font-semibold mt-0.5">Hotline</span>
                </a>

                <!-- Đăng nhập / User -->
                <?php if (isset($_SESSION['user'])) { ?>
                    <div class="hidden sm:flex flex-col items-center justify-center px-3 py-2 text-ink-700 hover:bg-ink-100 hover:text-sale rounded-xl transition-colors    ">
                        <a href="index.php?controller=login&action=controllerGETuser">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <span class="text-[10px] font-semibold mt-0.5 max-w-[64px] truncate"><?php echo htmlspecialchars($_SESSION['user']['name']); ?></span></a>
                    </div>
                    <?php if ($_SESSION['user']['role'] == 1) { ?>
                        <a href="/web-ban-hang/admin/" class="hidden lg:flex flex-col items-center justify-center px-3 py-2 text-primary-500 hover:bg-primary-50 rounded-xl transition-colors" title="Quản trị">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-[10px] font-semibold mt-0.5">Admin</span>
                        </a>
                    <?php } ?>
                    <a href="index.php?controller=login&action=logout" onclick="return confirm('Bạn muốn đăng xuất?')" class="hidden sm:flex flex-col items-center justify-center px-3 py-2 text-ink-500 hover:bg-ink-100 hover:text-sale rounded-xl transition-colors" title="Đăng xuất">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="text-[10px] font-semibold mt-0.5">Đăng xuất</span>
                    </a>
                <?php } else { ?>
                    <a href="index.php?controller=login&action=index" class="flex flex-col items-center justify-center px-3 py-2 text-ink-700 hover:bg-ink-100 hover:text-sale rounded-xl transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <span class="text-[10px] font-semibold mt-0.5 hidden sm:block">Đăng nhập</span>
                    </a>
                <?php } ?>

                <!-- Mobile menu button -->
                <button type="button" id="mobileMenuBtn" class="md:hidden flex h-11 w-11 items-center justify-center rounded-xl bg-primary-500 hover:bg-primary-700 text-white transition-colors" aria-label="Menu">
                    <svg id="menuIconOpen" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg id="menuIconClose" class="hidden" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobileMenu" class="hidden md:hidden border-t border-ink-200 bg-surface">
        <div class="max-w-[1400px] mx-auto px-4 py-4 space-y-3">
            <form action="index.php" method="GET" class="flex gap-2">
                <input type="hidden" name="controller" value="san_pham">
                <input type="hidden" name="action" value="search">
                <input name="name" type="search" placeholder="Tìm kiếm sản phẩm..." class="flex-1 h-11 px-4 rounded-l-xl border border-ink-200 text-sm text-ink-800 focus:outline-none bg-white" />
                <button type="submit" class="h-11 px-4 rounded-r-xl bg-primary-500 text-white text-sm font-bold hover:bg-primary-700 transition-colors">Tìm</button>
            </form>
            <a href="index.php" class="block py-2 text-sm font-bold text-ink-800">🏠 Trang chủ</a>
            <a href="index.php?controller=category&action=index" class="block py-2 text-sm font-medium text-ink-600">📦 Danh mục sản phẩm</a>
            <?php if (isset($_SESSION['user'])) { ?>
                <a href="index.php?controller=login&action=logout" onclick="return confirm('Bạn muốn đăng xuất?')" class="block py-2 text-sm font-medium text-sale">🚪 Đăng xuất</a>
            <?php } else { ?>
                <a href="index.php?controller=login&action=index" class="block py-2 text-sm font-bold text-primary-500">👤 Đăng nhập</a>
            <?php } ?>
        </div>
    </div>
</header>

<!-- ===== BREADCRUMB & PROMOTION BAR =====
<div class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-2 flex items-center justify-between flex-wrap gap-2">
        <nav class="flex items-center gap-1.5 text-xs text-gray-500">
            <a href="index.php" class="hover:text-red-600 transition-colors flex items-center gap-1">🏠 Trang chủ</a>
            <span class="text-gray-300">›</span>
            <a href="index.php?controller=category&action=index" class="hover:text-red-600 transition-colors">Sản phẩm Công nghệ</a>
        </nav>
        <div class="text-xs font-bold text-red-600 uppercase tracking-wide">
            KHUYẾN MẠI 🎁 Combo sạc cáp khi mua điện thoại
        </div>
    </div>
</div> -->

<script>
    (function() {
        var btn = document.getElementById('mobileMenuBtn');
        var menu = document.getElementById('mobileMenu');
        var openIcon = document.getElementById('menuIconOpen');
        var closeIcon = document.getElementById('menuIconClose');
        if (!btn || !menu) return;
        btn.addEventListener('click', function() {
            menu.classList.toggle('hidden');
            openIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    })();
</script>