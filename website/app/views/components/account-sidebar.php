<?php
/** @var string $accountActive profile | orders | password */
$accountActive = $accountActive ?? 'profile';
?>
<!-- Mobile account menu button -->
<div class="lg:hidden mb-4">
    <button type="button" id="accountDrawerBtn" class="ds-btn-secondary w-full h-10 text-sm gap-2" aria-expanded="false" aria-controls="accountDrawer">
        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
        </svg>
        Menu tài khoản
    </button>
</div>

<!-- Desktop sidebar -->
<aside class="hidden lg:block w-full lg:w-64 shrink-0">
    <div class="ds-card p-5 lg:sticky lg:top-28">
        <h2 class="text-lg font-semibold text-slate-900 mb-5 pb-3 border-b border-slate-100">Tài khoản</h2>
        <ul class="space-y-1">
            <li><a href="index.php?controller=login&action=controllerGETuser" class="block px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 <?php echo $accountActive === 'profile' ? 'bg-blue-50 text-blue-600 border border-blue-100' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50'; ?>">Thông tin cá nhân</a></li>
            <li><a href="index.php?controller=login&action=lichSu" class="block px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 <?php echo $accountActive === 'orders' ? 'bg-blue-50 text-blue-600 border border-blue-100' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50'; ?>">Lịch sử đơn hàng</a></li>
            <li><a href="index.php?controller=login&action=viuUpdatemkUser" class="block px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 <?php echo $accountActive === 'password' ? 'bg-blue-50 text-blue-600 border border-blue-100' : 'text-slate-700 hover:text-blue-600 hover:bg-slate-50'; ?>">Đổi mật khẩu</a></li>
            <li><a href="index.php?controller=san_pham&action=index" class="block px-3 py-2.5 rounded-xl text-sm font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50 transition-all duration-200">Quay lại cửa hàng</a></li>
        </ul>
    </div>
</aside>

<!-- Mobile drawer -->
<div id="accountDrawer" class="fixed inset-0 z-50 hidden lg:hidden" aria-hidden="true">
    <div id="accountDrawerOverlay" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
    <div id="accountDrawerPanel" class="absolute left-0 top-0 h-full w-[min(100%,300px)] bg-white border-r border-slate-200 shadow-md transform -translate-x-full transition-transform duration-300 flex flex-col overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200">
            <span class="font-semibold text-slate-900">Tài khoản</span>
            <button type="button" id="accountDrawerClose" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:text-blue-600" aria-label="Đóng menu">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        <nav class="flex-1 overflow-y-auto p-3 space-y-1">
            <a href="index.php?controller=login&action=controllerGETuser" class="block px-3 py-3 rounded-xl text-sm font-medium <?php echo $accountActive === 'profile' ? 'bg-blue-50 text-blue-600' : 'text-slate-700'; ?>">Thông tin cá nhân</a>
            <a href="index.php?controller=login&action=lichSu" class="block px-3 py-3 rounded-xl text-sm font-medium <?php echo $accountActive === 'orders' ? 'bg-blue-50 text-blue-600' : 'text-slate-700'; ?>">Lịch sử đơn hàng</a>
            <a href="index.php?controller=login&action=viuUpdatemkUser" class="block px-3 py-3 rounded-xl text-sm font-medium <?php echo $accountActive === 'password' ? 'bg-blue-50 text-blue-600' : 'text-slate-700'; ?>">Đổi mật khẩu</a>
            <a href="index.php?controller=san_pham&action=index" class="block px-3 py-3 rounded-xl text-sm font-medium text-slate-700">Quay lại cửa hàng</a>
        </nav>
    </div>
</div>

<script>
(function() {
    var btn = document.getElementById('accountDrawerBtn');
    var drawer = document.getElementById('accountDrawer');
    var panel = document.getElementById('accountDrawerPanel');
    var overlay = document.getElementById('accountDrawerOverlay');
    var closeBtn = document.getElementById('accountDrawerClose');
    if (!btn || !drawer || !panel) return;
    function open() {
        drawer.classList.remove('hidden');
        drawer.setAttribute('aria-hidden', 'false');
        btn.setAttribute('aria-expanded', 'true');
        document.body.classList.add('ds-drawer-open');
        requestAnimationFrame(function() { panel.classList.remove('-translate-x-full'); });
    }
    function close() {
        panel.classList.add('-translate-x-full');
        drawer.setAttribute('aria-hidden', 'true');
        btn.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('ds-drawer-open');
        setTimeout(function() { drawer.classList.add('hidden'); }, 300);
    }
    btn.addEventListener('click', open);
    if (closeBtn) closeBtn.addEventListener('click', close);
    if (overlay) overlay.addEventListener('click', close);
    drawer.querySelectorAll('a').forEach(function(a) { a.addEventListener('click', close); });
})();
</script>
