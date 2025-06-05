<?php
namespace Application\Dto\Response;

use Pagerfanta\Pagerfanta;

abstract class AbstractItemList
{
    public array $items;
    public Pagination $pagination;

    public function __construct(?Pagerfanta $pagination = null)
    {
        $this->pagination = new Pagination($pagination);
        foreach($pagination->getCurrentPageResults() as $item) {
            $this->addItem($item);
        }
    }

    abstract public function getItems();
    abstract public function setItems(array $items): ItemListInterface;
    abstract public function addItem($item): ItemListInterface;

    public function getPagination(): Pagination
    {
        return $this->pagination;
    }

    public function setPagination(Pagination $pagination): ItemListInterface
    {
        $this->pagination = $pagination;
        return $this;
    }
}