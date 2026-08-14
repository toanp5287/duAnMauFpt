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

    <div class="p-3 border-t border-slate-200">
        <a href="index.php?controller=auth&action=logout" onclick="return confirm('Bạn muốn đăng xuất?')" class="adm-nav-link text-red-600 hover:text-red-700 hover:bg-red-50">
            <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
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

<script>
    (function() {
        var drawer = document.getElementById('adminDrawer');
        var panel = document.getElementById('adminDrawerPanel');
        var overlay = document.getElementById('adminDrawerOverlay');
        var openBtn = document.getElementById('adminDrawerBtn');
        var closeBtn = document.getElementById('adminDrawerClose');
        if (!drawer || !panel || !openBtn) return;

        function openDrawer() {
            drawer.classList.remove('hidden');
            drawer.setAttribute('aria-hidden', 'false');
            openBtn.setAttribute('aria-expanded', 'true');
            document.body.classList.add('adm-drawer-open');
            requestAnimationFrame(function() {
                panel.classList.remove('-translate-x-full');
            });
        }

        function closeDrawer() {
            panel.classList.add('-translate-x-full');
            drawer.setAttribute('aria-hidden', 'true');
            openBtn.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('adm-drawer-open');
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
            if (e.key === 'Escape' && !drawer.classList.contains('hidden')) closeDrawer();
        });
    })();
</script>