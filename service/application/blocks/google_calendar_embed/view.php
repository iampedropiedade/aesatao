<?php
defined('C5_EXECUTE') or die('Access Denied.');
?>
<?php if ( $this->controller->get('embedUrl')) : ?>
    <section class="wrapper">
        <div class="container py-14 xl:py-24 lg:py-20 md:py-18">
            <?php $this->inc('elements/view.php'); ?>
        </div>
    </section>
<?php endif; ?>
