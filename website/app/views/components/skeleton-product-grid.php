<?php
/** @var int $skeletonCount Number of skeleton cards (default 4) */
$skeletonCount = $skeletonCount ?? 4;
?>
<div class="ds-skeleton-grid grid grid-cols-1 min-[375px]:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5" aria-hidden="true" role="presentation">
    <?php for ($i = 0; $i < $skeletonCount; $i++) {
        include __DIR__ . '/skeleton-product-card.php';
    } ?>
</div>
