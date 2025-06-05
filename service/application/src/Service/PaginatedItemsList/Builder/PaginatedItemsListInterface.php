<?php
namespace Application\Service\PaginatedItemsList\Builder;

use Application\Dto\Response\ItemListInterface;
use Concrete\Core\Http\Request;

interface PaginatedItemsListInterface
{
    public function getResponse(Request $request): ItemListInterface;
}
