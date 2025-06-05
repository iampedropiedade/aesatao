<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\File\File;
use Concrete\Core\Page\Page;
use Application\Service\Picture;

assert(isset($item, $index));

if(isset($item['image_id']) && $item['image_id']) {
    $file = File::getByID($item['image_id']);
    $image = new Picture($file);
}
if(isset($item['cta_page_id']) && $item['cta_page_id']) {
    $ctaPage = Page::getByID($item['cta_page_id']);
}
?>
<div class="swiper-slide banner-slider-item py-64 anim">
    <div class="container">
        <div class="row items-center">
            <div class="col-lg-12">
                <div class="hero-content relative z-20">
                    <h4 class="h4 uppercase font-normal text-dark mb-0 block anim-item anim-slide-right anim-delay-1"><?php echo $item['heading']; ?></h4>
                    <h1 class="text-5xl/tight lg:text-6xl/tight font-semibold sm:font-bold mb-6 anim-item anim-slide-right anim-delay-3"><?php echo $item['title']; ?></h1>
                    <p class="text-dark anim-item anim-slide-right anim-delay-6"><?php echo $item['content']; ?></p>
                    <?php if (isset($ctaPage) && $ctaPage) : ?>
                        <div class="anim-item relative w-fit mt-12 anim-slide-right anim-delay-8">
                            <a class="btn btn-banner" href="<?php echo $ctaPage->getCollectionPath(); ?>"><?php echo $item['cta_caption'] ?: $ctaPage->getCollectionName(); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if (isset($image) && $image) : ?>
                    <div class="banner-gradient">
                        <img src="<?php echo $image->getSrc(2600, 700, true) ?>"
                             alt="<?php echo $item['title']; ?>"
                             class="z-10 absolute left-0 top-0 w-full h-full object-cover"
                             width="1550"
                             height="600"
                        >
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
