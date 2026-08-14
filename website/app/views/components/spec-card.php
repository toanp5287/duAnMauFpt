<?php
/**
 * Spec Card component — dùng tại Product Detail
 * Giữ nguyên dữ liệu từ $list_san_pham
 */
if (empty($list_san_pham)) {
    return;
}

$specItems = $specItems ?? [
    [
        'icon' => 'category',
        'title' => 'Danh mục',
        'value' => $list_san_pham['ten_loai'] ?? '—',
    ],
    [
        'icon' => 'product',
        'title' => 'Tên sản phẩm',
        'value' => $list_san_pham['ten_san_pham'] ?? '—',
    ],
    [
        'icon' => 'price',
        'title' => 'Giá bán',
        'value' => number_format($list_san_pham['gia'] ?? 0, 0, ',', '.') . ' ₫',
    ],
    [
        'icon' => 'warranty',
        'title' => 'Bảo hành',
        'value' => '12 tháng chính hãng',
    ],
    [
        'icon' => 'stock',
        'title' => 'Tình trạng',
        'value' => 'Còn hàng',
    ],
    [
        'icon' => 'brand',
        'title' => 'Thương hiệu',
        'value' => 'Tech Store',
    ],
];

if (!function_exists('dsSpecIcon')) {
    function dsSpecIcon(string $type): string
    {
        $icons = [
        'category' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />',
        'product' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />',
        'price' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
        'warranty' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />',
        'stock' => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />',
        'brand' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />',
    ];
    return $icons[$type] ?? $icons['product'];
    }
}
?>

<section class="mt-8 pt-8 border-t border-slate-200">
    <h2 class="text-lg font-semibold text-slate-900 mb-5">Thông số kỹ thuật</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-3 gap-3 sm:gap-4">
        <?php foreach ($specItems as $spec) : ?>
            <div class="flex items-start gap-3 p-4 bg-slate-50 border border-slate-200 rounded-xl">
                <div class="shrink-0 w-9 h-9 flex items-center justify-center rounded-lg bg-white border border-slate-200">
                    <svg class="ds-icon-brand w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <?php echo dsSpecIcon($spec['icon']); ?>
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-slate-500 text-sm mb-0.5"><?php echo htmlspecialchars($spec['title']); ?></p>
                    <p class="text-slate-900 font-medium text-sm break-words"><?php echo htmlspecialchars($spec['value']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
