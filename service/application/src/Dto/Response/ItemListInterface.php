<?php
namespace Application\Dto\Response;

interface ItemListInterface
{
    public function getItems();
    public function setItems(array $items): self;
    public function addItem($item): self;
    public function getPagination(): Pagination;
    public function setPagination(Pagination $pagination): self;
}
