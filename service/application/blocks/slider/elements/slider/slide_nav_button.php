<?php
defined('C5_EXECUTE') or die('Access Denied.');
assert(isset($item, $index));
?>
<div class="swiper-slide">
    <button type="button" title="<?php echo $item['nav_title'] ?? ''; ?>" style="width: 100%">
        <i class="fa-regular <?php echo $item['nav_icon'] ?? ''; ?> mr-4 fa-2xl"></i>
        <span><?php echo $item['nav_title'] ?: $item['title']; ?></span>
    </button>
</div>