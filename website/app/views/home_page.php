<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Tech Store - Mua sắm thiết bị công nghệ chính hãng, giá tốt nhất" />
    <title>Tech Store - Trang chủ</title>
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body class="font-sans bg-slate-50 text-slate-700 antialiased">
    <div class="flex flex-col min-h-screen">
        <?php include __DIR__ . '/components/header.php'; ?>

        <main class="flex-1">
            <!-- Banner full-width -->
            <section class="w-full py-6 sm:py-8 lg:py-10">
                <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                    <?php $bannerMode = 'home'; include __DIR__ . '/components/banner.php'; ?>
                </div>
            </section>

            <!-- Danh mục nổi bật -->
            <?php if (!empty($categories)) { ?>
                <section class="py-8 sm:py-10 lg:py-12 border-t border-slate-100">
                    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
                            <div>
                                <p class="text-sm font-medium text-blue-600 mb-1">Khám phá</p>
                                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Danh mục nổi bật</h2>
                            </div>
                            <a href="index.php?controller=category&action=index" class="ds-btn-secondary h-10 px-5 text-sm w-fit">
                                Xem tất cả danh mục
                            </a>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 sm:gap-4">
                            <?php foreach ($categories as $cat) { ?>
                                <a href="index.php?controller=category&action=phan_loai&id=<?php echo $cat['id']; ?>"
                                    class="group ds-card p-4 sm:p-5 text-center hover:border-blue-600 hover:shadow-md transition-all duration-200">
                                    <div class="w-10 h-10 mx-auto mb-3 flex items-center justify-center rounded-xl bg-slate-50 border border-slate-200 group-hover:border-blue-600 group-hover:bg-blue-50 transition-all duration-200">
                                        <svg class="ds-icon-brand w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-slate-900 group-hover:text-blue-600 transition-colors duration-200 line-clamp-2">
                                        <?php echo htmlspecialchars($cat['ten_loai']); ?>
                                    </span>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </section>
            <?php } ?>

            <!-- Sản phẩm nổi bật -->
            <section class="py-8 sm:py-10 lg:py-12">
                <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
                        <div>
                            <p class="text-sm font-medium text-blue-600 mb-1"><?= !empty($isSearch) ? 'Kết quả tìm kiếm' : 'Gợi ý cho bạn' ?></p>
                            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900"><?= !empty($isSearch) ? 'Sản phẩm tìm kiếm' : 'Sản phẩm nổi bật' ?></h2>
                            <?php if (!empty($isSearch) && !empty($searchKeyword)): ?>
                                <p class="text-sm text-slate-500 mt-1">Từ khóa: "<?= htmlspecialchars($searchKeyword, ENT_QUOTES, 'UTF-8') ?>"</p>
                            <?php endif; ?>
                        </div>
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-blue-50 text-blue-600 text-sm font-medium border border-blue-100">
                            Tổng <strong class="ml-1"><?= count($productsList) ?></strong> sản phẩm
                        </span>
                    </div>

                    <?php if (empty($productsList)) { ?>
                        <?php $emptyType = 'products'; include __DIR__ . '/components/empty-state.php'; ?>
                    <?php } else { ?>
                        <div class="relative" data-product-grid>
                            <div class="ds-skeleton-layer hidden absolute inset-0 z-10 pointer-events-none" data-skeleton-layer aria-hidden="true">
                                <?php $skeletonCount = 4; include __DIR__ . '/components/skeleton-product-grid.php'; ?>
                            </div>
                            <div class="grid grid-cols-1 min-[375px]:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5" data-product-content>
                            <?php foreach ($productsList as $row) {
                                include __DIR__ . '/components/product-card.php';
                            } ?>
                        </div>
                        </div>
                    <?php } ?>
                </div>
            </section>

            <!-- Sản phẩm mới -->
            <?php
            $newProducts = !empty($productsList) ? array_slice(array_reverse($productsList), 0, min(4, count($productsList))) : [];
            if (!empty($newProducts)) { ?>
                <section class="py-8 sm:py-10 lg:py-12 bg-white border-t border-slate-100">
                    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="mb-8">
                            <p class="text-sm font-medium text-blue-600 mb-1">Mới cập nhật</p>
                            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Sản phẩm mới</h2>
                        </div>
                        <div class="grid grid-cols-1 min-[375px]:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5">
                            <?php foreach ($newProducts as $row) {
                                include __DIR__ . '/components/product-card.php';
                            } ?>
                        </div>
                    </div>
                </section>
            <?php } ?>
        </main>

        <?php include __DIR__ . '/components/footer.php'; ?>
    </div>
</body>

</html>
