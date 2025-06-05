<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Support\Facade\Application;
/** @var Concrete\Core\Form\Service\Form $form */
/** @var Application\Block\PageSectionAnchor\Controller $controller */
?>
<div class="tab-content">
    <div class="tab-pane active" id="object-content" role="tabpanel">
        <fieldset>
            <div class="form-group">
                <?php echo $form->label('sectionAnchor', t('Anchor')); ?>
                <?php echo $form->text('sectionAnchor', $controller->get('sectionAnchor')); ?>
            </div>
        </fieldset>
    </div>
</div>
