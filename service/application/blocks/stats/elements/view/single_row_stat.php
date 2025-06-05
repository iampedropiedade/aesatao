<?php
defined('C5_EXECUTE') or die('Access Denied.');
assert(isset($item, $index));
?>
<div class="xl:w-4/12 lg:w-4/12 md:w-4/12 w-full flex-[0_0_auto] !px-[15px] !mt-[30px] max-w-full">
    <h3
        class="counter counter-lg !text-[calc(1.35rem_+_1.2vw)] !tracking-[normal] !leading-none !mb-[.5rem] xl:!text-[2.25rem] ">
        <?php echo $item['stat']; ?></h3>
    <p class="font-medium !mb-0"><?php echo $item['title']; ?></p>
</div>