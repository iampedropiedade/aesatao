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
        <div class="col-12">
            <hubspot-form
                    :portal-id="<?php echo $this->controller->get('portalId'); ?>"
                    form-id="<?php echo $this->controller->get('formId'); ?>"
                    region="<?php echo $this->controller->get('region'); ?>"
                    hubspot-script="//js-eu1.hsforms.net/forms/embed/v2.js"
                    styles-href="/application/themes/aee/app/css/hubspot.css"
            ></hubspot-form>
        </div>
    </div>
</div>
