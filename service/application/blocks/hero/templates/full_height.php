<?php
defined('C5_EXECUTE') or die('Access Denied.');
/** @var Application\Block\Hero\Controller $controller */

$textColor = $controller->get('navbarStyle') === 'navbar-light' ? 'light' : 'dark';
?>
<section
    class="w-full h-screen bg-cover"
    style="background: url(<?php echo $this->controller->get('image'); ?>) no-repeat center center fixed; box-shadow: inset 0 0 0 100vw rgba(0,0,0,0.6); background-size: cover;">
    <div class="container pt-28 pb-20 sm:!py-28 xxl:!py-40">
        <div class="flex flex-wrap mx-[-15px]">
            <div class="xl:w-8/12 lg:w-8/12 md:w-8/12 sm:w-8/12 xxl:w-8/12 w-full flex-[0_0_auto] px-[15px] max-w-full xsm:!text-center text-left <?php if($textColor === 'light') : ?> !text-gray-200 <?php else: ?> !text-white <?php endif; ?>">
                <h2 class="drop-shadow-md xl:text-[2.8rem] text-[calc(1.405rem_+_1.86vw)] font-bold !leading-[1.2] tracking-[-0.035em] mb-4 mt-0 xl:!mt-5 lg:!mt-5 xl:pr-5 xxl:pr-0 <?php if($textColor === 'light') : ?> !text-gray-200 <?php else: ?> !text-white <?php endif; ?>">
                    <?php echo $controller->get('title'); ?>
                </h2>
                <h3 class="!text-[calc(1.315rem_+_0.78vw)] font-bold xl:!text-[1.9rem] !leading-[1.25] !mb-6 !text-white xxl:!pr-32">
                    <?php echo $controller->get('heading'); ?>
                </h3>
                <p class="lead text-[1.15rem] !leading-[1.5] font-medium mb-7 lg:pr-5 xl:pr-5 xxl:pr-0 drop-shadow">
                    <?php echo $controller->get('description'); ?>
                </p>
                <?php if($controller->get('buttonCaption') && $controller->get('buttonLinkUrl')) : ?>
                    <div class="mt-8">
                        <a href="<?php echo $controller->get('buttonLinkUrl'); ?>"
                           target="<?php echo $controller->get('buttonLinkTarget'); ?>"
                           class="btn btn-lg <?php if($textColor === 'light') : ?>  !text-white !bg-[#343f52] border-[#343f52]<?php else: ?> !text-[#343f52] !bg-white !border-white <?php endif; ?> hover:text-white hover:bg-[#343f52] hover:border-[#343f52] focus:shadow-[rgba(82,92,108,1)] active:text-white active:bg-[#343f52] active:border-[#343f52] disabled:text-white disabled:bg-[#343f52] disabled:border-[#343f52] rounded">
                            <?php echo $controller->get('buttonCaption'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>