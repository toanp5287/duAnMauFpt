<?php
/** @var int $skeletonCount Number of spec items (default 6) */
$skeletonCount = $skeletonCount ?? 6;
?>
<div class="ds-skeleton-spec grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3 sm:gap-4" aria-hidden="true" role="presentation">
    <?php for ($i = 0; $i < $skeletonCount; $i++) : ?>
        <div class="flex items-start gap-3 p-4 bg-slate-50 border border-slate-200 rounded-xl animate-pulse">
            <div class="shrink-0 w-9 h-9 rounded-lg bg-slate-200"></div>
            <div class="flex-1 space-y-2">
                <div class="h-3 bg-slate-200 rounded w-1/3"></div>
                <div class="h-4 bg-slate-200 rounded w-2/3"></div>
            </div>
        </div>
    <?php endfor; ?>
</div>
