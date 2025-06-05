<?php
defined('C5_EXECUTE') or die('Access Denied.');
/** @var Application\Block\Hero\Controller $controller */

$page = $this->controller->get('page');
$buttonLinkTarget = starts_with($controller->get('buttonLinkUrl'), 'http') ? '_blank' : '_self';
?>
<span class="!text-aesatao-300"></span>
<section
        class="wrapper image-wrapper bg-image bg-overlay !bg-fixed bg-no-repeat bg-[center_center] bg-cover relative z-0 before:content-[''] before:block before:absolute before:z-[1] before:w-full before:h-full before:left-0 before:top-0 before:bg-[rgba(30,34,40,.6)]"
        data-image-src="<?php echo $this->controller->get('image'); ?>">
    <div class="container pt-28 pb-20 sm:!py-28 xxl:!py-40">
        <div class="flex flex-wrap mx-[-15px]">
            <div class="xl:w-8/12 lg:w-8/12 md:w-8/12 sm:w-8/12 xxl:w-8/12 w-full flex-[0_0_auto] px-[15px] max-w-full xsm:!text-center text-left <?php if($textColor === 'dark') : ?> !text-gray-700 <?php else: ?> !text-white <?php endif; ?>">
                <h2 class="!text-[0.8rem] uppercase inline-flex !leading-[1.35] text-line relative align-top !pl-[1.4rem] !tracking-[0.02rem] before:content-[''] before:absolute before:inline-block before:translate-y-[-60%] before:w-3 before:h-[0.05rem] before:left-0 before:top-2/4 before:bg-[#ffffff] !text-white !mb-3">
                    <?php echo $controller->get('title'); ?>
                </h2>
                <h3 class="!text-[calc(1.315rem_+_0.78vw)] font-bold xl:!text-[1.9rem] !leading-[1.25] !mb-6 !text-white xxl:!pr-32">
                    <?php echo $controller->get('heading'); ?>
                </h3>
                <div class="lead text-[1.15rem] !leading-[1.5] font-medium mb-7 lg:pr-5 xl:pr-5 xxl:pr-0">
                    <?php echo $controller->get('description'); ?>
                </div>
                <?php if($controller->get('buttonCaption') && $controller->get('buttonLinkUrl')) : ?>
                    <div class="mt-8">
                        <a href="<?php echo $controller->get('buttonLinkUrl'); ?>"
                           target="<?php echo $controller->get('buttonLinkTarget'); ?>"
                           class="btn btn-lg <?php if(starts_with($controller->get('buttonLinkUrl'), '#')) : ?>scroll<?php endif; ?> <?php if($textColor === 'dark') : ?>  !text-white !bg-[#343f52] border-[#343f52]<?php else: ?> !text-[#343f52] !bg-white !border-white <?php endif; ?> hover:text-white hover:bg-[#343f52] hover:border-[#343f52] focus:shadow-[rgba(82,92,108,1)] active:text-white active:bg-[#343f52] active:border-[#343f52] disabled:text-white disabled:bg-[#343f52] disabled:border-[#343f52] rounded">
                            <?php echo $controller->get('buttonCaption'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>