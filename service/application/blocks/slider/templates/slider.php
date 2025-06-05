<?php
defined('C5_EXECUTE') or die('Access Denied.');
if(!is_array($this->controller->get('items')) || $this->controller->get('items') === 0) {
    return;
}
?>
<section
    <?php if($this->controller->get('anchor')) : ?>
        id="<?php echo $this->controller->get('anchor'); ?>"
    <?php endif; ?>
>
    <div class="banner-slider swiper relative">
        <div class="swiper-wrapper">
            <?php foreach($this->controller->get('items') as $key=>$item) : ?>
                <?php $this->inc('elements/view/' . $item['type'] . '.php', ['item' => $item, 'index'=>$key]); ?>
            <?php endforeach; ?>
        </div>
        <div class="swiper-navigation">
            <button type="button" class="prev-arrow" title="prev navigation button"><span class="sr-only">see previous slide</span>
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <button type="button" class="next-arrow" title="next navigation button"><span class="sr-only">see next slide</span>
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </div>
    <div class="container">
        <div class="swiper banner-nav-slider">
            <div class="swiper-wrapper">
                <?php foreach($this->controller->get('items') as $key=>$item) : ?>
                    <?php $this->inc('elements/view/' . $item['type'] . '_nav_button.php', ['item' => $item, 'index'=>$key]); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>