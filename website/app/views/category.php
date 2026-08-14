<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Tech Store - Danh mục sản phẩm công nghệ chính hãng." />
    <title>Tech Store - Danh mục sản phẩm</title>
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body class="font-sans bg-slate-50 text-slate-700 antialiased">
    <div class="flex flex-col min-h-screen">
        <?php include __DIR__ . '/components/header.php'; ?>

        <!-- Category Banner -->
        <section class="w-full py-5 sm:py-6 lg:py-8">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                <?php $bannerMode = 'category'; include __DIR__ . '/components/banner.php'; ?>
            </div>
        </section>

        <main class="flex-1 py-8 lg:py-12">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-[240px_1fr] gap-6 lg:gap-8">
                    <?php include __DIR__ . '/components/sidebar.php'; ?>

                    <div>
                        <!-- Category Header -->
                        <div class="ds-card p-5 sm:p-6 mb-6">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                                <div class="flex items-center gap-3">
                                    <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-50 border border-blue-100">
                                        <svg class="ds-icon-brand w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </span>
                                    <div>
                                        <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Tất cả sản phẩm</h1>
                                        <p class="text-sm text-slate-500 mt-0.5">Khám phá các sản phẩm công nghệ</p>
                                    </div>
                                </div>

                                <form action="category.php" method="get" class="flex flex-col sm:flex-row gap-2 w-full lg:w-auto">
                                    <input type="hidden" name="c" value="phone" />
                                    <label for="categorySort" class="sr-only">Sắp xếp sản phẩm</label>
                                    <select id="categorySort" name="sort" class="ds-input h-10 min-w-[190px] text-sm cursor-pointer w-full sm:w-auto">
                                        <option value="popular">Sắp xếp: Phổ biến</option>
                                        <option value="priceAsc">Giá: Thấp → Cao</option>
                                        <option value="priceDesc">Giá: Cao → Thấp</option>
                                        <option value="nameAsc">Tên: A → Z</option>
                                    </select>
                                    <button type="submit" class="ds-btn-primary h-10 px-5 text-sm gap-2">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M6 12h12M10 20h4" />
                                        </svg>
                                        Lọc sản phẩm
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Product count -->
                        <div class="flex items-center justify-between mb-5">
                            <p class="text-sm text-slate-500">
                                Hiển thị <strong class="text-slate-900"><?= count($list) ?></strong> sản phẩm
                            </p>
                            <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-xs font-medium text-slate-500">
                                Sản phẩm công nghệ
                            </span>
                        </div>

                        <!-- Product Grid -->
                        <?php if (count($list) === 0) { ?>
                            <?php $emptyType = 'products'; include __DIR__ . '/components/empty-state.php'; ?>
                        <?php } else { ?>
                        <div class="relative" data-product-grid>
                            <div class="ds-skeleton-layer hidden absolute inset-0 z-10 pointer-events-none" data-skeleton-layer aria-hidden="true">
                                <?php $skeletonCount = 4; include __DIR__ . '/components/skeleton-product-grid.php'; ?>
                            </div>
                            <div id="products" class="grid grid-cols-1 min-[375px]:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5" data-product-content>
                            <?php foreach ($list as $row) {
                                include __DIR__ . '/components/product-card.php';
                            } ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </main>

        <?php include __DIR__ . '/components/footer.php'; ?>
    </div>
</body>

</html>
