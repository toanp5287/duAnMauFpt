<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Tech Store - Chi tiết sản phẩm." />
    <title>Tech Store - Chi tiết sản phẩm</title>
    <?php include __DIR__ . '/components/head-resources.php'; ?>
</head>

<body class="font-sans bg-surface text-ink-800 antialiased">
    <div class="flex flex-col min-h-screen">
        <?php include __DIR__ . '/components/header.php'; ?>

        <main class="flex-1 py-8 lg:py-12">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex items-center flex-wrap gap-2 text-sm text-ink-500 mb-8 font-medium">
                    <a href="index.php" class="hover:text-accent-600 transition-colors">Trang chủ</a>
                    <span class="text-ink-300">/</span>
                    <a href="index.php?controller=category&action=index" class="hover:text-accent-600 transition-colors">Danh mục</a>
                    <span class="text-ink-300">/</span>
                    <span class="font-bold text-ink-900 truncate max-w-[220px] sm:max-w-none"><?php echo $list_san_pham['ten_san_pham'] ?? 'Sản phẩm'; ?></span>
                </nav>

                <div class="bg-white rounded-2xl border border-ink-200 p-6 sm:p-8 lg:p-10 mb-12 shadow-soft product-detail-wrap">
                    <?php if (!empty($list_san_pham)) { ?>
                        <?php include __DIR__ . '/components/product-detail.php'; ?>
                    <?php } else { ?>
                        <div class="flex flex-col items-center justify-center py-20 text-center">
                            <div class="text-5xl mb-4">🔍</div>
                            <h3 class="text-xl font-extrabold text-ink-900 mb-2">Không tìm thấy sản phẩm</h3>
                            <p class="text-ink-500 mb-6 font-medium">Sản phẩm này không tồn tại hoặc đã bị xóa.</p>
                            <a href="index.php" class="inline-flex h-12 items-center justify-center px-8 text-sm font-bold text-white bg-cta-500 rounded-xl hover:bg-cta-600 transition-colors shadow-md">Về trang chủ</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <section class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 mb-16">
                <!-- Section Header -->
                <div class="mb-10 flex flex-col md:flex-row md:items-end md:justify-between border-b border-ink-100 pb-5">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-accent-500 mb-1">Đánh Giá</p>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-ink-900 tracking-tight">Khách Hàng Nói Gì Về Chúng Tôi</h2>
                    </div>
                    <?php if (!empty($reviews)): ?>
                        <p class="text-xs text-ink-400 mt-2 md:mt-0 font-bold uppercase tracking-wider">Tổng cộng: <?= count($reviews) ?> đánh giá</p>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left: Reviews List (takes 2 cols on lg screens) -->
                    <div class="lg:col-span-2">
                        <?php
                        $reviews = $reviews ?? [];
                        if (empty($reviews)):
                        ?>
                            <div class="text-center py-16 bg-white rounded-2xl border border-ink-100 shadow-sm flex flex-col items-center justify-center">
                                <div class="text-4xl mb-3 opacity-50">💬</div>
                                <p class="text-ink-900 font-bold text-base">Chưa có đánh giá nào</p>
                                <p class="text-ink-400 text-xs mt-1 font-medium">Hãy là người đầu tiên chia sẻ trải nghiệm về sản phẩm này!</p>
                            </div>
                        <?php else: ?>
                            <div class="grid sm:grid-cols-2 gap-4">
                                <?php foreach ($reviews as $rv): ?>
                                    <div class="bg-white p-5 rounded-2xl border border-ink-100 shadow-sm hover:shadow-soft hover:-translate-y-0.5 transition-all duration-300 relative overflow-hidden group flex flex-col justify-between">
                                        <div>
                                            <div class="flex items-center justify-between mb-3.5">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 rounded-full bg-accent-50 text-accent-600 flex items-center justify-center font-bold text-sm mr-3 border border-accent-100">
                                                        <?= mb_strtoupper(mb_substr($rv['name'], 0, 1, 'UTF-8'), 'UTF-8'); ?>
                                                    </div>
                                                    <div>
                                                        <p class="font-bold text-ink-900 text-sm leading-tight"><?= htmlspecialchars($rv['name']); ?></p>
                                                        <div class="flex text-amber-400 text-xs mt-1 gap-0.5">
                                                            <?php
                                                            $stars = (int)($rv['so_sao'] ?? 5);
                                                            for ($i = 1; $i <= 5; $i++) {
                                                                if ($i <= $stars) {
                                                                    echo '★';
                                                                } else {
                                                                    echo '<span class="text-ink-200">★</span>';
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-ink-600 text-sm leading-relaxed italic">"<?= htmlspecialchars($rv['noi_dung']); ?>"</p>
                                        </div>
                                        <div class="mt-4 pt-3 border-t border-ink-50 flex items-center justify-between">
                                            <span class="inline-block text-[10px] text-ink-400 font-bold uppercase tracking-wider">
                                                SP: <?= htmlspecialchars($rv['ten_san_pham']); ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Right: Review Form (takes 1 col on lg screens) -->
                    <div class="lg:col-span-1">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-ink-100 lg:sticky lg:top-28">
                            <h3 class="text-base font-extrabold text-ink-900 mb-4 pb-2 border-b border-ink-50">Gửi đánh giá của bạn</h3>
                            <form action="index.php?controller=chi_tiet&action=insertRV" method="POST" class="flex flex-col gap-4">
                                <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id'] ?? '' ?>">

                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[10px] font-bold text-ink-500 uppercase tracking-wider">Sản phẩm</label>
                                    <input type="hidden" name="id_sp" value="<?= $list_san_pham['id'];  ?>">
                                </div>

                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[10px] font-bold text-ink-500 uppercase tracking-wider">Đánh giá sao</label>
                                    <select name="so_sao" required class="w-full px-3 py-2 bg-ink-50 border border-ink-200 rounded-lg focus:outline-none focus:border-accent-500 focus:bg-white text-xs text-ink-700 font-medium transition-colors cursor-pointer">
                                        <option value="5" selected>5 Sao ⭐⭐⭐⭐⭐</option>
                                        <option value="4">4 Sao ⭐⭐⭐⭐</option>
                                        <option value="3">3 Sao ⭐⭐⭐</option>
                                        <option value="2">2 Sao ⭐⭐</option>
                                        <option value="1">1 Sao ⭐</option>
                                    </select>
                                </div>

                                <div class="flex flex-col gap-1.5">
                                    <label class="text-[10px] font-bold text-ink-500 uppercase tracking-wider">Nhận xét chi tiết</label>
                                    <textarea name="danhGia" required placeholder="Chia sẻ trải nghiệm của bạn về sản phẩm này..." class="w-full px-3 py-2.5 bg-ink-50 border border-ink-200 rounded-lg focus:outline-none focus:border-accent-500 focus:bg-white text-xs text-ink-700 min-h-[90px] resize-none transition-colors"></textarea>
                                </div>

                                <button type="submit" class="w-full py-3 mt-1 bg-accent-500 hover:bg-accent-600 text-white font-bold rounded-lg transition-colors shadow-sm text-xs tracking-wider uppercase">Gửi Đánh Giá</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-14 bg-surface border-t border-ink-200">
                <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-10">
                        <div>
                            <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-primary-500 mb-2">Gợi ý</p>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-ink-800 tracking-tight">Sản phẩm liên quan</h2>
                        </div>
                        <a href="index.php?controller=category&action=index" class="inline-flex h-11 items-center px-5 text-sm font-bold text-primary-500 bg-primary-50 rounded-xl hover:bg-primary-100 transition-colors">Xem tất cả</a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
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

    console.log(prv);
    console.log(next);

    const arr = [
        '/web-ban-hang/admin/uploads/<?php echo $list_san_pham["hinh_anh"]; ?>',
        '/web-ban-hang/website/app/views/imgs/banner1.png',
        '/web-ban-hang/website/app/views/imgs/image.png',
        '/web-ban-hang/website/app/views/imgs/banner2.png'
    ];
    console.log(arr);
    let index = 0;
    img.src = arr[0];
    prv.addEventListener('click', () => {
        index--;

        if (index < 0) {
            index = arr.length - 1;
        }

        img.src = arr[index];
    });

    next.addEventListener('click', () => {
        index++;

        if (index >= arr.length) {
            index = 0;
        }

        img.src = arr[index];
    });
</script>

</html>