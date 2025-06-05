<?php
namespace Application\Block\CustomSitemap;

use Application\Constants\Attributes;
use Application\Constants\PageTypes;
use Application\Service\ItemsList\Pages\PageList;
use Application\Service\PaginatedItemsList\Builder\Pages;
use Concrete\Core\Block\BlockController;
use Concrete\Core\Page\Page;

class Controller extends BlockController
{
    protected $btTable = 'btCustomSitemap';
    protected $btInterfaceWidth = '900';
    protected $btInterfaceHeight = '600';
    protected $btDefaultSet = 'application';

    /**
     * @return string
     */
    public function getBlockTypeDescription()
    {
        return t('Custom sitemap');
    }

    /**
     * @return string
     */
    public function getBlockTypeName()
    {
        return t('Custom sitemap');
    }

    public function add()
    {
        $this->edit();
    }

    public function edit()
    {
    }

    public function view()
    {
        $this->set('pages', $this->getChildPages());
    }

    public function getChildPages(?int $parentId = null)
    {
        $parentId = $parentId ?? Page::getHomePageID();
        $list = new Pages();
        $list->filterByParentID($parentId);
        $list->filterByExcludePageTypeHandles([PageTypes::NEWS_ARTICLE]);
        // $list->includeAliases();
        $list->sortByDisplayOrder();
        return $list->getResults();
    }
}
