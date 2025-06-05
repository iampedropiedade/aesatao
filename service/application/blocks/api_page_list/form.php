<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Application\Service\FileManager;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Form\Service\Widget\PageSelector;
use Concrete\Core\Application\Service\UserInterface;

/** @var Concrete\Core\Form\Service\Form $form */
/** @var Application\Block\ApiPageList\Controller $controller */
/** @var FileManager $fileManager */
/** @var PageSelector $pageSelector */

$app = Application::getFacadeApplication();
$pageSelector = $app->make(PageSelector::class);

/** @var Concrete\Core\Application\Service\UserInterface $userInterface */
$userInterface = $app->make(UserInterface::class);

echo $userInterface->tabs([
    ['list-content', t('Conteúdo'), true],
    ['list-filter-sorting', t('Filtros e ordenação')],
    ['list-button', t('Botão adicional')],
]);
?>
<div class="tab-content">
    <div class="tab-pane active" id="list-content" role="tabpanel">
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
                <?php echo $form->label('cardStyle', t('Estilo')); ?>
                <?php echo $form->select('cardStyle', $controller->get('cardStyleOptions'), $controller->get('cardStyle')) ?>
            </div>

            <div class="form-group">
                <?php echo $form->label('itemsPerPage', t('Items por página')); ?>
                <?php echo $form->text('itemsPerPage', $controller->get('itemsPerPage', 9)); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('displayPagination', t('Mostrar paginação')); ?>
                <?php echo $form->select('displayPagination', $controller->get('displayPaginationOptions'), $controller->get('displayPagination')) ?>
            </div>
        </fieldset>
    </div>
    <div class="tab-pane" id="list-filter-sorting" role="tabpanel">
        <fieldset>
            <div class="form-group">
                <?php echo $form->label('sort', t('Ordernar')); ?>
                <?php echo $form->select('sort', $controller->get('sortOptions'), $controller->get('sort')) ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('parentPageId', t('Apenas subpáginas de...')); ?>
                <?php echo $pageSelector->selectPage('parentPageId', $controller->get('parentPageId')); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('filterPageTypes', t('Tipos de página')); ?>
                <?php echo $form->selectMultiple('filterPageTypes', $controller->get('pageTypeOptions'), $controller->get('filterPageTypes'), ['data-behaviour'=>'smart-select', 'class'=>'smart-select']) ?>
            </div>

            <div class="form-group">
                <?php echo $form->label('filterTagsIn', t('Apenas mostrar páginas com as seguintes tags')); ?>
                <?php echo $form->selectMultiple('filterTagsIn', $controller->get('tagsList'), $controller->get('filterTagsIn'), ['data-behaviour'=>'smart-select', 'class'=>'smart-select']); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('filterTagsOut', t('Não mostrar páginas com as seguintes tags')); ?>
                <?php echo $form->selectMultiple('filterTagsOut', $controller->get('tagsList'), $controller->get('filterTagsOut'), ['data-behaviour'=>'smart-select', 'class'=>'smart-select']); ?>
            </div>
        </fieldset>
    </div>
    <div class="tab-pane" id="list-button" role="tabpanel">
        <fieldset>
            <div class="form-group">
                <?php echo $form->label('ctaCaption', t('Título')); ?>
                <?php echo $form->text('ctaCaption', $controller->get('ctaCaption')); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label('ctaLinkToPageId', t('Ligar à página...')); ?>
                <?php echo $pageSelector->selectPage('ctaLinkToPageId', $controller->get('ctaLinkToPageId')); ?>
            </div>
        </fieldset>
    </div>
</div>
<script>
    applicationBlockFunctions.smartSelect();
</script>