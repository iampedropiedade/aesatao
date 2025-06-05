<section class="wrapper  bg-[#21262c] opacity-100 mt-[-4.5rem]">
    <div class="swiper-container !h-[75vh] !min-h-[700px] dots-over relative z-10 swiper-container-0"
         data-margin="0"
         data-autoplay="true"
         data-autoplaytime="7000"
         data-nav="true"
         data-dots="true"
         data-items="1"
    >
        <div class="swiper">
            <div class="swiper-wrapper" aria-live="off">
                <?php foreach($this->controller->get('items') as $key=>$item) : ?>
                    <?php $this->inc('elements/banner/slide.php', ['item' => $item, 'index'=>$key]); ?>
                <?php endforeach; ?>
            </div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
        </div>
        <div class="swiper-controls">
        </div>
    </div>
</section>
