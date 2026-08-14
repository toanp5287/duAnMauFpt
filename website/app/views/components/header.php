<?php
// Tính số lượng giỏ hàng (giữ nguyên logic PHP)
$soLuongGioHang = 0;
if (isset($_SESSION['user'])) {
    require_once __DIR__ . '/../../models/model-shopping-cart.php';
    $model = new Model_shopping();
    $soLuongGioHang = $model->countCart($_SESSION['user']['id']);
}
$cartAriaLabel = 'Giỏ hàng' . ($soLuongGioHang > 0 ? ', ' . $soLuongGioHang . ' sản phẩm' : ', trống');
?>

<!-- Top bar -->
<div class="hidden sm:block bg-slate-50 border-b border-slate-200 text-xs text-slate-500">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-2 flex items-center justify-between">
        <p class="flex items-center gap-1.5">
            <svg class="ds-icon w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
            </svg>
            Miễn phí vận chuyển đơn từ 500.000₫
            <span class="text-slate-300" aria-hidden="true">·</span>
            Hotline:
            <a href="tel:19001234" class="font-semibold text-blue-600 hover:text-blue-700 transition-colors duration-200">1900 1234</a>
        </p>
        <div class="flex items-center gap-5">
            <a href="#" class="ds-nav-link text-xs">Theo dõi đơn hàng</a>
            <a href="#" class="ds-nav-link text-xs">Hệ thống cửa hàng</a>
        </div>
    </div>
</div>

