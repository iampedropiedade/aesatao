<?php
namespace Application\Service\PaginatedItemsList;

use Application\Dto\Response\ItemListInterface;
use Application\Service\PaginatedItemsList\Builder\PaginatedItemsListInterface;
use Concrete\Core\Http\Request;

class PaginatedItemsList
{
    public function __construct(protected PaginatedItemsListInterface $paginatedItemsList, protected Request $request)
    {
    }

    public function getResponse(): ?ItemListInterface
    {
        return $this->paginatedItemsList->getResponse($this->request);
    }

}