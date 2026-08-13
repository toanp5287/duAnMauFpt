<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Tech Store - Mua sắm thiết bị công nghệ chính hãng, giá tốt nhất" />
    <title>Tech Store - Trang chủ</title>
    <?php include __DIR__ . '/components/head-resources.php'; ?>
    <style>
        /* ══════════════════════════════
           HOME PAGE — LAYOUT CHÍNH
           ══════════════════════════════ */

        /* Wrapper thân trang */
        .home-body-wrapper {
            width: 92%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 24px 0 48px;
            display: flex;
            flex-direction: row;
            gap: 20px;
            align-items: flex-start;
        }

        .home-sidebar {
            width: 22%;
            flex-shrink: 0;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(31, 41, 55, 0.06);
            border: 1px solid #E5E7EB;
            position: sticky;
            top: 88px;
            align-self: flex-start;
        }

        .home-sidebar-header {
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .home-sidebar-header span {
            color: #ffffff;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .home-sidebar ul {
            list-style: none;
            margin: 0;
            padding: 6px 0;
        }

        .home-sidebar ul li {
            border-bottom: 1px solid #F3F4F6;
        }

        .home-sidebar ul li:last-child {
            border-bottom: none;
        }

        .home-sidebar ul li a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 11px 16px;
            font-size: 13.5px;
            font-weight: 500;
            color: #1F2937;
            text-decoration: none;
            transition: background 0.25s, color 0.25s;
        }

        .home-sidebar ul li a:hover {
            background: #EFF6FF;
            color: #2563EB;
        }

        .home-sidebar ul li.active-cat a,
        .home-sidebar ul li a.all-cat {
            background: #2563EB;
            color: #ffffff;
            font-weight: 700;
        }

        .home-sidebar ul li a.all-cat:hover {
            background: #1D4ED8;
            color: #fff;
        }

        .home-sidebar ul li a .cat-label {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .home-sidebar ul li a svg.arrow-icon {
            color: #94a3b8;
            flex-shrink: 0;
            transition: color 0.2s, transform 0.2s;
        }

        .home-sidebar ul li a:hover svg.arrow-icon {
            color: #2563EB;
            transform: translateX(2px);
        }

        .home-sidebar ul li a.all-cat svg.arrow-icon {
            color: rgba(255, 255, 255, 0.7);
        }

        /* ── CONTENT PHẢI ── */
        .home-content {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* ── SLIDER ── */
        .slider-dot {
            width: 24px;
            height: 4px;
            border-radius: 2px;
            background: rgba(255, 255, 255, 0.5);
            transition: all .3s;
            cursor: pointer;
        }

        .slider-dot.active {
            width: 36px;
            background: #F97316;
        }

        .home-products-box {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(31, 41, 55, 0.06);
            border: 1px solid #E5E7EB;
        }

        .home-products-header {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 16px 20px;
            border-bottom: 2px solid #E5E7EB;
            background: linear-gradient(to right, #EFF6FF, #ffffff);
        }

        .home-products-title-label {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #2563EB;
            margin-bottom: 2px;
        }

        .home-products-title {
            font-size: 18px;
            font-weight: 900;
            color: #1F2937;
        }

        .home-products-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
            background: #EFF6FF;
            color: #2563EB;
            font-size: 12px;
            font-weight: 700;
            border-radius: 999px;
            border: 1px solid #BFDBFE;
            white-space: nowrap;
        }

        .home-products-grid-wrap {
            padding: 16px 20px 20px;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .home-body-wrapper {
                width: 96%;
                flex-direction: column;
                gap: 14px;
                padding: 14px 0 30px;
            }

            .home-sidebar {
                width: 100%;
                position: static;
            }

            .home-content {
                width: 100%;
            }
        }
    </style>
</head>

<body class="bg-surface text-ink-800 antialiased font-sans">
    <div class="flex flex-col min-h-screen">
        <?php include __DIR__ . '/components/header.php'; ?>

        <main>
            <div class="home-body-wrapper">

                <!-- ══════════════════════════
                     SIDEBAR — CỘT TRÁI 20%
                     ══════════════════════════ -->
                <aside class="home-sidebar">
                    <div class="home-sidebar-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <span>Danh Mục Sản Phẩm</span>
                    </div>

                    <ul>
                        <li>
                            <a href="index.php?controller=category&action=index" class="all-cat">
                                <span class="cat-label">
                                    <span>🏷️</span> Tất cả sản phẩm
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="arrow-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </li>
                        <?php
                        $categoryIcons = ['📱', '💻', '🖥️', '⌨️', '🎧', '📷', '🖨️', '🔋', '🎮', '📺', '⌚', 'f'];
                        $iconIdx = 0;
                        foreach ($categories as $row) { ?>
                            <li>
                                <a href="index.php?controller=category&action=phan_loai&id=<?php echo $row['id']; ?>">
                                    <span class="cat-label">
                                        <span><?php echo $categoryIcons[$iconIdx % count($categoryIcons)]; ?></span>
                                        <?php echo $row['ten_loai']; ?>
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="arrow-icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </li>
                        <?php $iconIdx++;
                        } ?>
                    </ul>
                </aside>

                <!-- ══════════════════════════
                     CONTENT — CỘT PHẢI 80%
                     ══════════════════════════ -->
                <div class="home-content">

                    <!-- ── BANNER SLIDER ── -->
                    <div class="relative overflow-hidden rounded-2xl shadow-card bg-ink-900" style="min-height: 380px;">
                        <div id="sliderTrack" class="flex h-full transition-transform duration-700 ease-in-out" style="min-height: 380px;">

                            <!-- Slide 1 -->
                            <div class="slide flex-shrink-0 w-full relative" style="min-height: 380px;">
                                <img src="/web-ban-hang/website/app/views/imgs/banner1.png" alt="Banner 1" class="absolute inset-0 w-full h-full object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-r from-gray-950/80 via-gray-900/50 to-transparent"></div>
                                <div class="relative z-10 h-full flex flex-col justify-center px-10 py-12 max-w-lg">
                                    <span class="inline-block px-3 py-1 mb-4 text-xs font-black uppercase tracking-widest text-ink-800 bg-cta-500 rounded-full w-fit">🔥 Deal Hot</span>
                                    <h2 class="text-3xl sm:text-4xl font-black text-white leading-tight mb-4">Công Nghệ<br /><span class="text-cta-500">Đỉnh Cao</span></h2>
                                    <p class="text-gray-200 text-sm mb-6">Hàng nghìn sản phẩm chính hãng — Apple, Samsung, Sony...</p>
                                    <a href="index.php?controller=category&action=index" class="banner-cta inline-block w-fit px-8 py-3.5 bg-cta-500 hover:bg-cta-600 text-white text-sm font-bold rounded-xl transition-all hover:shadow-lg active:scale-95">
                                        Mua Sắm Ngay →
                                    </a>
                                </div>
                            </div>

                            <!-- Slide 2 -->
                            <div class="slide flex-shrink-0 w-full relative" style="min-height: 380px;">
                                <img src="/web-ban-hang/website/app/views/imgs/image.png" alt="Banner 2" class="absolute inset-0 w-full h-full object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-r from-gray-950/80 via-gray-900/50 to-transparent"></div>
                                <div class="relative z-10 h-full flex flex-col justify-center px-10 py-12 max-w-lg">
                                    <span class="inline-block px-3 py-1 mb-4 text-xs font-black uppercase tracking-widest text-white bg-primary-500 rounded-full w-fit">✨ Mới Ra Mắt</span>
                                    <h2 class="text-3xl sm:text-4xl font-black text-white leading-tight mb-4">Smartphone<br /><span class="text-cta-500">Flagship 2026</span></h2>
                                    <p class="text-gray-200 text-sm mb-6">Trải nghiệm màn hình Dynamic AMOLED 120Hz, camera 200MP...</p>
                                    <a href="index.php?controller=category&action=index" class="banner-cta inline-block w-fit px-8 py-3.5 bg-cta-500 hover:bg-cta-600 text-white text-sm font-bold rounded-xl transition-all hover:shadow-lg active:scale-95">
                                        Khám Phá Ngay →
                                    </a>
                                </div>
                            </div>

                            <!-- Slide 3 -->
                            <div class="slide flex-shrink-0 w-full relative" style="min-height: 380px;">
                                <img src="/web-ban-hang/website/app/views/imgs/banner2.png" alt="Banner 3" class="absolute inset-0 w-full h-full object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-r from-gray-950/80 via-gray-900/50 to-transparent"></div>
                                <div class="relative z-10 h-full flex flex-col justify-center px-10 py-12 max-w-lg">
                                    <span class="inline-block px-3 py-1 mb-4 text-xs font-black uppercase tracking-widest text-ink-800 bg-cta-500 rounded-full w-fit">💻 Work &amp; Play</span>
                                    <h2 class="text-3xl sm:text-4xl font-black text-white leading-tight mb-4">Laptop<br /><span class="text-cta-500">Chính Hãng</span></h2>
                                    <p class="text-gray-200 text-sm mb-6">MacBook, Dell XPS, Asus ROG — giá ưu đãi nhất thị trường.</p>
                                    <a href="index.php?controller=category&action=index" class="banner-cta inline-block w-fit px-8 py-3.5 bg-cta-500 hover:bg-cta-600 text-white text-sm font-bold rounded-xl transition-all hover:shadow-lg active:scale-95">
                                        Xem Ngay →
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Prev / Next -->
                        <button id="sliderPrev" class="absolute left-3 top-1/2 -translate-y-1/2 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-white/90 hover:bg-primary-500 text-ink-700 hover:text-white text-xl font-bold transition-all hover:scale-110 backdrop-blur-sm shadow-soft" aria-label="Slide trước">&#8249;</button>
                        <button id="sliderNext" class="absolute right-3 top-1/2 -translate-y-1/2 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-white/90 hover:bg-primary-500 text-ink-700 hover:text-white text-xl font-bold transition-all hover:scale-110 backdrop-blur-sm shadow-soft" aria-label="Slide sau">&#8250;</button>

                        <!-- Dots -->
                        <div id="sliderDots" class="absolute bottom-4 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
                            <div class="slider-dot active" data-dot="0"></div>
                            <div class="slider-dot" data-dot="1"></div>
                            <div class="slider-dot" data-dot="2"></div>
                        </div>
                    </div>

                    <!-- ── DANH SÁCH SẢN PHẨM ── -->
                    <div class="home-products-box">
                        <div class="home-products-header">
                            <div>
                                <p class="home-products-title-label">Gợi ý cho bạn</p>
                                <h2 class="home-products-title">Sản Phẩm Yêu Thích</h2>
                            </div>
                            <span class="home-products-badge">
                                🛍️ Tổng <strong><?= count($productsList) ?></strong> sản phẩm
                            </span>
                        </div>

                        <div class="home-products-grid-wrap">
                            <?php if (empty($productsList)) { ?>

                                <div class="flex flex-col items-center justify-center py-20 text-center">
                                    <div class="text-5xl mb-4">🔍</div>
                                    <h3 class="text-lg font-black text-gray-700 mb-2">Không tìm thấy sản phẩm</h3>
                                    <p class="text-gray-400 text-sm mb-6">Sản phẩm này không tồn tại hoặc đã bị xóa.</p>
                                    <a href="index.php" class="px-6 py-2.5 bg-cta-500 text-white text-sm font-bold rounded-xl hover:bg-cta-600 transition-colors shadow-md">
                                        Về trang chủ
                                    </a>
                                </div>

                            <?php } else { ?>

                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
                                    <?php foreach ($productsList as $row) { ?>
                                        <?php include __DIR__ . '/components/product-card.php'; ?>
                                    <?php } ?>
                                </div>

                            <?php } ?>
                        </div>
                    </div>

                </div>
                <!-- end .home-content -->

            </div>
            <!-- end .home-body-wrapper -->
        </main>

        <?php include __DIR__ . '/components/footer.php'; ?>
    </div>
</body>

<!-- ════ SLIDER SCRIPT (giữ nguyên) ════ -->
<script>
    (function() {
        var track = document.getElementById('sliderTrack');
        var slides = track ? track.querySelectorAll('.slide') : [];
        var dots = document.querySelectorAll('[data-dot]');
        var total = slides.length;
        var current = 0;
        var autoTimer;

        function goTo(idx) {
            current = (idx + total) % total;
            track.style.transform = 'translateX(-' + (current * 100) + '%)';
            dots.forEach(function(d, i) {
                d.classList.toggle('active', i === current);
            });
        }

        function next() {
            goTo(current + 1);
        }

        function prev() {
            goTo(current - 1);
        }

        function startAuto() {
            autoTimer = setInterval(next, 3500);
        }

        function resetAuto() {
            clearInterval(autoTimer);
            startAuto();
        }

        var btnNext = document.getElementById('sliderNext');
        var btnPrev = document.getElementById('sliderPrev');

        if (btnNext) btnNext.addEventListener('click', function() {
            next();
            resetAuto();
        });
        if (btnPrev) btnPrev.addEventListener('click', function() {
            prev();
            resetAuto();
        });

        dots.forEach(function(d) {
            d.addEventListener('click', function() {
                goTo(parseInt(d.getAttribute('data-dot')));
                resetAuto();
            });
        });

        if (total > 0) {
            goTo(0);
            startAuto();
        }
    })();
</script>

</html>