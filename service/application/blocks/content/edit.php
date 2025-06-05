<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Application\Block\BlockStyle;
use Concrete\Core\Block\View\BlockView;

/** @var \Concrete\Block\Content\Controller $controller */
/** @var BlockView $this */
$padding = (new BlockStyle)->getPaddingClass($this->getBlock()->getBlockID());
?>
<section class="wrapper !bg-[#ffffff]">
    <div class="container <?php echo $padding; ?>">
        <?php echo app('editor')->outputPageInlineEditor('content', $controller->getContentEditMode()); ?>
    </div>
</section>
