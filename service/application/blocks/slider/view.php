<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Application\Block\BlockStyle;
use Concrete\Core\Block\View\BlockView;

if(!is_array($this->controller->get('items')) || $this->controller->get('items') === 0) {
    return;
}

/** @var BlockView $this */
$padding = (new BlockStyle)->getPaddingClass($this->getBlock()->getBlockID());
?>
<section class="wrapper bg-white"
    <?php if($this->controller->get('anchor')) : ?>
        id="<?php echo $this->controller->get('anchor'); ?>"
    <?php endif; ?>>
    <div class="container <?php echo $padding; ?>">

        <div class="flex flex-wrap">
            <div class="md:w-10/12 lg:w-full xl:w-10/12 xxl:w-9/12 w-full flex-[0_0_auto] !px-[15px] max-w-full !mx-auto !text-center">
                <?php if($this->controller->get('title')) : ?>
                    <h2 class="!mb-3 text-[1.8rem]">
                        <?php echo $this->controller->get('title'); ?>
                    </h2>
                <?php endif; ?>
                <?php if($this->controller->get('subTitle')) : ?>
                    <h4 class="font-bold !mb-7 lg:!px-36 xl:!px-32"><?php echo $this->controller->get('subTitle'); ?></h4>
                <?php endif; ?>
            </div>
        </div>

        <div class="flex flex-wrap mx-[-15px] grid-view md:mx-[-20px] lg:mx-[-20px] xl:mx-[-25px] !mt-[-40px] xl:!mt-0 lg:!mt-0">
            <?php foreach($this->controller->get('items') as $key=>$item) : ?>
                <?php $this->inc('elements/gallery/' . $item['type'] . '.php', ['item' => $item, 'index'=>$key]); ?>
            <?php endforeach; ?>
        </div>

</section>
