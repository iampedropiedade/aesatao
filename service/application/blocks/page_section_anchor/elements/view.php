<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Page\Page;
$c = Page::getCurrentPage();
?>
<?php if(is_object($c) && $c->isEditMode()) : ?>
<section class="wrapper !bg-[#ffffff]">
    <div class="container py-2">
        <div class="!text-center">
            <h2 class="!text-[.75rem] uppercase text-aesatao tracking-[0.02rem] leading-[1.35] !mb-3">
                Section anchor #<?php echo $this->controller->get('sectionAnchor'); ?>
            </h2>
        </div>
    </div>
</section>
<?php else: ?>
    <span id="<?php echo $this->controller->get('sectionAnchor'); ?>"></span>
<?php endif; ?>
