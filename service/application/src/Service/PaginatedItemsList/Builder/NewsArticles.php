<?php

namespace Application\Service\PaginatedItemsList\Builder;

use Application\Constants\PageTypes;

class NewsArticles extends AbstractPageList implements PaginatedItemsListInterface
{
    /** @var string[] */
    protected array $pageTypeHandles = [PageTypes::NEWS_ARTICLE];

    public function __construct(?int $parentPageId = null)
    {
        parent::__construct();
        $this->sortByPublicDateDescending();
        $this->filterByPageTypeHandle($this->pageTypeHandles);
        if($parentPageId) {
            $this->filterByParentID($parentPageId);
        }
    }
}
