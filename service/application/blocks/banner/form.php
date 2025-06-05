<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Application\Service\FileManager;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Form\Service\Widget\PageSelector;
use Concrete\Core\Application\Service\UserInterface;

/** @var Concrete\Core\Form\Service\Form $form */
/** @var Application\Block\Hero\Controller $controller */
/** @var FileManager $fileManager */
/** @var PageSelector $pageSelector */

$app = Application::getFacadeApplication();
$fileManager = $app->make(FileManager::class);
$pageSelector = $app->make(PageSelector::class);

/** @var Concrete\Core\Application\Service\UserInterface $userInterface */
$userInterface = $app->make(UserInterface::class);

echo $userInterface->tabs([
    ['list-content', t('Conteúdo'), true],
    ['list-buttons', t('Botões')],
    ['list-stats', t('Estatísticas')],
]);
?>
<div class="tab-content">
    <div class="tab-pane active" id="list-content" role="tabpanel">
        <fieldset class="mb-3 ting">
            <legend><?php echo t('Content'); ?></legend>

            <div class="mb-3">
                <?php echo $form->label('title', 'Title') ?>
                <?php echo $form->text('title', $controller->get('title')) ?>
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
        </fieldset>
    </div>

    <div class="tab-pane" id="list-buttons" role="tabpanel">
        <fieldset class="mb-3 ting">
            <div class="mb-3">
                <?php echo $form->label('buttonCaption', 'Main button caption') ?>
                <?php echo $form->text('buttonCaption', $controller->get('buttonCaption')) ?>
            </div>

            <div class="mb-3">
                <?php echo $form->label('buttonLinkToSection', 'Main button - link to page section') ?>
                <?php echo $form->text('buttonLinkToSection', $controller->get('buttonLinkToSection')) ?>
            </div>

            <div class="mb-3">
                <label class="form-label" for="buttonPageId"><?=t('Main button - link to page')?></label>
                <?php echo $pageSelector->selectPage('buttonPageId', $controller->get('buttonPageId')) ?>
            </div>

            <div class="mb-3">
                <?php echo $form->label('button2Caption', 'Secondary button caption') ?>
                <?php echo $form->text('button2Caption', $controller->get('button2Caption')) ?>
            </div>

            <div class="mb-3">
                <?php echo $form->label('button2LinkToSection', 'Secondary button - link to page section') ?>
                <?php echo $form->text('button2LinkToSection', $controller->get('button2LinkToSection')) ?>
            </div>

            <div class="mb-3">
                <label class="form-label" for="button2PageId"><?=t('Secondary button - link to page')?></label>
                <?php echo $pageSelector->selectPage('button2PageId', $controller->get('button2PageId')) ?>
            </div>

        </fieldset>
    </div>

    <div class="tab-pane" id="list-stats" role="tabpanel">
        <div class="mb-3">
            <?php echo $form->label('statIcon', 'Icon') ?>
            <?php echo $form->text('statIcon', $controller->get('statIcon')) ?>
        </div>
        <div class="mb-3">
            <?php echo $form->label('statTitle', 'Title') ?>
            <?php echo $form->text('statTitle', $controller->get('statTitle')) ?>
        </div>
        <div class="mb-3">
            <?php echo $form->label('statDescription', 'Description') ?>
            <?php echo $form->text('statDescription', $controller->get('statDescription')) ?>
        </div>
    </div>
</div>