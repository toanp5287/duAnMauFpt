<?php

/**
 * TECH STORE - PREMIUM BANNER SLIDER
 * PHP + Tailwind CSS
 *
 * Không thay đổi logic PHP hiện tại.
 */

$bannerMode = $bannerMode ?? 'category';

$bannerSlides = [
    [
        'image' => '/web-ban-hang/website/app/views/imgs/banner1.png',
        'alt' => 'Sản phẩm công nghệ',
        'tag' => 'NEW',
        'title' => $bannerMode === 'home'
            ? 'Công Nghệ Đỉnh Cao'
            : 'Khám Phá Sản Phẩm Công Nghệ',
        'desc' => $bannerMode === 'home'
            ? 'Hàng nghìn sản phẩm chính hãng — Apple, Samsung, Sony...'
            : 'Khám phá những sản phẩm công nghệ mới nhất với chất lượng chính hãng và giá tốt.',
        'cta' => $bannerMode === 'home'
            ? 'Mua Sắm Ngay'
            : 'Xem Sản Phẩm',
        'href' => $bannerMode === 'home'
            ? 'index.php?controller=category&action=index'
            : '#products',
    ],

    [
        'image' => '/web-ban-hang/website/app/views/imgs/image.png',
        'alt' => 'Điện thoại thông minh',
        'tag' => 'NEW',
        'title' => $bannerMode === 'home'
            ? 'Smartphone Flagship 2026'
            : 'Smartphone Thế Hệ Mới',
        'desc' => $bannerMode === 'home'
            ? 'Trải nghiệm màn hình Dynamic AMOLED 120Hz, camera 200MP...'
            : 'Những mẫu smartphone mới nhất từ Apple, Samsung, Xiaomi và nhiều thương hiệu nổi tiếng.',
        'cta' => 'Khám Phá Ngay',
        'href' => $bannerMode === 'home'
            ? 'index.php?controller=category&action=index'
            : '#products',
    ],

    [
        'image' => '/web-ban-hang/website/app/views/imgs/banner2.png',
        'alt' => 'Laptop chính hãng',
        'tag' => 'NEW',
        'title' => 'Laptop Chính Hãng',
        'desc' => $bannerMode === 'home'
            ? 'MacBook, Dell XPS, Asus ROG — giá ưu đãi nhất thị trường.'
            : 'MacBook, Dell, ASUS, Lenovo và nhiều mẫu laptop phù hợp cho học tập, làm việc và giải trí.',
        'cta' => $bannerMode === 'home'
            ? 'Xem Ngay'
            : 'Xem Laptop',
        'href' => $bannerMode === 'home'
            ? 'index.php?controller=category&action=index'
            : '#products',
    ],
];
?>


<style>
    /* =========================================================
   PREMIUM LED BORDER
========================================================= */

    .tech-banner {
        position: relative;
        isolation: isolate;

        border-radius: 20px;

        background: white;

        /* khoảng cách để LED không bị cắt */
        margin: 3px;

        box-shadow:
            0 10px 35px rgba(15, 23, 42, 0.06);
    }


    /* =========================================================
   LED CHẠY QUANH VIỀN
========================================================= */

    .tech-banner::before {

        content: "";

        position: absolute;

        inset: -2px;

        border-radius: 22px;

        background: conic-gradient(from 0deg,

                transparent 0deg,
                transparent 20deg,

                #2563eb 55deg,
                #60a5fa 90deg,

                transparent 130deg,
                transparent 190deg,

                #2563eb 230deg,
                #60a5fa 270deg,

                transparent 315deg,
                transparent 360deg);

        animation:
            techLedRotate 3s linear infinite;

        z-index: -2;
    }


    /* =========================================================
   LỚP CHE GIỮA
========================================================= */

    .tech-banner::after {

        content: "";

        position: absolute;

        inset: 2px;

        border-radius: 18px;

        background: white;

        z-index: -1;
    }


    /* =========================================================
   LED ROTATE
========================================================= */

    @keyframes techLedRotate {

        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }

    }


    /* =========================================================
   LED GLOW
========================================================= */

    .tech-banner-led-glow {

        position: absolute;

        inset: -5px;

        border-radius: 25px;

        pointer-events: none;

        background: transparent;

        box-shadow:
            0 0 12px rgba(37, 99, 235, 0.12);

        z-index: -3;
    }


    /* =========================================================
   SLIDER DOT
========================================================= */

    .slider-dot {

        width: 7px;

        height: 7px;

        border-radius: 9999px;

        background: #cbd5e1;

        cursor: pointer;

        transition:
            all 0.3s ease;
    }


    .slider-dot:hover {

        background: #60a5fa;

    }


    .slider-dot.active {

        width: 24px;

        background: #2563eb;

        box-shadow:
            0 0 8px rgba(37, 99, 235, 0.45);

    }


    /* =========================================================
   IMAGE HOVER
========================================================= */

    .tech-banner-image {

        transition:
            transform 0.5s ease;
    }


    .slide:hover .tech-banner-image {

        transform:
            scale(1.03);

    }


    /* =========================================================
   ACCESSIBILITY
========================================================= */

    @media (prefers-reduced-motion: reduce) {

        .tech-banner::before {

            animation: none;

        }

        .tech-banner-image {

            transition: none;

        }

    }
