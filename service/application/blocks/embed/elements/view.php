<?php
defined('C5_EXECUTE') or die('Access Denied.');
?>
<div class="container">
    <div class="row gy-4 mb-6">

        <?php if ( $this->controller->get('title')) : ?>
            <div class="col-12">
                <h3><?php echo $this->controller->get('title'); ?></h3>
            </div>
        <?php endif; ?>
        <?php if ( $this->controller->get('intro')) : ?>
            <div class="col-12 wysiwyg">
                <?php echo $this->controller->get('intro'); ?>
            </div>
        <?php endif; ?>
        <iframe src="<?php echo $this->controller->get('embedCode'); ?>" class="w-full min-h-[40rem]"></iframe>

    </div>
</div>
