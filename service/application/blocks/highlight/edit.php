<?php
defined('C5_EXECUTE') or die('Access Denied.');
use \Concrete\Core\Form\Service\Widget\PageSelector;
use Concrete\Core\Application\Service\FileManager;
assert(isset($form, $controller));

$pageSelector = new PageSelector();
$al = new FileManager();
?>
<fieldset>
    <div class="form-group">
        <?php echo $form->label('title', t('Title')); ?>
        <?php echo $form->text('title', $controller->get('title')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('subTitle', t('Section subtitle')); ?>
        <?php echo $form->text('subTitle', $controller->get('subTitle')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('content', t('Content')); ?>
        <?php echo \Core::make('editor')->outputStandardEditor('content', $controller->getContentEditMode()); ?>
    </div>

    <div class="mb-3">
        <?php echo $form->label('buttonCaption', 'Button caption') ?>
        <?php echo $form->text('buttonCaption', $controller->get('buttonCaption')) ?>
    </div>

    <div class="mb-3">
        <?php echo $form->label('buttonLinkToSection', 'Button - link to page section') ?>
        <?php echo $form->text('buttonLinkToSection', $controller->get('buttonLinkToSection')) ?>
    </div>

    <div class="mb-3">
        <label class="form-label" for="buttonPageId"><?=t('Button - link to page')?></label>
        <?php echo $pageSelector->selectPage('buttonPageId', $controller->get('buttonPageId')) ?>
    </div>

    <div class="form-group">
        <?php echo $form->label('backgroundImageId', t('Background Image')); ?>
        <?php echo $al->image('backgroundImageId', 'backgroundImageId', 'Select an image', $controller->get('backgroundImageId')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('align', t('Image position')); ?>
        <?php echo $form->select('align', ['left'=>'Left', 'right'=>'Right'], $controller->get('align')); ?>
    </div>
</fieldset>