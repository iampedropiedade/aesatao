<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Application\Constants\Attributes;
use Application\Service\Picture;
?>
<section class="section-sm lg:section overlay bg-cover bg-no-repeat"
         <?php if($this->controller->get('backgroundImage')) : ?>
            style="background-image:url(<?php echo $this->controller->get('backgroundImage'); ?>">
        <?php endif; ?>
    <div class="container overlay-content">
        <div class="row">
            <div class="text-white <?php echo $this->controller->get('align'); ?> <?php echo $this->controller->get('width'); ?>">
                <div class="bg-secondary px-10 py-12 rounded-md">
                    <h3 class="h3">
                        <?php echo $this->controller->get('title'); ?>
                    </h3>
                    <div class="separator separator-secondary mb-8"></div>
                    <?php echo $this->controller->get('content'); ?>
                </div>
            </div>
        </div>
    </div>
</section>