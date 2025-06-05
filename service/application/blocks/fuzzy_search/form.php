<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Application\Service\FileManager;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Form\Service\Widget\PageSelector;

/** @var Concrete\Core\Form\Service\Form $form */
/** @var Application\Block\FuzzySearch\Controller $controller */
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
                <?php echo $form->label('searchDomains', t('Display the following search tabs')); ?>
                <?php foreach ($controller->get('searchDomainsOptions') as $option => $optionLabel) : ?>
                    <div><label><?php echo $form->checkbox('searchDomains[]', $option, in_array($option, $controller->get('searchDomains'))); ?> <?php echo $optionLabel['title']; ?></label></div>
                <?php endforeach; ?>
            </div>
        </fieldset>
    </div>
</div>
