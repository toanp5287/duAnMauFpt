<article class="product-card-item group flex flex-col bg-white rounded-2xl border border-ink-200 overflow-hidden shadow-soft">
    <a href="index.php?controller=chi_tiet&action=index&id=<?php echo $row['id']; ?>" class="product-img-wrap relative block aspect-square bg-surface p-4 flex items-center justify-center overflow-hidden m-3 mb-0">
        <span class="absolute top-2 left-2 z-10 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
            Hot
        </span>
        <img src="/web-ban-hang/admin/public/uploads/<?php echo $row['hinh_anh']; ?>" alt="<?php echo $row['ten_san_pham']; ?>" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-105" />
    </a>

    <div class="p-4 pt-3 flex flex-col flex-1">
        <p class="text-[10px] font-bold uppercase tracking-widest text-ink-400 mb-1.5">Tech Store</p>
        <h3 class="text-sm font-semibold text-ink-800 line-clamp-2 leading-snug mb-3 min-h-[2.75rem]">
            <a href="index.php?controller=chi_tiet&action=index&id=<?php echo $row['id']; ?>" class="hover:text-primary-500 transition-colors focus:outline-none">
                <?php echo $row['ten_san_pham']; ?>
            </a>
        </h3>

        <div class="mt-auto">
            <div class="product-price-wrap mb-3">
                <span class="price-original"><?= number_format($row['gia'], 0, ',', '.') ?> ₫</span>

            </div>
            <div class="grid grid-cols-2 gap-2">
                <a href="index.php?controller=chi_tiet&action=them_gio_hang&id=<?php echo $row['id']; ?>"
                    class="flex items-center justify-center gap-1.5 py-2.5 text-xs font-bold rounded-xl transition-all duration-200 hover:bg-cta-600 active:scale-[0.98] transition-all shadow-md shadow-cta-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1 5h12m-9 0a1 1 0 100 2 1 1 0 000-2zm8 0a1 1 0 100 2 1 1 0 000-2z" />
                    </svg>
                    Giỏ
                </a>
                <a href="index.php?controller=buy&action=index&id=<?php echo $row['id']; ?>"
                    class="flex items-center justify-center gap-1.5 py-2.5 text-xs font-bold rounded-xl transition-all duration-200 hover:bg-cta-600 active:scale-[0.98] transition-all shadow-md shadow-cta-500/30">
                    Mua ngay
                </a>
            </div>
        </div>
    </div>
</article>