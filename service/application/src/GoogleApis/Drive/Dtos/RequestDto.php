<?php
namespace Application\GoogleApis\Drive\Dtos;

class RequestDto
{
    public const string DRIVE_TYPE_PUBLIC = 'public';
    public const string DRIVE_TYPE_PRIVATE = 'private';

    private int $itemsPerPage;
    private ?string $pageToken;
    private int $page;
    private string $parentFolderId;
    private string $displayPermissions;
    private string $displayItemTypes;
    private string $orderBy;

    public function __construct(array $queryParams)
    {
        $this->parentFolderId = $queryParams['parentFolderId'];
        $this->page = intval($queryParams['page']) ?? 1;
        $this->itemsPerPage = intval($queryParams['itemsPerPage']) ?? 10;
        $this->pageToken = $queryParams['nextPageToken'] === 'null' ? null : $queryParams['nextPageToken'];
        $this->displayPermissions = $queryParams['displayPermissions'] === self::DRIVE_TYPE_PRIVATE ? self::DRIVE_TYPE_PRIVATE : self::DRIVE_TYPE_PUBLIC;
        $this->displayItemTypes = $queryParams['displayItemTypes'] ?? 'all';
        $this->orderBy = $queryParams['orderBy'] ?? 'modifiedTime desc';
    }

    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    public function getPageToken(): ?string
    {
        return $this->pageToken;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getParentFolderId(): string
    {
        return $this->parentFolderId;
    }

    public function getDisplayItemTypes(): string
    {
        return $this->displayItemTypes;
    }

    public function getDisplayPermissions(): string
    {
        return $this->displayPermissions;
    }

    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

}
