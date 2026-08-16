<article class="product-card-item group flex flex-col rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden">
    <a href="index.php?controller=chi_tiet&action=index&id=<?php echo $row['id']; ?>"
        class="product-img-wrap relative block aspect-square bg-slate-50 p-4 sm:p-5 flex items-center justify-center overflow-hidden">
        <span class="badge-new absolute top-2.5 left-2.5 z-10 text-[10px] font-semibold uppercase tracking-wide text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md">NEW</span>
        <span class="badge-hot absolute top-2.5 left-2.5 z-10 text-[10px] font-semibold uppercase tracking-wide text-amber-600 bg-amber-50 px-2 py-0.5 rounded-md border border-amber-100">HOT</span>
        <span class="badge-sale absolute top-2.5 left-2.5 z-10 text-[10px] font-semibold uppercase tracking-wide text-green-600 bg-green-50 px-2 py-0.5 rounded-md border border-green-100">SALE</span>
        <img src="/web-ban-hang/public/uploads/<?php echo $row['hinh_anh']; ?>"
            alt="<?php echo htmlspecialchars($row['ten_san_pham']); ?>"
            class="w-full h-full object-contain transition-transform duration-300 group-hover:scale-105" />
    </a>

    <div class="p-4 flex flex-col flex-1 border-t border-slate-100">
        <h3 class="text-sm font-medium text-slate-900 line-clamp-2 leading-snug mb-2 min-h-[2.5rem]">
            <a href="index.php?controller=chi_tiet&action=index&id=<?php echo $row['id']; ?>"
                class="hover:text-blue-600 transition-colors duration-200 focus:outline-none">
                <?php echo htmlspecialchars($row['ten_san_pham']); ?>
            </a>
        </h3>

        <div class="mt-auto">
            <div class="product-price-wrap mb-3">
                <span class="price-sale text-blue-600 font-semibold text-base">
                    <?= number_format($row['gia'], 0, ',', '.') ?> ₫
                </span>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <a href="index.php?controller=chi_tiet&action=them_gio_hang&id=<?php echo $row['id']; ?>"
                    class="ds-btn-primary flex items-center justify-center gap-1 py-2 px-2 text-xs h-auto min-h-[36px]"
                    aria-label="Thêm <?php echo htmlspecialchars($row['ten_san_pham']); ?> vào giỏ">
                    <svg class="w-3.5 h-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1 5h12m-9 0a1 1 0 100 2 1 1 0 000-2zm8 0a1 1 0 100 2 1 1 0 000-2z" />
                    </svg>
                    Giỏ
                </a>
                <a href="index.php?controller=buy&action=index&id=<?php echo $row['id']; ?>"
                    class="ds-btn-success flex items-center justify-center gap-1 py-2 px-2 text-xs h-auto min-h-[36px]"
                    aria-label="Mua ngay <?php echo htmlspecialchars($row['ten_san_pham']); ?>">
                    Mua ngay
                </a>
            </div>
        </div>
    </div>
</article>