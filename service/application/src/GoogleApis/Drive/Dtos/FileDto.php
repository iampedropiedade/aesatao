<?php
namespace Application\GoogleApis\Drive\Dtos;

use Google\Service\Drive\DriveFile;
use DateTime;

class FileDto
{
    private bool $folder;
    private string $id;
    private string $title;
    private string $icon;
    private ?string $viewLink;
    private ?string $downloadLink;
    private ?string $size;
    private ?DateTime $dateCreated;
    private ?DateTime $dateModified;

    public function __construct(DriveFile $file)
    {
        $this->id = $file->getId();
        $this->title = $this->formatTitle($file->getName());
        $this->size = $file->getSize();
        $this->viewLink = $file->getWebViewLink();
        $this->downloadLink = $file->getWebContentLink();
        try {
            $this->dateCreated = $file->getCreatedTime() ? new DateTime($file->getCreatedTime()) : null;
        } catch (\DateMalformedStringException) {
            $this->dateCreated = null;
        }
        try {
            $this->dateModified = $file->getModifiedTime() ? new DateTime($file->getModifiedTime()) : null;
        } catch (\DateMalformedStringException) {
            $this->dateModified = null;
        }
        $this->mapIcon($file->getMimeType());
        $this->folder = $file->getMimeType() === 'application/vnd.google-apps.folder';
    }

   public function getId(): string
   {
        return $this->id;
    }

    public function isFolder(): bool
    {
        return $this->folder;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getViewLink(): ?string
    {
        return $this->viewLink;
    }

    public function getDownloadLink(): ?string
    {
        return $this->downloadLink;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function getDateCreated(): ?DateTime
    {
        return $this->dateCreated;
    }

    public function getDateModified(): ?DateTime
    {
        return $this->dateModified;
    }

    private function mapIcon(string $mimeType): void
    {
        if (str_contains($mimeType, 'folder')) {
            $this->icon = 'fa-regular fa-folder-open';
            return;
        }

        if (str_contains($mimeType, 'pdf')) {
            $this->icon = 'fa-regular fa-file-pdf';
            return;
        }

        if (str_contains($mimeType, 'png') || str_contains($mimeType, 'jpg')) {
            $this->icon = 'fa-regular fa-file-image';
            return;
        }

        $this->icon = 'fa-regular fa-file';
    }

    public function getSizeFormatted(): string
    {
        if ($this->size === null) {
            return 'Unknown';
        }
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $factor = floor((strlen($this->size) - 1) / 3);
        return sprintf("%.1f %s", $this->size / pow(1024, $factor), $units[$factor]);
    }

    private function formatTitle(string $title): string
    {
        return str_replace('_', ' ', $title);
    }
}
