<?php
namespace Application\GoogleApis\Drive\Dtos;

use Google\Service\Drive\FileList;

class DriveDto
{
    /**
     * @var FileDto[]
     */
    private array $items;

    private ?string $nextPageToken;

    public function __construct(FileList $list)
    {
        $this->nextPageToken = $list->getNextPageToken();
        foreach ($list->getFiles() as $file) {
            $this->items[] = new FileDto($file);
        }
    }

    /**
     * @return FileDto[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getNextPageToken(): ?string
    {
        return $this->nextPageToken;
    }
}
