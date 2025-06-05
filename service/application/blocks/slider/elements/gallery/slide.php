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
$itemsPerRow = $this->controller->get('itemsPerRow');
$itemClasses = 'w-full';
if(intval($itemsPerRow) === 2) {
    $itemClasses .= ' xl:w-6/12';
}
if(intval($itemsPerRow) === 3) {
    $itemClasses .= ' lg:w-6/12 xl:w-4/12';
}
if(intval($itemsPerRow) === 4) {
    $itemClasses .= ' md:w-6/12 lg:w-4/12 xl:w-3/12';
}
if(intval($itemsPerRow) === 6) {
    $itemClasses .= ' sm:w-4/12 md:w-4/12 lg:w-3/12 xl:w-2/12';
}
?>
<div class="<?php echo $itemClasses; ?> flex-[0_0_auto] xl:!px-[25px] lg:!px-[20px] md:!px-[20px] !px-[15px] max-w-full md:!mt-[40px] max-md:!mt-[40px]">
    <div class="!relative">
        <div class="card shadow-md">
            <?php if (isset($image) && $image) : ?>
                <figure class="card-img-top"><img class="max-w-full h-auto" src="<?php echo $image->getSrc(1200, 1200) ?>" alt="<?php echo $item['title']; ?>"></figure>
            <?php endif; ?>
            <div class="card-body px-6 py-5">
                <h4 class="mb-2 font-bold"><?php echo $item['heading']; ?></h4>
                <p class="mb-2 text-[.85rem] font-semibold"><?php echo $item['title']; ?></p>
                <div class="!mb-0 text-[.75rem]">
                    <?php echo $item['content']; ?>
                </div>
            </div>
        </div>
    </div>
</div>