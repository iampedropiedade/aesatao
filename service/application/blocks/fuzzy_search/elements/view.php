<?php
defined('C5_EXECUTE') or die('Access Denied.');
use Concrete\Core\Page\Page;
$c = Page::getCurrentPage();
?>
<?php if(is_object($c) && $c->isEditMode()) : ?>
    <div class="!text-center">
        <h2 class="!text-[.75rem] uppercase text-aesatao tracking-[0.02rem] leading-[1.35] !mb-3">
            Fuzzy Search
        </h2>
        <h3 class="text-[2rem] font-bold mb-10 xxl:!px-20">
            Conteúdo não disponível em modo de edição
        </h3>
    </div>
<?php else: ?>
    <fuzzy-search
        :allowed-search-domains="<?php echo htmlentities(json_encode($this->controller->get('allowedSearchDomains'))); ?>"
        original-query="<?php echo $this->controller->get('query'); ?>"
        api-url="<?php echo \Application\Routes\Router::ROUTE_SEARCH; ?>"
    ></fuzzy-search>
<?php endif; ?>
