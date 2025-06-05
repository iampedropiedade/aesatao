<?php
namespace Application\Dto\Response;

use Pagerfanta\Pagerfanta;

class Pagination
{
    public int $currentPage = 1;
    public int $totalPages = 0;
    public int $itemsPerPage = 10;
    public int $totalItems = 0;
    public ?int $nextPage;
    public ?int $previousPage;
    public bool $hasNextPage = false;
    public bool $hasPreviousPage = false;

    public function __construct(Pagerfanta $pagerfanta = null)
    {
        $this->currentPage = $pagerfanta->getCurrentPage();
        $this->totalPages = $pagerfanta->getNbPages();
        $this->itemsPerPage = $pagerfanta->getMaxPerPage();
        $this->totalItems = $pagerfanta->getNbResults();
        $this->nextPage = $pagerfanta->hasNextPage() ? $pagerfanta->getNextPage() : null;
        $this->previousPage = $pagerfanta->hasPreviousPage() ? $pagerfanta->getPreviousPage() : null;
        $this->hasPreviousPage = $pagerfanta->hasPreviousPage();
        $this->hasNextPage = $pagerfanta->hasNextPage();
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function setCurrentPage(int $currentPage): Pagination
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function setTotalPages(int $totalPages): Pagination
    {
        $this->totalPages = $totalPages;
        return $this;
    }

    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    public function setItemsPerPage(int $itemsPerPage): Pagination
    {
        $this->itemsPerPage = $itemsPerPage;
        return $this;
    }

    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    public function setTotalItems(int $totalItems): Pagination
    {
        $this->totalItems = $totalItems;
        return $this;
    }

}