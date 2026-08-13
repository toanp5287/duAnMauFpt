<aside class="bg-white rounded-2xl border border-ink-200 p-5 lg:sticky lg:top-28 shadow-soft">
    <h3 class="text-sm font-extrabold uppercase tracking-widest text-ink-800 mb-5">Bộ lọc danh mục</h3>
    <ul class="space-y-1">
        <li>
            <a href="index.php?controller=category&action=index" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-white bg-primary-500 rounded-xl shadow-md transition-colors hover:bg-primary-700">
                <span class="h-2 w-2 rounded-full bg-white"></span>
                Tất cả sản phẩm
            </a>
        </li>
        <?php foreach ($categories as $row) { ?>
            <li>
                <a class="flex items-center justify-between px-4 py-3 text-sm font-medium text-ink-600 rounded-xl hover:bg-primary-50 hover:text-primary-500 transition-colors group border border-transparent hover:border-ink-200" href="index.php?controller=category&action=phan_loai&id=<?php echo $row['id']; ?>">
                    <?php echo $row['ten_loai']; ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="opacity-0 group-hover:opacity-100 transition-opacity text-primary-500 transform group-hover:translate-x-1 duration-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </li>
        <?php } ?>
    </ul>
</aside>
