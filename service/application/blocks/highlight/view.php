<?php
defined('C5_EXECUTE') or die('Access Denied.');


$imageCssClasses = $this->controller->get('align') === 'left' ? 'start-0' : '!right-0';
$dividerCssClasses = $this->controller->get('align') === 'left' ? 'divider-v-end' : 'divider-v-start';
$contentWrapperCssClasses = $this->controller->get('align') === 'left' ? 'ml-auto' : '';
$contentCssClasses = $this->controller->get('align') === 'left' ? 'lg:!pl-20 xl:!pl-20 xxl:!pr-24' : 'xl:pr-20 lg:pr-20';
$polygon = $this->controller->get('align') === 'left' ? '48 0 0 0 48 1200 54 1200 54 0 48 0' : '6 0 0 0 0 1200 6 1200 54 0 6 0';
?>
<section class="wrapper bg-[rgba(246,247,249,1)] !relative min-h-[60vh] lg:flex items-center">
    <?php if($this->controller->get('backgroundImage')) : ?>
        <div
                class="<?php echo $imageCssClasses; ?> xl:w-6/12 lg:w-6/12 w-full flex-[0_0_auto] max-w-full xl:!absolute lg:!absolute top-0 image-wrapper bg-image bg-cover !h-full bg-[center_center] bg-no-repeat bg-scroll z-0 min-h-[25rem] xl:h-auto lg:h-auto"
                data-image-src="<?php echo $this->controller->get('backgroundImage'); ?>">
            <div class="<?php echo $dividerCssClasses; ?> divider text-[#f6f7f9] hidden xl:block lg:block">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54 1200">
                    <g></g>
                    <g><g><polygon fill="currentColor" points="<?php echo $polygon; ?>"></polygon></g></g>
                </svg>
            </div>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="flex flex-wrap mx-0">
            <div class="<?php echo $contentWrapperCssClasses; ?> xl:w-6/12 lg:w-6/12 w-full flex-[0_0_auto] max-w-full">
                <div class="<?php echo $contentCssClasses; ?> pt-[4.5rem] pb-20 xl:pb-[7rem] lg:pb-[7rem] md:pb-[7rem] lg:!py-[6rem] xl:!py-[6rem]">
                    <?php if($this->controller->get('subTitle')) : ?>
                        <h3 class="!text-[.75rem] uppercase text-[#aab0bc] !mb-3 tracking-[0.02rem] !leading-[1.35]"><?php echo $this->controller->get('subTitle'); ?></h3>
                    <?php endif; ?>
                    <?php if($this->controller->get('title')) : ?>
                        <h2 class="xl:text-[2rem] text-[calc(1.325rem_+_0.9vw)] font-bold !leading-[1.25] tracking-[-0.03em] mb-7"><?php echo $this->controller->get('title'); ?></h2>
                    <?php endif; ?>
                    <?php if($this->controller->get('content')) : ?>
                        <?php echo $this->controller->get('content'); ?>
                    <?php endif; ?>
                    <?php if($this->controller->get('buttonCaption') && $this->controller->get('buttonLinkUrl')) : ?>
                        <div class="mt-8">
                            <a href="<?php echo $this->controller->get('buttonLinkUrl'); ?>"
                               class="btn btn-lg scroll !text-white !bg-[#343f52] border-[#343f52] hover:text-white hover:bg-[#343f52] hover:border-[#343f52] focus:shadow-[rgba(82,92,108,1)] active:text-white active:bg-[#343f52] active:border-[#343f52] disabled:text-white disabled:bg-[#343f52] disabled:border-[#343f52] rounded">
                                <?php echo $this->controller->get('buttonCaption'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
