<?php

use Application\Service\Picture;
use Concrete\Core\File\File;

defined('C5_EXECUTE') or die('Access Denied.');
/** @var Application\Block\Hero\Controller $controller */

$imageSrc = null;
if($controller->get('imageId')) {
    $mainImage = File::getByID($controller->get('imageId'));
    if($mainImage) {
        $image = new Picture($mainImage);
        $imageSrc = $image->getSrc(1200, 1200);
    }
}
?>
<section class="wrapper !bg-aesataoAlt-100" style="background-image: url(<?php echo $this->getThemePath() ?>/app/img/patterns/waves8-dark.svg); background-repeat: repeat; background-position: center center; background-size: cover;">
    <div class="container pt-18 xl:pt-[8rem] lg:pt-[8rem] md:pt-[8rem] pb-12 xl:pb-18 lg:pb-18 md:pb-18">
        <div class="card !shadow-[0_0.25rem_1.75rem_rgba(30,34,40,0.07)] !mb-20 xl:!mb-[4.5rem] lg:!mb-[4.5rem] md:!mb-[4.5rem] bg-">
            <div class="flex flex-wrap mx-0">
                <?php if($imageSrc) : ?>
                    <div class="xl:w-6/12 lg:w-6/12 w-full flex-[0_0_auto] max-w-full image-wrapper bg-image rounded-t-[0.4rem] rounded-lg-start hidden xl:block lg:block md:block bg-cover bg-[center_center] bg-no-repeat !bg-scroll md:min-h-[25rem]"
                         data-image-src="<?php echo $imageSrc; ?>"
                    >
                    </div>
                <?php endif; ?>
                <div class="xl:w-6/12 lg:w-6/12 w-full flex-[0_0_auto] max-w-full">
                    <div class="p-10 md:!p-12 xl:!p-[4rem] lg:!p-[4rem]">
                        <h2 class="xl:!text-[2rem] !text-[calc(1.325rem_+_0.9vw)] !leading-[1.2] tracking-normal !mb-3">
                            <?php echo $controller->get('title'); ?>
                        </h2>
                        <h5 class="lead !text-[1.05rem] !leading-[1.6] font-medium">
                            <?php echo $controller->get('heading'); ?>
                        </h5>
                        <div>
                            <?php echo $controller->get('description'); ?>
                        </div>
                        <?php if($controller->get('buttonCaption') && $controller->get('buttonLinkUrl')) : ?>
                            <a href="<?php echo $controller->get('buttonLinkUrl'); ?>"
                               target="<?php echo $controller->get('buttonLinkTarget'); ?>"
                               class="btn btn-violet !text-white !bg-aesataoAlt border-aesataoAlt hover:text-white hover:bg-aesataoAlt hover:!border-aesataoAlt   active:text-white active:bg-aesataoAlt active:border-aesataoAlt disabled:text-white disabled:bg-aesataoAlt disabled:border-aesataoAlt  !rounded-[50rem] !mt-2 hover:translate-y-[-0.15rem] hover:shadow-[0_0.25rem_0.75rem_rgba(30,34,40,0.15)]">
                                <?php echo $controller->get('buttonCaption'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
