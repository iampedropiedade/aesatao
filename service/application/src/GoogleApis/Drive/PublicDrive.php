<?php
namespace Application\GoogleApis\Drive;

use Application\GoogleApis\Drive\Dtos\DriveDto;
use Application\GoogleApis\Drive\Dtos\RequestDto;
use Google\Exception;

class PublicDrive extends AbstractDrive implements DriveInterface
{
    /**
     * @throws Exception
     */
    public function getFolderContents(RequestDto $request): DriveDto
    {
        return $this->getItemsFromApi($request, $this->getPublicService());
    }

    /**
     * @throws Exception
     */
    public function find(string $query): DriveDto
    {
        return $this->findInApi($query, $this->getPublicService());
    }
}