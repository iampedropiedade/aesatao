<?php
defined('C5_EXECUTE') or die('Access Denied.');
?>
<?php if ( $this->controller->get('title')) : ?>
    <div class="mb-6">
        <h2><?php echo $this->controller->get('title'); ?></h2>
    </div>
<?php endif; ?>
<?php if ( $this->controller->get('intro')) : ?>
    <div class="mb-12 wysiwyg">
        <?php echo $this->controller->get('intro'); ?>
    </div>
<?php endif; ?>
<div>
    <google-form
            embed-url="<?php echo $this->controller->get('embedUrl'); ?>"
            form-height="<?php echo $this->controller->get('formHeight', '800px'); ?>"
    ></google-form>
</div>
