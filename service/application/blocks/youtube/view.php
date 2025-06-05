<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Application\Block\BlockStyle;
use Concrete\Core\Block\View\BlockView;
/** @var BlockView $this */
$padding = (new BlockStyle)->getPaddingClass($this->getBlock()->getBlockID());
?>
<section class="wrapper !bg-[#ffffff]">
    <div class="container <?php echo $padding; ?>">
        <?php $this->inc('elements/view.php'); ?>
    </div>
</section>