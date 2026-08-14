<?php
/**
 * Sidebar / Filter component
 * Dùng $categories từ Controller — giữ nguyên URL và filter logic
 */
$sidebarController = $_GET['controller'] ?? '';
$sidebarAction = $_GET['action'] ?? '';
$sidebarCategoryId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if (!function_exists('dsSidebarLinkClass')) {
    function dsSidebarLinkClass(bool $isActive): string
    {
        if ($isActive) {
            return 'flex items-center justify-between px-3 py-2.5 text-sm font-medium text-blue-600 border-l-2 border-blue-600 bg-slate-50 rounded-r-lg transition-all duration-200';
        }
        return 'flex items-center justify-between px-3 py-2.5 text-sm font-medium text-slate-900 hover:text-blue-600 border-l-2 border-transparent hover:border-slate-200 rounded-r-lg transition-all duration-200 group';
    }
}
?>

<!-- Mobile: Filter button (chuẩn bị cho Drawer Lượt 5/6) -->
<div class="lg:hidden mb-4">
    <button type="button" id="filterDrawerBtn"
        class="ds-btn-secondary w-full h-10 text-sm gap-2"
        aria-expanded="false"
        aria-controls="categorySidebar">
        <svg class="ds-icon w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
        </svg>
        Bộ lọc danh mục
    </button>
</div>

<aside id="categorySidebar"
    class="hidden lg:block bg-white border border-slate-200 rounded-2xl shadow-sm p-5 lg:sticky lg:top-28 backdrop-blur-sm">
    <h3 class="text-slate-900 font-semibold text-sm mb-4 pb-3 border-b border-slate-100">
        Bộ lọc danh mục
    </h3>
    <ul class="space-y-0.5">
        <li>
            <?php $isAllActive = ($sidebarController === 'category' && $sidebarAction === 'index'); ?>
            <a href="index.php?controller=category&action=index" class="<?php echo dsSidebarLinkClass($isAllActive); ?>">
                <span class="flex items-center gap-2.5">
                    <svg class="ds-icon w-4 h-4 shrink-0 <?php echo $isAllActive ? 'text-blue-600' : ''; ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 5.25v2.25a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 013.75 12v2.25a2.25 2.25 0 002.25 2.25h2.25a2.25 2.25 0 002.25-2.25v-2.25a2.25 2.25 0 00-2.25-2.25H3.75z" />
                    </svg>
                    Tất cả sản phẩm
                </span>
            </a>
        </li>
        <?php foreach ($categories as $row) {
            $isActive = ($sidebarController === 'category' && $sidebarAction === 'phan_loai' && $sidebarCategoryId === (int) $row['id']);
        ?>
            <li>
                <a href="index.php?controller=category&action=phan_loai&id=<?php echo $row['id']; ?>"
                    class="<?php echo dsSidebarLinkClass($isActive); ?>">
                    <span class="flex items-center gap-2.5">
                        <svg class="ds-icon w-4 h-4 shrink-0 <?php echo $isActive ? 'text-blue-600' : ''; ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg>
                        <?php echo $row['ten_loai']; ?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="opacity-0 group-hover:opacity-100 text-slate-500 transition-opacity duration-200 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </li>
        <?php } ?>
    </ul>
</aside>

<!-- Mobile drawer -->
<div id="filterDrawer" class="fixed inset-0 z-50 hidden lg:hidden" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Bộ lọc danh mục">
    <div id="filterDrawerOverlay" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity duration-300"></div>
    <div id="filterDrawerPanel" class="absolute left-0 top-0 h-full w-[min(100%,320px)] max-w-full bg-white border-r border-slate-200 shadow-md transform -translate-x-full transition-transform duration-300 flex flex-col overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 shrink-0">
            <h3 class="text-slate-900 font-semibold text-sm">Bộ lọc danh mục</h3>
            <button type="button" id="filterDrawerClose" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:text-blue-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-100" aria-label="Đóng menu">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <ul class="flex-1 overflow-y-auto p-4 space-y-0.5">
            <li>
                <a href="index.php?controller=category&action=index" class="<?php echo dsSidebarLinkClass($sidebarController === 'category' && $sidebarAction === 'index'); ?>">
                    Tất cả sản phẩm
                </a>
            </li>
            <?php foreach ($categories as $row) {
                $isActive = ($sidebarController === 'category' && $sidebarAction === 'phan_loai' && $sidebarCategoryId === (int) $row['id']);
            ?>
                <li>
                    <a href="index.php?controller=category&action=phan_loai&id=<?php echo $row['id']; ?>"
                        class="<?php echo dsSidebarLinkClass($isActive); ?>">
                        <?php echo $row['ten_loai']; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

<script>
(function() {
    var btn = document.getElementById('filterDrawerBtn');
    var drawer = document.getElementById('filterDrawer');
    var panel = document.getElementById('filterDrawerPanel');
    var closeBtn = document.getElementById('filterDrawerClose');
    var overlay = document.getElementById('filterDrawerOverlay');
    if (!btn || !drawer || !panel) return;

    function openDrawer() {
        drawer.classList.remove('hidden');
        drawer.setAttribute('aria-hidden', 'false');
        btn.setAttribute('aria-expanded', 'true');
        document.body.classList.add('ds-drawer-open');
        requestAnimationFrame(function() { panel.classList.remove('-translate-x-full'); });
    }
    function closeDrawer() {
        panel.classList.add('-translate-x-full');
        drawer.setAttribute('aria-hidden', 'true');
        btn.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('ds-drawer-open');
        setTimeout(function() { drawer.classList.add('hidden'); }, 300);
    }

    btn.addEventListener('click', openDrawer);
    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    if (overlay) overlay.addEventListener('click', closeDrawer);
    drawer.querySelectorAll('a').forEach(function(link) { link.addEventListener('click', closeDrawer); });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !drawer.classList.contains('hidden')) closeDrawer();
    });
})();
</script>
