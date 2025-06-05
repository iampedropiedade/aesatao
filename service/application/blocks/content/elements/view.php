<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Page\Page;
$c = Page::getCurrentPage();
?>
<div class="row gy-4 mb-6">
    <div class="col-12 wysiwyg">
        <?php if(!$content && is_object($c) && $c->isEditMode()) : ?>
            <div class="ccm-edit-mode-disabled-item"><?=t('Empty Content Block.')?></div>
        <?php else : ?>
            <?php echo $content; ?>
        <?php endif; ?>
    </div>
</div>