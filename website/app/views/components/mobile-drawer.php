<!-- Mobile navigation drawer -->
<div id="mobileDrawer" class="fixed inset-0 z-[60] hidden md:hidden" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Menu điều hướng">
    <div id="mobileDrawerOverlay" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity duration-300"></div>
    <div id="mobileDrawerPanel" class="absolute left-0 top-0 h-full w-[min(100%,320px)] max-w-full bg-white border-r border-slate-200 shadow-md transform -translate-x-full transition-transform duration-300 flex flex-col overflow-hidden">
        <!-- Header -->
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 shrink-0">
            <a href="index.php" class="flex items-center gap-2 group">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 group-hover:border-blue-600 transition-all duration-200">
                    <svg class="ds-icon-brand w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-base font-bold text-blue-600">Tech Store</span>
            </a>
            <button type="button" id="mobileDrawerClose" class="w-9 h-9 flex items-center justify-center rounded-lg text-slate-500 hover:text-blue-600 hover:bg-slate-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-100" aria-label="Đóng menu">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Search -->
        <div class="px-5 py-4 border-b border-slate-100 shrink-0">
            <form action="index.php" method="GET" class="flex gap-2">
                <input type="hidden" name="controller" value="san_pham">
                <input type="hidden" name="action" value="search">
                <label for="drawerSearch" class="sr-only">Tìm kiếm sản phẩm</label>
                <input id="drawerSearch" name="name" type="search" placeholder="Tìm kiếm..." class="ds-input flex-1 h-10 px-3 text-sm" />
                <button type="submit" class="ds-btn-primary h-10 px-3 text-sm shrink-0" aria-label="Tìm kiếm">Tìm</button>
            </form>
        </div>

        <!-- Nav links -->
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5" aria-label="Menu chính">
            <a href="index.php" class="flex items-center gap-3 px-3 py-3 text-sm font-medium text-slate-900 hover:text-blue-600 hover:bg-slate-50 rounded-xl transition-all duration-200">
                <svg class="ds-icon w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Trang chủ
            </a>
            <a href="index.php?controller=category&action=index" class="flex items-center gap-3 px-3 py-3 text-sm font-medium text-slate-900 hover:text-blue-600 hover:bg-slate-50 rounded-xl transition-all duration-200">
                <svg class="ds-icon w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                </svg>
                Danh mục
            </a>
            <a href="index.php?controller=category&action=index" class="flex items-center gap-3 px-3 py-3 text-sm font-medium text-slate-900 hover:text-blue-600 hover:bg-slate-50 rounded-xl transition-all duration-200">
                <svg class="ds-icon w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                Sản phẩm
            </a>
            <a href="index.php?controller=shopping_cart&action=index" class="flex items-center gap-3 px-3 py-3 text-sm font-medium text-slate-900 hover:text-blue-600 hover:bg-slate-50 rounded-xl transition-all duration-200">
                <svg class="ds-icon w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                </svg>
                Giỏ hàng
                <?php if ($soLuongGioHang > 0) { ?>
                    <span class="ml-auto text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full"><?php echo $soLuongGioHang; ?></span>
                <?php } ?>
            </a>

            <div class="border-t border-slate-100 my-3"></div>

            <?php if (isset($_SESSION['user'])) { ?>
                <a href="index.php?controller=login&action=controllerGETuser" class="flex items-center gap-3 px-3 py-3 text-sm font-medium text-slate-900 hover:text-blue-600 hover:bg-slate-50 rounded-xl transition-all duration-200">
                    <svg class="ds-icon w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    Tài khoản
                </a>
                <?php if ($_SESSION['user']['role'] == 1) { ?>
                    <a href="/web-ban-hang/admin/" class="flex items-center gap-3 px-3 py-3 text-sm font-medium text-blue-600 hover:bg-blue-50 rounded-xl transition-all duration-200">
                        Quản trị
                    </a>
                <?php } ?>
                <a href="index.php?controller=login&action=logout" onclick="return confirm('Bạn muốn đăng xuất?')" class="flex items-center gap-3 px-3 py-3 text-sm font-medium text-red-600 hover:bg-red-50 rounded-xl transition-all duration-200">
                    <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Đăng xuất
                </a>
            <?php } else { ?>
                <a href="index.php?controller=login&action=index" class="flex items-center gap-3 px-3 py-3 text-sm font-medium text-slate-900 hover:text-blue-600 hover:bg-slate-50 rounded-xl transition-all duration-200">
                    <svg class="ds-icon w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    Đăng nhập
                </a>
            <?php } ?>
        </nav>
    </div>
</div>
