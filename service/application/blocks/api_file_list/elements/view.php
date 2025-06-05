<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Page\Page;
$c = Page::getCurrentPage();
?>
<?php if(is_object($c) && $c->isEditMode()) : ?>
    <div class="!text-center">
        <h2 class="!text-[.75rem] uppercase text-aesatao tracking-[0.02rem] leading-[1.35] !mb-3">
            API Item List
        </h2>
        <h3 class="text-[2rem] font-bold mb-10 xxl:!px-20">
            Conteúdo não disponível em modo de edição
        </h3>
    </div>
<?php else: ?>
    <item-list
            title="<?php echo $this->controller->get('title'); ?>"
            sub-title="<?php echo $this->controller->get('subTitle'); ?>"
            cta-caption="<?php echo $this->controller->get('ctaCaption'); ?>"
            cta-link-to-page-url="<?php echo $this->controller->get('ctaLinkToPageUrl'); ?>"
            item-type="<?php echo $this->controller->get('itemType', ''); ?>"
            :parent-folder-id="<?php echo $this->controller->get('parentFolderId', 0); ?>"
            :parent-page-id="<?php echo $this->controller->get('parentPageId', 0); ?>"
            :items-per-page="<?php echo $this->controller->get('itemsPerPage'); ?>"
            display-pagination="<?php echo $this->controller->get('displayPagination'); ?>"
            card-style="<?php echo $this->controller->get('cardStyle'); ?>"
            api-type="<?php echo $this->controller->get('apiType'); ?>"
            api-url="<?php echo $this->controller->get('apiUrl'); ?>"
            current-url="<?php echo $c->getCollectionLink(); ?>"
            query-filters="<?php echo $this->controller->get('filters'); ?>"
    ></item-list>
<?php endif; ?>
