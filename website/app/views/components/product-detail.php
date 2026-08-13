<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">

    <!-- ===================== -->
    <!-- LEFT: PRODUCT IMAGE -->
    <!-- ===================== -->
    <div class="space-y-4">

        <div class="relative aspect-square bg-white rounded-2xl border border-ink-200 overflow-hidden shadow-soft group">

            <!-- Previous -->
            <button id="prv"
                type="button"
                class="absolute left-4 top-1/2 -translate-y-1/2 z-10
                       w-10 h-10 flex items-center justify-center
                       rounded-full bg-white/95 border border-ink-200
                       text-ink-600 hover:text-primary-500
                       hover:border-primary-200 shadow-soft
                       transition-all hover:scale-105 active:scale-95"
                aria-label="Previous image">

                <svg xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="3">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19l-7-7 7-7" />

                </svg>
            </button>


            <!-- Product Image -->
            <img id="imgs"
                src="/web-ban-hang/admin/public/uploads/<?php echo $list_san_pham['hinh_anh']; ?>"
                alt="<?php echo htmlspecialchars($list_san_pham['ten_san_pham']); ?>"
                class="w-full h-full object-contain p-8
                       transition-transform duration-500
                       group-hover:scale-105">


            <!-- Next -->
            <button id="next"
                type="button"
                class="absolute right-4 top-1/2 -translate-y-1/2 z-10
                       w-10 h-10 flex items-center justify-center
                       rounded-full bg-white/95 border border-ink-200
                       text-ink-600 hover:text-primary-500
                       hover:border-primary-200 shadow-soft
                       transition-all hover:scale-105 active:scale-95"
                aria-label="Next image">

                <svg xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="3">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 5l7 7-7 7" />

                </svg>

            </button>

        </div>


        <!-- Image note -->
        <div class="flex items-center justify-center gap-2 text-xs text-ink-400">
            <svg xmlns="http://www.w3.org/2000/svg"
                width="15"
                height="15"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14" />

            </svg>

            Hình ảnh sản phẩm chính hãng
        </div>

    </div>



    <!-- ===================== -->
    <!-- RIGHT: PRODUCT INFO -->
    <!-- ===================== -->
    <div class="flex flex-col">

        <!-- Category -->
        <div class="mb-3">

            <span class="inline-flex items-center px-3 py-1
                         text-[11px] font-bold uppercase
                         tracking-widest
                         text-primary-600
                         bg-primary-50
                         border border-primary-100
                         rounded-lg">

                <?php echo $list_san_pham['ten_loai'] ?? 'Danh mục'; ?>

            </span>

        </div>


        <!-- Product name -->
        <h1 class="text-2xl sm:text-3xl lg:text-4xl
                   font-extrabold text-ink-900
                   leading-tight tracking-tight">

            <?php echo htmlspecialchars($list_san_pham['ten_san_pham']); ?>

        </h1>


        <!-- Rating -->
        <div class="flex items-center gap-3 mt-3 mb-5">

            <div class="flex text-amber-400 text-sm">
                ★★★★★
            </div>

            <span class="text-sm text-ink-400">
                Đánh giá sản phẩm
            </span>

        </div>


        <!-- Price -->
        <div class="pb-6 border-b border-ink-100">

            <p class="text-sm text-ink-400 mb-1">
                Giá sản phẩm
            </p>

            <div class="flex items-end gap-3">

                <span class="text-3xl sm:text-4xl font-extrabold text-primary-600">

                    <?= number_format(
                        $list_san_pham['gia'] ?? 0,
                        0,
                        ',',
                        '.'
                    ) ?>

                    ₫

                </span>

            </div>

        </div>


        <!-- Stock -->
        <div class="flex items-center gap-3 py-5">

            <span class="flex items-center gap-2
                         px-3 py-1.5
                         rounded-lg
                         bg-emerald-50
                         text-emerald-600
                         border border-emerald-100
                         text-xs font-bold">

                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>

                Còn hàng

            </span>

            <span class="text-xs text-ink-400">
                Sản phẩm chính hãng
            </span>

        </div>


        <!-- Buttons -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">

            <!-- Add cart -->
            <a href="index.php?controller=chi_tiet&action=them_gio_hang&id=<?php echo $list_san_pham['id']; ?>"
                class="h-12 flex items-center justify-center
                       gap-2 rounded-xl
                       border-2 border-primary-500
                       text-primary-600
                       font-bold text-sm
                       hover:bg-primary-50
                       active:scale-[0.98]
                       transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2.5">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />

                </svg>

                Thêm vào giỏ

            </a>


            <!-- Buy -->
            <a href="index.php?controller=buy&action=index&id=<?php echo $list_san_pham['id']; ?>"
                class="h-12 flex items-center justify-center
                       gap-2 rounded-xl
                       bg-primary-500
                       hover:bg-primary-600
                       text-white
                       font-bold text-sm
                       shadow-md
                       hover:shadow-lg
                       active:scale-[0.98]
                       transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2.5">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M13 10V3L4 14h7v7l9-11h-7z" />

                </svg>

                Mua ngay

            </a>

        </div>


        <!-- Benefits -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

            <!-- Warranty -->
            <div class="flex gap-3 p-4
                        rounded-xl
                        bg-surface
                        border border-ink-100">

                <div class="w-10 h-10 shrink-0
                            flex items-center justify-center
                            rounded-lg
                            bg-emerald-50
                            text-emerald-600">

                    ✓

                </div>

                <div>

                    <p class="text-sm font-bold text-ink-900">
                        Bảo hành chính hãng
                    </p>

                    <p class="text-xs text-ink-500 mt-1">
                        12 tháng toàn quốc
                    </p>

                </div>

            </div>


            <!-- Return -->
            <div class="flex gap-3 p-4
                        rounded-xl
                        bg-surface
                        border border-ink-100">

                <div class="w-10 h-10 shrink-0
                            flex items-center justify-center
                            rounded-lg
                            bg-primary-50
                            text-primary-500">

                    ↩

                </div>

                <div>

                    <p class="text-sm font-bold text-ink-900">
                        Đổi trả 30 ngày
                    </p>

                    <p class="text-xs text-ink-500 mt-1">
                        Hỗ trợ nếu sản phẩm lỗi
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- ================================= -->
<!-- PRODUCT DESCRIPTION -->
<!-- ================================= -->

