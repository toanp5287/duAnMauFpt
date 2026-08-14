<?php
/**
 * Navigation partial — UI only.
 * Set $navMode = 'quick' | 'mobile' trước khi include.
 */
$navMode = $navMode ?? 'quick';
$navController = $_GET['controller'] ?? 'san_pham';
$navAction = $_GET['action'] ?? 'index';

if (!function_exists('dsNavClass')) {
    function dsNavClass(string $controller, string $action = 'index'): string
    {
        global $navController, $navAction;
        if ($navController === $controller && $navAction === $action) {
            return 'ds-nav-link-active';
        }
        return 'ds-nav-link';
    }
}
?>

<?php if ($navMode === 'quick') : ?>
    <div class="flex items-center gap-3 mt-1.5 flex-wrap">
        <a href="index.php?controller=category&action=index" class="<?php echo dsNavClass('category', 'index'); ?> text-[11px]">Điện thoại</a>
        <span class="text-slate-300 text-[10px]">·</span>
        <a href="index.php?controller=category&action=index" class="<?php echo dsNavClass('category', 'index'); ?> text-[11px]">Laptop</a>
        <span class="text-slate-300 text-[10px]">·</span>
        <a href="index.php?controller=category&action=index" class="<?php echo dsNavClass('category', 'index'); ?> text-[11px]">Máy tính bảng</a>
        <span class="text-slate-300 text-[10px]">·</span>
        <a href="index.php?controller=category&action=index" class="<?php echo dsNavClass('category', 'index'); ?> text-[11px]">Phụ kiện</a>
        <span class="text-slate-300 text-[10px]">·</span>
        <a href="index.php?controller=category&action=index" class="<?php echo dsNavClass('category', 'index'); ?> text-[11px]">Tai nghe</a>
    </div>
<?php elseif ($navMode === 'mobile') : ?>
    <a href="index.php" class="<?php echo dsNavClass('san_pham', 'index'); ?> block py-2.5">Trang chủ</a>
    <a href="index.php?controller=category&action=index" class="<?php echo dsNavClass('category', 'index'); ?> block py-2.5">Danh mục sản phẩm</a>
    <?php if (isset($_SESSION['user'])) { ?>
        <a href="index.php?controller=login&action=controllerGETuser" class="<?php echo dsNavClass('login', 'controllerGETuser'); ?> block py-2.5">Tài khoản</a>
        <a href="index.php?controller=login&action=logout" onclick="return confirm('Bạn muốn đăng xuất?')" class="ds-btn-danger block py-2.5 !px-0">Đăng xuất</a>
    <?php } else { ?>
        <a href="index.php?controller=login&action=index" class="<?php echo dsNavClass('login', 'index'); ?> block py-2.5">Đăng nhập</a>
    <?php } ?>
<?php endif; ?>
