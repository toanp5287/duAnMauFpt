<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Tech Store - Chi tiết sản phẩm." />
    <title>Tech Store - Chi tiết sản phẩm</title>
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body class="font-sans bg-slate-50 text-slate-700 antialiased">
    <div class="flex flex-col min-h-screen">
        <?php include __DIR__ . '/components/header.php'; ?>

        <main class="flex-1 py-8 lg:py-12">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex items-center flex-wrap gap-2 text-sm text-slate-500 mb-8">
                    <a href="index.php" class="hover:text-blue-600 transition-colors duration-200">Trang chủ</a>
                    <span class="text-slate-300">/</span>
                    <a href="index.php?controller=category&action=index" class="hover:text-blue-600 transition-colors duration-200">Danh mục</a>
                    <span class="text-slate-300">/</span>
                    <span class="font-medium text-slate-900 truncate max-w-[220px] sm:max-w-none"><?php echo $list_san_pham['ten_san_pham'] ?? 'Sản phẩm'; ?></span>
                </nav>

                <?php if (!empty($errors['cart'])): ?>
                    <p class="text-sm text-red-600 mb-4" role="alert"><?= htmlspecialchars($errors['cart'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>

                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 lg:p-10 mb-12 shadow-sm product-detail-wrap">
                    <?php if (!empty($list_san_pham)) { ?>
                        <?php include __DIR__ . '/components/product-detail.php'; ?>
                    <?php } else { ?>
                        <?php $emptyType = 'product-not-found'; include __DIR__ . '/components/empty-state.php'; ?>
                    <?php } ?>
                </div>
            </div>

            <!-- Reviews -->
            <section class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 mb-16">
                <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between border-b border-slate-200 pb-5">
                    <div>
                        <p class="text-sm font-medium text-blue-600 mb-1">Đánh giá</p>
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Khách hàng nói gì</h2>
                    </div>
                    <?php if (!empty($reviews)): ?>
                        <p class="text-sm text-slate-500 mt-2 md:mt-0">Tổng cộng: <?= count($reviews) ?> đánh giá</p>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <?php $reviews = $reviews ?? []; ?>
                        <?php if (empty($reviews)): ?>
                            <?php $emptyType = 'reviews'; include __DIR__ . '/components/empty-state.php'; ?>
                        <?php else: ?>
                            <div class="grid sm:grid-cols-2 gap-4">
                                <?php foreach ($reviews as $rv): ?>
                                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-all duration-200 flex flex-col">
                                        <div class="flex items-center mb-3">
                                            <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-semibold text-sm mr-3 border border-blue-100">
                                                <?= mb_strtoupper(mb_substr($rv['name'], 0, 1, 'UTF-8'), 'UTF-8'); ?>
                                            </div>
                                            <div>
                                                <p class="font-medium text-slate-900 text-sm"><?= htmlspecialchars($rv['name']); ?></p>
                                                <div class="flex text-amber-500 text-xs mt-0.5 gap-0.5">
                                                    <?php
                                                    $stars = (int)($rv['so_sao'] ?? 5);
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        echo $i <= $stars ? '★' : '<span class="text-slate-200">★</span>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-slate-600 text-sm leading-relaxed flex-1">"<?= htmlspecialchars($rv['noi_dung']); ?>"</p>
                                        <p class="mt-4 pt-3 border-t border-slate-100 text-xs text-slate-500">
                                            SP: <?= htmlspecialchars($rv['ten_san_pham']); ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Review Form -->
                    <div class="lg:col-span-1" id="review-form">
                        <div class="ds-card p-6 lg:sticky lg:top-28">
                            <h3 class="text-base font-semibold text-slate-900 mb-4 pb-3 border-b border-slate-100">Gửi đánh giá của bạn</h3>
                            <?php if (!empty($reviewSuccess)): ?>
                                <p class="text-sm text-green-600 mb-4" role="status"><?= htmlspecialchars($reviewSuccess, ENT_QUOTES, 'UTF-8') ?></p>
                            <?php endif; ?>
                            <?php if (!empty($errors['auth'])): ?>
                                <p class="text-sm text-red-600 mb-4" role="alert"><?= htmlspecialchars($errors['auth'], ENT_QUOTES, 'UTF-8') ?></p>
                            <?php endif; ?>
                            <form action="index.php?controller=chi_tiet&action=insertRV" method="POST" class="flex flex-col gap-4" novalidate>
                                <input type="hidden" name="id_sp" value="<?= $list_san_pham['id']; ?>">

                                <div>
                                    <label for="so_sao" class="ds-label">Đánh giá sao</label>
                                    <?php $soSaoOld = form_old_raw('so_sao', '5'); ?>
                                    <select id="so_sao" name="so_sao" class="<?= form_input_class($errors ?? [], 'so_sao', 'ds-input h-10 px-3 text-sm cursor-pointer') ?>"<?= form_field_attrs($errors ?? [], 'so_sao', 'so_sao') ?>>
                                        <option value="5" <?= (string)$soSaoOld === '5' ? 'selected' : '' ?>>5 Sao ⭐⭐⭐⭐⭐</option>
                                        <option value="4" <?= (string)$soSaoOld === '4' ? 'selected' : '' ?>>4 Sao ⭐⭐⭐⭐</option>
                                        <option value="3" <?= (string)$soSaoOld === '3' ? 'selected' : '' ?>>3 Sao ⭐⭐⭐</option>
                                        <option value="2" <?= (string)$soSaoOld === '2' ? 'selected' : '' ?>>2 Sao ⭐⭐</option>
                                        <option value="1" <?= (string)$soSaoOld === '1' ? 'selected' : '' ?>>1 Sao ⭐</option>
                                    </select>
                                    <?php $field = 'so_sao'; $inputId = 'so_sao'; include __DIR__ . '/components/form-error.php'; ?>
                                </div>

                                <div>
                                    <label for="danhGia" class="ds-label">Nhận xét chi tiết</label>
                                    <textarea id="danhGia" name="danhGia" placeholder="Chia sẻ trải nghiệm của bạn về sản phẩm này..."
                                        class="<?= form_input_class($errors ?? [], 'danhGia', 'ds-input px-3 py-2.5 text-sm min-h-[100px] resize-none') ?>"<?= form_field_attrs($errors ?? [], 'danhGia', 'danhGia') ?>><?= form_old_value('danhGia') ?></textarea>
                                    <?php $field = 'danhGia'; $inputId = 'danhGia'; include __DIR__ . '/components/form-error.php'; ?>
                                </div>

                                <button type="submit" class="ds-btn-primary w-full py-3 text-sm mt-1">Gửi đánh giá</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Related Products -->
            <section class="py-12 lg:py-14 bg-white border-t border-slate-200">
                <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
                        <div>
                            <p class="text-sm font-medium text-blue-600 mb-1">Gợi ý</p>
                            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Sản phẩm liên quan</h2>
                        </div>
                        <a href="index.php?controller=category&action=index" class="ds-btn-secondary h-10 px-5 text-sm w-fit">Xem tất cả</a>
                    </div>
                    <div class="grid grid-cols-1 min-[375px]:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5">
                        <?php foreach ($related_products as $row) {
                            include __DIR__ . '/components/product-card.php';
                        } ?>
                    </div>
                </div>
            </section>
        </main>

        <?php include __DIR__ . '/components/footer.php'; ?>
    </div>
</body>
<script>
    const img = document.getElementById('imgs');
    const prv = document.getElementById('prv');
    const next = document.getElementById('next');
    if (img && prv && next) {
        const arr = [
            '/web-ban-hang/public/uploads/<?php echo $list_san_pham["hinh_anh"] ?? ""; ?>',
            '/web-ban-hang/website/app/views/imgs/banner1.png',
            '/web-ban-hang/website/app/views/imgs/image.png',
            '/web-ban-hang/website/app/views/imgs/banner2.png'
        ];
        let index = 0;
        img.src = arr[0];
        prv.addEventListener('click', () => {
            index = index <= 0 ? arr.length - 1 : index - 1;
            img.src = arr[index];
        });
        next.addEventListener('click', () => {
            index = index >= arr.length - 1 ? 0 : index + 1;
            img.src = arr[index];
        });
    }
</script>

</html>
