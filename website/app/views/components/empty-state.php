<?php
/**
 * Empty State component — UI only
 * $emptyType: cart | products | reviews | product-not-found
 */
$emptyType = $emptyType ?? 'products';

$emptyConfigs = [
    'cart' => [
        'icon' => 'cart',
        'heading' => 'Giỏ hàng của bạn đang trống',
        'description' => 'Thêm sản phẩm yêu thích vào giỏ để tiếp tục mua sắm.',
        'buttonText' => 'Tiếp tục mua sắm',
        'buttonHref' => 'index.php',
        'buttonClass' => 'ds-btn-primary',
    ],
    'products' => [
        'icon' => 'search',
        'heading' => 'Không tìm thấy sản phẩm',
        'description' => 'Thử thay đổi từ khóa tìm kiếm hoặc bộ lọc danh mục để xem thêm sản phẩm.',
        'buttonText' => 'Quay lại danh mục',
        'buttonHref' => 'index.php?controller=category&action=index',
        'buttonClass' => 'ds-btn-primary',
    ],
    'reviews' => [
        'icon' => 'review',
        'heading' => 'Chưa có đánh giá nào',
        'description' => 'Hãy là người đầu tiên chia sẻ trải nghiệm về sản phẩm này.',
        'buttonText' => 'Gửi đánh giá của bạn',
        'buttonHref' => '#review-form',
        'buttonClass' => 'ds-btn-primary',
    ],
    'product-not-found' => [
        'icon' => 'search',
        'heading' => 'Không tìm thấy sản phẩm',
        'description' => 'Sản phẩm này không tồn tại hoặc đã bị xóa khỏi hệ thống.',
        'buttonText' => 'Về trang chủ',
        'buttonHref' => 'index.php',
        'buttonClass' => 'ds-btn-primary',
    ],
];

$config = $emptyConfigs[$emptyType] ?? $emptyConfigs['products'];
?>

<div class="ds-empty-state ds-card flex flex-col items-center justify-center py-16 sm:py-20 px-6 text-center" role="status" aria-live="polite">
    <div class="w-14 h-14 mb-5 flex items-center justify-center rounded-2xl bg-slate-50 border border-slate-200" aria-hidden="true">
        <?php if ($config['icon'] === 'cart') : ?>
            <svg class="w-7 h-7 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
            </svg>
        <?php elseif ($config['icon'] === 'review') : ?>
            <svg class="w-7 h-7 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
            </svg>
        <?php else : ?>
            <svg class="w-7 h-7 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        <?php endif; ?>
    </div>

    <h3 class="text-lg sm:text-xl font-semibold text-slate-900 mb-2"><?php echo htmlspecialchars($config['heading']); ?></h3>
    <p class="text-sm text-slate-500 max-w-md mb-8 leading-relaxed"><?php echo htmlspecialchars($config['description']); ?></p>

    <?php if ($config['buttonHref'] === '#review-form') : ?>
        <a href="<?php echo htmlspecialchars($config['buttonHref']); ?>" class="<?php echo $config['buttonClass']; ?> px-6 py-2.5 text-sm">
            <?php echo htmlspecialchars($config['buttonText']); ?>
        </a>
    <?php else : ?>
        <a href="<?php echo htmlspecialchars($config['buttonHref']); ?>" class="<?php echo $config['buttonClass']; ?> px-6 py-2.5 text-sm">
            <?php echo htmlspecialchars($config['buttonText']); ?>
        </a>
    <?php endif; ?>
</div>
