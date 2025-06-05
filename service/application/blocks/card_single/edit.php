<?php
defined('C5_EXECUTE') or die('Access Denied.');
use \Concrete\Core\Form\Service\Widget\PageSelector;
use Concrete\Core\Application\Service\FileManager;
assert(isset($form, $controller));

$pageSelector = new PageSelector();
$fileManager = new FileManager();
?>
<fieldset>
    <div class="form-group">
        <?php echo $form->label('title', t('Título')); ?>
        <?php echo $form->text('title', $controller->get('title')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('subTitle', t('Subtítulo')); ?>
        <?php echo $form->text('subTitle', $controller->get('subTitle')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('content', t('Conteúdo')); ?>
        <?php echo \Core::make('editor')->outputStandardEditor('content', $controller->getContentEditMode()); ?>
    </div>
    <div class="mb-3">
        <?php echo $form->label('imageId', 'Image') ?>
        <?php echo $fileManager->image('imageId', 'imageId', 'Choose image', $controller->get('imageId')) ?>
    </div>

    <div class="form-group">
        <?php echo $form->label('cardStyle', t('Card style')); ?>
        <?php echo $form->select('cardStyle', $controller->get('cardStyleOptions'), $controller->get('cardStyle')) ?>
    </div>

    <div class="form-group">
        <?php echo $form->label('ctaPageId', t('Botão (abrir página / deixar em branco para não mostrar)')); ?>
        <?php echo $pageSelector->selectPage('ctaPageId', $controller->get('ctaPageId')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('ctaCaption', t('Título do botão')); ?>
        <?php echo $form->text('ctaCaption', $controller->get('ctaCaption')); ?>
    </div>
</fieldset>