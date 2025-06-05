<?php
namespace Application\Dto\Response;

use Concrete\Core\Entity\File\File as CoreFile;

class FileList extends AbstractItemList implements ItemListInterface
{
    /** @var array<File> */
    public array $items;

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
     * @param CoreFile $item
     */
    public function addItem($item): self
    {
        $this->items[] = new File($item);
        return $this;
    }
}