<!-- Main header -->
<header class="site-header sticky top-0 z-50 bg-white border-b border-slate-200 shadow-sm">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 md:gap-4 lg:gap-6 py-3">

            <!-- Mobile hamburger -->
            <button type="button" id="mobileDrawerBtn" class="md:hidden flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 text-slate-500 hover:text-blue-600 hover:border-blue-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-100 shrink-0" aria-label="Mở menu" aria-expanded="false" aria-controls="mobileDrawer">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <!-- Logo — desktop -->
            <a href="index.php" class="hidden md:flex items-center gap-2.5 shrink-0 group">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white group-hover:border-blue-600 transition-all duration-200">
                    <svg class="ds-icon-brand w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div class="leading-tight">
                    <span class="block text-lg font-bold text-blue-600 tracking-tight">Tech Store</span>
                    <span class="block text-[10px] font-medium text-slate-500 tracking-wide uppercase">Chính hãng · Uy tín</span>
                </div>
            </a>

            <!-- Mobile center title -->
            <a href="index.php" class="md:hidden flex-1 text-center text-lg font-bold text-blue-600 tracking-tight truncate px-2">
                TECH STORE
            </a>

            <!-- Search — desktop -->
            <div class="flex-1 max-w-2xl mx-auto hidden md:block">
                <form action="index.php" method="GET" role="search">
                    <input type="hidden" name="controller" value="san_pham">
                    <input type="hidden" name="action" value="search">
                    <div class="flex h-10 rounded-xl border border-slate-200 bg-white overflow-hidden">
                        <label for="headerSearch" class="sr-only">Tìm kiếm sản phẩm</label>
                        <input
                            id="headerSearch"
                            name="name"
                            type="search"
                            placeholder="Nhập tên sản phẩm, thương hiệu cần tìm..."
                            class="ds-input flex-1 h-10 px-4 text-sm border-0 rounded-none focus:ring-0" />
                        <button type="submit" class="ds-btn-primary h-10 px-5 rounded-none rounded-r-xl text-sm whitespace-nowrap" aria-label="Tìm kiếm sản phẩm">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                                Tìm kiếm
                            </span>
                        </button>
                    </div>
                    <?php $navMode = 'quick'; include __DIR__ . '/navigation.php'; ?>
                </form>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-0.5 sm:gap-1 shrink-0 md:ml-auto">

                <!-- Cart -->
                <a href="index.php?controller=shopping_cart&action=index" class="ds-header-action group focus:outline-none focus:ring-2 focus:ring-blue-100 rounded-xl" aria-label="<?php echo htmlspecialchars($cartAriaLabel); ?>">
                    <div class="relative">
                        <svg class="ds-icon group-hover:text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                        </svg>
                        <span id="cartBadge" class="absolute -top-1.5 -right-1.5 min-w-[16px] h-4 flex items-center justify-center rounded-full bg-blue-600 text-white text-[10px] font-semibold px-0.5" aria-hidden="true"><?php echo $soLuongGioHang; ?></span>
                    </div>
                    <span class="text-[10px] font-medium mt-0.5 hidden sm:block">Giỏ hàng</span>
                </a>

                <!-- Hotline -->
                <a href="tel:19001234" class="ds-header-action hidden lg:flex group focus:outline-none focus:ring-2 focus:ring-blue-100 rounded-xl" aria-label="Gọi hotline 1900 1234">
                    <svg class="ds-icon group-hover:text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                    </svg>
                    <span class="text-[10px] font-medium mt-0.5">Hotline</span>
                </a>

                <!-- User / Login — desktop & tablet -->
                <?php if (isset($_SESSION['user'])) { ?>
                    <a href="index.php?controller=login&action=controllerGETuser" class="ds-header-action hidden md:flex group focus:outline-none focus:ring-2 focus:ring-blue-100 rounded-xl" aria-label="Tài khoản của <?php echo htmlspecialchars($_SESSION['user']['name']); ?>">
                        <svg class="ds-icon group-hover:text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <span class="text-[10px] font-medium mt-0.5 max-w-[64px] truncate"><?php echo htmlspecialchars($_SESSION['user']['name']); ?></span>
                    </a>
                    <?php if ($_SESSION['user']['role'] == 1) { ?>
                        <a href="/web-ban-hang/admin/" class="ds-header-action hidden lg:flex group focus:outline-none focus:ring-2 focus:ring-blue-100 rounded-xl" aria-label="Quản trị">
                            <svg class="ds-icon-brand group-hover:text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-[10px] font-medium mt-0.5 text-blue-600">Admin</span>
                        </a>
                    <?php } ?>
                    <a href="index.php?controller=login&action=logout" onclick="return confirm('Bạn muốn đăng xuất?')" class="ds-header-action hidden md:flex group focus:outline-none focus:ring-2 focus:ring-blue-100 rounded-xl" aria-label="Đăng xuất">
                        <svg class="ds-icon group-hover:text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="text-[10px] font-medium mt-0.5">Đăng xuất</span>
                    </a>
                <?php } else { ?>
                    <a href="index.php?controller=login&action=index" class="ds-header-action hidden md:flex group focus:outline-none focus:ring-2 focus:ring-blue-100 rounded-xl" aria-label="Đăng nhập">
                        <svg class="ds-icon group-hover:text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <span class="text-[10px] font-medium mt-0.5 hidden sm:block">Đăng nhập</span>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</header>

<?php include __DIR__ . '/mobile-drawer.php'; ?>

<script>
    (function() {
        var drawer = document.getElementById('mobileDrawer');
        var panel = document.getElementById('mobileDrawerPanel');
        var overlay = document.getElementById('mobileDrawerOverlay');
        var openBtn = document.getElementById('mobileDrawerBtn');
        var closeBtn = document.getElementById('mobileDrawerClose');
        if (!drawer || !panel || !openBtn) return;

        function openDrawer() {
            drawer.classList.remove('hidden');
            drawer.setAttribute('aria-hidden', 'false');
            openBtn.setAttribute('aria-expanded', 'true');
            document.body.classList.add('ds-drawer-open');
            requestAnimationFrame(function() {
                panel.classList.remove('-translate-x-full');
            });
        }

        function closeDrawer() {
            panel.classList.add('-translate-x-full');
            drawer.setAttribute('aria-hidden', 'true');
            openBtn.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('ds-drawer-open');
            setTimeout(function() {
                drawer.classList.add('hidden');
            }, 300);
        }

        openBtn.addEventListener('click', openDrawer);
        if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
        if (overlay) overlay.addEventListener('click', closeDrawer);

        drawer.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', closeDrawer);
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !drawer.classList.contains('hidden')) {
                closeDrawer();
            }
        });
    })();
</script>
