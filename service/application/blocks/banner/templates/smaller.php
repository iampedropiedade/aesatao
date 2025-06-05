<?php
defined('C5_EXECUTE') or die('Access Denied.');
/** @var Application\Block\Hero\Controller $controller */
?>
<section
    class="wrapper image-wrapper bg-image bg-overlay text-white bg-no-repeat bg-[center_center] bg-cover relative z-0 !bg-fixed before:content-[''] before:block before:absolute before:z-[1] before:w-full before:h-full before:left-0 before:top-0 before:bg-[rgba(30,34,40,.5)]"
    data-image-src="<?php echo $this->controller->get('image'); ?>">
    <div class="container pt-36 xl:pt-[12.5rem] lg:pt-[12.5rem] md:pt-[12.5rem] pb-32 xl:pb-40 lg:pb-40 md:pb-40 !text-center">
        <div class="flex flex-wrap mx-[-15px]">
            <div class="md:w-10/12 lg:w-8/12 xl:w-7/12 xxl:w-6/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto">
                <h1 class="text-[calc(1.365rem_+_1.38vw)] font-bold leading-[1.2] xl:text-[2.4rem] text-white !mb-3">
                    <?php echo $controller->get('title'); ?>
                </h1>
                <p class="lead text-[1.05rem] leading-[1.6] font-medium md:!px-3 lg:!px-7 xl:!px-9 xxl:!px-10">
                    <?php echo $controller->get('description'); ?>
                </p>
                <?php if($controller->get('buttonCaption') && $controller->get('buttonLinkToUrl')) : ?>
                    <div>
                        <a href="<?php echo $controller->get('buttonLinkToUrl'); ?>"
                           class="btn btn-lg <?php if($textColor === 'light') : ?>  !text-white !bg-[#343f52] border-[#343f52]<?php else: ?> !text-[#343f52] !bg-white !border-white <?php endif; ?> hover:text-white hover:bg-[#343f52] hover:border-[#343f52] focus:shadow-[rgba(82,92,108,1)] active:text-white active:bg-[#343f52] active:border-[#343f52] disabled:text-white disabled:bg-[#343f52] disabled:border-[#343f52] rounded">
                            <?php echo $controller->get('buttonCaption'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
