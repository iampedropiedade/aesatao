<?php

namespace Application\Service\PaginatedItemsList\Builder;

use Application\Constants\PageTypes;

class Highlights extends AbstractPageList implements PaginatedItemsListInterface
{
    /** @var string[] */
    protected array $pageTypeHandles = [PageTypes::HIGHLIGHT];

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