<div class="mt-10 pt-8 border-t border-ink-200">

    <!-- MÔ TẢ SẢN PHẨM -->
    <div class="xl:col-span-2 w-full mt-8 pt-8 border-t border-ink-200">

        <!-- Header -->
        <div class="flex items-center gap-3 mb-6">

            <div class="
            flex h-11 w-11 shrink-0
            items-center justify-center
            rounded-xl
            bg-primary-50
            text-primary-500
            border border-primary-100
        ">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                </svg>
            </div>

            <div>
                <p class="
                text-xs
                font-bold
                uppercase
                tracking-widest
                text-primary-500
            ">
                    Thông tin sản phẩm
                </p>

                <h2 class="
                text-xl sm:text-2xl
                font-extrabold
                text-ink-900
                leading-tight
            ">
                    Mô tả sản phẩm
                </h2>
            </div>

        </div>


        <!-- Nội dung mô tả -->
        <div class="
        product-description
        w-full

        text-sm sm:text-base
        leading-7
        font-medium
        text-ink-600

        [&>p]:mb-5
        [&>p:last-child]:mb-0

        [&>h2]:mt-8
        [&>h2]:mb-4
        [&>h2]:text-xl
        [&>h2]:font-extrabold
        [&>h2]:text-ink-900

        [&>h3]:mt-7
        [&>h3]:mb-3
        [&>h3]:text-lg
        [&>h3]:font-extrabold
        [&>h3]:text-ink-900

        [&>h4]:mt-6
        [&>h4]:mb-2
        [&>h4]:font-bold
        [&>h4]:text-ink-900


        /* UL - 3 thông tin / dòng */
        [&_ul]:grid
        [&_ul]:grid-cols-1
        sm:[&_ul]:grid-cols-2
        lg:[&_ul]:grid-cols-3
        [&_ul]:gap-3
        [&_ul]:my-6
        [&_ul]:p-0
        [&_ul]:list-none


        /* LI */
        [&_li]:relative
        [&_li]:flex
        [&_li]:items-start
        [&_li]:min-h-0
        [&_li]:px-4
        [&_li]:py-3
        [&_li]:pl-10
        [&_li]:rounded-xl
        [&_li]:border
        [&_li]:border-ink-200
        [&_li]:bg-surface
        [&_li]:text-sm
        [&_li]:leading-6
        [&_li]:text-ink-600


        /* Không để p tạo khoảng cách */
        [&_li_p]:m-0
        [&_li_p]:p-0


        /* CHECK */
        [&_li]:before:content-['✓']
        [&_li]:before:absolute
        [&_li]:before:left-3
        [&_li]:before:top-3
        [&_li]:before:flex
        [&_li]:before:h-5
        [&_li]:before:w-5
        [&_li]:before:items-center
        [&_li]:before:justify-center
        [&_li]:before:rounded-full
        [&_li]:before:bg-emerald-50
        [&_li]:before:text-emerald-500
        [&_li]:before:text-xs
        [&_li]:before:font-bold


        /* BOLD */
        [&_strong]:font-bold
        [&_strong]:text-ink-900

        [&_b]:font-bold
        [&_b]:text-ink-900


        /* IMAGE */
        [&_img]:block
        [&_img]:max-w-full
        [&_img]:h-auto
        [&_img]:mx-auto
        [&_img]:my-6
        [&_img]:rounded-xl


        /* TABLE */
        [&_table]:w-full
        [&_table]:my-6
        [&_table]:border
        [&_table]:border-ink-200
        [&_table]:rounded-xl
        [&_table]:overflow-hidden
        [&_table]:text-sm

        [&_th]:bg-surface
        [&_th]:px-4
        [&_th]:py-3
        [&_th]:text-left
        [&_th]:font-bold
        [&_th]:text-ink-900
        [&_th]:border-b
        [&_th]:border-ink-200

        [&_td]:px-4
        [&_td]:py-3
        [&_td]:border-b
        [&_td]:border-ink-200
    ">

            <?php
            echo $list_san_pham['mo_ta']
                ?? 'Sản phẩm này chưa có mô tả chi tiết.';
            ?>

        </div>

    </div>

</div>