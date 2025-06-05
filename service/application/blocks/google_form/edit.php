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
        <?php echo $form->label('embedUrl', t('Embed URL')); ?>
        <?php echo $form->text('embedUrl', $controller->get('embedUrl')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('formHeight', t('Form height')); ?>
        <?php echo $form->text('formHeight', $controller->get('formHeight')); ?>
    </div>
</fieldset>