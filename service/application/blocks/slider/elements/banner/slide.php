<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\File\File;
use Concrete\Core\Page\Page;
use Application\Service\Picture;

assert(isset($item, $index));

$image = null;
if(isset($item['image_id']) && $item['image_id']) {
    $file = File::getByID($item['image_id']);
    $image = new Picture($file);
}
if($image === null) {
    return;
}
if(isset($item['cta_page_id']) && $item['cta_page_id']) {
    $ctaPage = Page::getByID($item['cta_page_id']);
}
?>
<div class="swiper-slide bg-overlay bg-overlay-400 bg-[#21262c] opacity-100 bg-image !bg-cover !bg-[center_center] !h-[75vh] !min-h-[700px] before:block before:absolute before:z-[1] before:w-full before:h-full before:left-0 before:top-0 before:bg-[rgba(30,34,40,.4)] swiper-slide-prev"
     data-image-src="<?php echo $image->getSrc(2600, 700, true) ?>" role="group">
    <div class="container !h-full">
        <div class="flex flex-wrap mx-[-15px] !h-full">
            <div class="md:w-10/12 md:!ml-[8.33333333%] lg:w-7/12 lg:!ml-0 xl:w-6/12 xxl:w-5/12 w-full flex-[0_0_auto] !px-[15px] max-w-full text-center lg:text-left xl:text-left justify-center self-center items-start">
                <h2 class="xl:!text-[2.8rem] !leading-[1.2] font-bold !text-[calc(1.405rem_+_1.86vw)] !mb-4 !text-white animate__animated animate__slideInDown animate__delay-1s">
                    <?php echo $item['heading']; ?>
                </h2>
                <p class="lead text-[1.15rem] leading-normal !mb-7 !text-white animate__animated animate__slideInRight animate__delay-2s">
                    <?php echo $item['title']; ?>
                </p>
                <?php if (isset($ctaPage) && $ctaPage) : ?>
                    <div class="animate__animated animate__slideInUp animate__delay-3s">
                        <a class="btn btn-lg btn-outline-white !text-white bg-[#ffffff] !border-white !border-[2px] hover:!text-[#343f52] hover:bg-[#ffffff] hover:border-white focus:shadow-[rgba(255,255,255,1)] active:!text-[#343f52] active:bg-[#ffffff] active:border-white disabled:text-white disabled:bg-transparent disabled:border-white !rounded-[50rem]" href="<?php echo $ctaPage->getCollectionPath(); ?>">
                            <?php echo $item['cta_caption'] ?: $ctaPage->getCollectionName(); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
