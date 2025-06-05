<?php
namespace Application\GoogleApis\Drive;

use Application\GoogleApis\Drive\Dtos\DriveDto;
use Application\GoogleApis\Drive\Dtos\RequestDto;

class UserDrive extends AbstractDrive implements DriveInterface
{

    public function getFolderContents(RequestDto $request): DriveDto
    {
        return $this->getItemsFromApi($request, $this->getUserService());
    }

    public function find(string $query): DriveDto
    {
        return $this->findInApi($query, $this->getUserService());
    }

}