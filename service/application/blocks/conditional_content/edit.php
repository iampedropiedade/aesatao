<?php
defined('C5_EXECUTE') or die('Access Denied.');
use \Concrete\Core\Form\Service\Widget\PageSelector;
use Concrete\Core\Application\Service\FileManager;
assert(isset($form, $controller));

?>
<fieldset>
    <div class="form-group">
        <?php echo $form->label('content', t('content')); ?>
        <?php echo \Core::make('editor')->outputStandardEditor('content', $controller->getContentEditMode()); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label('viewedBy', t('Apenas visível para...')); ?>
        <?php echo $form->select('viewedBy', $controller->get('viewedByOptions'), $controller->get('viewedBy')) ?>
    </div>
</fieldset>