<?php
defined('C5_EXECUTE') or die('Access Denied.');
use \Concrete\Core\Form\Service\Widget\PageSelector;
use Concrete\Core\Application\Service\FileManager;
assert(isset($form, $controller));

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
        <?php echo $form->label('parentFolderId', t('Parent folder ID')); ?>
        <?php echo $form->text('parentFolderId', $controller->get('parentFolderId')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('displayPermissions', t('Display permissions')); ?>
        <?php echo $form->select('displayPermissions', $controller->get('displayPermissionsOptions'), $controller->get('displayPermissions')) ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('displayItemTypes', t('Display items of the following types')); ?>
        <?php echo $form->select('displayItemTypes', $controller->get('displayItemTypesOptions'), $controller->get('displayItemTypes')) ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('defaultItemStyle', t('Default display style')); ?>
        <?php echo $form->select('defaultItemStyle', $controller->get('itemStyleOptions'), $controller->get('defaultItemStyle')) ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('itemsPerPage', t('Max number of items per page')); ?>
        <?php echo $form->text('itemsPerPage', $controller->get('itemsPerPage', 9)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('displayPagination', t('Display pagination')); ?>
        <?php echo $form->select('displayPagination', $controller->get('displayPaginationOptions'), $controller->get('displayPagination')) ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('openFoldersMethod', t('Abrir pastas...')); ?>
        <?php echo $form->select('openFoldersMethod', $controller->get('openFoldersMethodOptions'), $controller->get('openFoldersMethod')) ?>
    </div>
    <div class="form-group">
        <?php echo $form->label('orderBy', t('Sort by')); ?>
        <?php echo $form->select('orderBy', $controller->get('sortOptions'), $controller->get('orderBy')) ?>
    </div>
</fieldset>