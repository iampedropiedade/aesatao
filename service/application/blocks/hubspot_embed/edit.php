<?php
defined('C5_EXECUTE') or die('Access Denied.');
use \Concrete\Core\Form\Service\Widget\PageSelector;
use Concrete\Core\Application\Service\FileManager;
assert(isset($form, $controller));

$ps = new PageSelector();
$al = new FileManager();
?>
<fieldset>
    <div class="form-group">
        <?php echo $form->label('title', t('Title')); ?>
        <?php echo $form->text('title', $controller->get('title')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('intro', t('Intro')); ?>
        <?php echo \Core::make('editor')->outputStandardEditor('intro', $controller->getContentEditMode()); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('portalId', t('Portal ID')); ?>
        <?php echo $form->text('portalId', $controller->get('portalId')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('formId', t('Form ID')); ?>
        <?php echo $form->text('formId', $controller->get('formId')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('region', t('Region')); ?>
        <?php echo $form->text('region', $controller->get('region'), ['maxlength'=>12]); ?>
    </div>
</fieldset>