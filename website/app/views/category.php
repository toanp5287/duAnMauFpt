<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Tech Store - Danh mục sản phẩm công nghệ chính hãng." />
    <title>Tech Store - Danh mục sản phẩm</title>
    <?php include __DIR__ . '/components/head-resources.php'; ?>
    <style>
        .slider-dot {
            width: 24px;
            height: 4px;
            border-radius: 9999px;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slider-dot.active {
            width: 36px;
            background: #f97316;
        }

        @media (max-width: 640px) {
            .slider-dot {
                width: 18px;
                height: 3px;
            }

            .slider-dot.active {
                width: 28px;
            }
        }
    </style>
</head>

<body class="font-sans bg-surface text-ink-800 antialiased">
    <div class="flex flex-col min-h-screen">
        <?php include __DIR__ . '/components/header.php'; ?>
        <!-- BANNER -->
        <section class="w-full py-5 sm:py-6 lg:py-8">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">

                <div
                    class="relative w-full overflow-hidden rounded-2xl shadow-card bg-ink-900
                   min-h-[260px] sm:min-h-[320px] lg:min-h-[380px]">

                    <!-- Slider Track -->
                    <div
                        id="sliderTrack"
                        class="flex h-full transition-transform duration-700 ease-in-out
                       min-h-[260px] sm:min-h-[320px] lg:min-h-[380px]">

                        <!-- SLIDE 1 -->
                        <div
                            class="slide flex-shrink-0 w-full relative
                           min-h-[260px] sm:min-h-[320px] lg:min-h-[380px]">
                            <img
                                src="/web-ban-hang/website/app/views/imgs/banner1.png"
                                alt="Sản phẩm công nghệ"
                                class="absolute inset-0 w-full h-full object-cover" />

                            <div class="absolute inset-0 bg-gradient-to-r from-gray-950/85 via-gray-900/55 to-transparent"></div>

                            <div
                                class="relative z-10 h-full flex flex-col justify-center
                               px-6 sm:px-10 lg:px-12
                               py-8 sm:py-10 lg:py-12
                               max-w-xl">

                                <span
                                    class="inline-flex w-fit px-3 py-1 mb-3 sm:mb-4
                                   text-[10px] sm:text-xs
                                   font-black uppercase tracking-widest
                                   text-ink-800 bg-cta-500 rounded-full">
                                    🔥 Sản Phẩm Nổi Bật
                                </span>

                                <h2
                                    class="text-2xl sm:text-3xl lg:text-4xl
                                   font-black text-white
                                   leading-tight mb-3 sm:mb-4">
                                    Khám Phá<br>
                                    <span class="text-cta-500">
                                        Sản Phẩm Công Nghệ
                                    </span>
                                </h2>

                                <p
                                    class="text-gray-200
                                   text-xs sm:text-sm
                                   leading-6
                                   mb-4 sm:mb-6
                                   max-w-md">
                                    Khám phá những sản phẩm công nghệ mới nhất
                                    với chất lượng chính hãng và giá tốt.
                                </p>

                                <a
                                    href="#products"
                                    class="inline-flex w-fit
                                   px-5 sm:px-8
                                   py-2.5 sm:py-3.5
                                   bg-cta-500 hover:bg-cta-600
                                   text-white text-xs sm:text-sm
                                   font-bold rounded-xl
                                   transition-all hover:shadow-lg
                                   active:scale-95">
                                    Xem Sản Phẩm →
                                </a>

                            </div>
                        </div>


                        <!-- SLIDE 2 -->
                        <div
                            class="slide flex-shrink-0 w-full relative
                           min-h-[260px] sm:min-h-[320px] lg:min-h-[380px]">
                            <img
                                src="/web-ban-hang/website/app/views/imgs/image.png"
                                alt="Điện thoại thông minh"
                                class="absolute inset-0 w-full h-full object-cover" />

                            <div class="absolute inset-0 bg-gradient-to-r from-gray-950/85 via-gray-900/55 to-transparent"></div>

                            <div
                                class="relative z-10 h-full flex flex-col justify-center
                               px-6 sm:px-10 lg:px-12
                               py-8 sm:py-10 lg:py-12
                               max-w-xl">

                                <span
                                    class="inline-flex w-fit px-3 py-1 mb-3 sm:mb-4
                                   text-[10px] sm:text-xs
                                   font-black uppercase tracking-widest
                                   text-white bg-primary-500 rounded-full">
                                    ✨ Sản Phẩm Mới
                                </span>

                                <h2
                                    class="text-2xl sm:text-3xl lg:text-4xl
                                   font-black text-white
                                   leading-tight mb-3 sm:mb-4">
                                    Smartphone<br>
                                    <span class="text-cta-500">
                                        Thế Hệ Mới
                                    </span>
                                </h2>

                                <p
                                    class="text-gray-200
                                   text-xs sm:text-sm
                                   leading-6
                                   mb-4 sm:mb-6
                                   max-w-md">
                                    Những mẫu smartphone mới nhất từ Apple,
                                    Samsung, Xiaomi và nhiều thương hiệu nổi tiếng.
                                </p>

                                <a
                                    href="#products"
                                    class="inline-flex w-fit
                                   px-5 sm:px-8
                                   py-2.5 sm:py-3.5
                                   bg-cta-500 hover:bg-cta-600
                                   text-white text-xs sm:text-sm
                                   font-bold rounded-xl
                                   transition-all hover:shadow-lg
                                   active:scale-95">
                                    Khám Phá Ngay →
                                </a>

                            </div>
                        </div>


                        <!-- SLIDE 3 -->
                        <div
                            class="slide flex-shrink-0 w-full relative
                           min-h-[260px] sm:min-h-[320px] lg:min-h-[380px]">
                            <img
                                src="/web-ban-hang/website/app/views/imgs/banner2.png"
                                alt="Laptop chính hãng"
                                class="absolute inset-0 w-full h-full object-cover" />

                            <div class="absolute inset-0 bg-gradient-to-r from-gray-950/85 via-gray-900/55 to-transparent"></div>

                            <div
                                class="relative z-10 h-full flex flex-col justify-center
                               px-6 sm:px-10 lg:px-12
                               py-8 sm:py-10 lg:py-12
                               max-w-xl">

                                <span
                                    class="inline-flex w-fit px-3 py-1 mb-3 sm:mb-4
                                   text-[10px] sm:text-xs
                                   font-black uppercase tracking-widest
                                   text-ink-800 bg-cta-500 rounded-full">
                                    💻 Laptop & Máy Tính
                                </span>

                                <h2
                                    class="text-2xl sm:text-3xl lg:text-4xl
                                   font-black text-white
                                   leading-tight mb-3 sm:mb-4">
                                    Laptop<br>
                                    <span class="text-cta-500">
                                        Chính Hãng
                                    </span>
                                </h2>

                                <p
                                    class="text-gray-200
                                   text-xs sm:text-sm
                                   leading-6
                                   mb-4 sm:mb-6
                                   max-w-md">
                                    MacBook, Dell, ASUS, Lenovo và nhiều mẫu laptop
                                    phù hợp cho học tập, làm việc và giải trí.
                                </p>

                                <a
                                    href="#products"
                                    class="inline-flex w-fit
                                   px-5 sm:px-8
                                   py-2.5 sm:py-3.5
                                   bg-cta-500 hover:bg-cta-600
                                   text-white text-xs sm:text-sm
                                   font-bold rounded-xl
                                   transition-all hover:shadow-lg
                                   active:scale-95">
                                    Xem Laptop →
                                </a>

                            </div>
                        </div>

                    </div>


                    <!-- PREV -->
                    <button
                        id="sliderPrev"
                        class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2
                       z-20
                       w-9 h-9 sm:w-10 sm:h-10
                       flex items-center justify-center
                       rounded-full
                       bg-white/90 hover:bg-primary-500
                       text-ink-700 hover:text-white
                       text-xl font-bold
                       transition-all hover:scale-110
                       backdrop-blur-sm shadow-soft">
                        &#8249;
                    </button>


                    <!-- NEXT -->
                    <button
                        id="sliderNext"
                        class="absolute right-3 sm:right-4 top-1/2 -translate-y-1/2
                       z-20
                       w-9 h-9 sm:w-10 sm:h-10
                       flex items-center justify-center
                       rounded-full
                       bg-white/90 hover:bg-primary-500
                       text-ink-700 hover:text-white
                       text-xl font-bold
                       transition-all hover:scale-110
                       backdrop-blur-sm shadow-soft">
                        &#8250;
                    </button>


                    <!-- DOTS -->
                    <div
                        id="sliderDots"
                        class="absolute bottom-4 left-1/2 -translate-x-1/2
                       z-20 flex items-center gap-2">
                        <div class="slider-dot active" data-dot="0"></div>
                        <div class="slider-dot" data-dot="1"></div>
                        <div class="slider-dot" data-dot="2"></div>
                    </div>

                </div>

            </div>
        </section>
        <main class="flex-1 py-10 lg:py-14">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-[260px_1fr] gap-8 lg:gap-10">
                    <?php include __DIR__ . '/components/sidebar.php'; ?>

                    <div class="mb-8">

                        <!-- Header sản phẩm -->
                        <div class="
        flex flex-col
        lg:flex-row
        lg:items-center
        lg:justify-between
        gap-5

        p-5 sm:p-6
        bg-white
        rounded-2xl
        border border-ink-100
        shadow-sm
    ">

                            <!-- Tiêu đề -->
                            <div>
                                <div class="flex items-center gap-3">

                                    <span class="
                    flex items-center justify-center
                    w-10 h-10
                    rounded-xl
                    bg-primary-50
                    text-primary-500
                ">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </span>

                                    <div>
                                        <h2 class="
                        text-xl sm:text-2xl
                        font-extrabold
                        text-ink-900
                        tracking-tight
                    ">
                                            Tất cả sản phẩm
                                        </h2>

                                        <p class="
                        text-sm
                        text-ink-500
                        mt-0.5
                    ">
                                            Khám phá các sản phẩm công nghệ
                                        </p>
                                    </div>

                                </div>
                            </div>


                            <!-- Bộ lọc -->
                            <form
                                action="category.php"
                                method="get"
                                class="
                flex flex-col
                sm:flex-row
                gap-2
                w-full
                lg:w-auto
            ">

                                <input
                                    type="hidden"
                                    name="c"
                                    value="phone" />

                                <div class="relative">

                                    <select
                                        name="sort"
                                        class="
                        w-full
                        sm:w-auto
                        min-w-[190px]
                        h-11
                        pl-4 pr-10
                        text-sm
                        font-medium
                        text-ink-700

                        bg-ink-50
                        border border-ink-200
                        rounded-xl

                        outline-none
                        cursor-pointer

                        focus:bg-white
                        focus:border-primary-400
                        focus:ring-2
                        focus:ring-primary-100

                        transition-all
                    ">
                                        <option value="popular">
                                            Sắp xếp: Phổ biến
                                        </option>

                                        <option value="priceAsc">
                                            Giá: Thấp → Cao
                                        </option>

                                        <option value="priceDesc">
                                            Giá: Cao → Thấp
                                        </option>

                                        <option value="nameAsc">
                                            Tên: A → Z
                                        </option>
                                    </select>

                                </div>


                                <button
                                    type="submit"
                                    class="
                    h-11
                    px-6
                    inline-flex
                    items-center
                    justify-center
                    gap-2

                    text-sm
                    font-bold
                    text-white

                    bg-primary-500
                    hover:bg-primary-600

                    rounded-xl
                    shadow-sm
                    hover:shadow-md

                    active:scale-[0.98]

                    transition-all
                ">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2.5">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 4h18M6 12h12M10 20h4" />
                                    </svg>

                                    Lọc sản phẩm

                                </button>

                            </form>

                        </div>


                        <!-- Số lượng sản phẩm -->
                        <div class="flex items-center justify-between mt-5 mb-4">

                            <p class="text-sm text-ink-500">
                                Hiển thị
                                <strong class="text-ink-900">
                                    <?= count($list) ?>
                                </strong>
                                sản phẩm
                            </p>

                            <span class="
            hidden sm:inline-flex
            items-center
            px-3 py-1
            rounded-full
            bg-ink-50
            border border-ink-100
            text-xs
            font-semibold
            text-ink-500
        ">
                                Sản phẩm công nghệ
                            </span>

                        </div>


                        <!-- Danh sách sản phẩm -->
                        <div class="
        grid
        grid-cols-1
        sm:grid-cols-2
        lg:grid-cols-3
        xl:grid-cols-4

        gap-4
        sm:gap-5
    ">

                            <?php foreach ($list as $row) {
                                include __DIR__ . '/components/product-card.php';
                            } ?>

                        </div>


                        <!-- Không có sản phẩm -->
                        <?php if (count($list) === 0) { ?>

                            <div class="
            flex
            flex-col
            items-center
            justify-center

            py-20
            px-6
            mt-6

            text-center

            bg-white
            rounded-2xl
            border border-ink-100
            shadow-sm
        ">

                                <div class="
                flex
                items-center
                justify-center

                w-16 h-16
                mb-5

                rounded-2xl
                bg-ink-50
                text-3xl
            ">
                                    📦
                                </div>

                                <h3 class="
                text-xl
                font-extrabold
                text-ink-900
                mb-2
            ">
                                    Không tìm thấy sản phẩm
                                </h3>

                                <p class="text-sm text-ink-500">
                                    Không có sản phẩm nào trong danh mục này.
                                </p>

                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </main>

        <?php include __DIR__ . '/components/footer.php'; ?>
    </div>
</body>
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