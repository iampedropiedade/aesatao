<?php
namespace Application\Service\PaginatedItemsList\Builder;

class Pages extends AbstractPageList implements PaginatedItemsListInterface
{
    public function __construct(?int $parentPageId = null)
    {
        parent::__construct();
        if($parentPageId) {
            $this->filterByParentID($parentPageId);
        }
        $this->includeAliases();
        $this->sortByPublicDateDescending();
    }
}
