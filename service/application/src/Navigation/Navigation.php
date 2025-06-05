<?php
declare(strict_types=1);

namespace Application\Navigation;

use Application\Constants\Attributes;
use Application\Service\PaginatedItemsList\Builder\Pages;
use Concrete\Core\Attribute\Exception\InvalidAttributeException;
use Concrete\Core\Page\Page;


class Navigation extends AbstractNavigation
{
    private const CACHE_KEY_MAIN = 'navigation_main';
    private const EXCLUDED_PAGE_TYPE_HANDLES = ['news_article', 'highlight'];

    /**
     * @return array<Page>
     */
    public function getBreadcrumbs()
    {
        $breadcrumbs = [];
        $currentPage = Page::getCurrentPage();
        while($currentPage && $currentPage->getCollectionParentID() !== 0) {
            $breadcrumbs[] = $currentPage;
            $currentPage = Page::getById($currentPage->getCollectionParentID());
        }
        $breadcrumbs[] = Page::getById(1);
        return array_reverse($breadcrumbs);
    }

    /**
     * @return array<Page>
     */
    public function getNavigation(?Page $parent = null): array
    {
        $cacheKey = $this->generateCacheKey([self::CACHE_KEY_MAIN, $parent?->getCollectionID() ?? '1']);
        $item = $this->cache->getItem($cacheKey);
        if ($item->isMiss() === true) {
            $item->lock();
            $result = $this->buildNavigation($parent);
            $item->set($result)->setTTL(self::TTL);
            try {
                $this->cache->save($item);
            }
            catch(\Exception) {
                // nothing do to...
            }
        } else {
            /** @var array<Page> $result */
            $result = $item->get();
        }
        return $result;
    }

    /**
     * @return array<Page>
     */
    protected function buildNavigation(?Page $parent = null): array
    {
        $currentPage = Page::getCurrentPage();
        $parentId = $parent ? $parent->getCollectionID() : $currentPage->getSiteHomePageID();
        $list = new Pages();
        try {
            $list->filterByAttribute(Attributes::EXCLUDE_NAV, false);
            $list->includeAliases();
            $list->filterByParentID($parentId);
            $list->filterByExcludePageTypeHandles(self::EXCLUDED_PAGE_TYPE_HANDLES);
            $list->sortByDisplayOrder();
        } catch (InvalidAttributeException) {
            return [];
        }
        return $list->getResults();
    }
}
