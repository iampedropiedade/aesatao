<?php
defined('C5_EXECUTE') or die('Access Denied.');
?>
<div class="card shadow-lg">
    <div class="flex flex-wrap mx-0">
        <div class="xl:w-6/12 lg:w-6/12 w-full flex-[0_0_auto] max-w-full image-wrapper bg-image rounded-t-[0.4rem] rounded-lg-start hidden xl:block lg:block md:block bg-cover bg-[center_center] bg-no-repeat"
             data-image-src="<?php echo $this->controller->get('image'); ?>"
             style="background-image: url('<?php echo $this->controller->get('image'); ?>');">
        </div>
        <div class="xl:w-6/12 lg:w-6/12 w-full flex-[0_0_auto] max-w-full">
            <div class="p-8 md:p-10 xl:p-[2rem] lg:p-[1.5rem]">
                <h2 class="xl:text-[1.6rem] mb-3"><?php echo $this->controller->get('title'); ?></h2>
                <p class="lead text-[1.2rem] font-medium"><?php echo $this->controller->get('subTitle'); ?></p>
                <div>
                    <?php echo $this->controller->get('content'); ?>
                </div>
                <?php if($this->controller->get('ctaUrl')) : ?>
                    <a href="<?php echo $this->controller->get('ctaUrl'); ?>"
                       class="btn btn-violet !text-white !bg-aesatao border-aesatao hover:text-white hover:bg-aesatao hover:!border-aesatao   active:text-white active:bg-aesatao active:border-aesatao disabled:text-white disabled:bg-aesatao disabled:border-aesatao  !rounded-[50rem] !mt-2 hover:translate-y-[-0.15rem] hover:shadow-[0_0.25rem_0.75rem_rgba(30,34,40,0.15)]">
                        <?php echo $this->controller->get('ctaCaption'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