</style>


<!-- =========================================================
     PREMIUM TECH STORE BANNER
========================================================= -->

<div
    class="
        tech-banner
        relative
        w-full
        overflow-hidden

        min-h-[300px]
        sm:min-h-[360px]
        lg:min-h-[420px]
    ">

    <!-- LED GLOW -->

    <div class="tech-banner-led-glow"></div>


    <!-- =====================================================
         SLIDER TRACK
    ====================================================== -->

    <div
        id="sliderTrack"

        class="
            flex

            w-full

            min-h-[300px]
            sm:min-h-[360px]
            lg:min-h-[420px]

            transition-transform
            duration-700
            ease-in-out
        ">

        <?php foreach ($bannerSlides as $slide): ?>

            <div
                class="
                    slide

                    flex-shrink-0

                    w-full

                    min-h-[300px]
                    sm:min-h-[360px]
                    lg:min-h-[420px]
                ">

                <div
                    class="
                        flex
                        flex-col
                        md:flex-row

                        w-full
                        h-full

                        min-h-[300px]
                        sm:min-h-[360px]
                        lg:min-h-[420px]
                    ">

                    <!-- =================================================
                         CONTENT
                    ================================================== -->

                    <div
                        class="
                            flex
                            flex-col
                            justify-center

                            w-full
                            md:w-1/2
                            lg:w-[45%]

                            px-6
                            sm:px-10
                            lg:px-16

                            py-10

                            bg-white
                        ">

                        <!-- TAG -->

                        <span
                            class="
                                inline-flex

                                w-fit

                                mb-4

                                text-xs
                                font-semibold

                                uppercase
                                tracking-[0.2em]

                                text-blue-600
                            ">
                            <?php
                            echo htmlspecialchars(
                                $slide['tag']
                            );
                            ?>
                        </span>


                        <!-- TITLE -->

                        <h2
                            class="
                                text-3xl
                                sm:text-4xl
                                lg:text-5xl

                                font-bold

                                leading-[1.1]

                                text-slate-900

                                mb-4
                            ">
                            <?php
                            echo htmlspecialchars(
                                $slide['title']
                            );
                            ?>
                        </h2>


                        <!-- DESCRIPTION -->

                        <p
                            class="
                                max-w-lg

                                text-sm
                                sm:text-base

                                leading-relaxed

                                text-slate-500

                                mb-7
                            ">
                            <?php
                            echo htmlspecialchars(
                                $slide['desc']
                            );
                            ?>
                        </p>


                        <!-- CTA -->

                        <a
                            href="<?php
                                    echo htmlspecialchars(
                                        $slide['href']
                                    );
                                    ?>"

                            class="
                                inline-flex
                                items-center
                                justify-center

                                w-fit

                                px-6
                                py-3

                                rounded-xl

                                bg-blue-600
                                hover:bg-blue-700

                                text-white

                                text-sm
                                font-medium

                                shadow-sm
                                hover:shadow-md

                                transition-all
                                duration-200
                            ">

                            <?php
                            echo htmlspecialchars(
                                $slide['cta']
                            );
                            ?>


                            <svg
                                class="
                                    w-4
                                    h-4
                                    ml-2
                                "

                                xmlns="http://www.w3.org/2000/svg"

                                fill="none"

                                viewBox="0 0 24 24"

                                stroke-width="2"

                                stroke="currentColor">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"

                                    d="
                                        M13.5 4.5
                                        L21 12
                                        m0 0
                                        l-7.5 7.5
                                        M21 12
                                        H3
                                    " />

                            </svg>

                        </a>

                    </div>


                    <!-- =================================================
                         IMAGE
                    ================================================== -->

                    <div
                        class="
                            relative

                            w-full
                            md:w-1/2
                            lg:w-[55%]

                            min-h-[200px]
                            sm:min-h-[240px]
                            md:min-h-0

                            flex
                            items-center
                            justify-center

                            bg-slate-50

                            p-6
                            sm:p-8
                            lg:p-10
                        ">

                        <img
                            src="<?php
                                    echo htmlspecialchars(
                                        $slide['image']
                                    );
                                    ?>"

                            alt="<?php
                                    echo htmlspecialchars(
                                        $slide['alt']
                                    );
                                    ?>"

                            class="
                                tech-banner-image

                                max-w-full
                                max-h-full

                                w-auto
                                h-auto

                                object-contain

                                rounded-xl
                            " />

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>


    <!-- =========================================================
         PREVIOUS BUTTON
    ========================================================== -->

    <button
        id="sliderPrev"

        type="button"

        aria-label="Slide trước"

        class="
            absolute

            left-3
            sm:left-5

            top-1/2

            -translate-y-1/2

            z-20

            flex
            items-center
            justify-center

            w-9
            h-9
            sm:w-10
            sm:h-10

            rounded-xl

            border
            border-slate-200

            bg-white/90

            backdrop-blur-sm

            text-slate-500

            hover:text-blue-600

            hover:border-blue-600

            shadow-sm

            transition-all
            duration-200
        ">

        <svg
            class="w-5 h-5"

            xmlns="http://www.w3.org/2000/svg"

            fill="none"

            viewBox="0 0 24 24"

            stroke-width="2"

            stroke="currentColor">

            <path
                stroke-linecap="round"
                stroke-linejoin="round"

                d="
                    M15.75 19.5
                    L8.25 12
                    l7.5-7.5
                " />

        </svg>

    </button>


    <!-- =========================================================
         NEXT BUTTON
    ========================================================== -->

    <button
        id="sliderNext"

        type="button"

        aria-label="Slide sau"

        class="
            absolute

            right-3
            sm:right-5

            top-1/2

            -translate-y-1/2

            z-20

            flex
            items-center
            justify-center

            w-9
            h-9
            sm:w-10
            sm:h-10

            rounded-xl

            border
            border-slate-200

            bg-white/90

            backdrop-blur-sm

            text-slate-500

            hover:text-blue-600

            hover:border-blue-600

            shadow-sm

            transition-all
            duration-200
        ">

        <svg
            class="w-5 h-5"

            xmlns="http://www.w3.org/2000/svg"

            fill="none"

            viewBox="0 0 24 24"

            stroke-width="2"

            stroke="currentColor">

            <path
                stroke-linecap="round"
                stroke-linejoin="round"

                d="
                    M8.25 4.5
                    l7.5 7.5
                    -7.5 7.5
                " />

        </svg>

    </button>


    <!-- =========================================================
         DOTS
    ========================================================== -->

    <div
        id="sliderDots"

        class="
            absolute

            bottom-5

            left-1/2

            -translate-x-1/2

            z-20

            flex
            items-center

            gap-2
        ">

        <?php
        for (
            $i = 0;
            $i < count($bannerSlides);
            $i++
        ):
        ?>

            <div
                class="
                    slider-dot

                    <?php
                    echo $i === 0
                        ? 'active'
                        : '';
                    ?>
                "

                data-dot="<?php echo $i; ?>"></div>

        <?php endfor; ?>

    </div>

