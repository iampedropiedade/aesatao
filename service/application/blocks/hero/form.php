<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Application\Service\FileManager;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Form\Service\Widget\PageSelector;

/** @var Concrete\Core\Form\Service\Form $form */
/** @var Application\Block\Hero\Controller $controller */
/** @var FileManager $fileManager */
/** @var PageSelector $pageSelector */

$app = Application::getFacadeApplication();
$fileManager = $app->make(FileManager::class);
$pageSelector = $app->make(PageSelector::class);
?>
<div class="tab-content">

    <div class="tab-pane active" id="object-content" role="tabpanel">
        <fieldset class="mb-3 ting">
            <legend><?php echo t('Content'); ?></legend>

            <div class="mb-3">
                <?php echo $form->label('title', 'Title') ?>
                <?php echo $form->text('title', $controller->get('title')) ?>
            </div>

            <div class="mb-3">
                <?php echo $form->label('heading', 'Heading') ?>
                <?php echo $form->text('heading', $controller->get('heading')) ?>
            </div>

            <div class="mb-3">
                <?php echo $form->label('description', 'Description') ?>
                <?php echo \Core::make('editor')->outputStandardEditor('description', $controller->getContentEditMode('description')); ?>
            </div>

            <div class="mb-3">
                <?php echo $form->label('imageId', 'Image') ?>
                <?php echo $fileManager->image('imageId', 'imageId', 'Choose image', $controller->get('imageId')) ?>
                <div class="help-block text-center"><?php echo sprintf("Recommended size is %s x %s", 1312, 736) ?></div>
            </div>

            <div class="mb-3">
                <?php echo $form->label('buttonCaption', 'Button caption') ?>
                <?php echo $form->text('buttonCaption', $controller->get('buttonCaption')) ?>
            </div>

            <div class="mb-3">
                <?php echo $form->label('buttonLinkToSection', 'Button - link to URL or page section') ?>
                <?php echo $form->text('buttonLinkToSection', $controller->get('buttonLinkToSection')) ?>
            </div>

            <div class="mb-3">
                <label class="form-label" for="buttonPageId"><?=t('Button - link to page')?></label>
                <?php echo $pageSelector->selectPage('buttonPageId', $controller->get('buttonPageId')) ?>
            </div>

        </fieldset>
    </div>
</div>
