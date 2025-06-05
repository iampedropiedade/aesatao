<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Application\Service\FileManager;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Form\Service\Widget\PageSelector;

/** @var Concrete\Core\Form\Service\Form $form */
/** @var Application\Block\ApiPageList\Controller $controller */
/** @var FileManager $fileManager */
/** @var PageSelector $pageSelector */

$app = Application::getFacadeApplication();
$fileManager = $app->make(FileManager::class);
$pageSelector = $app->make(PageSelector::class);
?>
<div class="tab-content">
    <div class="tab-pane active" id="object-content" role="tabpanel">
        <fieldset>
            <div class="form-group">
                <?php echo $form->label('title', t('Section title')); ?>
                <?php echo $form->text('title', $controller->get('title')); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('subTitle', t('Section subtitle')); ?>
                <?php echo $form->text('subTitle', $controller->get('subTitle')); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('itemType', t('Display pages of this type')); ?>
                <?php echo $form->select('itemType', $controller->get('pageTypeOptions'), $controller->get('itemType')) ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('parentFolderId', t('Display files under this folder')); ?>
                <?php echo $form->select('parentFolderId', $controller->get('fileManagerFolderOptions'), $controller->get('parentFolderId')) ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('cardStyle', t('Card style')); ?>
                <?php echo $form->select('cardStyle', $controller->get('cardStyleOptions'), $controller->get('cardStyle')) ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('parentPageId', t('Parent page (leave blank for none)')); ?>
                <?php echo $pageSelector->selectPage('parentPageId', $controller->get('parentPageId')); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('itemsPerPage', t('Max number of items per page')); ?>
                <?php echo $form->text('itemsPerPage', $controller->get('itemsPerPage', 10)); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('displayPagination', t('Display pagination')); ?>
                <?php echo $form->select('displayPagination', $controller->get('displayPaginationOptions'), $controller->get('displayPagination')) ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('sort', t('Sort by')); ?>
                <?php echo $form->select('sort', $controller->get('sortOptions'), $controller->get('sort')) ?>
            </div>
        </fieldset>
        <fieldset>
            <div class="form-group">
                <?php echo $form->label('ctaCaption', t('CTA Caption')); ?>
                <?php echo $form->text('ctaCaption', $controller->get('ctaCaption')); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('ctaLinkToPageId', t('CTA page')); ?>
                <?php echo $pageSelector->selectPage('ctaLinkToPageId', $controller->get('ctaLinkToPageId')); ?>
            </div>
        </fieldset>
    </div>
</div>
