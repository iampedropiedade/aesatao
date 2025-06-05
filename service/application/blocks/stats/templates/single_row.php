<?php
defined('C5_EXECUTE') or die('Access Denied.');
if(!is_array($this->controller->get('items')) || $this->controller->get('items') === 0) {
    return;
}
?>
<section class="wrapper !bg-white">
    <div class="container py-[6rem]">
        <div class="flex flex-wrap mx-[-15px] xl:mx-[-35px] lg:mx-[-20px] !mt-[-50px] xl:!mt-0 lg:!mt-0 !mb-2 items-end">
            <div
                    class="xl:w-4/12 lg:w-4/12 w-full flex-[0_0_auto] !px-[15px] xl:!px-[35px] lg:!px-[20px] !mt-[50px] xl:!mt-0 lg:!mt-0 max-w-full">
                <h2
                        class="!text-[0.8rem] uppercase inline-flex !leading-[1.35] text-line relative align-top !pl-[1.4rem] !tracking-[0.02rem] before:content-[''] before:absolute before:inline-block before:translate-y-[-60%] before:w-3 before:h-[0.05rem] before:left-0 before:top-2/4 before:bg-aesatao !text-aesatao  !mb-3">
                    <?php echo $this->controller->get('subTitle'); ?>
                </h2>
                <h3 class="!text-[calc(1.315rem_+_0.78vw)] font-bold xl:!text-[1.9rem] !leading-[1.25] !mb-0 xxl:!pr-20">
                    <?php echo $this->controller->get('title'); ?>
                </h3>
            </div>
            <div
                    class="lg:w-8/12 xl:w-8/12 w-full flex-[0_0_auto] !px-[15px] xl:!px-[35px] lg:!px-[20px] !mt-[50px] max-w-full xl:!mt-2 lg:!mt-2">
                <div class="flex flex-wrap mx-[-15px] items-center counter-wrapper !mt-[-30px] !text-center">
                    <?php foreach($this->controller->get('items') as $key=>$item) : ?>
                        <?php $this->inc('elements/view/single_row_' . $item['type'] . '.php', ['item' => $item, 'index'=>$key]); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>