<?php
namespace Application\Dto\Response;

use Concrete\Core\Page\Page as CorePage;

class PageList extends AbstractItemList implements ItemListInterface
{
    /** @var array<Page> */
    public array $items = [];

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @param CorePage $item
     */
    public function addItem($item): self
    {
        $this->items[] = new Page($item);
        return $this;
    }
}