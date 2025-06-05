<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Page\Page;
$c = Page::getCurrentPage();
?>
<?php if(is_object($c) && $c->isEditMode()) : ?>
    <div class="!text-center">
        <h2 class="!text-[.75rem] uppercase text-aesatao tracking-[0.02rem] leading-[1.35] !mb-3">
            Google Drive Folder
        </h2>
        <h3 class="text-[2rem] font-bold mb-10 xxl:!px-20">
            Conteúdo não disponível em modo de edição
        </h3>
        <p>
            <strong>Google Drive:</strong> <?php echo $this->controller->get('parentFolderId'); ?>
        </p>
    </div>
<?php else: ?>
    <div class="container">
        <div class="row gy-4 mb-6">
            <google-drive
                    title="<?php echo $this->controller->get('title'); ?>"
                    sub-title="<?php echo $this->controller->get('subTitle'); ?>"
                    item-type="<?php echo $this->controller->get('itemType', ''); ?>"
                    parent-folder-id="<?php echo $this->controller->get('parentFolderId'); ?>"
                    display-permissions="<?php echo $this->controller->get('displayPermissions'); ?>"
                    :items-per-page="<?php echo $this->controller->get('itemsPerPage'); ?>"
                    display-pagination="<?php echo $this->controller->get('displayPagination'); ?>"
                    default-item-style="<?php echo $this->controller->get('defaultItemStyle'); ?>"
                    open-folders-method="<?php echo $this->controller->get('openFoldersMethod'); ?>"
                    order-by="<?php echo $this->controller->get('orderBy'); ?>"
                    api-url="<?php echo $this->controller->get('apiUrl'); ?>"
            ></google-drive>
        </div>
    </div>
<?php endif; ?>