</div>


<!-- =========================================================
     JAVASCRIPT SLIDER
========================================================== -->

<script>
    (function() {

        const track =
            document.getElementById(
                'sliderTrack'
            );

        if (!track) return;


        const slides =
            track.querySelectorAll(
                '.slide'
            );


        const dots =
            document.querySelectorAll(
                '[data-dot]'
            );


        const btnNext =
            document.getElementById(
                'sliderNext'
            );


        const btnPrev =
            document.getElementById(
                'sliderPrev'
            );


        const total =
            slides.length;


        let current = 0;

        let autoTimer = null;


        /* =====================================================
           GO TO
        ====================================================== */

        function goTo(index) {

            if (total <= 0) return;


            current =
                (index + total) % total;


            track.style.transform =
                'translateX(-' +
                (current * 100) +
                '%)';


            dots.forEach(
                function(dot, i) {

                    dot.classList.toggle(
                        'active',
                        i === current
                    );

                }
            );

        }


        /* =====================================================
           NEXT
        ====================================================== */

        function next() {

            goTo(
                current + 1
            );

        }


        /* =====================================================
           PREVIOUS
        ====================================================== */

        function prev() {

            goTo(
                current - 1
            );

        }


        /* =====================================================
           AUTO PLAY
        ====================================================== */

        function startAuto() {

            clearInterval(
                autoTimer
            );


            autoTimer =
                setInterval(
                    next,
                    3500
                );

        }


        function resetAuto() {

            startAuto();

        }


        /* =====================================================
           NEXT EVENT
        ====================================================== */

        if (btnNext) {

            btnNext.addEventListener(
                'click',
                function() {

                    next();

                    resetAuto();

                }
            );

        }


        /* =====================================================
           PREVIOUS EVENT
        ====================================================== */

        if (btnPrev) {

            btnPrev.addEventListener(
                'click',
                function() {

                    prev();

                    resetAuto();

                }
            );

        }


        /* =====================================================
           DOT EVENTS
        ====================================================== */

        dots.forEach(
            function(dot, index) {

                dot.addEventListener(
                    'click',
                    function() {

                        goTo(index);

                        resetAuto();

                    }
                );

            }
        );


        /* =====================================================
           PAUSE KHI HOVER
        ====================================================== */

        const banner =
            document.querySelector(
                '.tech-banner'
            );


        if (banner) {

            banner.addEventListener(
                'mouseenter',
                function() {

                    clearInterval(
                        autoTimer
                    );

                }
            );


            banner.addEventListener(
                'mouseleave',
                function() {

                    startAuto();

                }
            );

        }


        /* =====================================================
           START
        ====================================================== */

        goTo(0);

        startAuto();

    })();
</script>